<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Speciality extends CI_Model {

  private $_specs = NULL;
  private $_treat = NULL;
  private $_assoc = array();


  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->load->database();
  }

  public function get()
  {
    if ($this->_specs)
    {
      return $this->_specs;
    }
    $this->db->order_by('name');
    $this->db->from('speciality');
    return $this->_specs = $this->db->get();
  }

  public function get_tr()
  {
    if ($this->_treat)
    {
      return $this->_treat;
    }
    $this->db->order_by('speciality_code');
    $this->db->from('speciality_treatment');
    return $this->_treat = $this->db->get();
  }

  public function get_assoc()
  {
    if ($this->_assoc)
    {
      return $this->_assoc;
    }

    $specs = $this->get()->result();
    $treat = $this->get_tr()->result();

    $treatment = array();
    foreach ($treat as $row) {
      if (!isset($treatment[$row->speciality_code])) {
        $treatment[$row->speciality_code] = array();
      }
      $treatment[$row->speciality_code][] = $row;
    }

    $speciality = array();
    foreach ($specs as $row) {
      $speciality[$row->code] = $row;
      array_key_exists($row->code, $treatment) ? ($speciality[$row->code]->treatment = $treatment[$row->code]) : ($speciality[$row->code]->treatment = array());
    }

    return $this->_assoc = $speciality;
  }

  /**
   *
   */
  public function user_specs(&$user)
  {
    if (isset($user->native->speciality) && $user->native->speciality && !is_array($user->native->speciality))
    {
      $split = explode(',', $user->native->speciality);

      $langs = $this->get_assoc();
      $arr = array();
      foreach ($split as $code)
      {
        if ($code && $langs[$code])
        {
          $arr[$code] = $langs[$code];
        }
      }
      $user->native->specs_assoc = $arr;
    }
  }

}

/* End of file speciality.php */
/* Location: ./application/models/speciality.php */