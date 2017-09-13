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
  public function set_new_password()
  {
    $id              = $this->m->user_id();
    $password_old    = $this->input->post('password');
    $password_new    = $this->input->post('password1');
    $password_repeat = $this->input->post('password2');

    if ($password_new !== $password_repeat)
    {
      return FALSE;
    }

    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('patients', array('id' => $id, 'temp_pass' => $password_old, ), 1);
    
    if ($query->num_rows() <= 0)
    {
      return FALSE;
    }

    $this->m->port->p->set('password', md5($password_new));
    $this->m->port->p->set('temp_pass', '' );
    $this->m->port->p->where('id', $id);
    $this->m->port->p->update('patients');
    return TRUE;
  }
    /**
   *
   */
  public function force_new_password()
  {
   
    $id              = $this->m->user_id();
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
    $this->m->port->p->set('password', md5($password_new));
    $this->m->port->p->set('force_login', '1' );
    $this->m->port->p->where('id',$id);
    $this->m->port->p->update('patients');
  
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



}




/* End of file mopat.php */
/* Location: ./application/models/mopat.php */