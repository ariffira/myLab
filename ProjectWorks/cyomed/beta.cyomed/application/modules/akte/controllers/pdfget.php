<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdfget extends MX_Controller {
const TABLE_HEART_FREQUENCY = 'heart_frequency';
  const TABLE_BLOOD_SUGAR     = 'blood_sugar';
  const TABLE_WEIGHT_BMI      = 'weight_bmi';
  const TABLE_MARCUMAR        = 'marcumar';
  const ERROR_NO_DOCTOR = 'error_no_doctor';
  const ERROR_NO_PATIENT = 'error_no_patient';
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

  
    public function condition()
  {
     //language loads....
    $this->lang->load('patients/home', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);
    $patient = array();

    $_ci->load->model('medical_condition/mmedical_condition');

    if ($this->m->user_role() === M::ROLE_PATIENT)
    {
        $condition = $_ci->mmedical_condition->get_all();
    }

    else if ($this->m->user_role() === M::ROLE_DOCTOR)
    {
      if ($_ci->m->us_id()){
        $condition = $_ci->mmedical_condition->get_all();
        $patient = $this->mopat->get_id($_ci->m->us_id());
      }
      else
        return FALSE;
    }


    foreach ($condition as $row)
    {

      $content = $this->load->view('pdf/medical_condition_pdf_view', array('mcond' => $row,'patient' => $patient,), TRUE); 
      $pdf->WriteHTML($stylesheet,1); 
      $pdf->WriteHTML($content,2);
    }

    $pdf->Output('Condition.pdf', 'D'); 
    exit;
  }
/***start from here***/
   public function getprofiledetail($patient_id,$time = NULL,$limit = 15)
  {
     
    //language loads....
    $this->lang->load('patients/home', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);
      if ($time === NULL)
    {
      $time = time();
    }
    if (!is_numeric($time))
    {
      if (strtotime($time) !== FALSE)
      {
        $time = strtotime($time);
      }
      else
      {
        $time = time();
      }
    }
    if (!is_numeric($limit))
    {
      $limit = 15;
    }
    $this->ui->feed_item->base_init();
    //$patient_id=12;
    $v_users=$_ci->modoc->get_patientdetail($patient_id);
    $patient_id=$v_users[0]->id;
                              $this->m->port->p->db_select();
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('patient_id' => $patient_id, 'doctor_inserted_id' => $_ci->m->user_id(),), 1);
                            if ($accessibility->num_rows() > 0) {
                               $access_permission = 1;
                            } else {
                                $access_permission = 2;
                            }
                            
    $this->load->model('medical_condition/mmedical_condition');
    $this->load->model('diagnosis/mdiagnosis');
    $this->load->model('medication/mmedication');
    $this->load->model('vaccination/mvaccination');
    $this->load->model('casehistory/mcasehistory');
    $this->load->model('graph/mgraph');
        
    #Here's for conditions
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('document_time <=', date('H:i', $time));
    $this->m->port->m->where('access_permission >=', $access_permission);
    $this->m->port->m->order_by('document_date', 'desc');
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $conditions = array_map(function($v) {
          return ($v->feed_type = 'condition') ? $v : $v;
        },$this->mmedical_condition->get(array('patient_id' =>$patient_id, ), TRUE));

        
    # Here's for diagnosis
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('access_permission >=', $access_permission);
    $this->m->port->m->order_by('document_date', 'desc');
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $diagnosis = array_map(function($v) {
    return ($v->feed_type = 'diagnosis') ? $v : $v;
        }, $this->mdiagnosis->get(array('patient_id' =>$patient_id, ), TRUE));


        # Here's for medication
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('access_permission >=', $access_permission);
    $this->m->port->m->order_by('document_date', 'desc');
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $medication = array_map(function($v) {
          return ($v->feed_type = 'medication') ? $v : $v;
        }, $this->mmedication->get(array('patient_id' => $patient_id,), TRUE));

        
        # Here's vaccination
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('access_permission >=', $access_permission);
    $this->m->port->m->order_by('document_date', 'desc');
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $vaccination = array_map(function($v) {
          return ($v->feed_type = 'vaccination') ? $v : $v;
        }, $this->mvaccination->get(array('patient_id' => $patient_id,), TRUE));



        # Here's case history

        $this->m->port->m->db_select();
        $this->m->port->m->order_by('date_added', 'desc');
        $this->m->port->m->order_by('id', 'desc');
        $this->m->port->m->limit($limit);

        $casehistory = array_map(function($v) {
            $v->feed_type = 'casehistory';
            $v->document_date = date('Y-m-d', strtotime($v->date_added));
            
          return ($v->feed_type && $v->document_date) ? $v : $v;

        }, $this->mcasehistory->get(array('patient_id' => $patient_id,'doctor_id' => $_ci->m->user_id())));
        
        
        # Here's for blood_pressure
       $this->m->port->m->db_select();
//       $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
//       $this->m->port->m->where('rec_time <=', date('H:i', $time));
       $this->m->port->m->order_by('id', 'desc');
       $this->m->port->m->limit($limit);
       $graph_entries = $this->mgraph->get_table(self::TABLE_HEART_FREQUENCY, array('patient_id' => $patient_id,'access_permission >=' => $access_permission), TRUE);
       $blood_pressure = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_pressure',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();
 
        # Here's for blood_sugar
       $this->m->port->m->db_select();
//       $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
//       $this->m->port->m->where('rec_time <=', date('H:i', $time));
       $this->m->port->m->order_by('id', 'desc');
       $this->m->port->m->limit($limit);
       $graph_entries = $this->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $patient_id,'access_permission >=' => $access_permission), TRUE);
       $blood_sugar = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_sugar',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for weight_bmi
    $this->m->port->m->db_select();
