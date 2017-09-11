<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->admin_check();
  }

  /**
   *
   */
  public function index()
  {

    if ($this->input->post())
    {
      if ($this->form_validation->run('admin/security/index'))
      {

        if ($this->mod->update_password())
        {
          $this->mod->login_check();
        }
        else
        {
          if ($this->mod->last_error() == Mod::ERROR_PASSWORD)
          {
            $alert = "Aktuelles Passwort falsch";
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
    isset($alert) && $alert ? ($page_data['alert'] = $alert) : FALSE;

    $page_content = $this->load->view('admin/security_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_security' => TRUE,
    );

    $this->load->view('struct_admin_view', $output_data);
  }
}

/* End of file security.php */
/* Location: ./application/controllers/admin/security.php */