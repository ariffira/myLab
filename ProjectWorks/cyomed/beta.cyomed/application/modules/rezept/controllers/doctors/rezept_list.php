<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rezept_list extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    
    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('eprescription/epres',$this->m->user_value('language'));
    $this->load->language('pwidgets/rezept',$this->m->user_value('language'));
    
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
   
  	$this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    if (!$_ci->m->us_id())
	{
    	$this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
    }
    else{
      $this->load->model('rezept/m_epres');

      $data = array();

//      $data = $this->m_epres->get_epres_list();
      $data = $this->m_epres->list_of_applications();

      $this->ui->mc->content->content = $this->load->view('doctors/rezept_view', array('data' => $data, ), TRUE); 

    }

    $this->output->set_output($this->ui->mc->output());
    
  }

  /**
   *
   */


}
/* End of file rezept_list.php */
/* Location: ./application/modules/rezept/controllers/rezept_list.php */