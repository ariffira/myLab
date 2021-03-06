<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Medication extends MX_Controller {

  /**
   *
   */

  public function index($id='')

  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();


    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('pwidgets/medication', $this->m->user_value('language'));  

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
                    ->set_active_url('akte/medication');

    }
    /***end here***/
//    $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', time()));
    $this->ui->mc->title->content = 'Medikamente';
    
    $this->m->role_diff(
      function() use ($_ci,$id){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }

        $_ci->load->model('medication/mmedication');
        
        $this->ui->mc->content->content = $_ci->load->view('medication/medication_view', array(
          'entries' => $_ci->mmedication->get_all(),'detail_id'=>$id
        ), TRUE);
      },

      function() use ($_ci,$id){
        $_ci->load->model('medication/mmedication');

        $entries = $_ci->mmedication->get_all();
        $this->ui->mc->content->content = $_ci->load->view('medication/medication_view', array(
          'entries' => $entries,'detail_id'=>$id

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
   */

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
                    ->set_active_url('akte/overview/timeline?check=medication');
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
    function() use ($_ci, $time, $limit,$showmorelimit,$showmore){
        if (!$_ci->m->us_id())
        {
          return $_ci->load->view('not_chosen_view', array(), TRUE);
        }

        $_ci->load->model('medication/mmedication');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));
        $_ci->m->port->m->limit($limit);

        $entries = $_ci->mmedication->get_all();
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);


        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }

        $output = $_ci->load->view('medication/medication_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,

        ), TRUE);

        return $output;
      },

      function() use ($_ci, $time, $limit,$showmorelimit,$showmore){
        
        $_ci->load->model('medication/mmedication');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mmedication->get_all();
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);

        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }

        $output = $_ci->load->view('medication/medication_feed_view', array(
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

  public function insert()
  {

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    echo $result = $this->m->role_diff( 
      function() use ($_ci){

        $_ci->load->model('medication/mmedication');

        $taken_time = $_ci->input->post('taken_time');
        $taken_time = !empty($taken_time) && is_array($taken_time) ? implode(",", $taken_time):"";
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 
        $insert_data = array(
          'patient_id'         => $_ci->m->us_id(), 
          'memory_enable'      => $_ci->input->post('memory_enable'), 
          'name'               => $_ci->input->post('name'), 
          'atc_code'           => $_ci->input->post('atc_code'), 
          'substance'          => $_ci->input->post('substance'), 
          'dose_rate'          => $_ci->input->post('dose_rate'), 
          'comments'           => $_ci->input->post('comments'), 
          'taken_morning'      => $_ci->input->post('morning'), 
          'taken_morning_time' => $_ci->input->post('morning_time'), 
          'taken_lunch'        => $_ci->input->post('lunch'), 
          'taken_lunch_time'   => $_ci->input->post('lunch_time'), 
          'taken_evening'      => $_ci->input->post('evening'), 
          'taken_evening_time' => $_ci->input->post('evening_time'), 
          'taken_night'        => $_ci->input->post('night'), 
          'taken_night_time'   => $_ci->input->post('night_time'), 
          'repeating_periods'  => $_ci->input->post('repeating_periods'), 
          'iv'                 => $_ci->input->post('iv') ? 1 : 0, 
          'po'                 => $_ci->input->post('po') ? 1 : 0, 
          'sc'                 => $_ci->input->post('sc') ? 1 : 0, 
          'im'                 => $_ci->input->post('im') ? 1 : 0, 
          'access_permission'  => $_ci->m->us_access(), 
          'taking_regularly'   => $_ci->input->post('taking_regularly'), 
          'taking_needed'      => $_ci->input->post('taking_needed'),
          'taken_since'        => date('Y-m-d', strtotime($_ci->input->post('since'))),
          'document_date'      => $documet_date,
          'date_added'         => TRUE,
          // 'date_modified'      => date('Y-m-d'),
          'bis_to'             => date('Y-m-d', strtotime($_ci->input->post('bis_to'))),
          'taken_time'         => $taken_time,
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),
        );

        return $_ci->mmedication->insert($insert_data);

      },

      function() use ($_ci){
        $_ci->load->model('medication/mmedication');

        $taken_time = $_ci->input->post('taken_time');
        $taken_time = !empty($taken_time) && is_array($taken_time) ? implode(",", $taken_time):"";
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 

        $insert_data = array(
          'patient_id'        => $_ci->m->user_id(), 
          'memory_enable'      => $_ci->input->post('memory_enable'), 
          'name'               => $_ci->input->post('name'), 
          'atc_code'           => $_ci->input->post('atc_code'), 
          'substance'          => $_ci->input->post('substance'), 
          'dose_rate'          => $_ci->input->post('dose_rate'), 
          'comments'           => $_ci->input->post('comments'), 

          // 'taken_morning'      => $_ci->input->post('morning'), 
          // 'taken_morning_time' => $_ci->input->post('morning_time'), 
          // 'taken_lunch'        => $_ci->input->post('lunch'), 
          // 'taken_lunch_time'   => $_ci->input->post('lunch_time'), 
          // 'taken_evening'      => $_ci->input->post('evening'), 
          // 'taken_evening_time' => $_ci->input->post('evening_time'), 
          // 'taken_night'        => $_ci->input->post('night'), 
          // 'taken_night_time'   => $_ci->input->post('night_time'), 

          
          'repeating_periods'  => $_ci->input->post('repeating_periods'), 
          'iv'                 => $_ci->input->post('iv') ? 1 : 0, 
          'po'                 => $_ci->input->post('po') ? 1 : 0, 
          'sc'                 => $_ci->input->post('sc') ? 1 : 0, 
          'im'                 => $_ci->input->post('im') ? 1 : 0, 
          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'taking_regularly'   => $_ci->input->post('taking_regularly'), 
          'taking_needed'      => $_ci->input->post('taking_needed'),
          'taken_since'        => date('Y-m-d', strtotime($_ci->input->post('since'))),
          'document_date'      => $documet_date,
          'date_added'         => TRUE,
          // 'date_modified'      => date('Y-m-d'),
          'bis_to'             => date('Y-m-d', strtotime($_ci->input->post('bis_to'))),
          'taken_time'         => $taken_time,
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),
        );

        return $_ci->mmedication->insert($insert_data);

      }

    );

    ajax_redirect('akte/medication');

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



    echo $result = $this->m->role_diff(

      function() use ($_ci, $id){

        if (empty($id)) return FALSE;
        if (!$_ci->m->us_id()) return FALSE;

        $_ci->load->model('medication/mmedication');
		
        $taken_time = $_ci->input->post('taken_time');
        $taken_time = !empty($taken_time) && is_array($taken_time) ? implode(",", $taken_time):"";
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 
        
        $update_data = array(

          'memory_enable'      => $_ci->input->post('memory_enable'), 



          'name'               => $_ci->input->post('name'), 

          'atc_code'           => $_ci->input->post('atc_code'), 

          'substance'          => $_ci->input->post('substance'), 

          'dose_rate'          => $_ci->input->post('dose_rate'), 

          'comments'           => $_ci->input->post('comments'), 

          

          'taken_morning'      => $_ci->input->post('morning'), 

          'taken_morning_time' => $_ci->input->post('morning_time'), 

          'taken_lunch'        => $_ci->input->post('lunch'), 

          'taken_lunch_time'   => $_ci->input->post('lunch_time'), 

          'taken_evening'      => $_ci->input->post('evening'), 

          'taken_evening_time' => $_ci->input->post('evening_time'), 

          'taken_night'        => $_ci->input->post('night'), 

          'taken_night_time'   => $_ci->input->post('night_time'), 

          

          'repeating_periods'  => $_ci->input->post('repeating_periods'), 

          'iv'                 => $_ci->input->post('iv') ? 1 : 0, 

          'po'                 => $_ci->input->post('po') ? 1 : 0, 

          'sc'                 => $_ci->input->post('sc') ? 1 : 0, 

          'im'                 => $_ci->input->post('im') ? 1 : 0, 

          'taking_regularly'   => $_ci->input->post('taking_regularly'), 

          'taking_needed'      => $_ci->input->post('taking_needed'),



          'taken_since'        => date('Y-m-d', strtotime($_ci->input->post('since'))),

          'document_date'      => $documet_date,

          // 'date_added'         => date('Y-m-d'),
		  'taken_time'	=> $taken_time,
          'date_modified'      => date('Y-m-d'),

          'bis_to'             => date('Y-m-d', strtotime($_ci->input->post('bis_to'))),

        );



        return $_ci->mmedication->update(

          array(                      

            'id'         => $id,

            'patient_id' => $_ci->m->us_id(), 

            'access_permission >=' => $_ci->m->us_access(),

          ),

          $update_data

        );

      },

      function() use ($_ci, $id){

        if (empty($id)) return FALSE;

		$taken_time = $_ci->input->post('taken_time');
        $taken_time = !empty($taken_time) && is_array($taken_time) ? implode(",", $taken_time):"";
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 

        $_ci->load->model('medication/mmedication');

        $update_data = array(

          'memory_enable'      => $_ci->input->post('memory_enable'), 



          'name'               => $_ci->input->post('name'), 

          'atc_code'           => $_ci->input->post('atc_code'), 

          'substance'          => $_ci->input->post('substance'), 

          'dose_rate'          => $_ci->input->post('dose_rate'), 

          'comments'           => $_ci->input->post('comments'), 

          

          'taken_morning'      => $_ci->input->post('morning'), 

          'taken_morning_time' => $_ci->input->post('morning_time'), 

          'taken_lunch'        => $_ci->input->post('lunch'), 

          'taken_lunch_time'   => $_ci->input->post('lunch_time'), 

          'taken_evening'      => $_ci->input->post('evening'), 

          'taken_evening_time' => $_ci->input->post('evening_time'), 

          'taken_night'        => $_ci->input->post('night'), 

          'taken_night_time'   => $_ci->input->post('night_time'), 

          

          'repeating_periods'  => $_ci->input->post('repeating_periods'), 

          'iv'                 => $_ci->input->post('iv') ? 1 : 0, 

          'po'                 => $_ci->input->post('po') ? 1 : 0, 

          'sc'                 => $_ci->input->post('sc') ? 1 : 0, 

          'im'                 => $_ci->input->post('im') ? 1 : 0, 

          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 

          'taking_regularly'   => $_ci->input->post('taking_regularly'), 

          'taking_needed'      => $_ci->input->post('taking_needed'),



          'taken_since'        => date('Y-m-d', strtotime($_ci->input->post('since'))),

          'document_date'      => $documet_date,

          // 'date_added'         => date('Y-m-d'),
          'taken_time'	=> $taken_time,

          'date_modified'      => date('Y-m-d'),

          'bis_to'             => date('Y-m-d', strtotime($_ci->input->post('bis_to'))),

        );



        return $_ci->mmedication->update(

          array(

            'id'         => $id,

            'patient_id' => $_ci->m->user_id(), 

          ),

          $update_data

        );

      }

    );



    ajax_redirect('akte/medication/index/'.$id);

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



        $_ci->load->model('medication/mmedication');

        return $_ci->mmedication->delete(

          array(

            'id' => $id, 

            'patient_id' => $_ci->m->us_id(), 

            'access_permission >=' => $_ci->m->us_access(),

          )

        );

      },

      function() use ($_ci, $id){

        if (empty($id)) return FALSE;



        $_ci->load->model('medication/mmedication');

        return $_ci->mmedication->delete(

          array(

            'id' => $id, 

            'patient_id' => $_ci->m->user_id(), 

          )

        );

      }

    );



    ajax_redirect('akte/medication');

  }



  /**
   *
   */

  public function archive($id)

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



        $_ci->load->model('medication/mmedication');

        return $_ci->mmedication->update(

          array(

            'id' => $id, 

            'patient_id' => $_ci->m->us_id(), 

            'access_permission >=' => $_ci->m->us_access(),

          ), 

          array(

            'delete_status' => 1,  

            'date_modified' => TRUE, 

          )

        );

      },

      function() use ($_ci, $id){

        if (empty($id)) return FALSE;



        $_ci->load->model('medication/mmedication');

        return $_ci->mmedication->update(

          array(

            'id' => $id, 

            'patient_id' => $_ci->m->user_id(), 

          ), 

          array(

            'delete_status' => 1,  

            'date_modified' => TRUE, 

          )

        );

      }

    );



    ajax_redirect('akte/medication');

  }
  /*
   * fetch medication data of already taken medication
   */
  
  function fetchmedication(){
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      $this->load->library('encrypt');
        $this->load->library('aes_encrypt');
      $patientid = $this->input->post('patientId');
      $atc_code = $this->input->post('atc_code');
      $_ci->load->model('medication/mmedication');
      $_ci->m->port->m->db_select();
      $_ci->m->port->m->where('patient_id =',$patientid);
      //$_ci->m->port->m->limit(1);
      $entries = $_ci->mmedication->get_all();
      $data = array();
      foreach($entries as $entrie){
         $atcCode = $entrie->atc_code;
	 if($atcCode==$atc_code){
           $data['id'] =  $entrie->id;
           $data['atc_code'] =  $entrie->atc_code;
           $data['dose_rate'] =  $entrie->dose_rate;
           $data['repeating_periods'] =  $entrie->repeating_periods;
           if( $entrie->taken_since!=''){
               $taken_date = date("d.m.Y",strtotime($entrie->taken_since)); 
             $data['taken_since'] =  $taken_date;
           }else{
             $data['taken_since'] = '';  
           }
           if($entrie->taken_time!=''){
              $taken_time_arr = explode(",",$entrie->taken_time);
              foreach($taken_time_arr as $v){
                 $taken_time_arr_new[] =  substr($v,0,2).':'.substr($v,2,2);
              }
              $takentime = implode(",",$taken_time_arr_new);
              $data['taken_time'] = $takentime;
           }else{
            $data['taken_time'] = '';   
           }
           
           break;
         }
          
      }
      if(!empty($data)){
         echo json_encode($data);
          
      }else{
          echo '';
      }
      die();
  }


  /**
   *
   */
  public function remove_file($id)
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

        $_ci->m->port->m->where('id', $id);
        $_ci->m->port->m->limit(1);
        $_ci->m->port->m->db_select();
        return $_ci->m->port->m->delete('medication_files');
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->m->port->m->where('id', $id);
        $_ci->m->port->m->limit(1);
        $_ci->m->port->m->db_select();
        return $_ci->m->port->m->delete('medication_files');
      }
    );

    ajax_redirect('akte/medication');
  }


}





/* End of file medication.php */

/* Location: ./application/modules/akte/controllers/medication.php */