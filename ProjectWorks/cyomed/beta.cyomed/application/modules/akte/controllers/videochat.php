<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videochat extends MX_Controller 
{

  /**
   *
   */
  public function index()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = '';
    $this->m->role_diff(
      function() use ($_ci){
        //if (!$_ci->m->us_id())
        //{
          //$this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          //return;
        //}
         $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_init_view', array(
          'v_users' => $_ci->modoc->get_patients(),
        ), TRUE);
      },
      function() use ($_ci){
        $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_init_view', array(
          'v_users' => $_ci->mopat->get_doctors(),
        ), TRUE);
      }
    );
    $this->output->set_output($this->ui->mc->output());
  }
  public function calltest()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    $this->m->role_diff(
      function() use ($_ci){
        //if (!$_ci->m->us_id())
        //{
          //$this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          //return;
        //}

        $this->ui->mc->content->content = $_ci->load->view('videochat/test_view', array(
          'v_users' => $_ci->modoc->get_patients(),
        ), TRUE);
      },
      function() use ($_ci){
        $this->ui->mc->content->content = $_ci->load->view('videochat/test_view', array(
          'v_users' => $_ci->mopat->get_doctors(),
        ), TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());


  }

  /**
   *
   */
  public function callsend()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $conference = $_ci->input->post('conferenceid');
    $confadd = random_string('alnum', 16);
    $confId  = $conference.$confadd; 

    $session = $_ci->input->post('sessionid');
    $sesadd = random_string('alnum', 16);
    $sesId  = $session.$sesadd; 


    $result = $this->m->role_diff(
      function() use ($_ci,$confId,$sesId ){
        $_ci->load->model('videochat/mvideochat');


        //$this->session->set_userdata('confId',$confId);

        $insert_data = array(
          'callfrom'                    => $_ci->m->user_value('regid'), 
          'callto'                      => $_ci->input->post('conferenceto'),
          'conferenceId'                => $confId, 
          'sessionId'                   => $sesId, 
          'call_status'                 => 1, 
          'calltime'                    => date('Y-m-d H:i:s'), 

        );

        $callid = $_ci->mvideochat->insert($insert_data);
        $this->session->set_userdata('callid',$callid);
      },

      function() use ($_ci,$confId,$sesId){
        $_ci->load->model('videochat/mvideochat');


        $insert_data = array(
          'callfrom'                    => $_ci->m->user_value('regid'),  
          'callto'                      => $_ci->input->post('conferenceto'),
          'conferenceId'                => $confId, 
          'sessionId'                   => $sesId, 
          'call_status'                 => 1, 
          'calltime'                    => date('Y-m-d H:i:s'), 

        );

        $callid = $_ci->mvideochat->insert($insert_data);
        $this->session->set_userdata('callid',$callid);
      }
    );

     
    //$this->session->set_userdata('confId',$confId);

    //$this->callinit($confId);
    ajax_redirect('akte/videochat/callinit');
    
  }

  /**
   *
   */

  public function callinit()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //$this->config->load('ia24ui', TRUE, TRUE);
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = '';

    $id = $this->session->userdata('callid');

    
    $this->m->role_diff(
      function() use ($_ci,$id){
        
        $this->load->model('videochat/mvideochat');  
        //$id = $this->session->userdata('callid');
  
        $call['callid'] = $id ;
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->modoc->get_patients();

        //print_r($call);
        
        $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_view', $call , TRUE);
      },
      function() use ($_ci,$id){

        $this->load->model('videochat/mvideochat');  
        //$id = $this->session->userdata('callid'); 
        //$call['conferenceId'] = $this->session->userdata('confId');
        //$call['callid'] = $this->session->userdata('callid');
        //$call['v_users'] = $_ci->mopat->get_doctors();
        $call['callid'] = $id ;
        //$call['conference'] =  $_ci->mvideochat->get_info($id);
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->mopat->get_doctors();

        //print_r($call);

       $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_view', $call , TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());

   

  }

 /**
   *
   */


  public function callview()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //$this->config->load('ia24ui', TRUE, TRUE);
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = '';

    $id = $this->session->userdata('callid');

    
    $this->m->role_diff(
      function() use ($_ci,$id){
        
        $this->load->model('videochat/mvideochat');  
  
        $call['callid'] = $id ;
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->modoc->get_patients();

        //print_r($call);
        
        $this->ui->mc->content->content = $_ci->load->view('videochat/video_view', $call , TRUE);
      },
      function() use ($_ci,$id){

        $this->load->model('videochat/mvideochat');  
        $call['callid'] = $id ;
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->mopat->get_doctors();

        //print_r($call);

       $this->ui->mc->content->content = $_ci->load->view('videochat/video_view', $call , TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());

  

    

  }


  /**
   *
   */
  public function callreceive($id)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $result = $this->m->role_diff(
      function() use ($_ci,$id){
        //if (empty($id)) return FALSE;


        $this->session->set_userdata('callid',$id);
        $this->load->model('videochat/mvideochat'); 


        $update_data = array(
          'call_status'                 => 2, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $id,), $update_data );
      },

      function() use ($_ci,$id){

        $this->session->set_userdata('callid',$id);
        $this->load->model('videochat/mvideochat'); 

        $update_data = array(
          'call_status'                 => 2, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $id,), $update_data );
      }
    );

    ajax_redirect('akte/videochat/callinit');
    
  }

   /**
   *
   */

  public function callend()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();


    $result = $this->m->role_diff(
      function() use ($_ci){
        //if (empty($id)) return FALSE;

        $_ci->load->model('videochat/mvideochat'); 
        $callid = $_ci->input->post('callid');

        //$_ci->load->model('videochat/mvideochat');

        $update_data = array(
          'call_status'                 => 0, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $callid,), $update_data );
      },

      function() use ($_ci){
        //if (empty($id)) return FALSE;

        $_ci->load->model('videochat/mvideochat'); 
        $callid = $_ci->input->post('callid');

        $update_data = array(
          'call_status'                 => 0, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $callid,), $update_data );
      }
    );


    ajax_redirect('akte/overview');
  }

 /**
   *
   */

  public function callreject($id)
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $this->load->library('user_agent');


    $result = $this->m->role_diff(
      function() use ($_ci,$id){
        //if (empty($id)) return FALSE;

        $_ci->load->model('videochat/mvideochat'); 

        $update_data = array(
          'call_status'                 => 0, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $id,), $update_data );
      },

      function() use ($_ci,$id){

        $_ci->load->model('videochat/mvideochat'); 

        $update_data = array(
          'call_status'                 => 0, 
        );

        return $_ci->mvideochat->update( array( 'id'  => $id,), $update_data );
      }
    );


   //$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
    //$url = empty($url) ? base_url() : $url;

    //ajax_redirect($this->agent->referrer());
    //echo $this->agent->referrer();
    //exit();

      //ajax_redirect($url);
    return $result;
  }

   /**
   *
   */


  public function callcheck()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $this->config->load('ia24ui', TRUE, TRUE);
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = '';

    $id = $this->session->userdata('callid');

    
    $this->m->role_diff(
      function() use ($_ci,$id){
        
        $this->load->model('videochat/mvideochat');  
        //$id = $this->session->userdata('callid');
  
        $call['callid'] = $id ;
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->modoc->get_patients();

        print_r($call);
        
        $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_view', $call , TRUE);
      },
      function() use ($_ci,$id){

        $this->load->model('videochat/mvideochat');  
        //$id = $this->session->userdata('callid'); 
        //$call['conferenceId'] = $this->session->userdata('confId');
        //$call['callid'] = $this->session->userdata('callid');
        //$call['v_users'] = $_ci->mopat->get_doctors();
        $call['callid'] = $id ;
        //$call['conference'] =  $_ci->mvideochat->get_info($id);
        $call['conferenceId'] =  $_ci->mvideochat->get_confId($id);
        $call['sessionId'] = $_ci->mvideochat->get_sessionId($id);
        $call['v_users'] = $_ci->mopat->get_doctors();

        print_r($call);

       $this->ui->mc->content->content = $_ci->load->view('videochat/videochat_view', $call , TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());

    ajax_redirect('akte/videochat');

  }


  


  

  
  

}

/* End of file videochat.php */
/* Location: ./application/modules/akte/controllers/videochat.php */