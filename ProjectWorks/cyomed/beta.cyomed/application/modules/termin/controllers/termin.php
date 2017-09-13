<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Termin extends MX_Controller {

  /**
   *
   */
  public function __construct()
  {
    $this->m->login_check_redirect();
  }


public function index($url = NULL)
{
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('termin_search',  $this->m->user_value('language'));
      
    $this->config->load('ia24ui', TRUE, TRUE);

    $this->ui->html
      ->base_init()
      ->load_config('html');

    # Active URL
    if (empty($url))
    {
      $url = $this->input->get('r');
    }

    if (empty($url))
    {
      $url = $this->input->post('r');
    }

    if ($url = $this->encrypt->decode($url))
      $this->ui->html
        ->set_active_url('termin/search_result/'.$url);
    
    else{
      if($this->m->user_role() == M::ROLE_DOCTOR)
          $this->ui->html
        ->set_active_url('termin/calendar');
      
      else
      $this->ui->html
        ->set_active_url('termin/search_result/');
      }
              
    # mvpr theme
    if (empty($mvprt))
    {
      $mvprt = $this->input->get('mvprt');
    }

    if (empty($mvprt))
    {
      $mvprt = $this->input->post('mvprt');
    }

    if (empty($mvprt))
    {
      $mvprt = $this->session->userdata('mvprt');
    }

    if (!empty($mvprt))
    {
      if ($mvprt != 'clear')
      {
        $this->session->set_userdata('mvprt', $mvprt);
        
        if (Ui::$bs_tname == 'mvpr110')
        {
          $this->ui->html
            ->set_css($mvprt);
        }
        else
        {
          redirect('termin');
          return;          
        }
      }
      else
      {
        $this->session->unset_userdata('mvprt');
        redirect('termin');
        return;
      }
    }
   
    # mvpr theme
    if (empty($sa103t))
    {
      $sa103t = $this->input->get('sa103t');
    }
    if (empty($sa103t))
    {
      $sa103t = $this->input->post('sa103t');
    }
    if(empty($sa103t))
    {
      $sa103t = $this->session->userdata('sa103t');
    }
    if(!empty($sa103t))
    {
      if ($sa103t != 'clear')
      {
        $this->session->set_userdata('sa103t', $sa103t);
        
        if (Ui::$bs_tname == 'sa103')
        {
          $this->ui->html
            ->set_css($sa103t, 'sa_css');
        }
        else
        {
          redirect('termin');
          return;          
        }
      }
      else
      {
        $this->session->unset_userdata('sa103t');
        redirect('termin');
        return;
      }
    }
    $this->output->set_output(
      $this->ui->html->output()
    );
 }

 
 
 
  /**
   *
   **/
  public function active_url($url = NULL)
  {
    $this->index($url);
  }
  public function search()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('termin_search',  $this->m->user_value('language'));
    

     $location  = $_ci->input->post('location');
     $distance  = $_ci->input->post('distance');
     $medical_specialty = $_ci->input->post('specialty');
     
     $this->session->set_userdata('location',$location);
     $this->session->set_userdata('distance',$distance);
     $this->session->set_userdata('medical_specialty',$medical_specialty);
     termin_ajax_redirect('search_result');
  }
}

/* End of file termin.php */
/* Location: ./application/modules/termin/controllers/termin.php */