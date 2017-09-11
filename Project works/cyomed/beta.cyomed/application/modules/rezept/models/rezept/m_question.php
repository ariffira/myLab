	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_question extends CI_Model {

		function __construct()
	    {
	        // Call the Model constructor
	        parent::__construct();
	    }
	    
		public function get(){
			/*type is the sickness type like pressure as bp genereal as ge likewise*/
			// if(!$type){

			// 	return array();
			// }
			if($this->m->user_value('gender')=='1'){
				//$query_text="select * from epres_questions where type='ge' or type like '%". $type ."%' or type="."'fe'";
				$query_text="select * from epres_questions where input_type!=''";
			}
			else{
				//$query_text="select * from epres_questions where type='ge' or type like '%" . $type ."%'";
				$query_text="select * from epres_questions where type!='fe' and input_type!=''";
			}
			$result = array();
			$result_row = array();
			$query=$this->m->port->m->query($query_text);
			
			if($this->m->user_value('language')=='de'){

				foreach($query->result() as $row){
					$result_row['id']				=$row->id;
					$result_row['question']			=$row->question;
					$result_row['input_type']		=$row->input_type;
					$result_row['option_count']		=$row->option_count;
					$result_row['option1']			=$row->option1;
					$result_row['option2']			=$row->option2;
					$result_row['option3']			=$row->option3;
					$result_row['option4']			=$row->option4;
					$result_row['class']			=$row->class;
					array_push($result, $result_row);
				}
			}
			else if($this->m->user_value('language')=='en'){

				foreach($query->result() as $row){
					$result_row['id']				=$row->id;
					$result_row['question']		    =$row->question_en;
					$result_row['input_type']		=$row->input_type;
					$result_row['option_count']		=$row->option_count;
					$result_row['option1']			=$row->option1_en;
					$result_row['option2']			=$row->option2_en;
					$result_row['option3']			=$row->option3_en;
					$result_row['option4']			=$row->option4_en;
					$result_row['class']			=$row->class;
					array_push($result, $result_row);
				}
			}

	              
			return $result;
		}

	}

