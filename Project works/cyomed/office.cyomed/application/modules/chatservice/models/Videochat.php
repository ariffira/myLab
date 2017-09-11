<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    |
    |help_status
    |1=in queue
    |help_status = 1 and care_doctor_id!=0 in process with care doctor
    |2=contacted with patient by chatcare /broadcasted
    |help_status=2 and doctor_id != 0 doctor resonded
    |3=completed
    |4=manually finished by chatcare
    */



class Videochat extends CI_Model {


  public static $encrypted_fields = array( );
  public static $plain_fields     = array('id', 'name', 'role', 'regid','login','status', );
  public static $datetime_fields  = array('lastlogin', );
	

	function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->load->database();

  }

  

  /*
  |get the list of patient for service from database who are not yet taken by any service person
  |
  */
  public function get_patients_list($care_id=null){
    
    $this->mod->port->p->select('c.id, q.id as quickblox_id, q.regid, c.patient_regid,c.patient_name, c.patient_surname, c.patient_phone,c.patient_address,c.help_apply_time,c.care_doctor_id');
    $this->mod->port->p->from('care_chatservice as c');
    $this->mod->port->p->join('quickblox as q','q.regid = c.patient_regid');
    $this->mod->port->p->where('c.help_status',1);
    if($care_id!=null){
      $this->mod->port->p->where('c.id',$care_id);
    }
    $this->mod->port->p->where_in('c.care_doctor_id',0);
    $query = $this->mod->port->p->get();
    
      $patients = array();
      $temp = array();
      foreach ($query->result() as $row){
        $temp['id'] = $row->id;
        $temp['quickblox_id'] = $row->quickblox_id;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['regid'] = $row->patient_regid;
        $temp['address'] = $row->patient_address;
        $temp['phone'] = $row->patient_phone;
        $temp['apply_time'] = $row->help_apply_time;
        $temp['care_doctor_id'] = $row->care_doctor_id;
        array_push($patients, $temp);
      }
    //   usort($patients, function($a, $b) {
    //     $ad = new DateTime($a['apply_time']);
    //     $bd = new DateTime($b['apply_time']);
    //     if ($ad == $bd) {
    //       return 0;
    //     }
    //     return $ad < $bd ? 1 : -1;
    // });
      return $patients;
  }

   /*
  |get the list of patient for service from database who taken by any service person but did not call/broadcast
  |
  */
  public function get_my_selected_patients_list(){
    
    $this->mod->port->p->select('c.id, q.id as quickblox_id, q.regid, c.patient_regid,c.patient_name, c.patient_surname, c.patient_phone,c.patient_address,c.help_apply_time,c.care_doctor_id');
    $this->mod->port->p->from('care_chatservice as c');
    $this->mod->port->p->join('quickblox as q','q.regid = c.patient_regid');
    $this->mod->port->p->where('c.help_status',1);
    $this->mod->port->p->where_in('c.care_doctor_id',array($this->mod->user_id()));
    //$this->mod->port->p->or_where('c.care_doctor_id',0);
    $query = $this->mod->port->p->get();
    
    //$where = 'care_doctor_id='.$this->mod->user_value('id').' or care_doctor_id=0 and help_status=1';
    // $this->mod->port->p->where('care_doctor_id',$this->mod->user_id());
    // $this->mod->port->p->or_where('care_doctor_id',0);
    // $this->mod->port->p->where('help_status',1);
    // $query = $this->mod->port->p->get('care_chatservice');
      $patients = array();
      $temp = array();
      foreach ($query->result() as $row){
        $temp['id'] = $row->id;
        $temp['quickblox_id'] = $row->quickblox_id;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['regid'] = $row->patient_regid;
        $temp['address'] = $row->patient_address;
        $temp['phone'] = $row->patient_phone;
        $temp['apply_time'] = $row->help_apply_time;
        $temp['care_doctor_id'] = $row->care_doctor_id;
        array_push($patients, $temp);
      }
    //   usort($patients, function($a, $b) {
    //     $ad = new DateTime($a['apply_time']);
    //     $bd = new DateTime($b['apply_time']);
    //     if ($ad == $bd) {
    //       return 0;
    //     }
    //     return $ad < $bd ? 1 : -1;
    // });
      return $patients;
  }

  /*
  |get the list of patient for service from database who are  taken by any service person
  |
  */
  public function get_my_patients_list(){
    $help_status=array('0','In queue','Broadcasted','Doctor responded',);
    $this->mod->port->p->select('c.id, q.id as quickblox_id, q.regid, c.patient_id,c.patient_regid,c.patient_name, c.patient_surname, c.patient_phone,c.patient_address,c.help_apply_time,c.care_doctor_id,c.help_status,c.broadcast_init_time,c.doctor_id,c.doctor_name,c.doctor_surname,c.doctor_regid,c.doctor_address,c.doctor_phone,c.doctor_call_patient_init_time,');
    $this->mod->port->p->from('care_chatservice as c');
    $this->mod->port->p->join('quickblox as q','q.regid = c.patient_regid');
    $this->mod->port->p->where('c.care_doctor_id',$this->mod->user_id());
    //$this->mod->port->p->or_where('c.care_doctor_id',0);

    $this->mod->port->p->where('c.help_status !=',1 );

    $query = $this->mod->port->p->get();
    
    //$where = 'care_doctor_id='.$this->mod->user_value('id').' or care_doctor_id=0 and help_status=1';
    // $this->mod->port->p->where('care_doctor_id',$this->mod->user_id());
    // $this->mod->port->p->or_where('care_doctor_id',0);
    // $this->mod->port->p->where('help_status',1);
    // $query = $this->mod->port->p->get('care_chatservice');
      $details = array();
      $temp = array();
      foreach ($query->result() as $row){
        $temp['id'] = $row->id;
        $temp['quickblox_id'] = $row->quickblox_id;
        $temp['patient_id'] = $row->patient_id;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['regid'] = $row->patient_regid;
        $temp['address'] = $row->patient_address;
        $temp['phone'] = $row->patient_phone;
        $temp['apply_time'] = $row->help_apply_time;
        $temp['care_doctor_id'] = $row->care_doctor_id;
        $temp['help_status'] = $help_status[$row->help_status];
        $temp['broadcast_time'] = $row->broadcast_init_time;
        $temp['doctor_id'] = $row->doctor_id;
        $temp['doctor_name'] = $row->doctor_name.' '.$row->doctor_surname;
        $temp['doctor_regid'] = $row->doctor_regid;
        $temp['doctor_address'] = $row->doctor_address;
        $temp['doctor_phone'] = $row->doctor_phone;
        $temp['doctor_callback_time'] = $row->doctor_call_patient_init_time;
        
        array_push($details, $temp);
      }
    //   usort($patients, function($a, $b) {
    //     $ad = new DateTime($a['apply_time']);
    //     $bd = new DateTime($b['apply_time']);
    //     if ($ad == $bd) {
    //       return 0;
    //     }
    //     return $ad < $bd ? 1 : -1;
    // });
      return $details;
  }

  /*
  |
  |insert quickblox login parameters into quickblox table
  */
  public function insert($insert_params){
    $this->mod->port->p->insert('quickblox',$insert_params);
  }

  /*
  |get the quickblox login credential
  */
  public function get_login(){
    $this->mod->port->p->select('login');
    $query = $this->mod->port->p->get_where('quickblox',array('regid'=>$this->mod->user_value('regid')));
    $login = null;
    foreach ($query->result() as $row){
      $login = $row->login;
    }
    return $login;
  }

    /**
   *
   */

  public function update($id, $update_params)
  {
    return $this->mod->port->p->update('quickblox',$update_params,array('id'=>$id));
  }

  public function get_doctor_for_specialization($spec){
    $this->mod->port->p->select('d.id as doctorId, q.id as quickbloxId');
    $this->mod->port->p->from('doctors as d');
    $this->mod->port->p->join('quickblox as q','d.regid=q.regid');
    $this->mod->port->p->where('d.specialization1',$spec);
    $this->mod->port->p->or_where('d.specialization2',$spec);
    $query = $this->mod->port->p->get();
    $temp = array();
    $doctors = array();
    if($query->num_rows()>0){
      foreach ($query->result() as $row) {
        $temp['id'] = $row->doctorId;
        $temp['quickbloxId'] = $row->quickbloxId;
        array_push($doctors, $temp);
      }
    }

    return $doctors;
  }

}

/* End of file videochat.php */
/* Location: ./application/modules/video/models/videochat.php */