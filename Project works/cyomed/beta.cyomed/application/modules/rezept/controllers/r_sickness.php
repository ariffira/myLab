<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R_sickness extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    $this->load->language('eprescription/epres',$this->m->user_value('language'));
    
  	$this->ui->mc->base_init();

    $this->ui->mc->title->content = $this->lang->line('epres_online_eprescription');

    $this->ui->mc->content->content = $this->load->view('rezept/sickness_view', array(), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  /**
   *
   */


}
