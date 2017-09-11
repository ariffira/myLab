<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'PORTAL';

    $this->ui->mc->content->content = $this->load->view('portal_view', array(), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

}

/* End of file portal.php */
/* Location: ./application/modules/akte/controllers/portal.php */