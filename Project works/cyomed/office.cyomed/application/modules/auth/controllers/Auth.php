<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->mod->login_check();
		$this->mod->login_redirect();

		$c = $this->load->module('auth/page')->page->index();
	}

	/**
   *
   */
	public function login()
	{

		if ($this->input->post('email') && $this->input->post('password') && $this->form_validation->run('auth/login'))
		{
			if ($this->mod->login($this->input->post('email'), $this->input->post('password')))
			{

				$role = $this->encrypt->decode($this->mod->user_role());
				if ($role == 9)
				{
					redirect(base_url());
					return;
				}
				elseif ($role == 2)
				{
					redirect(base_url());
					return;
				}

				//redirect('admin/dashboard');
				//return;

			}
			else
			{
				if ($this->mod->last_error())
				{
					if ($this->mod->last_error() == Mod::ERROR_EMAIL)
					{
						$error = 'Invalid email';
					}
					if ($this->mod->last_error() == Mod::ERROR_PASSWORD)
					{
						$error = 'Invalid password';
					}
				}
			}
		}
		else
		{
			$error = validation_errors();
		}

		$sidebar = $this->config->item('sidebar');

		$page_data = array(
      		// 'data' => $data,
		);

		if (isset($error) && $error)
		{
			$page_data['error'] = $error;
		}

		$page_content = $this->load->view('login_view', $page_data, TRUE);

		$output_data = array(
			'page_class' => 'login-page',
			'page_stylesheets' => array(), 
			'page_content' => $page_content, 

			// 'sidebar' => $sidebar,

			// 'active_1' => TRUE,
			// 'active_2' => TRUE,
			// 'active_3' => TRUE,
			// 'active_4' => TRUE,
			// 'active_5' => TRUE,
			// 'jumbotron' => TRUE, 
			'hide_topnav' => TRUE, 
			);

		$this->load->view('page_html', $output_data);

	}

	/**
	 *
	*/

	public function logout()
	{
		$this->mod->logout();
		redirect('auth/login');
	}
	

}
