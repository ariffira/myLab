<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mimmigration extends CI_Model {

  public static $encrypted_fields = array('document_name', 'document_caption', 'document_category');

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

    // Dependencies
    $this->load->model('mgen');
    $this->load->model('document/mdoc');

  }

  public function immigration()
  {
    $query = $this->mgen->dbm->get('diagnoses_files');

    foreach ($query->result() as $row) {
      $document_name = $this->aes_encrypt->de($row->document_name);
      $ext = '';
      $ext_exp = explode('.', $document_name);
      if (($index = count($ext_exp) - 1) > 0) while($ext = !$ext_exp[$index--]);

      $permission = $this->mgen->dbm->get_where('diagnoses', array('id' => $row->record_id), 1);
      $permission = $permission->num_rows() > 0 ? $permission->access_permission : 0;

      $new_id = $this->mdoc->insert(array(
        'patient_id'         => $row->patient_id, 
        'record_id'          => $row->record_id, 
        'document_name'      => $row->document_name, 
        'document_caption'   => $row->document_name, 
        'document_category'  => 'diagnosis', 
        'document_extension' => $ext, 
        'access_permission'  => $permission, 
        'delete_status'      => 0, 
        'cdate'              => TRUE, 
        'mdate'              => TRUE, 
      ));
      
    }
  }

}

/* End of file mimmigration.php */
/* Location: ./application/models/patients/mimmigration.php */