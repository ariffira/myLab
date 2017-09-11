<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    //$this->mod->admin_check();
  }

  /**
   *
   */
  public function index()
  {

    if ($this->input->post())
    {
      if ($this->form_validation->run('termin/profile/index'))
      {
        $this->modoc->update_profile();
        $this->m->login_check();
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    //$page_data = array();
    //isset($alert) && $alert ? ($page_data['alert'] = $alert) : FALSE;

    //$page_content = $this->load->view('termin/admin/profile_view', $page_data, TRUE);

    //$output_data = array(
      //'page_class' => '',
      //'page_stylesheets' => array(), 
      //'page_content' => $page_content, 

      //'active_profile' => TRUE,
    //);

    //$this->load->view('struct_admin_view', $output_data);

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
   
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'Doctor Termin';

    //$this->ui->mc->content->content = $this->load->view('admin/calendar_view', array(), TRUE); 

    $this->ui->mc->content->content = $_ci->load->view('admin/profile_view', array(
          
          'active_profile' => TRUE,
        ), TRUE);
    
    $this->output->set_output($this->ui->mc->output());

  }
}

/* End of file profile.php */
/* Location: ./application/controllers/admin/profile.php */