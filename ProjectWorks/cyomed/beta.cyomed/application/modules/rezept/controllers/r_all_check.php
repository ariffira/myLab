 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R_all_check extends MX_Controller {

 /*
  * Give the patients credentials after giving all answers and after viewing the summary page
  */
        public function index($id=null)
        {

        $this->load->language('eprescription/epres',$this->m->user_value('language'));
        
	    $this->ui->mc->base_init();

	    $this->ui->mc->title->content = '';

	    $this->ui->mc->content->content = $this->load->view('rezept/final_view', array('epres_id'=>$id), TRUE);
	    
	    $this->output->set_output($this->ui->mc->output());
        }

}