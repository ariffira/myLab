<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Smokingstatus extends MX_Controller 
{
  
  public function index()
  {
    static $_ci;
    
    if (empty($_ci)) $_ci =& get_instance();
    //loading languages
   $_ci->m->user()->smoking_status;
    
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/smoking', $this->m->user_value('language'));
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = $this->lang->line('pwidget_diagnosis_diagnosis');
    $this->m->role_diff(function() use ($_ci){
    if (!$_ci->m->us_id())
    {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
    }

    $this->ui->mc->content->content = $_ci->load->view('smokingstatus/smoking_entry_view', array(
      'entries' =>$_ci->m->user(),
     ), TRUE);
      },
      function() use ($_ci)
      {
       
        $this->ui->mc->content->content = $_ci->load->view('smokingstatus/smoking_entry_view', array(
          'entries' => $_ci->m->user(),
        ), TRUE);
      }
    );
    $this->output->set_output($this->ui->mc->output());
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
    $this->load->language('patients/smoking',$this->m->user_value('language'));

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
    if(isset($_REQUEST['id']))
    {
      $colorclass="blog-cyan"; 
    }
    else
    {
      $colorclass="blog-blue";  
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
                    ->set_active_url('akte/overview/timeline?check=smokingstatus');
    }
    /***end here***/
    $output = $this->m->role_diff(
      function() use ($_ci, $time, $limit,$colorclass){
        if (!$_ci->m->us_id())
        {
          return $_ci->load->view('not_chosen_view', array(), TRUE);
        }
        $entries = $_ci->m->user();
        $output = $_ci->load->view('smokingstatus/smokingstatus_feed_view', array(
            'entries' => $entries,
            'colorclass'=>$colorclass,
        ), TRUE);
        return $output;
      },
      function() use ($_ci, $time, $limit,$colorclass){
       $entries = $_ci->m->user();
        $output = $_ci->load->view('smokingstatus/smokingstatus_feed_view', array(
            'entries' => $entries,
            'colorclass'=>$colorclass,
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
  
  public function update($id)
  {
    static $_ci;
     if (empty($_ci)) $_ci =& get_instance();
     $smokingstatus = $_ci->input->post('smokingstatus');
      $this->m->port->p->db_select();
                 $this->m->port->p->set('smoking_status', $smokingstatus);
                $this->m->port->p->where('id', $_ci->m->user_id());
             $this->m->port->p->update('patients');
    ajax_redirect('akte/smokingstatus');
  }

}
/* End of file smokingstatus.php */
/* Location: ./application/modules/akte/controllers/smokingstatus.php */