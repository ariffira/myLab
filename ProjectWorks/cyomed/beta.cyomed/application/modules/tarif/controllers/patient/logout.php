<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    $this->m->logout();
    redirect('portal/both/login/page?p');
  }

}

/* End of file logout.php */
/* Location: ./application/controllers/patient/logout.php */