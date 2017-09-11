<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mvideochat extends CI_Model {

  const STATUS_OPENED        = 1;
  const STATUS_CLOSED        = 0;
  const STATUS_RUNNING       = 2;

  public static $encrypted_fields = array( );
  public static $plain_fields     = array('id', 'name', 'role', 'regid','login','status', );
  public static $datetime_fields  = array('lastlogin', );

  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  |
  |
  */

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

  }

  /*
  |--------------------------------------------------------------------------
  | SELECTING
  |--------------------------------------------------------------------------
  |
  |
  */

  public function get_valid_id($receiver){


    $curr = date('Y-m-d H:i:s');
    $last_min = date('Y-m-d H:i:s', strtotime('-90 seconds'));

    $this->m->port->p->db_select();
    $this->m->port->p->from('videochat');
    $this->m->port->p->where('callto', $receiver);
    $this->m->port->p->where('call_status', 1);
    $this->m->port->p->where('calltime >=', $last_min);
    $this->m->port->p->where('calltime <=', $curr);
    $this->m->port->p->order_by('calltime', 'asc');
    $result = $this->m->port->p->get();
    if ($result->num_rows() > 0) {

        $result_row   = $result->row(); 
        $call_id  = $result_row ->id;
        return $call_id;
    } else {
        return 0;
    }

    /*
    $this->m->port->p->db_select();
    $query1 = $this->m->port->p->get_where('videochat', array('callto' => $receiver, 'call_status' => 1, ));
    //var_dump($query1) ;
    if ($query1->num_rows() > 0)
    {
      foreach ($query1->result() as $row) {
        //$result_row   = $query1->row(); 
        $call_result  = $row->calltime;
        if(time() - strtotime($call_result) < 90) {
          $call_id  = $row->id;
          return $call_id;
        }
        else {
          $call_id  = 0;
         } 
      }
      return $call_id;
    }

    else {
      return 0;
    }

  */
  }




  public function valid_status($receiver){

    $this->m->port->p->db_select();
    $this->m->port->p->order_by('calltime', 'desc');
    $result = $this->m->port->p->get_where('videochat', array('callto' => $receiver, 'call_status' => 1,  ),1 );
    if ($result->num_rows() > 0)
    {
     // $result_row   = $result->last_row(); 
      //$from_time = strtotime($result_row->calltime);
      //if (time() - $from_time < 90) {
        return 1;
      //}

    }
    else {
      return 0;
    }
  }

  /**
   *
   */

  public function get_info($id){

    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('videochat', array('id' => $id,),1  );
    return $query->result();
    //$result_row   = $result->row(); 
    //$call_result  = $result_row->conferenceId;

    //return $call_result;
  }



  public function get_confId($id){

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('videochat', array('id' => $id,),1  );
    $result_row   = $result->row(); 
    $call_result  = $result_row->conferenceId;

    return $call_result;
  }


  /**
   *
   */

  public function get_receiver_confId($receiver){

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('videochat', array('callto' => $receiver, 'call_status' => 1,),1  );
    $result_row   = $result->row(); 
    $call_result  = $result_row->conferenceId;

    return $call_result;
  }
 


  /**
   *
   */


  public function get_sessionId($id){

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('videochat', array('id' => $id,),1  );
    $result_row   = $result->row(); 
    $call_result  = $result_row->sessionId;

    return $call_result;
  }


  /*
  |--------------------------------------------------------------------------
  | INSERTING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

  public function insert($insert_params)
  {
    // $this->m->db_set('p', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    // $this->m->port->p->insert('videochat');

    // return $this->m->port->p->insert_id();
    
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
  |--------------------------------------------------------------------------
  | DELETE
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

 
 /*
 |
 |----------------------------------------------
 |Insert into new chatservice table
 |----------------------------------------------
 |
 */

 public function insert_chatService($insert_params){
    $service_id = null;
    /*
    |service_status
    |1=busy
    |2=not busy
    |3=not on duty
    |
    |help_status
    |1=in queue
    |2=in process
    |3=completed
    */
    //select not busy servicperson
    $service = $this->m->port->p->query('select id from customer_service where status=2 limit 1'); 
    if($service->num_rows()>0){
      foreach ($service->result() as $row) {
        $service_id = $row->id;
      }
      $this->update_service_status($service_id, array('status'=>1));   //change the status to busy
    }else{//select the service person with less count of patient on queue
      $query = $this->m->port->p->query('select service_id, count(service_id) as count from care_chatservice where help_status = 1 group by service_id order by count asc limit 1');
    
      if($query->num_rows()>0){
        foreach ($query->result() as $row) {
          $service_id = $row->service_id;
        }
      }
    }

    $insert_params = array_merge($insert_params, array('service_id'=>$service_id,));
    $this->m->port->p->insert('care_chatservice',$insert_params);
  }

  public function update_service_status($id,$update_params){
    $this->m->port->p->where('id',$id);
    return $this->m->port->p->update('customer_service',$update_params);
  }

}

/* End of file miconsult.php */
/* Location: ./application/models/diagnosis/miconsult.php */