//    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
//    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $patient_id,'access_permission >=' => $access_permission), TRUE);
    $weight_bmi = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'weight_bmi',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();
    # Here's for marcumar
    $this->m->port->m->db_select();
//    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
//    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->order_by('id', 'desc');
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $patient_id,'access_permission >=' => $access_permission), TRUE);
    $marcumar = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'marcumar',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();
   
    $entries = array();
    $entries = array_merge($entries, $conditions);
    $entries = array_merge($entries, $diagnosis);
    $entries = array_merge($entries, $medication);
    $entries = array_merge($entries, $vaccination);
    $entries = array_merge($entries, $casehistory);
    $entries = array_merge($entries, $blood_pressure);
    $entries = array_merge($entries, $blood_sugar);
    $entries = array_merge($entries, $weight_bmi);
    $entries = array_merge($entries, $marcumar);
    $output = $this->load->view('pdf/pmedical_pdf_view', array(
            'entries' => $entries,
            'diagnosis' => $diagnosis,
            'medication'=>$medication,
            'vaccination'=>$vaccination,
            'casehistory'=>$casehistory,
            'conditions'=>$conditions,
            'blood_pressure'=>$blood_pressure,
            'blood_sugar'=>$blood_sugar,
            'weight_bmi'=>$weight_bmi,
            'marcumar'=>$marcumar,
            'pdfcheck'=>true,
            'v_usrs'=>$v_users,
    ),TRUE);
    $content = $output;
    $pdf->WriteHTML($stylesheet,1); 
    $pdf->WriteHTML($content,2);
    $pdf->Output('Patientprofile.pdf', 'D'); 
    exit;
  }
