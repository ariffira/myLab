<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Miconsult extends CI_Model {

  const STATUS_OPENED        = 0;
  const STATUS_CLOSED        = 1;
  public static $encrypted_fields = array('keyword', 'message', 'reply_message_patient', );
  public static $plain_fields     = array('id', 'patient_id', 'document_name', 'document_extension', 'document_date', 'doc_reg_id', 'rememberoption', 'access_permission', 'question_status', 'delete_status','doctorcheck','familydoctor' );
  public static $datetime_fields  = array('reply_message_patient_date', 'date', 'date_added', 'date_modified', );
  /*
  |--------------------------------------------------------------------------
  | PUBLIC VARS
  |--------------------------------------------------------------------------
  */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  public function get_epres_list() 
  {
    $this->m->port->m->db_select();
    $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0),100);
    $this->m->port->m->db_select();
    $this->m->port->m->select("p.*", FALSE);
    $this->m->port->m->from("eprescription AS p");
    $this->m->port->m->where('delete_status',0); 
    $this->m->port->m->where('patient_id',$this->m->user_id()); 
    $this->m->port->m->where("(status = 3 OR status = 1)");
    $this->m->port->m->order_by('id','desc');
    $query=$this->m->port->m->get();
    $result=array_splice($query->result(),0,3);
    return $result;   
  }
  
  public function get_epres_list1() 
  {
    $this->m->port->m->db_select();
    $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0),100);
    $this->m->port->m->db_select();
    $this->m->port->m->select("p.*", FALSE);
    $this->m->port->m->from("eprescription AS p");
    $this->m->port->m->where('delete_status',0); 
    $this->m->port->m->where("status ",1);
    $this->m->port->m->order_by('id','desc');
    $query=$this->m->port->m->get();
    $result=array_splice($query->result(),0,3);
    return $result;   
  }
  function get_latestdoctoreconsult()
  {
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      $return =(object)array('all' => $_ci->miconsult->get(array(),TRUE),
                             'opened' => $_ci->miconsult->get(array('question_status' => Miconsult::STATUS_OPENED,'doctorcheck'=>2,),TRUE),
                             'closed' => $_ci->miconsult->get(array('question_status' => Miconsult::STATUS_CLOSED,),TRUE),);
      return $return;
  }
  function get_latestpatienteconsult()
  {
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      $return = (object) array('all'    => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(),), TRUE),
                               'opened' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_OPENED),TRUE),
                               'closed' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_CLOSED),TRUE),);
      return $return;
  }
  function get_econsult_doctor()
  {
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      
    return $this->m->role_diff(
      function() use ($_ci)
      {
                            $this->m->port->p->db_select();
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('doctor_inserted_id' => $this->m->user_id(),));
                            if ($accessibility->num_rows() > 0) {
                             $family_doctor=$accessibility->result();
                             $where_field='(doctorcheck ="2" or familydoctor in ('.$_ci->m->user_id().'))';
                            } else {
                                $family_doctor='';
                             $where_field='(doctorcheck ="2")';  
                            }
//                            print_r($family_doctor);die;
//                            $this->m->port->m->db_select();
//                            $this->m->port->m->where("$family_doctor");
//                            $all=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(),), TRUE);
//                            
//                            $this->m->port->m->db_select();
//                            $this->m->port->m->where("$family_doctor");
//                            $open=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(), 'question_status' => Miconsult::STATUS_OPENED,  ), TRUE);
//
//                            $this->m->port->m->db_select();
//                            $this->m->port->m->where("$family_doctor");
//                            $close=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(), 'question_status' => Miconsult::STATUS_CLOSED,  ), TRUE);

                            $all_result_array=array();
                            $open_result_array=array();
                            $close_result_array=array();
                            $this->m->port->m->db_select();
                            $this->m->port->m->where($where_field);
                            $all=$_ci->miconsult->get(array(),TRUE);
                            if(!empty($family_doctor) && $family_doctor!=''){
                            foreach ($all as $all_value){
                                
                                      foreach($family_doctor as $doctor){
                                          if($all_value->patient_id==$doctor->patient_id){
                                              array_push($all_result_array, $all_value);  
                                              if($all_value->question_status==Miconsult::STATUS_OPENED)
                                                   array_push($open_result_array, $all_value);
                                              if($all_value->question_status==Miconsult::STATUS_CLOSED)
                                                   array_push($close_result_array, $all_value);
                                          }
                                      }
                                }
//                                if($all_value->patient_id==)
                            }
                            else {
                              $all_result_array=  $all;
                            }
        $return = (object) array(
          'all' =>$all_result_array,
          'opened' => $open_result_array,
          'closed' => $close
           );
        
        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      },
      function() use ($_ci)
      {
        $return = (object) array(
          'all' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(),), TRUE),
          'opened' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_OPENED), TRUE),
          'closed' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_CLOSED), TRUE),
          );

        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      }
    );

      return $return;
  }
  function get_econsult_patient()
  {
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      $return = (object) array('all'    => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(),), TRUE),
                               'opened' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_OPENED),TRUE),
                               'closed' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_CLOSED),TRUE),);
      return $return;
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
  public function get($value, $field = 'patient_id', $get_files = FALSE)
  {
    if (is_array($value))
    {
      $condition = $value;
      $get_files = $field ? ($field === 'patient_id' ? FALSE : $field) : FALSE;
    }
    else
    {
      if (is_string($field))
      {
        $condition = array($field => $value, );
      }
      else
      {
        $get_files = $field;
        $condition = array('patient_id' => $value, ); 
      }
    }
//    if (count($condition) <= 0)
//    {
//      return array();
//    }

    if ($get_files)
    {
      $this->load->model('document/mdoc');
    }
    $ret = $this->m->get('m', 'iconsult', $condition, self::$encrypted_fields);
    
    if (count($ret) > 0)
    {
      foreach ($ret as $index => $row)
      {
        $ret[$index]->replies = $this->get_replies($row->id);
        if ($get_files) 
        {
          $ret[$index]->files = array();
          $files = $this->m->get('m', 'iconsult_files', array('iconsult_id' => $row->id, ), array('document_name', ), array());
          foreach ($files as $file)
         {
          $this->m->port->m->limit(1);
          $entry_id = $file->id;
          $file = $this->mdoc->get($file->document_id, 'id');
          if (count($file) > 0)
          {
            $file = $file[0];
            $file->entry_id = $entry_id;
          }
          else
          {
            continue;
          }
          $ret[$index]->files[] = $file;
         }
        }
      }
    }
    return $ret;
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
                            $this->m->port->p->db_select();
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('patient_id' => $_ci->m->us_id(), 'doctor_inserted_id' => $this->m->user_id(),), 1);
                            
                            if ($accessibility->num_rows() > 0) {
                             $family_doctor='(doctorcheck ="2" or familydoctor in ('.$_ci->m->user_id().'))';
                            } else {
                             $family_doctor='(doctorcheck ="2")';  
                            }
                            
                            $this->m->port->m->db_select();
                            $this->m->port->m->where("$family_doctor");
                            $all=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(),), TRUE);
                            
                            $this->m->port->m->db_select();
                            $this->m->port->m->where("$family_doctor");
                            $open=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(), 'question_status' => Miconsult::STATUS_OPENED,  ), TRUE);

                            $this->m->port->m->db_select();
                            $this->m->port->m->where("$family_doctor");
                            $close=$_ci->miconsult->get(array('patient_id' => $_ci->m->us_id(), 'question_status' => Miconsult::STATUS_CLOSED,  ), TRUE);
        $return = (object) array(
          'all' =>$all,
          'opened' => $open,
          'closed' => $close
           );
        
        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      },
      function() use ($_ci)
      {
        $return = (object) array(
          'all' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(),), TRUE),
          'opened' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_OPENED), TRUE),
          'closed' => $_ci->miconsult->get(array('patient_id' => $_ci->m->user_id(), 'question_status' => Miconsult::STATUS_CLOSED), TRUE),
          );

        foreach ($return as $key => $arr)
        {
          usort($arr, function($a, $b){
            return strtotime($a->document_date) < strtotime($b->document_date) ? 1 : (strtotime($a->document_date) == strtotime($b->document_date) ? ($a->id < $b->id ? 1 : -1) : -1);
          });
          $return->$key = $arr;
        }

        return $return;
      }
    );
  }


  /**
   *
   */

  public function get_replies($value, $field = 'iconsult_id')
  {
    if (is_array($value))
    {
      $condition = $value;
    }
    else
    {
      $condition = array($field => $value, );
    }

    if (count($condition) <= 0)
    {
      return array();
    }

    foreach ($condition as $field => $value)
    {
      if ($field) {
        $this->m->port->m->where($field, $value);
      }
    }

    $this->m->port->m->db_select();
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->order_by('reply_date', 'desc');
    $this->m->port->m->from('iconsult_replies');

    $query = $this->m->port->m->get();

    if ($query->num_rows() > 0)
    {
      $result = array();
      $patient_detial="";
       $complete_replies=$query->result();      
      foreach ($complete_replies as $row)
      {
          if($row->doc_reg_id && $row->reply_by==1 && empty($patient_detial) && $patient_detial==""){   
           $pat_query = $this->m->port->p->get_where('patients', array('regid' => $row->doc_reg_id), 1);
                if ($pat_query->num_rows() > 0)
                {
                $patient_detail= $pat_query->row();
                }
                else {
                    $patient_detail=array();
                }
          }
        # Encrypted values
        foreach (array('reply_message') as $field) {
          $row->$field = $this->aes_encrypt->de($row->$field);
        }

        if ($row->doc_reg_id)
        {
            if($row->reply_by==0){
          $doc_query = $this->m->port->p->get_where('doctors', array('regid' => $row->doc_reg_id), 1);
          if ($doc_query->num_rows() > 0)
          {
            $row->doctor = $doc_query->row();
          }
            }
        else {
            $row->patient = $patient_detail;
        }
        }

        $result[] = $row;
      }

      return $result;
    }
    else
    {
      return array();
    }

  }


  /**
   *
   */


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

    $this->m->port->m->insert('iconsult');

    return $this->m->port->m->insert_id();
  }

  /**
   *
   */
  public function insert_reply($insert_params)
  {
    $this->m->db_set('m', $insert_params, 
      array('id', 'iconsult_id', 'patient_id','doc_reg_id', 'reply_by', ), 
      array('reply_date', ), 
      array('reply_message', )
    );

    $this->m->port->m->insert('iconsult_replies');

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
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->db_set('m', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    return $this->m->port->m->update('iconsult');
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

  public function delete($id)
  {
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    return $this->m->port->m->delete('iconsult');
  }

  public function get_familydoctor($patientid)
 {
  
   $this->m->port->p->select("`md`.`doctor_inserted_id`,`d`.`surname`,`d`.`name`", FALSE);
    $this->m->port->p->from("my_doctors AS md");
    $this->m->port->p->join("doctors AS d", "d.id = md.doctor_inserted_id", 'inner');
    $this->m->port->p->where("md.patient_id",$patientid);
    $this->m->port->p->where("md.access_rights",1);
     $this->m->port->p->db_select();
    $query = $this->m->port->p->get();
   
   return  $query->result();
 }

}

/* End of file miconsult.php */
/* Location: ./application/models/diagnosis/miconsult.php */