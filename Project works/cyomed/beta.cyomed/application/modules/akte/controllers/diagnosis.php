<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$_SERVER['HTTP_X_REQUESTED_WITH']);
class Diagnosis extends MX_Controller {
 /**
   *
   */
  public function index()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('pwidgets/diagnosis', $this->m->user_value('language'));


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
                    ->set_active_url('akte/diagnosis');
    }
    /***end here***/
    $this->ui->mc->title->content = $this->lang->line('pwidget_diagnosis_diagnosis');
//    $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));
    $this->m->role_diff(
      function() use ($_ci){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        $_ci->load->model('diagnosis/mdiagnosis');
        $this->ui->mc->content->content = $_ci->load->view('diagnosis/diagnosis_view', array(
          'category' => $_ci->mdiagnosis->get_all(),
        ), TRUE);
      },
      function() use ($_ci){
        $_ci->load->model('diagnosis/mdiagnosis');
        $this->ui->mc->content->content = $_ci->load->view('diagnosis/diagnosis_view', array(
          'category' => $_ci->mdiagnosis->get_all(),
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
    if(!is_numeric($limit))
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
                    ->set_active_url('akte/overview/timeline?check=diagnosis');
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
        
        $_ci->load->model('diagnosis/mdiagnosis');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mdiagnosis->get_all_uncata();
         $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('diagnosis/diagnosis_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,
        ), TRUE);
        return $output;
      },
      function() use ($_ci, $time, $limit,$showmorelimit,$showmore){
        $_ci->load->model('diagnosis/mdiagnosis');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('document_date <=', date('Y-m-d H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mdiagnosis->get_all_uncata();
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('diagnosis/diagnosis_feed_view', array(
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
     
        $_ci->load->model('diagnosis/mdiagnosis');
        if(trim($_ci->input->post('start_date'))==''){
            $start_date  = date("Y-m-d",  time());
        }
        else {

            $start_date=date("Y-m-d", strtotime($_ci->input->post('start_date')));  

        }
        if(trim($_ci->input->post('end_date'))==''){
         $end_date = date("Y-m-d",  time());   
        }
        else{
           $end_date= date("Y-m-d", strtotime($_ci->input->post('end_date')));  
        }
        
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 
                
        $insert_data = array(
          'patient_id'        => $_ci->m->us_id(), 
          'icd_code'          => $_ci->input->post('icd_code'), 
          'title'             => $_ci->input->post('disease_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $documet_date, 
          'status'            => Mdiagnosis::STATUS_CONFIRMED, 
          'allergy'           => $_ci->input->post('allergy') ? $_ci->input->post('allergy') : 0, 
          'entry_from'        => $_ci->input->post('entry_from') ? $_ci->input->post('entry_from') : 0, 
          'country_id'        => $_ci->input->post('country'), 
          'start_date'        => $start_date, 
          'end_date'          => $end_date, 
          'access_permission' => $_ci->m->us_access(), 
          'date_added'        => TRUE, 
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),  
        );

        return $_ci->mdiagnosis->insert($insert_data);
      },
      function() use ($_ci){
       
        $_ci->load->model('diagnosis/mdiagnosis');
        if(trim($_ci->input->post('start_date'))==''){
            $start_date  = date("Y-m-d",  time());
        }
        else {

            $start_date=date("Y-m-d", strtotime($_ci->input->post('start_date')));  

        }
        if(trim($_ci->input->post('end_date'))==''){
         $end_date = date("Y-m-d",  time());   
        }
        else{
           $end_date= date("Y-m-d", strtotime($_ci->input->post('end_date')));  
        }
                $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 
        $insert_data = array(
          'patient_id'        => $_ci->m->user_id(), 
          'icd_code'          => $_ci->input->post('icd_code'), 
          'title'             => $_ci->input->post('disease_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $documet_date, 
          'status'            => Mdiagnosis::STATUS_NON_CONFIRMED, 
          'allergy'           => $_ci->input->post('allergy') ? $_ci->input->post('allergy') : 0, 
          'entry_from'        => $_ci->input->post('entry_from') ? $_ci->input->post('entry_from') : 0, 
          'country_id'        => $_ci->input->post('country'), 
          'start_date'        => $start_date, 
          'end_date'          => $end_date, 
          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'date_added'        => TRUE, 
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),  
        );

        return $_ci->mdiagnosis->insert($insert_data);
      }
    );

    ajax_redirect('akte/diagnosis');
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

        $_ci->load->model('diagnosis/mdiagnosis');
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 

        $update_data = array(
          'icd_code'          => $_ci->input->post('icd_code'), 
          'title'             => $_ci->input->post('disease_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $documet_date, 
          'allergy'           => $_ci->input->post('allergy') ? $_ci->input->post('allergy') : 0, 
          'entry_from'        => $_ci->input->post('entry_from') ? $_ci->input->post('entry_from') : 0, 
          'date_modified'     => TRUE, 
        );

        if ($_ci->input->post('country')) $update_data['country_id']    = $_ci->input->post('country');
        if ($_ci->input->post('start_date')) $update_data['start_date'] = date("Y-m-d", strtotime($_ci->input->post('start_date')));
        if ($_ci->input->post('end_date')) $update_data['end_date']     = date("Y-m-d", strtotime($_ci->input->post('end_date')));

        return $_ci->mdiagnosis->update(
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

        $_ci->load->model('diagnosis/mdiagnosis');
        $documet_date=$_ci->input->post('document_date')?date("Y-m-d", strtotime($_ci->input->post('document_date'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 

        $update_data = array(
          'icd_code'          => $_ci->input->post('icd_code'), 
          'title'             => $_ci->input->post('disease_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $documet_date, 
          'allergy'           => $_ci->input->post('allergy') ? $_ci->input->post('allergy') : 0, 
          'entry_from'        => $_ci->input->post('entry_from') ? $_ci->input->post('entry_from') : 0, 
          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'date_modified'     => TRUE, 
        );

        if ($_ci->input->post('country')) $update_data['country_id']    = $_ci->input->post('country');
        if ($_ci->input->post('start_date')) $update_data['start_date'] = date("Y-m-d", strtotime($_ci->input->post('start_date')));
        if ($_ci->input->post('end_date')) $update_data['end_date']     = date("Y-m-d", strtotime($_ci->input->post('end_date')));

        return $_ci->mdiagnosis->update(
          array(
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
          ),
          $update_data
        );
      }
    );

    ajax_redirect('akte/diagnosis');  }

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

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          )
        );
      }
    );

    ajax_redirect('akte/diagnosis');
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

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ), 
          array(
            'status' => Mdiagnosis::STATUS_CONFIRMED,  
            'date_modified' => TRUE, 
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          ), 
          array(
            'status' => Mdiagnosis::STATUS_CONFIRMED,  
            'date_modified' => TRUE, 
          )
        );
      }
    );

    ajax_redirect('akte/diagnosis');
  }

  /**
   *
   */
  public function emergency($id)
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

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ), 
          array(
            'status' => Mdiagnosis::STATUS_EMERGENCY,  
            'date_modified' => TRUE, 
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          ), 
          array(
            'status' => Mdiagnosis::STATUS_EMERGENCY,  
            'date_modified' => TRUE, 
          )
        );
      }
    );

    ajax_redirect('akte/diagnosis');
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

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
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

        $_ci->load->model('diagnosis/mdiagnosis');
        return $_ci->mdiagnosis->update(
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

    ajax_redirect('akte/diagnosis');
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
        $_ci->m->port->m->where('patient_id', $_ci->m->us_id());
        $_ci->m->port->m->limit(1);
        $_ci->m->port->m->db_select();
        return $_ci->m->port->m->delete('diagnoses_files');
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->m->port->m->where('id', $id);
        $_ci->m->port->m->where('patient_id', $_ci->m->user_id());
        $_ci->m->port->m->limit(1);
        $_ci->m->port->m->db_select();
        return $_ci->m->port->m->delete('diagnoses_files');
      }
    );

    ajax_redirect('akte/diagnosis');
  }

}

/* End of file diagnosis.php */
/* Location: ./application/modules/akte/controllers/diagnosis.php */