<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends MX_Controller {



  /**
   *
   */

  public function index()

  {
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('global/overview',$this->m->user_value('language'));

    $this->general();

  }



  /**
   *
   */

  public function general()

  {

    # Combining eveyrthing, to be implemented

    $this->akte();

  }



  /**
   *
   */

  public function akte($time = NULL, $limit = 15)

  {

    static $_ci;

    if (empty($_ci)) $_ci =& get_instance();

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

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')

        {

     

        }

        else

        {

         $this->config->load('ia24ui', TRUE, TRUE);

         $this->ui->html

                ->base_init()

                ->load_config('html');

         $this->ui->html

                    ->set_active_url('akte/overview/timeline?check=akte');

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

        $output = $this->m->role_diff(

        function() use ($_ci, $time, $limit,$showmorelimit,$showmore)
        {

         if (!$_ci->m->us_id())

         {

          return $_ci->load->view('not_chosen_view', array(), TRUE);

         }

        $_ci->load->model('medical_condition/mmedical_condition');
        $_ci->load->model('diagnosis/mdiagnosis');
        $_ci->load->model('medication/mmedication');
        $_ci->load->model('vaccination/mvaccination');
        $_ci->load->model('casehistory/mcasehistory');
	$_ci->load->model('familyhistory/mfamilyhistory');
        $_ci->load->model('graph/mgraph');

        # Here's for conditions

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $conditions = array_map(function($v) {

          $v->document_date = date('Y-m-d H:i:s', strtotime($v->document_date.' '.$v->document_time));
          return ($v->feed_type = 'condition') ? $v : $v;

        }, $_ci->mmedical_condition->get_all());


        # Here's for diagnosis

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $diagnosis = array_map(function($v) {
          return ($v->feed_type = 'diagnosis') ? $v : $v;

        }, $_ci->mdiagnosis->get_all_uncata());



        # Here's for medication

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $medication = array_map(function($v) {
          return ($v->feed_type = 'medication') ? $v : $v;

        }, $_ci->mmedication->get_all());



        # Here's vaccination

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $vaccination = array_map(function($v) {

          return ($v->feed_type = 'vaccination') ? $v : $v;

        }, $_ci->mvaccination->get_all());

        # Here's case history

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('date_added <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $mcasehistory = array_map(function($v) {
            $v->feed_type = 'casehistory';
            $v->document_date = date('Y-m-d H:i:s', strtotime($v->date_added));
            
          return ($v->feed_type && $v->document_date) ? $v : $v;

        }, $_ci->mcasehistory->get_all());

		# Here's for family history
		$_ci->m->port->m->db_select();
                $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));                   
		$_ci->m->port->m->limit($limit);
                
        $mfamilyhistory = array_map(function($v) {
            $v->feed_type = 'familyhistory';
            $v->document_date = date('Y-m-d', strtotime($v->effective_time));
            
          return ($v->feed_type && $v->document_date) ? $v : $v;

        }, $_ci->mfamilyhistory->get_all());
        

        # Here's for blood_pressure

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);
        
        $graph_entries = $_ci->mgraph->get_heart_frequency();

        $blood_pressure = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'blood_pressure',

          'entries' => $graph_entries,

          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d H:i:s', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d H:i:s', $time),
        
        ), ) : array();



        # Here's for blood_sugar

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_blood_sugar();

        $blood_sugar = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'blood_sugar',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' => isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d H:i:s', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d H:i:s', $time),

        ), ) : array();

        # Here's for weight_bmi

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_weight_bmi();

        $weight_bmi = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'weight_bmi',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' =>  isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d', $time),

        ), ) : array();



        # Here's for marcumar

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_marcumar();

       $marcumar = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'marcumar',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' =>  isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d', $time),
       	  'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d', $time),
           ), ) : array();


        $graph_entries_complete = array();

        $graph_entries_complete = array_merge($graph_entries_complete, $blood_pressure);

        $graph_entries_complete = array_merge($graph_entries_complete, $blood_sugar);

        $graph_entries_complete = array_merge($graph_entries_complete, $weight_bmi);

        $graph_entries_complete = array_merge($graph_entries_complete, $marcumar);
        
        $entries_other=array();
       
        
        $entries_other = array_merge($entries_other, $conditions);

        $entries_other = array_merge($entries_other, $diagnosis);

        $entries_other = array_merge($entries_other, $medication);

        $entries_other = array_merge($entries_other, $vaccination);

        $entries_other = array_merge($entries_other, $mcasehistory);
        
        $entries_other = array_merge($entries_other, $mfamilyhistory);
        
        /*usort($entries_other, function($a,$b) 

        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });
        
        usort($graph_entries_complete, function($a,$b) 

        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });*/


         $entries = array_merge($graph_entries_complete, $entries_other);
         usort($entries, function($a,$b) 
	     {
         	return strtotime(@$a->document_date) < strtotime(@$b->document_date) ? 1 : (strtotime(@$a->document_date) == strtotime(@$b->document_date) ? (@$a->date_added < @$b->date_added ? 1 : -1) : -1);
         });
         $totalrecord=count($entries);
         $entries = array_splice($entries,$showmore,5);
         
         if(empty($showmorelimit))
         {
          $showmorelimit=5;  
         }
         $output = $_ci->load->view('overview/feeds_view',array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,
        ), TRUE);

        return $output;

      },

      function() use ($_ci, $time, $limit,$showmorelimit,$showmore)
      {

        $_ci->load->model('medical_condition/mmedical_condition');

        $_ci->load->model('diagnosis/mdiagnosis');

        $_ci->load->model('medication/mmedication');

        $_ci->load->model('vaccination/mvaccination');
        $_ci->load->model('casehistory/mcasehistory');
        $_ci->load->model('familyhistory/mfamilyhistory');
        $_ci->load->model('graph/mgraph');


        # Here's for conditions

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $conditions = array_map(function($v) {

          $v->document_date = date('Y-m-d H:i:s', strtotime($v->document_date.' '.$v->document_time));
          return ($v->feed_type = 'condition') ? $v : $v;

        }, $_ci->mmedical_condition->get_all());


        # Here's for diagnosis

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $diagnosis = array_map(function($v) {
          return ($v->feed_type = 'diagnosis') ? $v : $v;

        }, $_ci->mdiagnosis->get_all_uncata());



        # Here's for medication

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $medication = array_map(function($v) {
          return ($v->feed_type = 'medication') ? $v : $v;

        }, $_ci->mmedication->get_all());



        # Here's vaccination

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $vaccination = array_map(function($v) {

          return ($v->feed_type = 'vaccination') ? $v : $v;

        }, $_ci->mvaccination->get_all());

        # Here's case history

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('date_added <=', date('Y-m-d H:i:s', $time));

        $_ci->m->port->m->limit($limit);

        $mcasehistory = array_map(function($v) {
            $v->feed_type = 'casehistory';
            $v->document_date = date('Y-m-d H:i:s', strtotime($v->date_added));
            
          return ($v->feed_type && $v->document_date) ? $v : $v;

        }, $_ci->mcasehistory->get_all());

		# Here's for family history
		$_ci->m->port->m->db_select();
                $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));                   
		$_ci->m->port->m->limit($limit);
                
        $mfamilyhistory = array_map(function($v) {
            $v->feed_type = 'familyhistory';
            $v->document_date = date('Y-m-d', strtotime($v->effective_time));
            
          return ($v->feed_type && $v->document_date) ? $v : $v;

        }, $_ci->mfamilyhistory->get_all());
        

        # Here's for blood_pressure

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);
        
        $graph_entries = $_ci->mgraph->get_heart_frequency();
        $blood_pressure = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'blood_pressure',

          'entries' => $graph_entries,

          'id' => 0, 
          'document_date' => (isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time))? $graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time: date('Y-m-d H:i:s', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d H:i:s', $time),
        
        ), ) : array();


        # Here's for blood_sugar

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_blood_sugar();

        $blood_sugar = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'blood_sugar',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' => isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d H:i:s', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d H:i:s', $time),

        ), ) : array();

        # Here's for weight_bmi

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_weight_bmi();

        $weight_bmi = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'weight_bmi',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' =>  isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d', $time),
          'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d', $time),

        ), ) : array();



        # Here's for marcumar

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));


        $_ci->m->port->m->limit($limit);

        $graph_entries = $_ci->mgraph->get_marcumar();

       $marcumar = !empty($graph_entries) ? array( (object) array(

          'feed_type' => 'marcumar',

          'entries' => $graph_entries,

          'id' => 0, 

          'document_date' =>  isset($graph_entries[0]->rec_date) && isset($graph_entries[0]->rec_time)? strtotime($graph_entries[0]->rec_date.' '.$graph_entries[0]->rec_time): date('Y-m-d', $time),
       	  'date_added' => isset($graph_entries[0]->date_added) ? $graph_entries[0]->date_added : date('Y-m-d', $time),
           ), ) : array();



        
        $graph_entries_complete = array();

        $graph_entries_complete = array_merge($graph_entries_complete, $blood_pressure);

        $graph_entries_complete = array_merge($graph_entries_complete, $blood_sugar);

        $graph_entries_complete = array_merge($graph_entries_complete, $weight_bmi);

        $graph_entries_complete = array_merge($graph_entries_complete, $marcumar);
        
        $entries_other=array();
        
        $entries_other = array_merge($entries_other, $conditions);

        $entries_other = array_merge($entries_other, $diagnosis);

        $entries_other = array_merge($entries_other, $medication);

        $entries_other = array_merge($entries_other, $vaccination);

        $entries_other = array_merge($entries_other, $mcasehistory);
        
        $entries_other = array_merge($entries_other, $mfamilyhistory);
        
       	/*usort($entries_other, function($a,$b) 
        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });
        
        usort($graph_entries_complete, function($a,$b) 
        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });*/

		$entries = array_merge($graph_entries_complete, $entries_other);
        usort($entries, function($a,$b) 
	     {
         	return strtotime(@$a->document_date) < strtotime(@$b->document_date) ? 1 : (strtotime(@$a->document_date) == strtotime(@$b->document_date) ? (@$a->date_added < @$b->date_added ? 1 : -1) : -1);
         });
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        
        if(empty($showmorelimit))
        {

             $showmorelimit=5;  

        }

        $output = $_ci->load->view('overview/feeds_view', array(
            'entries' => $entries,

            'show_more'=>$showmorelimit,
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

 /**
  *
  */

  public function vital_values()

  {



  }

}



/* End of file feed.php */

/* Location: ./application/modules/akte/controllers/feed.php */