<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {

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
        if ($this->mod->login($this->input->post('email'), $this->input->post('password'), FALSE))
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

    if (($u = $this->mod->user()) && $this->mod->user_role() == 'patient' && (!isset($alert) || $alert))
    {
      redirect(base_url().'../');
    }

    $page_data = array();

    $page_content = $this->load->view('portal/patient/login_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => 'two-cols-with-form doctor-login',
      'page_stylesheets' => array('assets/stylesheets/two-cols-with-form.min.css', ), 
      'page_content' => $page_content, 

      'active_patient' => TRUE, 
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
      if ($this->form_validation->run('patreg'))
      {
        if ($this->mod->patreg())
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

    $page_content = $this->load->view('portal/patient/registration_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => 'two-cols-with-form',
      'page_stylesheets' => array('assets/stylesheets/two-cols-with-form.min.css', ), 
      'page_content' => $page_content, 

      'active_patient' => TRUE, 
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
    redirect('portal/patient/login');
  }

}

/* End of file patient.php */
/* Location: ./application/controllers/portal/patient.php */