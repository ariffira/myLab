<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmedicine extends CI_Model {

	public static $role = NULL;

  	/*
  	 |--------------------------------------------------------------------------
  	 | PUBLIC VARS
  	 |--------------------------------------------------------------------------
	 */

	function __construct()
  	{
    	// Call the Model constructor
    	parent::__construct();

    	$alert = '';

    	$this->mod->port->m->db_select();

    	if (!$this->mod->port->m->table_exists('epres_medicine'))
    	{
      		$alert .= '<p>';
	      	$alert .= 'DB Error: medicine table not found.';
	      	$alert .= '</p>';
	      	echo $alert;
    	}

    	if ($alert)
    	{
      		echo $alert;
      		exit();
    	}
  	}
  
  	/**
   	 *
   	 */
  
	public function get_list()
	{
   		$this->mod->port->m->db_select();

    	$query = $this->mod->port->m->get('epres_medicine');
    	
    	if ($query->num_rows() > 0)
    	{
      		$result = $query->result();

      		$fields = $this->mod->port->m->field_data('epres_medicine');


	      	foreach ($fields as $field)
	      	{
	        	if (strtoupper($field->type) == 'BLOB')
	        	{
		        	$field_name = $field->name;
		         	foreach ($result as $index => $row)
		          	{
		            	isset($row->$field_name) && $row->$field_name ? ($result[$index]->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
		          	}
	        	}
	      	}
	
	      	return $result;
		}
	    else
	    {
	    	return array();
	    }
  	}
}

/* End of file minvoice.php */
/* Location: ./application/models/minvoice.php */