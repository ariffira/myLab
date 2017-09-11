<?php
class Sync_model extends CI_Model {
    private $patient_termin_table = 'reservations';
    private $doctor_termin_table = 'doctor_termins';
    private $doctor_sync_table = 'sync_status_doctor';
    private $dbi = null; //database instance

    public function __construct() {
	parent::__construct();
	$this->dbi = $this->load->database();
    }

    public function getDoctorTerminEventsGoogle($doctor_id = 0) {

	$events = array();
	//1. sync termins from docter termine table
	$termines = $this->dbi->get_where($this->doctor_termin_table, array('doctor_id' => $doctor_id))->result();
	if (empty($termines)) {
	    return $events;
	}
	foreach ($termines as $termine) {
	    $event = array();
	    $event['id'] = $termine->id;
	    $event['end_datetime'] = date('Y-m-d H:i:s', strtotime($termine->end));
	    $event['start_datetime'] = date('Y-m-d H:i:s', strtotime($termine->start));
	    if ($termine->repetitive) {
		$event['repeat'] = $termine->repetitive;
	    }
	    if ($termine->allday) {
		$event['all_day'] = $termine->allday;
	    }
	    if (!$termine->insurance_private && !$termine->insurance_public && !$termine->mask) {
		$title_text = (!empty($termine->text_patient) ? $termine->text_patient : 'Own Occupancy');
		$event['name'] = $title_text;
		$event['color'] = '#e1e1e1';
	    } elseif (!$termine->insurance_private && !$termine->insurance_public && $termine->mask) {
		$title_text = 'Closing Times';
		$event['name'] = $title_text;
		$event['color'] = '#51b749';
	    } elseif ($termine->insurance_private) {
		$event['name'] = 'For Pvt. Ver.';
		$event['color'] = '#fbd75b';
	    } elseif ($termine->insurance_public) {
		$event['name'] = 'For Ges. / Pvt. Ver';
		$event['color'] = '#5484ed';
	    } else {
		$event['name'] = 'NA#' . $termine->id;
	    }
	    $events[] = $event;
	}
	return $events;
    }

    public function getDoctorTerminEventsOutlook($doctor_id = 0) {

	$events = array();
	//1. sync termins from docter termine table
	$termines = $this->dbi->get_where($this->doctor_termin_table, array('doctor_id' => $doctor_id))->result();
	if (empty($termines)) {
	    return $events;
	}
	foreach ($termines as $termine) {
	    $event = array();
	    $event['id'] = $termine->id;
	    $event['end_time'] = date('Y-m-d H:i:s', strtotime($termine->end));
	    $event['start_time'] = date('Y-m-d H:i:s', strtotime($termine->start));
	    if ($termine->repetitive) {
		$event['repeat'] = $termine->repetitive;
	    }
	    if ($termine->allday) {
		$event['is_all_day'] = true;
	    }
	    if (!$termine->insurance_private && !$termine->insurance_public && !$termine->mask) {
		$title_text = (!empty($termine->text_patient) ? $termine->text_patient : 'Own Occupancy');
		$event['name'] = $title_text;
	    } elseif (!$termine->insurance_private && !$termine->insurance_public && $termine->mask) {
		$title_text = 'Closing Times';
		$event['name'] = $title_text;
	    } elseif ($termine->insurance_private) {
		$event['name'] = 'For Pvt. Ver.';
	    } elseif ($termine->insurance_public) {
		$event['name'] = 'For Ges. / Pvt. Ver';
	    } else {
		$event['name'] = 'NA#' . $termine->id;
	    }
	    $events[] = $event;
	    $events=array_merge($events, $this->outlookEventRepeater($event));
	}
	return $events;
    }

    private function outlookEventRepeater($event, $week_repeat = 4) {
	$events = array();
	if (@$event['repeat']) {
	    $event['repeated_event'] = 1;
	    for ($i = 1; $i <= $week_repeat; $i++) {
		$new_start = strtotime($event['start_time']);
		$new_start = strtotime("+1 week", $new_start); 
		$new_end = strtotime($event['end_time']);
		$new_end = strtotime("+1 week", $new_end); 
		$event['start_time'] = date("Y-m-d H:i:s",$new_start);
		$event['end_time'] =  date("Y-m-d H:i:s",$new_end);
		$events[] = $event;
	    }
	}
	
	return $events;
    }
    public function isEventSyncedDoctor($termin_id=0){
	$this->db->limit(1);
	$row=$this->dbi->get_where($this->doctor_sync_table,array(
	    'doctor_termins_id'=>$termin_id,
	))->row();
	if(!empty($row->id)){
	    return $row;
	}else{
	    return FALSE;
	}
    }
    public function updateSyncedStatus($termin_id=0,$remote_event_id=0,$mode='google'){
	if($termin_id && in_array($mode,array('google','outlook'))){
	    $syncedinfo=$this->isEventSyncedDoctor($termin_id);
	    if($syncedinfo){
		$syncdata_update=array(
		     $mode.'_event_id'=>$remote_event_id,
		    'status_'.$mode=>1
		);
		$this->dbi->where(array('id'=>$syncedinfo->id));
		$this->dbi->limit(1);
		$this->dbi->update($this->doctor_sync_table,array($syncdata_update));
	    }else{
		$syncdata_insert=array(
		    'doctor_termins_id'=>$termin_id,
		    'outlook_event_id'=>$remote_event_id,
		    'status_outlook'=>0,
		    'google_event_id'=>$remote_event_id,
		    'status_google'=>0
		);
		$this->dbi->insert($this->doctor_sync_table,$syncdata_insert);
	    }
	}else{
	    return FALSE;
	}
    }
}
