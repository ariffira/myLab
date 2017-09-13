<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Epres extends MX_Controller {

protected $data=NULL;

  /**
   *
   */
  public function index()
  {
    
  	$this->ui->mc->base_init();

  	$this->ui->mc->title->content = 'eprescription';

    $this->ui->mc->content->content = $this->load->view('epres_view', array(), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  /**
   *
   */
  public function insert()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
  
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription/information added';
  
    $insert_data =  array(
         'patient_id'    => $_ci->m->user_id() ? $_ci->m->user_id() : 0, 
         'follow_up'     => $_ci->input->post('follow_up'),
         'Handelsname'   => $_ci->input->post('Handelsname'),
         'drug'          => $_ci->input->post('drug'),
         'atc_code'      => $_ci->input->post('atc_code'),
         'packsize'      => $_ci->input->post('packsize'),
         //'pzn'         => $_ci->input->post('pzn'),
         'manufacturer'  => $_ci->input->post('manufacturer'),
         'comments'      => $_ci->input->post('comments'),
        );

    $this->session->set_userdata($insert_data);

    echo $result = $this->m->role_diff(
      function() use ($_ci,$insert_data){
        $_ci->load->model('epres/m_epres');

        return $_ci->m_epres->insert($insert_data);
      },
      function() use ($_ci, $insert_data){
        $_ci->load->model('epres/m_epres');
        $insert_id=$_ci->m_epres->insert($insert_data);
        $this->session->set_userdata('epresid',$insert_id);
        return $insert_id;
      }
    );

    redirect('eprescription/index/insert_info');
    
  }


  /**
   * updates epresription insert information
   */
    /**
   *
   */

  public function update()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
  
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription/information Updated';
    
    $this->load->model('epres/m_epres');

    $id = $this->session->userdata('epresid');
    $patient_id = $this->session->userdata('patient_id');

    $update_data =  array(
         //'patient_id'    => $_ci->m->user_id() ? $_ci->m->user_id() : 0, 
         'follow_up'     => $_ci->input->post('follow_up'),
         'Handelsname'   => $_ci->input->post('Handelsname'),
         'drug'          => $_ci->input->post('drug'),
         'atc_code'      => $_ci->input->post('atc_code'),
         'packsize'      => $_ci->input->post('packsize'),
         //'pzn'         => $_ci->input->post('pzn'),
         'manufacturer'  => $_ci->input->post('manufacturer'),
         'comments'      => $_ci->input->post('comments'),
        );

    $this->m_epres->update($id, $update_data);

    redirect('eprescription/index/insert_info');
    
  }

  /**
   *
   */
  public function insert_info()
  {
   //collect data from database where this patient have it just from session epresid then when update 
    $this->load->model('epres/m_epres');

    $id = $this->session->userdata('epresid');
    $patient_id = $this->session->userdata('patient_id');
    //echo $patient_id;
    $data = $this->m_epres->get_info($id, $patient_id);
    //var_dump($data);

    $this->ui->mc->base_init();

    $this->ui->mc->content->content = $this->load->view('update_view', array('data' => $data, ), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  public function sickness_view(){
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'Krankheit Wählen';

    $this->ui->mc->content->content = $this->load->view('sickness_choose_view', array(), TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  public function questions()
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();

    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription/Fragen';

    $_ci->load->model('epres/m_question');    
    $_ci->load->model('epres/m_medicine');

    //getting the list of questions and medicine for the selected sickness

    $questions['questions'] = $_ci->m_question->get($this->session->userdata('sickness'));
    $questions['medicine'] = $_ci->m_medicine->get($this->session->userdata('sickness'));

    $this->ui->mc->content->content = $this->load->view('questions_view', $questions , TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

  public function questions_insert()
  {
      $page_data = $this->load->view('both/epres/epres_questions_view');
      $this->load->view('struct_clean_view', $page_data);
  }

    public function questions_update()
  {
      $page_data = $this->load->view('both/epres/epres_questions_view');
      $this->load->view('struct_clean_view', $page_data);
  }

  //Insert the answers given by the patiens
  public function insert_answers(){
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
  
    $_ci->load->model('epres/m_question');
    $questions = $_ci->m_question->get($this->session->userdata('sickness'));
    
    $insert_data=array();
    $insert_row=array(
        'epres_id'    => $this->session->userdata('epresid'),
        'ques_id'     => '0',
        'answer'      => $_ci->input->post('question0'),
      );
    array_push($insert_data, $insert_row);

    foreach($questions as $key=>$value){
        $insert_row = array(
          'epres_id'  => $this->session->userdata('epresid'),
          'ques_id'   => $value['id'],
          'answer'    => $_ci->input->post('question'.$value['id']),
          );
        array_push($insert_data, $insert_row);
    }
    $_ci->load->model('epres/m_answers');
    $_ci->m_answers->insert($insert_data);

    //get the name of the sickness to update the eprescription table sickess column
    $_ci->load->model('epres/m_medicine');
    $sickness=$_ci->m_medicine->get_sickness_name($this->session->userdata('sickness'));

    $_ci->load->model('epres/m_epres');
    $_ci->m_epres->set_sickness($this->session->userdata('epresid'),$sickness);

    redirect('eprescription/index/summary');
  }

  public function summary(){
    $this->ui->mc->base_init();
    $this->ui->mc->title->content = 'eprescription/Zusammenfassung';

    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
  
    $_ci->load->model('epres/m_answers');


    
    $everything = $_ci->m_answers->get_everything($this->session->userdata('epresid'));


    $this->ui->mc->content->content = $this->load->view('summary_view', $everything , TRUE);

    $this->output->set_output($this->ui->mc->output());

  }

    public function all_check()
  {
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription/Final Check';

    //get user information from patient
    //default is null for guest user
    $userdata = (object) array(
       'id'                  => $this->m->user_id() ? $this->m->user_id() : 0, 
       'name'                => '',
       'surname'             => '',
       'email'               => '',
       'dob'                 => date("d.m.Y", time()),
       'family_doctor_name'  => '',
       'insurance'           => '',
       'insurance_no'        => '',
      ) ;

    $this->load->model('m');
    $id = $this->session->userdata('patient_id');
    if($id>0) 
      {  
        $this->load->model('mopat');
        $userdata = $this->mopat->get_id($id);
        $this->ui->mc->content->content = $this->load->view('final_view', array('userdata' => $userdata, ), TRUE);
        $this->output->set_output($this->ui->mc->output());
      }
    else
        { 

        $this->ui->mc->content->content = $this->load->view('final_view', array('userdata' => $userdata, ), TRUE);
        $this->output->set_output($this->ui->mc->output());

        }
  }

  public function final_submission()
  {
    $email = $this->input->post('email');
    //sending email to patient and also cyomed about his application

    //echo $email;
    
     if($email!=NUll) 
     {
        $user_data = array();//empty array for later use
        $subject= "Cyomed GmbH:Your application for ePrescription";
        $msg = $this->load->view('submission_view', array('user_data' => $user_data, ), TRUE);
        $this->load->model('moemail');
        $this->moemail->send_email($email,$subject,$msg);
     }
     else{
       echo "No email found";
     }

    // $this->ui->mc->base_init();

    // $this->ui->mc->title->content = 'eprescription/Final Submission';

    // $id = $this->session->userdata('patient_id');

    // if($id>0) //patients of system
    //   {  
    //     $this->ui->mc->content->content = $this->load->view('submission_view', array(), TRUE);
    //     $this->output->set_output($this->ui->mc->output());
    //   }
    // else  //guest user
    //   { 
    //     $this->session->set_userdata($insert_user);

    //     $this->ui->mc->content->content = $this->load->view('submission_view', array(), TRUE);
    //     $this->output->set_output($this->ui->mc->output());

    //   }
    redirect('eprescription/index/email_check');
  }


/*
function used to get the json list of medicine for selected sickness for jquery function not used anymore 
*/
  public function get_option(){
    $term = trim(strip_tags($_GET['term']));
    if (!$term)
    {
      echo 'No Matches Found';
      return;
    }

    $a_json=array();
    $a_json_row=array();
    $this->m->port->m->from('epres_medicine');
    $this->m->port->m->where('sickness',$term);
    $this->m->port->m->select('medicine');
    $query = $this->m->port->m->get();

    if($query->num_rows() > 0){
      foreach ($query->result() as $row){
        $a_json_row['medicine'] = $row->medicine;
        array_push($a_json,$a_json_row);
      }
    }
    echo json_encode($a_json);

  }


  /**
   * List of all application and their status or history
   */
  public function epres_list()
  {
    $data = array();
    $this->load->model('epres/m_epres');
    $data = $this->m_epres->list_of_applications();

    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription/ePrescription History';

    $this->ui->mc->content->content = $this->load->view('history_view', array('data' => $data, ), TRUE);

    //var_dump($data);
    $this->output->set_output($this->ui->mc->output());

  }


  /**
   * email check message after successful apllication
   */
  public function email_check()
  {
    
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = 'eprescription';

    $this->ui->mc->content->content = $this->load->view('submission_view', array(), TRUE);

    $this->output->set_output($this->ui->mc->output());


  }





}
