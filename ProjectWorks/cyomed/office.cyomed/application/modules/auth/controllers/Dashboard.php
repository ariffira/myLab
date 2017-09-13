<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

  function __construct()
  {
    parent::__construct();
  }

  /**
   *
   */
  public function index()
  {
    $this->mod->login_check();
    if ($this->mod->login_redirect()) return;

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