<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Db_check
|--------------------------------------------------------------------------
| 
|
*/

$config['tables'] = array(
  // table user
  'user' => array(
    
    'fields' => array(
      'id' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'username' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'hash' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
      'password_s' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      ),
    ),
    
    'keys' => array(
      array(
        'tuples' => 'id',
        'primary' => TRUE,
      ),
      'email',
      array('username', 'hash', ),
      // array(
      //   'tuples' => array('username', 'hash'),
      // ),
    ),

  ),
);

/* End of file db_check.php */
/* Location: ./application/config/db_check.php */