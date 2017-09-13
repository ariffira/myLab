<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpatient extends CI_Model {

  public static $encrypted_fields = array('owner_name', 'bankname', 'account_number', 'blz', );
  public static $plain_fields     = array('id', 'regid', 'pin', 'name', 'surname', 'birthname', 'gender', 'language', 'theme', 'address', 'zip', 'region', 'city', 'country', 'telephone', 'fax', 'mobile', 'email', 'password', 'package', 'profile_image', 'doctor_access', 'others_access', 'access_permission', 'private_access', 'emergency_name', 'emergency_telephone', 'family_doctor_name', 'family_doctor_telephone', 'family_doctor_id', 'family_doctor_list', 'hypercheck', 'diabetescheck', 'paincheck', 'illcheck', 'bmicheck', 'smokercheck', 'alcoholcheck', 'sportcheck', 'depressioncheck', 'family_heart_disease', 'sickcheck', 'family_cancer', 'healthscore', 'confirm_status', 'confirm_code', 'Pat_approv', 'emergency_doctor_id', 'payment_method', 'direct_debit', 'revocation', 'head_id', 'promocode', );
  public static $datetime_fields  = array('dob', 'cdate', );

  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  |
  |
  */

  public $patient;

  function __construct($redirect = TRUE)
  {
    // Call the Model constructor
    parent::__construct();

    // Dependencies
    $this->load->model('mgen');

    # Redirection

    if (!$this->session->userdata('user_id'))
    {
      if ($redirect)
      {
        redirect(base_url().'../../../apps/ia24portal/');
        exit();
      }
      else
      {
        return;
      }
    }

    $this->mgen->user_id = $user_id = $this->encrypt->decode($this->session->userdata('user_id')   ? $this->session->userdata('user_id') : 'ia24akte');
    $this->mgen->user_role = $user_role = $this->encrypt->decode($this->session->userdata('user_role') ? $this->session->userdata('user_role') : 'ia24akte');

    if ($user_role == 'patient')
    {
      $this->patient =& $this->get($user_id);

      $this->patient->user_id = $user_id;
      $this->patient->user_role = $user_role;

      $this->mgen->lang = $this->patient->language ? $this->patient->language : $this->mgen->lang;

      $this->mgen->theme = $this->patient->theme ? $this->patient->theme : $this->mgen->theme;
    }
  }


//faisal

    public function get_upload_path($row, $role = "patient")
  {
    return './protected/uploads/profile_image/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($row->patient_id)).'/';
  }

  /**
   *
   */
  public function image_upload($id, $role = "patient", $upload_field = "document_upload")
  {
    $config = array();

    $config['upload_path'] = './protected/uploads/profile_image/';
    $config['encrypt_name'] = TRUE;
    $config['allowed_types'] = 'jpg|png|jpeg|tif|gif';
    $config['max_size'] = '2048000';
    $config['remove_spaces'] = true;
    $config['overwrite'] = FALSE;
    $config['max_width']  = '';
    $config['max_height']  = '';

    if (!file_exists($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, true);
    }

    $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
    $this->load->helper('file');
    write_file($config['upload_path'].'index.html', $permission_string);

    
    $this->load->library('upload', $config);
    //$this->upload->initialize($config);
    //echo $id;

    if ($this->upload->do_upload($upload_field))
    {
      //echo "second check";
      $data = $this->upload->data();

      //echo "second check";

      $extension     = str_replace('.', '', $data['file_ext']);
      $file_name     = ($ext_pos = strrpos($data['file_name'], '.'.$extension)) !== FALSE ? substr_replace($data['file_name'], '', $ext_pos, strlen('.'.$extension)) : $data['file_name'];
      $pro_img = $file_name.$data['file_ext'];

      return $this->photo_update($id,array(
        //'id'                 => $id, 
        'profile_image'      => $pro_img, 
      ));

    }
    else
    {
      //echo $this->upload->display_errors();
      $error = (object)array('error' => $this->upload->display_errors());
      return $error;
    }
  }

  //faisal
  public function &get($id)
  {
    # get patient values
    $query = $this->mgen->dbp->get_where('patients', array('id' => $id), 1);
    $pat = $query->num_rows() > 0 ? $query->row() : new stdClass();

    # patient profile image
    if (isset($pat->profile_image) && $pat->profile_image) {
      $file_path = base_url("/protected/uploads/profile_image/{$pat->profile_image}");
      $file_headers = @get_headers($file_path);

      if($file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
        $pat->profile_image_path = base_url("protected/patients/profile_image/no-image.jpg");
      } else {
        $pat->profile_image_path = $file_path;
      }
    } else {
      $pat->profile_image_path = base_url("protected/patients/profile_image/no-image.jpg");
    }

    # Encrypted values
    foreach (array('owner_name', 'account_number', 'bankname', 'blz') as $field) {
      $pat->$field = $this->aes_encrypt->de($pat->$field);
    }

    return $pat;
  }


    /**
   *
   */
  public function by_regid($regid)
  {
    $query = $this->mgen->dbp->get_where('patients', array('regid' => $regid, ));
    return $query->num_rows() > 0 ? $query->row() : (new stdClass());
  }


  /**
   *
   */
  public function my_doctors($value, $field = 'my_doctors.patient_id')
  {
    if (is_array($value))
    {
      $condition = $value;
    }
    else
    {
      $condition = array($field => $value, );
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    # Get my doctors
    $this->mgen->dbp->select("
      `doctors`.`name`,
      `doctors`.`surname`,
      `doctors`.`city`,
      AES_DECRYPT(`my_doctors`.`doctor_id`, '{$this->mgen->db_key}') AS `doctor_id`,
      `my_doctors`.`id`,
      `my_doctors`.`access_rights`",
      FALSE);
    $this->mgen->dbp->from("my_doctors");
    $this->mgen->dbp->join("doctors", "my_doctors.doctor_inserted_id = doctors.id", 'inner');

    foreach ($condition as $field => $value)
    {
      $this->mgen->dbp->where($field, $value);
    }

    $query = $this->mgen->dbp->get();

    return $query->num_rows() > 0 ? $query->result() : array();
  }

  /**
   *
   */
  public function my_doctors_insert($insert_params)
  {
    $this->load->model('doctors/mdoctor');
    $doctor = $this->mdoctor->by_regid($insert_params['doctor_id']);

    if (!isset($doctor->id) || !$doctor->id)
    {
      return FALSE;
    }

    $query = $this->mgen->dbp->get_where('my_doctors', array('patient_id' => $insert_params['patient_id'], 'doctor_inserted_id' => $doctor->id, ), 1);

    if ($query->num_rows() > 0)
    {
      return $query->row()->doctor_inserted_id;
    }

    $insert_params['doctor_inserted_id'] = $doctor->id;

    $this->mgen->db_set('dbp', $insert_params, array('id', 'patient_id', 'doctor_inserted_id', 'access_rights', ), array('date_added', ), array('doctor_id', 'doctor_name', ));

    $this->mgen->dbp->insert('my_doctors');

    return $this->mgen->dbp->insert_id();
  }

  
  /**
   *
   */
  public function my_doctors_update($id, $update_params)
  {
    if (!$this->mgen->db_where('dbp', $id, array('doctor_id', 'doctor_name', ), array()))
    {
      return FALSE;
    }

    $this->mgen->dbp->limit(1);

    $this->mgen->db_set('dbp', $update_params, array('id', 'patient_id', 'doctor_inserted_id', 'access_rights', ), array('date_added', ), array('doctor_id', 'doctor_name', ));

    return $this->mgen->dbp->update('my_doctors');
  }

  /**
   *
   */
  public function my_doctors_delete($id)
  {
    if (!$this->mgen->db_where('dbp', $id, array('doctor_id', 'doctor_name', ), array()))
    {
      return FALSE;
    }

    $this->mgen->dbp->limit(1);

    return $this->mgen->dbp->delete('my_doctors');
  }

  /**
   *
   */
  public function all_access($patient_id)
  {
    $permission = $this->input->post('access');

    if (is_numeric($permission) && in_array($permission, array('0', '1', '2', ))) {

      $this->mgen->dbp->set('access_permission', $permission);
      $this->mgen->dbp->where('id', $patient_id);

      $update_query = $this->mgen->dbp->update('patients');

      if ($update_query) {
       
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('medical_condition');

        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('diagnoses');

        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('medication');

        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('vaccination');
    
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('heart_frequency');
        
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('weight_bmi');
        
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('blood_sugar');
        
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('marcumar');
        
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('iconsult');
             
        $this->mgen->dbm->set('access_permission', $permission);
        $this->mgen->dbm->where('patient_id', $patient_id);
        $this->mgen->dbm->update('patients_files');

        return TRUE;
      }
    }
  }

  /**
   *
   */
  public function health_score($patient_id)
  {
    $query = $this->mgen->dbp->get_where('patients', array('id' => $patient_id, ), 1);

    if ($query->num_rows() > 0) {
      $row = $query->row();

      # For calculating BMI 
      $this->mgen->dbm->select('patient_id, bmi');
      $this->mgen->dbm->from('weight_bmi');
      $this->mgen->dbm->where('patient_id', $patient_id);
      $this->mgen->dbm->order_by('date_added', 'desc');

      $bmi_query = $this->mgen->dbm->get();

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
      $this->mgen->dbm->select('patient_id, bloodsugar');
      $this->mgen->dbm->from('blood_sugar');
      $this->mgen->dbm->where('patient_id', $patient_id);
      $this->mgen->dbm->order_by('date_added', 'desc');

      $bloodsugar_query = $this->mgen->dbm->get();

      $bloodsugar_row   = $bloodsugar_query->num_rows() > 0 ? $bloodsugar_query->row() : array();

        # Calculate bloodsugar score
      if($bloodsugar_row && $bloodsugar_row->bloodsugar < 110) {$BloodSugarScore = '200';}  
      else { $BloodSugarScore = '0'; }
      if(!$bloodsugar_row ) { $BloodSugarScore = '0'; }

      # For calculating Bloodpressure
      $this->mgen->dbm->select('patient_id, rr_sys');
      $this->mgen->dbm->from('heart_frequency');
      $this->mgen->dbm->where('patient_id', $patient_id);
      $this->mgen->dbm->order_by('date_added', 'desc');

      $bloodpressure_query = $this->mgen->dbm->get();

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

  /*
  |--------------------------------------------------------------------------
  | PROFILE UPDATING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */
  public function profile_update($id, $update_params)
  {
    if (!$this->mgen->db_where('dbp', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->mgen->dbp->limit(1);

    $this->mgen->db_set('dbp', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->mgen->dbp->update('patients');
  }


  /**
   *
   */
  public function photo_update($id, $update_params)
  {
    if (!$this->mgen->db_where('dbp', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->mgen->dbp->limit(1);

    $this->mgen->db_set('dbp', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->mgen->dbp->update('patients');
  }



}

/* End of file mpatient.php */
/* Location: ./application/models/patients/mpatient.php */