<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Term extends CI_Controller {

  /**
   *
   */
  public function index()
  {

  }

  /**
   *
   */
  public function output($term_name = NULL, $term_id = NULL, $print = FALSE)
  {
    if ($term_name === NULL || $term_id === NULL)
    {
      exit('NULL');
    }

    if (!is_string($term_name) || !is_numeric($term_id))
    {
      exit('TYPE');
    }

    $term = $this->moterm->get_id($term_id);

    if ($term->name != $term_name)
    {
      exit('MISMATCH');
    }

    $this->moterm->modal_attr($term->id);

    $page_content = '
      <div class="row">
        <div class="col-md-12">
          '.($print ? $this->moterm->modal_output(TRUE, TRUE) : $this->moterm->modal_output(TRUE)).'
        </div>
      </div>';

    $output_data = array(
      'page_stylesheets' => array(), 
      'page_content' => $page_content, 
    );

    if (isset($alert) && $alert) $output_data['alert'] = $alert;

    $this->load->view('struct_clean_view', $output_data);

  }

}

/* End of file term.php */
/* Location: ./application/controllers/term.php */