<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
  }

  public function index()
  {
    $this->_page();
  }
  
  /**
   *
  */
  public function _page($page_content = '')
  {
    $this->load->config('navbars');

    switch ($this->mod->user_role()) {
      case 9:
        $sidebar = $this->config->item('sidebar_'.$this->mod->user_role());
        break;

      case 2:
        $sidebar = $this->config->item('sidebar_'.$this->mod->user_role());
        break;

      case 1:
        $sidebar = $this->config->item('sidebar_'.$this->mod->user_role());
        break;
      
      default:
        $sidebar = array();
        break;
    }

    $data = array(
      'page_class' => '',
      'page_stylesheets' => array(), 
      'page_content' => '', 

      // 'active_url' => 'auth/dashboard',

      'sidebar' => $sidebar,
      'error' => !empty($error) ? $error : NULL, 

      'jumbotron' => (object)array(
      'title' => ucfirst(basename(__FILE__, '.php')),
      ), 
    );

    if (is_array($page_content))
    {
      $data = array_merge($data, $page_content);
    }
    else
    {
      $data['page_content'] = $page_content;
    }

    if (empty($page_content))
    {
      $data['active_url'] = 'auth/dashboard';
    }

    $data['data_array'] = $data;

    $this->load->view('page', $data);
  }

  
}
