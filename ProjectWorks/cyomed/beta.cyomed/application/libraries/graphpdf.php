<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class graphpdf {
    
    function graphpdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        //include APPPATH.'third_party/phpgraphlib/phpgraphlib.php';
        include_once APPPATH.'third_party/phpgraphlib/phpgraphlib.php';
         
        if ($params == NULL)
        {
            $param = '650,200';         
        }
         
        return new PHPGraphLib($param);
    }
}