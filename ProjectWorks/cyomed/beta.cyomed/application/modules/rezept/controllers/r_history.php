<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R_history extends MX_Controller {

  /**
   *
   */
  public function index($patient=false)
  {
  	
    $this->load->language('eprescription/epres',$this->m->user_value('language'));
    $this->load->language('pwidgets/rezept',$this->m->user_value('language'));
    
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    $this->load->model('rezept/m_epres');

    $data = array();
    $data = $this->m_epres->list_of_applications($patient);


    $this->ui->mc->content->content = $this->load->view('rezept/history_view', array('data'=>$data), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  /**
   *
   */


}
