<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mvideochat extends CI_Model {

  public static $encrypted_fields = array( );
  public static $plain_fields     = array('id', 'callfrom', 'callto', 'conferenceId', );
  public static $datetime_fields  = array('calltime', );

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

  /*
  |--------------------------------------------------------------------------
  | SELECTING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

  public function get_confId($confId){

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('videochat', array('conferenceId' => $confId,),1  );
    $result_row   = $result->row(); 
    $call_result  = $result_row->conferenceId;

    return $call_result;
  }
 


  /**
   *
   */


  /*
  |--------------------------------------------------------------------------
  | INSERTING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

  public function insert($insert_params)
  {
    $this->m->db_set('p', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->p->insert('videochat');

    return $this->m->port->p->insert_id();
  }

  /**
   *
   */


  /*
  |--------------------------------------------------------------------------
  | UPDATING
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

  

  /*
  |--------------------------------------------------------------------------
  | DELETE
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   *
   */

 

}

/* End of file miconsult.php */
/* Location: ./application/models/diagnosis/miconsult.php */