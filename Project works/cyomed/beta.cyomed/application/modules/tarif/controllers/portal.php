<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    $this->load->module('portal/both/login')->page();
  }

}

/* End of file portal.php */
/* Location: ./application/modules/portal/controllers/portal.php */