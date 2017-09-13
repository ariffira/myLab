<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
    if ($this->mod->user_role() >= 9)
    {
      //$this->index();
    }
    else
    {
      // redirect('auth/login');
      show_error('Access denied.');
    }
  }
  /**
   *
   */
  public function index()
  {

    $page_data = array(
      // 'data' => $data,
    );

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('dashboard_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */