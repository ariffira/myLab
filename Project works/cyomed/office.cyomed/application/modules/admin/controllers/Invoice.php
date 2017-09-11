<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MX_Controller {

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

    $s = $this->input->get('s');
    $n = $this->input->get('n');

    $s = $s ? $s : 0;
    $n = $n ? $n : 10;

    $s_field = $this->input->get('search_field');
    $s_value = $this->input->get('search_value');

    // CURRENT DOC

    $this->mod->port->p->db_select();
    
    $this->mod->port->p->limit($n, $s);

    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    $this->minvoice->valid_payer();
    $doctors = $this->modoc->get_list();

    // TOTAL DOC

    $this->mod->port->p->db_select();
    
    if ($s_field && $s_value)
    {
      $this->mod->port->p->like($s_field, $s_value, 'both'); 
    }
    $this->minvoice->valid_payer();
    $total_doc_count = count($this->modoc->get_list());

    // PAGE DOC

    $this->load->library('pagination');

    $config['base_url'] = site_url('admin/invoice').'?'.$this->input->server('QUERY_STRING');
    $this->mod->port->p->db_select();
    $config['total_rows'] = $total_doc_count;
    $config['per_page'] = 10; 
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 's';

    $this->pagination->initialize($config); 

    $pagination = $this->pagination->create_links();

    $page_data = array(
      'doctors' => $doctors,
      'pagination' => $pagination,
    );

    $page_content = $this->load->view('invoice_doctor_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function generate()
  {
    if ($this->input->post('invoice_id'))
    {
      $this->mod->port->p->db_select();
      $this->mod->port->p->where('id', $this->input->post('invoice_id'));
      $this->mod->port->p->limit(1);
      $query = $this->mod->port->p->get('doctors_payment');

      if ($query->num_rows() > 0)
      {
        $row = $query->row();
        foreach ($row as $key => $value)
        {
          if (strpos($key, 'payment') !== FALSE && $key != 'payment')
          {
            $row->$key = $this->encrypt->decode($value);
          }
        }
        $invoice_data = (array) $row;

        $this->mod->port->p->db_select();
        $this->mod->port->p->where('id', $row->doctor_id);
        $this->mod->port->p->limit(1);
        $query = $this->mod->port->p->get('doctors');

        $row = $query->row();
        foreach ($row as $key => $value)
        {
          if (strpos($key, 'payment') !== FALSE && $key != 'payment')
          {
            $row->$key = $this->encrypt->decode($value);
          }
        }
        $invoice_data = array_merge($invoice_data, (array) $row);
      }
      else
      {
        $invoice_data = array();
      }
    }
    else
    {
      $invoice_data = array();
    }

    // $page_content = $this->load->view('admin/invoice_doctor_view', $invoice_data, TRUE);
    $page_content = preg_replace_callback('#\{([a-z0-9A_Z\-_]*?)\}#Ss', function($matches) use ($invoice_data) {
      return isset($invoice_data[$matches[1]]) ? $invoice_data[$matches[1]] : '{'.$matches[1].'}';
    }, $this->mod->dy_config->invoice_template);

    output_ajax($page_content);
  }

}

/* End of file invoice.php */
/* Location: ./application/controllers/admin/invoice.php */