/***end here***/
  
  public function medication()
  {
     //language loads....
    $this->lang->load('pwidgets/medication', $this->m->user_value('language'));
    $this->lang->load('patients/home', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);
    $patient = array();

    $_ci->load->model('medication/mmedication');

    if ($this->m->user_role() === M::ROLE_PATIENT)
    {
        $medication = $_ci->mmedication->get_all();
    }

    else if ($this->m->user_role() === M::ROLE_DOCTOR)
    {
      if ($_ci->m->us_id()){
        $medication = $_ci->mmedication->get_all();
        $patient = $this->mopat->get_id($_ci->m->us_id());
      }
      else
        return FALSE;
    }

    foreach ($medication as $row)
    {
      $content = $this->load->view('pdf/medication_pdf_view', array('medication' => $row,'patient'=>$patient,), TRUE); 
      $pdf->WriteHTML($stylesheet,1); 
      $pdf->WriteHTML($content,2);
    }

     $pdf->Output('Medication.pdf', 'D'); 
     exit;
  }

  public function diagnosis($type)
  {
    
    //language loads....
    $this->lang->load('pwidgets/diagnosis', $this->m->user_value('language'));
    $this->lang->load('patients/home', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 

    //pdf library loads.......
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);
    $patient = array();

    $_ci->load->model('diagnosis/mdiagnosis');

    if ($this->m->user_role() === M::ROLE_PATIENT)
    {
        $category = $_ci->mdiagnosis->get_all();
    }

    else if ($this->m->user_role() === M::ROLE_DOCTOR)
    {
      if ($_ci->m->us_id()){

        $category = $_ci->mdiagnosis->get_all();
        $patient = $this->mopat->get_id($_ci->m->us_id());
      }
      else
        return FALSE;
    }

    $diagnosis_result = array();
    if($type=='emergency' || $type == 'all')
      $diagnosis_result['emergency'] = $category->emergency;
    
    if($type=='confirmed' || $type == 'all')
      $diagnosis_result['confirmed'] = $category->confirmed;
    
    if($type=='unconfirmed' || $type == 'all')
      $diagnosis_result['unconfirmed'] = $category->unconfirmed;

    if($type=='travel' || $type == 'all')
      $diagnosis_result['travel'] = $category->travel;

    if($type=='allergy' || $type == 'all')
      $diagnosis_result['allergy'] = $category->allergy;

    if($type=='archived' || $type == 'all')
      $diagnosis_result['archived'] = $category->archived;

    $content = $this->load->view('pdf/diagnosis_pdf_view', array('diagnosis' => $diagnosis_result,'patient'=>$patient,), TRUE);

    $pdf->WriteHTML($stylesheet,1); 
    $pdf->WriteHTML($content,2);
    
    $pdf->Output($type!='all'?ucwords($type).' Diagnosis.pdf':'Diagnosis.pdf', 'D'); 
    exit;

  }

  public function vaccination()
  {
    //language loads....
    $this->lang->load('patients/vaccination_card', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 


    //pdf library loads.......
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);

    $patient = array();

    $_ci->load->model('vaccination/mvaccination');

    if ($this->m->user_role() === M::ROLE_PATIENT)
    {
        $vaccination = $_ci->mvaccination->get_all();
    }

    else if ($this->m->user_role() === M::ROLE_DOCTOR)
    {
      if ($_ci->m->us_id()){

        $vaccination = $_ci->mvaccination->get_all();
        $patient = $this->mopat->get_id($_ci->m->us_id());
      }
      else
        return FALSE;
    }

    foreach ($vaccination as $row)
    {

      $content = $this->load->view('pdf/vaccination_pdf_view', array('vaccination' => $row,'patient' => $patient,), TRUE); 
      $pdf->WriteHTML($stylesheet,1); 
      $pdf->WriteHTML($content,2);
    }

    $pdf->Output('Vaccination.pdf', 'D'); 
    exit;
  }


  public function my_doctors()
  {
    $this->load->driver('Pwidget');

    $this->pwidget->pdf->as_patient();

    $this->pwidget->pdf->my_doctors_pdf();

  }
 

  public function iconsult($type)
  {
    //language loads....
    $this->lang->load('patients/iconsult', $this->m->user_value('language'));
    $this->lang->load('patients/all_access', $this->m->user_value('language')); 
    $this->lang->load('global/general_text', $this->m->user_value('language')); 

    //pdf library loads.......
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);
    $patient = array();
//    $alldoctor=false;
    $_ci->load->model('iconsult/miconsult');

    if ($this->m->user_role() === M::ROLE_PATIENT)
    {
        $category = $_ci->miconsult->get_all();
        $patient = $this->mopat->get_id($_ci->m->user_id());
    }
    else if ($this->m->user_role() === M::ROLE_DOCTOR)
    { 
        if($type=='alldoctor' || $type=='closeddoctor' || $type=='openeddoctor'){
          $category=  $_ci->miconsult->get_pdf_econsult();
//          $alldoctor=true;
        }
        else if($_ci->m->us_id()){
        $category = $_ci->miconsult->get_all();
        $patient = $this->mopat->get_id($_ci->m->us_id());
      }
      else
        return FALSE;
//      echo "<pre>";print_r($category);die;
    }
