<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Termin extends CI_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    //$this->mod->admin_check();
  }

  /**
   *
   */
  public function index()
  {
    //if (!$this->mod->user()->module_activated)
    //{
      //redirect('admin/profile');
      //exit();
    //}

    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('termin_search',  $this->m->user_value('language'));

    $reservations = $this->modoc->get_all_reservations($this->mod->user_id());
    $unread = $this->modoc->get_unread_reservations($this->mod->user_id());
    $past = $this->modoc->get_past_reservations($this->mod->user_id());
    $accepted = $this->modoc->get_accepted_reservations($this->mod->user_id());
    $unaccepted = $this->modoc->get_unaccepted_reservations($this->mod->user_id());
    $archive = $this->modoc->get_archived_reservations($this->mod->user_id());

    $page_data = array(
      'reservations' => $reservations, 
      'unread' => $this->modoc->merge_reservations($unread, $unaccepted),
      'past' => $past, 
      'accepted' => $accepted, 
      'accepted_filtered' => $this->modoc->filter_time_room($accepted), 
      'archive' => $archive, 
    );

    $page_content = $this->load->view('admin/termin_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 
      'active_termin' => TRUE,
    );

    $this->load->view('struct_admin_view', $output_data);
  }

  /**
   *
   */
  public function new_appointment()
  {
    // var_dump($this->input->post());

    if ($this->input->post())
    {
      if ($reserve_id = $this->modoc->reserve())
      {
        $this->modoc->reservation_action('read', TRUE, array($reserve_id => 1, )); 
        $this->modoc->reservation_action('accept', TRUE, array($reserve_id => 1, )); 
        // echo $reserve_id;
      }
      else
      {
        echo "Post information validation error.\n";
        var_dump($this->input->post());
      }
    }
    else
    {
      echo 'Nothing posted';
    }

  }

  /**
   *
   */
  public function all_termin_json()
  {
    $this->output->set_content_type('application/json')->set_output(json_encode($this->modoc->get_all_reservations($this->m->user_id())));
  }

  /**
   *
   */
  public function action($action = 'read', $toggle = NULL)
  {
    switch ($action)
    {
      case 'read':
        $action = 'read';
        break;

      case 'accept':
        $action = 'accept';
        break;

      case 'archive':
        $action = 'archived';
        break;

      case 'delete':
        $action = 'deleted';
        break;
      
      default:
        $action = FALSE;
        break;
    }

    switch ($toggle)
    {
      case 'y':
        $toggle = true;
        break;

      case 'n':
        $toggle = false;
        break;

      case 'toggle':
        $toggle = NULL;
        break;
      
      default:
        $toggle = true;
        break;
    }

    if ($action)
    {
      $this->modoc->reservation_action($action, $toggle);
    }

    // redirect('admin/termin');
  }
}

/* End of file termin.php */
/* Location: ./application/controllers/admin/termin.php */