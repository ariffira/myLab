<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainsite extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Main page for people to understand the site
	 */

	public function __construct(){
		parent :: __construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('common_view');
	}
}

