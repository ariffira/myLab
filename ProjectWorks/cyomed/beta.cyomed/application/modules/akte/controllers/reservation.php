<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MX_Controller {

  /**
   *
   */
  public function __construct()
  {
    $this->m->login_check_redirect();
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('global/overview',$this->m->user_value('language'));
    $this->load->language('patients/home',$this->m->user_value('language'));
    $this->load->language('patients/reservation',$this->m->user_value('language'));
  }


  public function index($url = NULL)
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
     ->set_active_url('akte/reservation');
   }
//    $this->ui->mc->title->content = $this->lang->line('appoinment_list');
   /***end here***/
   $_ci->load->model('reservation/mreservation');
   $this->m->role_diff(
    function() use ($_ci,$url){
      if ($url)
      {
       
        if(!$_ci->m->us_id()){
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        else{
          $reservation=array('doctor_id'=>$_ci->m->user_id(),'patient_id'=>$_ci->m->us_id());
        }
      }
      else{
        
        $reservation=array('doctor_id'=>$_ci->m->user_id());   
      }
      
      $this->ui->mc->content->content = $_ci->load->view('reservation/reservation_list', array(
        'reservation' =>  $_ci->mreservation->getReservation($reservation,'',2),
        'url'=>$url
        ), TRUE);
    },
    function() use ($_ci){
     $reservation=array('patient_id'=>$_ci->m->user_id());
     $this->ui->mc->content->content = $_ci->load->view('reservation/reservation_list', array(
      'reservation'=>$_ci->mreservation->getReservation($reservation,'',1), 
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
 public function reservation_history($patient=false)
 {

  if($patient=='patient'){
   $url="akte/reservation/index/$patient";
 }
 else{
  $url='akte/reservation/index';
}
//          echo $url;die;
ajax_redirect($url);
}
public function ajax_accept($patient=false)
{    
  static $_ci;
  if (empty($_ci)) $_ci =& get_instance();
  if(isset($_POST['reserv_id']) && !empty($_POST['reserv_id'])){
    $update_params = array('accept'=>'1');
    $id=$_POST['reserv_id'];
  }
  else{
   $update_params = array();
 }
 $_ci->load->model('reservation/mreservation');
 
 $this->mreservation->updateReserv($id, $update_params);
 $return= $this->m->role_diff(
  function() use ($_ci,$patient){
    if ($patient)
    {
     
      if(!$_ci->m->us_id()){
        return $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
      }
      else{
        $reservation=array('doctor_id'=>$_ci->m->user_id(),'patient_id'=>$_ci->m->us_id());
      }
    }
    else{
      
      $reservation=array('doctor_id'=>$_ci->m->user_id());   
    }
    
    return $_ci->load->view('reservation/reservation_list', array(
      'reservation' =>  $_ci->mreservation->getReservation($reservation,'',2),
      'url'=>$patient
      ), TRUE);
  },
  function() use ($_ci){
   $reservation=array('patient_id'=>$_ci->m->user_id());
   return $_ci->load->view('reservation/reservation_list', array(
    'reservation'=>$_ci->mreservation->getReservation($reservation,'',1), 
    ), TRUE);
 }
 );
 echo $return;die;
}

public function ajax_cancel($patient=false)
{    
 static $_ci;
 if (empty($_ci)) $_ci =& get_instance();

 $_ci->load->model('reservation/mreservation');

 if(isset($_POST['reserv_id']) && !empty($_POST['reserv_id'])){
   $update_params = array('accept'=>'1');
   $id = $_POST['reserv_id'];

          /* Alg by arif:
           email if reservation is cancel,
           1) find all data by reservation id done 
           2) find all reservation later than this one
           3) compare
           4) send array of emails to everyone by email 
           5) email the patient who cancel it about cancelation
           */
$query4thisReserv = $_ci->mreservation->get_data($id);

//send email about cancelation to its patient
$email1 = $query4thisReserv->email;
$docOfThisID = $query4thisReserv->doctor_id;
$timeOfThisID = $query4thisReserv->end;
$appointment_time =  $query4thisReserv->start;

$subject= $this->lang->line('reserv_email_sub');
$msg = $this->load->view('reservation/emails/cancel_reservation_view', $query4thisReserv, true);
$this->moemail->send_email($email1,$subject,$msg);

//send email to all users waiting....
$query4allReserv = $_ci->mreservation->get_all_reserv($docOfThisID,$appointment_time);          
//var_dump($query4allReserv);
foreach ($query4allReserv as $row){
  $reserv_temp['reserv_id'] = $row['reserv_id'];
  $reserv_id = $reserv_temp['reserv_id'];
  $email_temp['email'] = $row['email'];
  $to = $email_temp['email'];
  $subject2all= $this->lang->line('reserv_email_sub2');
  $msg_content = $this->load->view('reservation/emails/cancel_reserv_msg2all_view', array('first_name'=> $row['first_name'],'last_name'=> $row['last_name'],'reserv_id'=> $reserv_id, 'appointment_time'=> $appointment_time, 'id'=> $id),true);

  $this->moemail->send_email($to,$subject2all,$msg_content);
}

}
else{
 $update_params = array();
}

$this->mreservation->updateReserv($id, $update_params);
$return= $this->m->role_diff(
  function() use ($_ci,$patient){
    if ($patient)
    {
     
      if(!$_ci->m->us_id()){
        return $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
      }
      else{
        $reservation=array('doctor_id'=>$_ci->m->user_id(),'patient_id'=>$_ci->m->us_id());
      }
    }
    else{
      
      $reservation=array('doctor_id'=>$_ci->m->user_id());   
    }
    
    return $_ci->load->view('reservation/reservation_list', array(
      'reservation' =>  $_ci->mreservation->getReservation($reservation,'',2),
      'url'=>$patient
      ), TRUE);
  },
  function() use ($_ci){
   $reservation=array('patient_id'=>$_ci->m->user_id());
   return $_ci->load->view('reservation/reservation_list', array(
    'reservation'=>$_ci->mreservation->getReservation($reservation,'',1), 
    ), TRUE);
 }
 );
echo $return;die;
}

public function ajax_cancel_request($patient=false)
{    
 static $_ci;
 if (empty($_ci)) $_ci =& get_instance();
 
 if(isset($_POST['reserv_id']) && !empty($_POST['reserv_id'])){
   $update_params = array('request'=>'1');
   $id=$_POST['reserv_id'];
 }
 else{
   $update_params = array();
 }
 $_ci->load->model('reservation/mreservation');
 
 $this->mreservation->updateReserv($id, $update_params);
 $return= $this->m->role_diff(
  function() use ($_ci,$patient){
    if ($patient)
    {
     
      if(!$_ci->m->us_id()){
        return $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
      }
      else{
        $reservation=array('doctor_id'=>$_ci->m->user_id(),'patient_id'=>$_ci->m->us_id());
      }
    }
    else{
      
      $reservation=array('doctor_id'=>$_ci->m->user_id());   
    }
    
    return $_ci->load->view('reservation/reservation_list', array(
      'reservation' =>  $_ci->mreservation->getReservation($reservation,'',2),
      'url'=>$patient
      ), TRUE);
  },
  function() use ($_ci){
   $reservation=array('patient_id'=>$_ci->m->user_id());
   return $_ci->load->view('reservation/reservation_list', array(
    'reservation'=>$_ci->mreservation->getReservation($reservation,'',1), 
    ), TRUE);
 }
 );
 echo $return;die;
}

public function Accept_Cancelation($patient=false)
{    
 static $_ci;
 if (empty($_ci)) $_ci =& get_instance();
 
 if(isset($_POST['reserv_id']) && !empty($_POST['reserv_id'])){
   $update_params = array('request'=>'0','accept'=>'2');
   $id=$_POST['reserv_id'];
 }
 else{
   $update_params = array();
 }
 $_ci->load->model('reservation/mreservation');
 
 $this->mreservation->updateReserv($id, $update_params);
 $return= $this->m->role_diff(
  function() use ($_ci,$patient){
    if ($patient)
    {
     
      if(!$_ci->m->us_id()){
        return $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
      }
      else{
        $reservation=array('doctor_id'=>$_ci->m->user_id(),'patient_id'=>$_ci->m->us_id());
      }
    }
    else{
      
      $reservation=array('doctor_id'=>$_ci->m->user_id());   
    }
    
    return $_ci->load->view('reservation/reservation_list', array(
      'reservation' =>  $_ci->mreservation->getReservation($reservation,'',2),
      'url'=>$patient
      ), TRUE);
  },
  function() use ($_ci){
   $reservation=array('patient_id'=>$_ci->m->user_id());
   return $_ci->load->view('reservation/reservation_list', array(
    'reservation'=>$_ci->mreservation->getReservation($reservation,'',1), 
    ), TRUE);
 }
 );
 echo $return;die;
}

public function change_reservation(){
  
  
  static $_ci;
  if (empty($_ci))
    $_ci = & get_instance();

  $this->m->login_check_redirect();

  $id = $this->input->get('id');
  $reserv_id = $this->input->get('reserv_id');
  // echo $id;
  //echo $reserv_id;

  $this->load->model('reservation/mreservation');
  $query1 = $this->mreservation->get_data($id);
  $query2 = $this->mreservation->get_data($reserv_id);
  // var_dump($query1);
  //user 1 data that will add to user 2
  $newDate = $query1->start;
  $newEndDate = $query1->end;

  //user2
  $existDate = $query2->start;
  $first_name = $query2->first_name;
  $last_name = $query2->last_name;
  $gender = $query2->gender;
 
   $this->config->load('ia24ui', TRUE, TRUE);
   $this->ui->html
   ->base_init()
   ->load_config('html');

   $this->ui->html
      ->content($this->load->view('reservation/change_reservation_view', array('newDate'=> $newDate,'existDate'=> $existDate, 'first_name'=>$first_name, 'last_name'=>$last_name,'gender'=>$gender, 'newEndDate'=>$newEndDate,'reserv_id'=>$reserv_id, ), TRUE));

   $this->output->set_output($this->ui->html->output());
 

}


public function modify(){
  
  
  static $_ci;
  if (empty($_ci))
    $_ci = & get_instance();

  //update accept field, start, end, wait=0, wait status=1 
  $form_data = $this->input->post();
  $id = $form_data['reserv_id'];
  $newDate = $form_data['newDate'];
  $newEndDate = $form_data['newEndDate'];
  
  $update_params = array('start'=> $newDate,'end'=>$newEndDate, 'accept'=> '1', 'wait'=> '0', 'wait_status'=> '1');
 

 $this->load->model('reservation/mreservation');
 
 $this->mreservation->updateReserv($id, $update_params);

 $this->config->load('ia24ui', TRUE, TRUE);
   $this->ui->html
   ->base_init()
   ->load_config('html');

   $this->ui->html
      ->content($this->load->view('reservation/reservation_modify_view', array(), TRUE));

   $this->output->set_output($this->ui->html->output());

}

// public function waiting_list_insert(){
  
  
//   static $_ci;
//   if (empty($_ci))
//     $_ci = & get_instance();

//   //get info and add to waiting list table
//   // $form_data = $_ci->input->post();
//   $pat_id = $_ci->input->post('patient_id');
//   $doc_id = $_ci->input->post('d_id');
//   $date = $_ci->input->post('waitDate');
//   //echo $pat_id.$doc_id;
//   //var_dump($form_data);  
//   $insert_params = array(
//     'pat_id'=> $pat_id,
//     'doc_id'=>$doc_id,
//     'wish_date'=>$date,
//     'status'=> '0');


//   $this->load->model('reservation/mwaitinglist');
 
//   $this->mwaitinglist->insert($insert_params);

//   $this->config->load('ia24ui', TRUE, TRUE);
//    $this->ui->html
//    ->base_init()
//    ->load_config('html');

//    $this->ui->html
//       ->content($this->load->view('reservation/waiting_list_view', array(), TRUE));

//    $this->output->set_output($this->ui->html->output());

// }


public function waiting_list_insert(){
  
  
  static $_ci;
  if (empty($_ci))
    $_ci = & get_instance();

  //get info and add to waiting list 

  $pat_id = $_ci->input->post('patient_id');
  $doc_id = $_ci->input->post('doc_id');
  $date = $_ci->input->post('waitDate');

  $_ci->load->model('mopat');
  $result = $_ci->mopat->get_info($pat_id);
  
  $insert_params = array(
    'patient_id'=> $pat_id,
    'doctor_id'=>$doc_id,
    'start' =>$date,
    //'accept'=> '1',
    'email'=> $result->email,
    'gender'=> $result->gender,
    'first_name'=> $result->name,
    'last_name'=> $result->surname,
    'telephone'=> $result->telephone,
    'insurance'=> $result->insurance_type,
    'insurance_provider'=> $result->insurance_provider,
    'wait'=> '1',
    'wait_status'=> '0');

  $this->load->model('reservation/mreservation');
 
  $this->mreservation->insert_wait($insert_params);

  $this->config->load('ia24ui', TRUE, TRUE);
   $this->ui->html
   ->base_init()
   ->load_config('html');

   $this->ui->html
      ->content($this->load->view('reservation/waiting_list_view', array(), TRUE));

   $this->output->set_output($this->ui->html->output());

}

 /**
   * make the reservation from doctor calendar called from termin.js 
   * @return [type] [description]
   */
  public function make_reservation(){
    $this->load->model('reservation/mreservation');
    $pat_id = $this->input->post('patient_id');
    $pat_param = null;
    if($pat_id){
      $this->m->port->p->select('name, surname, telephone, email, insurance_type, insurance, gender');
      $patient_query = $this->m->port->p->get_where('patients',array('id'=>$pat_id),1);
      if($patient_query->num_rows()>0){
        $pat_param = $patient_query->row();
      }
    }
    $insert_param = array(
      'doctor_id'          => $this->input->post('doctor_id')!=0?$this->input->post('doctor_id'):$this->m->user_id(),
      'patient_id'         => $pat_id?$pat_id:'',
      'termin_id'          => $this->input->post('id')!='add'?$this->input->post('id'):0,
      'start'              => $this->input->post('start'),
      'end'                => $this->input->post('end'),
      'gender'             => $pat_id?$pat_param->gender:$this->input->post('gender'), 
      'email'              => $pat_id?$pat_param->email:$this->input->post('email'),
      'first_name'         => $pat_id?$pat_param->name:$this->input->post('first_name'),
      'last_name'          => $pat_id?$pat_param->surname:$this->input->post('last_name'),
      'telephone'          => $pat_id?$pat_param->telephone:$this->input->post('telephone'),
      'insurance'          => $pat_id?$pat_param->insurance_type:$this->input->post('insurance_type'),
      'insurance_provider' => $pat_id?$pat_param->insurance:$this->input->post('insurance_provider'),
      'text_notes'         => $this->input->post('text_notes'),
      );
    $reserve_id = $this->mreservation->insert($insert_param);
    $this->mreservation->updateReserv($reserve_id,array('accept'=>1));
  }



}

/* End of file reservation.php */
/* Location: ./application/modules/akte/controllers/reservation.php */