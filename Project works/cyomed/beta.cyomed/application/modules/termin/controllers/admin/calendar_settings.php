<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_settings extends CI_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
    $this->m->login_check_redirect();
  }

  /**
   *
   */
  public function index()
  {
    if($this->m->user_role() != M::ROLE_DOCTOR ){
      exit();
    }
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $working_hours_start = array('1|09:00','2|09:00','3|09:00','4|09:00','5|09:00');
    $working_hours_end = array('1|17:00','2|17:00','3|17:00','4|17:00','5|17:00');
    // $day = $_ci->input->post('day');
    // $start_time = $_ci->input->post('start_time');
    // $end_time = $_ci->input->post('end_time');
    // if($day && is_array($day)){
    //  if($start_time && is_array($start_time) && $end_time && is_array($end_time)){
    //    foreach ($_ci->input->post('day') as $day) {
    //      $working_hours_start[] = isset($day) ? $day.'|'.$start_time[$day]:'',
    //      $working_hours_end[] = isset($day) ? $day.'|'.$end_time[$day]:'', 
    //    }
    //  }
    // }

    $update_doctor_settings=array(
      //'doctor_id'       => $this->m->user_id(),
      'working_days'      => 5,
      'working_hours_start'   => implode(",", $working_hours_start),
      'working_hours_end'   => implode(",", $working_hours_end),
      'calendar_cell'     => 30,
      'termin_default_length' => $_ci->input->post('duration')?'':30,
      'regular_termin_on'   => 0,
      'lunch_start'     => $_ci->input->post('lunch_start')?'':'12:00',
      'lunch_end'       => $_ci->input->post('lunch_end')?'':'14:00',

      );

    $_ci->load->model('modoc');

    $_ci->modoc->update_doctor_settings($update_doctor_settings);


  }

  public function get_doctor_settings(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->model('modoc');
    $calendar_settings = $_ci->modoc->get_doctor_settings();

    $working_hours_start = explode(",", $calendar_settings['working_hours_start']);
    $start_time=array();
    foreach($working_hours_start as $day){
      $temp = explode("|", $day);
      $temp1['day'] = $temp[0];
      $temp1['start_time'] = $temp[1];
      array_push($start_time, $temp1);
    }
    var_dump($start_time);
  }
}

/* End of file calendar_settings.php */
/* Location: ./application/controllers/admin/calendar_settings.php */