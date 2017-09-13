<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Office extends MX_Controller
{
    /**
     * [index description].
     * 
     * @return [type] [description]
     */
    public function index()
    {
        echo Modules::run('auth');
    }
}

/* End of file cyomed.php */
/* Location: ./application/controllers/cyomed.php */