//    echo "<pre>";echo count($category);print_R($category);die;
//    if($alldoctor){        
//    $iconsult_result = array();
//    foreach()
//    if($type == 'alldoctor')
//      $iconsult_result['all'] = $category->all;
//    
//    elseif($type == 'openeddoctor')
//      $iconsult_result['opened'] = $category->opened;
//    
//    elseif($type == 'closeddoctor')
//      $iconsult_result['closed'] = $category->closed;
//
//    $iconsult_result['patient'] = $patient;
//    print_r($patient);die;
//    $content.= $this->load->view('pdf/iconsult_pdf_view', $iconsult_result, TRUE);
//    }
//    else{
    $category=(array)$category;
     $iconsult_result = array();
//    echo "<pre>";echo count($category);print_R($category);die;
     $content='';
        if(isset($category['all']) && count($category['all'])>0 && count($category)>0 && !empty($category) && is_array($category)){            
    if($type == 'all')
      $iconsult_result['all'] = $category['all'];
    
    elseif($type == 'opened')
      $iconsult_result['opened'] = $category['opened'];
    
    elseif($type == 'closed')
      $iconsult_result['closed'] = $category['closed'];
    
     $iconsult_result['patient'] = $patient;
         $content = $this->load->view('pdf/iconsult_pdf_view', $iconsult_result, TRUE);
         $content= $this->load->view('pdf/iconsult_pdf_view', $iconsult_result, TRUE);
          $pdf->WriteHTML($stylesheet,1); 
        $pdf->WriteHTML($content,2);

        }
        
        elseif(isset($category[0]['patient']) && count($category)>0 && !empty($category) && is_array($category)){
//             $content_main_header= $this->load->view('pdf/main_header', $iconsult_result, TRUE);
//             $content_main_footer= $this->load->view('pdf/iconsult_pdf_footer', $iconsult_result, TRUE);
//            print_r($category);die;
             $i=0;
            foreach ($category as $patient_econsult){
//          print_r($patient_econsult);die;
   if($type == 'alldoctor')               
    $iconsult_result['all'] = $patient_econsult['all'];
    elseif($type == 'openeddoctor')
      $iconsult_result['opened'] = $patient_econsult['opened'];
    
    elseif($type == 'closeddoctor')
      $iconsult_result['closed'] = $patient_econsult['closed'];

    $iconsult_result['patient'] = $patient_econsult['patient'];
    $iconsult_result['i'] = $i;
//       $content_iconsult_pdf_header= $this->load->view('pdf/iconsult_pdf_header', $iconsult_result, TRUE);
//       $pdf->SetHTMLHeader($content_iconsult_pdf_header);
//        $content= $this->load->view('pdf/iconsult_content', $iconsult_result, TRUE);
//           $content= $this->load->view('pdf/iconsult_pdf_view', $iconsult_result, TRUE);
//         $complete_html=$content_main_header.$content_iconsult_pdf_header.$content.$content_main_footer;
//    $pdf->WriteHTML($stylesheet,1); 
//    $pdf->WriteHTML($content,2);
    
//    $pdf->Output($type!='all'?ucwords($type).' Econsult.pdf':'Econsult.pdf', 'D'); 
//       print_r($patient_econsult['patient']);die;
     $content= $this->load->view('pdf/iconsult_pdf_view', $iconsult_result, TRUE);
     
     $pdf->WriteHTML($stylesheet,1); 
       if($i>0){  
       $pdf->addPage(1);  
//       $pdf->SetHTMLHeader($content_iconsult_pdf_header);
       }
    $pdf->WriteHTML($content,2);
    
    $i++;
//    
//    $pdf->Output($type!='all'?ucwords($type).' Econsult.pdf':'Econsult.pdf', 'D'); die;
            }
        }
        
        else{
            return FALSE;
        }
    
    $pdf->Output($type!='all'?ucwords($type).' Econsult.pdf':'Econsult.pdf', 'D'); 
        die;
