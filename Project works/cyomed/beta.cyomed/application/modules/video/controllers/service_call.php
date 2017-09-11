<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_call extends MX_Controller {

  /**
   *
   */
  public function index()
  {
  	$this->load->view('service_call_view');
  }

  public function load_patient_video(){
  	$this->load->view('patient_video_view');
  }

}

/* End of file service_call.php */
/* Location: ./application/modules/video/controllers/service_call.php */