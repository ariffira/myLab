<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

  /**
   *
   */
	public function index()
	{
	  	static $_ci;
	  	if (empty($_ci)) $_ci =& get_instance();


	    //lang load for design
	  	$this->load->language('global/general_text', $this->m->user_value('language'));
	  	$this->load->language('settings', $this->m->user_value('language'));

	  	$termin_settings = $this->modoc->get_termin_settings();
	  	$doctors = $this->modoc->get_me();

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
	  		->set_active_url('termin/doctor/settings');
	  	}
	  	/***end here***/

	  	$this->ui->mc->title->content = 'Settings';


	  	$this->ui->mc->content->content = $this->load->view('settings/settings_view', array(
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
   * update the calendar settings of the doctor, called from calendar form from profile page
   * @return [type] [description]
   */
	public function update_doctor_settings(){
	  	static $_ci;
	  	if (empty($_ci)) $_ci =& get_instance();

	  	$working_hours_start = array();
	  	$working_hours_end = array();
	  	$pr_hours_start = array();
	  	$pr_hours_end = array();

	  	$day = $_ci->input->post('day');
	  	$pr_day = $_ci->input->post('pr_day');
	  	$start_time = $_ci->input->post('start_time');
	  	$end_time = $_ci->input->post('end_time');
	  	$pr_start_time = $_ci->input->post('pr_start_time');
	  	$pr_end_time = $_ci->input->post('pr_end_time');

	  	if($day && is_array($day)){
	  		if($start_time && is_array($start_time) && $end_time && is_array($end_time)){
	  			foreach ($day as $key => $value) {
	  				$temp = $key.'|'.$start_time[$key];
	  				$temp1 = $key.'|'.$end_time[$key];
	  				array_push($working_hours_start, $temp);
	  				array_push($working_hours_end, $temp1);
	  			}
	  		}
	  	}

	  	if($pr_day && is_array($pr_day)){
	  		if($pr_start_time && is_array($pr_start_time) && $pr_end_time && is_array($pr_end_time)){
	  			foreach ($pr_day as $key => $value) {
	  				$temp = $key.'|'.$pr_start_time[$key];
	  				$temp1 = $key.'|'.$pr_end_time[$key];
	  				array_push($pr_hours_start, $temp);
	  				array_push($pr_hours_end, $temp1);
	  			}
	  		}
	  	}

	  	for($i=1;$i<=7;$i++){
	  		if(!in_array($i, $day)){
	  			$temp = $i.'|-';
	  			array_push($working_hours_start, $temp);
	  			array_push($working_hours_end, $temp);
	  		}
	  		if(!in_array($i, $pr_day)){
	  			$temp1 = $i.'|-';
	  			array_push($pr_hours_start, $temp1);
	  			array_push($pr_hours_end, $temp1);
	  		}
	  	}

	  	$update_doctor_settings=array(
	      //'doctor_id'       => $this->m->user_id(),
	  		'working_days'      => 5,
	  		'working_hours_start'   => implode(",", $working_hours_start),
	  		'working_hours_end'   => implode(",", $working_hours_end),
	  		'calendar_cell'     => 30,
	  		'termin_default_length' => $_ci->input->post('duration')?$_ci->input->post('duration'):0,
	  		'regular_termin_on'   => 0,
	  		'lunch_start'     => $_ci->input->post('lunch_start')?$_ci->input->post('lunch_start'):'12:00',
	  		'lunch_end'       => $_ci->input->post('lunch_end')?$_ci->input->post('lunch_end'):'14:00',
	  		'private_hours_start' =>implode(",", $pr_hours_start),
	  		'private_hours_end'=> implode(",", $pr_hours_end),

	  		);

	  	$_ci->load->model('modoc');

	  	$_ci->modoc->update_doctor_settings($update_doctor_settings);
	  	ajax_redirect('akte/profile');
  	}

  	public function update_general_settings(){
  		$update_param = array(
  			'max_advance_booking' => $this->input->post('advance_booking').' '.$this->input->post('advance_booking_time'),
  			'min_cancel_before' => $this->input->post('cancel_before').' '.$this->input->post('cancel_before_time'),
  			);
  		$this->modoc->update_general_settings($update_param);
  		ajax_redirect('akte/profile');
  	}


  public function update_profile(){

  	$this->modoc->update_profile();

  	ajax_redirect('termin/doctor/settings');
  }

  /**
   *
   */
  public function update_times(){

  	$this->modoc->update_regular_termins();

  	ajax_redirect('termin/doctor/settings');
  }

  /**
   *
   */
  public function delete($mode = 'redirect', $id = NULL)
  {
  	if (!in_array($mode, array('redirect', 'ajax', )))
  	{
  		$mode = 'redirect';
  	}

  	$result = $this->modoc->delete_regular_termin($id);

  	$this->m->login_check();

  	switch ($mode) {
  		case 'redirect':
  		ajax_redirect('termin/doctor/settings');
  		break;

  		case 'ajax':
  		echo $result ? TRUE : FALSE;
  		break;

  		default:
        # code...
  		break;
  	}
  }

  /**
   *
   */
  public function update_afterwards(){

  	$this->modoc->update_afterwards();

  	ajax_redirect('akte/profile');
  }

  /**
   *
   */
  public function update_reminders(){

  	$this->modoc->update_reminders();

  	ajax_redirect('akte/profile');
  }

  /**
   *
   */
  public function update_followup(){

  	$this->modoc->update_followup();

  	ajax_redirect('akte/profile');
  }

 

}

/* End of file profile.php */
/* Location: ./application/modules/termin/controllers/settings.php */