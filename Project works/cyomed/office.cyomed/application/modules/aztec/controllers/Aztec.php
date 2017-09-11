<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aztec extends MX_Controller {

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

    $all_inputs = $this->input->get();

    $s = $this->input->get('s');
    $n = $this->input->get('n');

    $s = $s ? $s : 0;
    $n = $n ? $n : 10;

    $this->mod->port->p->db_select();
    $this->mod->port->p->limit($n, $s);

    $s_field = $this->input->get('search_field');
    $s_value = $this->input->get('search_value');

    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }

    $patients = $this->mopat->get_list();
    $all_fields = ! empty($patients) ? array_keys((array)$patients[0]) : array();
    $all_fields[] = 'aztec';

    $fields = array();
    $found_checked_field = FALSE;
    if (count($all_inputs))
    {
      foreach ($all_inputs as $key => $value)
      {
        if (strpos($key, 'field_') === 0)
        {
          $key = substr($key, strlen('field_'));

          if (in_array($key, $all_fields))
          {
            $fields[] = $key;
            $found_checked_field = TRUE;
          }
          
        }
      }
    }

    if ( ! $found_checked_field)
    {
      $fields = array(
        'aztec',
        'regid', 
        'email', 
        'name', 
        'surname', 
        'birthname', 
        'address', 
        'zip', 
        'region', 
        'city', 
        'country', 
        'mobile', 
        'telephone', 
      );
    }

    $this->mod->port->p->db_select();
    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    $total_count = count($this->mopat->get_list());

    $this->load->library('pagination');

    if ($this->input->server('QUERY_STRING'))
    {
      $qs = implode('&', array_filter(array_map(function($key, $value) {
        return ! in_array($key, array('s', )) ? $key.'='.$value : NULL;
      }, array_keys($this->input->get()), $this->input->get())));

      $config['base_url'] = site_url('aztec/aztec').($qs ? '?' : '').$qs;
    }
    else
    {
      $config['base_url'] = site_url('aztec/aztec');
    }

    $this->mod->port->p->db_select();
    $config['total_rows'] = $total_count;
    $config['per_page'] = 10; 
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 's';

    $this->pagination->initialize($config); 

    $pagination = $this->pagination->create_links();

    $page_data = array(
      'all_fields' => $all_fields, 
      'fields' => $fields, 
      'patients' => $patients,
      'pagination' => $pagination,
    );

    $page_content = $this->load->view('aztec_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function entry($id = NULL)
  {
    if ($id === NULL || !is_numeric($id))
    {
      redirect('aztec/aztec');
    }

    $sidebar = $this->config->item('sidebar');
    // $sidebar[1]['active'] = TRUE;

    $this->mod->port->p->where('id', $id);
    $this->mod->port->p->limit(1);

    $patients = $this->mopat->get_list();

    $page_data = array(
      'patients' => $patients,
    );

    $page_content = $this->load->view('aztec_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file Aztec.php */
/* Location: ./application/modules/aztec/Aztec.php */