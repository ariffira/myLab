<?php

class Googleapi{

    private $google_auth_endpoint = 'https://accounts.google.com/o/oauth2/auth';
    private $google_revoke_token_endpoint = 'https://accounts.google.com/o/oauth2/revoke';
    private $google_token_url = "https://www.googleapis.com/oauth2/v3/token";
    private $google_auth_key = 'google_auth_key';
    private $google_api_endpoint = 'https://www.googleapis.com/';
    private $google_colors_endpoint = "https://www.googleapis.com/calendar/v3/colors";
    private $client_id = NULL;
    private $client_secret = NULL;
    private $api_key = NULL;
    private $redirect_uri = NULL;
    private $scopes = array('https://www.googleapis.com/auth/calendar');
    private $ci = NULL;
    private $http = NULL;
    private $access_token = NULL;
    private $refresh_token = NULL;

    /*
     * @method: constructor
     */

    public function __construct() {
	$this->ci = & get_instance();
	$this->ci->load->helper('curl');
	$this->ci->load->library('session');
	$this->http = new Curl();
	$authdata = $this->getAuthData();
	if ($authdata) {
	    $this->setAccessToken($authdata);
	    $this->setRefreshToken($authdata);
	} else {
	    $this->setAccessToken(NULL);
	    $this->setRefreshToken(NULL);
	}
    }

    /*
     * @method: get auth url
     */

    public function getAuthUrl() {
	$params = array(
	    'client_id' => $this->client_id,
	    'response_type' => 'code',
	    'access_type' => 'online',
	    'scope' => rtrim(implode(' ', $this->scopes)),
	    'redirect_uri' => $this->redirect_uri,
	    'state'=>'google'
	);
	return $this->google_auth_endpoint . '?' . http_build_query($params);
    }

    /*
     * @method: authorize code
     */