//        $complete_html=$content_main_header.$content.$content_main_footer;
//    echo $content;die;
//   echo "<pre>";echo count($iconsult_result);print_R($iconsult_result);die;
//    print_r($patient);die;
        
//    }

//    $pdf->WriteHTML($stylesheet,1); 
//    $pdf->WriteHTML($complete_html,2);
//    
//    $pdf->Output($type!='all'?ucwords($type).' Econsult.pdf':'Econsult.pdf', 'D'); 
    exit;
  }


  public function blood_sugar()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);

    $this->load->driver('Pwidget');

    $this->pwidget->pdf_graph->as_patient();

    $this->pwidget->pdf_graph->type(Pwidget_pdf_graph::TYPE_BLOOD_SUGAR);

    $this->pwidget->pdf_graph->content();

    //$this->pwidget->pdf_graph->graph();

  }


  public function heart_frequency()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);

    $this->load->driver('Pwidget');

    $this->pwidget->pdf_graph->as_patient();

    $this->pwidget->pdf_graph->type(Pwidget_pdf_graph::TYPE_HEART_FREQUENCY);

    $this->pwidget->pdf_graph->content();

  }


  public function weight_bmi()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);

    $this->load->driver('Pwidget');

    $this->pwidget->pdf_graph->as_patient();

    $this->pwidget->pdf_graph->type(Pwidget_pdf_graph::TYPE_WEIGHT_BMI);

    $this->pwidget->pdf_graph->content();

    //$this->pwidget->pdf_graph->graph();

  }


  public function marcumar()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $_ci->load->library('pdf');
    $pdf = $this->pdf->load();
    $style = 'assets/pdf/pdf.css';
    $stylesheet = file_get_contents( $style);

    $this->load->driver('Pwidget');

    $this->pwidget->pdf_graph->as_patient();

    $this->pwidget->pdf_graph->type(Pwidget_pdf_graph::TYPE_MARCUMAR);

    $this->pwidget->pdf_graph->content();

    //$this->pwidget->pdf_graph->graph();

  }
  


  /**
   *
   */
	public function casehistory($id) 
  	{
  		static $_ci;
    	if (empty($_ci)) $_ci =& get_instance();
    
	    //loading languages
		$this->load->language('global/general_text',$this->m->user_value('language'));
		$this->load->language('patients/home',$this->m->user_value('language'));
		$this->load->language('patients/casehistory',$this->m->user_value('language'));
		
		$_ci->load->library('pdf','utf8');
	    $pdf = $this->pdf->load();
	    $style = 'assets/pdf/pdf.css';
	    $stylesheet = file_get_contents( $style);
	    $patient = array();
	
		$_ci->load->model('casehistory/mcasehistory');
	
  		$entries = $_ci->mcasehistory->get(array("id"=>$id));
    
	  	if(empty($entries))
	    {
	    	return false;
	    }
	    else 
	    {
	        foreach ($entries as $key=>$value)
	        {
	        	if(!empty($value->bodylocations))
	        	{
	        		$temp = $value->bodylocations;
					$value->bodylocations = '';
					
					$temp = explode("||",$temp);
	
					foreach($temp as $val)
					{
						$value->bodylocations[] = explode(",",$val);
					}
	        	}
	        }
	    }
	    
	  	if ($this->m->user_role() === M::ROLE_PATIENT)
	    {
	        $patient_details = $this->m->user_details($_ci->m->user_id(),'role_patient');
	    }
	    else if ($this->m->user_role() === M::ROLE_DOCTOR)
	    {
	    	$patient_details = $this->m->user_details($_ci->m->us_id(),'role_patient');
	    }

	    $content = $this->load->view('pdf/case_history_pdf_view', array('entries' => $entries,'patient_details'=>$patient_details), TRUE); 
		
	    $pdf->allow_charset_conversion=true;
	    $pdf->charset_in='ISO-8859-15';
		$pdf->WriteHTML($stylesheet,1); 
     	$pdf->WriteHTML($content,2);

		$pdf->Output('Casehistory.pdf', 'D');
	    exit;
 	}

}

/* End of file pdfget.php */
/* Location: ./application/modules/akte/controllers/pdfget.php */