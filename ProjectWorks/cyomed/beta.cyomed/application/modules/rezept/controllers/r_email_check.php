 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R_email_check extends MX_Controller {

 /*
  * email check message after successful apllication
  */


	public function index(){

		$this->ui->mc->base_init();

	    $this->ui->mc->title->content = '';

	    $this->ui->mc->content->content = $this->load->view('rezept/submission_view', array(), TRUE);

	    $this->output->set_output($this->ui->mc->output());



	}








}