<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdoc extends CI_Model {

  public static $categories = array(
    array('value' => 'doctor_letter', 'label' => 'Arztbrief', ),
    array('value' => 'lab', 'label' => 'Labor', ),
    array('value' => 'radio', 'label' => 'Radiologische Befunde', ),
    array('value' => 'common', 'label' => 'Andere Dokumente', ),
  );

  public static $encrypted_fields = array('document_name', 'document_caption', 'document_category', );
  public static $plain_fields     = array('id', 'patient_id', 'document_extension', 'p_file_data', 'access_permission', 'delete_status', );
  public static $datetime_fields  = array('cdate', 'mdate', );

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

  /** 
   *
   */
  public function db_check()
  {
    // CREATE TABLE `user_docs` (
    // `id` int(11) NOT NULL AUTO_INCREMENT,
    // `user_id` bigint(20) unsigned NOT NULL,
    // `user_role` varchar(255) NOT NULL,
    // `document_name` blob NOT NULL,
    // `document_caption` blob NOT NULL,
    // `document_category` blob NOT NULL,
    // `document_extension` varchar(30) NOT NULL,
    // `p_file_data` longtext NOT NULL,
    // `access_permission` int(2) NOT NULL,
    // `delete_status` int(2) NOT NULL,
    // `cdate` datetime NOT NULL,
    // `mdate` datetime NOT NULL,
    // PRIMARY KEY (`id`)
    // ) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8
  }

  /** 
   *
   */
  public function check_upload_path($path = NULL, $create_subs = FALSE)
  {
    if (empty($path)) return FALSE;

    $this->load->helper('file');

    foreach (($create_subs ? array('', '/Arztbrief', '/Labor', '/Radiologische Befunde', '/Andere' ) : array('', )) as $appendix)
    {
      $total_path = rtrim($path,'/').$appendix.'/';

      if (!file_exists($total_path)) {
        mkdir($total_path, 0777, true);
      }

      $deny_html = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
      write_file($total_path.'index.html', $deny_html);
    }

    return $path;
  }

  /**
   *
   */
  public function get_upload_path()
  {
    // return './protected/uploads/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($row->patient_id)).'/'.$row->document_name.'.'.$row->document_extension;
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if ($_ci->m->user() && $_ci->m->user()->regid)
    {
      return './protected/uploads/'.$this->m->role_diff(function(){
        return 'doctor';
      }, function(){
        return 'patient';
      }).'/'.bin2hex($_ci->aes_encrypt->en($_ci->m->user()->regid)).'/';
    }

    return FALSE;
  }

  /**
   *
   */
  public function get_us_upload_path()
  {
    // return './protected/uploads/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($row->patient_id)).'/'.$row->document_name.'.'.$row->document_extension;
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if ($_ci->m->us() && $_ci->m->us()->regid)
    {
      return './protected/uploads/patient/'.bin2hex($_ci->aes_encrypt->en($_ci->m->us()->regid)).'/';
    }

    return FALSE;
  }

  /**
   *
   */
  public function get_file_path($row)
  {
    if ($this->m->us() && $this->m->us()->regid)
    {
      return './protected/uploads/patient/'.bin2hex($this->aes_encrypt->en($this->m->us()->regid)).'/'.$row->document_name.'.'.$row->document_extension;
    }

    if ($this->m->user() && $this->m->user()->regid)
    {
      return './protected/uploads/patient/'.bin2hex($this->aes_encrypt->en($this->m->user()->regid)).'/'.$row->document_name.'.'.$row->document_extension;
    }

    return FALSE;
  }

  
  /**
   *
   */
   public function get_profile_img_path($regid = NULL)
  {
    $query=$this->m->port->p->get_where('patients', array('regid = ' => $regid,), 1);
    $row = $query->row();
    if (!empty($row->profile_image) && !empty($row->regid))
    {
      $this->m->port->m->db_select();
      $this->m->port->m->limit(1);
      $doc = $this->get($row->profile_image, 'id');
      if (!empty($doc))
      {
        $doc = is_array($doc) ? $doc[0] : ( is_object($doc) && !empty($doc->document_name) && !empty($doc->document_extension) ? $doc : FALSE );

        if ($doc)
        {
          $location = './protected/uploads/patient/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          $location = './protected/uploads/patient/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          return $location;

        }
      }
    }

    return FALSE;
  }
  /**/
  
  
  public function get_profile_image_path($row = NULL)
  {
    if (empty($row)) $row = $this->m->user();
    if (!empty($row->profile_image) && !empty($row->regid))
    {
      $this->m->port->m->db_select();
      $this->m->port->m->limit(1);
      $doc = $this->get($row->profile_image, 'id');
      if (!empty($doc))
      {
        $doc = is_array($doc) ? $doc[0] : ( is_object($doc) && !empty($doc->document_name) && !empty($doc->document_extension) ? $doc : FALSE );
        if ($doc)
        {
          $location = './protected/uploads/'.$this->m->role_diff(function() {
            return 'doctor';
          }, function() {
            return 'patient';
          }).'/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          $location = './protected/uploads/'.$this->m->role_diff(function() {
            return 'patient';
          }, function() {
            return 'doctor';
          }).'/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          return $location;
        }
      }
    }
    return FALSE;
  }

    
  public function get_associate_image($field=null,$row = NULL)
  {
    if (empty($row)) $row = $this->m->user();
    if (!empty($row->profile_image) && !empty($row->regid) && $field)
    {
      $this->m->port->m->db_select();
      $this->m->port->m->limit(1);
      $doc = $this->get($field, 'id');
      if (!empty($doc))
      {
        $doc = is_array($doc) ? $doc[0] : ( is_object($doc) && !empty($doc->document_name) && !empty($doc->document_extension) ? $doc : FALSE );
        if ($doc)
        {
          $location = './protected/uploads/'.$this->m->role_diff(function() {
            return 'doctor';
          }, function() {
            return 'patient';
          }).'/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          $location = './protected/uploads/'.$this->m->role_diff(function() {
            return 'patient';
          }, function() {
            return 'doctor';
          }).'/'.bin2hex($this->aes_encrypt->en($row->regid)).'/'.$doc->document_name.'.'.$doc->document_extension;

          if (file_exists($location) && @getimagesize($location)) {
            return $location;
          }

          return $location;
        }
      }
    }
    return FALSE;
  }

  /**
   *
   */
  public function do_upload($patient_id, $role = "patient", $upload_field = "document_upload")
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $config = array();

    $config['upload_path'] = './protected/uploads/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($this->m->role_diff(function() use ($_ci, $role) {
      if ($role == 'patient')
      {
        if ($_ci->m->us())
        {
          return $_ci->m->us()->regid;
        }
        return $_ci->m->user()->regid;
      }
      return $_ci->m->user()->regid;
    }, function() use ($_ci) {
      if ($_ci->m->user())
      {
        return $_ci->m->user()->regid;
      }
    }))).'/';
    $config['allowed_types'] = 'jpg|png|jpeg|gif|tif|doc|pdf|docx|odt|txt|ppt|xls|xlsx';
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = '10240';
    // $config['max_width']  = '1024';
    // $config['max_height']  = '768';

    if (!file_exists($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, true);
    }

    $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
    $this->load->helper('file');
    write_file($config['upload_path'].'index.html', $permission_string);

    $this->load->library('upload', $config);

    if ($this->upload->do_upload($upload_field))
    {
      $data = $this->upload->data();

      $category      = $this->input->post('document_category');
      $caption       = $this->input->post('document_caption');
      $extension     = str_replace('.', '', $data['file_ext']);
      $file_name     = ($ext_pos = strrpos($data['file_name'], '.'.$extension)) !== FALSE ? substr_replace($data['file_name'], '', $ext_pos, strlen('.'.$extension)) : $data['file_name'];

      $permission    = $this->input->post('access');
      
      $category      = $category ? $category : 'common';
      $caption       = $caption ? $caption : $data['orig_name'];
      $permission    = $permission ? $permission : 1;

      $new_id = $this->insert(array(
        'patient_id'         => $patient_id, 
        'document_name'      => $file_name, 
        'document_caption'   => $caption, 
        'document_category'  => $category, 
        'document_extension' => $extension, 
        'p_file_data'        => json_encode($data),
        'access_permission'  => $permission, 
        'delete_status'      => 0, 
        'cdate'              => TRUE, 
        'mdate'              => TRUE, 
      ));

      if ($row = $this->get($new_id, 'id'))
      {
        return $row;
      }

    }
    else
    {
      $error = (object)array('error' => $this->upload->display_errors());

      // $this->load->view('upload_form', $error);
      echo $error->error;
      return $error;
    }
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
    else if(!empty($value))
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

    M::$encrypted_fields_bin2hex = TRUE;

    $ret = $this->m->get('m', 'patients_docs', $condition, self::$encrypted_fields);

    return $ret;
  }

  /**
   *
   */
  public function from_patient_category($patient_id, $category)
  {
    return $this->get(array('patient_id' => $patient_id, 'document_category' => $category, ));
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
    $this->m->db_set('m', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->insert('patients_docs');

    return $this->m->port->m->insert_id();
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
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->m->port->m->update('patients_docs');
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
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    return $this->m->port->m->delete('patients_docs');
  }
  
  /*
   *
   */
  
  	public function get_document_details($ids) {
  		$vaccinations = $diagnoses = $medical_conditions = array();
  		$query = "SELECT * FROM vaccination LEFT JOIN vaccination_files ON vaccination_files.vaccination_id = vaccination.id WHERE vaccination_files.document_id IN (".$ids.")";
  		$query_result =$this->m->port->m->query($query);
  		$vaccinations = $query_result->result();
  		
  		$query = "SELECT * FROM diagnoses LEFT JOIN diagnoses_files ON diagnoses_files.diagnosis_id = diagnoses.id WHERE diagnoses_files.document_id IN (".$ids.")";
  		$query_result =$this->m->port->m->query($query);
  		$diagnoses = $query_result->result();

  		$query = "SELECT * FROM medical_condition LEFT JOIN medical_condition_files ON medical_condition_files.medical_condition_id = medical_condition.id WHERE medical_condition_files.document_id IN (".$ids.")";
  		$query_result =$this->m->port->m->query($query);
  		$medical_conditions = $query_result->result();
  		
  		
  		$result = array_merge($vaccinations,$diagnoses,$medical_conditions);
  		
  		return $result;
  	}

}

/* End of file mdoc.php */
/* Location: ./application/models/document/mdoc.php */