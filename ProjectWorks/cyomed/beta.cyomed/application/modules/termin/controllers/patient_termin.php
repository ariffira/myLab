<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient_termin extends MX_Controller {

  /**
   *
   */
  public function index()
  {
   //from old one...
  $speciality = $this->speciality->get()->result();
  


   /* $post_data  = $this->input->get();

   if ($this->input->get('form') && ($spec_id = $this->input->get('form')['medical_specialty_id'])) {
      foreach ($speciality as $row) {
        if ($row->code == $spec_id) {
          $post_data['form']['medical_specialty'] = $row->name;
           break;
        }
      }
     }

   
   $post_data['form']['location'] = isset($post_data['form']) && isset($post_data['form']['location']) ? $post_data['form']['location'] : '';

   $oqs = $this->input->server('QUERY_STRING'); 

     $s = $this->input->get('s');
     $n = $this->input->get('n');

     $s = $s ? $s : 0;
     $n = $n ? $n : 10;

     // DOC LIMIT

   $this->m->port->p->db_select();
   $this->m->port->p->limit($n, $s);

   $this->m->port->p->where('display_on_at_search_result !=', 0);
   $doctors = $this->modoc->get_all();
   $i = 1;
   foreach ($doctors as $key => $row) {
       $doctors[$key]->marker_num = $s + $i++;
     }


     $this->m->port->p->where('display_on_at_search_result !=', 0);
     $doctors_all = $this->modoc->get_all();

     $this->load->library('pagination');

     $config['base_url'] = site_url('termin').'?'.$oqs.($oqs ? '&' : '');
     $this->m->port->p->db_select();
     $config['total_rows'] = count($doctors_all);
     $config['per_page'] = 10; 
     $config['page_query_string'] = TRUE;
     $config['query_string_segment'] = 's';

     $this->pagination->initialize($config); 
     $pagination = $this->pagination->create_links();
*/
     $doctors = array();
     $post_data = array();
     $page_data = array(
       'speciality' => $speciality,
       'doctors' => $doctors,
       'pagination' => $pagination,
       'post_data' => json_encode($post_data), 
     );

   //end off old code

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('termin_search',  $this->m->user_value('language'));
   
  	$this->ui->mc->base_init();

    $this->ui->mc->title->content = 'Termin';

    if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('termin/termin_view', $page_data, TRUE);
        }
    else{

      $this->ui->mc->content->content = $this->load->view('termin/termin_view', $page_data, TRUE); 

    }

     $this->output->set_output($this->ui->mc->output());
    
  }

  /**
   *
   */


}
/* End of file patient_termin.php */
/* Location: ./application/modules/termin/controllers/rezept_list.php */