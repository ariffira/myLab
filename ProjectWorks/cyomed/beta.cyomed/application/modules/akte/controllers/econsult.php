<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Econsult extends MX_Controller {

  /**
   *
   */
  public function index($id='')
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/all_access', $this->m->user_value('language'));
    $this->load->language('patients/iconsult', $this->m->user_value('language'));

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
                    ->set_active_url('akte/econsult');
    }
    /***end here***/
    $this->ui->mc->title->content = $this->lang->line('general_text_menu_side_nav_document');
    $this->m->role_diff(
      function() use ($_ci,$id){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }  
        $_ci->load->model('iconsult/miconsult');
        $this->ui->mc->content->content = $_ci->load->view('econsult/econsult_view', array(
          'category' => $_ci->miconsult->get_all(),
            'patient_id'=>false,
            'detail_id'=>$id,
        ), TRUE);
      },
      function() use ($_ci,$id){
        $_ci->load->model('iconsult/miconsult');
        $this->ui->mc->content->content = $_ci->load->view('econsult/econsult_view', array(
          'category' => $_ci->miconsult->get_all(),
            'family_doctor'=> $_ci->miconsult->get_familydoctor($this->m->user_id()),
            'patient_id'=>false,
            'detail_id'=>$id,
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
                    ->set_active_url('akte/overview/timeline?check=econsult');
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
       $output = $this->m->role_diff(
       function() use ($_ci, $time, $limit,$showmorelimit,$colorclass,$showmore)
       {
        if (!$_ci->m->us_id())
        {
          return $_ci->load->view('not_chosen_view', array(), TRUE);
        }
        $_ci->load->model('iconsult/miconsult');
        $_ci->m->port->m->db_select();
//        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));
//        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));
//        $_ci->m->port->m->where('document_time <=', date('H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->miconsult->get_all();
      echo "<pre>";print_r($entries);die;
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
             $showmorelimit=5;  
        }
        $output = $_ci->load->view('econsult/econsult_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'colorclass'=>$colorclass,
            'tot_record'=>$totalrecord,
        ), TRUE);
        return $output;
      },
      function() use ($_ci, $time, $limit,$showmorelimit,$colorclass,$showmore){
          
        $_ci->load->model('iconsult/miconsult');
//        $_ci->m->port->m->db_select();
//        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));
//        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));
//        $_ci->m->port->m->where('document_time <=', date('H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->miconsult->get_all();
//        echo "<pre>";print_r($entries);die;
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('econsult/econsult_feed_view', array(
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

  /**
   *
   */
  public function insert()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    echo $result = $this->m->role_diff(
      function() use ($_ci){
        return FALSE;
      },
      function() use ($_ci){
        $_ci->load->model('iconsult/miconsult');
        $insert_data = array(
          'patient_id'        => $_ci->m->user_id(), 
          'document_date'     => date("Y-m-d", strtotime($_ci->input->post('document_date'))),  
//          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'date_added'        => TRUE, 
          'keyword'           => $_ci->input->post('keyword'), 
          'message'           => $_ci->input->post('message'), 
          'question_status'   => 0, 
//           'doctorcheck'=>$_ci->input->post('cyomeddoctor'), 
        );
         $doctor_check=$_ci->input->post('cyomeddoctor');
          $doctor_id=$_ci->input->post('doctor_id');
        if($doctor_check==1 || $doctor_check==2){
            $insert_data['doctorcheck']=$doctor_check;
        }
          
          if($doctor_check==1){
             
              if(!empty($doctor_id)){
                $familydoctors=implode(',',$doctor_id);
                $familydoctorentry = array('familydoctor'  => $familydoctors,); 
                $insert_data=array_merge($insert_data,$familydoctorentry);
              }
                    else{
                        $family_doctor=$this->miconsult->get_familydoctor($_ci->m->user_id());
                        if(empty($family_doctor)){
                              $this->m->port->m->set('familydoctor',NULL);
                        }
                        else {
                         $string_family_doctor="";
                        foreach($family_doctor as $doctors){
                            $doctor=(array)$doctors;
                            $string_family_doctor.=$doctor['doctor_inserted_id'].',';                            
                        }
                      $string_family_doctor=  rtrim($string_family_doctor, ',');
                     $familydoctorentry = array('familydoctor'  => $string_family_doctor,); 
                     $insert_data=array_merge($insert_data,$familydoctorentry);

                        }
                    }
          }
        return $_ci->miconsult->insert($insert_data);
      }
    );

    ajax_redirect('akte/econsult');
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

        $_ci->load->model('iconsult/miconsult');
        $update_data=array();
        if ($reply_masg=($_ci->input->post('reply')=='reply' && $_ci->input->post('reply_message')) || $_ci->input->post('reply_message'))
        {
           $_ci->miconsult->insert_reply(
            array( 
            'doc_reg_id' => $_ci->m->user_value('regid'),  
            'reply_by' =>  0, 
            'reply_date' => TRUE,
            'reply_message' => $_ci->input->post('reply_message'),                     
              'iconsult_id'         => $id,
              'patient_id'          => $_ci->m->us_id(), 
              )
            );
            $update_data['question_status']=1;
        }
        if(!$reply_masg){
        $update_data1 = array(
          'keyword'           => $_ci->input->post('keyword'), 
          'message'           => $_ci->input->post('message'), 
          'document_date'     => date("Y-m-d", strtotime($_ci->input->post('document_date'))), 
          'date_modified'     => TRUE, 
//          'question_status'   => $_ci->input->post('question_status') ? $_ci->input->post('question_status') : 0, 
      
        );
        $update_data=array_merge($update_data,$update_data1);
        }
       
        return $_ci->miconsult->update(
          array(                      
            'id'         => $id,
            'patient_id' => $_ci->m->us_id(), 
            'doctorcheck >=' => $_ci->m->us_access(),
          ),
          $update_data
        );
      },

      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('iconsult/miconsult');
          $update_data=array();
        if ($reply_masg=($_ci->input->post('reply')=='reply' && $_ci->input->post('reply_message')) || $_ci->input->post('reply_message'))
        {
           $_ci->miconsult->insert_reply(
            array(    
            'doc_reg_id' => $_ci->m->user_value('regid') , 
            'reply_by' => 1 , 
            'reply_date' => TRUE,
            'reply_message' => $_ci->input->post('reply_message'),                  
              'iconsult_id'         => $id,
              'patient_id'          => $_ci->m->user_id(), 
              )
            );
             $update_data['question_status']=0;
        }
        if(!$reply_masg){
        $update_data1 = array(
          'keyword'           => $_ci->input->post('keyword'), 
          'message'           => $_ci->input->post('message'), 
          'document_date'     => date("Y-m-d", strtotime($_ci->input->post('document_date'))), 
          'date_modified'     => TRUE, 
//          'question_status'   => $_ci->input->post('question_status') ? $_ci->input->post('question_status') : 0, 
//          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
        );
            $update_data=array_merge($update_data,$update_data1);
         $doctor_check=$_ci->input->post('cyomeddoctor');
          $doctor_id=$_ci->input->post('doctor_id');
        if($doctor_check==1 || $doctor_check==2){
            $update_data['doctorcheck']=$doctor_check;
        }
          
          if($doctor_check==1){
             
              if(!empty($doctor_id)){
                $familydoctors=implode(',',$doctor_id);
                $familydoctorentry = array('familydoctor'  => $familydoctors,); 
                $update_data=array_merge($update_data,$familydoctorentry);
              }
                    else{
                        $family_doctor=$this->miconsult->get_familydoctor($_ci->m->user_id());
                        if(empty($family_doctor)){
                              $this->m->port->m->set('familydoctor',NULL);
                        }
                        else {
                         $string_family_doctor="";
                        foreach($family_doctor as $doctors){
                            $doctor=(array)$doctors;
                            $string_family_doctor.=$doctor['doctor_inserted_id'].',';                            

                        }
                     $string_family_doctor=  rtrim($string_family_doctor, ',');
                     $familydoctorentry = array('familydoctor'  => $string_family_doctor,); 
                     $update_data=array_merge($update_data,$familydoctorentry);

                        }
                    
                    }
          }
            else {
              $this->m->port->m->set('familydoctor',NULL);
            }

        }
        return $_ci->miconsult->update(
          array(
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
          ),
          $update_data
        );
        
      }

    );

    ajax_redirect('akte/econsult'); 
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

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          )
        );
      }
    );

    ajax_redirect('akte/econsult');
  }

  /**
   *
   */
  public function confirm($id)
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

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ), 
          array(
            'question_status' => Miconsult::STATUS_CLOSED,  
            'date_modified' => TRUE, 
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          ), 
          array(
            'question_status' => Miconsult::STATUS_CLOSED,  
            'date_modified' => TRUE, 
          )
        );
      }
    );

    ajax_redirect('akte/econsult');
  }


}

/* End of file econsult.php */
/* Location: ./application/modules/akte/controllers/econsult.php */