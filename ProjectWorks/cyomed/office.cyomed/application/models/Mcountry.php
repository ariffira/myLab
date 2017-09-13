<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcountry extends CI_Model {

  private $_country = array();

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
    if ($this->_country && count($this->_country) > 0)
    {
      return $this->_country;
    }

    $this->mod->port->p->db_select();
    $this->mod->port->p->from('country');
    $this->mod->port->p->order_by('country_name', 'asc');
    
    return $this->_country = $this->mod->port->p->get()->result();
  }

}

/* End of file mcountry.php */
/* Location: ./application/models/mcountry.php */