 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R_summary extends MX_Controller {


	public function index($id=NULL){
	    static $_ci;

	    if (empty($_ci)) $_ci =& get_instance();
	  
	    $_ci->load->model('rezept/m_answers');

		$this->ui->mc->base_init();
		
		if ($this->m->user_role() == M::ROLE_DOCTOR){
			
//			$id = $this->session->userdata('selectedid');
			$this->ui->mc->title->content = 'Rezept/Ausgewählte Patient';
		}

		elseif ($this->m->user_role() == M::ROLE_PATIENT){
//				if($this->session->userdata('selectedid')){
//					$id = $this->session->userdata('selectedid');
//					$this->session->unset_userdata('selectedid');
//				}
//					
//				else
//					$id = $this->session->userdata('epresid');
	    		$this->ui->mc->title->content = 'Zusammenfassung';			
		}

	    $everything = $_ci->m_answers->get_everything($id);
//            print_r($everything);die;

	    $this->ui->mc->content->content = $this->load->view('rezept/summary_view', $everything , TRUE);

	    $this->output->set_output($this->ui->mc->output());

	}




}