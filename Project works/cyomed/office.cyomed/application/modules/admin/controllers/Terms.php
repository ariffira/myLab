<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends MX_Controller {

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
      if ($this->form_validation->run('admin/terms'))
      {
        $this->moterm->update_term();
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }

    $this->mod->port->p->db_select();
    $terms = $this->moterm->get_list();

    $page_data = array(
      'terms' => $terms,
    );

    if (isset($alert) && $alert)
    {
      $page_data['alert'] = $alert;
    }

    $page_content = $this->load->view('terms_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file terms.php */
/* Location: ./application/controllers/admin/terms.php */