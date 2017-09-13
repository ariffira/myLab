<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends MX_Controller {

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
    $this->load->library('form_validation');
          
    if ($this->input->post('password_old') && $this->input->post('password') && $this->input->post('password2') && $this->form_validation->run('auth/change_password'))
    {
      if ($this->mod->update_password())
      {
        redirect('auth/dashboard');
        return;
      }
      else
      {
        if ($this->mod->last_error())
        {
          if ($this->mod->last_error() == Mod::ERROR_PASSWORD)
          {
            $error = 'Invalid password';
          }
        }
      }
    }
    else
    {
      $error = validation_errors();
    }

    $page_data = array(
      // 'data' => $data,
    );

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('change_password_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file change_password.php */
/* Location: ./application/controllers/modules/auth/change_password.php */