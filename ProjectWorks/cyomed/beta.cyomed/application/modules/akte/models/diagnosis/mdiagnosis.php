<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdiagnosis extends CI_Model {

  public static $encrypted_fields = array('icd_code', 'title', 'description');
  public static $plain_fields     = array('id', 'patient_id','user_role','added_by','icd_code', 'description', 'status', 'document', 'allergy', 'access_permission', 'country_id', 'entry_from', 'delete_status', );
  public static $datetime_fields  = array('document_date', 'date_added', 'date_modified', 'date_confirmed', 'date_emergency', 'start_date', 'end_date', );

  const STATUS_EMERGENCY     = '2';
  const STATUS_CONFIRMED     = '1';
  const STATUS_NON_CONFIRMED = '0';

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

    $ret = $this->m->get('m', 'diagnoses', $condition, self::$encrypted_fields);
    if (count($ret) > 0 && $get_files)
    {
      foreach ($ret as $index => $row)
      {
//        $ret[$index]->icd_code = preg_replace('/\s+/', '', $ret[$index]->icd_code);
//        $ret[$index]->title = preg_replace('/\s+/', '', $ret[$index]->title);

        // Old Doc system
        $ret[$index]->files = array();
        $files = $this->m->get('m', 'diagnoses_files', array('diagnosis_id' => $row->id, ), array('document_name', ), array());
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

    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = (object) array(
          'emergency' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'status' => Mdiagnosis::STATUS_EMERGENCY, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
          'confirmed' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'status' => Mdiagnosis::STATUS_CONFIRMED, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
          'unconfirmed' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'status' => Mdiagnosis::STATUS_NON_CONFIRMED, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
          'travel' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'entry_from' => 1, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
          'allergy' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'allergy' => 1, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
          'archived' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'delete_status' => 1, 'access_permission >=' => $_ci->m->us_access(), ), TRUE),
        );
        
        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      },
      function() use ($_ci)
      {
        $return = (object) array(
          'emergency' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'status' => Mdiagnosis::STATUS_EMERGENCY), TRUE),
          'confirmed' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'status' => Mdiagnosis::STATUS_CONFIRMED), TRUE),
          'unconfirmed' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'status' => Mdiagnosis::STATUS_NON_CONFIRMED), TRUE),
          'travel' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'entry_from' => 1), TRUE),
          'allergy' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'allergy' => 1), TRUE),
          'archived' => $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), 'delete_status' => 1), TRUE),
        );

        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_all_uncata()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('document_date', 'desc');
//        $_ci->m->port->m->order_by('id', 'desc');        
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);
        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mdiagnosis->get(array('patient_id' => $_ci->m->user_id(), ), TRUE);
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
    $this->m->port->m->insert('diagnoses');
    
    $insert_id = $this->m->port->m->insert_id();

    $this->load->model('document/mdoc');

    if ($result = $this->mdoc->do_upload($insert_params['patient_id']))
    {
      if (isset($result->error) && $result->error)
      {

      }
      else
      {
        $doc = $result[0];

        $this->m->db_set('m', array(
          'diagnosis_id' => $insert_id, 
          'document_id' => $doc->id, 
          'patient_id' => $this->m->role_diff(
            function() use ($_ci){
              return $this->m->us_id();
            },
            function() use ($_ci){
              return $this->m->user_id();
            }
          ),
        ), array('id', 'patient_id', 'diagnosis_id', 'document_id', ), array(), array());

        $this->m->port->m->insert('diagnoses_files');
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
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->db_select();
    $result = $this->m->port->m->update('diagnoses');

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
            'diagnosis_id' => is_string($id) || is_numeric($id) ? $id : $id['id'], 
            'document_id' => $doc->id, 
            'patient_id' => $this->m->role_diff(
              function() use ($_ci){
                return $this->m->us_id();
              },
              function() use ($_ci){
                return $this->m->user_id();
              }
            ),
          ), array('id', 'patient_id', 'diagnosis_id', 'document_id', ), array(), array());

          $this->m->port->m->insert('diagnoses_files');
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
    return $this->m->port->m->delete('diagnoses');
  }
   public function diagnosis_for_eprescription($icd_code,$icd_name,$id)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('`title` like "%'.$_ci->aes_encrypt->en($icd_name).'%"');        
        $_ci->m->port->m->or_where("icd_code",$_ci->aes_encrypt->en($icd_code));       
        $return = $_ci->mdiagnosis->get(array('patient_id' => $id), TRUE);
        echo $_ci->m->port->m->last_query();
//        print_R($return);die;
        return $return;
  }
	/**
   	 *
   	 */
  	public function getDiagnosisImage($term=''){
   		if (!$term)
    	{
      		return base_url('assets/img/portal/no-image.jpg');
    	}
    
	    $this->m->port->p->from('icd');
	    $this->m->port->p->where('icd_code', $term);
	    $query = $this->m->port->p->get();
    
	    if($query->num_rows() > 0)
	    {
	 		if(strtolower($term[0])=='h') {
	 			$term = str_replace('h','',$term);
	 			if($term>=0 && $term<=59)
	 				return base_url('assets/img/Diagnosis_ICD_Code_H1.png');
	 			else 
	 				return base_url('assets/img/Diagnosis_ICD_Code_H2.png');
	 		}  	
	 		else {
	 			return base_url('assets/img/Diagnosis_ICD_Code_'.strtoupper($term[0]).'.png');
	 		}
	    }
		else 
		{
			return base_url('assets/img/portal/no-image.jpg');
		}
  	}
}

/* End of file mdiagnosis.php */
/* Location: ./application/models/diagnosis/mdiagnosis.php */