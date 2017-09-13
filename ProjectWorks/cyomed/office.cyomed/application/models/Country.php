<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Model {

  private $_query = NULL;
  private $_assoc = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  public function get($key = 'Alpha-2_code')
  {
    if ($this->_query)
    {
      return $this->_query;
    }
    $this->mod->port->p->db_select();
    $this->mod->port->p->order_by($key);
    $this->mod->port->p->from('country');
    return $this->_query = $this->mod->port->p->get();
  }

  public function get_assoc($key = 'Alpha-2_code')
  {
    if ($this->_assoc)
    {
      return $this->_assoc;
    }

    $assoc = array();
    foreach ($this->get()->result() as $row) {
      $assoc[$row->$key] = $row;
    }

    return $this->_assoc = $assoc;
  }

}

/* End of file country.php */
/* Location: ./application/models/country.php */