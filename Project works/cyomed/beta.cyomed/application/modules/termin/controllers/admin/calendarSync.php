<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CalendarSync extends CI_Controller {
    private $client_outlook=NULL;
    private $client_google=NULL;
    private $http=NULL;
    private $user;
    private $user_role = NULL;
    private $user_id = NULL;
    private $active_sync_api_key='__active_sync_api';
    private $doctor_sync_table = 'sync_status_doctor';
    private $dbi=NULL;
    public function __construct() {
	parent::__construct();
	$this->mod->admin_check();
	$this->dbi = $this->load->database('development', TRUE);
	$this->load->library('session');
	$this->load->helper('curl');
	$this->load->helper('outlookapi');
	$this->load->helper('googleapi');
	$this->load->model('sync_model');
	$this->user = $this->mod->user();
	$this->user_id = $this->encrypt->decode($this->session->userdata('user_id'));
	$this->user_role = $this->encrypt->decode($this->session->userdata('user_role'));
	$this->http=new Curl();
	//
	$this->client_google=new Googleapi();
	$this->client_google->setAPIKey(GOOGLE_API_KEY);
	$this->client_google->setClient_id(GOOGLE_CLIENT_ID);
	$this->client_google->setClient_secret(GOOGLE_CLIENT_SECRET);
	$this->client_google->setRedirect_uri(GOOGLE_REDIRECT_URI);
	//
	$this->client_outlook=new Outlookapi();
	$this->client_outlook->setClient_id(OUTLOOK_CLIENT_ID);
	$this->client_outlook->setClient_secret(OUTLOOK_CLIENT_SECRET);
	$this->client_outlook->setRedirect_uri(OUTLOOK_REDIRECT_URI);
    }
    public function index() {
	$client=  $this->client_google;
	$output=array();
	$action=  $this->input->post('action');
	$api=  $this->input->post('api');
	if($api!='google' || $api!='outlook'){
	    if($api=='outlook'){ $client=  $this->client_outlook;    }
	    //
	    $this->checkClientRejected();
	    if($action=='startSync' && $client->getAuthData()){
		$this->beginSync($api);
	    }else{
		$this->initAction($api);
	    }
	}else{
	    $output['error']=1;
	    $output['txt']='Invalid API Requested';
	}
	$this->outputJson($output);

	
    }
    private function outputJson($data) {
	header('Content-Type: application/json');
	echo json_encode($data);
	die();
    }
    private function debug($data=''){
	echo "<pre>";
	print_r($data);
	echo "</pre>";die();
    }
    private function initAction($api){
	$client= $this->client_google;
	if($api=='outlook'){
	    $client= $this->client_outlook;
	}
	$authdata=$client->getAuthData();
	$code=$this->input->get('code');
	if($authdata){
	    $output['error']=0;
	    $output['process']='initNotify';
	    $output['txt']=ucfirst($api).' Calendar Syncing Running';
	    $output['id']='#syncBtn'.  ucfirst($api);
	    $this->outputJson($output);
	}elseif($code){
		//since not an ajax we need to identify request on the basic
	    
	    if($this->input->get('state')=='google'){
		$client=  $this->client_google;
	    }else{
		$client=  $this->client_outlook;
	    }
	    $output=$client->Authorize($code);
	    if($output['error']){
		$client->unsetAuthData();
		$data['showError']=$output['error'];
		$this->__loadView($data);
	    }else{
		$client->setAuthData($output['txt']);
		if($api=='outlook'){
		    $client->refreshToken();
		}
		$data['closewindow']=1;
		$this->__loadView($data);
	    }
	}else{
	    $client->unsetAuthData();
	    $output['error']=0;
	    $output['process']='redirect';
	    $output['txt']=$client->getAuthUrl();
	    $this->outputJson($output);
	}
    }
    //
    private function beginSync($api){
	$output=array();
	$client= $this->client_google;
	if($api=='outlook'){
	    $client= $this->client_outlook;
	}
	$this->pushEvents($api);
	/*
	 * call api to sync events
	 * 
	 * 
	 */
	
	$output['error']=0;
	$output['process']='complete';
	$output['txt']=ucfirst($api).' Calendar Syncing Completed';
	$output['btntext']='Sync With '.ucfirst($api);
	$output['id']='#syncBtn'.  ucfirst($api);
	$this->outputJson($output);	
    }
    //
    private function checkClientRejected(){
	/*
	 * check if client rejected
	 */
	$error=  $this->input->get('error');
	$error_description=  $this->input->get('error_description');
	if($error_description){
	    $error=$error_description;
	}
	if($error){
	    $data['showError']=$error;
	    $this->__loadView($data);
	}
	/*
	 * 
	 */
    }
    //
    private function __loadView($data=array()){
	$this->load->view('admin/calendar_sync_view',$data);
	die();
    }
    
    
    private function pushEvents($mode=''){
	switch ($mode){
	    case 'outlook':
		$events=$this->sync_model->getDoctorTerminEventsOutlook($this->user_id);
		foreach ($events as $event){
		   $where=array('status_outlook'=>1,'doctor_termins_id'=>$event['id']);
		   $sync_row=  $this->dbi->get_where($this->doctor_sync_table,$where)->row();
		   if(empty($sync_row->id))
		   {
		       $output=$this->client_outlook->createEvent($event);
		       if(!$output['error']){
			   $inserted_event=$output['txt']->id;
			   $insertdata=array(
				'doctor_termins_id'=>$event['id'],
				'outlook_event_id'=>$inserted_event,
				'status_outlook'=>1,
				'google_event_id'=>'',
				'status_google'=>0
			   );
			$this->db->insert($this->doctor_sync_table,$insertdata);
		   }
		   }
		}
	    break;
	    case 'google':
		$events=$this->sync_model->getDoctorTerminEventsGoogle($this->user_id);
		foreach ($events as $event){
		   $where=array('status_google'=>1,'doctor_termins_id'=>$event['id']);
		   $sync_row=  $this->dbi->get_where($this->doctor_sync_table,$where)->row();
		   if(empty($sync_row->id))
		   {
		       $output=   $this->client_google->createEvent($event);
		       if(!$output['error']){
			   $inserted_event=$output['txt']->id;
			   $insertdata=array(
				'doctor_termins_id'=>$event['id'],
				'outlook_event_id'=>'',
				'status_outlook'=>0,
				'google_event_id'=>$inserted_event,
				'status_google'=>1
			   );
			$this->db->insert($this->doctor_sync_table,$insertdata);
		   }
		   }
		}
	    break;
	}
    }
    
    
    
}
