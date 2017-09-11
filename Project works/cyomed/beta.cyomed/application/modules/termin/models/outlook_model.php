<?php
class Outlook_model extends CI_Model {
    private $auth_token_key = 'outlook_auth_token';
    private $calendarID = 'primary';
    private $timezone = 'Asia/Kolkata';
    private $dbi = null; //database instance
    private $client=NULL;

    public function __construct() {
	parent::__construct();
	$this->dbi = $this->load->database();
	$this->load->library('session');
	$this->load->helper('outlookapi');
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->client=new Outlookapi();
	$this->client->setClient_id(OUTLOOK_CLIENT_ID);
	$this->client->setClient_secret(OUTLOOK_CLIENT_SECRET);
	$this->client->setRedirect_uri(OUTLOOK_REDIRECT_URI);
    }
    //
    public function APIAction() {
	$output = array();
	$output['action'] = 'nothing';
	if (!$this->getAuthToken()) {
	    // acess code returned
	    if ($this->input->get('code')) {
		$code = $this->input->get('code');
		if ($this->client->authenticate($code)) {
		    $this->setAuthToken($this->client->getAccessToken());
		    $output['action'] = 'refresh';
		}
	    }
	    if ($this->input->get('logout')) {
		$token = $this->getAuthToken();
		if (!empty($token)) {
		    $this->client->revokeToken($token);
		}
		$this->unsetAuthToken();
		$output['action'] = 'refresh';
	    }
	    //unable to obtain acess token so need to authorize/login
	    if (!$this->client->getAccessToken()) {
		$authUrl = $this->client->createAuthUrl();
		$output['action'] = 'redirect';
		$output['url'] = $authUrl;
	    }
	} else {
	      $auth_token=  $this->getAuthToken();
	      $this->setAuthToken($auth_token);
	      $this->client->refreshToken();
	}
	return $output;
    }
    //
    public function syncEvent($eventdata, $showerror = 0) {
	
	$weekdays = array('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');
	if (!isset($eventdata['id'])) {
	    return 0;
	}
	$this->client->setAccessToken($this->getAuthToken());
	$id = md5($eventdata['id']);
	try {
	    $service = new Google_Service_Calendar($this->client);
	    $event = new Google_Service_Calendar_Event();
	    $exists = $this->getEvent($id);
	    if ($exists) {
		$event->setId($exists->getId());
	    } else {
		$event->setId($id);
	    }
	    if (isset($eventdata['color'])) {
		$colorID=  $this->getColor($eventdata['color']);
		if($colorID){
		    $event->setColorId($colorID);
		}
	    }
	    if (isset($eventdata['title'])) {
		$event->setSummary($eventdata['title']);
	    }
	    if (isset($eventdata['description'])) {
		$event->setDescription($eventdata['description']);
	    }
	    if (isset($eventdata['participants']) && is_array(@$eventdata['participants'])) {
		$participants = array();
		for ($i = 0; $i < count($eventdata['participants']); $i++) {
		    $participants[$i] = new Google_Service_Calendar_EventAttendee();
		    $participants[$i]->setEmail($eventdata['participants'][$i]);
		}
		if (!empty($participants)) {
		    $event->setAttendees($participants);
		}
	    }
	    if (isset($eventdata['start_datetime'])) {

		$gstart_datetime = new Google_Service_Calendar_EventDateTime();
		$gstart_datetime->setTimeZone($this->getTimeZone());
		$gstart_datetime->setDateTime($this->googleDateTime($eventdata['start_datetime']));
		$event->setStart($gstart_datetime);
		if (isset($eventdata['repeat'])) {
		    $day = date('w', strtotime($eventdata['start_datetime']));
		    $rrule = "RRULE:FREQ=WEEKLY;BYDAY=" . $weekdays[$day];
		    $event->setRecurrence(array($rrule));
		}
	    }
	    if (isset($eventdata['end_datetime'])) {
		$gend_datetime = new Google_Service_Calendar_EventDateTime();
		$gend_datetime->setTimeZone($this->getTimeZone());
		$gend_datetime->setDateTime($this->googleDateTime($eventdata['end_datetime']));
		$event->setEnd($gend_datetime);
	    }
	    if ($exists) {
		$appointment = $service->events->update($this->calendarID, $event->getId(), $event);
		$return = $appointment->getUpdated();
	    } else {
		$appointment = $service->events->insert($this->calendarID, $event);
		$return = $appointment->getId();
	    }
	    return $return;
	} catch (Exception $e) {
	    
	    if ($showerror): echo $e->getMessage();
	    endif;
	    return 0;
	}
    }

    //
    public function getEvent($id, $showerror = 0) {
	$this->client->setAccessToken($this->getAuthToken());
	$service = new Google_Service_Calendar($this->client);
	try {
	    $event = $service->events->get($this->calendarID, $id);
	    return $event;
	} catch (Exception $e) {
	    if ($showerror): echo $e->getMessage();
	    endif;
	    return 0;
	}
    }

