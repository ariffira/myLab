<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clinic extends CI_Controller {

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
    if (!$this->mod->user()->module_activated)
    {
      redirect('admin/profile');
      exit();
    }    

    if ($this->input->post())
    {
      if ($this->form_validation->run('admin/clinic/index'))
      {
        // $this->modoc->update_profile();
        $this->mod->login_check();
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    $page_data = array();
    isset($alert) && $alert ? ($page_data['alert'] = $alert) : FALSE;

    $page_content = $this->load->view('admin/clinic_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_clinic' => TRUE,
    );

    $this->load->view('struct_admin_view', $output_data);
  }
}

/* End of file clinic.php */
/* Location: ./application/controllers/admin/clinic.php */