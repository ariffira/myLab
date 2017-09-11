<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_fs extends MX_Controller {

  public function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $this->mod->login_check();
    $this->mod->login_redirect();
    if ($this->mod->user_role() >= 9)
    {
      //$this->index();
    }
    else
    {
      // redirect('auth/login');
      show_error('Access denied.');
    }
  }

  /**
   *
   */
  public function index()
  {
    $this->page();
  }

  /**
   *
   */
  public function page()
  {

    $lines = $this->modlang->from_file_system();

    $page_data = array(
      'lines' => $lines,
      'lang_driver' => 'fs',
    );

    // var_dump($lines);

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('language_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function to_db()
  {
    $this->modlang->from_file_system();
    $this->modlang->file_system_to_db();
    $this->page();
  }

  /**
   *
   */
  public function excel()
  {
    $lines = $this->modlang->from_file_system();
    $this->modlang->to_excel($lines, 'language_fs.xls');
  }

  /**
   *
   */
  public function line($key = NULL)
  {
    $key = empty($key) ? $this->input->get('key') : $key;

    $key = empty($key) ? $this->input->post('key') : $key;

    if (empty($key))
    {
      $this->page();
      return;
    }

    $lines = $this->modlang->from_file_system();

    if (!empty($lines[$key]))
    {
      $line = $lines[$key];
    }
    else
    {
      $this->page();
      return;
    }

    $page_data = array(
      'key' => $key, 
      'line' => $line, 
      'lines' => $lines, 
      'lang_driver' => 'fs',
    );

    // var_dump($lines);

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('language_line_edit_view', $page_data, TRUE);

    output_ajax($page_content);
  }

  /**
   *
   */
  public function line_update($key = NULL)
  {
    $key = empty($key) ? $this->input->get_post('orig_key') : $key;

    $key = empty($key) ? $this->input->get('key') : $key;

    $key = empty($key) ? $this->input->post('key') : $key;

    if (empty($key))
    {
      $this->page();
      return;
    }

    $lines = $this->modlang->from_file_system();

    if (!empty($lines[$key]))
    {
      $line = $lines[$key];
    }
    else
    {
      $this->page();
      return;
    }

    $page_data = array(
      'key' => $key, 
      'line' => $line, 
      'lines' => $lines, 
      'lang_driver' => 'fs',
    );

    var_dump($this->input->post());
  }

  /**
   *
   */
  public function add($post = NULL)
  {
    $lines = $this->modlang->from_database();

    $page_data = array(
      'lines' => $lines, 
      'lang_driver' => 'db', 
    );

    // var_dump($lines);

    if (isset($error) && $error)
    {
      $page_data['error'] = $error;
    }

    $page_content = $this->load->view('language_line_edit_view', $page_data, TRUE);

    output_ajax($page_content);
  }

}

/* End of file language_fs.php */
/* Location: ./application/modules/tranlsate/controllers/language_fs.php */