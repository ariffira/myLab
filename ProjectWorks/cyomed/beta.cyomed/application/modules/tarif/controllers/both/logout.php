<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    $this->m->logout();

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : FALSE,
      'd' => $this->input->get('d') !== FALSE ? TRUE : FALSE,
    );

    redirect('portal/both/login/page?'.($this->input->get('p') !== FALSE ? 'p' : ($this->input->get('d') !== FALSE ? 'd' : FALSE)));
  }

}

/* End of file logout.php */
/* Location: ./application/controllers/both/logout.php */