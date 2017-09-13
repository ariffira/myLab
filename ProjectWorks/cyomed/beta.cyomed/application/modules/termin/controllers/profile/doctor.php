<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    //redirect(base_url().'../');
  }


  /**
   *
   */
  public function member($id)
  {
    $doctor = $this->modoc->get_id($id);

    //if (!$doctor)
    //{
      //redirect(base_url().'../');
      //exit();
    //}



    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $this->load->language('termin_search',  $this->m->user_value('language'));
   
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    $this->ui->mc->content->content = $_ci->load->view('profile/doctor_view', array(
          'doctor' => $doctor,
          'active_search' => TRUE, 
        ), TRUE);
    
    $this->output->set_output($this->ui->mc->output());
  }

  /**
   *
   */
  public function member_termins($id)
  {
      
    $this->output->set_content_type('application/json')->set_output(json_encode($this->modoc->get_all_termins($id)));
  }

  /**
   *
   */
  public function member_reservations($id)
  {
      //echo "<pre>"; print_r($this->modoc->get_all_reservations($id)); exit();
    $this->output->set_content_type('application/json')->set_output(json_encode($this->modoc->get_all_reservations($id)));
  }

  /**
   *
   */
  public function google($id)
  {

    var_dump($this->input->post('google'));
    $post = $this->input->post('google');
    $post = json_decode($post);
    var_dump($post);
    return;

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $this->load->language('termin_search',  $this->m->user_value('language'));
   
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

    $this->ui->mc->content->content = $_ci->load->view('profile/doctor_view', array(
          'doctor' => new stdClass(),
          'active_search' => TRUE, 
        ), TRUE);
    
    $this->output->set_output($this->ui->mc->output());
  }

}

/* End of file doctor.php */
/* Location: ./application/controllers/profile/doctor.php */