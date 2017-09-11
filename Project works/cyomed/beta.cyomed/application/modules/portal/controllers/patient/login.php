<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    $this->page();
  }

  /**
   *
   */
  public function page($post = FALSE)
  {
    $user_id=$this->m->user_id();
      if(isset($user_id) && !empty($user_id) && $user_id!=""){
             redirect('akte');
      }
        //lang load...
    $this->load->language('login', $this->m->lang);

    if ($post)
    {
        
      if ($this->form_validation->run('login'))
      {
          $email=$this->input->post('email');
          $pass=$this->input->post('password');
         $redirect=$this->m->force_pass_change($email,$pass, FALSE);
         if($redirect!='' && !empty($redirect) && $redirect){
                redirect($redirect);
         }
        if ($this->m->login($email, $pass, FALSE))
        {
          $get_redirect = $this->input->get('r');
          $check_redirect = $this->input->get('c');
          
          if ($get_redirect && $check_redirect)
          {
            $this->load->library('encrypt');
            if ($get_redirect == $this->encrypt->decode($check_redirect))
            {
           
              redirect($get_redirect);
              return;
            }
          }
          $this->m->updateIp($email,false);
          
          $redirect=$this->m->login_changepassword($email,$pass, FALSE);
          
//          echo $redirect;die;
        
          redirect($redirect);
          
          return;
        }
        else
        {
          if ($this->m->last_error() == M::ERROR_EMAIL)
          {
            $alert = $this->lang->line('login_lang_email_not_exist');
          }
          elseif ($this->m->last_error() == M::ERROR_PASSWORD)
          {
            if((int)$this->m->invalid_login_error()<3)
            {
                if((int)$this->m->invalid_login_error()==0)
                {
                  $alert = $this->lang->line('login_lang_disable_msg');     
                }
               else {
                   $alert = $this->lang->line('login_lang_pass_wrong_attmt') . $this->m->invalid_login_error() . "";
              }
             
            }
            else
            {
              $alert = $this->lang->line('login_lang_acc_lock_msg');   
            }
            
          }
        }
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }
    

    if (($u = $this->m->user()) && $this->m->user_role() == 'patient' && (!isset($alert) || $alert))
    {
      redirect('portal/both/login/page');
    }

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : TRUE,
      'd' => $this->input->get('d') !== FALSE ? TRUE : FALSE,
    );

    $get_redirect = $this->input->get('r');
    $check_redirect = $this->input->get('c');
    if ($get_redirect && $check_redirect)
    {
      $this->load->library('encrypt');
      if ($get_redirect == $this->encrypt->decode($check_redirect))
      {
        $page_data['r'] = $get_redirect;
        $page_data['c'] = $this->encrypt->encode($get_redirect);
      }
    }

    if (isset($alert) && $alert) $page_data['alert'] = $alert;

    $this->ui->html
      ->base_init()
      ->load_config(Ui::$bs_tname == 'sa103' ? '404' : 'login')
      ->page_title('');

    $this->ui->html
      ->content($this->load->view('both/login_view', $page_data, TRUE));

    $this->output->set_output(
      $this->ui->html->output()
    );
    
  }

}

/* End of file login.php */
/* Location: ./application/controllers/patient/login.php */