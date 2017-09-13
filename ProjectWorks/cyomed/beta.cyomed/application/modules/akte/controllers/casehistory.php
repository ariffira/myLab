<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casehistory extends MX_Controller {

	public function index($id='') {
		static $_ci;
	    if (empty($_ci)) $_ci =& get_instance();
	  
	    //loading languages
	    $this->load->language('global/general_text',$this->m->user_value('language'));
	    $this->load->language('patients/home',$this->m->user_value('language'));
	
	    $this->ui->mc->base_init();
	    
	    /*** for adding header***/
	    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
	    {
	     
	    }
	    else
	    {
			$this->config->load('ia24ui', TRUE, TRUE);
		    $this->ui->html->base_init()->load_config('html');
		    $this->ui->html->set_active_url('akte/casehistory');
	    }
	    /***end here***/
	    
	    $this->ui->mc->title->content = $this->lang->line('patients_home_new_case_history');
        $_ci->m->port->m->db_select();

//        $_ci->m->port->m->where('greatest(date_modified,date_added)<=', date('Y-m-d H:i:s', time()));

    	$this->m->role_diff(
      		function() use ($_ci,$id){
				$_ci->load->model('casehistory/mcasehistory');

        		$entries = $_ci->mcasehistory->get_all();
        		
        		if(!empty($entries))
        		{
        			foreach ($entries as $key=>$value)
        			{
        				if(!empty($value->bodylocations))
        				{
	        				$temp = $value->bodylocations;
							$value->bodylocations = '';
							
							$temp = explode("||",$temp);
	
							foreach($temp as $val)
							{
								$value->bodylocations[] = explode(",",$val);
							}
        				}
        			}
        		}
        		
        		$patient_details = $this->m->user_details($_ci->m->us_id(),'role_patient');
        		
        		$_ci->ui->mc->content->content = $_ci->load->view('casehistory/casehistory_view', array(
					'entries' => $entries,'detail_id'=>$id,'patient_details'=>$patient_details
        		), TRUE);
      		},
      		function() use ($_ci,$id){
        		$_ci->load->model('casehistory/mcasehistory');

        		$entries = $_ci->mcasehistory->get_all();
        		
        		if(!empty($entries))
        		{
        			foreach ($entries as $key=>$value)
        			{
        				if(!empty($value->bodylocations))
        				{
	        				$temp = $value->bodylocations;
							$value->bodylocations = '';
							
							$temp = explode("||",$temp);
	
							foreach($temp as $val)
							{
								$value->bodylocations[] = explode(",",$val);
							}
        				}
        			}
        		}
        		
        		$patient_details = $this->m->user_details($_ci->m->user_id(),'role_patient');
        		
        		$_ci->ui->mc->content->content = $_ci->load->view('casehistory/casehistory_view', array(
					'entries' => $entries,'detail_id'=>$id,'patient_details'=>$patient_details
        		), TRUE);
      		}
    	);

		/**displaying for output***/
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    	{
       		$this->output->set_output($this->ui->mc->output());
    	}
    	else
    	{
     		$this->output->set_output($this->ui->html->output());
    	}
    	/****end here***/
	}
	
	/**
	 *
	**/
  	public function insert()
  	{
	  	static $_ci;
	  	if (empty($_ci)) $_ci =& get_instance();
	  	
	  	$insert_data = $_ci->input->post();

	  	if(empty($insert_data))
	  	{
	  		
	  	}
	  	else 
	  	{
		  	$_ci->load->model('casehistory/mcasehistory');
		  	$patient_id = $_ci->m->us_id();
		  	if(!empty($patient_id))
		  	{
				$insert_data['patient_id'] = $_ci->m->us_id();
		  	}
		  	
			$insert_data['doctor_id']    =  $_ci->m->user_id();
		  	$insert_data['date_added'] 	  =  date("Y-m-d H:i:s");

		  	unset($insert_data['id']);
		  	
	  		$insert_id = $_ci->mcasehistory->insert($insert_data);
	  	}
  		
	  	ajax_redirect('akte/casehistory/index/'.$insert_id);
  	}

	/**
   	  *
   	  */
  	public function update($id)
  	{
    	static $_ci;
    	if (empty($_ci)) $_ci =& get_instance();

    	if (empty($id))
    	{
      		$id = $this->input->post('id');
    	}

	    if (empty($id))
	    {
	      	$id = $this->input->get('id');
	    }

	    if (empty($id)) return FALSE;

        $_ci->load->model('casehistory/mcasehistory');
        
        $update_data = $_ci->input->post();
		$update_data['date_modified'] =  date("Y-m-d H:i:s");
        
		
		$array = array('id' => $id, "doctor_id"=>$_ci->m->user_id());
		$patient_id = $_ci->m->us_id();
		if(!empty($patient_id))
	  	{
			$array['patient_id'] = $_ci->m->us_id();
	  	}
	  
		$_ci->mcasehistory->update(
        	$array,
          	$update_data
        );
        ajax_redirect('akte/casehistory/index/'.$id);
  	} 
  	
	/**
     *
     */
  	public function delete($id)
  	{
    	static $_ci;
    	if (empty($_ci)) $_ci =& get_instance();

    	if (empty($id))
	    {
	    	$id = $this->input->post('id');
	    }

	    if (empty($id))
	    {
			$id = $this->input->get('id');
		}

	    $this->m->role_diff(
			function() use ($_ci, $id){
				if (empty($id)) return FALSE;

				if (!$_ci->m->us_id()) return FALSE;
	
	 			$_ci->load->model('casehistory/mcasehistory');
	 			
	        	return $_ci->mcasehistory->delete($id);
			},
			function() use ($_ci, $id){
				if (empty($id)) return FALSE;

				$_ci->load->model('casehistory/mcasehistory');
        		return $_ci->mcasehistory->delete($id);
      		}
    	);

		ajax_redirect('akte/casehistory');
  	}
  	
 	/**
   	 *
	 */
	public function feed($time = NULL, $limit = 15)
  	{
    	static $_ci;
    	if (empty($_ci)) $_ci =& get_instance();
    
    	//loading languages
	    $this->load->language('global/general_text',$this->m->user_value('language'));
	    $this->load->language('patients/home',$this->m->user_value('language'));

    	if ($time === NULL)
    	{
      		$time = time();
    	}

    	if (!is_numeric($time))
    	{
      		if (strtotime($time) !== FALSE)
      		{
        		$time = strtotime($time);
      		}
      		else
      		{
        		$time = time();
      		}
    	}

    	if (!is_numeric($limit))
    	{
      		$limit = 15;
    	}
   
    	$this->ui->feed_item->base_init();
	   	
	   	/*** for adding header***/
	    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
	    {
	     
	    }
    	else
    	{
	    	$this->config->load('ia24ui', TRUE, TRUE);
	      	$this->ui->html
		                ->base_init()
		                ->load_config('html');
	      	$this->ui->html
            	        ->set_active_url('akte/overview/timeline?check=casehistory');
    	}
    	/***end here***/
        if(isset($_REQUEST['showmore']))
        {
            $showmorelimit=5;
            $showmorelimit+=$_REQUEST['showmore'];
            $showmore=$_REQUEST['showmore'];
        }
        else
        {
	         $showmorelimit=0;
	         $showmore=0;
        }
        
        if(isset($_REQUEST['id']))
        {
           $colorclass="blog-cyan"; 
        }
        else
        {
          	$colorclass="blog-blue";  
        }
                $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('date_added <=', date('Y-m-d H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $_ci->load->model('casehistory/mcasehistory');
       	$output = $this->m->role_diff(
	       	function() use ($_ci, $time, $limit,$showmorelimit,$colorclass,$showmore)
	       	{
	        	if (!$_ci->m->us_id())
	        	{
	          		return $_ci->load->view('not_chosen_view', array(), TRUE);
	        	}
	    
		        $_ci->m->port->m->limit($limit);
		        $entries = $_ci->mcasehistory->get_all();
	    
		        $totalrecord=count($entries);
		        $entries = array_splice($entries,$showmorelimit,5);
		        if(empty($showmorelimit))
		        {
		             $showmorelimit=5;  
		        }
		        $output = $_ci->load->view('casehistory/casehistory_feed_view', array(
		            'entries' => $entries,
		            'show_more'=>$showmorelimit,
		            'colorclass'=>$colorclass,
		            'tot_record'=>$totalrecord,
		        ), TRUE);
		        return $output;
	      	},
	      	function() use ($_ci, $time, $limit,$showmorelimit,$colorclass,$showmore){
	        	$entries = $_ci->mcasehistory->get_all();
	        
	        	$totalrecord=count($entries);
	        
	        	$entries = array_splice($entries,$showmore,5);
	        	if(empty($showmorelimit))
	        	{
	         		$showmorelimit=5;  
	        	}
		        $output = $_ci->load->view('casehistory/casehistory_feed_view', array(
		            'entries' => $entries,
		            'show_more'=>$showmorelimit,
		            'colorclass'=>$colorclass,
		            'tot_record'=>$totalrecord,
		        ), TRUE);
		
		        return $output;
	      	}
	    );
    
    	/**displaying for output***/
    	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    	{
      		$this->output->set_output($output);  
    	}
    	else
    	{
     		$this->output->set_output($this->ui->html->output());
    	}
    	/****end here***/
	}
}