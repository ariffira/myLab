<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clinic extends CI_Controller {

  /**
   *
   */
  public function index()
  {
    redirect(base_url().'../');
  }


  /**
   *
   */
  public function member($id)
  {
    $doctor = $this->modoc->get_id($id);

    if (!$doctor)
    {
      redirect(base_url().'../');
      exit();
    }

    $page_data = array(
      'doctor' => $doctor,
    );

    $page_content = $this->load->view('profile/clinic_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_search' => TRUE, 
    );

    $this->load->view('struct_clean_view', $output_data);
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
  public function google($id)
  {

    $page_data = array(
      'doctor' => new stdClass(),
    );

    $page_content = $this->load->view('profile/clinic_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 

      'active_search' => TRUE, 
    );

    $this->load->view('struct_clean_view', $output_data);
  }

}

/* End of file clinic.php */
/* Location: ./application/controllers/profile/clinic.php */