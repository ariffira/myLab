<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class allEconsult extends MX_Controller {

    function __construct(){
        parent::__construct();
$this->m->login_check_redirect();
    }

    /**
   *
   */
  public function index()
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
                    ->set_active_url('akte/alleconsult');
    }
    /***end here***/
    $this->ui->mc->title->content = $this->lang->line('general_text_menu_side_nav_document');

    $this->m->role_diff(
      function() use ($_ci){
        $_ci->load->model('iconsult/miconsult');
        $this->ui->mc->content->content = $_ci->load->view('econsult/econsult_view', array(
          'category' => $_ci->miconsult->get_econsult_doctor(),
            'patient_id'=>true
           
        ), TRUE);
      },
      function() use ($_ci){
        $_ci->load->model('iconsult/miconsult');
        $this->ui->mc->content->content = $_ci->load->view('econsult/econsult_view', array(
          'category' => $_ci->miconsult->get_all(),
            'family_doctor'=> $_ci->miconsult->get_familydoctor($this->m->user_id()),
            'patient_id'=>true
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

    ajax_redirect('akte/alleconsult');
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
        
        $patient_id=$_ci->input->post('patient_id');
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
              'patient_id'          =>$patient_id, 
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
              'patient_id'=>$patient_id,
            'doctorcheck >=' => $_ci->m->us_access(),
          ),
          $update_data
        );


      },

      function() use ($_ci, $id){
         
        if (empty($id)) return FALSE;

        $_ci->load->model('iconsult/miconsult');
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

        $update_data = array(
          'keyword'           => $_ci->input->post('keyword'), 
          'message'           => $_ci->input->post('message'), 
          'document_date'     => date("Y-m-d", strtotime($_ci->input->post('document_date'))), 
          'date_modified'     => TRUE, 
//          'question_status'   => $_ci->input->post('question_status') ? $_ci->input->post('question_status') : 0, 
//          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
        );
        
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
                     $string_family_doctor=  rtrim($string_family_doctor, ',');
                     $familydoctorentry = array('familydoctor'  => $string_family_doctor,); 
                     $update_data=array_merge($update_data,$familydoctorentry);

                        }
                        }
                    
                    }
          }
            else {
              $this->m->port->m->set('familydoctor',NULL);
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

    ajax_redirect('akte/alleconsult'); 
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

     

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->delete(
          array(
            'id' => $id, 
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

    ajax_redirect('akte/alleconsult');
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

       

        $_ci->load->model('iconsult/miconsult');
        return $_ci->miconsult->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->input->post('patient_id'),
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

    ajax_redirect('akte/alleconsult');
  }


}

/* End of file econsult.php */
/* Location: ./application/modules/akte/controllers/econsult.php */