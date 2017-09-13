<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modoc extends CI_Model {
    
 const TABLE_HEART_FREQUENCY = 'heart_frequency';
  const TABLE_BLOOD_SUGAR     = 'blood_sugar';
  const TABLE_WEIGHT_BMI      = 'weight_bmi';
  const TABLE_MARCUMAR        = 'marcumar';
  const ERROR_NO_DOCTOR = 'error_no_doctor';
  const ERROR_NO_PATIENT = 'error_no_patient';

  public static $encrypted_fields = array('password', 'confirm_code');
  public static $plain_fields     = array('id', 'regid', 'pin', 'name', 'surname', 'academic_grade', 'address', 'language', 'theme', 'website', 'zip', 'region', 'city', 'country', 'telephone', 'fax', 'mobile', 'email', 'emergency_number', 'specialization1', 'specialization2', 'profile_image', 'additional_title1', 'additional_title2', 'additional_title3', 'uploads', 'confirm_status', 'iconsult_status', 'Dr_approv',  'confirm_code',  );
  public static $datetime_fields  = array('cdate', );

  public $doctor;
  public $pat_id;
  public $patient;
  public $access;

  private $_error = array();

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  /**
   *
   */
  public function last_error()
  {
    return ($c = count($this->_error)) > 0 ? $this->_error[$c - 1] : FALSE;
  }

  /**
   *
   */
  public function get_id($id)
  {
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
    
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('doctors', array('id' => $id, ), 1);

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      $this->m->port->b->db_select();
      $query = $this->m->port->b->get_where('doctors', array('doctor_id' => $id, ), 1);
      if ($query->num_rows() > 0)
      {
        $native_row = $query->row();
      }
      else
      {
        $this->m->port->b->set('is_member'      , 1);
        $this->m->port->b->set('doctor_id'      , $row->id);
        $this->m->port->b->set('email'          , $row->email);
        $this->m->port->b->set('password'       , $row->password);
        $this->m->port->b->set('title'          , $row->academic_grade);
        $this->m->port->b->set('first_name'     , $row->name);
        $this->m->port->b->set('last_name'      , $row->surname);
        $this->m->port->b->set('telephone'      , $row->telephone);

        $this->m->port->b->db_select();
        if ($this->m->port->b->insert('doctors'))
        {
          $this->m->port->b->db_select();
          $query = $this->m->port->b->get_where('doctors', array('doctor_id' => $id, ), 1);
          if ($query->num_rows() > 0)
          {
            $native_row = $query->row();
          }
          else
          {
            $native_row = new stdClass();
          }
        }
        else
        {
          $native_row = new stdClass();
        }

      }

      $row->native = $native_row;

      $this->m->port->b->db_select();
      $query = $this->m->port->b->get_where('doctor_settings', array('doctor_id' => $id, ), 1);
      if ($query->num_rows() <= 0)
      {
        $this->m->port->b->set('doctor_id'             , $id);
        $this->m->port->b->set('working_days'          , 5);
        $this->m->port->b->set('working_hours_start'   , 9);
        $this->m->port->b->set('working_hours_end'     , 17);
        $this->m->port->b->set('calendar_cell'         , 15);
        $this->m->port->b->set('termin_default_length' , 30);
        $this->m->port->b->set('regular_termin_on'     , 0);

        $this->m->port->b->db_select();
        if ($this->m->port->b->insert('doctor_settings'))
        {
          $this->m->port->b->db_select();
          $query = $this->m->port->b->get_where('doctor_settings', array('doctor_id' => $id, ), 1);
        }
      }

      $row->doctor_settings = $query->row();

      $ci =& get_instance();
      $ci->speciality->user_specs($row);
      $ci->language->user_langs($row);

      $row->regular_termins = $this->get_regular_termins($id);

      $row->all_termins = $this->get_all_termins($id);

      $row->unread = $this->get_unread_reservations($id);

      $row->specialization1 = array_filter(array_map(function($item) use ($_ci) { 
        return !empty($item) && array_key_exists($item, $_ci->speciality->get_assoc()) ? $item : NULL;
      }, explode(',', $row->specialization1) ) );

      return $row;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_regid($regid)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->where('regid', $regid);

    $query = $this->m->port->p->get('doctors');

    if ($query->num_rows() > 0)
    {
      return $this->get_id($query->row()->id);
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_all()
  {
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get('doctors');

    $ret = array();
    foreach ($query->result() as $row) {
      $ret[] = $this->get_id($row->id);
    }
    
    return $ret;
  }

  /**
   *
   */
  public function get_approved()
  {
    $this->m->port->p->db_select();
    $this->m->port->p->where('confirm_status', 1);
    $this->m->port->p->where('Dr_approv', 1);

    $query = $this->m->port->p->get('doctors');

    $ret = array();
    foreach ($query->result() as $row) {
      $ret[] = $this->get_id($row->id);
    }
    
    return $ret;
  }

  /**
   *
   */
  public function select($patient_id)
  {   
    $patient = $this->mopat->get_id($patient_id);

    if ($patient && !empty($patient->id) && !empty($patient->regid))
    {
      $this->session->set_userdata('selected_id', $this->encrypt->encode($patient->id));
      $this->session->set_userdata('selected_regid', $this->encrypt->encode($patient->regid));
    }

    $this->m->login_check();

    return $this->m->us();
  }

  /**
   *
   */
  public function select_regid($regid)
  {  
    $patient = $this->mopat->get_regid($regid);
    if ($patient)
    {
      return $this->select($patient->id);
    }
    else
    {
      return FALSE;
    }      
  }
  /**
   *
   */
  public function get_patients($doctor_id = NULL,$regid=NULL)
  {
    if ($doctor_id === NULL)
    {
      if ($this->m->user_role() == M::ROLE_DOCTOR)
      {
        $doctor_id = $this->m->user_id();
      }
      else
      {
        return array();
      }
    }
    
    # Get my doctors
    $this->m->port->p->select("`p`.`name`, p.`dob`,`p`.`surname`, `p`.`city`, `p`.`regid`, `myd`.`id`, `myd`.`access_rights`", FALSE);
    $this->m->port->p->from("my_doctors AS myd");
    $this->m->port->p->join("patients AS p", "myd.patient_id = p.id", 'inner');
    $this->m->port->p->where("myd.access_rights",1);
    $this->m->port->p->where("myd.doctor_inserted_id", $doctor_id);
    if(!empty($regid))
    {
      $this->m->port->p->where("myd.patient_id", $regid);  
    }
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get();
    return $query->result();
  }

  public function get_patientdetail($reg_id)
  {
    # Get my doctors
    $this->m->port->p->select("`p`.`name`,`p`.`id`,`p`.`mobile`,`p`.`telephone`,`p`.`surname`, `p`.`city`, `p`.`regid`", FALSE);
    $this->m->port->p->from("patients AS p");
    $this->m->port->p->where("p.regid", $reg_id);
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get();
   
    return $query->result();
  }
  /**
   *
   */
  public function update_profile()
  {
    $title                   = $this->input->post('title');
    $gender                  = $this->input->post('gender');
    $first_name              = $this->input->post('first_name');
    $last_name               = $this->input->post('last_name');
    $email                   = $this->input->post('email');
    $postal_code             = $this->input->post('postal_code');
    $locality                = ucfirst($this->input->post('locality'));
    $street                  = $this->input->post('street');
    $street_additional       = $this->input->post('street_additional');
    $coordinate_lat          = $this->input->post('coordinate_lat');
    $coordinate_lng          = $this->input->post('coordinate_lng');
    $telephone               = $this->input->post('telephone');
    $website                 = $this->input->post('website');
    $speciality              = $this->input->post('speciality') && is_array($this->input->post('speciality')) ? implode(',', $this->input->post('speciality')) : '';
    $languages               = $this->input->post('languages') && is_array($this->input->post('languages')) ? implode(',', $this->input->post('languages')) : '';
    $insurance_private       = set_checkbox('insurance[]', '1') ? '1' : '';
    $insurance_public        = set_checkbox('insurance[]', '2') ? '1' : '';
    $must_feedback           = $this->input->post('must_feedback');
    $text_description        = $this->input->post('text_description');
    $text_vet                = $this->input->post('text_vet');
    $text_more_for_patient   = $this->input->post('text_more_for_patient');
    $text_membership         = $this->input->post('text_membership');
    $text_hospital_occupancy = $this->input->post('text_hospital_occupancy');

    $upload_result = $this->do_upload('avatar');

    $this->m->port->b->set('title'                   , $title);
    $this->m->port->b->set('gender'                  , $gender);
    $this->m->port->b->set('first_name'              , $first_name);
    $this->m->port->b->set('last_name'               , $last_name);
    $this->m->port->b->set('email'                   , $email);
    $this->m->port->b->set('postal_code'             , $postal_code);
    $this->m->port->b->set('locality'                , $locality);
    $this->m->port->b->set('street'                  , $street);
    $this->m->port->b->set('street_additional'       , $street_additional);
    $this->m->port->b->set('coordinate_lat'          , $coordinate_lat);
    $this->m->port->b->set('coordinate_lng'          , $coordinate_lng);
    $this->m->port->b->set('telephone'               , $telephone);
    $this->m->port->b->set('website'                 , $website);
    $this->m->port->b->set('speciality'              , $speciality);
    $this->m->port->b->set('languages'               , $languages);
    $this->m->port->b->set('insurance_private'       , $insurance_private);
    $this->m->port->b->set('insurance_public'        , $insurance_public);
    $this->m->port->b->set('must_feedback'           , $must_feedback);
    $this->m->port->b->set('text_description'        , $text_description);
    $this->m->port->b->set('text_vet'                , $text_vet);
    $this->m->port->b->set('text_more_for_patient'   , $text_more_for_patient);
    $this->m->port->b->set('text_membership'         , $text_membership);
    $this->m->port->b->set('text_hospital_occupancy' , $text_hospital_occupancy);

    if ($upload_result)
    {
      $this->m->port->b->set('avatar', base_url($upload_result['upload_path'].$upload_result['file_name']));
    }

    $this->m->port->b->where('doctor_id', $this->m->user_id());

    $this->m->port->b->db_select();
    $this->m->port->b->update('doctors');

    $this->m->port->p->set('academic_grade'          , $title);
    // $this->m->port->p->set('gender'                  , $gender);
    $this->m->port->p->set('name'                    , $first_name);
    $this->m->port->p->set('surname'                 , $last_name);
    $this->m->port->p->set('email'                   , $email);
    $this->m->port->p->set('zip'                     , $postal_code);
    $this->m->port->p->set('city'                    , $locality);
    $this->m->port->p->set('address'                 , $street);
    $this->m->port->p->set('telephone'               , $telephone);
    $this->m->port->p->set('website'                 , $website);

    $this->m->port->p->where('id', $this->m->user_id());

    return $this->m->port->p->update('doctors');
  }

  /**
   *
   */
  public function do_upload($type = 'general')
  {
    $config = array();

    $config['upload_path'] = './assets/uploads/doctor/'.md5($this->m->user_id()).'/'.trim($type, '/').'/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['encrypt_name'] = TRUE;
    // $config['max_size'] = '100';
    // $config['max_width']  = '1024';
    // $config['max_height']  = '768';

    if (!file_exists($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, true);
    }

    $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
    $this->load->helper('file');
    write_file($config['upload_path'].'index.html', $permission_string);

    $this->load->library('upload', $config);

    if ($this->upload->do_upload($type))
    {
      return (($data = $this->upload->data()) && ($data['upload_path'] = $config['upload_path'])) ? $data : $this->upload->data();
    }
    else
    {
      return FALSE;
    }
  }

  /**
   *
   */
  public function get_regular_termins($doctor_id)
  {
    $this->m->port->b->db_select();
    $query = $this->m->port->b->get_where('doctor_termins', array('doctor_id' => $doctor_id, 'repetitive' => 1, ));

    return $result = ($query->num_rows() > 0 ? $query->result() : array());
  }

  /**
   *
   */
  public function get_all_termins($doctor_id)
  {
    $this->m->port->b->db_select();
    $query = $this->m->port->b->get_where('doctor_termins', array('doctor_id' => $doctor_id, ));

    return $result = ($query->num_rows() > 0 ? $query->result() : array());
  }

  /**
   *
   */
  public function get_display_termins($doctor_id, $show_private = TRUE, $show_public = TRUE)
  {

  }

  /**
   *
   */
  public function update_termin($id = NULL)
  {
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }
    if (!is_numeric($id))
    {
      return;
    }

    $this->m->port->b->where('id', $id);
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->limit(1);

    if ($this->input->post('insurance') && is_array($this->input->post('insurance')))
    {
      if (in_array('1', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_private', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_private', 0);
      }

      if (in_array('2', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_public', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_public', 0);
      }
    }

    $this->m->port->b->set('repetitive', $this->input->post('repetitive') ? 1 : 0);
    $this->m->port->b->set('mask', $this->input->post('mask') ? 1 : 0);
    $this->m->port->b->set('allday', $this->input->post('allday') ? 1 : 0);
    $this->m->port->b->set('period', 7);

    $this->m->port->b->set('text_patient', $this->input->post('text_patient') ? $this->input->post('text_patient') : '');
    $this->m->port->b->set('text_notes', $this->input->post('text_notes') ? $this->input->post('text_notes') : '');

    $this->m->port->b->db_select();
    $this->m->port->b->update('doctor_termins');

    if ($this->input->post('start_picker') || $this->input->post('end_picker'))
    {
      $this->update_termin_time($id);
    }
  }

  /**
   *
   */
  public function update_termin_time($id = NULL)
  {
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }
    if (!is_numeric($id))
    {
      return;
    }

    $this->m->port->b->where('id', $id);
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->limit(1);
    $query = $this->m->port->b->get('doctor_termins');
    if ($query->num_rows() <= 0)
    {
      return;
    }
    $old = $query->row();

    $this->m->port->b->where('id', $id);
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->limit(1);

    $start = $this->input->post('start_picker');
    $end = $this->input->post('end_picker');

    if (!$start || !$end)
    {
      $start = $this->input->post('start');
      $end = $this->input->post('end');
    }

    if ($start && $end)
    {
      $val_start = strtotime($start);
      $val_end = strtotime($end);

      if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1)
      {
        $this->m->port->b->set('start', $start);
        $this->m->port->b->set('end', $end);

        if ($day = @date('N', $val_start))
        {
          $this->m->port->b->set('day', $day);
        }
        else
        {
          return;
        }
      }
      else
      {
        return;
      }
    }
    else
    {
      return;
    }

    $this->m->port->b->db_select();
    $this->m->port->b->update('doctor_termins');

    $diff = $val_start - strtotime($old->start);

    $this->m->port->b->set('start', 'start + INTERVAL '.$diff.' SECOND' , FALSE);
    $this->m->port->b->set('end', 'end + INTERVAL '.$diff.' SECOND' , FALSE);
    $this->m->port->b->set('day', $day);

    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->where('mask', 1);
    $this->m->port->b->where('mask_event_id', $id);

    $this->m->port->b->db_select();
    $this->m->port->b->update('doctor_termins');
  }

  /**
   *
   */
  public function insert_termin()
  {
    
    $this->m->port->b->set('doctor_id', $this->m->user_id());

    if (($start = $this->input->post('start')) && ($end = $this->input->post('end')))
    {
      $val_start = strtotime($start);
      $val_end = strtotime($end);

      if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1)
      {
        $this->m->port->b->set('start', $start);
        $this->m->port->b->set('end', $end);

        if ($day = @date('N', $val_start))
        {
          $this->m->port->b->set('day', $day);
        }
      }
    }

    if ($this->input->post('insurance') && is_array($this->input->post('insurance')))
    {
      if (in_array('1', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_private', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_private', 0);
      }

      if (in_array('2', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_public', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_public', 0);
      }
    }

    $this->m->port->b->set('ready', $this->input->post('ready') ? 1 : 0);
    $this->m->port->b->set('repetitive', $this->input->post('repetitive') ? 1 : 0);
    $this->m->port->b->set('mask', $this->input->post('mask') ? 1 : 0);
    $this->m->port->b->set('allday', $this->input->post('allday') ? 1 : 0);
    $this->m->port->b->set('period', 7);

    $this->m->port->b->set('text_patient', $this->input->post('text_patient') ? $this->input->post('text_patient') : '');
    $this->m->port->b->set('text_notes', $this->input->post('text_notes') ? $this->input->post('text_notes') : '');

    $this->m->port->b->db_select();
    $this->m->port->b->insert('doctor_termins');
  }

  /**
   *
   */
  public function mask_termin($id = NULL)
  {
    // Original Termin query
    
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }
    if (!is_numeric($id))
    {
      return;
    }

    $this->m->port->b->where('id', $id);
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->limit(1);
    $query = $this->m->port->b->get('doctor_termins');

    if ($query->num_rows() > 0)
    {
      $row = $query->row();
    }
    else
    {
      return;
    }

    // Create mask Termin    

    if (($start = $this->input->post('start')) && ($end = $this->input->post('end')))
    {
      $val_start = strtotime($start);
      $val_end = strtotime($end);

      if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1)
      {
        $this->m->port->b->set('start', $start);
        $this->m->port->b->set('end', $end);

        if ($day = @date('N', $val_start))
        {
          $this->m->port->b->set('day', $day);
        }
      }
      else
      {
        return;
      }
    }
    else
    {
      return;
    }

    $this->m->port->b->set('doctor_id', $this->m->user_id());
    $this->m->port->b->set('ready', 1);
    $this->m->port->b->set('repetitive', 0);
    $this->m->port->b->set('mask', 1);
    $this->m->port->b->set('mask_event_id', $id);
    $this->m->port->b->set('allday', 1);
    $this->m->port->b->set('period', 7);
    $this->m->port->b->db_select();
    $this->m->port->b->insert('doctor_termins');

    // Create termin in the middle

    if ($this->input->post('start_picker') != $start || $this->input->post('end_picker') != $end)
    {
      $start = $this->input->post('start_picker');
      $end = $this->input->post('end_picker');

      $val_start = strtotime($start);
      $val_end = strtotime($end);

      if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1)
      {
        $this->m->port->b->set('start', $start);
        $this->m->port->b->set('end', $end);

        if ($day = @date('N', $val_start))
        {
          $this->m->port->b->set('day', $day);
        }
      }
      else
      {
        return;
      }
    }
    else
    {
      $this->m->port->b->set('start', $start);
      $this->m->port->b->set('end', $end);
      $this->m->port->b->set('day', $day);
    }

    $this->m->port->b->set('doctor_id', $this->m->user_id());

    if ($this->input->post('insurance') && is_array($this->input->post('insurance')))
    {
      if (in_array('1', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_private', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_private', 0);
      }

      if (in_array('2', $this->input->post('insurance')))
      {
        $this->m->port->b->set('insurance_public', 1);
      }
      else
      {
        $this->m->port->b->set('insurance_public', 0);
      }
    }

    $this->m->port->b->set('ready', $this->input->post('ready') ? 1 : 0);
    $this->m->port->b->set('repetitive', 0);
    $this->m->port->b->set('mask', $this->input->post('mask') ? 1 : 0);
    $this->m->port->b->set('allday', $this->input->post('allday') ? 1 : 0);
    $this->m->port->b->set('period', 7);

    $this->m->port->b->set('text_patient', $this->input->post('text_patient') ? $this->input->post('text_patient') : '');
    $this->m->port->b->set('text_notes', $this->input->post('text_notes') ? $this->input->post('text_notes') : '');

    $this->m->port->b->db_select();
    $this->m->port->b->insert('doctor_termins');
  }

  /**
   *
   */
  public function update_regular_termins()
  {
    $this->m->port->b->set('regular_termin_on', $this->input->post('regular_termin_on'));
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->db_select();
    $this->m->port->b->update('doctor_settings');

    $time = time();
    $weekday = date('N', $time);

    for ($day = 1; $day < 8; $day++) {
      if ($this->input->post('regular_termins_count') && is_array($this->input->post('regular_termins_count')) && $this->input->post('regular_termins_count')[$day])
      {

      }
      else
      {
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->where('day', $day);
        $this->m->port->b->db_select();
        $this->m->port->b->delete('doctor_termins');
      }

      if ($this->input->post('regular_termins_added') && is_array($this->input->post('regular_termins_added')) && $this->input->post('regular_termins_added')[$day])
      {
        if ($this->input->post('added_termin_start') && is_array($this->input->post('added_termin_start')) && $this->input->post('added_termin_start')[$day]) {
          foreach ($this->input->post('added_termin_start')[$day] as $key => $value) {
            if ($end = $this->input->post('added_termin_end')[$day][$key])
            {

              $date = date('Y-m-d', $time + ($day >= $weekday ? $day - $weekday : $day + 7 - $weekday) * 86400);
              $start_datetime = $date.' '.$value.':00';
              // $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime) + $end * 60);
              $end_datetime = $date.' '.$end.':00';

              $val_start = strtotime($start_datetime);
              $val_end = strtotime($end_datetime);

              if ($val_start === FALSE || $val_start === -1 || $val_end === FALSE || $val_end === -1)
              {
                continue;
              }

              $this->m->port->b->set('doctor_id', $this->m->user_id());
              $this->m->port->b->set('day', $day);
              $this->m->port->b->set('repetitive', 1);
              $this->m->port->b->set('period', 7);
              if ($this->input->post('added_termin_ready') && is_array($this->input->post('added_termin_ready')) && isset($this->input->post('added_termin_ready')[$day]) && is_array($this->input->post('added_termin_ready')[$day]) && isset($this->input->post('added_termin_ready')[$day][$key]) && $this->input->post('added_termin_ready')[$day][$key]) {
                $this->m->port->b->set('ready', 1);
              } else {
                $this->m->port->b->set('ready', 0);
              }
              if ($this->input->post('added_termin_insurance') && is_array($this->input->post('added_termin_insurance')) && isset($this->input->post('added_termin_insurance')[$day]) && is_array($this->input->post('added_termin_insurance')[$day]) && isset($this->input->post('added_termin_insurance')[$day][$key]) && is_array($this->input->post('added_termin_insurance')[$day][$key]) && in_array(1, $this->input->post('added_termin_insurance')[$day][$key])) {
                $this->m->port->b->set('insurance_private', 1);
              } else {
                $this->m->port->b->set('insurance_private', 0);
              }
              if ($this->input->post('added_termin_insurance') && is_array($this->input->post('added_termin_insurance')) && isset($this->input->post('added_termin_insurance')[$day]) && is_array($this->input->post('added_termin_insurance')[$day]) && isset($this->input->post('added_termin_insurance')[$day][$key]) && is_array($this->input->post('added_termin_insurance')[$day][$key]) && in_array(2, $this->input->post('added_termin_insurance')[$day][$key])) {
                $this->m->port->b->set('insurance_public', 1);
              } else {
                $this->m->port->b->set('insurance_public', 0);
              }
              if ($this->input->post('added_termin_mask') && is_array($this->input->post('added_termin_mask')) && isset($this->input->post('added_termin_mask')[$day]) && is_array($this->input->post('added_termin_mask')[$day]) && isset($this->input->post('added_termin_mask')[$day][$key]) && $this->input->post('added_termin_mask')[$day][$key]) {
                $this->m->port->b->set('mask', 1);
              } else {
                $this->m->port->b->set('mask', 0);
              }
              $this->m->port->b->set('start', $start_datetime);
              $this->m->port->b->set('end', $end_datetime);

              $this->m->port->b->db_select();
              $this->m->port->b->insert('doctor_termins');
            }
          }
        }
      }
    }

    if ($this->input->post('termin_start') && is_array($this->input->post('termin_start'))) {
      foreach ($this->input->post('termin_start') as $key => $value) {
        if ($end = $this->input->post('termin_end')[$key])
        {

          $this->m->port->b->where('id', $key);
          $this->m->port->b->where('doctor_id', $this->m->user_id());
          $this->m->port->b->limit(1);
          $query = $this->m->port->b->get('doctor_termins');

          if ($query->num_rows() <= 0)
          {
            continue;
          }

          $row = $query->row();

          $date = date('Y-m-d', strtotime($row->start));
          $start_datetime = $date.' '.$value.':00';
          // $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime) + $end * 60);
          $end_datetime = $date.' '.$end.':00';

          $val_start = strtotime($start_datetime);
          $val_end = strtotime($end_datetime);

          if ($val_start === FALSE || $val_start === -1 || $val_end === FALSE || $val_end === -1)
          {
            continue;
          }

          $this->m->port->b->where('id', $key);
          $this->m->port->b->where('doctor_id', $this->m->user_id());

          // $this->m->port->b->set('day', $day);
          if ($this->input->post('ready') && is_array($this->input->post('ready')) && isset($this->input->post('ready')[$key]) && $this->input->post('ready')[$key]) {
            $this->m->port->b->set('ready', 1);
          } else {
            $this->m->port->b->set('ready', 0);
          }
          if ($this->input->post('insurance') && is_array($this->input->post('insurance')) && isset($this->input->post('insurance')[$key]) && is_array($this->input->post('insurance')[$key]) && in_array(1, $this->input->post('insurance')[$key])) {
            $this->m->port->b->set('insurance_private', 1);
          } else {
            $this->m->port->b->set('insurance_private', 0);
          }
          if ($this->input->post('insurance') && is_array($this->input->post('insurance')) && isset($this->input->post('insurance')[$key]) && is_array($this->input->post('insurance')[$key]) && in_array(2, $this->input->post('insurance')[$key])) {
            $this->m->port->b->set('insurance_public', 1);
          } else {
            $this->m->port->b->set('insurance_public', 0);
          }
          if ($this->input->post('mask') && is_array($this->input->post('mask')) && isset($this->input->post('mask')[$key]) && $this->input->post('mask')[$key]) {
            $this->m->port->b->set('mask', 1);
          } else {
            $this->m->port->b->set('mask', 0);
          }
          $this->m->port->b->set('start', $start_datetime);
          $this->m->port->b->set('end', $end_datetime);

          $this->m->port->b->db_select();
          $this->m->port->b->update('doctor_termins');
        }
      }
    }
  }

  /**
   *
   */
  public function delete_regular_termin($id = NULL)
  {
    if ($id === NULL)
    {
      $id = $this->input->post('id');
    }

    if (!$id)
    {
      $id = $this->input->get('id');
    }

    if (!$id || !is_numeric($id))
    {
      return FALSE;
    }

    $this->m->port->b->where('id', $id);
    $this->m->port->b->where('doctor_id', $this->m->user_id());
    $this->m->port->b->db_select();
    return $this->m->port->b->delete('doctor_termins');
  }

  /**
   *
   */
  public function reserve()
  {
    $start              = $this->input->post('start');
    $doctor_id          = $this->input->post('doctor_id');
    $user_id            = $this->input->post('user_id');
    $gender             = $this->input->post('gender');
    $first_name         = $this->input->post('first_name');
    $last_name          = $this->input->post('last_name');
    $email              = $this->input->post('email');
    $telephone          = $this->input->post('telephone');
    $insurance          = $this->input->post('insurance');
    $insurance_provider = $this->input->post('insurance_provider');
    $treatment          = $this->input->post('treatment');
    $patient_notes      = $this->input->post('patient_notes');

    if (!$doctor_id)
    {
      return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
    }

    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('doctors', array('id' => $doctor_id, ), 1);
    if ($query->num_rows() > 0)
    {
      $doctor_row = $query->row();
    }
    else
    {
      return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
    }

    $this->m->port->b->set('doctor_id', $doctor_id);

    if ($user_id)
    {
      $this->m->port->p->db_select();
      $this->m->port->p->db_select();
      $query = $this->m->port->p->get_where('patients', array('id' => $user_id, ), 1);
      if ($query->num_rows() > 0)
      {
        $patient_row = $query->row();

        $this->m->port->b->set('patient_id'         , $patient_row->id);
        // $this->m->port->b->set('gender'             , $patient_row->gender);
        $this->m->port->b->set('first_name'         , $patient_row->name);
        $this->m->port->b->set('last_name'          , $patient_row->surname);
        $this->m->port->b->set('email'              , $patient_row->email);
        $this->m->port->b->set('telephone'          , $patient_row->telephone);
        $this->m->port->b->set('insurance'          , $insurance);
        $this->m->port->b->set('insurance_provider' , $insurance_provider);
      }
      else
      {
        return ($this->_error[] = self::ERROR_NO_PATIENT) ? FALSE : FALSE;
      }
    }
    else
    {
      $this->m->port->b->set('patient_id'         , $user_id);
      $this->m->port->b->set('gender'             , $gender);
      $this->m->port->b->set('first_name'         , $first_name);
      $this->m->port->b->set('last_name'          , $last_name);
      $this->m->port->b->set('email'              , $email);
      $this->m->port->b->set('telephone'          , $telephone);
      $this->m->port->b->set('insurance'          , $insurance);
      $this->m->port->b->set('insurance_provider' , $insurance_provider);
    }

    $val_start = strtotime($start);

    if ($val_start !== FALSE && $val_start !== -1)
    {
      $this->m->port->b->set('start', $start);
      // $this->m->port->b->set('end', $end);
    }
    else
    {
      return ($this->_error[] = Mod::ERROR_DATE_INVALID) ? FALSE : FALSE;
    }

    $this->m->port->b->set('treatment' , $treatment);
    $this->m->port->b->set('text_patient_notes' , $patient_notes);

    $this->m->port->b->db_select();
    return ($result = $this->m->port->b->insert('reservations')) ? $result : (($this->_error[] = Mod::ERROR_DB_INSERT) ? FALSE : FALSE);
    
  }

  /**
   *
   */
  public function get_all_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, ));
  }

  /**
   *
   */
  public function get_unread_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'read' => 0, ));
  }

  /**
   *
   */
  public function get_unaccepted_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'accept' => 0, ));
  }

  /**
   *
   */
  public function get_accepted_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'start >' => date('Y-m-d H:i:s'), 'accept' => 1, ));
  }

  /**
   *
   */
  public function get_past_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'start <=' => date('Y-m-d H:i:s'), 'accept' => 1, ));
  }

  /**
   *
   */
  public function get_archived_reservations($doctor_id)
  {
    return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 1, ));
  }

  /**
   *
   */
  public function get_cond_reservations($cond)
  {
    $this->m->port->b->order_by('start');

    $this->m->port->b->db_select();
    $query = $this->m->port->b->get_where('reservations', $cond);

    if ($query->num_rows() > 0)
    {
      $result = array();
      
      foreach ($query->result() as $row)
      {
        if ($row->patient_id)
        {
          $query_patient_row = $this->mopat->get_id($row->patient_id);
        }
        else
        {
          $query_patient_row = NULL;
        }

        if (isset($query_patient_row) && $query_patient_row)
        {
          $this->insurance_provider->user_inspro($query_patient_row);

          $row->email = $query_patient_row->email;
          $row->gender = $query_patient_row->gender;
          $row->first_name = $query_patient_row->name;
          $row->last_name = $query_patient_row->surname;
          $row->telephone = $query_patient_row->telephone;
          // $row->insurance = $query_patient_row->insurance;

          if (count($query_patient_row->inspro_assoc) > 0)
          {
            $row->insurance_provider = reset($query_patient_row->inspro_assoc)->name;
          }
          else
          {
            $row->insurance_provider = '';
          }
        }
        else
        {
          if ($row->insurance_provider)
          {
            $providers = $this->insurance_provider->get_assoc();

            if (isset($providers[$row->insurance_provider]) && $providers[$row->insurance_provider])
            {
              $row->insurance_provider = $providers[$row->insurance_provider]->name;
            }
            else
            {
              $row->insurance_provider = ''; 
            }
          }
          else
          {
            $row->insurance_provider = ''; 
          }
        }

        if (isset($row->treatment) && $row->treatment)
        {
          $split = explode(',', $row->treatment);
          if (is_array($split) && count($split) > 0)
          {
            $specs_assoc = $this->speciality->get_assoc();

            if (isset($specs_assoc[$split[0]]) && $specs_assoc[$split[0]])
            {
              $new_treatment = array();
              $new_treatment[] = $specs_assoc[$split[0]]->name;

              $treatment_assoc = isset($specs_assoc[$split[0]]->treatment) && is_array($specs_assoc[$split[0]]->treatment) ? $specs_assoc[$split[0]]->treatment : array();

              foreach ($treatment_assoc as $treatment_row)
              {
                if ($treatment_row->code == $split[1])
                {
                  $new_treatment[] = $treatment_row->name;
                }                
              }

              $row->treatment = $new_treatment;

            }

          }

        }

        $result[] = $row;
      }

      return $result;
    }
    else
    {
      return array();
    }
  }

  /**
   *
   */
  public function merge_reservations($arr1, $arr2)
  {
    $hash = array();
   
    $merge = $arr1; 
    foreach ($merge as $row) {
      $hash[$row->id] = true;
    }

    foreach ($arr2 as $row) {
      if (!isset($hash[$row->id]) || !$hash[$row->id]) {
        $hash[$row->id] = true;
        $merge[] = $row;
      }
    }

    return $merge;
  }

  /**
   *
   */
  public function filter_time_room($arr)
  {
    $result = new stdClass();
    $result->day = array();
    $result->workdays = array();
    $result->week = array();
    $result->month = array();
    $result->later = array();
    $result->overview = $arr;

    $time = time();
    $weekday_end = date('N');
    $weekday_end = $weekday_end <=5 ? date('Y-m-d', (5 - $weekday_end) * 86400 + $time) : date('Y-m-d', (12 - $weekday_end) * 86400 + $time);

    foreach ($arr as $row)
    {
      $start_time = strtotime($row->start);
      $start_date = date('Y-m-d', $start_time);

      if (date('Y-m-d') == $start_date)
      {
        array_push($result->day, $row);
      }

      if ($start_date < $weekday_end)
      {
        array_push($result->workdays, $row);
      }

      if ($start_time < $time + 604800)
      {
        array_push($result->week, $row);
      }

      if ($start_time < $time + 2592000)
      {
        array_push($result->month, $row);
      }
      else
      {
        array_push($result->later, $row);
      }
    }

    return $result;
  }

  /**
   *
   */
  public function reservation_action($action = 'read', $toggle = NULL)
  {
    $checked_reservations = $this->input->post('checked_reservation');
    if ($checked_reservations && is_array($checked_reservations))
    {
      foreach ($checked_reservations as $id => $value)
      {
        $this->m->port->b->where('id', $id);
        if ($toggle === NULL)
        {
          $this->m->port->b->set($action, '1 - '.$action, FALSE);
        }
        else
        {
          $this->m->port->b->set($action, $toggle ? 1 : 0);
        }

        $this->m->port->b->limit(1);
        $this->m->port->b->db_select();
        $this->m->port->b->update('reservations');
      }
    }
  }

  /**
   *
   */
  public function get_data($email)
  {
    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('doctors', array ('email' => $email,) );
    $result_row   = $result->row(); 
    $user_result['regid'] = $result_row->regid;
    $user_result['p1_userid'] = $result_row->p1_userid;
    $user_result['name'] = $result_row->name;
    $user_result['surname'] = $result_row->surname;
    $user_result['gender'] = $result_row->gender;
    $user_result['pin'] = $result_row->pin;
    $user_result['confirm_code'] = $result_row->confirm_code;
    $user_result['temp_pass'] = $result_row->temp_pass;
    $user_result['email'] = $result_row->email;
    
    return $user_result;
  }


  /**
   *
   */
  public function doctor_validate_email($email,$email_code)  {

    $this->m->port->p->db_select();
    $result = $this->m->port->p->get_where('doctors', array ('email' => $email,'confirm_code' => $email_code,) );
            
    if ($result->num_rows() === 1) {
      $this->m->port->p->set('confirm_status', 1);
      $this->m->port->p->where('email', $email);
      $this->m->port->p->update('doctors');

      return TRUE;
    }

    else {
      return FALSE;
    }
  } 


  /**
   *
   */
  public function pass_reset_validation($email)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->set('confirm_code'  , $confirm_code = random_string('alnum', 16) );
    $this->m->port->p->set('temp_pass'  , $temp_pass = random_string('alnum', 16) );
    $this->m->port->p->where('email', $email);

    if ($this->m->port->p->update('doctors')) {
      return TRUE;
    }

    else{
      return FALSE;
    }
  }


  /**
   *
   */
  public function set_new_password()
  {

    $email           = $this->input->post('email');
    $password_old    = $this->input->post('password3');
    $password_new    = $this->input->post('password');
    $password_repeat = $this->input->post('password2');

    if ($password_new !== $password_repeat)
    {
      return FALSE;
    }

    $this->m->port->p->db_select();
    $query = $this->m->port->p->get_where('doctors', array('email' => $email, 'temp_pass' => $password_old, ), 1);
    
    if ($query->num_rows() <= 0)
    {
      return FALSE;
    }

    $this->m->port->p->set('password', md5($password_new));
    $this->m->port->p->set('temp_pass', '' );
    $this->m->port->p->where('email', $email);
    $this->m->port->p->update('doctors');
    return TRUE;
  }


  /**
   *
   */
  public function email_reset_validation($email)
  {
    $this->m->port->p->db_select();
    $this->m->port->p->set('confirm_code'  , $confirm_code = random_string('alnum', 16) );
    //$this->m->port->p->set('temp_pass'  , $temp_pass = random_string('alnum', 16) );
    $this->m->port->p->where('email', $email);

    if ($this->m->port->p->update('doctors')) {
      return TRUE;
    }

    else{
      return FALSE;
    }
  }

  /**
   * Termine Legacy updates
   */
  public function profile_update($id, $update_params)
  {
    if (!$this->m->db_where('p', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->m->port->p->limit(1);

    $this->m->db_set('p', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->p->db_select();
    return $this->m->port->p->update('doctors');
  }

  /**
   * SA103 update
   */
  public function update_records($id,$update_data)
  {
    $this->m->port->p->db_select();
    return $this->m->port->p->update('doctors',$update_data,$id);
  }


  /**
   *
   */
  public function photo_update($id, $update_params)
  {
    if (!$this->m->db_where('p', $id, self::$encrypted_fields, array()))
    {
      return FALSE;
    }

    $this->m->port->p->limit(1);

    $this->m->db_set('p', $update_params, self::$plain_fields, self::$datetime_fields, self::$encrypted_fields);

    $this->m->port->p->db_select();
    return $this->m->port->p->update('doctors');
  }

  /**
   *
   */
  public function get_upload_path($row, $role = "doctor")
  {
    return './protected/uploads/profile_image/'.trim($role, '/').'/'.bin2hex($this->aes_encrypt->en($row->patient_id)).'/';
  }

  /**
   *
   */
  public function image_upload($id, $role = "doctor", $upload_field = "document_upload")
  {
    $config = array();

    $config['upload_path'] = './protected/uploads/profile_image/';
    $config['encrypt_name'] = TRUE;
    $config['allowed_types'] = 'jpg|png|jpeg|tif|gif';
    $config['max_size'] = '2048000';
    $config['remove_spaces'] = true;
    $config['overwrite'] = FALSE;
    $config['max_width']  = '';
    $config['max_height']  = '';

    if (!file_exists($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, true);
    }

    $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
    $this->load->helper('file');
    write_file($config['upload_path'].'index.html', $permission_string);

    
    $this->load->library('upload', $config);
    //$this->upload->initialize($config);
    //echo $id;

    if ($this->upload->do_upload($upload_field))
    {
      //echo "second check";
      $data = $this->upload->data();

      //echo "second check";

      $extension     = str_replace('.', '', $data['file_ext']);
      $file_name     = ($ext_pos = strrpos($data['file_name'], '.'.$extension)) !== FALSE ? substr_replace($data['file_name'], '', $ext_pos, strlen('.'.$extension)) : $data['file_name'];
      $pro_img = $file_name.$data['file_ext'];

      return $this->photo_update($id,array(
        //'id'                 => $id, 
        'profile_image'      => $pro_img, 
      ));

    }
    else
    {
      //echo $this->upload->display_errors();
      $error = (object)array('error' => $this->upload->display_errors());
      return $error;
    }
  }
public function patientdetails($patient_id,$time = NULL, $limit = 15)
  {
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
    $this->load->model('medical_condition/mmedical_condition');
    $this->load->model('diagnosis/mdiagnosis');
    $this->load->model('medication/mmedication');
    $this->load->model('vaccination/mvaccination');
    $this->load->model('graph/mgraph');
    #Here's for conditions
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('document_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $conditions = array_map(function($v) {
          return ($v->feed_type = 'condition') ? $v : $v;
        },$this->mmedical_condition->get(array('patient_id' =>$patient_id, ), TRUE));
    # Here's for diagnosis
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $diagnosis = array_map(function($v) {
    return ($v->feed_type = 'diagnosis') ? $v : $v;
        }, $this->mdiagnosis->get(array('patient_id' =>$patient_id, ), TRUE));
    # Here's for medication
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $medication = array_map(function($v) {
          return ($v->feed_type = 'medication') ? $v : $v;
        }, $this->mmedication->get(array('patient_id' => $patient_id,), TRUE));

        # Here's vaccination
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $vaccination = array_map(function($v) {
          return ($v->feed_type = 'vaccination') ? $v : $v;
        }, $this->mvaccination->get(array('patient_id' => $patient_id,), TRUE));

        # Here's for blood_pressure
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_HEART_FREQUENCY, array('patient_id' => $patient_id,), TRUE);
    $blood_pressure = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_pressure',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for blood_sugar
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $patient_id, ), TRUE);
    $blood_sugar = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_sugar',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for weight_bmi
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $patient_id, ), TRUE);
    $weight_bmi = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'weight_bmi',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for marcumar
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $patient_id, ), TRUE);
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
        $entries = array_merge($entries, $blood_pressure);
        $entries = array_merge($entries, $blood_sugar);
        $entries = array_merge($entries, $weight_bmi);
        $entries = array_merge($entries, $marcumar);
       
       $output = $this->load->view('myprofile/patient_medical_record', array(
             'entries' => $entries,
            'diagnosis' => $diagnosis,
            'medication'=>$medication,
            'vaccination'=>$vaccination,
            'conditions'=>$conditions,
            'blood_pressure'=>$blood_pressure,
            'blood_sugar'=>$blood_sugar,
            'weight_bmi'=>$weight_bmi,
            'marcumar'=>$marcumar,
        ), TRUE);
    return $output;
  }
  /*public function patientdetails($patient_id,$time = NULL, $limit = 15)
  {
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
    $this->load->model('medical_condition/mmedical_condition');
    $this->load->model('diagnosis/mdiagnosis');
    $this->load->model('medication/mmedication');
    $this->load->model('vaccination/mvaccination');
    $this->load->model('graph/mgraph');
    #Here's for conditions
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('document_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $conditions = array_map(function($v) {
          return ($v->feed_type = 'condition') ? $v : $v;
        },$this->mmedical_condition->get(array('patient_id' =>$patient_id, ), TRUE));
    # Here's for diagnosis
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $diagnosis = array_map(function($v) {
    return ($v->feed_type = 'diagnosis') ? $v : $v;
        }, $this->mdiagnosis->get(array('patient_id' =>$patient_id, ), TRUE));
    # Here's for medication
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $medication = array_map(function($v) {
          return ($v->feed_type = 'medication') ? $v : $v;
        }, $this->mmedication->get(array('patient_id' => $patient_id,), TRUE));

        # Here's vaccination
    $this->m->port->m->db_select();
    $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
    $this->m->port->m->limit($limit);
    $vaccination = array_map(function($v) {
          return ($v->feed_type = 'vaccination') ? $v : $v;
        }, $this->mvaccination->get(array('patient_id' => $patient_id,), TRUE));

        # Here's for blood_pressure
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_HEART_FREQUENCY, array('patient_id' => $patient_id,), TRUE);
    $blood_pressure = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_pressure',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for blood_sugar
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $patient_id, ), TRUE);
    $blood_sugar = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'blood_sugar',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for weight_bmi
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $patient_id, ), TRUE);
    $weight_bmi = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'weight_bmi',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

        # Here's for marcumar
    $this->m->port->m->db_select();
    $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
    $this->m->port->m->where('rec_time <=', date('H:i', $time));
    $this->m->port->m->limit($limit);
    $graph_entries = $this->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $patient_id, ), TRUE);
    $marcumar = !empty($graph_entries) ? array( (object) array(
          'feed_type' => 'marcumar',
          'entries' => $graph_entries,
          'id' => 0, 
          'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
        ), ) : array();

    $entries = array();
   
    $output = $this->load->view('access/patient_medical_record', array(
        
            'diagnosis' => $diagnosis,
            'medication'=>$medication,
            'vaccination'=>$vaccination,
            'conditions'=>$conditions,
            'blood_pressure'=>$blood_pressure,
            'blood_sugar'=>$blood_sugar,
            'weight_bmi'=>$weight_bmi,
            'marcumar'=>$marcumar,
        ), TRUE);
    return $output;
  }*/
  
}

/* End of file modoc.php */
/* Location: ./application/models/modoc.php */