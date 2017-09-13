<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Termin extends MX_Controller {

  //function __construct()
  //{
    // Call the Model constructor
    //parent::__construct();

    //$this->mod->admin_check();
  //}

  /**
   *
   */
  public function index()
  {
    //if (!$this->mod->user()->module_activated)
    //{
      //redirect('admin/profile');
      //exit();
    //}

    //lang load for design
  	$this->load->language('global/general_text', $this->m->user_value('language'));
  	$this->load->language('appointment', $this->m->user_value('language'));

  	$reservations = $this->modoc->get_all_reservations($this->m->user_id());    
  	$unread = $this->modoc->get_unread_reservations($this->m->user_id());
  	$past = $this->modoc->get_past_reservations($this->m->user_id());
  	$accepted = $this->modoc->get_accepted_reservations($this->m->user_id());
  	$unaccepted = $this->modoc->get_unaccepted_reservations($this->m->user_id());
  	$archive = $this->modoc->get_archived_reservations($this->m->user_id());


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
  		->set_active_url('termin/doctor/termin');
  	}
  	/***end here***/

  	$this->ui->mc->title->content = '';

  	$this->ui->mc->content->content = $_ci->load->view('appointment/appointment_view', array(
  		'reservations' => $reservations,
  		'unread' => $this->modoc->merge_reservations($unread, $unaccepted),
  		'past' => $past, 
  		'accepted' => $accepted, 
  		'accepted_filtered' => $this->modoc->filter_time_room($accepted),
  		'archive' => $archive, 
  		'active_termin' => TRUE,
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
  public function new_appointment()
  {
    // var_dump($this->input->post());

  	if ($this->input->post())
  	{
  		if ($reserve_id = $this->modoc->reserve())
  		{
  			$this->modoc->reservation_action('read', TRUE, array($reserve_id => 1, )); 
  			$this->modoc->reservation_action('accept', TRUE, array($reserve_id => 1, )); 
        // echo $reserve_id;
  		}
  		else
  		{
  			echo "Post information validation error.\n";
  			var_dump($this->input->post());
  		}
  	}
  	else
  	{
  		echo 'Nothing posted';
  	}

  }

  /**
   *
   */
  public function all_termin_json()
  {
  	$this->output->set_content_type('application/json')->set_output(json_encode($this->modoc->get_all_reservations($this->m->user_id())));
  }

  /**
   *
   */
  public function action($action = 'read', $toggle = NULL)
  {
  	switch ($action)
  	{
  		case 'read':
  		$action = 'read';
  		break;

  		case 'accept':
  		$action = 'accept';
  		break;

  		case 'archive':
  		$action = 'archived';
  		break;

  		case 'delete':
  		$action = 'deleted';
  		break;
  		
  		default:
  		$action = FALSE;
  		break;
  	}

  	switch ($toggle)
  	{
  		case 'y':
  		$toggle = true;
  		break;

  		case 'n':
  		$toggle = false;
  		break;

  		case 'toggle':
  		$toggle = NULL;
  		break;
  		
  		default:
  		$toggle = true;
  		break;
  	}

  	if ($action)
  	{
  		$this->modoc->reservation_action($action, $toggle);
  	}

    // redirect('admin/termin');
  }
}

/* End of file termin.php */
/* Location: ./application/controllers/admin/termin.php */