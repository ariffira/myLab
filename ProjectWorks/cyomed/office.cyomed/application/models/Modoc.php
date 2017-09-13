<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modoc extends CI_Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function get_id($id)
  {
    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get_where('doctors', array('id' => $id, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $fields = $this->mod->port->p->field_data('doctors');

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
        if (strpos($field->name, 'payment') !== FALSE && $field->name != 'payment')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($row->$field_name = $this->encrypt->decode($row->$field_name)) : NULL;
          }
        }
      }

      Module::$role = Module::DOCTOR_MODULES;
      $modules = $this->module->get($row->id);
      $row->modules = $modules;

      Minvoice::$role = Minvoice::DOCTOR_INVOICE;
      $this->minvoice->get_invoice($row);

      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_list()
  {
    $this->mod->port->p->db_select();

    $query = $this->mod->port->p->get('doctors');

    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      $fields = $this->mod->port->p->field_data('doctors');

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
        if (strpos($field->name, 'payment') !== FALSE && $field->name != 'payment')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($result[$index]->$field_name = $this->encrypt->decode($row->$field_name)) : NULL;
          }
        }
      }

      Module::$role = Module::DOCTOR_MODULES;
      Minvoice::$role = Minvoice::DOCTOR_INVOICE;
      foreach ($result as $index => $row)
      {
        $modules = $this->module->get($row->id);
        $result[$index]->modules = $modules;

        $this->minvoice->get_invoice($result[$index]);
      }

      return $result;
    }
    else
    {
      return array();
    }
  }


}

/* End of file modoc.php */
/* Location: ./application/models/modoc.php */