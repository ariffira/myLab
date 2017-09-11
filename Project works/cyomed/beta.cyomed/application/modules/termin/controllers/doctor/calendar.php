<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
    $this->m->login_check_redirect();
    //$this->m->admin_check();
  }

  /**
   *
   */
  public function index()
  {

    //if (!$this->m->user()->module_activated)
    //{
      //echo "string";
      //redirect('termin/admin/profile');
      //exit();
    //}

    //$this->config->load('side_menu', TRUE, TRUE);

    $events = $this->m->user()->all_termins;
//    echo "<pre>";print_r($this->m->user());
//    echo "<pre>";
//    print_r($events);die;

    //$page_data = array(
      ///'events' => $events,
    //);
    //print_r($page_data);

    //$page_content = $this->load->view('admin/calendar_view', $page_data, TRUE);

    //$output_data = array(
      //'page_class' => '',
      //'page_stylesheets' => array(), 
      //'page_content' => $page_content, 

      //'active_calendar' => TRUE,
      // 'jumbotron' => TRUE, 

      //'side_menu' => $this->config->item('side_menu'),
    //);

   // $this->load->view('struct_admin_view', $output_data);


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
                    ->set_active_url('termin/doctor/calendar');
    }
    /***end here***/


    $this->ui->mc->title->content = '';

    $this->ui->mc->content->content = $_ci->load->view('calendar/calendar_view', array(
          'events' => $events,
          'active_calendar' => TRUE,
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
    
    //$this->output->set_output($this->ui->mc->output());

  }

  /**
   *
   */
  public function all_termin_json()
  {
    $this->output->set_content_type('application/json')->set_output(json_encode($this->m->user()->all_termins));
  }

  /**
   *
   */
  public function update_termin($id = NULL)
  {
    $this->modoc->update_termin($id);

    // $this->output->set_content_type('application/json')->set_output(json_encode($this->mod->user()->all_termins));
  }

  /**
   *
   */
  public function update_reservation($id = NULL)
  {
    $this->modoc->update_reservation($id);

    // $this->output->set_content_type('application/json')->set_output(json_encode($this->mod->user()->all_termins));
  }

  /**
   *
   */
  public function update_termin_time($id = NULL)
  {
    $this->modoc->update_termin_time($id);

    // $this->output->set_content_type('application/json')->set_output(json_encode($this->mod->user()->all_termins));
  }

  /**
   *
   */
  public function insert_termin()
  {
    $this->modoc->insert_termin();

    // $this->output->set_content_type('application/json')->set_output(json_encode($this->mod->user()->all_termins));
  }

  /**
   *
   */
  public function mask_termin($id = NULL)
  {
    $this->modoc->mask_termin($id);

    // $this->output->set_content_type('application/json')->set_output(json_encode($this->mod->user()->all_termins));
  }

  

}

/* End of file calendar.php */
/* Location: ./application/controllers/admin/calendar.php */