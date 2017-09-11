<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

DEFINE('QB_API_ENDPOINT', "https://api.quickblox.com");
DEFINE('QB_PATH_SESSION', "session.json");

class My_patients extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
  }

  /**
   *
   */
  public function index()
  {

    $this->load->model('videochat');
    $this->load->model('mspeciality');

    //$s = $this->input->get('s');
    //$n = $this->input->get('n');

    //$s = $s ? $s : 0;
    //$n = $n ? $n : 10;

    //$this->mod->port->p->db_select();
    //$this->mod->port->p->limit($n, $s);

    //$s_field = $this->input->get('search_field');
    //$s_value = $this->input->get('search_value');

    //if ($s_field && $s_value)
    //{
      //$this->mod->port->p->like($s_field, $s_value, 'both');
    //}

    //$admins = $this->moadmin->get_list();

    //$this->mod->port->p->db_select();
    //if ($s_field && $s_value)
    //{
      //$this->mod->port->p->like($s_field, $s_value, 'both'); 
    //}
    //$total_count = count($this->moadmin->get_list());

    //$patients = $this->videochat->get_patients_list();
    //$my_selected_patients = $this->videochat->get_my_selected_patients_list();
    $quickblox_params = array();
    $quickblox_params = $this->quickblox_init();
    $specialization = $this->mspeciality->get();

    $process_details = $this->videochat->get_my_patients_list();

    //$this->load->library('pagination');

    //$config['base_url'] = site_url('admin/admin').'?'.$this->input->server('QUERY_STRING').($this->input->server('QUERY_STRING') ? '&' : '');
    //$this->mod->port->p->db_select();
    //$config['total_rows'] = $total_count;
    //$config['per_page'] = 10; 
    //$config['page_query_string'] = TRUE;
    //$config['query_string_segment'] = 's';

    //$this->pagination->initialize($config); 

    //$pagination = $this->pagination->create_links();

    $page_data = array(
      //'admins' => $admins,
      //'patients' => $patients,
      //'my_selected_patients' => $my_selected_patients,
      'process_details' => $process_details,
      'quickblox' => $quickblox_params,
      'specialization' => $specialization,
      //'pagination' => $pagination,
    );

    $page_content = $this->load->view('my_patients_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function entry($id = NULL)
  {
    if ($id === NULL || !is_numeric($id))
    {
      redirect('admin/admin');
    }

    $this->mod->port->p->where('id', $id);
    $this->mod->port->p->limit(1);

    $admins = $this->moadmin->get_list();

    $page_data = array(
      'admins' => $admins,
    );

    $page_content = $this->load->view('admin_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_field($admin_id = NULL)
  {
    if ($admin_id === NULL || !is_numeric($admin_id))
    {
      return;
    }

    $field = $this->input->post('field');
    $value = $this->input->post('value');

    if (!$field || !is_string($field))
    {
      return;
    }

    if ($field == 'password')
    {
      $value = md5($value);
    }

    $fields = $this->mod->port->p->field_data('admin');

    foreach ($fields as $fd)
    {
       // echo $fd->name;
       // echo $fd->type;
       // echo $fd->max_length;
       // echo $fd->primary_key;
      if ($fd->name == $field && strtoupper($fd->type) == 'BLOB')
      {
        $value = $this->aes_encrypt->en($value);
      }
    }

    $this->mod->port->p->db_select();
    $this->mod->port->p->set($field, $value);
    $this->mod->port->p->where('id', $admin_id);
    $this->mod->port->p->limit(1);
    $this->mod->port->p->update('admin');
  }

  /**
   *
   */
  public function activate_module($admin_id = NULL)
  {
    if ($admin_id === NULL || !is_numeric($admin_id))
    {
      return;
    }

    $field = $this->input->post('field');
    $value = $this->input->post('value');

    if (!$field || !is_string($field))
    {
      return;
    }

    $this->mod->port->p->db_select();
    if ($value)
    {
      $query = $this->mod->port->p->get_where('admin_modules', array('module' => $field, 'admin_id' => $admin_id, ), 1);
      if ($query->num_rows() > 0)
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->where('module', $field);
        $this->mod->port->p->where('admin_id', $admin_id);
        $this->mod->port->p->limit(1);
        $this->mod->port->p->update('admin_modules');
      }
      else
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->set('module', $field);
        $this->mod->port->p->set('admin_id', $admin_id);
        $this->mod->port->p->insert('admin_modules');
      }
    }
    else
    {
      $this->mod->port->p->where('module', $field);
      $this->mod->port->p->where('admin_id', $admin_id);
      $this->mod->port->p->limit(1);
      $this->mod->port->p->delete('admin_modules');
    }

  }


  /*
  |try to insert care_doctor_id in care_chatservice table, first check if empty (==0)
  |if yes insert the current service person id and return 1 else return -1
  |$id is the id of the row that a service person has selected
  */

  public function insert_care_doctor_id(){
    $id = trim(strip_tags($_GET['id']));
    if (!$id)
    {
      echo 'No Matches Found';
      return;
    }
    $this->mod->port->p->select('care_doctor_id,patient_regid');
    $care_doctor_id = null;
    $patient_regid = null;
    $query = $this->mod->port->p->get_where('care_chatservice',array('id'=>$id));
    if($query->num_rows()>0){
      foreach ($query->result() as $row) {
          $care_doctor_id = $row->care_doctor_id;
          $patient_regid = $row->patient_regid;
        }
    }

    if($care_doctor_id == 0){
      $care_doctor=array(
        'care_doctor_id'      => $this->mod->user_id(),
        'care_doctor_regid'   => $this->mod->user_value('regid'),
        'care_doctor_name'    => $this->mod->user_value('name'),
        'care_doctor_surname' => $this->mod->user_value('surname'),
        );
      $this->mod->port->p->update('care_chatservice',$care_doctor,array('id'=>$id));
       echo json_encode(array('success'=>1));
    }else{
       echo json_encode(array('success'=>-1));
    }
  }


  /*
  */
  public function update_specialization(){
     $care_id=$this->input->post('careId');
     $specialization=$this->input->post('specialization');
     $this->mod->port->p->update('care_chatservice',array('specialization_id'=>$specialization,'help_status'=>2,'broadcast_init_time'=>date('Y-m-d H:i:s'),),array('id'=>$care_id));
     $this->index();
  }


  public function quickblox_init(){

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
                          'name' => $this->mod->user_value('name').' '.$this->mod->user_value('surname'),
                          'role'  => $this->mod->user_role(),
                          'regid' => $this->mod->user_value('regid'),
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

  public function get_details(){
    $help_status=array('0','In queue','Broadcasted','Doctor responded',);
    $id = trim(strip_tags($_GET['id']));
    if (!$id)
    {
      echo 'No Matches Found';
      return;
    }
    $query=$this->mod->port->p->get_where('care_chatservice',array('id'=>$id));
    $details=array();
    $temp=array();
    foreach ($query->result() as $row) {
      $temp['id'] = $row->id;
      $temp['patient_id'] = $row->patient_id;
      $temp['name'] = $row->patient_name.' '.$row->patient_surname;
      $temp['regid'] = $row->patient_regid;
      $temp['address'] = $row->patient_address;
      $temp['phone'] = $row->patient_phone;
      $temp['apply_time'] = $row->help_apply_time;
      $temp['care_doctor_id'] = $row->care_doctor_id;
      $temp['help_status'] = $help_status[$row->help_status];
      $temp['broadcast_time'] = $row->broadcast_init_time;
      $temp['doctor_id'] = $row->doctor_id;
      $temp['doctor_name'] = $row->doctor_name.' '.$row->doctor_surname;
      $temp['doctor_regid'] = $row->doctor_regid;
      $temp['doctor_address'] = $row->doctor_address;
      $temp['doctor_phone'] = $row->doctor_phone;
      $temp['doctor_callback_time'] = $row->doctor_call_patient_init_time;
      
      array_push($details, $temp);
    }
    echo json_encode($details);
  }


}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */