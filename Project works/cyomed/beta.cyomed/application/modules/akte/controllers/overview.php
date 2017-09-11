<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends MX_Controller 
{
  /**
   *
   */
  public function index()
  {
    $this->timeline();
  }
  /**
   *
   */
  public function graph_view()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('global/overview',$this->m->user_value('language'));

    $this->ui->mc->base_init();

    $this->ui->mc->title->content = $this->lang->line('general_text_menu_overview_top');

    $this->m->role_diff(
      function() use ($_ci){
        if (!$_ci->m->us_id())
        {
          $_ci->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }

        
        $_ci->load->model('graph/mgraph');
        $category = $_ci->mgraph->get_all();
       

        if (Ui::$bs_tname == 'sa103')
        {
          $this->ui->mc->content->content = $this->load->view('overview/shortcuts_view', array(), TRUE);
        }
        else
        {
          $this->ui->mc->content->content = '';
        }

        $_ci->ui->mc->append_content('quick_stats')->content = $_ci->load->view('graph/quick_stat_mc_view', array(
          'quick_stats' => array(
            array('desc' => 'Puls', 'entries' => $category->heart_frequency, 'field' => 'puls', ),
            array('desc' => 'Blutzucker', 'entries' => $category->blood_sugar, 'field' => 'bloodsugar', ),
            array('desc' => 'Gewicht &amp; BMI', 'entries' => $category->weight_bmi, 'field' => 'bmi', ),
            array('desc' => 'Marcumar', 'entries' => $category->marcumar, 'field' => 'INR', ),
          )
        ), TRUE);

        $this->ui->mc->append_content('quick_stats_hr', '<hr class="whiter" />');

        $_ci->ui->mc->append_content('additional_block_0')->content = $_ci->load->view('overview/overview_patient_view', array(
          'category' => $category,
        ), TRUE);
        $_ci->ui->mc->append_content('additional_block_1')->content = '&nbsp;';
        $_ci->ui->mc->append_content('additional_block_2')->content = '&nbsp;';
      },
      function() use ($_ci){
        
        $_ci->load->model('graph/mgraph');
        $category = $_ci->mgraph->get_all();

        if (Ui::$bs_tname == 'sa103')
        {
          $this->ui->mc->content->content = $this->load->view('overview/shortcuts_view', array(), TRUE);
        }
        else
        {
          $this->ui->mc->content->content = '';
        }

        $_ci->ui->mc->append_content('quick_stats')->content = $_ci->load->view('graph/quick_stat_mc_view', array(
          'quick_stats' => array(
            array('desc' => 'Puls', 'entries' => $category->heart_frequency, 'field' => 'puls', ),
            array('desc' => 'Blutzucker', 'entries' => $category->blood_sugar, 'field' => 'bloodsugar', ),
            array('desc' => 'Gewicht &amp; BMI', 'entries' => $category->weight_bmi, 'field' => 'bmi', ),
            array('desc' => 'Marcumar', 'entries' => $category->marcumar, 'field' => 'INR', ),
          )
        ), TRUE);

        $this->ui->mc->append_content('quick_stats_hr', '<hr class="whiter" />');

        $_ci->ui->mc->append_content('additional_block_0')->content = $_ci->load->view('overview/overview_patient_view', array(
          'category' => $category,
        ), TRUE);
        $_ci->ui->mc->append_content('additional_block_1')->content = '&nbsp;';
        $_ci->ui->mc->append_content('additional_block_2')->content = '&nbsp;';
      }
    );
    $this->output->set_output($this->ui->mc->output());
  }
  /**
   *
   */
  public function timeline()
  {
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('global/overview',$this->m->user_value('language'));
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
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
                    ->set_active_url('akte/overview/timeline');
    }
    /***end here***/
    
    $this->ui->mc->title->content = '';
    // $this->ui->mc->breadcrumb->options('enabled', FALSE);
    $this->m->role_diff(
    function() use ($_ci)
    {
        if(isset($_REQUEST['check']))
        {
         $check=$_REQUEST['check'];
        }
        else
        {
         $check="";  
        }
        /*
         *  get top 3 reservation 
         */
         $this->load->model('reservation/mreservation');
         $user_id = $this->m->user_id();
         $search_condition = array(
            'doctor_id' =>$user_id,
            'date(start)>=' => date('Y-m-d'),
            'accept' => 0
         );
        $latest_doc_reservation = $this->mreservation->getReservation($search_condition,'3','2');
        
        /*
         * get today accepted reservation
         */
        $accepted_res_condition = array(
            'doctor_id' =>$user_id,
            'date(start)=' => date('Y-m-d'),
            'accept' => 1
         );
        $accepted_doc_reservation = $this->mreservation->getReservation($accepted_res_condition,'','2');
        
        /*
         * get sepcification  
         */
       /* $this->load->Model('Speciality');
        $speciallity = $this->Speciality->get_assoc();
        print "<pre>";
        print_r($speciallity);*/
        
        $rezeptdata = array();
        $rezeptdata = $this->modoc->get_epres_list();
        $profilevisit=array();
        $profilevisit= $this->modoc->profile_visit_record();
        $_ci->load->model('iconsult/miconsult');
        $econsult=$_ci->miconsult->get_econsult_doctor();
        $_ci->load->model('graph/mgraph');
        $graph_category = $_ci->mgraph->get_all();
        $_ci->ui->mc->content->content = '';
        $_ci->ui->mc->append_content('timeline')->content = $_ci->load->view('overview/overview_timeline_view', array(
          'graph_category' => $graph_category,'check'=>$check,'rezeptdata' =>$rezeptdata,'profilevisit'=>$profilevisit
            ,'econsult'=>$econsult,'latest_doc_reservation' => $latest_doc_reservation,'accepted_doc_reservation' =>$accepted_doc_reservation
        ), TRUE);
    },
    function() use ($_ci)
    {
        if(isset($_REQUEST['check']))
        {
         $check=$_REQUEST['check'];
        }
        else
        {
         $check="";  
        }
        $_ci->load->model('graph/mgraph');
        $graph_category = $_ci->mgraph->get_all();
        $_ci->load->model('iconsult/miconsult');
        $econsult=$_ci->miconsult->get_econsult_patient();
        $_ci->ui->mc->content->content = '';
        /*
     *  get latest reservation 
     */
    $this->load->model('reservation/mreservation');
     $user_id = $this->m->user_id();
     $search_condition = array(
         'patient_id' =>$user_id,
         'date(start)>=' => date('Y-m-d'),
         'accept' => 1
      );
     

     $latest_reservation  = $this->mreservation->getReservation($search_condition,3,1,'asc','start');
     $all_reservation = $this->mreservation->getReservation($search_condition);
     
        $_ci->ui->mc->append_content('timeline')->content = $_ci->load->view('overview/overview_timeline_view', array(
          'graph_category' => $graph_category,'check'=>$check,'econsult'=>$econsult,'latest_reservation' => $latest_reservation,
          'all_reservation' => $all_reservation
        ), TRUE);
    });
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
  
  public function getPatientReservation(){
      $this->load->model('reservation/mreservation');
     $user_id = $this->m->user_id();
     $search_condition = array(
         'patient_id' =>$user_id,
         'date(start)' =>$_POST['date'],
         'accept' => 1
      );
     $html_str= '';
     $latest_reservation  = $this->mreservation->getReservation($search_condition);
     if(is_array($latest_reservation) && count($latest_reservation)>0){
         foreach($latest_reservation as $l_reservation){    
      $html_str.='<li><div class="aktuell-icon"><span class=""></span></div>
                        <p class="font-bold">'.date("d.F Y, h:i",strtotime($l_reservation->start)).'</p>
                        <div><a href=""accesskey="" class="font-bold"></a></div>
                        <div>Dr.'.$l_reservation->doctor->name.' '.$l_reservation->doctor->surname.'</div>
                        <div>'.$l_reservation->doctor->city.", ".$l_reservation->doctor->region.'</div>
                    </li>';
      
     }
     echo $html_str;
     }else{
        echo $html_str; 
     }
     die();
  }
  
  public function getDoctorReservation(){
     $this->load->model('reservation/mreservation');
     $user_id = $this->m->user_id();
     $update_params = array('accept'=>'1');
     $id = $_POST['reserv_id'];
     $this->mreservation->updateReserv($id, $update_params);
      
     $search_condition = array(
            'doctor_id' =>$user_id,
            'date(start)>=' => date('Y-m-d'),
            'accept' => 0
         );
     $html_str= '';
     $latest_reservation  = $this->mreservation->getReservation($search_condition);
     if(is_array($latest_reservation) && count($latest_reservation)>0){
        $html_str ='<table class="table table-condensed">'; 
         foreach($latest_reservation as $l_doc_reservation){    
      $html_str.='<tr>
                                        <td width="25%">'.date("d-m-Y",strtotime($l_doc_reservation->start)).'</td>
                                        <td width="25%">'.date("h:i",strtotime($l_doc_reservation->start)).'</td>
                                        <td width="25%">'.$l_doc_reservation->first_name.' '.$l_doc_reservation->last_name.'</td>
                                        <td width="25%">
                                            <input type="hidden" name="reserv_id" id="reserv_id" value="'.$l_doc_reservation->id.'" />
                                            <button class="btn btn-success" id="accept_reservation_button" onclick="acceptResv(\''.$l_doc_reservation->id.'\')" ia-action="reservation-action" data-action="accept"><span class="icomoon i-checkmark-circle-2"></span></button>
                                            <div id="loading_'.$l_doc_reservation->id.'"></div>
                                        </td>
                                    </tr>';
      
     }
     $html_str .="</table>";
     echo $html_str;
     }else{
        echo $html_str; 
     }
     exit;
      
  }  
  
}

/* End of file overview.php */
/* Location: ./application/modules/akte/controllers/overview.php */