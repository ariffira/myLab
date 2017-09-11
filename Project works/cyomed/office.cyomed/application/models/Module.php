<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Model {

  const PATIENT_MODULES = 'patient_modules';
  const DOCTOR_MODULES = 'doctor_modules';
  const ADMIN_MODULES = 'admin_modules';

  public static $role = NULL;

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

    $this->mod->port->p->db_select();

    if (!$this->mod->port->p->table_exists('doctor_modules'))
    {
      $this->load->dbforge();
      $this->mod->port->p->db_select();

      $this->dbforge->add_field($fields_config = array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'doctor_id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
        ),
        'module' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'activate' => array(
          'type' => 'TINYINT',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('doctor_id');
      $this->dbforge->create_table('doctor_modules');
    }

    if (!$this->mod->port->p->table_exists('patient_modules'))
    {
      $this->load->dbforge();
      $this->mod->port->p->db_select();

      $this->dbforge->add_field($fields_config = array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'patient_id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
        ),
        'module' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'activate' => array(
          'type' => 'TINYINT',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('patient_id');
      $this->dbforge->create_table('patient_modules');
    }

    if (!$this->mod->port->p->table_exists('admin_modules'))
    {
      $this->load->dbforge();
      $this->mod->port->p->db_select();

      $this->dbforge->add_field($fields_config = array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'admin_id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
        ),
        'module' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'activate' => array(
          'type' => 'TINYINT',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('admin_id');
      $this->dbforge->create_table('admin_modules');
    }
  }

  /**
   *
   */
  public function get($value, $field = NULL)
  {
    if (self::$role === NULL)
    {
      return array();
    }

    if ($field === NULL)
    {
      if (self::$role === self::PATIENT_MODULES)
      {
        $field = 'patient_id';
      }
      if (self::$role === self::DOCTOR_MODULES)
      {
        $field = 'doctor_id';
      }
      if (self::$role === self::ADMIN_MODULES)
      {
        $field = 'admin_id';
      }
    }

    if (is_array($value))
    {
      $condition = $value;
    }
    else
    {
      if (is_string($field))
      {
        $condition = array($field => $value, );
      }
      else
      {
        if (self::$role === self::PATIENT_MODULES)
        {
          $field = 'patient_id';
        }
        if (self::$role === self::DOCTOR_MODULES)
        {
          $field = 'doctor_id';
        }
        if (self::$role === self::ADMIN_MODULES)
        {
          $field = 'admin_id';
        }
        $condition = array($field => $value, ); 
      }
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    $this->mod->port->p->db_select();
    foreach ($condition as $field => $value)
    {
      $this->mod->port->p->where($field, $value);
    }
    if (self::$role === self::PATIENT_MODULES)
    {
      $table = 'patient_modules';
    }
    if (self::$role === self::DOCTOR_MODULES)
    {
      $table = 'doctor_modules';
    }
    if (self::$role === self::ADMIN_MODULES)
    {
      $table = 'admin_modules';
    }
    $query = $this->mod->port->p->get($table);

    $ret = array();

    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $ret[$row->module] = $row;
      }
    }

    return $ret;
  }

  public function activate($user_id = NULL, $field = NULL, $value = 1)
  {
    if ($user_id === NULL || !is_numeric($user_id))
    {
      return;
    }

    if ($field === NULL || !is_string($field))
    {
      return;
    }

    if (self::$role === self::PATIENT_MODULES)
    {
      $table = 'patient_modules';
      $id_field = 'patient_id';
    }
    if (self::$role === self::DOCTOR_MODULES)
    {
      $table = 'doctor_modules';
      $id_field = 'doctor_id';
    }
    if (self::$role === self::ADMIN_MODULES)
    {
      $table = 'admin_modules';
      $id_field = 'admin_id';
    }

    $this->mod->port->p->db_select();
    if ($value)
    {
      $query = $this->mod->port->p->get_where($table, array('module' => $field, $id_field => $user_id, ), 1);
      if ($query->num_rows() > 0)
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->where('module', $field);
        $this->mod->port->p->where($id_field, $user_id);
        $this->mod->port->p->limit(1);
        $this->mod->port->p->update($table);
      }
      else
      {
        $this->mod->port->p->set('activate', 1);
        $this->mod->port->p->set('module', $field);
        $this->mod->port->p->set($id_field, $user_id);
        $this->mod->port->p->insert($table);
      }
    }
    else
    {
      $this->mod->port->p->where('module', $field);
      $this->mod->port->p->where($id_field, $user_id);
      $this->mod->port->p->limit(1);
      $this->mod->port->p->delete($table);
    }

  }

  /**
   *
   */
  public function activated($module_name = NULL, $modules = array())
  {
    if ($module_name === NULL || !$module_name)
    {
      return FALSE;
    }

    if (!is_array($modules) || count($modules) <= 0)
    {
      return FALSE;
    }

    if (isset($modules[$module_name]) && is_object($modules[$module_name]) && $modules[$module_name]->activate)
    {
      return $modules[$module_name];
    }
    else
    {
      return FALSE;
    }
  }

}

/* End of file module.php */
/* Location: ./application/models/module.php */