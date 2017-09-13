<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_answers extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	
	public function insert($insert_data){
		if(!$insert_data){
			return;
		}
			
		else{
			foreach ($insert_data as $key => $value) {
				$this->m->port->m->insert('epres_answers',$value);
			}
			
		}
		
	}

	public function get_everything($epres_id){
		$this->load->language('pwidgets/rezept',$this->m->user_value('language'));
  		$this->load->language('pwidgets/my_account', $this->m->user_value('language'));
		
		$this->m->port->m->where('id',$epres_id);
		$query1 = $this->m->port->m->get('eprescription');
		$eprescription=array();
		

		foreach ($query1->result() as $row) {
			$eprescription['id'] 		    		=$row->id;
			$eprescription['sickness']				=$row->sickness;
			$eprescription['follow_up'] 			=$row->follow_up;
			$eprescription['Handelsname'] 			=$row->Handelsname;
			$eprescription['drug'] 					=$row->drug;
			$eprescription['atc_code'] 				=$row->atc_code;
			$eprescription['packsize'] 				=$row->packsize;
			//$eprescription['pzn'] 				=$row->pzn;	
			$eprescription['manufacturer'] 			=$row->manufacturer;
			$eprescription['comments'] 				=$row->comments;
			$eprescription['patient_id'] 			=$row->patient_id;
			if($row->status!=0)
				$eprescription[$this->lang->line('pwidgets_doc_comments')] 		=$row->doc_comments;
			
		}



		$this->m->port->p->where('id',$eprescription['patient_id']);
		unset($eprescription['patient_id']);
		$query2 = $this->m->port->p->get('patients');
		$patient=array();
		
		foreach ($query2->result() as $row) {
			$patient['id']						=$row->regid;
			$patient['first_name']				=$row->name;
			$patient['last_name']				=$row->surname;
			$patient['birth_date']				=$row->dob;
			$patient['street_house_number']		=$row->address;
			$patient['zip_code']				=$row->zip;
			$patient['city']					=$row->city;
			$patient['region']					=$row->region;
			$patient['email']					=$row->email;
			
		}

		$query_text = "Select A.question, A.question_en , B.answer from epres_answers as B join epres_questions as A on A.id=B.ques_id where B.epres_id ='".$epres_id."'";

		$query3 = $this->m->port->m->query($query_text);
		$answers = array();
		$select_row=array();

		foreach ($query3->result() as $row) {
			if($this->m->user_value('language')=='de')
			{
				$select_row['question']		=$row->question;
			}else if($this->m->user_value('language')=='en')
			{
				$select_row['question']		=$row->question_en;
			}
			$select_row['answer']		=$row->answer;
			
			array_push($answers, $select_row);
		}


		$everything['eprescription']		=$eprescription;
		$everything['patient']				=$patient;
		$everything['answers']				=$answers;

		return $everything;

	}

}

