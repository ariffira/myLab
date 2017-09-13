<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

DEFINE('QB_API_ENDPOINT', "https://api.quickblox.com");
DEFINE('QB_PATH_SESSION', "session.json");
class Chat extends MX_Controller {



  /**
   *
   */


  public function index(){

    $this->load->model('videochat/mvideochat');
    $application_id = 20710;
    $auth_key = 'z9STk7LvBE9PJu-';
    $auth_secret = 'eTJOZ5Acn9zs9Nb';
    $token = null;
    $user_id = null;
    $login = null;

    $nonce = rand();
    $timestamp = time(); // time() method must return current timestamp in UTC but seems like hi is return timestamp in current time zone

    if($login=$this->mvideochat->get_login()){
      $signature_string = "application_id=".$application_id."&auth_key=".$auth_key."&nonce=".$nonce."&timestamp=".$timestamp."&user[login]=".$this->mvideochat->get_login()."&user[password]="."cyomedvideo";
     
     //echo "stringForSignature: " . $signature_string . "<br><br>";
      $signature = hash_hmac('sha1', $signature_string , $auth_secret);

      $post_body = http_build_query(array(
                         'application_id' => $application_id,
                         'auth_key' => $auth_key,
                         'timestamp' => $timestamp,
                         'nonce' => $nonce,
                         'signature' => $signature,
                         'user[login]' => $this->mvideochat->get_login(),
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
        $this->mvideochat->update($user_id,$update_params);

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
        $this->mvideochat->insert($insert_params);
           
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


           
          } else {
                  $error = curl_error($curl1). '(' .curl_errno($curl1). ')';
                  echo $error . "\n";
          }
          // Close connection
          curl_close($curl1);


    }
    $this->chatinit(array('token'=>$token,'user_id'=>$user_id,'login'=>$login));     
  }


  /**
   *
   */


  public function chatinit($session_array=array())
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->load->model('videochat/mvideochat');

    $doctorlist = $this->mvideochat->get_doctors();
    $patientlist = $this->mvideochat->get_patients();
    
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';
    /*** for adding header***/
    // if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    // {
     
    // }
    // else
    // {
    //   $this->config->load('ia24ui', TRUE, TRUE);
    //   $this->ui->html
    //             ->base_init()
    //             ->load_config('html');
    //  $this->ui->html
    //                 ->set_active_url('akte/chat');
    // }
    /***end here***/
    $output = $this->m->role_diff(
      function() use ($_ci,$session_array,$doctorlist,$patientlist){
        //if (!$_ci->m->us_id())
        //{
          //$this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          //return;
        //}
        // $output = $_ci->load->view('chat/videochat',array(),TRUE);

        $output = $_ci->load->view('chat/chatinit_view', array(
          'v_users' => $_ci->modoc->get_patients(),
          'my_users' => $_ci->mvideochat->get_patients(),
          'token' => $session_array['token'],
          'user_id' => $session_array['user_id'],
          'login' => $session_array['login'],
          'doctorlist' => $doctorlist,
          'patientlist' =>$patientlist,
        ), TRUE);
        return $output;
      },
      function() use ($_ci,$session_array,$doctorlist,$patientlist){
        $output = $_ci->load->view('chat/chatinit_view', array(
          'v_users' => $_ci->mopat->get_doctors(),
          'my_users' => $_ci->mvideochat->get_doctors(),
          'token' => $session_array['token'],
          'user_id' => $session_array['user_id'],
          'login' => $session_array['login'],
          'doctorlist' => $doctorlist,
          'patientlist' =>$patientlist,
        ), TRUE);
        // $output = $_ci->load->view('chat/videochat',array(),TRUE);
        return $output;
      }
    );

    /**displaying for output***/
    // if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    // {
    //   $this->output->set_output($output);  
    // }
    // else
    // {
    //  $this->output->set_output($this->ui->html->output());
    // }
    /****end here***/
    $this->output->set_output($output);  

  }


    /**
   *
   */
  public function callsend()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->load->model('videochat/mvideochat');
    

    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    $this->m->role_diff(
      function() use ($_ci){
        //if (!$_ci->m->us_id())
        //{
          //$this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          //return;
        //}

        $this->ui->mc->content->content = $_ci->load->view('chat/chatfinal_view', array(
          'v_users' => $_ci->modoc->get_patients(),
          'my_users' => $_ci->mvideochat->get_patients(),
          'token' => $_ci->input->post('token'),
          'user_id' => $_ci->input->post('user_id'),
          'login' => $_ci->input->post('login'),    
          'callee_id' => $_ci->input->post('callee_id'),
          'callee_name' => $_ci->input->post('callee_name'),
          'callee_regid' => $_ci->input->post('callee_regid'),
          'callee_lastlogin' => $_ci->input->post('callee_lastlogin'),

        ), TRUE);
      },
      function() use ($_ci){
        $this->ui->mc->content->content = $_ci->load->view('chat/chatfinal_view', array(
          'v_users' => $_ci->mopat->get_doctors(),
          'my_users' => $_ci->mvideochat->get_doctors(),
          'token' => $_ci->input->post('token'),
          'user_id' => $_ci->input->post('user_id'),
          'login' => $_ci->input->post('login'),    
          'callee_id' => $_ci->input->post('callee_id'),
          'callee_name' => $_ci->input->post('callee_name'),
          'callee_regid' => $_ci->input->post('callee_regid'),
          'callee_lastlogin' => $_ci->input->post('callee_lastlogin'),
        ), TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());

    
  }


//user Log out
  public function logout(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->load->model('videochat/mvideochat');
    $_ci->mvideochat->logout();
    redirect('akte');
  }


//get the recently changed data list
  public function get_recent_list(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->load->model('videochat/mvideochat');

    $this->m->role_diff(
      function() use ($_ci){
        echo json_encode($_ci->mvideochat->get_recent_patients());
      },
      function() use ($_ci){
        echo json_encode($_ci->mvideochat->get_recent_doctors());
      }
    );
  }

  public function insert_care_chatservice(){

    $this->load->model('videochat/mvideochat');
    
    $insert_params = array(
    'patient_id'    => $this->m->user_value('id'),
    'patient_regid'   => $this->m->user_value('regid'),
    'patient_name'    => $this->m->user_value('name'),
    'patient_surname'   => $this->m->user_value('surname'),
    'patient_address'   => $this->m->user_value('address').','.$this->m->user_value('zip').','.$this->m->user_value('city'),
    'patient_phone'   => $this->m->user_value('telephone'),
    'help_apply_time'   => date('Y-m-d H:i:s'),
    );
    
    print_r($insert_params);
    $this->mvideochat->insert_chatService($insert_params);
   
  
  }


}

/* End of file videochat.php */
/* Location: ./application/modules/akte/controllers/videochat.php */