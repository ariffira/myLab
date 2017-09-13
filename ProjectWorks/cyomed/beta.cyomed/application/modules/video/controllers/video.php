<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

DEFINE('QB_API_ENDPOINT', "https://api.quickblox.com");
DEFINE('QB_PATH_SESSION', "session.json");

class Video extends MX_Controller {

  /**
   *
   */
  public function __construct()
  {
    $this->m->login_check_redirect();
  }

  public function index(){

    $quickblox_login=$this->get_quickblox_login();

    
    if($this->m->user_role() == M::ROLE_PATIENT){
      $this->patient_load_video($quickblox_login);     
    }else if($this->m->user_role() == M::ROLE_DOCTOR){
      $this->doctor_load_video($quickblox_login);     
    }
  }

  public function get_quickblox_login(){
    $this->load->model('videochat');
    $application_id = 20710;
    $auth_key = 'z9STk7LvBE9PJu-';
    $auth_secret = 'eTJOZ5Acn9zs9Nb';
    $token = null;
    $user_id = null;
    $login = null;

    $nonce = rand();
    $timestamp = time(); // time() method must return current timestamp in UTC but seems like hi is return timestamp in current time zone

    if($login=$this->videochat->get_login()){
      $signature_string = "application_id=".$application_id."&auth_key=".$auth_key."&nonce=".$nonce."&timestamp=".$timestamp."&user[login]=".$this->videochat->get_login()."&user[password]="."cyomedvideo";
     
     //echo "stringForSignature: " . $signature_string . "<br><br>";
      $signature = hash_hmac('sha1', $signature_string , $auth_secret);

      $post_body = http_build_query(array(
                         'application_id' => $application_id,
                         'auth_key' => $auth_key,
                         'timestamp' => $timestamp,
                         'nonce' => $nonce,
                         'signature' => $signature,
                         'user[login]' => $this->videochat->get_login(),
                         'user[password]' => 'cyomedvideo',
                         ));
         
         // Configure cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION); // Full path is - https://api.quickblox.com/session.json
        curl_setopt($curl, CURLOPT_POST, true); // Use POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
         
         // Execute request and read response
        $response = curl_exec($curl);
        
         // Check errors
        if ($response) {
                 //echo $response . "\n";
         
        } else {
                $error = curl_error($curl). '(' .curl_errno($curl). ')';
                echo $error . "\n";
        }
        $response = json_decode($response);
        $token = $response->session->token;
        $user_id = $response->session->user_id;
         
        // Close connection
        curl_close($curl);

        $update_params = array(
                          'status'  => 1,
                          'lastlogin' => date('Y-m-d H:i:s'),
                          
                          );
        $this->videochat->update($user_id,$update_params);

    }


    else{  //if the user is using the quickblox for first time then create a user in quickblox application
        $signature_string = "application_id=".$application_id."&auth_key=".$auth_key."&nonce=".$nonce."&timestamp=".$timestamp;
       
        $signature = hash_hmac('sha1', $signature_string , $auth_secret);
        
        $post_body = http_build_query(array(
                    'application_id' => $application_id,
                    'auth_key' => $auth_key,
                    'timestamp' => $timestamp,
                    'nonce' => $nonce,
                    'signature' => $signature,
                    ));
         
         // Configure cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION); // Full path is - https://api.quickblox.com/session.json
        curl_setopt($curl, CURLOPT_POST, true); // Use POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
         
         // Execute request and read response
        $response = curl_exec($curl);
        
         
         // Check errors
        if ($response) {
                 //echo $response . "\n";
         
        } else {
                 $error = curl_error($curl). '(' .curl_errno($curl). ')';
                 echo $error . "\n";
        }

        $response = json_decode($response);
        $token = $response->session->token;
         
        // Close connection
        curl_close($curl);

        $login = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
        $ch = curl_init();
                $userdata = http_build_query(array(
                    'token' => $token,
                    'user' => array(
                             'login' => $login,
                             'password' => 'cyomedvideo',
                             ),
                     ));
        
        curl_setopt($ch, CURLOPT_URL, QB_API_ENDPOINT . '/users.json' ); // Full path is - https://api.quickblox.com/users.json
        curl_setopt($ch, CURLOPT_POST, true); // Use POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $userdata); // Setup user body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Receive server response
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        
        if($result){
          //echo $result . "\n";
        }else {
          $error = curl_error($ch). '(' .curl_errno($ch). ')';
          echo $error . "\n";
         }

        $result = json_decode($result);
        curl_close($ch);

        $insert_params = array(
                          'id'    => $result->user->id,
                          'name' => $this->m->user_value('name').' '.$this->m->user_value('surname'),
                          'role'  => $this->m->user_role(),
                          'regid' => $this->m->user_value('regid'),
                          'login' => $result->user->login,
                          );
        $this->videochat->insert($insert_params);
           
        $user_id= $result->user->id;
           // Signing in the new user
          $curl1 = curl_init();
          $userdata = http_build_query(array(
                    'token' => $token,
                    'login' => $login,
                    'password' => 'cyomedvideo',
                             
                     ));
          curl_setopt($curl1, CURLOPT_URL, QB_API_ENDPOINT . '/login.json'); // Full path is - https://api.quickblox.com/session.json
          curl_setopt($curl1, CURLOPT_POST, true); // Use POST
          curl_setopt($curl1, CURLOPT_POSTFIELDS, $userdata); // Setup post body
          curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true); // Receive server response
          curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);
           
