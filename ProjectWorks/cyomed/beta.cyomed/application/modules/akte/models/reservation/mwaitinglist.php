<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mwaitinglist extends CI_Model {

  public static $encrypted_fields = array();
  public static $plain_fields     = array('id','pat_id','doc_id','pat_email','status',);
  public static $datetime_fields  = array('wish_date',);

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

    // Dependencies
    $this->load->model('m');
  }


  /*
  |--------------------------------------------------------------------------
  | INSERTING patient to waiting list
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */
  public function insert($insert_params)
  {
    $this->m->db_set('b', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->b->db_select();

    $this->m->port->b->insert('waitinglist');

    return $this->m->port->b->insert_id();
  }



  
  
}

/* End of file mwaitinglist.php */
/* Location: ./application/models/reservation/mwaitinglist.php */