<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcasehistory extends CI_Model {

  public static $encrypted_fields = array('symptom_current_history', 'vegetative_anamnese', 'pre_existing_conditions', 'drug_history', 'allergies', 'related_products', 'family_history', 'social_history', 'attending_physicians', 'general_findings', 'head_and_neck', 'thorax_and_lungs', 'heart_circulation_blood_vessels', 'abdomen', 'motion_apparatus', 'nervous_system', 'maintenance_state', 'other_findings','bodylocations','remarks');
  public static $plain_fields     = array('id', 'patient_id', 'doctor_id', 'delete_status');
  public static $datetime_fields  = array('date_added', 'date_modified');

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

    	$ret = $this->m->get('m', 'casehistory', $condition, self::$encrypted_fields);
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
		        $_ci->m->port->m->db_select();
		        $_ci->m->port->m->order_by('date_added', 'desc');

		        
		        $condition = array('doctor_id' => $_ci->m->user_id());
		        
		        $patient_id = $_ci->m->us_id();

		        if(!empty($patient_id))
		        {
		        	$condition['patient_id'] = $patient_id;
		        }
		        $return = $_ci->mcasehistory->get($condition, TRUE);
        		return $return;
      		},
      		function() use ($_ci)
      		{
      		
		        $_ci->m->port->m->db_select();
		        $_ci->m->port->m->order_by('date_added', 'desc');
//		        $_ci->m->port->m->order_by('id', 'desc');
		        $return = $_ci->mcasehistory->get(array('patient_id' => $_ci->m->user_id()), TRUE);
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
    	$this->m->port->m->insert('casehistory');

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

    	$this->m->port->m->db_select();

    	return $this->m->port->m->update('casehistory');
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
	  	static $_ci;
    	if (empty($_ci)) $_ci =& get_instance();
    	
		if (!$this->m->db_where('m', $id))
    	{
      		return FALSE;
    	}
    	
    	/*$this->m->db_where('patient_id', $_ci->m->us_id());
    	$this->m->db_where('doctor_id', $_ci->m->u_id());
*/
    	$this->m->port->m->limit(1);

    	$this->m->port->m->db_select();
    	return $this->m->port->m->delete('casehistory');
  	}
}

/* End of file mmedication.php */
/* Location: ./application/models/medication/mmedication.php */