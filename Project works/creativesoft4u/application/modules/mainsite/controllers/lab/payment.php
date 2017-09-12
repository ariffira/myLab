<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Payment module test file
	 */

	public function __construct(){
		parent :: __construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('lab/payment_mod_view');
	}
}

