<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance_provider extends CI_Model {

  private $_providers = NULL;
  private $_assoc = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->load->database();
  }

  public function get()
  {
    if ($this->_providers)
    {
      return $this->_providers;
    }
  	$this->db->order_by('code');
  	$this->db->from('insurance_provider');
    return $this->_providers = $this->db->get();
  }

  public function get_assoc()
  {
    if ($this->_assoc)
    {
      return $this->_assoc;
    }

    $providers = array();
    foreach ($this->get()->result() as $row) {
      $providers[$row->code] = $row;
    }

    return $this->_assoc = $providers;
  }

  /**
   *
   */
  public function user_inspro(&$user)
  {
    if (isset($user->native->insurance_provider) && $user->native->insurance_provider && !is_array($user->native->insurance_provider))
    {
      $split = explode(',', $user->native->insurance_provider);

      $inspro = $this->get_assoc();
      $arr = array();
      foreach ($split as $code)
      {
        if ($code && $inspro[$code])
        {
          $arr[$code] = $inspro[$code];
        }
      }
      $user->inspro_assoc = $arr;
    }

    if (!isset($user->inspro_assoc) || !is_array($user->inspro_assoc))
    {
      $user->inspro_assoc = array();
    }
  }

}

/* End of file insurance_provider.php */
/* Location: ./application/models/insurance_provider.php */