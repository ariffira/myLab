<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moadmin extends CI_Model {

  public static $encrypted_fields = array( );
  public static $plain_fields     = array('id', 'name', 'role', 'regid','login','status', );
  public static $datetime_fields  = array('lastlogin', );


  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->load->database();
  }

  public function get_id($id)
  {
    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get_where('admin', array('id' => $id, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->mod->port->p->field_data('admin');

      foreach ($fields as $field)
      {
         // echo $field->name;
         // echo $field->type;
         // echo $field->max_length;
         // echo $field->primary_key;
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($row->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }

      Module::$role = Module::ADMIN_MODULES;
      $modules = $this->module->get($row->id);
      $row->modules = $modules;

      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  public function get_list()
  {
    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get('admin');

    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      $fields = $this->mod->port->p->field_data('admin');

      foreach ($fields as $field)
      {
         // echo $field->name;
         // echo $field->type;
         // echo $field->max_length;
         // echo $field->primary_key;
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($result[$index]->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }

      Module::$role = Module::ADMIN_MODULES;
      foreach ($result as $index => $row)
      {
        $modules = $this->module->get($row->id);
        $result[$index]->modules = $modules;
      }

      return $result;
    }
    else
    {
      return array();
    }
  }

    /*
  |get the list of patient for service from database who are not yet taken by any service person
  |
  */
  public function get_patients_list(){
    
    $this->mod->port->p->select('c.id, q.id as quickblox_id, q.regid, c.patient_regid,c.patient_name, c.patient_surname, c.patient_phone,c.patient_address,c.help_apply_time,c.care_doctor_id');
    $this->mod->port->p->from('care_chatservice as c');
    $this->mod->port->p->join('quickblox as q','q.regid = c.patient_regid');
    $this->mod->port->p->where('c.care_doctor_id',$this->mod->user_id());
    $this->mod->port->p->or_where('c.care_doctor_id',0);
    $this->mod->port->p->where('c.help_status',1);
    $query = $this->mod->port->p->get();
    
    //$where = 'care_doctor_id='.$this->mod->user_value('id').' or care_doctor_id=0 and help_status=1';
    // $this->mod->port->p->where('care_doctor_id',$this->mod->user_id());
    // $this->mod->port->p->or_where('care_doctor_id',0);
    // $this->mod->port->p->where('help_status',1);
    // $query = $this->mod->port->p->get('care_chatservice');
      $patients = array();
      $temp = array();
      foreach ($query->result() as $row){
        $temp['id'] = $row->id;
        $temp['quickblox_id'] = $row->quickblox_id;
        $temp['name'] = $row->patient_name.' '.$row->patient_surname;
        $temp['regid'] = $row->patient_regid;
        $temp['address'] = $row->patient_address;
        $temp['phone'] = $row->patient_phone;
        $temp['apply_time'] = $row->help_apply_time;
        $temp['care_doctor_id'] = $row->care_doctor_id;
        array_push($patients, $temp);
      }
      usort($patients, function($a, $b) {
        $ad = new DateTime($a['apply_time']);
        $bd = new DateTime($b['apply_time']);
        if ($ad == $bd) {
          return 0;
        }
        return $ad < $bd ? 1 : -1;
    });
      return $patients;
  }

  

}

/* End of file moadmin.php */
/* Location: ./application/models/moadmin.php */