<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    $this->page();
  }

  /**
   *
   */
  public function page($post = FALSE)
  {
    if ($post)
    {
      if ($this->form_validation->run('login'))
      {
        if ($this->m->login($this->input->post('email'), $this->input->post('password')))
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

          redirect('akte');
          return;
        }
        else
        {
          if ($this->m->last_error() == M::ERROR_EMAIL)
          {
            $alert = "Email existiert nicht";
          }
          elseif ($this->m->last_error() == M::ERROR_PASSWORD)
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

    if (($u = $this->m->user()) && $this->m->user_role() == 'doctor' && (!isset($alert) || $alert))
    {
      redirect('portal/both/login/page');
    }

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : FALSE,
      'd' => $this->input->get('d') !== FALSE ? TRUE : TRUE,
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

    if (isset($alert) && $alert) $page_data['alert'] = $alert;

    $this->ui->html
      ->base_init()
      ->load_config('404')
      ->body->content->title->content = 'CYOMED LOGIN';

    $this->ui->html
      ->body->content->content = $this->load->view('both/login_view', $page_data, TRUE);

    $this->output->set_output(
      $this->ui->html->output()
    );

  }

}

/* End of file login.php */
/* Location: ./application/controllers/doctor/login.php */