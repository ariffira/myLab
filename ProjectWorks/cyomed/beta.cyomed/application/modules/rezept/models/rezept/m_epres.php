<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_epres extends CI_Model {

  public static $encrypted_fields = array();
  public static $plain_fields     = array('id', 'follow_up','familydoctor','Handelsname','doctorcheck','drug', 'atc_code', 'manufacturer', 'comments','doc_comments', 'packsize', 'pzn', 'patient_id', 'status', 'delete_status','sickness', );
  public static $datetime_fields  = array('date_added','date_modified');


function __construct()
{
   // Call the Model constructor
   parent::__construct();
}
    
public function get_info($id, $patient_id) 
{
    //get eprescription information which is status 0 , means not prescribed yet for specific patient... 
    $this->m->port->m->db_select();
    $result = $this->m->port->m->get_where('eprescription', array('id' => $id, 'patient_id' => $patient_id, 'status' => 0, ) );
    $result_row   = $result->row(); 
    $user_result['id'] = $result_row->id;
    $user_result['doctorcheck']          = $result_row->doctorcheck;
    $user_result['patient_id']  = $result_row->patient_id;
    $user_result['follow_up']   = $result_row->follow_up;
    $user_result['Handelsname'] = $result_row->Handelsname;
    $user_result['drug']        = $result_row->drug;
    $user_result['atc_code']    = $result_row->atc_code;
    $user_result['packsize']    = $result_row->packsize;
    //$user_result['pzn'] = $result_row->pzn;
    $user_result['manufacturer']= $result_row->manufacturer;
    $user_result['comments']    = $result_row->comments;
    //$user_result['status']    = $result_row->status;
    return $user_result;
}

//doctor will have this info if status is 0 means not approved yet
public function get_epres_list() 
{
    //get eprescription information which is status 0 from eprescription, means not prescribed yet for specific patient... 
    $this->m->port->m->db_select();
    $query = $this->m->port->m->get_where('eprescription', array('patient_id' => $this->m->us_id(),'delete_status' => 0, 'status !=' => 0, ) );
    $result = array();
    foreach ($query->result() as $row)
    {
     array_push($result, $row);
    }
    return $result;   
}

//patient will see his applications list
public function list_of_applications($patient=false) 
{
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      
    return $this->m->role_diff(
      function() use ($_ci,$patient)
      {
                            $this->m->port->m->db_select();
                            $this->m->port->m->order_by('id','desc');
                            if($patient){
                            $query = $this->m->port->m->get_where('eprescription', array('patient_id' => $this->m->us_id(), 'delete_status' => 0,'status'=>1 ) );
                            }
                            else{
                            $this->m->port->p->db_select();
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('doctor_inserted_id' => $this->m->user_id(),));
                            if ($accessibility->num_rows() > 0) {
                             $family_doctor=$accessibility->result();
                             $where_field='(doctorcheck ="2" or familydoctor in ('.$_ci->m->user_id().'))';
                            } else {
                                $family_doctor='';
                             $where_field='(doctorcheck ="2")';  
                            }                                
                             $this->m->port->m->where($where_field);
                            $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0,'status'=>1 ) );                
                            }
                        return $query->result();
   
      },
      function() use ($_ci)
      {
            $this->m->port->m->db_select();
            $query = $this->m->port->m->get_where('eprescription', array('patient_id' => $this->m->user_id(), 'delete_status' => 0, ) );
        return $query->result();
      }
    );
   
    
}


public function get_selected_epres($id) 
{
    //show all information for selected eprescription application for checking by doc
    $this->m->port->m->db_select();
    $result = $this->m->port->m->get_where('eprescription', array('id' => $id, 'status' => 0,) );
    $result_row   = $result->row(); 
    $user_result['id']          = $result_row->id;
    $user_result['patient_id']  = $result_row->patient_id;
    $user_result['follow_up']   = $result_row->follow_up;
    $user_result['Handelsname'] = $result_row->Handelsname;
    $user_result['drug']        = $result_row->drug;
    $user_result['atc_code']    = $result_row->atc_code;
    $user_result['packsize']    = $result_row->packsize;
    //$user_result['pzn'] = $result_row->pzn;
    $user_result['manufacturer']= $result_row->manufacturer;
    $user_result['comments']    = $result_row->comments;
    //$user_result['status']    = $result_row->status;
    return $user_result;
}

/*
* insert eprescription dataaccept
*/
public function insert($insert_params)
{

        $this->m->db_set('m', $insert_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);
        $this->m->port->m->db_select();
        $this->m->port->m->insert('eprescription');
        $insert_id = $this->m->port->m->insert_id();

        return $insert_id;

}


/**
 *
*/
public function update($id, $update_params)
{
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->m->port->m->update('eprescription');
}


/*
*update the status of the rezept to 1 (sent to cyomed)
*status = 0 is submitted but not sent to cyomed
*status = 1 is sent to cyomed
*status = 2 is checked by doctor
*status = 3 is checked and accepted
*status = 4 is checked not accepted
*/
 public function set_status($epresid,$status)
 {
    $this->m->port->m->where('id',$epresid);
    $data=array(
        'status'  => $status
        );
    $this->m->port->m->update('eprescription',$data);
 }
 public function set_sickness($epresid,$sickness)
 {
  $this->m->port->m->where('id',$epresid);
  $data=array(
      'sickness'  =>$sickness
      );
  $this->m->port->m->update('eprescription',$data);
 }
 public function get_familydoctor($patientid)
 {
  
   $this->m->port->p->select("`md`.`doctor_inserted_id`,`d`.`surname`,`d`.`name`", FALSE);
    $this->m->port->p->from("my_doctors AS md");
    $this->m->port->p->join("doctors AS d", "d.id = md.doctor_inserted_id", 'inner');
    $this->m->port->p->where("md.patient_id",$this->m->user_id());
    $this->m->port->p->where("md.access_rights",1);
     $this->m->port->p->db_select();
    $query = $this->m->port->p->get();
   
   return  $query->result();
 }

// funtion for the get_epres_list of the all patients
    public function get_epres_list_all(){
    $this->m->port->m->db_select();
    $this->m->port->m->order_by('id','desc');
    $this->m->port->m->where_in('familydoctor',array($this->m->user_id(),""));
    $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0 ) );
    $result = array();
    foreach ($query->result() as $row)
    {
     array_push($result, $row);
    }
    return $result;   
    }
}