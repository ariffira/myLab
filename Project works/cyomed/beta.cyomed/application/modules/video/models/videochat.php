<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    /*
    |
    |help_status
    |1=in queue
    |help_status = 1 and care_doctor_id!=0 in process with care doctor
    |2=contacted with patient by chatcare /broadcasted
    |help_status=2 and doctor_id != 0 doctor resonded
    |3=doctor ended the call
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

  }

  
  public function insert($insert_params)
  	{
  	  $this->m->port->p->insert('quickblox',$insert_params);
  	}

  public function get_login(){
    $this->m->port->p->select('login');
    $query = $this->m->port->p->get_where('quickblox',array('regid'=>$this->m->user_value('regid')));
    $login = null;
    foreach ($query->result() as $row){
      $login = $row->login;
    }
    return $login;
  }

  public function get_doctors(){
    $query = $this->m->port->p->get_where('quickblox',array('regid !='=>$this->m->user_value('regid'),'role'=>M::ROLE_DOCTOR,));
    $doctors = array();
    $temp = array();
    foreach ($query->result() as $row){
      $temp['id'] = $row->id;
      $temp['regid'] = $row->regid;
      $temp['name'] = $row->name;
      $temp['status'] = $row->status;
      $temp['lastlogin'] = $row->lastlogin;
      array_push($doctors, $temp);
    }
    return $doctors;
  }

  public function get_patients(){
    $query = $this->m->port->p->get_where('quickblox',array('regid !='=>$this->m->user_value('regid'),'role'=>M::ROLE_PATIENT,));
    $patients = array();
    $temp = array();
    foreach ($query->result() as $row){
      $temp['id'] = $row->id;
      $temp['regid'] = $row->regid;
      $temp['name'] = $row->name;
      $temp['status'] = $row->status;
      $temp['lastlogin'] = $row->lastlogin;
      array_push($patients, $temp);
    }
    return $patients;
  }

  /**
   *
   */


  /*
  |--------------------------------------------------------------------------
  | UPDATING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

  public function update($id, $update_params)
  {
    if (!$this->m->db_where('p', $id))
    {
      return FALSE;
    }

    $this->m->port->p->limit(1);

    $this->m->db_set('p', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->p->db_select();

    return $this->m->port->p->update('quickblox');

    //$this->m->port->p->db_select();
    //$this->m->port->p->update('quickblox',$id, $update_params);
  }

  /*
  |--------------------------------------------------------------------------
  | LOGOUT
  |--------------------------------------------------------------------------
  |
  |
  */

  public function logout(){
    $update_params = array('status'=>0,'logout_time'=>date('Y-m-d H:i:s'),);
    $this->m->port->p->where('regid',$this->m->user_value('regid'));
    return $this->m->port->p->update('quickblox',$update_params);
  }


  /*
  |--------------------------------------------------------------------------
  | Get Recent changed database
  |--------------------------------------------------------------------------
  |
  |
  */

  public function get_recent_doctors(){
    $query = $this->m->port->p->query('SELECT * FROM quickblox WHERE regid !=" '. $this->m->user_value('regid').'" and role ="'.M::ROLE_DOCTOR. '" and (lastlogin>date_sub(now(), Interval 11 second) OR logout_time>date_sub(now(),Interval 10 second))');
    $doctors = array();
    $temp = array();
    foreach ($query->result() as $row){
      $temp['id'] = $row->id;
      $temp['regid'] = $row->regid;
      $temp['name'] = $row->name;
      $temp['status'] = $row->status;
      array_push($doctors, $temp);
    }
    return $doctors;
  }

  public function get_recent_patients(){
    $query = $this->m->port->p->query('SELECT * FROM quickblox WHERE regid != "'. $this->m->user_value('regid').'" and role ="'.M::ROLE_PATIENT. '" and (lastlogin>date_sub(now(), Interval 11 second) OR logout_time>date_sub(now(),Interval 10 second))');
    $patients = array();
    $temp = array();
    foreach ($query->result() as $row){
      $temp['id'] = $row->id;
      $temp['regid'] = $row->regid;
      $temp['name'] = $row->name;
      $temp['status'] = $row->status;
      array_push($patients, $temp);
    }
    return $patients;
  }

	/*
 	|
 	|----------------------------------------------
 	|Insert into new chatservice table
 	|----------------------------------------------
 	|
 	*/
	public function insert_chatService($insert_params){
      $care_id=null;
      $date=date('Y-m-d H:i:s',strtotime("-30 minutes"));
      $this->m->port->p->select('id');
      $this->m->port->p->where('patient_id',$this->m->user_value('id'));
      $this->m->port->p->where('help_apply_time >',$date);
      $query=$this->m->port->p->get('care_chatservice',1);
      if($query->num_rows>0){
        foreach ($query->result() as $row) {
          $care_id=$row->id;
        }$query->result()->id;
        return $care_id;
      }else{
        $this->m->port->p->insert('care_chatservice',$insert_params);
        return $this->m->port->p->insert_id();
      }
 	}

 	public function update_service_status($id,$update_params){
 		$this->m->port->p->where('id',$id);
 		return $this->m->port->p->update('customer_service',$update_params);
 	}

 	

 	/*
	|get the list of patient for service from database who are not yet taken by any service person
	|
 	*/
 	public function get_patient_list(){
 		//$where = "care_doctor_id=".$this->m->user_value('id')." or care_doctor_id=0";
 		$query = $this->m->port->p->get_where('care_chatservice',array('care_doctor_id'=>0,));
    	$patients = array();
    	$temp = array();
    	foreach ($query->result() as $row){
    		$temp['id'] = $row->id;
    		$temp['name'] = $row->patient_name.' '.$row->patient_surname;
    		$temp['regid'] = $row->patient_regid;
    		$temp['address'] = $row->patient_address;
    		$temp['phone'] = $row->patient_phone;
    		$temp['apply_time'] = $row->help_apply_time;
    		array_push($patients, $temp);
    	}
    	usort($patients, function($a, $b) {
  			$ad = new DateTime($a['apply_time']);
  			$bd = new DateTime($b['apply_time']);
  			if ($ad == $bd) {
  			  return 0;
  			}
  			return $ad < $bd ? 1 : -1;
		});
    	return $patients;
 	}

  public function doctor_query_for_notification(){
    $this->m->port->p->select('d.id');
    $this->m->port->p->from('doctors as d');
    $this->m->port->p->join('care_chatservice as c','d.specialization1=c.specialization_id and d.specialization2=c.specialization_id');
    $this->m->port->p->where('d.id',$this->m->user_value('id'));
    $this->m->port->p->where('c.help_status',2);
    $query=$this->m->port->p->get();
    if($query->num_rows()){
      return 1;
    }else{
      return -1;
    }
  }

  /*
  |get the list of patient for service from database who are not yet taken by any service person
  |
  */
  public function get_patients_list_for_doctor(){
    $help_status=array('0','In queue','Broadcasted','Doctor responded',);
    $this->m->port->p->select('c.id, q.id as quickblox_id, c.patient_regid,c.patient_name, c.patient_surname, c.broadcast_init_time,c.doctor_id,c.help_status');
    $this->m->port->p->from('care_chatservice as c');
    $this->m->port->p->join('quickblox as q','q.regid = c.patient_regid');
    $this->m->port->p->where('c.help_status !=',1);
    $this->m->port->p->where_in('c.doctor_id',array($this->m->user_id(),0));
    $this->m->port->p->where_in('c.specialization_id',$this->m->user_value('specialization1'));
    //$this->m->port->p->or_where('c.doctor_id',0);
    $query = $this->m->port->p->get();
      $patients = array();
      $temp = array();
      foreach ($query->result() as $row){
        $temp['id'] = $row->id;
        $temp['quickblox_id'] = $row->quickblox_id;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['regid'] = $row->patient_regid;
        $temp['broadcast_time'] = $row->broadcast_init_time;
        $temp['doctor_id'] = $row->doctor_id;
        $temp['help_status'] = $help_status[$row->help_status];
        array_push($patients, $temp);
      }
      return $patients;
  }


 	

}

/* End of file videochat.php */
/* Location: ./application/modules/video/models/videochat.php */