    public function syncGDataDocter($termines) {
	$sync_status_table = 'sync_status_doctor';
	$this->dbi->where(array('status_google' => 0));
	$data = $this->dbi->get($sync_status_table)->result_array();
	$data = array_column($data, 'id');
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Invalid Request';
	$insurance = array(1 => 'insurance_private', 2 => 'insurance_public', '');
	foreach ($termines as $termine) {
	    if (!in_array($termine->id, $data)) {
		$eventdata = array(
		    'id' => $termine->id,
		    'title' => 'inserted termine#' . $termine->id,
		    'end_datetime' => date('Y-m-d H:i:s', strtotime($termine->end)),
		    'start_datetime' => date('Y-m-d H:i:s', strtotime($termine->start))
		);
		if ($termine->repetitive) {
		    $eventdata['repeat'] = $termine->repetitive;
		}
		if (!$termine->insurance_private && !$termine->insurance_public && !$termine->mask) {
		    $title_text = (!empty($termine->text_patient) ? $termine->text_patient : 'Own Occupancy');
		    $eventdata['title'] = date('g:i a', strtotime($termine->start)) . ' ' . $title_text;
		    $eventdata['color']='#e1e1e1';
		} elseif (!$termine->insurance_private && !$termine->insurance_public && $termine->mask) {
		    $title_text = 'Closing Times';
		    $eventdata['title'] = date('g:i a', strtotime($termine->start)) . ' ' . $title_text;
		    $eventdata['color']='#51b749';
		} elseif ($termine->insurance_private) {
		    $eventdata['title'] = 'For Pvt. Ver.';
		    $eventdata['color']='#fbd75b';
		} elseif ($termine->insurance_public) {
		    $eventdata['title'] = 'For Ges. / Pvt. Ver';
		    $eventdata['color']='#5484ed';
		}
		$synced = $this->syncEvent($eventdata, 1);
		if ($synced) {
		    $status = $this->dbi->get_where($sync_status_table, array('doctor_termins_id' => $termine->id))->row();
		    if (!empty($status->id)) {
			$status->status_google = 1;
			$this->dbi->where('id', $status->id);
			$this->dbi->update($sync_status_table, $status);
		    } else {
			$this->dbi->insert($sync_status_table, array('status_google' => 1, 'doctor_termins_id' => $termine->id));
		    }
		}
		$output['error'] = 0;
		$output['txt'] = 'Syncing Completed';
		$output['completed']=1;
		$this->Glogout();
	    } else {
		$output['error'] = 0;
		$output['txt'] = 'No Event to Sync';
		$output['completed']=1;
		$this->Glogout();
	    }
	    break;
	}
	return $output;
	}
     public function Glogout(){
	 $token=  $this->getAuthToken();
		$this->client->revokeToken($token);
		$this->unsetAuthToken();
     }
    public function eventColors(){
	    $colorlist=array();
	    try{
		$service=  new Google_Service_Calendar($this->client);
		$colors = $service->colors->get();
		foreach ($colors->getEvent() as $key => $color) {
		    $colorlist[$color->getBackground()]=$key;
		}
		return $colorlist;
	    }  catch (Exception $e){
		return false;
	    }
    }
    public function getColor($color=''){
	$colors=  $this->eventColors();
	if(isset($colors[$color])){
	    return $colors[$color];
	}else{
	    return 0;
	}
    }
    public function clearSynCalendar() {
	$sync_status_table = 'sync_status_doctor';
	$this->dbi->empty_table($sync_status_table);
	return;
	$this->client->setAccessToken($this->getAuthToken());
	
	try {
	    $service = new Google_Service_Calendar($this->client);
	    $events = $service->events->listEvents($this->calendarID);
	    while (true) {
		foreach ($events as $event) {
		    $this->deleteEvent($event->getId());
		}
		$pageToken = $events->getNextPageToken();
		if ($pageToken) {
		    $optParams = array('pageToken' => $pageToken);
		    $events = $service->events->listEvents($this->calendarID, $optParams);
		} else {
		    break;
		}
	    }
	} catch (Exception $e) {
	    if ($showerror): echo $e->getMessage();
	    endif;
	    return false;
	}
	
	
	
    }

    ///
    public function getAllEvents($showerror = 0) {
	$this->client->setAccessToken($this->getAuthToken());
	$eventslist = array();
	try {
	    $service = new Google_Service_Calendar($this->client);
	    $events = $service->events->listEvents($this->calendarID);
	    while (true) {
		foreach ($events->getItems() as $event) {
		    $eventslist[] = $event;
		}
		$pageToken = $events->getNextPageToken();
		if ($pageToken) {
		    $optParams = array('pageToken' => $pageToken);
		    $events = $service->events->listEvents($this->calendarID, $optParams);
		} else {
		    break;
		}
	    }
	    return $eventslist;
	} catch (Exception $e) {
	    if ($showerror): echo $e->getMessage();
	    endif;
	    return false;
	}
    }

    //
    public function getTimezone() {
	return $this->timezone;
    }

    public function setTimezone($timezone) {
	$this->timezone = $timezone;
    }

    //
    private function googleDateTime($datetimestr = '', $gmtoffset = '') {
	$datetime = @strtotime($datetimestr);
	$outputformat = date('Y-m-d H:i:s', $datetime);
	$outputformat = str_replace(' ', 'T', $outputformat);
	return $outputformat;
    }

    function getAuthToken() {
	$authToken = $this->session->userdata($this->auth_token_key);
	if ($authToken && !empty($authToken)) {
	    return $authToken;
	} else {
	    return 0;
	}
    }

    private function setAuthToken($auth_token = '') {
	if (!empty($auth_token)) {
	    $this->session->set_userdata($this->auth_token_key, $auth_token);
	}
    }

    private function unsetAuthToken($auth_token = '') {
	$this->session->unset_userdata($this->auth_token_key);
    }

}

/* End of file welcome.php */
