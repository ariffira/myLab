<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MX_Controller {

  /**
   *
   */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function index()
  {

  }

  /**
   * Ajax handlers
   */

  /**
   *
   */
  public function json($id = NULL)
  {
    $this->load->model('mopat');
    $this->load->model('reservation/mreservation', 'termin');

    $reservation = $this->termin->get_inbox_reservations($this->mpatient->patient->id);

    $pool = array();

    foreach ($reservation as $index => $row)
    {
      $title = "\n".trim($row->doctor->academic_grade).' '.trim($row->doctor->name).' '.trim($row->doctor->surname)."\n";

      $event = (object)array(
        'id' => $row->id,
        'title' => $title,
        'start' => $start = date('Y-m-d H:i:s', strtotime($row->start)),
        'end' => date('Y-m-d H:i:s', $row->end > 0 ? strtotime($row->end) : strtotime($row->start) + 3600),
      );

      $event->color = $row->accept ? '#3c763d' : '#a94442';

      $pool[] = $event;
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($pool));

  }

}

/* End of file reservation.php */
/* Location: ./akte/application/controllers/patients/reservation.php */