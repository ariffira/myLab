<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends MX_Controller 
{

  /**
   *
   */
  public function index()
  {
    
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    
  	$this->ui->mc->base_init();
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
                    ->set_active_url('akte/document');
        }
        /***end here***/
  	$this->ui->mc->title->content = $this->lang->line('general_text_menu_side_nav_document');

    $this->ui->mc->content->content = $this->load->view('document/document_view', array(), TRUE);

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
   */
  public function connector()
  {

    /**
     * Simple function to demonstrate how to control file access using "accessControl" callback.
     * This method will disable accessing files/folders starting from '.' (dot)
     *
     * @param  string  $attr  attribute name (read|write|locked|hidden)
     * @param  string  $path  file path relative to volume root directory started with directory separator
     * @return bool|null
     **/
    function access($attr, $path, $data, $volume) {
	
	return
        // if file/folder begins with '.' (dot)
        strpos(basename($path), '.') === 0 || strpos(basename($path), 'index.html') === 0 ? 
        
        // set read+write to false, other (locked+hidden) set to true
        !($attr == 'read' || $attr == 'write') :
        
        // else elFinder decide it itself
        NULL;
    }


    // Documentation for connector options:
    // https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options

    $this->load->model('document/mdoc');
    $opts = array(
      // 'debug' => true,
      'roots' => array(),
    );
    $path = $this->m->role_diff(function() {
      return $this->mdoc->check_upload_path($this->mdoc->get_upload_path());
    }, function() {
      return $this->mdoc->check_upload_path($this->mdoc->get_upload_path(), TRUE);
    });

    $common_roots = array(
      // driver for accessing file system (REQUIRED)
      // 'driver'        => 'LocalFileSystem',
      'driver'        => 'LocalDBConn',
      'files_table'   => $this->m->port->p->dbprefix.'elfinder_files',

      // path to files (REQUIRED)
      // 'path'          => $path,

      // URL to files (REQUIRED)
      // 'URL'           => base_url($path),

      // disable and hide dot starting files (OPTIONAL)
      'accessControl' => 'access',

      // Allowed Types
      'uploadAllow'   => array('image', 'text/plain', 'csv', 'doc', 'xls', 'ppt', 'pps', 'pdf', 'odt', 'ott', 'oth', 'odm', 'odg', 'otg', 'odp', 'otp', 'ods', 'ots', 'odc', 'odf', 'odb', 'odi', 'oxt', 'docx', 'docm', 'dotx', 'dotm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xlam', 'pptx', 'pptm', 'ppsx', 'ppsm', 'potx', 'potm', 'ppam', 'sldx', 'sldm', ),

      // Alias
      // 'alias'         => 'Meine_'.$this->m->user()->regid,
    );

    if ($path)
    {
      $opts['roots'][] = array_merge($common_roots, array(
        // path to files (REQUIRED)
        'path'          => $path,

        // Alias
        'alias'         => 'Meine_'.$this->m->user()->regid,
      ));
    }

    $path = $this->mdoc->check_upload_path($this->mdoc->get_us_upload_path(), TRUE);

    if ($path)
    {
      $opts['roots'][] = array_merge($common_roots, array(
        // path to files (REQUIRED)
        'path'          => $path,

        // Alias
        'alias'         => 'Patient_'.$this->m->us()->regid,
      ));
    }

    // $opts['roots'][] = array(
    //   'driver'        => 'MySQL',
    //   'host'          => $this->m->port->p->hostname,
    //   'user'          => $this->m->port->p->username,
    //   'pass'          => $this->m->port->p->password,
    //   'db'            => $this->m->port->p->database,
    //   'files_table'   => $this->m->port->p->dbprefix.'elfinder_file',
    //   'path'          => 1,

    //   // Alias
    //   'alias'         => 'MySQL_'.$this->m->user()->regid,
    // );

	
    // run elFinder
    $this->load->library('elfinder_lib', $opts);

  }

	/**
   	 *
   	 */
//
//	public function feed($time = NULL, $limit = 15)
//  	{
//    	static $_ci;
//    	if (empty($_ci)) $_ci =& get_instance();
//
//		if ($time === NULL)
//    	{
//      		$time = time();
//    	}
//
//    	if (!is_numeric($time))
//    	{
//      		if (strtotime($time) !== FALSE)
//      		{
//        		$time = strtotime($time);
//      		}
//			else
//			{
//				$time = time();
//			}
//	    }
//
//		if (!is_numeric($limit))
//    	{
//      		$limit = 15;
//    	}
//
//    	$this->ui->feed_item->base_init();
//    	/*** for adding header***/
//
//	    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
//	    { 
//	
//	    }
//
//    	else
//    	{
//			$this->config->load('ia24ui', TRUE, TRUE);
//	      	$this->ui->html
//						->base_init()
//	                	->load_config('html');
//     		$this->ui->html
//            	        ->set_active_url('akte/overview/timeline?check=medication');
//    	}
//
//    	/***end here***/
//
//		if(isset($_REQUEST['showmore']))
//      	{
//	        $showmorelimit=5;
//	        $showmorelimit+=$_REQUEST['showmore'];
//	    	$showmore=$_REQUEST['showmore'];
//      	}
//    	else
//      	{
//	        $showmorelimit=0;
//	        $showmore=0;
//      	}
//
//    	$output = $this->m->role_diff(
//	    	function() use ($_ci, $time, $limit,$showmorelimit,$showmore){
//		        if (!$_ci->m->us_id())
//		        {
//		        	return $_ci->load->view('not_chosen_view', array(), TRUE);
//		        }
//	
//		        $_ci->load->model('medication/mmedication');
//		        $_ci->m->port->m->db_select();
//		        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));
//		        $_ci->m->port->m->limit($limit);
//	
//		        $entries = $_ci->mmedication->get_all();
//		        $totalrecord=count($entries);
//		        $entries = array_splice($entries,$showmore,5);
//	
//	
//	        	if(empty($showmorelimit))
//	        	{
//	         		$showmorelimit=5;  
//	        	}
//	
//		        $output = $_ci->load->view('medication/medication_feed_view', array(
//		            'entries' => $entries,
//		            'show_more'=>$showmorelimit,
//		            'tot_record'=>$totalrecord,
//		
//		        ), TRUE);
//	
//	        	return $output;
//	      	},
//
//			function() use ($_ci, $time, $limit,$showmorelimit,$showmore){
//	        	
//				/*$_ci->load->model('diagnosis/mdiagnosis');
//				$_ci->load->model('vaccination/mvaccination');
//				$_ci->load->model('medical_condition/mmedical_condition');*/
//				$_ci->load->model('document/mdoc');
//				
//				$_ci->m->port->m->db_select();
//		        //$_ci->m->port->m->where('patient_id',$_ci->m->user_id());
//		        $_ci->m->port->m->order_by('id', 'desc');
//		        $_ci->m->port->m->limit($limit);
//		       
//		        $documents 	= $_ci->mdoc->get(array('patient_id'=>$_ci->m->user_id())); 
//		        
//		        $entries = array();
//		        $document_ids = '';
//		        
//		        foreach ($documents as $entry)
//		        {
//		        	if(!empty($entry->p_file_data))
//		        	{
//		        		$file_data = json_decode($entry->p_file_data);
//		        		if(file_exists($file_data->full_path))
//		        		{
//		        			$entries[$entry->id] = array('document_caption'=>$entry->document_caption,
//			        							 		'document_extension'=>$entry->document_extension,
//			        							 		'full_path'=>$file_data->full_path);
//		        			
//		        			$document_ids = $document_ids.$entry->id.',';
//		        		}
//		        		
//		        	}
//		        }
//		        
//		        $document_ids = rtrim($document_ids,',');
//		        
//		        $document_details = $_ci->mdoc->get_document_details($document_ids);
//
//		        $totalrecord=count($document_details);
//		        $document_details = array_splice($document_details,$showmore,5);
//				
//		        foreach ($document_details as $key=>$value)
//		        {
//		        	$document_details[$key]->document_caption 	= $entries[$document_details[$key]->document_id]['document_caption'];
//		        	$document_details[$key]->document_extension = $entries[$document_details[$key]->document_id]['document_extension'];
//		        	$document_details[$key]->full_path 			= $entries[$document_details[$key]->document_id]['full_path'];;
//		        }
//		        if(empty($showmorelimit))
//	    	    {
//	        		$showmorelimit=5;  
//	        	}
//	        	
//	        	$output = $_ci->load->view('document/document_feed_view', array(
//			            	'entries' => $document_details,
//			            	'show_more'=>$showmorelimit,
//			            	'tot_record'=>$totalrecord,
//	
//	        			), TRUE);
//	        	return $output;
//	
//	      	}
//
//    	);
//
//   		/**displaying for output***/
//
//    	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
//    	{
//      		$this->output->set_output($output);  
//    	}
//
//    	else
//    	{
//     		$this->output->set_output($this->ui->html->output());
//    	}
//
//    	/****end here***/
//
// 	}
//

  
  public function feed($time = NULL, $limit = 15)

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

                    ->set_active_url('akte/overview/timeline?check=document');

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

         $_ci->load->model('medical_condition/mmedical_condition');

         $_ci->load->model('diagnosis/mdiagnosis');

         $_ci->load->model('vaccination/mvaccination');
        
        $output = $this->m->role_diff(

        function() use ($_ci, $time, $showmorelimit,$showmore)
        {

         if (!$_ci->m->us_id())

         {

          return $_ci->load->view('not_chosen_view', array(), TRUE);

         }

         # Here's for conditions

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));

        $_ci->m->port->m->where('document_time <=', date('H:i', $time));


        $conditions = array_map(function($v) {

          return ($v->feed_type = 'condition') ? $v : $v;

        }, $_ci->mmedical_condition->get_all());

        # Here's for diagnosis

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));

   

        $diagnosis = array_map(function($v) {

          return ($v->feed_type = 'diagnosis') ? $v : $v;

        }, $_ci->mdiagnosis->get_all_uncata());

        # Here's for medication

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));



        $vaccination = array_map(function($v) {

          return ($v->feed_type = 'vaccination') ? $v : $v;

        }, $_ci->mvaccination->get_all());


        $entries_other=array();
        $entries_other = array_merge($entries_other, $conditions);

        $entries_other = array_merge($entries_other, $diagnosis);

        $entries_other = array_merge($entries_other, $vaccination);
        
        usort($entries_other, function($a,$b) 

        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });
        

         $entries =$entries_other;
         $totalrecord=count($entries);
         
        foreach ($entries as $key=>$entry)
		{
	        if(empty($entry->files))
	        {
	        	unset($entries[$key]);
	        }
	        else 
	        {
	        	$file_data = json_decode($entry->files[0]->p_file_data);
	        	if(!file_exists($file_data->full_path))
	        	{
	        		unset($entries[$key]);
	        	}
	        	
	        }
		}
		
         $entries = array_splice($entries,$showmore,5);
         
         if(empty($showmorelimit))
         {
          $showmorelimit=5;  
         }
         $output = $_ci->load->view('document/document_feed_view',array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,
        ), TRUE);

        return $output;

      },

      function() use ($_ci, $time, $showmorelimit,$showmore)
      {
        # Here's for conditions

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));

        $_ci->m->port->m->where('document_time <=', date('H:i', $time));

        $conditions = array_map(function($v) {

          return ($v->feed_type = 'condition') ? $v : $v;

        }, $_ci->mmedical_condition->get_all());

       # Here's for diagnosis

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));

        $diagnosis = array_map(function($v) {

          return ($v->feed_type = 'diagnosis') ? $v : $v;

        }, $_ci->mdiagnosis->get_all_uncata());

        # Here's vaccination

        $_ci->m->port->m->db_select();

        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));

        $vaccination = array_map(function($v) {

          return ($v->feed_type = 'vaccination') ? $v : $v;

        }, $_ci->mvaccination->get_all());

        $entries_other=array();
        $entries_other = array_merge($entries_other, $conditions);

        $entries_other = array_merge($entries_other, $diagnosis);

        $entries_other = array_merge($entries_other, $vaccination);

        usort($entries_other, function($a,$b) 

        {

          return strtotime(@$a->date_added) < strtotime(@$b->date_added) ? 1 : (strtotime(@$a->date_added) == strtotime(@$b->date_added) ? (@$a->id < @$b->id ? 1 : -1) : -1);

        });
        
         $entries = $entries_other;
        $totalrecord=count($entries);
        
     	foreach ($entries as $key=>$entry)
		{
	        if(empty($entry->files))
	        {
	        	unset($entries[$key]);
	        }
	        else 
	        {
	        	$file_data = json_decode($entry->files[0]->p_file_data);
	        	if(!file_exists($file_data->full_path))
	        	{
	        		unset($entries[$key]);
	        	}
	        	
	        }
		}
       
        $entries = array_splice($entries,$showmore,5);
        
        if(empty($showmorelimit))
        {

             $showmorelimit=5;  

        }

        $output = $_ci->load->view('document/document_feed_view', array(
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
  
}

/* End of file document.php */
/* Location: ./application/modules/akte/controllers/document.php */