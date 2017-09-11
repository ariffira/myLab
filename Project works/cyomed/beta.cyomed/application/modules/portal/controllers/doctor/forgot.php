<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends CI_Controller {

  /**
   *
   */
 

  public function index()
  {
    
  }

  /**
   *
   */
  public function pass_reset()
  {
    //lang load...
    $this->load->language('reg', $this->m->lang);
    $this->load->language('forgot_pass', $this->m->lang);

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : FALSE,
      'd' => $this->input->get('d') !== FALSE ? TRUE : FALSE,
    );

    $get_redirect = $this->input->get('r');
    $check_redirect = $this->input->get('c');
    if ($get_redirect && $check_redirect)
    {
      $this->load->library('encrypt');
      if ($get_redirect == $this->encrypt->decode($check_redirect))
      {
        $page_data['r'] = $get_redirect;
        $page_data['c'] = $this->encrypt->encode($get_redirect);
      }
    }

    $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'register')
      ->page_title('');

    $this->ui->html
      ->content($this->load->view('doctor/login_forget_view', $page_data, TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );


    // $page_content = $this->load->view('doctor/login_forget_view', '', TRUE);

    // $this->ui->html
    //   ->base_init()
    //   ->load_config('404')
    //   ->body->content->title->content = 'CYOMED SECURITY';

    // $this->ui->html
    //   ->body->content->content = $page_content;

    // $this->output->set_output(
    //   $this->ui->html->output()
    // );
  }


  /**
   *
   */
  public function pass_reset_validation()
  {
    //lang load...
    $this->load->language('forgot_pass', $this->m->lang);

    $this->load->model('m');
    $this->load->model('modoc');
    $this->load->model('moemail');

    $email = $this->input->post('email');

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('doctors', array ('email' => $email, 'confirm_status' => 1,),1);
    
    if ($result->num_rows() > 0){

      if ($this->modoc->pass_reset_validation($email)) {
        // Display success message
        //echo '<script>alert("' . $this->lang->line("email_send_alert_msg") . '");</script>';
        $user_result = $this->modoc->get_data($email);

        //Pass reset mail send
        $subject= $this->lang->line("pass_reset_email_sub");
        $msg = $this->load->view('doctor/email/doctor_password_reset_email_view', $user_result, true);
        echo $msg;die;
        $this->moemail->send_email($email,$subject,$msg);
        
        echo "1||".$this->lang->line("email_send_alert_msg");exit;
        //redirect('portal/both/login/page', 'refresh');
      }  
    } 

    else {  
      /*echo '<script>alert("'. $this->lang->line("email_exist_alert_msg") . '");</script>';
      redirect('portal/both/register/page', 'refresh');*/
	  echo "0||".$this->lang->line("email_exist_alert_msg");exit;
    }
  }

    /**
   *
   */
  public function change_password()
  {
    
    //lang load...
    $this->load->language('forgot_pass', $this->m->lang);

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : FALSE,
      'd' => $this->input->get('d') !== FALSE ? TRUE : FALSE,
    );

    $get_redirect = $this->input->get('r');
    $check_redirect = $this->input->get('c');
    if ($get_redirect && $check_redirect)
    {
      $this->load->library('encrypt');
      if ($get_redirect == $this->encrypt->decode($check_redirect))
      {
        $page_data['r'] = $get_redirect;
        $page_data['c'] = $this->encrypt->encode($get_redirect);
      }
    }

    $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'register')
      ->page_title('');



    $email=$this->input->get('email');
    $email_code=$this->input->get('code');

    if ($this->modoc->doctor_validate_email($email,$email_code)) {
      $data = array('email' => $email);
      // $page_content = $this->load->view('doctor/update_password_view', $data, TRUE);
      $this->ui->html
      ->content($this->load->view('doctor/update_password_view', array($page_data, $data), TRUE));

    }

    else{
      // $page_content = $this->load->view('both/failure_view', '', TRUE);
      
      $this->ui->html
      ->content($this->load->view('both/failure_view', '', TRUE));

    }
  

    // $this->ui->html
    //   ->base_init()
    //   ->load_config('404')
    //   ->body->content->title->content = 'CYOMED SECURITY';

    // $this->ui->html
    //   ->body->content->content = $page_content;

    $this->output->set_output(
      $this->ui->html->output()
    );
  }

  /**
   *
   */
  public function new_password()
  {
    
    //lang load...
    $this->load->language('forgot_pass', $this->m->lang);

    if($this->modoc->set_new_password('temp_pass')){
      echo '<script>alert("' . $this->lang->line("pass_change_confirm_alert"). '");</script>';
      redirect('portal/both/login/page', 'refresh');
    }

    else { 
      echo '<script>alert("Sorry could not process!!!Something went wrong!! Please try again");</script>';
      redirect('portal/both/login/page', 'refresh');    
    }

    $this->ui->html
      ->base_init()
      ->load_config('404')
      ->body->content->title->content = 'CYOMED SECURITY';

    $this->ui->html
      ->body->content->content = $msg;

    $this->output->set_output(
      $this->ui->html->output()
    );
  }


  /**
   *
   */

  public function email_reset()
  {
    $page_content = $this->load->view('doctor/resend_confirmation_code_view', '', TRUE);

    $this->ui->html
      ->base_init()
      ->load_config('404')
      ->body->content->title->content = 'CYOMED SECURITY';

    $this->ui->html
      ->body->content->content = $page_content;

    $this->output->set_output(
      $this->ui->html->output()
    );
  }
  /**
   *
   */
  public function email_reset_validation()
  {
    $email = $this->input->post('email');
    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('doctors', array ('email' => $email, ),1);
    
    if ($result->num_rows() > 0){

      if ($this->modoc->email_reset_validation($email)) {
        // Display success message
        echo '<script>alert("An account activation link has been sent to your Email");</script>';
        $user_result = $this->modoc->get_data($email);

        //Email reset mail send
        $subject= "Willkommen bei Cyomed";
        $msg1 = $this->load->view('doctor/email/doctor_first_confirmation_email_view', $user_result, true);
        $this->moemail->send_email($email,$subject,$msg1);
        redirect('portal/both/login/page', 'refresh');
      }  
    } 

    else {  
      echo '<script>alert("Email existiert nicht");</script>';
      redirect('portal/both/register/page', 'refresh');
    }
  }
  /*** used for forcefully passwordchange****/
   public function forcepass_reset()
  {
    //lang load...
    $this->load->language('forgot_pass', $this->m->lang);
       $user_details=$this->session->userdata('force_change');
    $page_content = $this->load->view('doctor/changepassword_view',  array('password'=>$user_details['password'],'id'=>$user_details['id']), TRUE);
    $this->ui->html
      ->base_init()
      ->load_config('login')
      ->page_title('');
     
     $this->ui->html
      ->content($page_content);

    $this->output->set_output(
      $this->ui->html->output()
    );
  }
  
   public function forcechange_password()
  {
    if($this->mopat->force_new_password_doctor()){
      echo '<script>alert("Passwort Successfully changed. Please Login!!!");</script>';
      redirect('portal/both/login/page', 'refresh');
    }

    else {
      echo '<script>alert("Sorry could not process!!!Something went wrong!! Please try again");</script>';
      redirect('portal/both/login/page', 'refresh');    
    }

    $this->ui->html
      ->base_init()
      ->load_config('404')
      ->body->content->title->content = 'CYOMED SECURITY';

    $this->ui->html
      ->body->content->content = $msg;

    $this->output->set_output(
      $this->ui->html->output()
    );
  }
  /***end here****/
  
  /***used for security question***/
   public function security_access()
  {
    $data = $this->mopat->security_question();   
    $page_content = $this->load->view('doctor/security_access_view',array('data'=>$data), TRUE);
    $this->ui->html
      ->base_init()
      ->load_config('login')
      ->page_title('');
     
     $this->ui->html
      ->content($page_content);

    $this->output->set_output(
      $this->ui->html->output()
    );
  }
  public function security_response()
  {
    if($this->mopat->security_answer())
    {
      redirect('akte', 'refresh');
          $this->ui->html
      ->base_init()
      ->load_config('login')
      ->page_title('');
     
     $this->ui->html
      ->content($page_content);

    $this->output->set_output(
      $this->ui->html->output()
    );
    }
    else
    { 
    
    }
  /***end here***/
  
}
}
