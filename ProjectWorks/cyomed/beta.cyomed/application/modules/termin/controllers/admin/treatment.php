<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treatment extends CI_Controller {

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
      if ($this->form_validation->run('admin/treatment/index'))
      {
        $this->modoc->update_regular_termins();

        $this->mod->login_check();
      }
      else
      {
        # FAIL
        // echo $alert = validation_errors();
      }
    }

    $page_data = array();

    $page_content = $this->load->view('admin/treatment_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_treatment' => TRUE,
    );

    $this->load->view('struct_admin_view', $output_data);
  }
}

/* End of file treatment.php */
/* Location: ./application/controllers/admin/treatment.php */