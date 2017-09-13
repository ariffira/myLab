<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_user extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
    if ($this->mod->user_role() == 9)
    {
      //$this->index();
    }
    else
    {
      redirect('auth/login');
    }
    $this->load->library('form_validation');
  }

  /**
   *
   */
  public function index()
  {
    
          
    if ($this->input->post('email') && $this->input->post('password') && $this->input->post('password2') && $this->form_validation->run('admin/create_user'))
    {
      if ($this->mod->register())
      {
        redirect('admin/admin');
        return;
      }
      else
      {
        if ($this->mod->last_error())
        {
          if ($this->mod->last_error() == Mod::ERROR_email)
          {
            $error = 'Email existiert schon';
          }
          if ($this->mod->last_error() == Mod::ERROR_DB_INSERT)
          {
            $error = 'Systemfehler';
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

    $page_content = $this->load->view('create_user_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */