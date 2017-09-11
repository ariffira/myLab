<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_check extends CI_Model {

  const ADD_MISSING_FIELDS = 1;
  const DROP_REDUNDANT_FIELDS = 2;
  const ADD_MISSING_TABLES = 4;
  const DROP_REDUNDANT_TABLES = 8;
  
  const FIX_FIELDS = 3;
  const FIX_TABLES = 12;

  public static $mode = self::FIX_FIELDS;

  /**
   * 
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   *
   */
  public function c()
  {


    # Load Config file

    $this->config->load('db_check', TRUE);

    $db_check_configs = $this->config->item('db_check');

    $db_table_info = $db_check_configs['tables'];

    # Start checking tables

    foreach ($db_table_info as $table_name => $table_info)
    {
      $table_fields = $table_info['fields'];
      $table_keys = $table_info['keys'];

      if ($this->db->table_exists($table_name))
      {
        $field_data = $this->db->field_data($table_name);
        $field_data_assoc = array();

        foreach ($field_data as $field)
        {
          $field_data_assoc[$field->name] = $field;
        }

        # Checking fields in config
        foreach ($table_fields as $field_name => $field_info)
        {
          if (is_string($field_info))
          {
            $this->dbforge->add_field($field_info);
          }
          elseif (is_array($field_info))
          {
            $this->dbforge->add_field(array($field_name => $field_info, ));
          }
        }

      }
      else
      {
        $this->load->dbforge();

        # Creating fields
        foreach ($table_fields as $field_name => $field_info)
        {
          if (is_string($field_info))
          {
            $this->dbforge->add_field($field_info);
          }
          elseif (is_array($field_info))
          {
            $this->dbforge->add_field(array($field_name => $field_info, ));
          }
        }

        # Adding keys
        foreach ($table_keys as $key_info)
        {
          if (is_string($key_info))
          {
            # Adding a key. Eg. *->add_key('key_field');
            $this->dbforge->add_key($key_info);
          }
          elseif (is_array($key_info))
          {
            if (isset($key_info['tuples']))
            {
              # When $key_info has a structure of $key_info => array('tuples' => string | array, ['primary' => mixed, ] );
              if (is_string($key_info['tuples']) || is_array($key_info['tuples']))
              {
                # $key_info['tuples'] has to be either a string or an array
                if (isset($key_info['primary']) && $key_info['primary'])
                {
                  $this->dbforge->add_key($key_info, $key_info['primary'] ?  TRUE : FALSE);
                }
                else
                {
                  $this->dbforge->add_key($key_info);
                }
              }
            }
            else
            {
              # When $key_info is just an array
              if (isset($key_info[1]) && !is_string($key_info[1]))
              {
                # Adding as args. Eg. *->add_key('id', TRUE)
                $this->dbforge->add_key($key_info[0], $key_info[1] ?  TRUE : FALSE);
              }
              else
              {
                # Adding a tuple. Eg. *->add_key(array('some_id', 'field_name', ))
                $this->dbforge->add_key($key_info);
              }
            }
          }
        }

        $this->dbforge->create_table($table_name, TRUE);
      }
    }

  }

}

/* End of file db_check.php */
/* Location: ./application/models/db_check.php */