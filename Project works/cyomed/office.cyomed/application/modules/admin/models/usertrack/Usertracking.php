<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertracking extends CI_Model {


  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  public function get_list($s=0,$n=10,$field=false,$value=false)
  {
//      echo $s.$n;
//  echo $field;
//  echo $value;die;
//    $this->mod->port->p->db_select();
//    $this->mod->port->p->select('usertracking.*','count(*) as counting');
//    $this->mod->port->p->select('count(*) as counting');
//    $this->mod->port->p->group_by('request_uri','user_identifier');
//    $query = $this->mod->port->p->get('usertracking');
      
//      $query="SELECT u.*, count(*) as counter,(case when (`u`.`user_role`='role_patient') then `p`.`regid`,`p`.`surname`,`p`.`name` else `d`.`regid`,`d`.`surname`,`d`.`name` end) regid
//  FROM `usertracking` as u left join `patients` as p on u.user_identifier=p.id left join doctors as d on u.user_identifier=d.id group by  `u`.`request_uri`";
      $like_value=($field && $value)?"where $field like '%$value%'":"";
      $limit_value=(is_int($n) && is_int($s))?"limit $s,$n":"";
      
                $query="select * from (SELECT u.*, count(*) as counter,(case when (`u`.`user_role`='role_patient') then 
                                 CONCAT_WS(' ',p.name,p.surname)  
                                 else 
                                   CONCAT_WS(' ',d.name,d.surname) 
                                 end) as fullname  FROM `usertracking` as u left join `patients` as p on u.user_identifier=p.id left join doctors as d on u.user_identifier=d.id   group by `u`.`request_uri` )  as usertrack $like_value $limit_value";      
//      echo $query;die;
    $query= $this->mod->port->p->query($query);
//      echo  $this->mod->port->p->last_query();
//    echo "<pre>";
//    print_r($result->result());die;
//    print_r($result);die;
    if ($query->num_rows() > 0)
    {
      $result = $query->result();

      $fields = $this->mod->port->p->field_data('usertracking');

      foreach ($fields as $field)
      {
        if (strtoupper($field->type) == 'BLOB')
        {
          $field_name = $field->name;
          foreach ($result as $index => $row)
          {
            isset($row->$field_name) && $row->$field_name ? ($result[$index]->$field_name = $this->aes_encrypt->de($row->$field_name)) : NULL;
          }
        }
      }
      return $result;
    }
    else
    {
      return array();
    }
  }

  public function user_list($user_role='role_patient'){
      if($user_role=='role_patient'){
          $table='patients';
      }
      else{
          $table='doctors';
      }
    $this->mod->port->p->db_select();
    $this->mod->port->p->select('DISTINCT(`u`.`user_identifier`),`p`.`name`,`p`.`id`,`p`.`surname`, `p`.`regid`',FALSE);
    $this->mod->port->p->from("usertracking AS u");
    $this->mod->port->p->join("$table AS p", "p.id = u.user_identifier", 'inner');
    $query=$this->mod->port->p->get();
     $return=$query->result();
    if($query->num_rows()>0){
        $return=$query->result();
        return $return;
    }
    else{
        return false;
    }
  }
}

/* Location: ./application/models/usertracking.php */