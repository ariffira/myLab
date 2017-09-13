<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cyomed extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    echo Modules::run('akte');

   //  $func = function($para)
   //  {
   //  	echo $para;
   //  };

  	// return call_user_func_array($func, array('para' => 'stuff', ));
  }


}

/* End of file cyomed.php */
/* Location: ./application/controllers/cyomed.php */