<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Runtastic extends MX_Controller {

  public function index()
  {
      static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    //loading languages
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('patients/vaccination_card', $this->m->user_value('language'));
    
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = $this->lang->line('pwidget_diagnosis_diagnosis');

    $this->m->role_diff(
      function() use ($_ci){
        if (!$_ci->m->us_id())
        {
          $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
          return;
        }
        
        $_ci->load->model('vaccination/mvaccination');
        $this->ui->mc->content->content = $_ci->load->view('vaccination/vaccination_view', array(
          'entries' => $_ci->mvaccination->get_all(),
        ), TRUE);
      },
      function() use ($_ci){
        $_ci->load->model('vaccination/mvaccination');
        $this->ui->mc->content->content = $_ci->load->view('vaccination/vaccination_view', array(
          'entries' => $_ci->mvaccination->get_all(),
        ), TRUE);
      }
    );

    $this->output->set_output($this->ui->mc->output());

  }
  /**
   *
   */
  public function insert()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    echo $result = $this->m->role_diff(
      function() use ($_ci){
        $_ci->load->model('vaccination/mvaccination');

        $insert_data = array(
          'patient_id'         => $_ci->m->us_id(), 
          'access_permission'  => $_ci->m->us_access(),  
          'Handelsname'        => $_ci->input->post('Handelsname'), 
          'vaccination'        => $_ci->input->post('vaccination'),
          'Praxis'             => $_ci->input->post('Praxis'),
          'Datei_name'         => $_ci->input->post('Datei_name'),
          'Datei'              => $_ci->input->post('Datei'),

          'Tetanus'            => $_ci->input->post('Tetanus') ? $_ci->input->post('Tetanus') : 0, 
          'Diphtherie'         => $_ci->input->post('Diphtherie') ? $_ci->input->post('Diphtherie') : 0,
          'Perstussis'         => $_ci->input->post('Perstussis') ? $_ci->input->post('Perstussis') : 0,
          'Poliomyeltis'       => $_ci->input->post('Poliomyeltis') ? $_ci->input->post('Poliomyeltis') : 0,
          'HepatitisA'         => $_ci->input->post('HepatitisA') ? $_ci->input->post('HepatitisA') : 0,
          'HepatitisB'         => $_ci->input->post('HepatitisB') ? $_ci->input->post('HepatitisB') : 0,
          'MMR'                => $_ci->input->post('MMR') ? $_ci->input->post('MMR') : 0,
          'Varizellen'         => $_ci->input->post('Varizellen') ? $_ci->input->post('Varizellen') : 0,
          'Meningokokken'      => $_ci->input->post('Meningokokken') ? $_ci->input->post('Meningokokken') : 0,
          'Pneumokokken'       => $_ci->input->post('Pneumokokken') ? $_ci->input->post('Pneumokokken') : 0,
          'Rotavirus'          => $_ci->input->post('Rotavirus') ? $_ci->input->post('Rotavirus') : 0,
          'Influenza'          => $_ci->input->post('Influenza') ? $_ci->input->post('Influenza') : 0,
          'Pertussis'          => $_ci->input->post('Pertussis') ? $_ci->input->post('Pertussis') : 0,
          'Cholera'            => $_ci->input->post('Cholera') ? $_ci->input->post('Cholera') : 0,
          'FSME'               => $_ci->input->post('FSME') ? $_ci->input->post('FSME') : 0,
          'HepatatisA'         => $_ci->input->post('HepatatisA') ? $_ci->input->post('HepatatisA') : 0,
          'HPV'                => $_ci->input->post('HPV') ? $_ci->input->post('HPV') : 0,
          'JapanischeEnzephalitis' => $_ci->input->post('JapanischeEnzephalitis') ? $_ci->input->post('JapanischeEnzephalitis') : 0,
          'Tollwut'            => $_ci->input->post('Tollwut') ? $_ci->input->post('Tollwut') : 0,
          'Typhus'             => $_ci->input->post('Typhus')? $_ci->input->post('Typhus') : 0,
          'Gelbfieber'         => $_ci->input->post('Gelbfieber')? $_ci->input->post('Gelbfieber') : 0,
          'Zoster'             => $_ci->input->post('Zoster') ? $_ci->input->post('Zoster') : 0,
          'FreierImpfeintrag1' => $_ci->input->post('FreierImpfeintrag1') ? $_ci->input->post('FreierImpfeintrag1') : 0,
          'FreierImpfeintrag2' => $_ci->input->post('FreierImpfeintrag2') ? $_ci->input->post('FreierImpfeintrag2') : 0,
          'FreierImpfeintrag3' => $_ci->input->post('FreierImpfeintrag3') ? $_ci->input->post('FreierImpfeintrag3') : 0,
          'FreierImpfeintrag4' => $_ci->input->post('FreierImpfeintrag4') ? $_ci->input->post('FreierImpfeintrag4') : 0,
          'document_date'      => date('Y-m-d', strtotime($_ci->input->post('document_date'))),
          'date'               => date('Y-m-d', strtotime($_ci->input->post('date'))),
          'date_added'         => TRUE,
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),
        );
        
        $symptoms = $_ci->input->post('symptoms');
        if ($symptoms && is_array($symptoms))
        {
          foreach (array('Tetanus', 'Diphtherie', 'Perstussis', 'Poliomyeltis', 'HepatitisA', 'HepatitisB', 'MMR', 'Varizellen', 'Meningokokken', 'Pneumokokken', 'Rotavirus', 'Influenza', 'Pertussis', 'Cholera', 'FSME', 'HepatatisA', 'HPV', 'JapanischeEnzephalitis', 'Tollwut', 'Typhus', 'Gelbfieber', 'Zoster', 'FreierImpfeintrag1', 'FreierImpfeintrag2', 'FreierImpfeintrag3', 'FreierImpfeintrag4', ) as $field)
          {
            if (in_array($field, $symptoms))
            {
              $insert_data[$field] = 1;
            }
            else
            {
              $insert_data[$field] = 0;
            }
          }
        }

        return $_ci->mvaccination->insert($insert_data);
      },
      function() use ($_ci){
        $_ci->load->model('vaccination/mvaccination');

        $insert_data = array(
          'patient_id'         => $_ci->m->user_id(), 
          'access_permission'   => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0,   
          'Handelsname'        => $_ci->input->post('Handelsname'), 
          'vaccination'        => $_ci->input->post('vaccination'),
          'Praxis'             => $_ci->input->post('Praxis'),
          'Datei_name'         => $_ci->input->post('Datei_name'),
          'Datei'              => $_ci->input->post('Datei'),
          'Tetanus'            => $_ci->input->post('Tetanus') , 
          'Diphtherie'         => $_ci->input->post('Diphtherie') ? $_ci->input->post('Diphtherie') : 0,
          'Perstussis'         => $_ci->input->post('Perstussis') ? $_ci->input->post('Perstussis') : 0,
          'Poliomyeltis'       => $_ci->input->post('Poliomyeltis') ? $_ci->input->post('Poliomyeltis') : 0,
          'HepatitisA'         => $_ci->input->post('HepatitisA') ? $_ci->input->post('HepatitisA') : 0,
          'HepatitisB'         => $_ci->input->post('HepatitisB') ? $_ci->input->post('HepatitisB') : 0,
          'MMR'                => $_ci->input->post('MMR') ? $_ci->input->post('MMR') : 0,
          'Varizellen'         => $_ci->input->post('Varizellen') ? $_ci->input->post('Varizellen') : 0,
          'Meningokokken'      => $_ci->input->post('Meningokokken') ? $_ci->input->post('Meningokokken') : 0,
          'Pneumokokken'       => $_ci->input->post('Pneumokokken') ? $_ci->input->post('Pneumokokken') : 0,
          'Rotavirus'          => $_ci->input->post('Rotavirus') ? $_ci->input->post('Rotavirus') : 0,
          'Influenza'          => $_ci->input->post('Influenza') ? $_ci->input->post('Influenza') : 0,
          'Pertussis'          => $_ci->input->post('Pertussis') ? $_ci->input->post('Pertussis') : 0,
          'Cholera'            => $_ci->input->post('Cholera') ? $_ci->input->post('Cholera') : 0,
          'FSME'               => $_ci->input->post('FSME') ? $_ci->input->post('FSME') : 0,
          'HepatatisA'         => $_ci->input->post('HepatatisA') ? $_ci->input->post('HepatatisA') : 0,
          'HPV'                => $_ci->input->post('HPV') ? $_ci->input->post('HPV') : 0,
          'JapanischeEnzephalitis' => $_ci->input->post('JapanischeEnzephalitis') ? $_ci->input->post('JapanischeEnzephalitis') : 0,
          'Tollwut'            => $_ci->input->post('Tollwut') ? $_ci->input->post('Tollwut') : 0,
          'Typhus'             => $_ci->input->post('Typhus')? $_ci->input->post('Typhus') : 0,
          'Gelbfieber'         => $_ci->input->post('Gelbfieber')? $_ci->input->post('Gelbfieber') : 0,
          'Zoster'             => $_ci->input->post('Zoster') ? $_ci->input->post('Zoster') : 0,
          'FreierImpfeintrag1' => $_ci->input->post('FreierImpfeintrag1') ? $_ci->input->post('FreierImpfeintrag1') : 0,
          'FreierImpfeintrag2' => $_ci->input->post('FreierImpfeintrag2') ? $_ci->input->post('FreierImpfeintrag2') : 0,
          'FreierImpfeintrag3' => $_ci->input->post('FreierImpfeintrag3') ? $_ci->input->post('FreierImpfeintrag3') : 0,
          'FreierImpfeintrag4' => $_ci->input->post('FreierImpfeintrag4') ? $_ci->input->post('FreierImpfeintrag4') : 0,
          'document_date'      => date('Y-m-d', strtotime($_ci->input->post('document_date'))),
          'date'               => date('Y-m-d', strtotime($_ci->input->post('date'))),
          'date_added'         => TRUE,
          'added_by'          => $_ci->m->user_id(),
          'user_role'         => $_ci->m->user_role(),
      );
        
        $symptoms = $_ci->input->post('symptoms');
        if ($symptoms && is_array($symptoms))
        {
          foreach (array('Tetanus', 'Diphtherie', 'Perstussis', 'Poliomyeltis', 'HepatitisA', 'HepatitisB', 'MMR', 'Varizellen', 'Meningokokken', 'Pneumokokken', 'Rotavirus', 'Influenza', 'Pertussis', 'Cholera', 'FSME', 'HepatatisA', 'HPV', 'JapanischeEnzephalitis', 'Tollwut', 'Typhus', 'Gelbfieber', 'Zoster', 'FreierImpfeintrag1', 'FreierImpfeintrag2', 'FreierImpfeintrag3', 'FreierImpfeintrag4', ) as $field)
          {
            if (in_array($field, $symptoms))
            {
              $insert_data[$field] = 1;
            }
            else
            {
              $insert_data[$field] = 0;
            }
          }
        }

        return $_ci->mvaccination->insert($insert_data);
      }
    );

    ajax_redirect('akte/vaccination');
  }


}

/* End of file vaccination.php */
/* Location: ./application/modules/akte/controllers/vaccination.php */