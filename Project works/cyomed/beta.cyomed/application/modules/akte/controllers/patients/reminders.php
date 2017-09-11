<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reminders extends CI_Controller {

  /**
   *
   */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    // Dependencies
    $this->load->model('patients/mpatient');
  }

  /**
   *
   */
  public function index()
  {
    $this->load->model('medication/mmedication');

    # Open consults

    $medication = $this->mmedication->get($this->mpatient->patient->id);


    $page_data = array(      
      'session_arr'          => $this->mgen->sess->arr, 
      'server_var_http_host' => $this->mgen->serv->http_host,
      
      'patient_row'          => $this->mpatient->patient,
      
      'medication'           => $medication,

    );

    $page    = $this->load->view('patients/reminders_view', $page_data, TRUE);
    $page_js = $this->load->view('patients/reminders_js_view', $page_data, TRUE);

    $struct_data = array(
      'session_arr'          => $this->mgen->sess->arr, 
      'server_var_http_host' => $this->mgen->serv->http_host,
      
      'patientvalues_row'          => $this->mpatient->patient,
      
      'content'              => $page,
      'page_js'              => $page_js, 
    );

    $this->load->view('patients/struct_view', $struct_data);

  }

  /**
   *
   */
  public function insert($id)
  {

  }

  /**
   *
   */
  public function update($id)
  {

  }

  /**
   *
   */
  public function delete($id)
  {

  }

  /**
   *
   */
  public function email()
  {

  }

  /**
   * Ajax handlers
   */

}

/* End of file reminders.php */
/* Location: ./application/controllers/patients/reminders.php */