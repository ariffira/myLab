<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
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

    $page_data = array(
      'p' => $this->input->get('p') !== FALSE ? TRUE : FALSE,
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
/* Location: ./application/controllers/both/login.php */