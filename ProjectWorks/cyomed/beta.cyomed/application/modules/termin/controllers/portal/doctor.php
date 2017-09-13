<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {

  /**
   *
   */
  public function index()
  {

  }

  /**
   *
   */
  public function login($post = FALSE)
  {
    if ($post)
    {
      if ($this->form_validation->run('login'))
      {
        if ($this->mod->login($this->input->post('email'), $this->input->post('password')))
        {
          redirect(base_url().'../');
          return;
        }
        else
        {
          if ($this->mod->last_error() == Mod::ERROR_EMAIL)
          {
            $alert = "Email existiert nicht";
          }
          elseif ($this->mod->last_error() == Mod::ERROR_PASSWORD)
          {
            $alert = "Falsch Passwort";
          }
        }
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    if (($u = $this->mod->user()) && $this->mod->user_role() == 'doctor' && (!isset($alert) || $alert))
    {
      redirect(base_url().'../');
    }

    $page_data = array();

    $page_content = $this->load->view('portal/doctor/login_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => 'two-cols-with-form doctor-login doctor-registration',
      'page_stylesheets' => array('assets/stylesheets/two-cols-with-form.min.css', ), 
      'page_content' => $page_content, 

      'active_doctor' => TRUE,
    );

    if (isset($alert) && $alert) $output_data['alert'] = $alert;

    $this->load->view('global_view', $output_data);
  }

  /**
   *
   */
  public function register($post = FALSE)
  {
    if ($post)
    {
      if ($this->form_validation->run('docreg'))
      {
        if ($this->mod->docreg())
        {
          redirect('portal/doctor/login');
          return;
        }
        else
        {
          if ($this->mod->last_error() == Mod::ERROR_EMAIL)
          {
            $alert = "Email existiert schon";
          }
          elseif ($this->mod->last_error() == Mod::ERROR_DB_INSERT)
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

    $page_content = $this->load->view('portal/doctor/registration_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => 'two-cols-with-form doctor-registration',
      'page_stylesheets' => array('assets/stylesheets/two-cols-with-form.min.css', ), 
      'page_content' => $page_content, 

      'active_doctor' => TRUE,
    );

    if (isset($alert) && $alert) $output_data['alert'] = $alert;

    $this->load->view('global_view', $output_data);
  }

  /**
   *
   */
  public function logout()
  {
    $this->mod->logout();
    redirect('portal/doctor/login');
  }

}

/* End of file doctor.php */
/* Location: ./application/controllers/portal/doctor.php */