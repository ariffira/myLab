<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
    if ($this->mod->user_role() >= 9)
    {
      //$this->index();
    }
    else
    {
      // redirect('auth/login');
      show_error('Access denied.');
    }
  }

  /**
   *
   */
  public function index()
  {
    $role = $this->mod->user_role();

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

    $admins = $this->moadmin->get_list();

    $this->mod->port->p->db_select();
    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    $total_count = count($this->moadmin->get_list());

    $this->load->library('pagination');

    $config['base_url'] = site_url('admin/admin').'?'.$this->input->server('QUERY_STRING').($this->input->server('QUERY_STRING') ? '&' : '');
    $this->mod->port->p->db_select();
    $config['total_rows'] = $total_count;
    $config['per_page'] = 10; 
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 's';

    $this->pagination->initialize($config); 

    $pagination = $this->pagination->create_links();

    $page_data = array(
      'admins' => $admins,
      'pagination' => $pagination,
    );

    $page_content = $this->load->view('admin_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function entry($id = NULL)
  {
    if ($id === NULL || !is_numeric($id))
    {
      redirect('admin/admin');
    }

    $this->mod->port->p->where('id', $id);
    $this->mod->port->p->limit(1);

    $admins = $this->moadmin->get_list();

    $page_data = array(
      'admins' => $admins,
    );

    $page_content = $this->load->view('admin_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_field($admin_id = NULL)
  {
    if ($admin_id === NULL || !is_numeric($admin_id))
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

    $fields = $this->mod->port->p->field_data('admin');

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
    $this->mod->port->p->where('id', $admin_id);
    $this->mod->port->p->limit(1);
    $this->mod->port->p->update('admin');
  }

  /**
   *
   */
  public function activate_module($admin_id = NULL)
  {
    if ($admin_id === NULL || !is_numeric($admin_id))
    {
      return;
    }

    $field = $this->input->post('field');
    $value = $this->input->post('value');

    if (!$field || !is_string($field))
    {
      return;
    }

    $this->mod->port->p->db_select();
    if ($value)
    {
      $query = $this->mod->port->p->get_where('admin_modules', array('module' => $field, 'admin_id' => $admin_id, ), 1);
      if ($query->num_rows() > 0)
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->where('module', $field);
        $this->mod->port->p->where('admin_id', $admin_id);
        $this->mod->port->p->limit(1);
        $this->mod->port->p->update('admin_modules');
      }
      else
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->set('module', $field);
        $this->mod->port->p->set('admin_id', $admin_id);
        $this->mod->port->p->insert('admin_modules');
      }
    }
    else
    {
      $this->mod->port->p->where('module', $field);
      $this->mod->port->p->where('admin_id', $admin_id);
      $this->mod->port->p->limit(1);
      $this->mod->port->p->delete('admin_modules');
    }

  }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */