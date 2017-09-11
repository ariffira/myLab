<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mopat extends CI_Model {


  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function get_id($id)
  {
    $this->m->port->p->db_select();

    $query = $this->m->port->p->get_where('patients', array('id' => $id, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();
      $row->name_combine = $row->name.' '.$row->surname;
      $ci =& get_instance();
      $ci->language->user_langs($row);
      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_regid($regid)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->where('regid', $regid);

    $query = $this->m->port->p->get('patients');

    if ($query->num_rows() > 0)
    {
      return $this->get_id($query->row()->id);
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_doctors($patient_id = NULL)
  {
    if ($patient_id === NULL)
    {
      if ($this->m->user_role() == M::ROLE_PATIENT)
      {
        $patient_id = $this->m->user_id();
      }
      else
      {
        return array();
      }
    }

    # Get my doctors
    $this->m->port->p->select("`d`.`name`, `d`.`surname`, `d`.`city`, `d`.`regid`, `myd`.`id`, `myd`.`access_rights`", FALSE);
    $this->m->port->p->from("my_doctors AS myd");
    $this->m->port->p->join("doctors AS d", "myd.doctor_inserted_id = d.id", 'inner');
    $this->m->port->p->where("myd.patient_id", $patient_id);
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get();

    return $query->result();
  }

  /**
   *
   */
  
   /**
   *
   */
  public function get_doctorsconnet($limit=null)
  {
    # Get my doctors
//      $result=array();
      if($limit){
          $limit="limit 0,$limit";
      }
      else{
          $limit="";
      }
     
      $query=  $this->m->port->p->query("select  `d`.`name`, `d`.`surname`,`d`.`email`,`d`.`telephone`,`d`.`profile_image`, `d`.`city`, `d`.`regid`,connect.* from (SELECT `c`.*,
(case 
    when (`c`.`sender_id`='".$this->m->user_id()."') then 
	`c`.`receiver_id`
    else `c`.`sender_id`
end
) as join_id
  FROM `doctors_connect` as `c` where (`c`.`delete_status`='0') and ( `c`.`receiver_id`='".$this->m->user_id()."' or `c`.`sender_id`='".$this->m->user_id()."')  ) as `connect` join doctors as d on connect.join_id=d.id   order by date_added $limit");
//        $this->m->port->p->('select `d`.`name`, `d`.`surname`, `d`.`city`, `d`.`regid`, `dc`.* from ( select * from doctors_connect as con where  con.sender_id or con.receiver_id = '.$this->m->user_id()) AS dc inner join doctors AS d
//            on 
//        ')
//    $this->m->port->p->select("`d`.`name`, `d`.`surname`, `d`.`city`, `d`.`regid`, `dc`.`id`", FALSE);
//    $this->m->port->p->from("doctors_connect AS dc");
//    $this->m->port->p->join("doctors AS d", "dc.receiver_id = d.id", 'inner');
//    $this->m->port->p->where("dc.sender_id", $this->m->user_id());
//    $this->m->port->p->db_select();
//    $query = $this->m->port->p->get();
//     if($query->num_rows()>0){
//          $result['sends']= $query->result();
//    }
//    
//    $this->m->port->p->select("`d`.`name`, `d`.`surname`, `d`.`city`, `d`.`regid`, `dc`.`id`", FALSE);
//    $this->m->port->p->from("doctors_connect AS dc");
//    $this->m->port->p->join("doctors AS d", "dc.sender_id = d.id", 'inner');
//    $this->m->port->p->where("dc.receiver_id", $this->m->user_id());    
//    $this->m->port->p->or_where("dc.receiver_id", $this->m->user_id());
//    $this->m->port->p->db_select();
//    $query = $this->m->port->p->get();
    if($query->num_rows()>0){
         return $query->result();
//          return $query->result();
    }
  else{
        return array();
  }
  }

  /**
   *
   */ 
  
  public function health_score($patient_id = NULl)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (empty($patient_id) && !($patient_id = $this->m->role_diff(function() use ($_ci) {
        if (!$_ci->m->us_id())
        {
          return 0;
        }
        return $_ci->m->us_id();
      }, function() use ($_ci) {
        return $_ci->m->user_id();
      } ) ) ) return 0;

    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('patients', array('id' => $patient_id, ), 1);

    if ($query->num_rows() > 0) {
      $row = $query->row();

      # For calculating BMI 
      $this->m->port->m->select('patient_id, bmi');
      $this->m->port->m->from('weight_bmi');
      $this->m->port->m->where('patient_id', $patient_id);
      $this->m->port->m->order_by('date_added', 'desc');

      $this->m->port->m->db_select();
      $bmi_query = $this->m->port->m->get();

      $bmi_row   = $bmi_query->num_rows() > 0 ? $bmi_query->row() : array();

        # Calculate the BMI score    
      if($bmi_row && $bmi_row->bmi >= 40                     ) { $BMIScore = '0'; }
      if($bmi_row && $bmi_row->bmi >= 35 && $bmi_row->bmi< 40) { $BMIScore = '100'; }
      if($bmi_row && $bmi_row->bmi >= 30 && $bmi_row->bmi< 35) { $BMIScore = '200'; }
      if($bmi_row && $bmi_row->bmi >= 25 && $bmi_row->bmi< 30) { $BMIScore = '300'; }
      if($bmi_row && $bmi_row->bmi >= 19 && $bmi_row->bmi< 25) { $BMIScore = '400'; }
      if($bmi_row && $bmi_row->bmi < 19                      ) { $BMIScore = '0'; }
      if(!$bmi_row )                                           { $BMIScore = '0'; }

      # For calculating bloodsugar  
      $this->m->port->m->select('patient_id, bloodsugar');
      $this->m->port->m->from('blood_sugar');
      $this->m->port->m->where('patient_id', $patient_id);
      $this->m->port->m->order_by('date_added', 'desc');

      $this->m->port->m->db_select();
      $bloodsugar_query = $this->m->port->m->get();

      $bloodsugar_row   = $bloodsugar_query->num_rows() > 0 ? $bloodsugar_query->row() : array();

        # Calculate bloodsugar score
      if($bloodsugar_row && $bloodsugar_row->bloodsugar < 110) {$BloodSugarScore = '200';}  
      else { $BloodSugarScore = '0'; }
      if(!$bloodsugar_row ) { $BloodSugarScore = '0'; }

      # For calculating Bloodpressure
      $this->m->port->m->select('patient_id, rr_sys');
      $this->m->port->m->from('heart_frequency');
      $this->m->port->m->where('patient_id', $patient_id);
      $this->m->port->m->order_by('date_added', 'desc');

      $this->m->port->m->db_select();
      $bloodpressure_query = $this->m->port->m->get();

      $bloodpressure_row   = $bloodpressure_query->num_rows() > 0 ? $bloodpressure_query->row() : array();

       # Calculate bloodpressure
      if($bloodpressure_row && $bloodpressure_row->rr_sys >= 180                                   ) { $BPScore = '0'; }    
      if($bloodpressure_row && $bloodpressure_row->rr_sys >= 160 && $bloodpressure_row->rr_sys< 180) { $BPScore = '25'; }    
      if($bloodpressure_row && $bloodpressure_row->rr_sys >= 140 && $bloodpressure_row->rr_sys< 160) { $BPScore = '50'; }    
      if($bloodpressure_row && $bloodpressure_row->rr_sys >= 130 && $bloodpressure_row->rr_sys< 140) { $BPScore = '100'; }    
      if($bloodpressure_row && $bloodpressure_row->rr_sys >= 120 && $bloodpressure_row->rr_sys< 130) { $BPScore = '250'; }
      if($bloodpressure_row && $bloodpressure_row->rr_sys < 120                                    ) { $BPScore = '500'; }
      if(!$bloodpressure_row  ) { $BPScore = '0'; }


      return $health_score = $row->healthscore + $BMIScore + $BloodSugarScore + $BPScore;
    }

    return 0;
  }

  /**
   *
   */
  public function get_data($email)
  {
    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('patients', array ('email' => $email,),1 );
    $result_row   = $result->row(); 
    $user_result['regid'] = $result_row->regid;
    $user_result['p1_userid'] = $result_row->p1_userid;
    $user_result['name'] = $result_row->name;
    $user_result['surname'] = $result_row->surname;
    $user_result['gender'] = $result_row->gender;
    $user_result['pin'] = $result_row->pin;
    $user_result['confirm_code'] = $result_row->confirm_code;
    $user_result['temp_pass'] = $result_row->temp_pass;
    $user_result['email'] = $result_row->email;
    
    return $user_result;
  }

  /**
   *
   */
  public function patient_validate_email($email,$email_code)  {

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('patients', array ('email' => $email,'confirm_code' => $email_code,) );
            
    if ($result->num_rows() === 1) {
      $this->m->port->p->set('confirm_status', 1);
      $this->m->port->p->where('email', $email);
      $this->m->port->p->update('patients');

      return TRUE;
    }

    else {
      return FALSE;
    }
  } 

  /**
   *
   */
  public function pass_reset_validation($email)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->set('confirm_code'  , $confirm_code = random_string('alnum', 16) );
    $this->m->port->p->set('temp_pass'  , $temp_pass = random_string('alnum', 16) );
    $this->m->port->p->where('email', $email);

    if ($this->m->port->p->update('patients')) {
      return TRUE;
    }

    else{
      return FALSE;
    }
  }

  /**
   *
   */
  public function set_new_password($password_field='password')
  {
    $id              = $this->m->user_id();
    $email           = $this->input->post('email');
    $password_old    = $this->input->post('oldpassword');
    $password_new    = $this->input->post('newpassword');
    $password_repeat = $this->input->post('confirmpassword');

     if($password_new != $password_repeat)
     {
       echo "Password and confirm password not matched.";
       return FALSE;
     }

     $this->m->port->p->db_select();
     $conditions = array();
     if(!empty($id))
     	$conditions['id'] = $id;
     	
     if(!empty($email))
     	$conditions['email'] = $email;

     if(empty($conditions))
     {
     	echo "Unable to update your password. Please try again later.";
       	return FALSE;
     }

     if($password_field=='password')
     	$conditions[$password_field] = md5($password_old);
     else 
	     $conditions[$password_field] = $password_old;

     $query = $this->m->port->p->get_where('patients', $conditions, 1);
     
     if ($query->num_rows() <= 0)
     {
     	echo "Old password not matched.";
       	return FALSE;
     }

     $this->m->port->p->set('password', md5($password_new));
     $this->m->port->p->set('temp_pass', '' );
     
     if(!empty($id))
     	 $this->m->port->p->where('id', $id);
     	
     if(!empty($email))
     	 $this->m->port->p->where('email', $email);
     
     $this->m->port->p->update('patients');

     return TRUE;
  }
    /**
   *
   */
  public function force_new_password()
  {
       $user_details=$this->session->userdata('force_change');
      if(isset($user_details) && !empty($user_details) && count($user_details) && is_array($user_details)){
          $this->session->unset_userdata('force_change');
          $id_session=$this->input->post('id');
          if(isset($id_session) && !empty($id_session) && $id_session==$user_details['id']){
            $id=$this->input->post('id');
        }
        else{
           $id              = $this->m->user_id();
        }
      }
   else{
         $id              = $this->m->user_id();
   }
  
    $password_old    = md5($this->input->post('password3'));
    $password_new    = $this->input->post('password');
    $password_repeat = $this->input->post('password2');
    if ($password_new !== $password_repeat)
    {
      return FALSE;
    }
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('patients', array('id' => $id,'password' => $password_old, ), 1);
   
    if ($query->num_rows() <= 0)
    {
      return FALSE;
    }
    $current_date_time = date("Y-m-d h:i:s");
    $this->m->port->p->set('password', md5($password_new));
    $this->m->port->p->set('force_login', '1' );
    $this->m->port->p->set('last_password_change_date',$current_date_time);
    $this->m->port->p->where('id',$id);
    $this->m->port->p->update('patients');
  
    return TRUE;
  }
  /*
   *  forced new password for doctor
   */
   public function force_new_password_doctor()
  {
       $user_details=$this->session->userdata('force_change');
      if(isset($user_details) && !empty($user_details) && count($user_details) && is_array($user_details)){
          $this->session->unset_userdata('force_change');
          $id_session=$this->input->post('id');
          if(isset($id_session) && !empty($id_session) && $id_session==$user_details['id']){
            $id=$this->input->post('id');
        }
        else{
           $id              = $this->m->user_id();
        }
      }
   else{
         $id              = $this->m->user_id();
   }
    $password_old    = md5($this->input->post('password3'));
    $password_new    = $this->input->post('password');
    $password_repeat = $this->input->post('password2');
 
    if ($password_new !== $password_repeat)
    {
      return FALSE;
    }
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('doctors', array('id' => $id,'password' => $password_old, ), 1);
   
    if ($query->num_rows() <= 0)
    {
      return FALSE;
    }
    $current_date_time = date("Y-m-d h:i:s");
    $this->m->port->p->set('password', md5($password_new));
    $this->m->port->p->set('last_password_change_date',$current_date_time);
    $this->m->port->p->where('id',$id);
    $this->m->port->p->update('doctors');
  
    return TRUE;
  }
  
  /**
   *
   */
  public function email_reset_validation($email)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->set('confirm_code'  , $confirm_code = random_string('alnum', 16) );
    //$this->m->port->p->set('temp_pass'  , $temp_pass = random_string('alnum', 16) );
    $this->m->port->p->where('email', $email);

    if ($this->m->port->p->update('patients')) {
      return TRUE;
    }

    else{
      return FALSE;
    }
  }

  public function update_records($id,$update_data)
  {
    $this->m->port->p->db_select();
    return $this->m->port->p->update('patients',$update_data,$id);
  }
/*** it's use for fecthing security question***/
  public function security_question()
  {
    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('security_question', array ('status' => 'Y',));
    $result   = $result->result(); 
   return $result;
  }
/****end here***/
/*** it's use for fecthing security question***/
 public function security_answer()
 {
     /* $result = $this->m->port->p->get_where('security_answer', array ('status' => 'Y',));*/
     $this->m->port->p->db_select();
     $security_question = $this->input->post('security_question_id');
     $security_question_id=(implode(',',$security_question));
     $answers=$this->input->post('answer');
     $answer=implode(',',$answers);
     
     if($this->m->user_role()=='')
     {
     	redirect('akte');
     }
     else if($this->m->user_role()=='role_doctor')
     {
      $this->m->port->p->set('answer',$answer);
      $this->m->port->p->set('userid', $this->m->user_id());
      $this->m->port->p->set('user_role',$this->m->user_role());
      $this->m->port->p->set('added_date', 'NOW()');
      $this->m->port->p->set('security_question_id', $security_question_id);
       if ($success = $this->m->port->p->insert('security_answer')) 
      {
      $answer_id = $this->m->port->p->insert_id();
        $this->m->port->p->set('security_answer_id',$answer_id);
        $this->m->port->p->where('id',$this->m->user_id());
        $this->m->port->p->update('doctors');
        return true;
      }
       else
      {
          return false;
      }
     }
      else
     {
      $this->m->port->p->set('answer', $answer);
      $this->m->port->p->set('userid',$this->m->user_id());
      $this->m->port->p->set('user_role',$this->m->user_role());
      $this->m->port->p->set('added_date', 'NOW()');
      $this->m->port->p->set('security_question_id',$security_question_id);
       if ($success = $this->m->port->p->insert('security_answer')) 
      {
        $answer_id = $this->m->port->p->insert_id(); 
        $this->m->port->p->set('security_answer_id',$answer_id);
        $this->m->port->p->where('id',$this->m->user_id());
        $this->m->port->p->update('patients');
        return true;
      }
       else
      {
        return false;     
      }
     }
 }
 
	/*
     * Function for doctor search
     */
	public function get_doctordetails($search = NULL) {
        $this->m->port->p->select("*", FALSE);
        $this->m->port->p->from("doctors");
        if (!empty($search)) {
            $this->m->port->p->like('regid', $search);
            $this->m->port->p->or_like('name', $search);
            $this->m->port->p->or_like('surname', $search);
            $this->m->port->p->or_like("lower(CONCAT(name, ' ', surname))", strtolower($search));
        }
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get();
        $AllDoctors = $query->result();

        $MyDoctors = $this->get_doctors($this->m->user_id());
       
        foreach ($AllDoctors as $key=>$value) {
        	$regid = $value->regid;
	        foreach ($MyDoctors as $val) {
	        	if($val->regid==$regid)
	        	{
	        		unset($AllDoctors[$key]);
	        	}
	        }	
        }

        return $AllDoctors;
    }

     /**
     *
     */
    public function get_info($id)
    {
      $this->m->port->p->db_select();
      $result = $this->m->port->p->get_where('patients', array ('id' => $id,),1 );
      $result_row   = $result->row(); 
      //$user_result->email = $result_row->email;      
      return $result_row;
    }


/****end here***/
}




/* End of file mopat.php */
/* Location: ./application/models/mopat.php */