           // Execute request and read response
          $response = curl_exec($curl1);
          
           // Check errors
          if ($response) {
                   //echo $response . "\n";
           
          } else {
                  $error = curl_error($curl1). '(' .curl_errno($curl1). ')';
                  echo $error . "\n";
          }
          // Close connection
          curl_close($curl1);
    }
    return array('token'=>$token,'user_id'=>$user_id,'login'=>$login);
  }

  public function patient_load_video($session_array=array()){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->view('patient_video_view', array(
          'token' => $session_array['token'],
          'user_id' => $session_array['user_id'],
          'login' => $session_array['login'],
        )); 

  }

  public function doctor_load_video($session_array=array()){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $this->load->model('videochat');
    $patients = $this->videochat->get_patients_list_for_doctor();

    $_ci->load->view('doctor_video_view', array(
          'token' => $session_array['token'],
          'user_id' => $session_array['user_id'],
          'login' => $session_array['login'],
          'patients' => $patients,
        ));

  }

  
  /**
   * insert the video call request from the patient in chatservice table
   * @return [type] [description]
   */
	public function insert_care_chatservice(){
    $this->load->model('videochat');
    $insert_params = array(
    'patient_id' 		=> $this->m->user_value('id'),
    'patient_regid' 	=> $this->m->user_value('regid'),
    'patient_name' 		=> $this->m->user_value('name'),
    'patient_surname' 	=> $this->m->user_value('surname'),
    'patient_address' 	=> $this->m->user_value('address').','.$this->m->user_value('zip').','.$this->m->user_value('city'),
    'patient_phone' 	=> $this->m->user_value('telephone'),
    'help_apply_time' 	=> date('Y-m-d H:i:s'),
    'help_status'      => 1,
    );
	  
    $care_id = $this->videochat->insert_chatService($insert_params);
    echo $care_id;
    
	}

    
  //user Log out
  public function logout(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->load->model('videochat');
    return $_ci->videochat->logout();
  }

  public function doctor_query_for_notification(){
    $date=date('Y-m-d H:i:s',strtotime("-30 minutes"));
    $this->m->port->p->select('c.id, c.patient_regid, c.patient_name,c.patient_surname, d.id as doctor_id, c.broadcast_init_time');
    $this->m->port->p->from('doctors as d');
    $this->m->port->p->join('care_chatservice as c','d.specialization1=c.specialization_id or d.specialization2=c.specialization_id');
    $this->m->port->p->where('d.id',$this->m->user_value('id'));
    $this->m->port->p->where('c.specialization_id !=',0);
    $this->m->port->p->where('c.doctor_id',0);
    $this->m->port->p->where('c.help_apply_time >',$date);
    $query=$this->m->port->p->get();
    //echo $this->m->port->p->last_query();
    $patients=array();
    $temp= array();
    if($query->num_rows()>0){
      foreach ($query->result() as $row) {
        $temp['id']=$row->id;
        $temp['patient_regid']=$row->patient_regid;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['broadcast_time'] = $row->broadcast_init_time;
        array_push($patients, $temp);
      }
      echo json_encode($patients);
    }else{
      return false;
    }
  }

  /*
  |try to insert doctor_id in care_chatservice table, first check if empty (==0)
  |if yes insert the current doctor id and return 1 else return -1
  |$id is the id of the patient the doctor choose to make a call
  */

  public function insert_doctor_id(){
    $id = trim(strip_tags($_GET['id']));
    if (!$id)
    {
      echo 'No Matches Found';
      return;
    }
    $this->m->port->p->select('patient_regid, doctor_id');
    $doctor_id = null;
    $patient_regid=null;
    $quickblox_id=null;
    $pat_name=null;
    $query = $this->m->port->p->get_where('care_chatservice',array('id'=>$id));
    if($query->num_rows()>0){
      foreach ($query->result() as $row) {
          $doctor_id = $row->doctor_id;
          $patient_regid = $row->patient_regid;
        }
    }

    if($doctor_id == 0){
      $doctor=array(
        'doctor_id'      => $this->m->user_id(),
        'doctor_regid'   => $this->m->user_value('regid'),
        'doctor_name'    => $this->m->user_value('name'),
        'doctor_surname' => $this->m->user_value('surname'),
        'doctor_call_patient_init_time' => date('Y-m-d H:i:s'),
        );
      $this->m->port->p->update('care_chatservice',$doctor,array('id'=>$id));
      $this->m->port->p->select('id,name');
      $query1=$this->m->port->p->get_where('quickblox',array('regid'=>$patient_regid),1);
      if($query1->num_rows()>0){
        foreach ($query1->result() as $row) {
          $quickblox_id=$row->id;
          $pat_name=$row->name;
        }
      }
      echo json_encode(array(array('qb_id'=>$quickblox_id,'pat_name'=>$pat_name,'patient_regid'=>$patient_regid,)));
    }else{
       echo json_encode(array(array('qb_id'=>-1)));
    }
  }

  /**
   * this function returns the quickblox login data for the notification function used in script page
   * @return [type] [description]
   */
  public function get_quickblox_login_for_doctor_notification(){
    $quickblox_login=$this->get_quickblox_login();
    echo json_encode(array('qb'=>$quickblox_login));
  }

  /**
   * funciton returns the quickblox id of the service person for notification
   * @return [type] [description]
   */
  public function get_service_for_notification(){
    $date=date('Y-m-d H:i:s',strtotime("-30 minutes"));
    $this->m->port->p->select('q.id as id');
    $this->m->port->p->from('care_chatservice as c');
    $this->m->port->p->join('quickblox as q','c.care_doctor_regid = q.regid');
    $this->m->port->p->where('c.patient_id',$this->m->user_value('id'));
    $this->m->port->p->where('c.help_apply_time >',$date);
    $query_for_multiple_request=$this->m->port->p->get();
    if($query_for_multiple_request->num_rows()>0){
      echo json_encode($query_for_multiple_request->result());
    }else{
      $this->m->port->p->select('id');
      $query = $this->m->port->p->get_where('quickblox',array('role'=>'role_service'));
      if($query->num_rows()>0){
        echo json_encode($query->result());
      }
    }
    
  }

  /**
   * return the quickblox of doctors
   * @return [type] [description]
   */
  public function get_doctor_qb(){
    $this->m->port->p->select('id');
    $query = $this->m->port->p->get_where('quickblox',array('role'=>M::ROLE_DOCTOR));
    if($query->num_rows()>0){
      echo json_encode($query->result());
    }
  }


  public function update_help_status_doctor_end_process(){
    $care_id=$this->input->post('careId');
    $this->m->port->p->update('care_chatservice',array('help_status'=>3),array('id'=>careId));
  }

  /**
   * check the status of the current video process
   * its is used for ajax call from patient video page to show the user the status of the process
   * @return [type] [description]
   */
  public function check_status(){
    $care_id=$this->input->post('careId');
    $this->m->port->p->select('help_status, care_doctor_id,doctor_id');
    $this->m->port->p->where('id',$care_id);
    $query=$this->m->port->p->get('care_chatservice',1);
    $status=array();
    if($query->num_rows()>0){
      foreach ($query->result() as $row) {
        $status['help_status'] = $row->help_status;
        $status['care_doctor_id'] = $row->care_doctor_id;
        $status['doctor_id'] = $row->doctor_id;
      }
    }
    if($status['help_status']==1){
      echo json_encode(array('msg'=>"Please reopen the video Window, Cyomed Service will connect you there.",'status'=>1));
    }
    else if($status['help_status']==2&&$status['doctor_id']==0){
      echo json_encode(array('msg'=>"Please reopen the video Window, Cyomed doctor will connect you there.",'status'=>2));
    }
    else if($status['help_status']==3){
      echo json_encode(array('msg'=>"Thank you for using our Service",'status'=>3));
    }
  }

	
}



/* End of file video.php */
/* Location: ./application/modules/video/controllers/video.php */