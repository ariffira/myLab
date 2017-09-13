<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends MX_Controller {

  /**
   *
   */

  public function index()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('plugin', $this->m->user_value('language'));

    $termin_settings = $this->modoc->get_termin_settings();
    $doctors = $this->modoc->get_me();
    //var_dump($doctor);

    $this->ui->mc->base_init();
    /*** for adding header***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
     
    }
    else
    {
     $this->config->load('ia24ui', TRUE, TRUE);
     $this->ui->html
                ->base_init()
                ->load_config('html');
     $this->ui->html
                    ->set_active_url('termin/doctor/plugin');
    }
    /***end here***/

    $this->ui->mc->title->content = '';

    //var_dump($termin_settings);

    $this->ui->mc->content->content = $this->load->view('plugins/plugin_view', array(
          'termin_settings' => $termin_settings,
          'doctors' => $doctors, 
        ), TRUE);

    /**displaying for output***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($this->ui->mc->output());
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    /****end here***/

  }

  /**
   *
   */
  public function iframe(){

    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));

    $share_id = $this->input->get('shareid');

    $doctors = $this->modoc->get_share($share_id);

    $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'register')
      ->page_title('');


    $this->ui->html
      ->content($this->load->view('plugins/iframe_view', array(
          'doctors' => $doctors, 
        ), TRUE));

    

    $this->output->set_output(
      $this->ui->html->output()
    );
     

  }


  

}

/* End of file profile.php */
/* Location: ./application/modules/termin/controllers/settings.php */