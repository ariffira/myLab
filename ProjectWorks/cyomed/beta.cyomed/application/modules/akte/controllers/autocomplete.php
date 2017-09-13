<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends MX_Controller {

  /**
   *
   */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    // Dependencies
    $this->load->model('m');
  }

  /**
   *
   */
  public function index()
  {

  }

  /**
   *
   */
  public function icd_by_code(){
    $term = trim(strip_tags($_GET['term']));
    if (!$term)
    {
      echo 'No Matches Found';
      return;
    }
    $a_json=array();
    $a_json_row=array();
    $this->m->port->p->from('icd-10-code');
    $this->m->port->p->like('icd_code', $term,'after');
    $query = $this->m->port->p->get();

    if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row){
        $a_json_row['label'] = trim($row->icd_code);
        $a_json_row['value'] = trim($row->icd_code);
        $a_json_row['diagnosis'] =  $this->m->user_value('language') == 'de'? trim($row->name_de):trim($row->name_en);
        array_push($a_json,$a_json_row);
      }
      echo json_encode($a_json);
    }

  }

  
  public function icd_by_name(){

    $term = trim(strip_tags($_GET['term']));
    if (!$term)
    {
      echo 'No Matches Found';
      return;
    }
    $a_json=array();
    $a_json_row=array();
    $this->m->port->p->from('icd-10-code');
    $this->m->user_value('language') == 'de'? $this->m->port->p->like('name_de', $term,'after'):$this->m->port->p->like('name_en', $term,'after');
    $query = $this->m->port->p->get();

    if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row){
        $a_json_row['label'] = $this->m->user_value('language') == 'de'?trim($row->name_de):trim($row->name_en);
        $a_json_row['value'] = $this->m->user_value('language') == 'de'?trim($row->name_de):trim($row->name_en);
        $a_json_row['icd'] = trim($row->icd_code);
        array_push($a_json,$a_json_row);
      }
      echo json_encode($a_json);
    }

  }


  public function atc_by_code(){
    $term = trim(strip_tags($_GET['term']));
    if (!$term)
    {
      echo 'No Matches Found';
      return;
    }
    $a_json=array();
    $a_json_row=array();
    $this->m->port->p->from('atccode');
    $this->m->port->p->like('atc_code', $term,'after');
    $query = $this->m->port->p->get();

     if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row){
        $a_json_row['label'] = trim($row->atc_code);
        $a_json_row['value'] = trim($row->atc_code);
        $a_json_row['substance'] = trim($row->substance);
        array_push($a_json,$a_json_row);
      }
      echo json_encode($a_json);
    }
  }

  
  public function atc_by_name(){

    $term = trim(strip_tags($_GET['term']));
    if (!$term)
    {
      echo 'No Matches Found';
      return;
    }
    $a_json=array();
    $a_json_row=array();
    $this->m->port->p->from('atccode');
    $this->m->port->p->like('substance', $term,'after');
    $query = $this->m->port->p->get();

    if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row){
        $a_json_row['label'] = trim($row->substance);
        $a_json_row['value'] = trim($row->substance);
        $a_json_row['atc'] = trim($row->atc_code);
        array_push($a_json,$a_json_row);
      }
      echo json_encode($a_json);
    }
  }

}

/* End of file icd_list.php */
/* Location: ./application/controllers/icd/icd_list.php */