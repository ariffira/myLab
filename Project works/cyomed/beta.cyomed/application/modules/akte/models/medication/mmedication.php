<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmedication extends CI_Model {

  public static $encrypted_fields = array('name', 'atc_code', 'substance', 'dose_rate', 'comments');
  public static $plain_fields     = array('id','user_role','added_by','memory_enable', 'patient_id', 'taken_morning', 'taken_morning_time', 'taken_lunch', 'taken_lunch_time', 'taken_evening', 'taken_evening_time', 'taken_night', 'taken_night_time', 'repeating_periods', 'prescribed', 'way_of_application', 'iv', 'po', 'sc', 'im', 'delete_status', 'discontinued_desc', 'reminderoption', 'access_permission', 'taking_regularly', 'taking_needed','taken_time', );
  public static $datetime_fields  = array('taken_since', 'document_date', 'date_added', 'date_modified', 'reminderdate', 'remindertime', 'bis_to', );

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

  /**
   *
   */
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

    if ($get_files)
    {
      $this->load->model('document/mdoc');
    }

    $ret = $this->m->get('m', 'medication', $condition, self::$encrypted_fields);
        

    if (count($ret) > 0 && $get_files)
    {
      foreach ($ret as $index => $row)
      {
        // Old Doc system
        // Old Doc system
        $ret[$index]->files = array();
        $files = $this->m->get('m', 'medication_files', array('medication_id' => $row->id, ), array(), array());
        foreach ($files as $file)
        {
          $this->m->port->m->limit(1);
          $entry_id = $file->id;
          $file = $this->mdoc->get($file->document_id, 'id');
          if (count($file) > 0)
          {
            $file = $file[0];
            $file->entry_id = $entry_id;
          }
          else
          {
            continue;
          }

          $ret[$index]->files[] = $file;
        }

        // New doc system
        // $docs = $this->mdoc->get($row->id, 'parent_id');
        // $ret[$index]->files = $docs ? $docs : array();
      }
    }

    return $ret;
  }

  /**
   *
   */
  public function get_all()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('document_date', 'desc');
//      $_ci->m->port->m->order_by('id', 'desc');
        
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mmedication->get(array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);

        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mmedication->get(array('patient_id' => $_ci->m->user_id(), ), TRUE);
        
        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_current_medication()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('document_date', 'desc');
//      $_ci->m->port->m->order_by('id', 'desc');
        
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mmedication->get(array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(),'bis_to >=' =>  date('Y-m-d'), ), TRUE);

        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mmedication->get(array('patient_id' => $_ci->m->user_id(), 'bis_to >=' =>  date('Y-m-d'),), TRUE);
        
        return $return;
      }
    );
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
    $this->m->port->m->insert('medication');

   $insert_id=  $this->m->port->m->insert_id();
	
    if(!empty($_FILES))
	{
	    $this->load->model('document/mdoc');
	
	    if ($result = $this->mdoc->do_upload($insert_params['patient_id']))
	    {
	      if (isset($result->error) && $result->error)
	      {
	          //echo $result->error;die();
	      }
	      else
	      {
	        $doc = $result[0];
	
	        $this->m->db_set('m', array(
	          'medication_id' => $insert_id, 
	          'document_id' => $doc->id, 
	        ), array('id', 'medication_id', 'document_id', ), array(), array());
	
	        $this->m->port->m->insert('medication_files');
	      }
	    }
	}
    return $insert_id;    
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

    $this->m->port->m->db_select();
    $result=$this->m->port->m->update('medication');

    if ($result && isset($id['patient_id']) && isset($id['id']))
    {
      $this->load->model('document/mdoc');

      if ($result = $this->mdoc->do_upload($id['patient_id']))
      {
        if (isset($result->error) && $result->error)
        {

        }
        else
        {
          $doc = $result[0];

          $this->m->db_set('m', array(
            'medication_id' => is_string($id) || is_numeric($id) ? $id : $id['id'], 
            'document_id' => $doc->id, 
          ), array('id', 'medication_id', 'document_id', ), array(), array());

          $this->m->port->m->insert('medication_files');
        }
      }
    }

    return $result;
    
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

    $this->m->port->m->db_select();
    return $this->m->port->m->delete('medication');
  }

    public function medication_for_eprescription($act_code,$substance,$id)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('`substance` like "%'.$_ci->aes_encrypt->en($substance).'%"');        
        $_ci->m->port->m->or_where("atc_code",$_ci->aes_encrypt->en($act_code));       
        $return = $_ci->mmedication->get(array('patient_id' => $id), TRUE);
        return $return;
  }

}

/* End of file mmedication.php */
/* Location: ./application/models/medication/mmedication.php */