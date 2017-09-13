<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends MX_Controller {

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
  }

  /**
   *
   */
  public function index()
  {
    $this->load->library('form_validation');

    if ($this->input->post())
    {
      if ($this->form_validation->run('admin/package'))
      {
        $this->mopack->update_package();
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    $this->mod->port->p->db_select();
    $packages = $this->mopack->get_list();

    $page_data = array(
      'packages' => $packages,
    );

    if (isset($alert) && $alert)
    {
      $page_data['alert'] = $alert;
    }

    $page_content = $this->load->view('package_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function term_update()
  {

  }

}

/* End of file misc.php */
/* Location: ./application/controllers/admin/package.php */