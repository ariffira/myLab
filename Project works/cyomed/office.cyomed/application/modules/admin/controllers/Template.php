<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {

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

    $page_content = $this->load->view('template_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_invoice()
  {
    $invoice_template = $this->input->post('invoice_template');

    $this->mod->port->p->db_select();
    foreach (array(
      'invoice_template', 
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

    redirect('admin/template');
  }

  /**
   *
   */
  public function update_confirm_doctor()
  {
    $doctor_confirm_subject = $this->input->post('doctor_confirm_subject');
    $doctor_confirm_content = $this->input->post('doctor_confirm_content');

    $this->mod->port->p->db_select();
    foreach (array(
      'doctor_confirm_subject', 
      'doctor_confirm_content', 
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

    redirect('admin/template');
  }

  /**
   *
   */
  public function update_confirm_patient()
  {
    $patient_confirm_subject = $this->input->post('patient_confirm_subject');
    $patient_confirm_content = $this->input->post('patient_confirm_content');

    $this->mod->port->p->db_select();
    foreach (array(
      'patient_confirm_subject', 
      'patient_confirm_content', 
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

    redirect('admin/template');
  }

}

/* End of file template.php */
/* Location: ./application/controllers/admin/template.php */