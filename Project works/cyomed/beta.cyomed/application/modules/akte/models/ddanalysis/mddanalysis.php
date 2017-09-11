<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mddanalysis extends CI_Model {

  public static $encrypted_fields = array();
  public static $plain_fields     = array();
  public static $datetime_fields  = array();

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

  /**
   *
   */
  public function get_drug($substance,$name)
  {
    $this->m->port->d->db_select();
    $this->m->port->d->from('drug');
    $this->m->port->d->where('name', $substance);
    $this->m->port->d->or_where('name', $name);
    $query = $this->m->port->d->get();
    //var_dump($query);
    
    //$query = $this->m->port->d->get_where('drug', array('name' => $substance));
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $query) {
          $drug_id= $query->id;
        }
      return $drug_id;
    }

    else{
      $this->m->port->d->db_select();
      $this->m->port->d->from('drug_synonym');
      $this->m->port->d->where('value', $substance);
      $this->m->port->d->or_where('value', $name);
      $query = $this->m->port->d->get('drug_id');

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $query) {
          $drug_id= $query->id;
        }
      return $drug_id;
       //return $query->result();
      }
     else{
      return;
     }
    }

  }

  /**
   *
   */
  public function get_drug_interaction($id)
  {
    $this->m->port->d->db_select();
    $query = $this->m->port->d->get_where('drug_drug_interaction', array('drug_id' => $id));
    if ($query->num_rows() > 0) {
     return $query->result();
   }
   else{
    return;
   }
  }

  /**
   *
   */
  public function get_all_info($id)
  {
    $this->m->port->d->db_select();

    $query_drug = $this->m->port->d->get_where('drug', array('id' => $id));
    if ($query_drug->num_rows() > 0) {
      $drug = $query_drug->result();
    }

    $query_drug_interaction = $this->m->port->d->get_where('drug_drug_interaction', array('drug_id' => $id));
    if ($query_drug_interaction->num_rows() > 0) {
      $drug_interaction = $query_drug_interaction->result();
    }

    $query_food_interaction = $this->m->port->d->get_where('drug_food_interaction', array('drug_id' => $id));
    if ($query_food_interaction->num_rows() > 0) {
      $food_interaction = $query_food_interaction->result();
    }

    $query_synonym = $this->m->port->d->get_where('drug_synonym', array('drug_id' => $id));
    if ($query_synonym->num_rows() > 0) {
      $synonym = $query_synonym->result();
    }

    $query_group = $this->m->port->d->get_where('drug_group', array('drug_id' => $id));
    if ($query_group->num_rows() > 0) {
      $group = $query_group->result();
    }

    $query_category = $this->m->port->d->get_where('drug_category', array('drug_id' => $id));
    if ($query_category->num_rows() > 0) {
      $category = $query_category->result();
    }

    $query_intbrand = $this->m->port->d->get_where('drug_international_brand', array('drug_id' => $id));
    if ($query_intbrand->num_rows() > 0) {
      $intbrand = $query_intbrand->result();
    }

    $query_product = $this->m->port->d->get_where('drug_product', array('drug_id' => $id));
    if ($query_product->num_rows() > 0) {
      $product = $query_product->result();
    }

    $query_classification = $this->m->port->d->get_where('drug_classification', array('drug_id' => $id));
    if ($query_classification->num_rows() > 0) {
      $classification = $query_classification->result();
    }

    $query_affected_organism = $this->m->port->d->get_where('drug_affected_organism', array('drug_id' => $id));
    if ($query_affected_organism->num_rows() > 0) {
      $affected_organism = $query_affected_organism->result();
    }

    $query_atc_code = $this->m->port->d->get_where('drug_atc_code', array('drug_id' => $id));
    if ($query_atc_code->num_rows() > 0) {
      $atc_code = $query_atc_code->result();
    }

    return array(
      'drug' => $drug, 
      'drug_interaction' => $drug_interaction, 
      'food_interaction' => $food_interaction,
      'synonym' => $synonym,
      'group' => $group,
      'category' => $category,
      'intbrand' => $intbrand,
      'product' => $product,
      'classification' => $classification,
      'affected_organism' => $affected_organism,
      'atc_code' => $atc_code,
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
    $this->m->port->m->insert('medication');

   $insert_id=  $this->m->port->m->insert_id();
	
    if(!empty($_FILES))
	{
	    $this->load->model('document/mdoc');
	
	    if ($result = $this->mdoc->do_upload($insert_params['patient_id']))
	    {
	      if (isset($result->error) && $result->error)
	      {
	          //echo $result->error;die();
	      }
	      else
	      {
	        $doc = $result[0];
	
	        $this->m->db_set('m', array(
	          'medication_id' => $insert_id, 
	          'document_id' => $doc->id, 
	        ), array('id', 'medication_id', 'document_id', ), array(), array());
	
	        $this->m->port->m->insert('medication_files');
	      }
	    }
	}
    return $insert_id;    
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

    $this->m->port->m->db_select();
    $result=$this->m->port->m->update('medication');

    if ($result && isset($id['patient_id']) && isset($id['id']))
    {
      $this->load->model('document/mdoc');

      if ($result = $this->mdoc->do_upload($id['patient_id']))
      {
        if (isset($result->error) && $result->error)
        {

        }
        else
        {
          $doc = $result[0];

          $this->m->db_set('m', array(
            'medication_id' => is_string($id) || is_numeric($id) ? $id : $id['id'], 
            'document_id' => $doc->id, 
          ), array('id', 'medication_id', 'document_id', ), array(), array());

          $this->m->port->m->insert('medication_files');
        }
      }
    }

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
  public function delete($id)
  {
    if (!$this->m->db_where('m', $id))
    {
      return FALSE;
    }

    $this->m->port->m->limit(1);

    $this->m->port->m->db_select();
    return $this->m->port->m->delete('medication');
  }

    public function medication_for_eprescription($act_code,$substance,$id)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('`substance` like "%'.$_ci->aes_encrypt->en($substance).'%"');        
        $_ci->m->port->m->or_where("atc_code",$_ci->aes_encrypt->en($act_code));       
        $return = $_ci->mmedication->get(array('patient_id' => $id), TRUE);
        return $return;
  }

}

/* End of file mmedication.php */
/* Location: ./application/models/medication/mmedication.php */