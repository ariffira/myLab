<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();

    $this->load->library('form_validation');
    
  }

  /**
   *
   */
  public function index()
  {

    $url= $this->input->get('url');
    $ci = get_instance(); // CI_Loader instance
    if ($url== "admin") {
      $ci->load->config('admin/navbars');
    }
    elseif ($url== "chatservice") {
      $ci->load->config('chatservice/navbars');
    }

    $sidebar = $ci->config->item('sidebar');


    //$page_data = array(
       //'url' => $url,
    //);

    $page_data['url'] = $url;

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('profile_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function update_profile()
  {

    //$this->load->library('form_validation');

    if ($this->input->post())
    {
      if ($this->mod->update_profile())
      {
        redirect('auth/profile');
      }
      else
      {
        # FAIL
        $alert = validation_errors();
      }
    }
     

  }
  

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */