<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bodymap extends MX_Controller {

    public function index($id='') {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/all_access', $this->m->user_value('language'));
  $this->load->language('pwidgets/bodymap', $this->m->user_value('language'));

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
           
        } else { 
                  
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/bodymap');
        }
        /*         * *end here** */
//        $this->ui->mc->title->content = $this->lang->line('patients_home_page_title');

        $this->m->role_diff(
                function() use ($_ci,$id) {
            if (!$_ci->m->us_id()) {
                $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
                return;
            }
            $_ci->load->model('bodymap/bodymmap');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("date_added <=", date('Y-m-d H:i:s', time()));
            $_ci->ui->mc->content->content = $_ci->load->view('bodymap/boymap_view',  array(
          'entries' => $_ci->bodymmap->get_all(),'detail_id'=>$id
        ), TRUE);
        }, function() use ($_ci,$id) {
            $_ci->load->model('bodymap/bodymmap');
            $_ci->ui->mc->content->content = $_ci->load->view('bodymap/boymap_view', array(
          'entries' => $_ci->bodymmap->get_all(),'detail_id'=>$id
        ), TRUE);
        }
        );

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    public function feed($time = NULL, $limit = 15) { 
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/home',$this->m->user_value('language'));

        if ($time === NULL) {
            $time = time();
        }

        if (!is_numeric($time)) {
            if (strtotime($time) !== FALSE) {
                $time = strtotime($time);
            } else {
                $time = time();
            }
        }

        if (!is_numeric($limit)) {
            $limit = 15;
        }
        $this->ui->feed_item->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/overview/timeline?check=bodymap');
        }
        /*         * *end here** */
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
                function() use ($_ci, $time, $limit, $showmorelimit,$showmore) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $_ci->load->model('bodymap/bodymmap');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("date_added <=", date('Y-m-d H:i:s', $time));
            $_ci->m->port->m->limit($limit);             
            $entries = $_ci->bodymmap->get_all(); 

        $totalrecord=count($entries);
        $entries = array_splice($entries,$showmore,5);
        if(empty($showmorelimit))
        {
             $showmorelimit=5;  
        }
            $output = $_ci->load->view('bodymap/bodymap_feed_view',   array(
                'entries' => $entries,
                'show_more'=>$showmorelimit,
                 'tot_record'=>$totalrecord,), TRUE);
            return $output;
            
        }, function() use ($_ci, $time, $limit, $showmorelimit,$showmore) { 
            
            $_ci->load->model('bodymap/bodymmap');            
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("date_added <=", date('Y-m-d H:i:s', $time));
            $_ci->m->port->m->limit($limit); 
            $entries = $_ci->bodymmap->get_all(); 
            $totalrecord=count($entries);
            $entries = array_splice($entries,$showmore,5);
            if(empty($showmorelimit))
            {
                $showmorelimit=5;  
            }
            
            $output = $_ci->load->view('bodymap/bodymap_feed_view', array(
                'entries' => $entries,
                'show_more'=>$showmorelimit,
                 'tot_record'=>$totalrecord,), TRUE);			       
            return $output;
        }
        );
        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($output);
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    public function insert() {        
        static $_ci; 
        if (empty($_ci))
            $_ci = & get_instance();
        echo $result = $this->m->role_diff(
        function() use ($_ci) {
                    $pain_type = $_ci->input->post('pain_type');
                    $pain_type=(isset($pain_type) && ($pain_type || $pain_type))?$pain_type:'acute';                       
                    
            $_ci->load->model('bodymap/bodymmap');
            $insert_data = array(
                'patient_id' => $_ci->m->us_id(),
                'pain_intensity' => $_ci->input->post('pain')?$_ci->input->post('pain'):1,
                'pain_type' => $pain_type,
                'qualities' => $_ci->input->post('qualities') ? $_ci->input->post('qualities') : '',
                'date_from' => date("Y-m-d H:i:s",time()),
                'time_from' => date("H:i:s", strtotime($_ci->input->post('time_from'))),
                'date_added' => date('Y-m-d H:i:s',time()),
                'added_by' => $_ci->m->user_id(),
                'user_role' => $_ci->m->user_role(),
                'x_position' => $_ci->input->post('x_position'),
                'y_position' => $_ci->input->post('y_position'),
                'access_permission' => $_ci->m->us_access(), 
            );
//            print_r($insert_data);die;
            return $_ci->bodymmap->insert($insert_data);
        }, function() use ($_ci) {
                    $pain_type = $_ci->input->post('pain_type');
                    $pain_type=(isset($pain_type) && ($pain_type || $pain_type))?$pain_type:'acute';            
            $_ci->load->model('bodymap/bodymmap');

            $insert_data = array(
                'patient_id' => $_ci->m->user_id(),
                'pain_intensity' => $_ci->input->post('pain')?$_ci->input->post('pain'):1,
                'pain_type' => $pain_type,
                'qualities' => $_ci->input->post('qualities') ? $_ci->input->post('qualities') : '',
                'date_from' => date("Y-m-d", strtotime($_ci->input->post('date_from'))),
                'time_from' => date("H:i:s", strtotime($_ci->input->post('time_from'))),
                'date_added' => date('Y-m-d H:i:s',time()),
                'added_by' => $_ci->m->user_id(),
                'user_role' => $_ci->m->user_role(),
                'x_position' => $_ci->input->post('x_position'),
                'y_position' => $_ci->input->post('y_position'),
                 'access_permission' =>in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0,
            );          
            return $_ci->bodymmap->insert($insert_data);
        }
                );                
         ajax_redirect('akte/bodymap');
                
    }


    public function update($id) {        
        static $_ci; 
        if (empty($_ci))
            $_ci = & get_instance();
    if (empty($id))
    {
      $id = $this->input->post('id');
    }

    if (empty($id))
    {
      $id = $this->input->get('id');
    }   
        echo $result = $this->m->role_diff(
        function() use ($_ci,$id) {
                    $pain_type = $_ci->input->post('pain_type');
                    $pain_type=(isset($pain_type) && ($pain_type || $pain_type))?$pain_type:'acute';                       

            $_ci->load->model('bodymap/bodymmap');
            $update_data = array(
                'patient_id' => $_ci->m->us_id(),
                'pain_intensity' => $_ci->input->post('pain')?$_ci->input->post('pain'):1,
                'pain_type' => $pain_type,
                'qualities' => $_ci->input->post('qualities') ? $_ci->input->post('qualities') : '',
                'date_from' => date("Y-m-d H:i:s",time()),
                'time_from' => date("H:i:s", strtotime($_ci->input->post('time_from'))),
                'date_modified' => true,
                'added_by' => $_ci->m->user_id(),
                'user_role' => $_ci->m->user_role(),
                'x_position' => $_ci->input->post('x_position'),
                'y_position' => $_ci->input->post('y_position'),
                'access_permission' => $_ci->m->us_access(), 
            );
            

              return $_ci->bodymmap->update(
          array(                      
            'id'         => $id,
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ),
          $update_date                      
        );
                return $_ci->bodymmap->insert($insert_data);
        }, function() use ($_ci,$id) {
                    $pain_type = $_ci->input->post('pain_type');
                    $pain_type=(isset($pain_type) && ($pain_type || $pain_type))?$pain_type:'acute';            
            $_ci->load->model('bodymap/bodymmap');

            $update_data = array(
                'patient_id' => $_ci->m->user_id(),
                'pain_intensity' => $_ci->input->post('pain')?$_ci->input->post('pain'):1,
                'pain_type' => $pain_type,
                'qualities' => $_ci->input->post('qualities') ? $_ci->input->post('qualities') : '',
                'date_from' => date("Y-m-d", strtotime($_ci->input->post('date_from'))),
                'time_from' => date("H:i:s", strtotime($_ci->input->post('time_from'))),
                'date_modified' => true,
                'added_by' => $_ci->m->user_id(),
                'user_role' => $_ci->m->user_role(),
                'x_position' => $_ci->input->post('x_position'),
                'y_position' => $_ci->input->post('y_position'),
                 'access_permission' =>in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0,
            );          
        return $_ci->bodymmap->update(
          array(
            'id'         => $id,
            'patient_id' => $_ci->m->user_id(), 
          ),
          $update_data
        );

        }
                );  
  ajax_redirect('akte/bodymap/index/'.$id);                
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

        $_ci->load->model('bodymap/bodymmap');
        return $_ci->bodymmap->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->us_id(), 
            'access_permission >=' => $_ci->m->us_access(),
          ),array('delete_status'=>1)
        );
      },
      function() use ($_ci, $id){
        if (empty($id)) return FALSE;
        $_ci->load->model('bodymap/bodymmap');        
        return $_ci->bodymmap->delete(
          array(
            'id' => $id, 
            'patient_id' => $_ci->m->user_id(), 
          ),array('delete_status'=>1)
        );
      }
    );

    ajax_redirect('akte/bodymap');
  }

}
