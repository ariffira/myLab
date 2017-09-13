<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familyhistory extends MX_Controller 
{
  /**
   *
   */
  public function index($id='')
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/family_history', $this->m->user_value('language'));
    
    $this->ui->mc->base_init();

//    $this->ui->mc->title->content = $this->lang->line('pwidget_diagnosis_diagnosis');
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
                    ->set_active_url('akte/familyhistory');
    }
    $this->ui->mc->title->content = $this->lang->line('pwidget_diagnosis_diagnosis');

    $this->m->role_diff(
      function() use ($_ci,$id){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        
        $_ci->load->model('familyhistory/mfamilyhistory');
//        $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));            
        $this->ui->mc->content->content = $_ci->load->view('familyhistory/familyhistory_view', array(
          'entries' => $_ci->mfamilyhistory->get_all(),'detail_id'=>$id
        ), TRUE);
      },
      function() use ($_ci,$id){
        $_ci->load->model('familyhistory/mfamilyhistory');
//        $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));                    
        $this->ui->mc->content->content = $_ci->load->view('familyhistory/familyhistory_view', array(
          'entries' => $_ci->mfamilyhistory->get_all(),'detail_id'=>$id
        ), TRUE);
      }
    );
    
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($this->ui->mc->output());
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    

  }

   public function feed($time = NULL, $limit = 15)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/family_history',$this->m->user_value('language'));

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
                    ->set_active_url('akte/overview/timeline?check=familyhistory');
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
    function() use ($_ci, $time,$limit,$showmorelimit,$showmore)
    {
        if (!$_ci->m->us_id())
        {
          return $_ci->load->view('not_chosen_view', array(), TRUE);
        }
        $_ci->load->model('familyhistory/mfamilyhistory');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));                            
         $_ci->m->port->m->limit($limit);
        $entries = $_ci->mfamilyhistory->get_all();
         $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('familyhistory/familyhistory_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,
        ), TRUE);
        return $output;
    },
    function() use ($_ci, $time, $limit,$showmorelimit,$showmore)
    {
        $_ci->load->model('familyhistory/mfamilyhistory'); 
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('effective_time <=', date('Y-m-d H:i:s', time()));                            
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mfamilyhistory->get_all();
         $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('familyhistory/familyhistory_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'tot_record'=>$totalrecord,
        ), TRUE);
        return $output;
    });
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
     $result = $this->m->role_diff(
      function() use ($_ci)
      {
        $_ci->load->model('familyhistory/mfamilyhistory');
     $effecitvetime=$_ci->input->post('effecitvetime')?date("Y-m-d", strtotime($_ci->input->post('effecitvetime'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time()); 
        $insert_data = array(
          'patient_id'         => $_ci->m->user_id(), 
          'disease_name'  => $_ci->input->post('disease_name'),  
          'gender'        => $_ci->input->post('gender'), 
          'dob'           => date('Y-m-d', strtotime($_ci->input->post('dateofbirth'))),
          'effective_time' => $effecitvetime,
          'relation_to_patient'=> $_ci->input->post('relationtopatient'),
          'dateofdeath'      => date('Y-m-d', strtotime($_ci->input->post('dateofdeath'))), 
          'date'               => date('Y-m-d', time()),
          'date_added'         => TRUE, 
         );
         
         return $_ci->mfamilyhistory->insert($insert_data);
      },
      function() use ($_ci){
        $_ci->load->model('familyhistory/mfamilyhistory');
     $effecitvetime=$_ci->input->post('effecitvetime')?date("Y-m-d", strtotime($_ci->input->post('effecitvetime'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time());         
        $insert_data = array(
           'patient_id'         => $_ci->m->user_id(), 
          'disease_name'  => $_ci->input->post('disease_name'),  
          'gender'        => $_ci->input->post('gender'), 
          'dob'        => date('Y-m-d', strtotime($_ci->input->post('dateofbirth'))),
          'effective_time'             => $effecitvetime,
          'relation_to_patient'         => $_ci->input->post('relationtopatient'),
          'dateofdeath'              => date('Y-m-d', strtotime($_ci->input->post('dateofdeath'))), 
          'date'               => date('Y-m-d', time()),
          'date_added'         => TRUE, 
        );
        return $_ci->mfamilyhistory->insert($insert_data);
      }
    );
 
    ajax_redirect('akte/familyhistory');
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

        $_ci->load->model('familyhistory/mfamilyhistory');
$effecitvetime=$_ci->input->post('effecitvetime')?date("Y-m-d", strtotime($_ci->input->post('effecitvetime'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time());         
        $update_data = array(   
          
          'disease_name'  => $_ci->input->post('disease_name'),  
          'gender'        => $_ci->input->post('gender'), 
          'dob'        => date('Y-m-d', strtotime($_ci->input->post('dateofbirth'))),
          'effective_time'             => $effecitvetime,
          'relation_to_patient'         => $_ci->input->post('relationtopatient'),
          'dateofdeath'              => date('Y-m-d', strtotime($_ci->input->post('dateofdeath'))), 
          'date'               => date('Y-m-d', strtotime($_ci->input->post('date'))),
          'date_modified'         => TRUE, 
        );

       $symptoms = $_ci->input->post('symptoms');
         return $_ci->mfamilyhistory->update(
          array(                      
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ),
          $update_data
        );
      },
      function() use ($_ci, $id)
      {
        if (empty($id)) return FALSE;

        $_ci->load->model('familyhistory/mfamilyhistory');
$effecitvetime=$_ci->input->post('effecitvetime')?date("Y-m-d", strtotime($_ci->input->post('effecitvetime'))).' '.date('H:i:s',time()):date("Y-m-d H:i:s",time());         
        $update_data = array(   
           'disease_name'  => $_ci->input->post('disease_name'),  
          'gender'        => $_ci->input->post('gender'), 
          'dob'        => date('Y-m-d', strtotime($_ci->input->post('dateofbirth'))),
          'effective_time'             => $effecitvetime,
          'relation_to_patient'         => $_ci->input->post('relationtopatient'),
          'dateofdeath'              => date('Y-m-d', strtotime($_ci->input->post('dateofdeath'))), 
          'date'               => date('Y-m-d', strtotime($_ci->input->post('date'))),
          'date_modified'         => TRUE, 
        );

       $symptoms = $_ci->input->post('symptoms');
       return $_ci->mfamilyhistory->update(
          array(
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
          ),
          $update_data
        );
      }
     );
     ajax_redirect('akte/familyhistory/index/'.$id);
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

        $_ci->load->model('familyhistory/mfamilyhistory');
        return $_ci->mfamilyhistory->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
           
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('familyhistory/mfamilyhistory');
        return $_ci->mfamilyhistory->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          )
        );
      }
    );

    ajax_redirect('akte/familyhistory');
  }


}

/* End of file familyhistory.php */
/* Location: ./application/modules/akte/controllers/familyhistory.php */