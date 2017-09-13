<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    redirect('doctor/register/page');
  }

  /**
   *
   */
  public function page($post = FALSE)
  {
   
    $this->load->language('reg', $this->m->lang);
    $this->load->language('forgot_pass', $this->m->lang);

    if ($post)
    {
      if ($this->form_validation->run('docreg'))
      {
        if ($this->m->docreg())
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

          redirect('portal/doctor/register/partial_success');
          return;
        }
        else
        {
          if ($this->m->last_error() == M::ERROR_EMAIL)
          {
            $alert = "Email existiert schon";
          }
          elseif ($this->m->last_error() == M::ERROR_DB_INSERT)
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

    $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'register')
      ->page_title('');
	
    $page_data['p'] = FALSE;
    $page_data['d'] = TRUE;
    
    $this->ui->html
      ->content($this->load->view('both/register_view', $page_data, TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );
  }

  

  public function doctor_validation() {

    $this->load->language('reg', $this->m->lang);
    $this->load->language('forgot_pass', $this->m->lang);

    $this->load->model('m');
    $this->load->model('modoc');
    $this->load->model('moemail');

    $email=$this->input->get('email');
    $email_code=$this->input->get('code');

    $validated = $this->modoc->doctor_validate_email($email,$email_code);

    if ($validated === TRUE)    {
      
      $user_result = $this->modoc->get_data($email);
      $status="doctor";

      //2nd mail send
      $subject= $this->lang->line('reg_lang_2nd_email_sub');
      $msg2 = $this->load->view('doctor/email/doctor_second_confirmation_email_view', $user_result, true);
      $this->moemail->send_email($email,$subject,$msg2);


      //third mail send
      $subject= $this->lang->line('reg_lang_2nd_email_sub');
      $msg3 = $this->load->view('doctor/email/doctor_third_confirmation_email_view', $user_result, true);
      $this->moemail->send_email($email,$subject,$msg3,$status);

      redirect('portal/doctor/register/success');

    }

    else {
 
      $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'register')
      ->page_title('');

    $this->ui->html
      ->content($this->load->view('both/failure_view', '',  TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );
    
    } 
  }


  public function success() {

    $this->load->language('reg', $this->m->lang);
    $this->load->language('forgot_pass', $this->m->lang);

   $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'login')
      ->page_title('');

    $this->ui->html
      ->content($this->load->view('both/success_view', array('regtype'=>'d'), TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );



  }


  public function partial_success() {

   $this->load->language('reg', $this->m->lang);
   $this->load->language('forgot_pass', $this->m->lang);

   $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'login')
      ->page_title('');

    $this->ui->html
      ->content($this->load->view('both/partial_success_view', array('regtype'=>'d'),  TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );

  }

}

/* End of file register.php */
/* Location: ./application/controllers/doctor/register.php */