<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_config extends CI_Model {

  private $_config = NULL;

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->_config = new stdClass();
    
    $this->db_check();
  }

  /**
   *
   */
  public function db_check()
  {

    // Table Config
    $this->mod->port->p->db_select();

    if (!$this->mod->port->p->table_exists('config'))
    {
      $this->load->dbforge();
      $this->mod->port->p->db_select();

      $this->dbforge->add_field($fields_config = array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'key' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'value' => array(
          'type' => 'TEXT',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('key');
      $this->dbforge->db =& $this->mod->port->p;
      $this->dbforge->create_table('config', TRUE);
    }

    $this->mod->port->p->db_select();
    $query = $this->mod->port->p->get('config');

    $this->_config = new stdClass();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $this->_config->{$row->key} = $row->value;
      }
    }
  }

  /**
   *
   */
  public function check_default()
  {
    $_ci =& get_instance();

    foreach (array(
      'email_protocol' => 'smtp', 
      'email_smtp_host' => 'vwp3097.webpack.hosteurope.de', 
      'email_smtp_user' => 'wp1052892-102', 
      'email_smtp_pass' => 'BangkoK9?8=', 
      'email_smtp_port' => '25', 
      'email_mailtype' => 'html', 
      'email_sender_address' => 'kundenservice@ihrarzt24.de', 
      'email_sender_name' => 'Kundenservice IhrArzt24', 
      'package_running_time_type' => 'static', 
      'package_running_time' => '28', 
      'package_running_time_quant' => 'day', 
      'package_cancel_buffer_type' => 'static', 
      'package_cancel_buffer' => '28', 
      'package_cancel_buffer_quant' => 'day', 
      'doctor_confirm_subject' => 'Welcome to Cyomed - Email confirm',
      'doctor_confirm_content' => $this->load->view('templates/default_confirm_email_doctor_view', array(), TRUE),
      'patient_confirm_subject' => 'Welcome to Cyomed - Email confirm',
      'patient_confirm_content' => $this->load->view('templates/default_confirm_email_doctor_view', array(), TRUE),
      'invoice_template' => $this->load->view('templates/default_invoice_view', array(), TRUE), 
    ) as $config_key => $config_default_value)
    {
      if (!isset($this->_config->$config_key))
      {
        $this->_config->$config_key = $config_default_value;

        $this->mod->port->p->db_select();
        $this->mod->port->p->set('key', $config_key);
        $this->mod->port->p->set('value', $config_default_value);

        $this->mod->port->p->insert('config');
      }
    }
  }

  /**
   *
   */
  public function item($item_key = NULL)
  {
    return $item_key === NULL ? $this->_config : (isset($this->_config->$item_key) ? $this->_config->$item_key : FALSE);
  }

  /**
   *
   */
  public function set_item($item_key = NULL, $item_value = NULL)
  {
    if ($item_key === NULL)
    {
      $this->_config = ($item_value === NULL ? $this->_config : $item_value);
    }
    else
    {
      $this->_config->$item_key = ($item_value === NULL ? FALSE : $item_value);
    } 
  }


}

/* End of file site_config.php */
/* Location: ./application/models/site_config.php */