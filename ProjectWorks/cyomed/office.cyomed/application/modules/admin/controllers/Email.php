<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
    if ($this->mod->user_role() == 9)
      {
          //$this->index();
      }
    else
      {
          redirect('auth/login');
      }
  }

  /**
   *
   */
  public function index()
  {

    $page_data = array(
      // 'data' => $data,
    );

    $page_content = $this->load->view('email_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_settings()
  {
    $email_protocol       = $this->input->post('email_protocol');
    $email_smtp_host      = $this->input->post('email_smtp_host');
    $email_smtp_user      = $this->input->post('email_smtp_user');
    $email_smtp_pass      = $this->input->post('email_smtp_pass');
    $email_smtp_port      = $this->input->post('email_smtp_port');
    $email_mailtype       = $this->input->post('email_mailtype');
    $email_sender_address = $this->input->post('email_sender_address');
    $email_sender_name    = $this->input->post('email_sender_name');


    $this->mod->port->p->db_select();
    foreach (array(
      'email_protocol', 
      'email_smtp_host', 
      'email_smtp_user', 
      'email_smtp_pass', 
      'email_smtp_port', 
      'email_mailtype', 
      'email_sender_address', 
      'email_sender_name', 
    ) as $key)
    {
      $value = $this->input->post($key);
      if ($value !== FALSE)
      {
        $this->mod->port->p->set('value', $value);
        $this->mod->port->p->where('key', $key);
        $this->mod->port->p->limit(1);
        $this->mod->port->p->update('config');
      }
    }

    redirect('admin/email');
  }

}

/* End of file email.php */
/* Location: ./application/controllers/admin/email.php */