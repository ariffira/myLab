<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgraph extends CI_Model {

  const TABLE_HEART_FREQUENCY = 'heart_frequency';
  const TABLE_BLOOD_SUGAR     = 'blood_sugar';
  const TABLE_WEIGHT_BMI      = 'weight_bmi';
  const TABLE_MARCUMAR        = 'marcumar';

  public static $encrypted_fields = array();
  public static $plain_fields     = array(
    'id', 'patient_id','added_by','user_role', 'graph_generation', 'access_permission',
    'rr_sys', 'rr_dia', 'puls',
    'bloodsugar', 'HbA1C',
    'size', 'weight', 'bmi',
    'INR', 'quick', 'lower_limit', 'upper_limit',
  );
  public static $datetime_fields  = array('rec_date', 'rec_time', 'date_added', 'date_modified', );

  public static $graph_table      = 'heart_frequency';

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
  public function get($value, $field = 'patient_id')
  {
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
        $condition = array('patient_id' => $value, ); 
      }
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    return $ret = $this->m->get('m', self::$graph_table, $condition, self::$encrypted_fields, array());
  }

  /**
   *
   */
  public function get_table($table, $value, $field = 'patient_id')
  {
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
        $condition = array('patient_id' => $value, ); 
      }
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    return $ret = $this->m->get('m', $table, $condition, self::$encrypted_fields, array());
  }

  /**
   *
   */
  public function get_all()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = (object) array(
          'heart_frequency' => $_ci->mgraph->get_heart_frequency(),
          'blood_sugar' => $_ci->mgraph->get_blood_sugar(),
          'weight_bmi' => $_ci->mgraph->get_weight_bmi(),
          'marcumar' => $_ci->mgraph->get_marcumar(),
        );
  
        return $return;
      },
      function() use ($_ci)
      {
        $return = (object) array(
          'heart_frequency' => $_ci->mgraph->get_heart_frequency(),
          'blood_sugar' => $_ci->mgraph->get_blood_sugar(),
          'weight_bmi' => $_ci->mgraph->get_weight_bmi(),
          'marcumar' => $_ci->mgraph->get_marcumar(),
        );

        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_heart_frequency()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('rec_date', 'desc');
        $_ci->m->port->m->order_by('rec_time', 'desc');
//        $_ci->m->port->m->order_by('id', 'desc');
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_HEART_FREQUENCY, array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);
         usort($return, function($a, $b){
           return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
         });

        return $return;
      },
      function() use ($_ci)
      {

        $return = $_ci->mgraph->get_table(self::TABLE_HEART_FREQUENCY, array('patient_id' => $_ci->m->user_id(), ), TRUE);
         usort($return, function($a, $b){
           return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
         });

        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_blood_sugar()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('rec_date', 'desc');
        $_ci->m->port->m->order_by('rec_time', 'desc');
//        $_ci->m->port->m->order_by('id', 'desc');
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);
        
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $_ci->m->user_id(), ), TRUE);
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_weight_bmi()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('rec_date', 'desc');
        $_ci->m->port->m->order_by('rec_time', 'desc');
//        $_ci->m->port->m->order_by('id', 'desc');
    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);
        
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $_ci->m->user_id(), ), TRUE);
        foreach ($return as $entry)
        {
        	$size = $entry->size;
        	$inch = (float)$size/2.54;
    		$feet = (int)($inch/12);
    		$inch = round($inch - ($feet * 12));
    		
    		if($inch==12)
    		{
    			$feet = $feet + 1;
    			$inch = 0; 
    		}
    		
    		$entry->feet = $feet;
    		$entry->inch = $inch;
        }
        
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      }
    );
  }

  /**
   *
   */
  public function get_marcumar()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->order_by('rec_date', 'desc');
        $_ci->m->port->m->order_by('rec_time', 'desc');
//        $_ci->m->port->m->order_by('id', 'desc');

    return $this->m->role_diff(
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $_ci->m->us_id(), 'access_permission >=' => $_ci->m->us_access(), ), TRUE);
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      },
      function() use ($_ci)
      {
        $return = $_ci->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $_ci->m->user_id(), ), TRUE);
        usort($return, function($a, $b){
          return strtotime($a->rec_date) < strtotime($b->rec_date) ? 1 : (strtotime($a->rec_date) == strtotime($b->rec_date) ? ( str_replace(':', '', $a->rec_time) < str_replace(':', '', $b->rec_time) ? 1 : ( str_replace(':', '', $a->rec_time) == str_replace(':', '', $b->rec_time) ? ($a->id < $b->id ? 1 : -1) : -1 ) ) : -1);
        });

        return $return;
      }
    );
  }

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
    $this->m->db_set('m', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->db_select();
    $this->m->port->m->insert(self::$graph_table);

    return $this->m->port->m->insert_id();
  }

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
  public function update($id, $update_params)
  {
    if (!$this->m->db_where('m', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->db_select();
    return $this->m->port->m->update(self::$graph_table);
  }

  /**
   *
   */
  public function update_multiple($id, $update_params)
  {
    if (!$this->m->db_where('m', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->m->db_select();
    return $this->m->port->m->update(self::$graph_table);
  }

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
  public function delete($id, $update_params)
  {
    if (!$this->m->db_where('m', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->port->m->db_select();
    return $this->m->port->m->delete(self::$graph_table);
  }


}

/* End of file Mgraph.php */
/* Location: ./application/models/graph/mgraph.php */