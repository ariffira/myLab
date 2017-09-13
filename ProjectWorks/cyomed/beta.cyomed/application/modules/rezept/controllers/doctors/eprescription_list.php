<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eprescription_list extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
   
  	$this->ui->mc->base_init();

    $this->ui->mc->title->content = 'Rezeptliste';

    
      $this->load->model('rezept/m_epres');

      $data = array();

      $data = $this->m_epres->get_epres_list_all();

      $this->ui->mc->content->content = $this->load->view('doctors/eprescription_view', array('data' => $data, ), TRUE); 
      
    $this->output->set_output($this->ui->mc->output());
    
  }

  /**
   *
   */


}
/* End of file rezept_list.php */
/* Location: ./application/modules/rezept/controllers/rezept_list.php */