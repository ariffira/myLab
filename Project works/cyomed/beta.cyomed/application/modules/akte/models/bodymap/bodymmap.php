<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bodymmap extends CI_Model {

    public static $plain_fields = array('id', 'pain_intensity', 'pain_type', 'qualities', 'date_from', 'date_added', 'added_by', 'user_role','time_from',
        'x_position','y_position');
     public static $encrypted_fields =array();
     public static $datetime_fields=array('date_from','date_added','date_modified');
    /*
      |--------------------------------------------------------------------------
      | PUBLIC VARS
      |--------------------------------------------------------------------------
      |
      |
     */

    function __construct() {
        // Call the Model constructor   
        parent::__construct();
    }


  /**
   *
   */
  public function update($id, $update_params)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }
    $this->m->port->m->db_select();
    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);    
    $result = $this->m->port->m->update('bodymap');
    return $result;
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
  public function delete($id,$updateprams)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
      
      if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    return $this->m->port->m->delete('bodymap');
 
  }



    public function get_all() {
        static $_ci;       
        if (empty($_ci))
            $_ci = & get_instance();
                    $_ci->m->port->m->db_select();
                    $_ci->m->port->m->order_by('date_added', 'desc');
                    $_ci->m->port->m->order_by('id', 'desc');        
        return $this->m->role_diff(
                        function() use ($_ci) { 
                    $return = $_ci->bodymmap->get(array('patient_id' => $_ci->m->us_id(),'access_permission >=' => $_ci->m->us_access(),), TRUE);
                    return $return;
                }, function() use ($_ci) {  
                    $return = $_ci->bodymmap->get(array('patient_id' => $_ci->m->user_id()), TRUE);                    
                    return $return;
                }
        );
    }

    public function get($value, $field = 'patient_id') {
       
        if (is_array($value)) {
            $condition = $value;           
        } else {
            if (is_string($field)) {
                $condition = array($field => $value,);
            } else {               
                $condition = array('patient_id' => $value,);
            }
        }

        if (count($condition) <= 0) {
            return array();
        }        
        $ret  = $this->m->get('m','bodymap',$condition,self::$encrypted_fields);
//        echo $this->m->port->m->last_query();die;
//        $ret = $query->result();       
        return $ret;
    }

        public function insert($insert_params) {

        $this->m->port->m->db_select();
        $this->m->port->m->insert('bodymap', $insert_params);
        $insert_id = $this->m->port->m->insert_id();
        return $insert_id;
    }

}

/* End of file mmedication.php */
/* Location: ./application/models/medication/mmedication.php */