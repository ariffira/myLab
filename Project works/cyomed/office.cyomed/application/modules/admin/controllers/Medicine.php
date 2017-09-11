<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medicine extends MX_Controller {

	function __construct()
  	{
   		// Call the Model constructor
    	parent::__construct();

		$this->mod->login_check();
		$this->mod->login_redirect();
		if ($this->mod->user_role() == 9)
      	{
        	//$this->index();
        	$this->load->model("mmedicine");
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
    	// $sidebar[1]['active'] = TRUE;

	    $s = $this->input->get('s');
	    $n = $this->input->get('n');

	    $s = $s ? $s : 0;
	    $n = $n ? $n : 10;

	    $this->mod->port->m->db_select();
	    $this->mod->port->m->limit($n, $s);
	
	    $s_field = $this->input->get('search_field');
	    $s_value = $this->input->get('search_value');

    	if ($s_field && $s_value)
    	{
      		$this->mod->port->m->like($s_field, $s_value, 'both'); 
    	}
		
    	$medicines = $this->mmedicine->get_list();
	
    	$this->mod->port->m->db_select();
    
    	if ($s_field && $s_value)
    	{
      		$this->mod->port->m->like($s_field, $s_value, 'both'); 
    	}
	    $total_count = count($this->mmedicine->get_list());
	
	    $this->load->library('pagination');
	
	    $config['base_url'] = site_url('admin/medicine').'?'.$this->input->server('QUERY_STRING').($this->input->server('QUERY_STRING') ? '&' : '');
	    $this->mod->port->p->db_select();
	    $config['total_rows'] = $total_count;
	    $config['per_page'] = 10; 
	    $config['page_query_string'] = TRUE;
	    $config['query_string_segment'] = 's';

	    $this->pagination->initialize($config); 
	
	    $pagination = $this->pagination->create_links();
	
	    $fields = $this->mod->port->m->field_data('epres_medicine');
	    
	    $page_data = array(
	    	'fields' => $fields,
	    	'medicines' => $medicines,
	      	'pagination' => $pagination,
			'hide_search'=>FALSE
	    );

	    $page_content = $this->load->view('medicine_view', $page_data, TRUE);

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
	
	/**
   	 *
   	 */
  	public function entry($id = NULL)
  	{
    	if ($id === NULL || !is_numeric($id))
    	{
      		redirect('admin/medicine');
    	}

	    $sidebar = $this->config->item('sidebar');
	    // $sidebar[1]['active'] = TRUE;

	    $this->mod->port->m->where('id', $id);
	    $this->mod->port->m->limit(1);

	    $medicines = $this->mmedicine->get_list();
	
	    $fields = $this->mod->port->m->field_data('epres_medicine');
	    
	    $page_data = array(
	    	'fields' => $fields,
	    	'medicines' => $medicines,
    		'hide_search'=>TRUE
	    );
	    
    	$page_content = $this->load->view('medicine_view', $page_data, TRUE);

    	$output_data = array(
			'page_class' => '',
			'page_stylesheets' => array(), 
			'page_content' => $page_content, 
			'sidebar' => $sidebar,
			'jumbotron' => (object)array(
        		'title' => ucfirst(basename(__FILE__, '.php')).(count($medicines) > 0 ? (' '.$medicines[0]->medicine) : ''),
      		)
		);
    	$this->load->view('page', $output_data);
  	}
	
	/**
   	 *
   	 */
  	public function addmedicine()
  	{
    	$sidebar = $this->config->item('sidebar');
	    // $sidebar[1]['active'] = TRUE;
	    
    	$this->load->library('session');
		$page_data["error"] = $this->session->userdata('error');
		$this->session->unset_userdata('error');
    	
    	$page_content = $this->load->view('medicine_add_view', $page_data, TRUE);

    	$output_data = array(
			'page_class' => '',
			'page_stylesheets' => array(), 
			'page_content' => $page_content, 
			'sidebar' => $sidebar,
			'jumbotron' => (object)array(
        		'title' => ucfirst(basename(__FILE__, '.php')),
      		)
		);
    	$this->load->view('page', $output_data);
  	}
  	
  	/**
   	 *
   	 */
  	public function insert_fields()
  	{
	    $error = "";
	    
	    $code 	  = $this->input->post('code');
	    $sickness = $this->input->post('sickness');
	    $medicine = $this->input->post('medicine');
	    
	    if(!isset($code) || $code=="")
	    {
	    	$error = "Please enter medicine code.";
	    }
	    else if(!isset($sickness) || $sickness=="")
	    {
	    	$error = "Please enter sickness.";
	    }
	    else if(!isset($medicine) || $medicine=="")
	    {
	    	$error = "Please enter medicine name.";
	    }
	    else 
	    {
		    $this->mod->port->m->db_select();
		    $this->mod->port->m->set('code', $this->input->post('code'));
		    $this->mod->port->m->set('sickness', $this->input->post('sickness'));
		    $this->mod->port->m->set('medicine', $this->input->post('medicine'));
		    $this->mod->port->m->insert('epres_medicine');
	    }
	    
	    if($error=="")
	    {
	    	redirect('admin/medicine');
	    }
	    else 
	    {
	    	$this->load->library('session');
	    	$this->session->set_userdata(array('error'=>$error));
	    	redirect('admin/medicine/addmedicine');
	    }
  	}
	
	/**
   	 *
   	 */
  	public function update_field($id = NULL)
  	{
    	if ($id === NULL || !is_numeric($id))
   		{
      		return;
    	}

	    $field = $this->input->post('field');
	    $value = $this->input->post('value');

	    if (is_array($value))
	    {
	    	$value = implode(',', $value);
	    }

    	if (!$field || !is_string($field))
    	{
      		return;
    	}

	    if ($field == 'password')
	    {
	    	$value = md5($value);
	    }

	    $fields = $this->mod->port->m->field_data('epres_medicine');
	
	    foreach ($fields as $fd)
	    {
	    	if ($fd->name == $field && strtoupper($fd->type) == 'BLOB')
	      	{
	        	$value = $this->aes_encrypt->en($value);
	      	}
	    }

	    $this->mod->port->m->db_select();
	    $this->mod->port->m->set($field, $value);
	    $this->mod->port->m->where('id', $id);
	    $this->mod->port->m->limit(1);
	    $this->mod->port->m->update('epres_medicine');
  	}
}

/* End of file patient.php */
/* Location: ./application/controllers/admin/patient.php */