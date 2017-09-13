<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    redirect('patient/register/page');
  }

  /**
   *
   */
  public function page($post = FALSE)
  {
    if ($post)
    {
      if ($this->form_validation->run('patreg'))
      {
        if ($this->m->patreg())
        {
          $get_redirect = $this->input->get('r');
          $check_redirect = $this->input->get('c');
          if ($get_redirect && $check_redirect)
          {
            $this->load->library('encrypt');
            if ($get_redirect == $this->encrypt->decode($check_redirect))
            {
              redirect($get_redirect);
              return;
            }
          }
          redirect('patient/register/partial_success');
          return;
        }
        else
        {
          if ($this->m->last_error() == Mod::ERROR_EMAIL)
          {
            $alert = "Email existiert schon";
          }
          elseif ($this->m->last_error() == Mod::ERROR_DB_INSERT)
          {
            $alert = "Systemfehler";
          }
        }
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    $page_data = array();

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

    if (isset($alert) && $alert) $page_data['alert'] = $alert;

    $page_content = $this->load->view('patient/register_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_patient' => TRUE,
    );

    if (isset($alert) && $alert) $output_data['alert'] = $alert;

    $this->load->view('struct_clean_view', $output_data);
  }


  public function patient_validation() {

    $this->load->model('mod');
    $this->load->model('mopat');
    $this->load->model('moemail');

    $email=$this->input->get('email');
    $email_code=$this->input->get('code');

    $validated = $this->mopat->patient_validate_email($email,$email_code);

    if ($validated === TRUE)    {
      
      //$page_content = $this->load->view('both/success_view', '', TRUE);
      $user_result = $this->mopat->get_data($email);
      $status="patient";

      //2nd mail send
      $subject= "Willkommen bei Cyomed";
      $msg2 = $this->load->view('patient/email/patient_second_confirmation_email_view', $user_result, true);
      $this->moemail->send_email($email,$subject,$msg2);


      //third mail send
      $subject= "Willkommen bei Cyomed";
      $msg3 = $this->load->view('patient/email/patient_third_confirmation_email_view', $user_result, true);
      $this->moemail->send_email($email,$subject,$msg3,$status);

      redirect('patient/register/success');

    }

    else {
 
      $page_content = $this->load->view('both/failure_view', '', TRUE);
      $output_data = array(
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 
      );

      $this->load->view('struct_clean_view', $output_data);
    } 
  }


  public function success() {

   $page_content = $this->load->view('both/success_view', '', TRUE);
   $output_data = array(
    'page_stylesheets' => array(), 
    'page_content' => $page_content, 
    );

   $this->load->view('struct_clean_view', $output_data);

  }

  public function partial_success() {

   $page_content = $this->load->view('both/partial_success_view', '', TRUE);
   $output_data = array(
    'page_stylesheets' => array(), 
    'page_content' => $page_content, 
    );

   $this->load->view('struct_clean_view', $output_data);

  }

}

/* End of file register.php */
/* Location: ./application/controllers/patient/register.php */