<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdfget extends CI_Controller {

  /**
   *
   */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function index()
  {

  }

  public function summary_pdf($rezeptid=0){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    if($rezeptid!="" && $rezeptid)
      $id = $rezeptid;
    else{
        return false;
    }
    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    //$style2 = 'assets\mvpr110\css\bootstrap.min.css';
    $stylesheet = file_get_contents( $style);

    $_ci->load->model('rezept/m_answers');
//    if($rezeptid==0)
//      $id = $this->session->userdata('epresid');
//    else
    
    $everything = $_ci->m_answers->get_everything($id);
    $content = $this->load->view('rezept/pdf_summary_view', $everything , TRUE);

    $pdf->WriteHTML($stylesheet,1);
    $pdf->WriteHTML($content,2);
    $pdf->Output('Rezept.pdf','D');
    exit;

  }

  
  

  /**
   *
   */
  

}

/* End of file pdfget.php */
/* Location: ./application/modules/rezept/controllers/pdfget.php */