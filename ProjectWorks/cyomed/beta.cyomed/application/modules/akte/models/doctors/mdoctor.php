<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdoctor extends CI_Model {

  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  |
  |
  */
  public static $encrypted_fields = array('password', 'confirm_code');
  public static $plain_fields     = array('id', 'regid', 'pin', 'name', 'surname', 'academic_grade', 'address', 'language', 'theme', 'website', 'zip', 'region', 'city', 'country', 'telephone', 'fax', 'mobile', 'email', 'emergency_number', 'specialization1', 'specialization2', 'profile_image', 'additional_title1', 'additional_title2', 'additional_title3', 'uploads', 'confirm_status', 'iconsult_status', 'Dr_approv',  'confirm_code',  );
  public static $datetime_fields  = array('cdate', );

  public $doctor;
  public $pat_id;
  public $patient;
  public $access;

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
        redirect(base_url().'../../../ia24at/');
        exit();
      }
      else
      {
        return;
      }
    }

    $this->mgen->user_id = $user_id = $this->encrypt->decode($this->session->userdata('user_id')   ? $this->session->userdata('user_id') : 'ia24akte');
    $this->mgen->user_role = $user_role = $this->encrypt->decode($this->session->userdata('user_role') ? $this->session->userdata('user_role') : 'ia24akte');

    if ($user_role == 'doctor')
    {
      $this->doctor =& $this->get($user_id);

      $this->doctor->user_id = $user_id;
      $this->doctor->user_role = $user_role;

      $this->mgen->lang = $this->doctor->language ? $this->doctor->language : $this->mgen->lang;

      $this->mgen->theme = $this->doctor->theme ? $this->doctor->theme : $this->mgen->theme;
    }
  }

  public function get_upload_path($row, $role = "doctor")
  {
    return './protected/uploads/profile_image/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($row->patient_id)).'/';
  }

  /**
   *
   */
  public function image_upload($id, $role = "doctor", $upload_field = "document_upload")
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




  public function &get($id)
  {
    # get doctor values
    $query = $this->mgen->dbp->get_where('doctors', array('id' => $id), 1);
    $doc = $query->num_rows() > 0 ? $query->row() : new stdClass();

    # doctor profile image
    if (isset($doc->profile_image) && $doc->profile_image) {
      $file_path = base_url("/protected/uploads/profile_image/{$doc->profile_image}");
      $file_headers = @get_headers($file_path);

      if($file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
        $doc->profile_image_path = base_url("protected/doctors/profile_image/no-image.jpg");
      } else {
        $doc->profile_image_path = $file_path;
      }
    } else {
      $doc->profile_image_path = base_url("protected/doctors/profile_image/no-image.jpg");
    }

    # Encrypted values
    foreach (array('owner_name', 'account_number', 'bankname', 'blz') as $field) {
      // $doc->$field = $this->aes_encrypt->de($doc->$field);
    }

    if ($this->session->userdata('pat_id'))
    {
      $this->load->model('patients/mpatient');

      $this->pat_id = $this->session->userdata('pat_id');
      
      $this->patient =& $this->mpatient->get($this->session->userdata('pat_id'));

      $accessibility = $this->mgen->dbp->get_where('my_doctors', array('patient_id' => $this->patient->id, 'doctor_inserted_id' => $id, ), 1);

      if ($accessibility->num_rows() > 0)
      {
        $this->access = 1;
      }
      else
      {
        $this->access = 2;
      }
    }

    $doc->user_role = 'doctor';

    return $doc;
  }

  /**
   *
   */
  public function by_regid($regid)
  {
    $query = $this->mgen->dbp->get_where('doctors', array('regid' => $regid, ));
    return $query->num_rows() > 0 ? $query->row() : (new stdClass());
  }

  /**
   *
   */
  public function get_all()
  {
    $query = $this->mgen->dbp->get_where('doctors', array('confirm_status' => 1, 'Dr_approv' => 1, ));
    return $query->num_rows() > 0 ? $query->result() : array();
  }

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

    return $this->mgen->dbp->update('doctors');
  }


  public function photo_update($id, $update_params)
  {
    if (!$this->mgen->db_where('dbp', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->mgen->dbp->limit(1);

    $this->mgen->db_set('dbp', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->mgen->dbp->update('doctors');
  }
  
}

/* End of file mdoctor.php */
/* Location: ./application/models/patients/mdoctor.php */