    public function Authorize($code = '') {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Unknown Error';
	$params = array(
	    'grant_type' => 'authorization_code',
	    'client_id' => $this->client_id,
	    'code' => $code,
	    'client_secret' => $this->client_secret,
	    'redirect_uri' => $this->redirect_uri,
	);
	$response = $this->http->post($this->google_token_url, $params);
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	    $this->setAuthData($response);
	}
	return $output;
    }

    public function refreshToken() {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Unknown Error';
	if (empty($this->getRefreshToken())) {
	    $output['error'] = 0;
	    $output['txt'] = 'Working In Online Mode';
	    return $output;
	}
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Unknown Error';
	if (@$this->getRefreshToken()) {
	    $params = array(
		'grant_type' => 'refresh_token',
		'client_id' => $this->client_id,
		'refresh_token' => $this->refresh_token,
		'redirect_uri' => $this->redirect_uri,
		'client_secret' => $this->client_secret
	    );
	    $response = $this->http->post($this->google_token_url, $params);
	    $isError = $this->isErrorObject($response);
	    if ($isError) {
		$output['error'] = 1;
		$output['txt'] = $isError;
	    } else {
		$output['error'] = 0;
		$output['txt'] = $response;
		$this->setAuthData($response);
	    }
	} else {
	    $output['error'] = 1;
	    $output['txt'] = 'Invalid Refresh Token Provided';
	}
	return $output;
    }

    /*
     * @method :revoke token
     */

    public function revokeToken() {
	$output = array();
	$url = $this->google_revoke_token_endpoint;
	$response = $this->http->get($url, array('token' => $this->access_token,'key'=>  $this->getAPIKey()));
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 1;
	    $output['txt'] = $response;
	}
	$this->unsetAuthData();
	return $response;
    }

    //// getters & Setters////
    public function getAccessToken() {
	$authdata = $this->getAuthData();
	if ($authdata) {
	    $this->setAccessToken($authdata);
	}
	return $this->access_token;
    }

    public function setAccessToken($access_token = '') {
	$this->access_token = $access_token;
	if (is_object($access_token)) {
	    $this->access_token = @$access_token->access_token;
	}
    }

    public function getRefreshToken() {
	$authdata = $this->getAuthData();
	if ($authdata) {
	    $this->setRefreshToken($authdata);
	}
	return $this->refresh_token;
    }

    public function setRefreshToken($refresh_token = '') {
	$this->refresh_token = $refresh_token;
	if (is_object($refresh_token)) {
	    $this->refresh_token = @$refresh_token->refresh_token;
	}
    }

    public function getAPIKey() {
	return $this->api_key;
    }

    public function setAPIKey($api_key) {
	$this->api_key = $api_key;
    }

    public function getClient_id() {
	return $this->client_id;
    }

    public function setClient_id($client_id) {
	$this->client_id = $client_id;
    }

    public function getClient_secret() {
	return $this->client_secret;
    }

    public function setClient_secret($client_secret) {
	$this->client_secret = $client_secret;
    }

    public function getRedirect_uri() {
	return $this->redirect_uri;
    }

    public function setRedirect_uri($redirect_uri) {
	$this->redirect_uri = $redirect_uri;
    }

    public function getScopes() {
	return $this->scopes;
    }

    public function setScopes($scopes) {
	foreach ($scopes as $scope) {
	    $this->scopes[] = $scopes;
	}
    }

    /*
     * @method: get primary calendar
     */

    public function getPrimaryCalendar() {
	$output = array();
	$output['error'] = 0;
	$output['txt'] = 'primary';
	return $output;
    }

    /*
     * @method: get all events for current month
     */
    public function getEvents($limit = 500) {
	$info = $this->getPrimaryCalendar();
	if ($info['error']) {
	    return $info;
	} else {
	    $id = $info['txt'];
	    $url = $this->google_api_endpoint . 'calendar/v3/calendars/' . $id . '/events';
	    $response = $this->http->get($url, array('access_token' => $this->getAccessToken(), 'maxResults' => $limit));
	    $isError = $this->isErrorObject($response);
	    if ($isError) {
		$info['error'] = 1;
		$info['txt'] = $isError;
	    } else {
		if (!empty($response->items)) {
		    $info['error'] = 0;
		    $info['txt'] = $response->items;
		} else {
		    $info['error'] = 1;
		    $info['txt'] = 'No Events Found';
		}
	    }
	}
	return $info;
    }

    /*
     * @method : get event
     */

    public function getEvent($event_id = 0) {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'No Events Found';
	$info = $this->getPrimaryCalendar();
	if ($info['error']) {
	    return $info;
	}
	if ($event_id) {
	    $calid = $info['txt'];
	    $url = $this->google_api_endpoint . '/calendar/v3/calendars/' . $calid . '/events/' . $event_id;
	    $response = $this->http->get($url, array('access_token' => $this->access_token,'key'=>  $this->getAPIKey()));
	    $isError = $this->isErrorObject($response);
	    if ($isError) {
		$output['error'] = 1;
		$output['txt'] = $isError;
	    } else {
		$output['error'] = 0;
		$output['txt'] = $response;
	    }
	}
	return $output;
    }

    /*
     * @method: create event
     * 
    * array(
	'id'=>md5(time().microtime()),
	'summary'=>'test summery',
	"end_datetime" =>"2012-06-01T10:40:00.000-07:00",
	"start_datetime" => "2012-06-01T10:00:00.000-07:00",  
	"name" => "my_summary",
	"description" => "my_description",
	"repeat"=>1,
	"participants"=>array("email1@s.com","email1@s.com"),
	'all_day'=>1,
	'color'=>'#7ae7bf'
     );
     * 
     * 
     */

    public function createEvent($eventdata) {
	sleep(1);
	$output = array();
	$weekdays = array('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');
	$params = array('summary'=>'NA');
	$params['id']=sha1(time().microtime().uniqid());
	if (isset($eventdata['color'])) {
	    $colorID = $this->getColor($eventdata['color']);
	    if ($colorID) {
		$params['colorId'] = $colorID;
	    }
	}
	if (isset($eventdata['name'])) {
	    $params['summary'] = $eventdata['name'];
	}
	if (isset($eventdata['description'])) {
	    $params['description'] = $eventdata['description'];
	}
	if (is_array(@$eventdata['participants'])) {
	    $participants = array();
	    foreach ($eventdata['participants'] as $participant) {
		$participants[]['email'] = $participant;
	    }
	    if (!empty($participants)) {
		$params['attendees'] = $participants;
	    }
	}
	if (isset($eventdata['start_datetime'])) {
	    $start_time_string = $eventdata['start_datetime'];
	    $start_time = array();
	    if (@$eventdata['all_day']) {
		$start_time['date'] = date('Y-m-d', strtotime($start_time_string));
	    }else{
		$start_time['dateTime'] = $this->formatDateTime($start_time_string);	   
	    }
		$start_time['timeZone'] = date_default_timezone_get();
	    if (isset($eventdata['repeat'])) {
		$day = date('w', strtotime($eventdata['start_datetime']));
		$rrule = "RRULE:FREQ=WEEKLY;BYDAY=" . $weekdays[$day];
		$params['recurrence'] = array($rrule);
	    }
	    $params['start'] = $start_time;
	}
	if (isset($eventdata['end_datetime'])) {
	    $end_time_string = $eventdata['end_datetime'];
	    $end_time = array();
	    if(@$eventdata['all_day']){
		$end_time['date'] = date('Y-m-d', strtotime($start_time_string));
	    }else{
		$end_time['dateTime'] = $this->formatDateTime($end_time_string);
	    }
	    $end_time['timeZone'] = date_default_timezone_get();
	    $params['end'] = $end_time;
	}
	//
	$output = $this->getPrimaryCalendar();
	if ($output['error']) {
	    return $output;
	}
	$calid = $output['txt'];
	$url = $this->google_api_endpoint . 'calendar/v3/calendars/' . $calid . '/events?access_token='.$this->getAccessToken().'&key='.$this->getAPIKey();
	$this->http->setHeader("content-type", "application/json");
	$response = $this->http->post($url, json_encode($params));
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	}
	$this->http->unsetHeader("content-type");
	return $output;
    }

    /*
     * @method update event
     * 
     */

    public function updateEvent($id = 0, $eventdata) {
	$output = array();
	$output = $this->getEvent($id);
	if ($output['error']) {
	    return $output;
	}

	$weekdays = array('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');
	$params = array('visibility' => 'public');
	if (isset($eventdata['color'])) {
	    $colorID = $this->getColor($eventdata['color']);
	    if ($colorID) {
		$params['colorId'] = $colorID;
	    }
	}
	if (isset($eventdata['name'])) {
	    $params['summary'] = $eventdata['name'];
	}
	if (isset($eventdata['description'])) {
	    $params['description'] = $eventdata['description'];
	}
	if (isset($eventdata['participants']) && is_array(@$eventdata['participants'])) {
	    $participants = array();
	    foreach ($eventdata['participants'] as $participant) {
		$participants[]['email'] = $participant;
	    }
	    if (!empty($participants)) {
		$params['attendees'] = $participants;
	    }
	}
	if (isset($eventdata['start_datetime'])) {
	    $start_time_string = $eventdata['start_datetime'];
	    $start_time = array();
	    if (@$eventdata['all_day']) {
		$start_time['date'] = date('Y-m-d', strtotime($start_time_string));
	    }else{
		$start_time['dateTime'] = $this->formatDateTime($start_time_string);	   
	    }
		$start_time['timeZone'] = date_default_timezone_get();
	    if (isset($eventdata['repeat'])) {
		$day = date('w', strtotime($eventdata['start_datetime']));
		$rrule = "RRULE:FREQ=WEEKLY;BYDAY=" . $weekdays[$day];
		$params['recurrence'] = array($rrule);
	    }
	    $params['start'] = $start_time;
	}
	if (isset($eventdata['end_datetime'])) {
	    $end_time_string = $eventdata['end_datetime'];
	    $end_time = array();
	    if(@$eventdata['all_day']){
		$end_time['date'] = date('Y-m-d', strtotime($start_time_string));
	    }else{
		$end_time['dateTime'] = $this->formatDateTime($end_time_string);
	    }
	    $end_time['timeZone'] = date_default_timezone_get();
	    $params['end'] = $end_time;
	}
	//
	$output = $this->getPrimaryCalendar();
	if ($output['error']) {
	    return $output;
	}
	$calid = $output['txt'];
	$url = $this->google_api_endpoint . 'calendar/v3/calendars/' . $calid . '/events/'.$id.'?access_token='.$this->getAccessToken().'&key='.$this->getAPIKey();
	$this->http->setHeader("content-type", "application/json");
	$response = $this->http->put($url, json_encode($params));
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	}
	$this->http->unsetHeader("content-type");
	return $output;
    }

    /*
     * @method: delete event
     */

    public function deleteEvent($event_id = 0) {
	$output = array();
	$info = $this->getPrimaryCalendar();
	if ($info['error']) {
	    return $info;
	}
	$calid = $info['txt'];
	$url = $this->google_api_endpoint . '/calendar/v3/calendars/' . $calid . '/events/' . $event_id;
	$response = $this->http->delete($url, array('access_token' => $this->access_token,'key'=>  $this->getAPIKey()));
	$isError = $this->isErrorObject($response);
	if(empty($response)){
	    $output['error']=0;
	    $output['txt']='#'.$event_id.' Deleted';
	}else{
	    $output['error']=1;
	    $output['txt']=$isError;
	}
	return $output;
    }

    /*
     * @method :get event colors
     */

    public function geteventColors() {
	$colorlist = array();
	$url = $this->google_colors_endpoint;
	$response=$this->http->get($url,array('access_token'=>  $this->getAccessToken(),'key'=>  $this->getAPIKey()));
	$isError=  $this->isErrorObject($response);
	if($isError){
	    return $colorlist;
	}else{
	    $colors = $response->event;
	   
	    foreach ($colors as $key => $color) {
		$colorlist[$color->background] = $key;
	    }
	}
	return $colorlist;
    }

    /*
     * @method get color code by ID;
     */

    public function getColor($color = '') {
	$colors = $this->geteventColors();
	if (isset($colors[$color])) {
	    return $colors[$color];
	} else {
	    return 0;
	}
    }

    /*
     * @method format time date for event
     */

    private function formatDateTime($datetimestr = '', $gmtoffset = '') {
	$datetime = @strtotime($datetimestr);
	$outputformat = date('Y-m-d H:i:s', $datetime);
	$outputformat = str_replace(' ', 'T', $outputformat) . $gmtoffset;
	return $outputformat;
    }

    /*
     * @method check api error object
     */

    private function isErrorObject($response) {
	if (!empty($response->error)) {
	    $msg = "CODE:".@$response->error->code." ## ";
	    $msg.="Reason:".@$response->error->errors[0]->reason." ## ";
	    $msg.="Message:".@$response->error->errors[0]->message;
	    if ($msg) {
		return $msg;
	    } else {
		return 0;
	    }
	} elseif (empty($response)) {
	    return "Empty Response";
	} else {
	    return 0;
	}
    }
    public function getAuthData() {
	return $this->ci->session->userdata($this->google_auth_key);
    }

    public function setAuthData($data) {
	$this->ci->session->set_userdata($this->google_auth_key, $data);
    }

    public function unsetAuthData() {
	$this->ci->session->unset_userdata($this->google_auth_key);
    }

}
