<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertrack extends MX_Controller {

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
      	static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $sidebar = $this->config->item('sidebar');
    // $sidebar[1]['active'] = TRUE;

    $s = $this->input->get('s');
    $n = $this->input->get('n');

    $s = $s ? $s : 0;
    $n = $n ? $n : 10;


    $s_field = $this->input->get('search_field');
    $s_value = $this->input->get('search_value');

//    if ($s_field && $s_value)
//    {
//      $this->mod->port->p->like($s_field, $s_value, 'both'); 
//    }
    $this->load->model('usertrack/usertracking');  
//    $usertracking_value = $this->usertracking->get_list();
    $this->mod->port->p->db_select();
    if ($s_field && $s_value)
    {
//        echo 'afs';die;
    $usertracking_value = $this->usertracking->get_list($s,$n,$s_field, $s_value);    
//      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    else{
    $usertracking_value = $this->usertracking->get_list($s,$n);        
    }
    $total_count = count($this->usertracking->get_list('',''));

    $this->load->library('pagination');

    $config['base_url'] = site_url('admin/usertrack').'?'.$this->input->server('QUERY_STRING').($this->input->server('QUERY_STRING') ? '&' : '');
    $this->mod->port->p->db_select();
    $config['total_rows'] = $total_count;
    $config['per_page'] = 10; 
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 's';

    $this->pagination->initialize($config); 

    $pagination = $this->pagination->create_links();

    $page_data = array(
      'usertrack' => $usertracking_value,
      'pagination' => $pagination,
    );

    $page_content = $this->load->view('user_track_view', $page_data, TRUE);

    $output_data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 
      'sidebar' => $sidebar,
      'jumbotron' => (object)array(
        'title' => ucfirst(basename(__FILE__, '.php')),
      ), 
    );
    $this->load->view('page', $output_data);
  }
}
/* Location: ./application/controllers/admin/usertrack.php */