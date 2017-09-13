<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mspeciality extends CI_Model {

  private $_specs = array();

  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  |
  |
  */

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function get()
  {
    if ($this->_specs && count($this->_specs) > 0)
    {
      return $this->_specs;
    }

    $this->mod->port->p->db_select();
    $this->mod->port->p->from('specialization');
    $this->mod->port->p->order_by('splizn_name', 'asc');
    
    return $this->_specs = $this->mod->port->p->get()->result();
  }

}

/* End of file mspeciality.php */
/* Location: ./application/models/mspeciality.php */