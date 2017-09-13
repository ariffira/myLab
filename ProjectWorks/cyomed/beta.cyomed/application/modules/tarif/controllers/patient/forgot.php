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

    $page_content = $this->load->view('patient/login_forget_view', '', TRUE);

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
  public function pass_reset_validation()
  {
    $this->load->model('mod');
    $this->load->model('mopat');
    $this->load->model('moemail');

    $email = $this->input->post('email');

    $this->mod->port->p->db_select();
    $result = $this->mod->port->p->get_where('patients', array ('email' => $email, 'confirm_status' => 1,),1);
    
    if ($result->num_rows() > 0){

      if ($this->mopat->pass_reset_validation($email)) {
        // Display success message
        echo '<script>alert("A Password Reset Link has been sent to your Email ");</script>';
        $user_result = $this->mopat->get_data($email);

        //Pass reset mail send
        $subject= "Cyomed:Ihre Passwortanfrage zur Nutzung des Cyomed Service-Centers";
        $msg = $this->load->view('patient/email/patient_password_reset_email_view', $user_result, true);
        $this->moemail->send_email($email,$subject,$msg);
        redirect('both/login/page', 'refresh');
      }  
    } 

    else {  
      echo '<script>alert("Email existiert nicht");</script>';
      redirect('both/register/page', 'refresh');
    }
  }

  /**
   *
   */
  public function change_password()
  {
    $email=$this->input->get('email');
    $email_code=$this->input->get('code');

    if ($this->mopat->patient_validate_email($email,$email_code)) {
      $data = array('email' => $email);
      $page_content = $this->load->view('patient/update_password_view', $data, TRUE);
    }

    else{
      $page_content = $this->load->view('both/failure_view', '', TRUE);
    }
    

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
  public function new_password()
  {

    //$query = $this->mopat->set_new_password();//here password updated or new password sets

    if($this->mopat->set_new_password()){
      echo '<script>alert("Passwort Successfully changed. Please Login!!!");</script>';
      redirect('both/login/page', 'refresh');
    }

    else { 
      echo '<script>alert("Sorry could not process!!!Something went wrong!! Please try again");</script>';
      redirect('both/login/page', 'refresh');    
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
    $page_content = $this->load->view('patient/resend_confirmation_code_view', '', TRUE);


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

    $this->mod->port->p->db_select();
    $result = $this->mod->port->p->get_where('patients', array ('email' => $email, ),1);
    
    if ($result->num_rows() > 0){

      if ($this->mopat->email_reset_validation($email)) {
        // Display success message
        echo '<script>alert("An account activation link has been sent to your Email ");</script>';
        $user_result = $this->mopat->get_data($email);

        //Email reset mail send
        $subject= "Willkommen bei Cyomed";
        $msg1 = $this->load->view('patient/email/patient_first_confirmation_email_view', $user_result, true);
        $this->moemail->send_email($email,$subject,$msg1);
        redirect('both/login/page', 'refresh');
      }  
    } 

    else {  
      echo '<script>alert("Email existiert nicht");</script>';
      redirect('both/register/page', 'refresh');
    }
  }

  
}

