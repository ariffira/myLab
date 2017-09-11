<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MX_Controller {

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

    $sidebar = $this->config->item('sidebar');
    // $sidebar[3]['active'] = TRUE;

    $reservations = $this->mopat->get_list();

    $page_data = array(
      'reservations' => $reservations,
    );

    $page_content = $this->load->view('reservation_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file reservation.php */
/* Location: ./application/controllers/admin/reservation.php */