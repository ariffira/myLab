<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    
    //echo "string";
    $this->general();

  }


  


  public function general()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
 

    $result = $this->m->role_diff(
      function() use ($_ci){
        //if (empty($id)) return FALSE;

        $this->load->model('videochat/mvideochat'); 
        $me = $_ci->m->user_value('regid');
        $callid = $_ci->mvideochat->get_valid_id($me);
        return $callid;

        //if ($callid != 0) {
          //return $callid;
        //}
        //else{
          //return 0;
        //}
  
        
      },

      function() use ($_ci){
        //if (empty($id)) return FALSE;

        $this->load->model('videochat/mvideochat'); 
        $me = $_ci->m->user_value('regid');
        $callid = $_ci->mvideochat->get_valid_id($me);
        return $callid;

        
      }
    );
      

    echo json_encode(array('id' => $result,));
     
    
  }



}

/* End of file videochat.php */
/* Location: ./application/modules/akte/controllers/videochat.php */