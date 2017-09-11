<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mreservation extends CI_Model {

  public static $encrypted_fields = array();
  public static $plain_fields     = array('id', 'termin_id','doctor_id', 'patient_id', 'accept', 'read', 'archived', 'deleted', 'email', 'gender', 'first_name', 'last_name', 'telephone', 'insurance', 'insurance_provider', 'treatment', 'text_patient', 'text_notes', 'text_patient_notes', 'text_doctor_answer', 'wait','wait_status', );
  public static $datetime_fields  = array('start', 'end', );

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

    // Dependencies
  	$this->load->model('m');
  }

  /*
  |--------------------------------------------------------------------------
  | SELECTING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */
  public function get($value, $field = 'patient_id')
  {
  	if (is_array($value))
  	{
  		$condition = $value;
  	}
  	else
  	{
  		if (is_string($field))
  		{
  			$condition = array($field => $value, );
  		}
  		else
  		{
  			$condition = array('patient_id' => $value, ); 
  		}
  	}

  	if (count($condition) <= 0)
  	{
  		return array();
  	}

  	$ret = $this->m->get('dbat', 'reservations', $condition, self::$encrypted_fields, array('deleted' => 0, ));

  	if (count($ret) > 0)
  	{
  		foreach ($ret as $index => $row)
  		{
  			$query = $this->m->dbp->get_where('doctors', array('id' => $row->doctor_id), 1);

  			if ($query->num_rows() > 0)
  			{
  				$ret[$index]->doctor = $query->row();
  			}

  		}
  	}

  	return $ret;
  }

  /**
   *
   */
  public function get_inbox_reservations($value, $field = 'patient_id')
  {
  	return $this->get(array($field => $value, 'archived' => 0, ));
  }

  /**
   *
   */
  public function get_unaccepted_reservations($value, $field = 'patient_id')
  {
  	return $this->get(array($field => $value, 'archived' => 0, 'accept' => 0, ));
  }

  /**
   *
   */
  public function get_accepted_reservations($value, $field = 'patient_id')
  {
  	return $this->get(array($field => $value, 'archived' => 0, 'start >' => date('Y-m-d H:i:s'), 'accept' => 1, ));
  }

  /**
   *
   */
  public function get_past_reservations($value, $field = 'patient_id')
  {
  	return $this->get(array($field => $value, 'archived' => 0, 'start <=' => date('Y-m-d H:i:s'), 'accept' => 1, ));
  }

  /**
   *
   */
  public function get_archived_reservations($value, $field = 'patient_id')
  {
  	return $this->get(array($field => $value, 'archived' => 1, ));
  }

  /**
   *
   */
  public function get_cond_reservations($cond)
  {
  	$this->db->order_by('start');

  	$query = $this->db->get_where('reservations', $cond);

  	if ($query->num_rows() > 0)
  	{
  		$result = array();

  		foreach ($query->result() as $row)
  		{
  			if ($row->patient_id)
  			{
  				$row->patient = $this->mopat->get_id($row->patient_id);
  			}

  			if (isset($row->patient) && $row->patient)
  			{
  				$this->insurance_provider->user_inspro($row->patient);

  				$row->email = $row->patient->email;
  				$row->gender = $row->patient->gender;
  				$row->first_name = $row->patient->name;
  				$row->last_name = $row->patient->surname;
  				$row->telephone = $row->patient->telephone;
          // $row->insurance = $row->patient->insurance;

  				if (count($row->patient->inspro_assoc) > 0)
  				{
  					$row->insurance_provider = reset($row->patient->inspro_assoc)->name;
  				}
  				else
  				{
  					$row->insurance_provider = '';
  				}
  			}
  			else
  			{
  				if ($row->insurance_provider)
  				{
  					$providers = $this->insurance_provider->get_assoc();

  					if (isset($providers[$row->insurance_provider]) && $providers[$row->insurance_provider])
  					{
  						$row->insurance_provider = $providers[$row->insurance_provider]->name;
  					}
  					else
  					{
  						$row->insurance_provider = ''; 
  					}
  				}
  				else
  				{
  					$row->insurance_provider = ''; 
  				}
  			}

  			if (isset($row->treatment) && $row->treatment)
  			{
  				$split = explode(',', $row->treatment);
  				if (is_array($split) && count($split) > 0)
  				{
  					$specs_assoc = $this->speciality->get_assoc();

  					if (isset($specs_assoc[$split[0]]) && $specs_assoc[$split[0]])
  					{
  						$new_treatment = array();
  						$new_treatment[] = $specs_assoc[$split[0]]->name;

  						$treatment_assoc = isset($specs_assoc[$split[0]]->treatment) && is_array($specs_assoc[$split[0]]->treatment) ? $specs_assoc[$split[0]]->treatment : array();

  						foreach ($treatment_assoc as $treatment_row)
  						{
  							if ($treatment_row->code == $split[1])
  							{
  								$new_treatment[] = $treatment_row->name;
  							}                
  						}

  						$row->treatment = $new_treatment;

  					}

  				}

  			}

  			$result[] = $row;
  		}

  		return $result;
  	}
  	else
  	{
  		return array();
  	}
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
  	//$this->m->db_set('dbat', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

  	$this->m->port->b->insert('reservations',$insert_params);

  	return $this->m->port->b->insert_id();
  }

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
  	if (!$this->m->db_where('dbat', $id))
  	{
  		return FALSE;
  	}

  	$this->m->dbat->limit(1);

  	$this->m->db_set('dbat', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

  	return $this->m->dbat->update('reservation');
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
  public function delete($id)
  {
  	if (!$this->m->db_where('dbat', $id))
  	{
  		return FALSE;
  	}

  	$this->m->dbat->limit(1);

  	return $this->m->dbat->delete('reservation');
  }

  public function getReservation($condition,$limit='',$patient_view='1',$order_by_method='desc',$order_by_field='id')
  {

  	if (count($condition) <= 0)
  	{
  		return array();
  	}
  	if($limit!=''){
  		$ret = $this->m->get('b', 'reservations', $condition, self::$encrypted_fields, array('deleted' => 0, ),array('order_by_method' =>$order_by_method,'order_by_field'=>$order_by_field,'limit'=>$limit));

  	}else{
  		$ret = $this->m->get('b', 'reservations', $condition, self::$encrypted_fields, array('deleted' => 0, ),array('order_by_method' =>$order_by_method,'order_by_field'=>$order_by_field));
  	}
  	if (count($ret) > 0)
  	{
  		foreach ($ret as $index => $row)
  		{
  			if($patient_view==1){
  				$query = $this->m->port->p->get_where('doctors', array('id' => $row->doctor_id), 1);

  				if ($query->num_rows() > 0)
  				{
  					$ret[$index]->doctor = $query->row();
  				}

  			}else{
  				$query = $this->m->port->p->get_where('patients', array('id' => $row->patient_id), 1);

  				if ($query->num_rows() > 0)
  				{
  					$ret[$index]->patient = $query->row();
  				}



  			}

  		}
  	}
  	return $ret;
  }
  /**
   * [update the reservatione table when doctor accepted the appointment from doctor and 
   * also mask the appointment from doctor termin table for the appointment so termin wont be visible for all
   * if the accepted request is cancel then unmask the termin again]
   * @param  [type] $id            [reservation id]
   * @param  [type] $update_params [update the reservation table with passed parameter, accept]
   * @return [type]                [nothing]
   */
  public function updateReserv($id, $update_params)
  {
  	if(is_array($update_params) && array_key_exists('accept', $update_params) && $update_params['accept'] == 1){
  		$this->m->port->b->select('termin_id,doctor_id,start,end');
  		$mask_query = $this->m->port->b->get_where('reservations',array('id'=>$id,));
  		if($mask_query->num_rows()>0){
  			$mask_row                  = $mask_query->row();
        if($mask_row->termin_id != 0){   //insert the masking row in doctor termin if termin id is not equal to zero, reservation directly without creating termin
          $temp['doctor_id']         = $mask_row->doctor_id;
          $temp['ready']             = 1;
          $temp['repetitive']        = 0;
          $temp['mask']              = 1;
          $temp['mask_event_id']     = $mask_row->termin_id;
          $temp['allday']            = 1;
          $temp['period']            = 7;
          $temp['day']               = date('N',strtotime($mask_row->start));
          $temp['insurance_private'] = 0;
          $temp['insurance_public']  = 0;
          $temp['start']             = $mask_row->start;
          $temp['end']               = $mask_row->end;
          $temp['text_patient']      = '';
          $temp['text_notes']        = '';
          $temp['auto_termin']       = 0;  //1 denotes automatically created termin
          $this->m->port->b->insert('doctor_termins',$temp);
        }
	    }
	}
	else if(is_array($update_params) && array_key_exists('accept', $update_params) && $update_params['accept'] == 2){
		$this->m->port->b->select('termin_id,doctor_id,start,end');
  		$mask_query = $this->m->port->b->get_where('reservations',array('id'=>$id,));
  		if($mask_query->num_rows()>0){
  			$mask_row    = $mask_query->row();
  		}
		$this->m->port->b->where(array('doctor_id'=>$mask_row->doctor_id,'mask'=>1,'mask_event_id'=>$mask_row->termin_id,'start'=>$mask_row->start,'end'=>$mask_row->end));
		$this->m->port->b->delete('doctor_termins');
	} 
	$this->m->port->b->where('id',$id);
	return $this->m->port->b->update('reservations',$update_params);
}

public function getLatestReservation()
{
	static $_ci;
	if (empty($_ci)) $_ci =& get_instance();

	$result=  $this->m->role_diff(
		function() use ($_ci)
		{
			$this->m->port->p->db_select();
			$this->m->port->b->order_by('id','desc');
			$query = $this->m->port->b->get_where('reservations', array('doctor_id' =>$_ci->m->user_id(),'date(start)>=' => date('Y-m-d'),'accept' => 0),1);
			$result = $query->result();
			return $result;
		},
		function() use ($_ci)
		{
			$this->m->port->p->db_select();
			$this->m->port->b->order_by('id','desc');
			$query = $this->m->port->b->get_where('reservations', array('patient_id' =>$_ci->m->user_id(),'date(start)>=' => date('Y-m-d'),'accept' => 1),1);
			$result = $query->result();
			return $result;          
		}
		);
	if (count($result) > 0)
	{
		if ($this->m->user_role() == M::ROLE_DOCTOR)
		{
			$query=$this->m->port->p->get_where('patients', array('id' => $result[0]->patient_id),1);
			$userdetails=$query->result();

			$result[0]->regid=$userdetails[0]->regid;
		}
		else 
		{
			$query=$this->m->port->p->get_where('doctors', array('id' => $result[0]->doctor_id),1);
			$userdetails=$query->result();

			$result[0]->regid=$userdetails[0]->regid;
		}
	}

	return $result;
}


  /**
   * getting reservation table information
   */
  public function get_data($id)
  {
    $this->m->port->b->db_select();
    $result = $this->m->port->b->get_where('reservations', array('id' =>$id),1);
    $query4thisReserv = array();
    if($result->num_rows()>0){
      $result_row   = $result->row(); 
    
      $query4thisReserv['doctor_id']  = $result_row->doctor_id;
      $query4thisReserv['patient_id'] = $result_row->patient_id;
      $query4thisReserv['first_name'] = $result_row->first_name;
      $query4thisReserv['last_name']  = $result_row->last_name;
      $query4thisReserv['gender']     = $result_row->gender;
      $query4thisReserv['start']      = $result_row->start;
      $query4thisReserv['end']        = $result_row->end;
      $query4thisReserv['telephone']  = $result_row->telephone;
      $query4thisReserv['email']      = $result_row->email;
      
      return $result_row;
    }else
      return array();
  }

  /**
   *
   */

  /**
   * getting all reservation list by specific query after a patient cancel his appointment 
   */
  public function get_all_reserv($docOfThisID,$appointment_time)
  {
    //datetime to date convert
    //$datetime = '2013-08-14 11:45:45';
    //echo date("Y-m-d",strtotime($datetime)); 
    $start_date =  date("Y-m-d",strtotime($appointment_time));
    //echo $start_date;
    $query = $this->m->port->b->get_where('reservations', array('start'=> $start_date, 'doctor_id'=> $docOfThisID, 'wait'=> '1', 'wait_status'=> '0') );
    $query4allReserv = array();
    $query4allReserv_temp = array();

    foreach ($query->result() as $row){

    $query4allReserv_temp['reserv_id']  = $row->id;
    $query4allReserv_temp['doctor_id']  = $row->doctor_id;
    $query4allReserv_temp['patient_id'] = $row->patient_id;
    $query4allReserv_temp['first_name'] = $row->first_name;
    $query4allReserv_temp['last_name']  = $row->last_name;
    $query4allReserv_temp['gender']     = $row->gender;
    $query4allReserv_temp['start']      = $row->start;
    $query4allReserv_temp['end']        = $row->end;
    $query4allReserv_temp['telephone']  = $row->telephone;
    $query4allReserv_temp['email']      = $row->email;
    array_push($query4allReserv, $query4allReserv_temp);

    }
    return $query4allReserv;
  }

  /**
   *
   */

  /**
   * getting all reservation list by specific query after a patient cancel his appointment 
   */
  public function get_waiting_list($docOfThisID,$appointment_time)
  {
    $query = $this->m->port->b->get_where('waitinglist', array('wishdate'=> $appointment_time, 'doc_id'=> $docOfThisID, 'wishdate'=> $appointment_time, 'status'=>0) );
    
    $query4allwait = array();
    $query4allwait_temp = array();

    foreach ($query->result() as $row){

    $query4allwait_temp['id']         = $row->id;
    $query4allwait_temp['doc_id']     = $row->doc_id;
    $query4allwait_temp['pat_id']     = $row->pat_id;
    $query4allwait_temp['pat_email']  = $row->pat_email;
    $query4allwait_temp['status']     = $row->status;
    
    array_push($query4allwait, $query4allwait_temp);

    }
    return $query4allwait;
    
  }

  /**
   *
   */

  /*
  |--------------------------------------------------------------------------
  | INSERTING patient to waiting list
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */
  public function insert_wait($insert_params)
  {
    $this->m->db_set('b', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->b->db_select();

    $this->m->port->b->insert('reservations');

    return $this->m->port->b->insert_id();
  }
  
}

/* End of file mreservation.php */
/* Location: ./application/models/reservation/mreservation.php */