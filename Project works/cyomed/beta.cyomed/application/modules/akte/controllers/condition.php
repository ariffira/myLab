<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condition extends MX_Controller {

  /**
   *
   */
  public function index($id='')
  {
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
     $this->ui->html
                ->base_init()
                ->load_config('html');
     $this->ui->html
                    ->set_active_url('akte/condition');
    }
    /***end here***/
    $this->ui->mc->title->content = $this->lang->line('patients_home_page_title');
        $_ci->m->port->m->db_select();
//        $_ci->m->port->m->where('document_date <=', date('Y-m-d', time()));
//        $_ci->m->port->m->where('document_time <=', date('H:i:s', time()));
    $this->m->role_diff(
      function() use ($_ci,$id){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        
        $_ci->load->model('medical_condition/mmedical_condition');
        $_ci->ui->mc->content->content = $_ci->load->view('condition/condition_view', array(
          'entries' => $_ci->mmedical_condition->get_all(),'detail_id'=>$id
        ), TRUE);
      },
      function() use ($_ci,$id){
        $_ci->load->model('medical_condition/mmedical_condition');
        $_ci->ui->mc->content->content = $_ci->load->view('condition/condition_view', array(
          'entries' => $_ci->mmedical_condition->get_all(),'detail_id'=>$id
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
                    ->set_active_url('akte/overview/timeline?check=condition');
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
        $_ci->load->model('medical_condition/mmedical_condition');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));
//        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));
//        $_ci->m->port->m->where('document_time <=', date('H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mmedical_condition->get_all();
      
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
             $showmorelimit=5;  
        }
        $output = $_ci->load->view('condition/condition_feed_view', array(
            'entries' => $entries,
            'show_more'=>$showmorelimit,
            'colorclass'=>$colorclass,
            'tot_record'=>$totalrecord,
        ), TRUE);
        return $output;
      },
      function() use ($_ci, $time, $limit,$showmorelimit,$colorclass,$showmore){
          
        $_ci->load->model('medical_condition/mmedical_condition');
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where("concat(document_date,' ',document_time) <=", date('Y-m-d H:i:s', $time));
//        $_ci->m->port->m->where('document_date <=', date('Y-m-d', $time));
//        $_ci->m->port->m->where('document_time <=', date('H:i:s', $time));
        $_ci->m->port->m->limit($limit);
        $entries = $_ci->mmedical_condition->get_all();
     
        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
         $showmorelimit=5;  
        }
        $output = $_ci->load->view('condition/condition_feed_view', array(
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
        $_ci->load->model('medical_condition/mmedical_condition');

        for ($i = 1, $pain_character = ''; $i <= 18; $i++)
        { 
          if ($_ci->input->post('check'.$i) == 'on')
          {
            $pain_character .= '1,';
          }
          else
          {
            $pain_character .= '0,';
          }
        }

        $insert_data = array(
          'patient_id'        => $_ci->m->us_id(), 
          'title'             => $_ci->input->post('title_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $_ci->input->post('document_date') ? date("Y-m-d", strtotime($_ci->input->post('document_date'))) :  date("Y-m-d",time()), 
          'document_time'     => $_ci->input->post('document_time')?date("H:i:s",strtotime($_ci->input->post('document_time'))):date("H:i:s",time()), 
          'befindlichkeit'    => $_ci->input->post('befindlichkeit') ? $_ci->input->post('befindlichkeit') : 0, 
          'schmerzen'         => $_ci->input->post('schmerzen') ? $_ci->input->post('schmerzen') : '', 
          'pain_character'    => $pain_character, 
          'pain_date'         => $_ci->input->post('pain_date') ? date("Y-m-d", strtotime($_ci->input->post('pain_date'))) : '', 
          'pain_time'         => $_ci->input->post('pain_time'), 
          'access_permission' => $_ci->m->us_access(), 
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),   
          'date_added'        => TRUE, 
        );
        
        return $_ci->mmedical_condition->insert($insert_data);
      },
      function() use ($_ci){
        $_ci->load->model('medical_condition/mmedical_condition');

        for ($i = 1, $pain_character = ''; $i <= 18; $i++)
        { 
          if ($_ci->input->post('check'.$i) == 'on')
          {
            $pain_character .= '1,';
          }
          else
          {
            $pain_character .= '0,';
          }
        }

        $insert_data = array(
          'patient_id'        => $_ci->m->user_id(), 
          'title'             => $_ci->input->post('title_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $_ci->input->post('document_date') ? date("Y-m-d", strtotime($_ci->input->post('document_date'))) :  date("Y-m-d",time()), 
          'document_time'     => $_ci->input->post('document_time')?date("H:i:s",strtotime($_ci->input->post('document_time'))):date("H:i:s",time()), 
          'befindlichkeit'    => $_ci->input->post('befindlichkeit') ? $_ci->input->post('befindlichkeit') : 0, 
          'schmerzen'         => $_ci->input->post('schmerzen') ? $_ci->input->post('schmerzen') : '', 
          'pain_character'    => $pain_character, 
          'pain_date'         => $_ci->input->post('pain_date') ? date("Y-m-d", strtotime($_ci->input->post('pain_date'))) : '', 
          'pain_time'         => $_ci->input->post('pain_time'), 
          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'date_added'        => TRUE, 
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),  
        );
        return $_ci->mmedical_condition->insert($insert_data);
      }
    );

    ajax_redirect('akte/condition');
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

    $this->m->role_diff(
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        if (!$_ci->m->us_id()) return FALSE;

        $_ci->load->model('medical_condition/mmedical_condition');

        for ($i = 1, $pain_character = ''; $i <= 18; $i++)
        { 
          if ($_ci->input->post('check'.$i) == 'on')
          {
            $pain_character .= '1,';
          }
          else
          {
            $pain_character .= '0,';
          }
        }

        $update_data = array(
          'title'             => $_ci->input->post('title_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $_ci->input->post('document_date') ? date("Y-m-d", strtotime($_ci->input->post('document_date'))) :  date("Y-m-d",time()), 
          'document_time'     => $_ci->input->post('document_time')?date("H:i:s",strtotime($_ci->input->post('document_time'))):date("H:i:s",time()), 
          'befindlichkeit'    => ($_ci->input->post('befindlichkeit') || trim($_ci->input->post('befindlichkeit')) ==0)? $_ci->input->post('befindlichkeit') : 0, 
          'schmerzen'         => $_ci->input->post('schmerzen') ? $_ci->input->post('schmerzen') : '', 
          'pain_character'    => $pain_character, 
          'pain_date'         => $_ci->input->post('pain_date') ? date("Y-m-d", strtotime($_ci->input->post('pain_date'))) : '', 
          'pain_time'         => $_ci->input->post('pain_time'), 
          'date_modified'     => TRUE, 
        );

        return $_ci->mmedical_condition->update(
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

        $_ci->load->model('medical_condition/mmedical_condition');

        for ($i = 1, $pain_character = ''; $i <= 18; $i++)
        { 
          if ($_ci->input->post('check'.$i) == 'on')
          {
            $pain_character .= '1,';
          }
          else
          {
            $pain_character .= '0,';
          }
        }

        $update_data = array(
          'title'             => $_ci->input->post('title_name'), 
          'description'       => $_ci->input->post('condition'), 
          'document_date'     => $_ci->input->post('document_date') ? date("Y-m-d", strtotime($_ci->input->post('document_date'))) :  date("Y-m-d",time()), 
          'document_time'     => $_ci->input->post('document_time')?date("H:i:s",strtotime($_ci->input->post('document_time'))):date("H:i:s",time()), 
          'befindlichkeit'    => $_ci->input->post('befindlichkeit') ? $_ci->input->post('befindlichkeit') : 0, 
          'schmerzen'         => $_ci->input->post('schmerzen') ? $_ci->input->post('schmerzen') : '', 
          'pain_character'    => $pain_character, 
          'pain_date'         => $_ci->input->post('pain_date') ? date("Y-m-d", strtotime($_ci->input->post('pain_date'))) : '', 
          'pain_time'         => $_ci->input->post('pain_time'), 
          'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
          'date_modified'     => TRUE, 
        );

        return $_ci->mmedical_condition->update(
          array(
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
          ),
          $update_data
        );
      }
    );

    ajax_redirect('akte/condition/index/'.$id);
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

        $_ci->load->model('medical_condition/mmedical_condition');
        return $_ci->mmedical_condition->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          )
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->load->model('medical_condition/mmedical_condition');
        return $_ci->mmedical_condition->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          )
        );
      }
    );

    ajax_redirect('akte/condition');
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

        $_ci->load->model('medical_condition/mmedical_condition');
        return $_ci->mmedical_condition->update(
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

        $_ci->load->model('medical_condition/mmedical_condition');
        return $_ci->mmedical_condition->update(
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

    ajax_redirect('akte/condition');
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
        return $_ci->m->port->m->delete('medical_condition_files');
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;

        $_ci->m->port->m->where('id', $id);
        $_ci->m->port->m->limit(1);
        $_ci->m->port->m->db_select();
        return $_ci->m->port->m->delete('medical_condition_files');
      }
    );

    ajax_redirect('akte/condition');
  }

}

/* End of file condition.php */
/* Location: ./application/modules/akte/controllers/condition.php */