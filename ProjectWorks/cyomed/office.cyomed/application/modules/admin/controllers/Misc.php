<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc extends MX_Controller {

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

    $sidebar = $this->config->item('sidebar');
    // $sidebar[count($sidebar) - 1]['active'] = TRUE;

    $page_data = array(
      // 'data' => $data,
    );

    $page_content = $this->load->view('misc_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file misc.php */
/* Location: ./application/controllers/admin/misc.php */