<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rezept extends MX_Controller {

  /**
   *
   */
  public function __construct()
  {
    $this->m->login_check_redirect();
  }


public function index($url = NULL)
  {
    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
                 
    /*$this->config->load('ia24ui', TRUE, TRUE);

    $this->ui->html
      ->base_init()
      ->load_config('html');*/

      
    /*** for adding header***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
     
    }
    else
    {
		$this->config->load('ia24ui', TRUE, TRUE);
	    $this->ui->html->base_init()->load_config('html');
	}
    /***end here***/
    
    # Active URL
    if (empty($url))
    {
      $url = $this->input->get('r');
    }

    if (empty($url))
    {
      $url = $this->input->post('r');
    }
    
    if ($url = $this->encrypt->decode($url)){
      $this->ui->html
        ->set_active_url('rezept/'.$url);
    }
    else{
        
      if($this->m->user_role() == M::ROLE_DOCTOR)
          $this->ui->html
        ->set_active_url('rezept/doctors/rezept_list');
      else
      $this->ui->html
        ->set_active_url('rezept/r_question');
      }

      //echo $url;die;
    # mvpr theme
    if (empty($mvprt))
    {
      $mvprt = $this->input->get('mvprt');
    }

    if (empty($mvprt))
    {
      $mvprt = $this->input->post('mvprt');
    }

    if (empty($mvprt))
    {
      $mvprt = $this->session->userdata('mvprt');
    }

    if (!empty($mvprt))
    {
      if ($mvprt != 'clear')
      {
        $this->session->set_userdata('mvprt', $mvprt);
        
        if (Ui::$bs_tname == 'mvpr110')
        {
          $this->ui->html
            ->set_css($mvprt);
        }
        else
        {
          redirect('rezept');
          return;          
        }
      }
      else
      {
        $this->session->unset_userdata('mvprt');
        redirect('rezept');
        return;
      }
    }
   
    # mvpr theme
    if (empty($sa103t))
    {
      $sa103t = $this->input->get('sa103t');
    }

    if (empty($sa103t))
    {
      $sa103t = $this->input->post('sa103t');
    }

    if (empty($sa103t))
    {
      $sa103t = $this->session->userdata('sa103t');
    }

    if (!empty($sa103t))
    {
      if ($sa103t != 'clear')
      {
        $this->session->set_userdata('sa103t', $sa103t);
        
        if (Ui::$bs_tname == 'sa103')
        {
          $this->ui->html
            ->set_css($sa103t, 'sa_css');
        }
        else
        {
          redirect('rezept');
          return;          
        }
      }
      else
      {
        $this->session->unset_userdata('sa103t');
        redirect('rezept');
        return;
      }
    }
     
    $this->output->set_output(
      $this->ui->html->output()
    );
  }



  /**
   *
   */
  public function active_url($url = NULL)
  {
    $this->index($url);
  }



/*
*Load the question for the given sickness from the database
*/
  public function questions()
  {
    $sickness=$_GET['sickness'];
    $this->session->set_userdata('sickness',$sickness);
    rezept_ajax_redirect('r_question');
  }

   //Insert the answers given by the patiens
  public function insert_answers()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
        
    $_ci->load->model('rezept/m_epres');
    
    if($_ci->input->post('doctor_id'))
    {
    $familydoctors=implode(',',$_ci->input->post('doctor_id'));
    }
    else{
    $my_doctor  = $_ci->m_epres->get_familydoctor($this->m->user_id());
        if(count($my_doctor)>0 && is_array($my_doctor)){
               $string_family_doctor = "";
                        foreach ($my_doctor as $doctors) {
                        $doctor = (array) $doctors;
                        $string_family_doctor.=$doctor['doctor_inserted_id'] . ',';
                           }
               $familydoctors=$string_family_doctor;
               $string_family_doctor = rtrim($string_family_doctor, ',');

        }
    }


    //get the name of the sickness to update the eprescription table sickess column
//    $_ci->load->model('rezept/m_medicine');
//    if($_ci->input->post('country')=='83')
//    	$sickness=$_ci->m_medicine->get_sickness_name($_ci->input->post('wirkstoff_g'));
//   	else
//    	$sickness="";
    $insert_rezept =  array(
         'patient_id'    => $_ci->m->user_id() ? $_ci->m->user_id() : 0, 
         'follow_up'     => $_ci->input->post('follow_up'),
         'doctorcheck'   => $_ci->input->post('cyomeddoctor'),
         'Handelsname'   => $_ci->input->post('Handelsname'),
//         'drug'          => $_ci->input->post('country')=='83'?$_ci->input->post('wirkstoff_g'):$_ci->input->post('wirkstoff'),
//         'atc_code'      => $_ci->input->post('country')=='83'?$_ci->input->post('atc_code_g'):$_ci->input->post('atc_code'),
         'drug'          => $_ci->input->post('wirkstoff'),
         'atc_code'      => $_ci->input->post('atc_code'),
         'packsize'      => $_ci->input->post('packsize'),
         'manufacturer'  => $_ci->input->post('manufacturer'),
         'comments'      => $_ci->input->post('comments'),
//         'sickness'      => $sickness,
         'date_added'   =>true,
        );
     
     if($_ci->input->post('cyomeddoctor')=='1')
    {
     $familydoctorentry = array('familydoctor'  => $familydoctors,); 
     $insert_rezept=array_merge($insert_rezept,$familydoctorentry);
    }
    $_ci->load->model('rezept/m_epres');
    $rezept_id=$_ci->m_epres->insert($insert_rezept);
    
//    $this->session->set_userdata('epresid',$rezept_id);
    $_ci->load->model('rezept/m_question');
    $questions = $_ci->m_question->get();
    
    $insert_data=array();
    foreach($questions as $key=>$value){
        $answer=$_ci->input->post('question'.$value['id']);
         if(isset($answer) && !empty($answer)){
    if($value['id']==5){    //for the multiple time taken question from question id 5

        $answer_c = !empty($answer) && is_array($answer) ? implode(",", $answer):"";
      }
      else{
        $answer_c = $answer;
      }
        $insert_row = array(
          'epres_id'  => $rezept_id,
          'ques_id'   => $value['id'],
          'answer'    => $answer_c,
          );
        array_push($insert_data, $insert_row);
    }}
    $_ci->load->model('rezept/m_answers');
    $_ci->m_answers->insert($insert_data);
    //for the medication is exist or not
        if(($insert_rezept['atc_code'] !="" && !empty($insert_rezept['atc_code'])) ||  ($insert_rezept['wirkstoff'] !="" && !empty($insert_rezept['wirkstoff']))){
         $_ci->load->model('akte/medication/mmedication');
        $value=    $_ci->mmedication->medication_for_eprescription($insert_rezept['atc_code'],$insert_rezept['wirkstoff'],  $_ci->m->user_id());
        if(count($value)<=0 || !$mdiagnosis){
    $this->m->port->p->from('atccode');
    $this->m->port->p->where('atc_code', $insert_rezept['atc_code']);
    $this->m->port->p->or_like('substance', $insert_rezept['wirkstoff'],'after');
    $this->m->port->p->limit(1);
    $query = $this->m->port->p->get();
        if($query->num_rows() > 0 ){
           
            $taken_time = $_ci->input->post('question5');
            $taken_time = !empty($taken_time) && is_array($taken_time) ? implode(",", $taken_time):"";        
        
            $medication_array=array(
                'patient_id'        => $_ci->m->user_id(), 
                'dose_rate' =>  $_ci->input->post('question2'),
                'repeating_periods'=>$_ci->input->post('question4'),
                'taken_since'=>$_ci->input->post('question3'),
                'taken_time'         => $taken_time,
                'added_by'          => $_ci->m->user_id(),
                'user_role'         => $_ci->m->user_role(),
                'date_added'         => date('Y-m-d'),
                'atc_code'           => $insert_rezept['atc_code'],
                 'substance'          => $insert_rezept['substance'],
                'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0, 
            );
            $_ci->mmedication->insert($medication_array);
        }
           //for the medication is exist or not end
        }   
        }
        $diagnosis=$_ci->input->post('question9');
          if($diagnosis !="" && !empty($diagnosis)){
                 $diagnosis =  explode(",", $diagnosis); 
                 $icd_code=array();
                 foreach($diagnosis as $value){
                    $this->m->port->p->from('icd');
                    $this->m->port->p->where('icd_name', $value);
                    $this->m->port->p->or_like('icd_name', $value,'after');
                    $this->m->port->p->limit(1);
                    $query = $this->m->port->p->get();
                    if($query->num_rows()>0){
                    $result_icd=$query->row();
                    $icd_code[$value]=$result_icd->icd_code;
                    }
                 }
                  $_ci->load->model('akte/diagnosis/mdiagnosis'); 
                 foreach($icd_code as $icd=>$code){
                      $mdiagnosis=    $_ci->mdiagnosis->diagnosis_for_eprescription($code,$icd,$_ci->m->user_id());
                      if(count($mdiagnosis)<=0 || !$mdiagnosis){
//                foreach($diagnosis as $value){
//                    $this->m->port->p->from('icd');
//                    $this->m->port->p->where('icd_name', $value);
//                    $query = $this->m->port->p->get();
//                    if($query->num_rows() > 0)
//                    {
                     
                    foreach ($query->result() as $row){
                    $diagnosis_array= array(
                        'patient_id'        => $_ci->m->user_id(), 
                        'icd_code'          => $code, 
                        'title'             => $icd, 
                        'status'            => Mdiagnosis::STATUS_CONFIRMED,
                        'country_id'        => $_ci->input->post('country'), 
                        'date_added'        => TRUE, 
                        'added_by'          => $_ci->m->user_id(),
                        'user_role'         => $_ci->m->user_role(),  
                        );
                        $_ci->mdiagnosis->insert($diagnosis_array);
                    }
//                    }                    
//                }
          }
          }}
        
   
    rezept_ajax_redirect('r_summary/index/'.$rezept_id);
  }

