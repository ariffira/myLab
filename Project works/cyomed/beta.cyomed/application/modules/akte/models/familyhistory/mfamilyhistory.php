<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mfamilyhistory extends CI_Model {

  public static $encrypted_fields = array('familyhistory', );
  public static $plain_fields     = array('id', 'patient_id', 'disease_name', 'gender', 'relation_to_patient', 'delete_status',);
  public static $datetime_fields  = array('date',  'dob', 'date_added', 'date_modified','effective_time','dateofdeath' );
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
    //$this->load->model('mgen');
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
public function get_all()
{
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
      	
      	$_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('effective_time', 'desc');
      return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mfamilyhistory->get(array('patient_id' => $_ci->m->us_id(), ), TRUE);
        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mfamilyhistory->get(array('patient_id' => $_ci->m->user_id(), ), TRUE);
        return $return;
      }
    );
 }

  public function get($value, $field = 'patient_id', $get_files = FALSE)
  {
    if (is_array($value))
    {
      $condition = $value;
      $get_files = $field ? ($field === 'patient_id' ? FALSE : $field) : FALSE;
    }
    else
    {
      if (is_string($field))
      {
        $condition = array($field => $value, );
      }
      else
      {
        $get_files = $field;
        $condition = array('patient_id' => $value, ); 
      }
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    

    $ret = $this->m->get('m', 'familyhistory', $condition, self::$encrypted_fields);
    return $ret;
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

    $this->m->port->m->db_select();
    $this->m->port->m->insert('familyhistory');
    $insert_id = $this->m->port->m->insert_id();

    return $insert_id;
  }



  public function update($id, $update_params)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);
    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->db_select();
    $result = $this->m->port->m->update('familyhistory');
    return $result;
  }

  public function delete($id)
  {
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    return $this->m->port->m->delete('familyhistory');
  }
  

}

/* End of file Mfamilhistory.php */
/* Location: ./application/models/familyhistory/familyhistory.php */