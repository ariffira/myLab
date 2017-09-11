<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Model {

  private $_langs = NULL;
  private $_assoc = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->load->database();
  }

  public function get()
  {
    if ($this->_langs)
    {
      return $this->_langs;
    }
  	$this->db->order_by('code');
  	$this->db->from('languages');
    return $this->_langs = $this->db->get();
  }

  public function get_assoc()
  {
    if ($this->_assoc)
    {
      return $this->_assoc;
    }

    $languages = array();
    foreach ($this->get()->result() as $row) {
      $languages[$row->code] = $row;
    }

    return $this->_assoc = $languages;
  }

  /**
   *
   */
  public function user_langs(&$user)
  {
    if (isset($user->native->languages) && $user->native->languages && !is_array($user->native->languages))
    {
      $split = explode(',', $user->native->languages);

      $langs = $this->get_assoc();
      $arr = array();
      foreach ($split as $code)
      {
        if ($code && $langs[$code])
        {
          $arr[$code] = $langs[$code];
        }
      }
      $user->native->langs_assoc = $arr;
    }
  }

}

/* End of file language.php */
/* Location: ./application/models/language.php */