/*
 *Load the final fiew to send the information to the cyomed
 */
  public function all_check($id=null)
  {
      if($id)
    rezept_ajax_redirect('r_all_check/index/'.$id);
      else
      rezept_ajax_redirect('r_history');
  }


/*
 *Send email to cyomed
 */
  public function final_submission($id=null)
  {
    $email = $this->input->post('email');
    //sending email to patient and also cyomed about his application

    //echo $email;
    
     if($email!=NULL) 
     {
        $user_data = array();//empty array for later use
        $subject= "Cyomed GmbH:Ihre Antrag zum Online Rezept";
        $msg = $this->load->view('rezept/submission_view', array('user_data' => $user_data, ), TRUE);
        $this->load->model('moemail');
        $this->moemail->send_email($email, $subject, $msg);
        $this->load->model('rezept/m_epres');
//        $this->m_epres->set_status($this->session->userdata('epresid'),1);
        $this->m_epres->set_status($id,1);
        /*** added for doctor check***/
         /*$this->m->port->m->where('id',$epres_id);
         $query1 = $this->m->port->m->get('eprescription');*/
        /*** end here***/ 
//        $this->session->unset_userdata('epresid');
     }
     else{
       echo "No email found";
     }
    rezept_ajax_redirect('r_email_check/index/submission_view');
  }

  //doctors
  /**
   * select Rezept to check or pateint select to check the history
   */
  public function select_rezept()
  {
    $id = trim(strip_tags($_GET['rezept_id']));
    if (!$id)
    {
      echo 'No Matches Found';
      return;
    }
//    $this->session->set_userdata('selectedid',$id);
    //if doctor select to view the applied rezept change the status to checked
    if($this->m->user_role() == M::ROLE_DOCTOR){
      $this->load->model('rezept/m_epres');
      $this->m_epres->set_status($id,2);
    }
    rezept_ajax_redirect('r_summary/index/'.$id);
  }
  public function rezept_history($patient=false)
  {
      if($patient=='patient'){
           $url="r_history/index/$patient";
          }
          else{
           $url='r_history';   
          }
    rezept_ajax_redirect($url);
  }

  /**
   * rezept acceptance
   */
  public function accept($id=NULL)
  {
//      echo $id;
//      print_R($this->input->post());die;
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }
//print_r($id);die;

    $this->load->model('rezept/m_epres');


    $update_data =  array(
         'status'       => 3,
         'doc_comments' => $this->input->post('doc_comments'),
        );

    $this->m_epres->update($id, $update_data);

    $email = $this->input->post('email');
    //sending email to patient and also cyomed about his application acceptance
    //echo $email;
     if($email!=NUll) 
     {
        $user_data = array();//empty array for later use
        $subject= "Cyomed GmbH:Rezept wurde akzeptiert";
        $msg = $this->load->view('rezept/accept_email_view', array('user_data' => $user_data, ), TRUE);
        $this->load->model('moemail');
        $this->moemail->send_email($email,$subject,$msg);
     }
     else{
       echo "No email found";
     }


    rezept_ajax_redirect('r_email_check/index/accept_email_view');
    
  }

  /**
   * Rezept not accepted
   */
  public function not_accept($id=NULL)
  {
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }
    $this->load->model('rezept/m_epres');
    $update_data =  array(
         'status'       => 4,
         'doc_comments' => $this->input->post('doc_comments'),
        );

    $this->m_epres->update($id, $update_data);

    $email = $this->input->post('email');
    //sending email to patient and also cyomed about his application not acceptance
   
     if($email!=NUll) 
     {
        $user_data = array();//empty array for later use
        $subject= "Cyomed GmbH:ePrescription acceptance";
        $msg = $this->load->view('rezept/epres_not_accept_view', array('user_data' => $user_data, ), TRUE);
        $this->load->model('moemail');
        $this->moemail->send_email($email,$subject,$msg);
     }
     else{
       echo "No email found";
     }

    rezept_ajax_redirect('r_email_check/index/epres_not_accept_view');
    
  }


}

/* End of file rezept.php */
/* Location: ./application/modules/rezept/controllers/rezept.php */