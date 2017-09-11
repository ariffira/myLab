
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_medicine extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get(){

		

		$query_text = "select medicine from epres_medicine ";
		$result = array();
		$query = $this->m->port->m->query($query_text);
		foreach ($query->result() as $row) {
			array_push($result, $row->medicine);
		}
		
		return $result;

	}

	public function get_sickness_name($code){
		if(!$code){

			return array();
		}

		$this->m->port->m->where('medicine',$code);
		$query=$this->m->port->m->get('epres_medicine');

		foreach ($query->result() as $row) {
			return $row->sickness;
		}
	}





}

