<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Termin_settings extends CI_Controller {

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
      if ($this->form_validation->run('admin/termin_settings/index'))
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

    $page_content = $this->load->view('admin/termin_settings_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_termin_settings' => TRUE,
    );

    $this->load->view('struct_admin_view', $output_data);
  }

  /**
   *
   */
  public function delete($mode = 'redirect', $id = NULL)
  {
    if (!in_array($mode, array('redirect', 'ajax', )))
    {
      $mode = 'redirect';
    }

    $result = $this->modoc->delete_regular_termin($id);

    $this->mod->login_check();

    switch ($mode) {
      case 'redirect':
        redirect('admin/termin_settings');
        break;

      case 'ajax':
        echo $result ? TRUE : FALSE;
        break;
      
      default:
        # code...
        break;
    }
  }
}

/* End of file termin_settings.php */
/* Location: ./application/controllers/admin/termin_settings.php */