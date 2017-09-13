<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ts extends MX_Controller {

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
    // $sidebar[2]['active'] = TRUE;

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

    $this->load->model('mopayone');

    $txi = $this->mopayone->ts_get();

    $this->mod->port->p->db_select();
    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    $total_count = count($this->mopayone->ts_get());

    $this->load->library('pagination');

    $config['base_url'] = site_url('admin/ts').'?'.$this->input->server('QUERY_STRING').($this->input->server('QUERY_STRING') ? '&' : '');
    $this->mod->port->p->db_select();
    $config['total_rows'] = $total_count;
    $config['per_page'] = 10; 
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 's';

    $this->pagination->initialize($config); 

    $pagination = $this->pagination->create_links();

    $page_data = array(
      'entries' => $txi,
      'pagination' => $pagination,
      'entry_click' => 'admin/ts/entry',
      'entry_update' => 'admin/ts/update',
      'entry_decode' => TRUE,
    );

    $page_content = $this->load->view('entries_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function entry($id = NULL)
  {
    if ($id === NULL || !is_numeric($id))
    {
      redirect('admin/doctor');
    }

    $this->mod->port->p->where('id', $id);
    $this->mod->port->p->limit(1);

    $this->load->model('mopayone');

    $txi = $this->mopayone->ts_get();

    $page_data = array(
      'entries' => $txi,
      'entry_click' => 'admin/ts/entry',
      'entry_update' => 'admin/ts/update',
      'entry_decode' => TRUE,
    );

    $page_content = $this->load->view('entries_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_field($doctor_id = NULL)
  {
    if ($doctor_id === NULL || !is_numeric($doctor_id))
    {
      return;
    }

    $field = $this->input->post('field');
    $value = $this->input->post('value');

    if (!$field || !is_string($field))
    {
      return;
    }

    if ($field == 'password')
    {
      $value = md5($value);
    }

    $fields = $this->mod->port->p->field_data('p1_ts');

    foreach ($fields as $fd)
    {
       // echo $fd->name;
       // echo $fd->type;
       // echo $fd->max_length;
       // echo $fd->primary_key;
      if ($fd->name == $field && strtoupper($fd->type) == 'BLOB')
      {
        $value = $this->aes_encrypt->en($value);
      }
    }

    $this->mod->port->p->db_select();
    $this->mod->port->p->set($field, $value);
    $this->mod->port->p->where('id', $doctor_id);
    $this->mod->port->p->limit(1);
    $this->mod->port->p->update('p1_ts');
  }

}

/* End of file ts.php */
/* Location: ./application/controllers/admin/ts.php */