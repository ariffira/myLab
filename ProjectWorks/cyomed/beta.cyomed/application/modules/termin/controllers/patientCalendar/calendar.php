<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MX_Controller {

  /**
   *
   */
  public function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }


/**
   *
   */
  public function index()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

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
                    ->set_active_url('termin/patientCalendar/calendar');
    }
    /***end here***/
    $this->ui->mc->title->content = 'Calendar';

    $this->m->role_diff(
      function() use ($_ci){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        
        // $_ci->load->model('');
        $_ci->ui->mc->content->content = $_ci->load->view('patientcalendar/calendar_view', array(), TRUE);
      },
      function() use ($_ci){
        $_ci->ui->mc->content->content = $_ci->load->view('patientcalendar/calendar_view', array(
        ), TRUE);
      }
    );

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
  

}

/* End of file calendar.php */
/* Location: ./application/modules/patientcalendar/controllers/calendar.php */