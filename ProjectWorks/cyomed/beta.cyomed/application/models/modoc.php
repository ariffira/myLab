<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modoc extends CI_Model {

    const TABLE_HEART_FREQUENCY = 'heart_frequency';
    const TABLE_BLOOD_SUGAR = 'blood_sugar';
    const TABLE_WEIGHT_BMI = 'weight_bmi';
    const TABLE_MARCUMAR = 'marcumar';
    const ERROR_NO_DOCTOR = 'error_no_doctor';
    const ERROR_NO_PATIENT = 'error_no_patient';

    public static $encrypted_fields = array('password', 'confirm_code');
    public static $plain_fields = array('id', 'regid', 'pin', 'name', 'surname', 'academic_grade', 'address', 'prac_address', 'language', 'theme', 'website', 'zip', 'region', 'city', 'country', 'telephone', 'fax', 'mobile', 'email', 'emergency_number', 'specialization1', 'specialization2', 'profile_image', 'additional_title1', 'additional_title2', 'additional_title3', 'uploads', 'confirm_status', 'iconsult_status', 'Dr_approv', 'confirm_code', 'gender',);
    public static $datetime_fields = array('cdate',);
    public $doctor;
    public $pat_id;
    public $patient;
    public $access;
    private $_error = array();

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     *
     */
    public function last_error() {
        return ($c = count($this->_error)) > 0 ? $this->_error[$c - 1] : FALSE;
    }

    /**
     *
     */
    public function get_id($id) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $id,), 1);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->m->port->b->db_select();
            $query = $this->m->port->b->get_where('doctors', array('doctor_id' => $id,), 1);
            if ($query->num_rows() > 0) {
                $native_row = $query->row();
            } else {
                $this->m->port->b->set('is_member', 1);
                $this->m->port->b->set('doctor_id', $row->id);
                $this->m->port->b->set('email', $row->email);
                $this->m->port->b->set('password', $row->password);
                $this->m->port->b->set('title', $row->academic_grade);
                $this->m->port->b->set('first_name', $row->name);
                $this->m->port->b->set('last_name', $row->surname);
                $this->m->port->b->set('telephone', $row->telephone);

                $this->m->port->b->db_select();
                if ($this->m->port->b->insert('doctors')) {
                    $this->m->port->b->db_select();
                    $query = $this->m->port->b->get_where('doctors', array('doctor_id' => $id,), 1);
                    if ($query->num_rows() > 0) {
                        $native_row = $query->row();
                    } else {
                        $native_row = new stdClass();
                    }
                } else {
                    $native_row = new stdClass();
                }
            }

            $row->native = $native_row;

            $this->m->port->b->db_select();
            $query = $this->m->port->b->get_where('doctor_settings', array('doctor_id' => $id,), 1);
            if ($query->num_rows() <= 0) {
                $this->m->port->b->set('doctor_id', $id);
                $this->m->port->b->set('working_days', 5);
                $this->m->port->b->set('working_hours_start','1|-,2|-,3|-,4|-,5|-,6|-,7|-');
                $this->m->port->b->set('working_hours_end', '1|-,2|-,3|-,4|-,5|-,6|-,7|-');
                $this->m->port->b->set('calendar_cell', 15);
                $this->m->port->b->set('termin_default_length', 30);
                $this->m->port->b->set('regular_termin_on', 0);
                $this->m->port->b->set('lunch_start', '12:00:00');
                $this->m->port->b->set('lunch_end', '14:00:00');
                $this->m->port->b->set('private_hours_start', '1|-,2|-,3|-,4|-,5|-,6|-,7|-');
                $this->m->port->b->set('private_hours_end', '1|-,2|-,3|-,4|-,5|-,6|-,7|-');
                $this->m->port->b->set('max_advance_booking','0 days');
                $this->m->port->b->set('min_cancel_before','0 days');

                $this->m->port->b->db_select();
                if ($this->m->port->b->insert('doctor_settings')) {
                    $this->m->port->b->db_select();
                    $query = $this->m->port->b->get_where('doctor_settings', array('doctor_id' => $id,), 1);
                }
            }

            $row->doctor_settings = $query->row();

            $ci = & get_instance();
            $ci->speciality->user_specs($row);
            $ci->language->user_langs($row);

            $row->regular_termins = $this->get_regular_termins($id);

            $row->all_termins = $this->get_all_termins($id);

            $row->unread = $this->get_unread_reservations($id);

            $row->specialization1 = array_filter(array_map(function($item) use ($_ci) {
                        return !empty($item) && array_key_exists($item, $_ci->speciality->get_assoc()) ? $item : NULL;
                    }, explode(',', $row->specialization1)));

            return $row;
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function get_regid($regid) {

        $this->m->port->p->db_select();
        $this->m->port->p->where('regid', $regid);

        $query = $this->m->port->p->get('doctors');

        if ($query->num_rows() > 0) {
            return $this->get_id($query->row()->id);
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function get_all() {
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
    public function getTerminDoc($conditions) {
        $ret = array();

        $cond = "1";
        // if (isset($conditions['location']) && $conditions['location'] != '') {
        //     $loc = trim($conditions['location']);
        //     $cond.=" and city like '%$loc%'";
        // }

        if (isset($conditions['specialty']) && $conditions['specialty'] != '') {
            $spec = $conditions['specialty'];
            //$cond.=" and find_in_set($spec,specialization1)";
        }
        if ($conditions['specialty'] == '' && $conditions['location'] == '') {
            return $ret;
        }
        $this->m->port->p->db_select();
        $this->m->port->p->select('id', 'regid', 'name', 'surname', 'gender', 'academic_grade', 'address', 'city', 'zip', 'region', 'country', 'email', 'telephone', 'fax', 'mobile', 'website', 'specialization1', 'prac_address');
        $this->m->port->p->where("find_in_set('$spec',specialization1)!=",0);
        $query = $this->m->port->p->get('doctors');
        //$query = $this->m->port->p->query("select * from doctors where $cond");
        
        if ($query->num_rows() > 0) {
            $k=0;
            foreach ($query->result() as $row) {
                $ret[$k]                    = $this->get_id($row->id);
                // $appointment                = $this->getTerminAppointment($row->id);
                // $ret[$k]->setting           = $setting;
                // $ret[$k]->reservations      = $reservations;
                // $ret[$k]->doc_appointment   = $appointment;
                $k++;
            }
          
        }

        return $ret;
    }

    public function getTerminAppointment($doctor_id) {
        $ret = array();

     
        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termins', array('doctor_id' => $doctor_id, 'date(start)>=' => date('Y-m-d'),));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $ret[] = $row->start;
            }
        }

        return $ret;
    }
    
    /**
     *
     */
    public function get_approved() {
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
    public function select($patient_id) {
        $patient = $this->mopat->get_id($patient_id);

        if ($patient && !empty($patient->id) && !empty($patient->regid)) {
            $this->session->set_userdata('selected_id', $this->encrypt->encode($patient->id));
            $this->session->set_userdata('selected_regid', $this->encrypt->encode($patient->regid));
        }

        $this->m->login_check();

        return $this->m->us();
    }

    /**
     *
     */
    public function select_regid($regid) {

        $patient = $this->mopat->get_regid($regid);
        if ($patient) {
            return $this->select($patient->id);
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function get_patients($doctor_id = NULL, $regid = NULL) {
        if ($doctor_id === NULL) {
            if ($this->m->user_role() == M::ROLE_DOCTOR) {
                $doctor_id = $this->m->user_id();
            } else {
                return array();
            }
        }
        #Get my doctors
        $this->m->port->p->select("`p`.`name`, p.`dob`,`p`.`surname`, `p`.`city`, `p`.`regid`, `myd`.`id`, `myd`.`access_rights`", FALSE);
        $this->m->port->p->from("my_doctors AS myd");
        $this->m->port->p->join("patients AS p", "myd.patient_id = p.id", 'inner');
        $this->m->port->p->where("myd.access_rights", 1);
        $this->m->port->p->where("myd.doctor_inserted_id", $doctor_id);
        if (!empty($regid)) {
            $this->m->port->p->where("myd.patient_id", $regid);
        }
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get();

        return $query->result();
    }

    public function get_patientdetailbyname($doctor_id = NULL, $regid = NULL) {
        if ($doctor_id === NULL) {
            if ($this->m->user_role() == M::ROLE_DOCTOR) {
                $doctor_id = $this->m->user_id();
            } else {
                return array();
            }
        }
        #Get my doctors
        /*  $this->m->port->p->select("`p`.`name`, p.`dob`,`p`.`surname`, `p`.`city`, `p`.`regid`, `myd`.`id`, `myd`.`access_rights`", FALSE);
          $this->m->port->p->from("my_doctors AS myd");
          $this->m->port->p->join("patients AS p", "myd.patient_id = p.id", 'inner');
          $this->m->port->p->where("myd.access_rights",1);
          $this->m->port->p->where("myd.doctor_inserted_id", $doctor_id);
          if(!empty($regid))
          {
          $this->m->port->p->where("p.regid",$regid);
          $this->m->port->p->or_where('p.name',$regid);
          } */
         $this->m->port->p->db_select();
        $this->m->port->p->select("`p`.`name`, p.`dob`,`p`.`surname`, `p`.`city`, `p`.`regid`,", FALSE);
        $this->m->port->p->from("patients AS p");
        if (!empty($regid)) {
            /*$this->m->port->p->like('p.name', $regid);
            $this->m->port->p->or_like('p.surname', $regid);*/
            $this->m->port->p->or_like("p.regid", $regid);
            $this->m->port->p->or_like("lower(CONCAT(name, ' ', surname))", strtolower($regid));
            
        }
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get();
        
        return $query->result();
    }

    public function get_patientdetail($reg_id) {
        $doctor_id = $this->m->user_id();
        # Get my doctors
        /* $this->m->port->p->select("`p`.`name`,`p`.`id`,`p`.`dob`,`p`.`email`,`p`.`mobile`,`p`.`telephone`,`p`.`surname`, `p`.`city`, `p`.`regid`", FALSE);
          $this->m->port->p->from("patients AS p");
          $this->m->port->p->join("my_doctors AS myd", "myd.patient_id = p.id", 'inner');
          $this->m->port->p->where("p.regid", $reg_id);
          $this->m->port->p->where("myd.doctor_inserted_id", $doctor_id);
          $this->m->port->p->db_select();
          $query = $this->m->port->p->get(); */
        $this->m->port->p->select("`p`.`name`,`p`.`id`,`p`.`dob`,`p`.`email`,`p`.`mobile`,`p`.`telephone`,`p`.`surname`, `p`.`city`, `p`.`regid`", FALSE);
        $this->m->port->p->from("patients AS p");
        $this->m->port->p->where("p.regid", $reg_id);
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get();

        return $query->result();
    }

    /**
     *
     */
    public function update_profile() {
        $title = $this->input->post('title');
        $gender = $this->input->post('gender');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $postal_code = $this->input->post('postal_code');
        $locality = ucfirst($this->input->post('locality'));
        $street = $this->input->post('street');
        $street_additional = $this->input->post('street_additional');
        $coordinate_lat = $this->input->post('coordinate_lat');
        $coordinate_lng = $this->input->post('coordinate_lng');
        $telephone = $this->input->post('telephone');
        $website = $this->input->post('website');
        $speciality = $this->input->post('speciality') && is_array($this->input->post('speciality')) ? implode(',', $this->input->post('speciality')) : '';
        $languages = $this->input->post('languages') && is_array($this->input->post('languages')) ? implode(',', $this->input->post('languages')) : '';
        $insurance_private = set_checkbox('insurance[]', '1') ? '1' : '';
        $insurance_public = set_checkbox('insurance[]', '2') ? '1' : '';
        $must_feedback = $this->input->post('must_feedback');
        $text_description = $this->input->post('text_description');
        $text_vet = $this->input->post('text_vet');
        $text_more_for_patient = $this->input->post('text_more_for_patient');
        $text_membership = $this->input->post('text_membership');
        $text_hospital_occupancy = $this->input->post('text_hospital_occupancy');

        $upload_result = $this->do_upload('avatar');

        $this->m->port->b->set('title', $title);
        $this->m->port->b->set('gender', $gender);
        $this->m->port->b->set('first_name', $first_name);
        $this->m->port->b->set('last_name', $last_name);
        $this->m->port->b->set('email', $email);
        $this->m->port->b->set('postal_code', $postal_code);
        $this->m->port->b->set('locality', $locality);
        $this->m->port->b->set('street', $street);
        $this->m->port->b->set('street_additional', $street_additional);
        $this->m->port->b->set('coordinate_lat', $coordinate_lat);
        $this->m->port->b->set('coordinate_lng', $coordinate_lng);
        $this->m->port->b->set('telephone', $telephone);
        $this->m->port->b->set('website', $website);
        $this->m->port->b->set('speciality', $speciality);
        $this->m->port->b->set('languages', $languages);
        $this->m->port->b->set('insurance_private', $insurance_private);
        $this->m->port->b->set('insurance_public', $insurance_public);
        $this->m->port->b->set('must_feedback', $must_feedback);
        $this->m->port->b->set('text_description', $text_description);
        $this->m->port->b->set('text_vet', $text_vet);
        $this->m->port->b->set('text_more_for_patient', $text_more_for_patient);
        $this->m->port->b->set('text_membership', $text_membership);
        $this->m->port->b->set('text_hospital_occupancy', $text_hospital_occupancy);

        if ($upload_result) {
            $this->m->port->b->set('avatar', base_url($upload_result['upload_path'] . $upload_result['file_name']));
        }

        $this->m->port->b->where('doctor_id', $this->m->user_id());

        $this->m->port->b->db_select();
        $this->m->port->b->update('doctors');

        $this->m->port->p->set('academic_grade', $title);
        $this->m->port->p->set('gender', $gender);
        $this->m->port->p->set('name', $first_name);
        $this->m->port->p->set('surname', $last_name);
        $this->m->port->p->set('email', $email);
        $this->m->port->p->set('zip', $postal_code);
        $this->m->port->p->set('city', $locality);
        $this->m->port->p->set('address', $street);
        $this->m->port->p->set('telephone', $telephone);
        $this->m->port->p->set('website', $website);

        $this->m->port->p->where('id', $this->m->user_id());

        return $this->m->port->p->update('doctors');
    }

    /**
     *
     */
    public function do_upload($type = 'general') {
        $config = array();

        $config['upload_path'] = './assets/uploads/doctor/' . md5($this->m->user_id()) . '/' . trim($type, '/') . '/';
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
        write_file($config['upload_path'] . 'index.html', $permission_string);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($type)) {
            return (($data = $this->upload->data()) && ($data['upload_path'] = $config['upload_path'])) ? $data : $this->upload->data();
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function get_regular_termins($doctor_id) {
        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termins', array('doctor_id' => $doctor_id, 'repetitive' => 1,));

        return $result = ($query->num_rows() > 0 ? $query->result() : array());
    }

    /**
     *
     */
    public function get_all_termins($doctor_id) {
        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termins', array('doctor_id' => $doctor_id,));

        return $result = ($query->num_rows() > 0 ? $query->result() : array());
    }

    /**
     *
     */
    public function get_display_termins($doctor_id, $show_private = TRUE, $show_public = TRUE) {
        
    }

    /**
     *
     */
    public function update_termin($id = NULL) {
        if ($id === NULL) {
            $id = $this->input->post('id');
        }
        if (!is_numeric($id)) {
            return;
        }

        $this->m->port->b->where('id', $id);
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->limit(1);

        if ($this->input->post('insurance') && is_array($this->input->post('insurance'))) {
            if (in_array('1', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_private', 1);
            } else {
                $this->m->port->b->set('insurance_private', 0);
            }

            if (in_array('2', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_public', 1);
            } else {
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

        if ($this->input->post('start_picker') || $this->input->post('end_picker')) {
            $this->update_termin_time($id);
        }
    }

    /**
     *
     */
    public function update_termin_time($id = NULL) {
        if ($id === NULL) {
            $id = $this->input->post('id');
        }
        if (!is_numeric($id)) {
            return;
        }

        $this->m->port->b->where('id', $id);
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->limit(1);
        $query = $this->m->port->b->get('doctor_termins');
        if ($query->num_rows() <= 0) {
            return;
        }
        $old = $query->row();

        $this->m->port->b->where('id', $id);
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->limit(1);

        $start = $this->input->post('start_picker');
        $end = $this->input->post('end_picker');

        if (!$start || !$end) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
        }

        if ($start && $end) {
            $val_start = strtotime($start);
            $val_end = strtotime($end);

            if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1) {
                $this->m->port->b->set('start', $start);
                $this->m->port->b->set('end', $end);

                if ($day = @date('N', $val_start)) {
                    $this->m->port->b->set('day', $day);
                } else {
                    return;
                }
            } else {
                return;
            }
        } else {
            return;
        }

        $this->m->port->b->db_select();
        $this->m->port->b->update('doctor_termins');

        $diff = $val_start - strtotime($old->start);

        $this->m->port->b->set('start', 'start + INTERVAL ' . $diff . ' SECOND', FALSE);
        $this->m->port->b->set('end', 'end + INTERVAL ' . $diff . ' SECOND', FALSE);
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
    public function insert_termin() {

        $this->m->port->b->set('doctor_id', $this->m->user_id());

        if (($start = $this->input->post('start')) && ($end = $this->input->post('end'))) {
            $val_start = strtotime($start);
            $val_end = strtotime($end);

            if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1) {
                $this->m->port->b->set('start', $start);
                $this->m->port->b->set('end', $end);

                if ($day = @date('N', $val_start)) {
                    $this->m->port->b->set('day', $day);
                }
            }
        }

        if ($this->input->post('insurance') && is_array($this->input->post('insurance'))) {
            if (in_array('1', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_private', 1);
            } else {
                $this->m->port->b->set('insurance_private', 0);
            }

            if (in_array('2', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_public', 1);
            } else {
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
    public function mask_termin($id = NULL) {
        // Original Termin query

        if ($id === NULL) {
            $id = $this->input->post('id');
        }
        if (!is_numeric($id)) {
            return;
        }

        $this->m->port->b->where('id', $id);
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->limit(1);
        $query = $this->m->port->b->get('doctor_termins');

        if ($query->num_rows() > 0) {
            $row = $query->row();
        } else {
            return;
        }

        // Create mask Termin    

        if (($start = $this->input->post('start')) && ($end = $this->input->post('end'))) {
            $val_start = strtotime($start);
            $val_end = strtotime($end);

            if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1) {
                $this->m->port->b->set('start', $start);
                $this->m->port->b->set('end', $end);

                if ($day = @date('N', $val_start)) {
                    $this->m->port->b->set('day', $day);
                }
            } else {
                return;
            }
        } else {
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

        if ($this->input->post('start_picker') != $start || $this->input->post('end_picker') != $end) {
            $start = $this->input->post('start_picker');
            $end = $this->input->post('end_picker');

            $val_start = strtotime($start);
            $val_end = strtotime($end);

            if ($val_start !== FALSE && $val_start !== -1 && $val_end !== FALSE && $val_end !== -1) {
                $this->m->port->b->set('start', $start);
                $this->m->port->b->set('end', $end);

                if ($day = @date('N', $val_start)) {
                    $this->m->port->b->set('day', $day);
                }
            } else {
                return;
            }
        } else {
            $this->m->port->b->set('start', $start);
            $this->m->port->b->set('end', $end);
            $this->m->port->b->set('day', $day);
        }

        $this->m->port->b->set('doctor_id', $this->m->user_id());

        if ($this->input->post('insurance') && is_array($this->input->post('insurance'))) {
            if (in_array('1', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_private', 1);
            } else {
                $this->m->port->b->set('insurance_private', 0);
            }

            if (in_array('2', $this->input->post('insurance'))) {
                $this->m->port->b->set('insurance_public', 1);
            } else {
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
    public function update_regular_termins() {
        $this->m->port->b->set('regular_termin_on', $this->input->post('regular_termin_on'));
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->db_select();
        $this->m->port->b->update('doctor_settings');
        $time = time();
        $weekday = date('N', $time);

        for ($day = 1; $day < 29; $day++) {
            if ($this->input->post('regular_termins_count') && is_array($this->input->post('regular_termins_count')) && $this->input->post('regular_termins_count')[$day]) {
                
            } else {
                $this->m->port->b->where('doctor_id', $this->m->user_id());
                $this->m->port->b->where('day', $day);
                $this->m->port->b->db_select();
                $this->m->port->b->delete('doctor_termins');
            }

            if ($this->input->post('regular_termins_added') && is_array($this->input->post('regular_termins_added')) && $this->input->post('regular_termins_added')[$day]) {
                if ($this->input->post('added_termin_start') && is_array($this->input->post('added_termin_start')) && $this->input->post('added_termin_start')[$day]) {
                    $day_index = $day - 1;
                    foreach ($this->input->post('added_termin_start')[$day] as $key => $value) {

                        if ($end = $this->input->post('added_termin_end')[$day][$key]) {

                            //$date = date('Y-m-d', $time + ($day >= $weekday ? $day - $weekday : $day + 7 - $weekday) * 86400);

                            $date = date('Y-m-d', strtotime("+$day_index days"));

                            $start_datetime = $date . ' ' . $value . ':00';
                            // $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime) + $end * 60);
                            $end_datetime = $date . ' ' . $end . ':00';

                            $val_start = strtotime($start_datetime);
                            $val_end = strtotime($end_datetime);

                            if ($val_start === FALSE || $val_start === -1 || $val_end === FALSE || $val_end === -1) {
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
                if ($end = $this->input->post('termin_end')[$key]) {

                    $this->m->port->b->where('id', $key);
                    $this->m->port->b->where('doctor_id', $this->m->user_id());
                    $this->m->port->b->limit(1);
                    $query = $this->m->port->b->get('doctor_termins');

                    if ($query->num_rows() <= 0) {
                        continue;
                    }

                    $row = $query->row();

                    $date = date('Y-m-d', strtotime($row->start));
                    $start_datetime = $date . ' ' . $value . ':00';
                    // $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime) + $end * 60);
                    $end_datetime = $date . ' ' . $end . ':00';

                    $val_start = strtotime($start_datetime);
                    $val_end = strtotime($end_datetime);

                    if ($val_start === FALSE || $val_start === -1 || $val_end === FALSE || $val_end === -1) {
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
    public function delete_regular_termin($id = NULL) {
        if ($id === NULL) {
            $id = $this->input->post('id');
        }

        if (!$id) {
            $id = $this->input->get('id');
        }

        if (!$id || !is_numeric($id)) {
            return FALSE;
        }

        $this->m->port->b->where('id', $id);
        $this->m->port->b->where('doctor_id', $this->m->user_id());
        $this->m->port->b->db_select();
        return $this->m->port->b->delete('doctor_termins');
    }

    /**
     * update general settings from doctor settings table called from doctor/settings.php from profile genral page
     * @return [type] none
     */
    public function update_general_settings($update_variables){
        $this->m->port->b->where('doctor_id',$this->m->user_id());
        $this->m->port->b->update('doctor_settings',$update_variables);
    }

    /**
     * update doctor settings table on doctor update the practice openning times
     * @param  [type] $update_variables [variables to be updated]
     * @return [type]                   [none, call another function to create termin in doctor termin table]
     */
    public function update_doctor_settings($update_variables){
        $this->m->port->b->where('doctor_id',$this->m->user_id());
        $this->m->port->b->update('doctor_settings',$update_variables);
        $this->update_regular_termins_for_doctor($this->m->user_id());
    }


    /**
     * function is called when doctor update the opening times settings from profile view page
     * @param  $doctorid [doctor id]
     * @return [type]    none only create termins on doctor termins table for automatic appointments
     */
    public function update_regular_termins_for_doctor($doctorid){
        $query = $this->m->port->b->get_where('doctor_termins',array('doctor_id'=>$doctorid,'auto_termin'=>1));
        if($query->num_rows()>0){
            $this->m->port->b->delete('doctor_termins',array('doctor_id'=>$doctorid,'auto_termin'=>1));
        }
        for($i=0;$i<7;$i++){
            $date = date("Y-m-d");
            $date = date("Y-m-d H:i:s", strtotime($date. '+'.$i.'days'));
            $calendar_settings = $this->get_termins_for_doctor($doctorid,$date);
            

            foreach ($calendar_settings as $row) {
                $temp['doctor_id'] = $doctorid;
                $temp['ready'] = 1;
                $temp['repetitive'] = 1;
                $temp['mask'] = 0;
                $temp['mask_event_id'] = 0;
                $temp['allday'] = 0;
                $temp['period'] = 7;
                $temp['day'] = date('N',strtotime($date));
                $temp['insurance_private'] = $row['insurance_private'];
                $temp['insurance_public'] = $row['insurance_public'];
                $temp['start'] = $row['start'];
                $temp['end'] = $row['end'];
                $temp['text_patient'] = '';
                $temp['text_notes'] = '';
                $temp['auto_termin'] = 1;  //1 denotes automatically created termin
                $this->m->port->b->insert('doctor_termins',$temp);
            }
        }
        //find the masked termins from the doctor termins from future time and update with the new calendar setting
        $mask_query = $this->m->port->b->get_where('doctor_termins',array('doctor_id'=>$doctorid,'mask'=>1,'start >'=>date('Y-m-d')));
        // echo ($this->m->port->b->last_query());
        // echo '<br>';
        if($mask_query->num_rows() > 0){
            foreach ($mask_query->result() as $mask_row) {
                $this->m->port->b->where(array('doctor_id'=>$doctorid,'auto_termin'=>1,'day'=>$mask_row->day));
                $this->m->port->b->where("time(start) BETWEEN '".date("H:i:s",strtotime($mask_row->start))."' AND '".date("H:i:s",strtotime($mask_row->end))."'");
                $this->m->port->b->where(array('time(start) !='=> date("H:i:s",strtotime($mask_row->end)),));
                $this->m->port->b->or_where("time(end) BETWEEN '".date("H:i:s",strtotime($mask_row->start))."' AND '".date("H:i:s",strtotime($mask_row->end))."'");
                $this->m->port->b->where(array('doctor_id'=>$doctorid,'auto_termin'=>1,'day'=>$mask_row->day));
                $this->m->port->b->where(array('time(end) !='=> date("H:i:s",strtotime($mask_row->start)),));
                //$new_event = $this->m->port->b->get_where('doctor_termins',array('doctor_id'=>$doctorid,'auto_termin'=>1,'start >=' => $mask_row->start,'end <='=>$mask_row->end));
                $new_event = $this->m->port->b->get('doctor_termins');
                // echo ($this->m->port->b->last_query());
                // echo '<br>';
                if($new_event->num_rows()>0){
                    foreach ($new_event->result() as $event_row) {
                        $new_mask_event['doctor_id'] = $doctorid;
                        $new_mask_event['ready'] = 1;
                        $new_mask_event['repetitive'] = 0;
                        $new_mask_event['mask'] = 1;
                        $new_mask_event['mask_event_id'] = $event_row->id;
                        $new_mask_event['allday'] = 0;
                        $new_mask_event['period'] = 7;
                        $new_mask_event['day'] = $mask_row->day;
                        $new_mask_event['insurance_private'] = $mask_row->insurance_private;
                        $new_mask_event['insurance_public'] = $mask_row->insurance_public;
                        $new_mask_event['start'] = date("Y-m-d",strtotime($mask_row->start)).' '.date("H:i:s",strtotime($event_row->start));
                        $new_mask_event['end'] = date("Y-m-d",strtotime($mask_row->start)).' '.date("H:i:s",strtotime($event_row->end));
                        $new_mask_event['text_patient'] = '';
                        $new_mask_event['text_notes'] = '';
                        $new_mask_event['auto_termin'] = 0;  //1 denotes automatically created termin
                        $this->m->port->b->insert('doctor_termins',$new_mask_event);
                        // die($this->m->port->b->last_query());
                    }
                }
                $this->m->port->b->delete('doctor_termins',array('id'=>$mask_row->id));
            }
        }
    }


    /**
    *get the doctor calendar settings
    */
    public function get_doctor_settings($id){
        $calendar_setting = array();
        $start_time = array();
        $end_time = array();
        $pr_start_time = array();
        $pr_end_time = array();
        $doctor_settings = $this->m->port->b->get_where('doctor_settings',array('doctor_id'=>$id,));
        if($doctor_settings->num_rows()>0){
            foreach ($doctor_settings->result() as $row) {
                //$calendar_setting['working_days'] = $row->working_days;
                $working_hours_start= explode(",", $row->working_hours_start);
                //making a array of days 
                foreach($working_hours_start as $day){
                  $temp                = explode("|", $day);
                  $temp1['day']        = $temp[0];
                  $temp1['start_time'] = $temp[1];
                  array_push($start_time, $temp1);
                }
                $calendar_setting['working_hours_start'] = $start_time;
                
                $working_hours_end = explode(",", $row->working_hours_end);
                foreach($working_hours_end as $day){
                  $temp              = explode("|", $day);
                  $temp2['day']      = $temp[0];
                  $temp2['end_time'] = $temp[1];
                  array_push($end_time, $temp2);
                }
                
                $calendar_setting['working_hours_end'] = $end_time;

                $private_hours_start = explode(",", $row->private_hours_start);
                foreach($private_hours_start as $day){
                  $temp                = explode("|", $day);
                  $temp4['day']        = $temp[0];
                  $temp4['start_time'] = $temp[1];
                  array_push($pr_start_time, $temp4);
                }

                $calendar_setting['private_hours_start'] = $pr_start_time;

                $private_hours_end = explode(",", $row->private_hours_end);
                foreach($private_hours_end as $day){
                  $temp              = explode("|", $day);
                  $temp3['day']      = $temp[0];
                  $temp3['end_time'] = $temp[1];
                  array_push($pr_end_time, $temp3);
                }
                $calendar_setting['private_hours_end']     = $pr_end_time;
                
                //$calendar_setting['calendar_cell']       = $row->calendar_cell;
                $calendar_setting['termin_default_length'] = $row->termin_default_length;
                //$calendar_setting['regular_termin_on']   = $row->regular_termin_on;
                $calendar_setting['lunch_start']           = date('H:i', strtotime($row->lunch_start));
                $calendar_setting['lunch_end']             = date('H:i', strtotime($row->lunch_end));
                $calendar_setting['max_advance_booking']   = $row->max_advance_booking;
                $calendar_setting['min_cancel_before']     = $row->min_cancel_before;
            }
        }

        return $calendar_setting;
    }


    public function get_max_advance_booking($doctor_id){
        $this->m->port->b->select('max_advance_booking');
        $query = $this->m->port->b->get_where('doctor_settings',array('doctor_id'=>$doctor_id,));
        if($query->num_rows()>0){
            return $query->row()->max_advance_booking;
        }else{
            return 365;//default max advance booking
        }
    }

    /**
     * returns array of termins according to doctor settings table
     * @param  [type] $doctorid [description]
     * 
     * @return [array] retuns array of time slots created according to doctor calendar settings
     */
    //public function get_termins_for_doctor($doctorid,$starttime,$insurance_type){
    public function get_termins_for_doctor($doctorid,$starttime){
        $calendar_setting = $this->get_doctor_settings($doctorid);
        //$doctor_termins = $this->get_date_reservations($doctorid,$starttime);
        $day              = date('N', strtotime($starttime));
        $opening_time     = null;
        $end_time         = null;
        $pr_start_time    = null;
        $pr_end_time      = null;

        foreach ($calendar_setting['working_hours_start'] as $selected) {
            if($selected['day'] == $day){
                $opening_time = $selected['start_time'];
            }
        }
        foreach ($calendar_setting['working_hours_end'] as $selected) {
            if($selected['day'] == $day){
                $end_time = $selected['end_time'];
            }
        }

        foreach ($calendar_setting['private_hours_start'] as $selected) {
            if($selected['day'] == $day){
                $pr_start_time = $selected['start_time'];
            }
        }

        foreach ($calendar_setting['private_hours_end'] as $selected) {
            if($selected['day'] == $day){
                $pr_end_time = $selected['end_time'];
            }
        }

        //'-' is for the closed days
        if($opening_time !== null && $opening_time != '-'){
            $openhrs = explode(":", $opening_time);
        }else{
            return array();
        }

    
        $starttime = strtotime($starttime);
        $date      =  date("Y-m-d", $starttime);
        
        
        $opening_time = strtotime($date.' '.$opening_time.':00');
        
        $end_time = strtotime($date.' '.$end_time.':00');
       
        if($pr_start_time !== null && $pr_start_time != '-'){
            $pr_start_time = strtotime($date.' '.$pr_start_time.':00');
            $pr_end_time   = strtotime($date.' '.$pr_end_time.':00');
        }
        
        
        $lunch_start = strtotime($date.' '.$calendar_setting['lunch_start']);
        $lunch_end   = strtotime($date.' '.$calendar_setting['lunch_end']);
        
        $appointment_length = $calendar_setting['termin_default_length'];
        
        if($opening_time > $starttime){
            $starttime = $opening_time;
        }else{
            while($starttime>$opening_time){
                $opening_time = strtotime('+'.$appointment_length.'minutes',$opening_time);
            }
            $starttime = $opening_time;
        }




        $termins = array();
        $temp = array();

        while($end_time > $starttime){
            $starttime = $starttime != $lunch_start ? $starttime : $lunch_end;
            // if($insurance_type == 'public' && $pr_start_time !== null && $pr_start_time != '-'){
            //     $starttime = $starttime != $pr_start_time ? $starttime : $pr_end_time;
            //     if($starttime == $end_time){
            //         break;
            //     }
            // }
            if($starttime>=$pr_start_time && $starttime < $pr_end_time){
                $temp['insurance_private'] = 1;
                $temp['insurance_public'] = 0;
            }else{
                $temp['insurance_private'] = 1;
                $temp['insurance_public'] = 1;
            }
            $temp['start'] = date("Y-m-d H:i", $starttime);
            $end           = strtotime('+'.$appointment_length.'minutes',$starttime);
            if($starttime < $lunch_start && $end > $lunch_start){
                $end = $lunch_start;
            }else if($starttime > $lunch_end && $end > $end_time){
                $end = $end_time;
            }
            $temp['end']   =  date("Y-m-d H:i", $end);
            array_push($termins, $temp);
            //array_push($termins, (object)$temp);
            $starttime = $end;
        }

        return $termins;

    }


    /**
     *
     */
    public function reserve() {
        if ($this->input->post('start_time') != '') {
            $start = $this->input->post('start') . ' ' . $this->input->post('start_time');
            $start = date('Y-m-d H:i', strtotime($start));
        } else {
            $start = $this->input->post('start');
            $start = date('Y-m-d H:i', strtotime($start));
        }
        if ($this->input->post('end_time') != '') {
            $end = $this->input->post('end') . ' ' . $this->input->post('end_time');
            $end = date('Y-m-d H:i', strtotime($end));
        } else {
            $end = $this->input->post('end');
            $end = date('Y-m-d H:i', strtotime($end));
        }

        $doctor_id = $this->input->post('doctor_id');
        $termin_id = $this->input->post('terminid');
        $user_id = $this->input->post('user_id');
        $gender = $this->input->post('gender');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email'); //patient
        $telephone = $this->input->post('telephone');
        $insurance = $this->input->post('insurance');
        $insurance_provider = $this->input->post('insurance_provider');
        if ($insurance_provider && is_array($insurance_provider))
            $insurance_provider = implode(',', $insurance_provider);
        $treatment = $this->input->post('treatment');
        $patient_notes = $this->input->post('patient_notes');
        $return_visitor = $this->input->post('returning_visitor') ? 1 : 0;

        if (!$doctor_id) {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $doctor_id,), 1);
        if ($query->num_rows() > 0) {
            $doctor_row = $query->row();
        } else {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->b->set('doctor_id', $doctor_id);

        if ($user_id) {
            $this->m->port->p->db_select();
            $this->m->port->p->db_select();
            $query = $this->m->port->p->get_where('patients', array('id' => $user_id,), 1);
            if ($query->num_rows() > 0) {
                $patient_row = $query->row();

                $this->m->port->b->set('patient_id', $patient_row->id);
                $this->m->port->b->set('gender', $patient_row->gender);
                $this->m->port->b->set('first_name', $patient_row->name);
                $this->m->port->b->set('last_name', $patient_row->surname);
                $this->m->port->b->set('email', $patient_row->email);
                $this->m->port->b->set('telephone', $patient_row->telephone);
                $this->m->port->b->set('insurance', $insurance);
                $this->m->port->b->set('insurance_provider', $insurance_provider);
            } else {
                return ($this->_error[] = self::ERROR_NO_PATIENT) ? FALSE : FALSE;
            }
        } else {
            $this->m->port->b->set('patient_id', $user_id);
            $this->m->port->b->set('gender', $gender);
            $this->m->port->b->set('first_name', $first_name);
            $this->m->port->b->set('last_name', $last_name);
            $this->m->port->b->set('email', $email);
            $this->m->port->b->set('telephone', $telephone);
            $this->m->port->b->set('insurance', $insurance);
            $this->m->port->b->set('insurance_provider', $insurance_provider);
        }

        $val_start = strtotime($start);

        if ($val_start !== FALSE && $val_start !== -1) {
            $this->m->port->b->set('start', $start);
            // $this->m->port->b->set('end', $end);
        } else {
            return ($this->_error[] = Mod::ERROR_DATE_INVALID) ? FALSE : FALSE;
        }
        $this->m->port->b->set('end', $end);
        $this->m->port->b->set('termin_id', $termin_id);
        $this->m->port->b->set('treatment', $treatment);
        $this->m->port->b->set('return_visitor', $return_visitor);
        $this->m->port->b->set('text_patient_notes', $patient_notes);

        $this->m->port->b->db_select();
        $result = $this->m->port->b->insert('reservations');
        $last_id = $this->m->port->b->insert_id(); //last reservation id
        $reserve_query = $this->m->port->b->get_where('reservations', array('id' => $last_id,), 1);
        $reservation_info = $reserve_query->row();

        $start = $reservation_info->start;
        $first_name = $reservation_info->first_name;
        $last_name = $reservation_info->last_name;
        $email = $reservation_info->email;
        $gender = $reservation_info->gender;
        $telephone = $reservation_info->telephone;
        // echo $telephone;

        $doc_setting_termin = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $doctor_id,), 1);

        $doc_email_set = $doc_setting_termin->row();

        $doctor_id = $doc_email_set->doctor_id;
        $email_subject = $doc_email_set->email_subject;
        $afterwards_message = $doc_email_set->afterwards_message;
        $email_body = $doc_email_set->email_body;
        $email_closing = $doc_email_set->email_closing;
        $email_signature = $doc_email_set->email_signature;
        $logo = $doc_email_set->logo;

        if ($result > 0) {
            $user_result['email_subject'] = $email_subject;
            $user_result['logo'] = $logo;
            $user_result['email_body'] = $email_body;
            $user_result['email_closing'] = $email_closing;
            $user_result['email_signature'] = $email_signature;
            $user_result['start'] = $start;
            $user_result['first_name'] = $first_name;
            $user_result['last_name '] = $last_name;
            $user_result['email     '] = $email;
            $user_result['gender    '] = $gender;
            $user_result['telephone '] = $telephone;


            $subject = $email_subject ? $email_subject : "Cyomed: Confirmation for your appointment with Cyomed Doctor";
            $msg1 = $this->load->view('portal/reservation/reservation_confirm_email_view', $user_result, true);
            $this->moemail->send_email($email, $subject, $msg1);
        }
        return ($result) ? $result : (($this->_error[] = Mod::ERROR_DB_INSERT) ? FALSE : FALSE);
    }

    /**
     *
     */
    public function get_all_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0,));
    }

    /**
     *
     */
    public function get_unread_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'read' => 0,));
    }

    /**
     *
     */
    public function get_unaccepted_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'accept' => 0,));
    }

    /**
     *
     */
    public function get_accepted_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'start >' => date('Y-m-d H:i:s'), 'accept' => 1,));
    }

    /**
     *
     */
    public function get_past_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'start <=' => date('Y-m-d H:i:s'), 'accept' => 1,));
    }

    /**
     *
     */
    public function get_archived_reservations($doctor_id) {
        return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 1,));
    }

    /**
     *
     */
    public function get_cond_reservations($cond) {
        $this->m->port->b->order_by('start');

        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('reservations', $cond);

        if ($query->num_rows() > 0) {
            $result = array();

            foreach ($query->result() as $row) {
                if ($row->patient_id) {
                    $query_patient_row = $this->mopat->get_id($row->patient_id);
                } else {
                    $query_patient_row = NULL;
                }

                if (isset($query_patient_row) && $query_patient_row) {
                    $this->insurance_provider->user_inspro($query_patient_row);

                    $row->email = $query_patient_row->email;
                    $row->gender = $query_patient_row->gender;
                    $row->first_name = $query_patient_row->name;
                    $row->last_name = $query_patient_row->surname;
                    $row->telephone = $query_patient_row->telephone;
                    $row->mobile = $query_patient_row->mobile;
                    // $row->insurance = $query_patient_row->insurance;

                    if (count($query_patient_row->inspro_assoc) > 0) {
                        $row->insurance_provider = reset($query_patient_row->inspro_assoc)->name;
                    } else {
                        $row->insurance_provider = '';
                    }
                } else {
                    if ($row->insurance_provider) {
                        $providers = $this->insurance_provider->get_assoc();

                        if (isset($providers[$row->insurance_provider]) && $providers[$row->insurance_provider]) {
                            $row->insurance_provider = $providers[$row->insurance_provider]->name;
                        } else {
                            $row->insurance_provider = '';
                        }
                    } else {
                        $row->insurance_provider = '';
                    }
                }

                if (isset($row->treatment) && $row->treatment) {
                    $split = explode(',', $row->treatment);
                    if (is_array($split) && count($split) > 0) {
                        $specs_assoc = $this->speciality->get_assoc();

                        if (isset($specs_assoc[$split[0]]) && $specs_assoc[$split[0]]) {
                            $new_treatment = array();
                            $new_treatment[] = $specs_assoc[$split[0]]->name;

                            $treatment_assoc = isset($specs_assoc[$split[0]]->treatment) && is_array($specs_assoc[$split[0]]->treatment) ? $specs_assoc[$split[0]]->treatment : array();

                            foreach ($treatment_assoc as $treatment_row) {
                                if ($treatment_row->code == $split[1]) {
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
        } else {
            return array();
        }
    }

    /**
     *
     */
    public function merge_reservations($arr1, $arr2) {
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
    public function filter_time_room($arr) {
        $result = new stdClass();
        $result->day = array();
        $result->workdays = array();
        $result->week = array();
        $result->month = array();
        $result->later = array();
        $result->overview = $arr;

        $time = time();
        $weekday_end = date('N');
        $weekday_end = $weekday_end <= 5 ? date('Y-m-d', (5 - $weekday_end) * 86400 + $time) : date('Y-m-d', (12 - $weekday_end) * 86400 + $time);

        foreach ($arr as $row) {
            $start_time = strtotime($row->start);
            $start_date = date('Y-m-d', $start_time);

            if (date('Y-m-d') == $start_date) {
                array_push($result->day, $row);
            }

            if ($start_date < $weekday_end) {
                array_push($result->workdays, $row);
            }

            if ($start_time < $time + 604800) {
                array_push($result->week, $row);
            }

            if ($start_time < $time + 2592000) {
                array_push($result->month, $row);
            } else {
                array_push($result->later, $row);
            }
        }
        return $result;
    }

    /**
     *
     */
    public function reservation_action($action = 'read', $toggle = NULL) {
        $checked_reservations = $this->input->post('checked_reservation');
        if ($checked_reservations && is_array($checked_reservations)) {
            foreach ($checked_reservations as $id => $value) {
                $this->m->port->b->where('id', $id);
                if ($toggle === NULL) {
                    $this->m->port->b->set($action, '1 - ' . $action, FALSE);
                } else {
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
    public function get_data($email) {
        $this->m->port->p->db_select();
        $result = $this->m->port->p->get_where('doctors', array('email' => $email,));
        $result_row = $result->row();
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
    public function doctor_validate_email($email, $email_code) {
        $this->m->port->p->db_select();
        $result = $this->m->port->p->get_where('doctors', array('email' => $email, 'confirm_code' => $email_code,));
        if ($result->num_rows() === 1) {
            $this->m->port->p->set('confirm_status', 1);
            $this->m->port->p->where('email', $email);
            $this->m->port->p->update('doctors');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function pass_reset_validation($email) {
        $this->m->port->p->db_select();
        $this->m->port->p->set('confirm_code', $confirm_code = random_string('alnum', 16));
        $this->m->port->p->set('temp_pass', $temp_pass = random_string('alnum', 16));
        $this->m->port->p->where('email', $email);

        if ($this->m->port->p->update('doctors')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function set_new_password($password_field='password') {  
        $id              = $this->m->user_id();
        $email           = $this->input->post('email');
        $password_old    = $this->input->post('oldpassword');
        $password_new    = $this->input->post('newpassword');
        $password_repeat = $this->input->post('confirmpassword');
        
        if ($password_new !== $password_repeat) {
            echo "Password and confirm password not matched.";
            return FALSE;
        }

        $this->m->port->p->db_select();
        
        $conditions = array();
         if(!empty($id))
            $conditions['id'] = $id;
            
         if(!empty($email))
            $conditions['email'] = $email;
    
         if(empty($conditions))
         {
            echo "Unable to update your password. Please try again later.";
            return FALSE;
         }
         if($password_field=='password')
            $conditions[$password_field] = md5($password_old);
         else 
             $conditions[$password_field] = $password_old;
        
        $query = $this->m->port->p->get_where('doctors', $conditions, 1);

        if ($query->num_rows() <= 0) {
            echo "Old password not matched.";
            return FALSE;
        }

        $this->m->port->p->set('password', md5($password_new));
        $this->m->port->p->set('temp_pass', '');
        if(!empty($id))
             $this->m->port->p->where('id', $id);
            
         if(!empty($email))
             $this->m->port->p->where('email', $email);
             
        $this->m->port->p->update('doctors');
        return TRUE;
    }

    /**
     *
     */
    public function email_reset_validation($email) {
        $this->m->port->p->db_select();
        $this->m->port->p->set('confirm_code', $confirm_code = random_string('alnum', 16));
        //$this->m->port->p->set('temp_pass'  , $temp_pass = random_string('alnum', 16) );
        $this->m->port->p->where('email', $email);

        if ($this->m->port->p->update('doctors')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Termine Legacy updates
     */
    public function profile_update($id, $update_params) {
        if (!$this->m->db_where('p', $id, self::$encrypted_fields, array())) {
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
    public function update_records($id, $update_data) {

        $this->m->port->p->db_select();
        return $this->m->port->p->update('doctors', $update_data, $id);
    }

    public function update_termin_profile($id, $update_data) {
        $this->m->port->b->db_select();
        return $this->m->port->b->update('doctors', $update_data, $id);
    }

    /**
     *
     */
    public function photo_update($id, $update_params) {
        if (!$this->m->db_where('p', $id, self::$encrypted_fields, array())) {
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
    public function get_upload_path($row, $role = "doctor") {
        return './protected/uploads/profile_image/' . trim($role, '/') . '/' . bin2hex($this->aes_encrypt->en($row->patient_id)) . '/';
    }

    /**
     *
     */
    public function image_upload($id, $role = "doctor", $upload_field = "document_upload") {
        $config = array();

        $config['upload_path'] = './protected/uploads/profile_image/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|png|jpeg|tif|gif';
        $config['max_size'] = '2048000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = FALSE;
        $config['max_width'] = '';
        $config['max_height'] = '';

        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $permission_string = '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
        $this->load->helper('file');
        write_file($config['upload_path'] . 'index.html', $permission_string);


        $this->load->library('upload', $config);
        //$this->upload->initialize($config);
        //echo $id;

        if ($this->upload->do_upload($upload_field)) {
            //echo "second check";
            $data = $this->upload->data();

            //echo "second check";

            $extension = str_replace('.', '', $data['file_ext']);
            $file_name = ($ext_pos = strrpos($data['file_name'], '.' . $extension)) !== FALSE ? substr_replace($data['file_name'], '', $ext_pos, strlen('.' . $extension)) : $data['file_name'];
            $pro_img = $file_name . $data['file_ext'];

            return $this->photo_update($id, array(
                        //'id'                 => $id, 
                        'profile_image' => $pro_img,
            ));
        } else {
            //echo $this->upload->display_errors();
            $error = (object) array('error' => $this->upload->display_errors());
            return $error;
        }
    }

    public function patientdetails($patient_id, $time = NULL, $limit = 5) {

        if ($time === NULL) {
            $time = time();
        }
        if (!is_numeric($time)) {
            if (strtotime($time) !== FALSE) {
                $time = strtotime($time);
            } else {
                $time = time();
            }
        }
        if (!is_numeric($limit)) {
            $limit = 5;
        }
        $this->ui->feed_item->base_init();
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctor_visit', array('patient_id' => $patient_id, 'doctor_id' => $this->m->user_id()), 1);
        if ($query->num_rows() > 0) {

            $this->m->port->p->set('visit_date', date('Y-m-d H:i:s'));
            $this->m->port->p->where('patient_id', $patient_id);
            $this->m->port->p->where('doctor_id', $this->m->user_id());
            $this->m->port->p->db_select();
            $this->m->port->p->update('doctor_visit');
        } else {
            $this->m->port->p->set('patient_id', $patient_id);
            $this->m->port->p->set('doctor_id', $this->m->user_id());
            $this->m->port->p->set('visit_date', date('Y-m-d h:i:s'));
            $this->m->port->p->set('added_date', date('Y-m-d h:i:s'));
            $this->m->port->p->insert('doctor_visit');
        }
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
        }, $this->mmedical_condition->get(array('patient_id' => $patient_id,), TRUE));
        # Here's for diagnosis
        $this->m->port->m->db_select();
        $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
        $this->m->port->m->limit($limit);
        $diagnosis = array_map(function($v) {
            return ($v->feed_type = 'diagnosis') ? $v : $v;
        }, $this->mdiagnosis->get(array('patient_id' => $patient_id,), TRUE));
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
        $blood_pressure = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'blood_pressure',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        # Here's for blood_sugar
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $patient_id,), TRUE);
        $blood_sugar = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'blood_sugar',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        # Here's for weight_bmi
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $patient_id,), TRUE);
        $weight_bmi = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'weight_bmi',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        # Here's for marcumar
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $patient_id,), TRUE);
        $marcumar = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'marcumar',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        $entries = array();

        $entries = array_merge($entries, $conditions);
        $entries = array_merge($entries, $diagnosis);
        $entries = array_merge($entries, $medication);
        $entries = array_merge($entries, $vaccination);
        $entries = array_merge($entries, $blood_pressure);
        $entries = array_merge($entries, $blood_sugar);
        $entries = array_merge($entries, $weight_bmi);
        $entries = array_merge($entries, $marcumar);
        $entries = array_splice($entries, 0, $limit);
        $output = $this->load->view('myprofile/patient_medical_record', array(
            'entries' => $entries,
            'diagnosis' => $diagnosis,
            'medication' => $medication,
            'vaccination' => $vaccination,
            'conditions' => $conditions,
            'blood_pressure' => $blood_pressure,
            'blood_sugar' => $blood_sugar,
            'weight_bmi' => $weight_bmi,
            'marcumar' => $marcumar,
                ), TRUE);
        return $output;
    }

    public function mypatientdetails($patient_id, $time = NULL, $limit = 15) {
        if ($time === NULL) {
            $time = time();
        }
        if (!is_numeric($time)) {
            if (strtotime($time) !== FALSE) {
                $time = strtotime($time);
            } else {
                $time = time();
            }
        }
        if (!is_numeric($limit)) {
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
        }, $this->mmedical_condition->get(array('patient_id' => $patient_id,), TRUE));
        # Here's for diagnosis
        $this->m->port->m->db_select();
        $this->m->port->m->where('document_date <=', date('Y-m-d', $time));
        $this->m->port->m->limit($limit);
        $diagnosis = array_map(function($v) {
            return ($v->feed_type = 'diagnosis') ? $v : $v;
        }, $this->mdiagnosis->get(array('patient_id' => $patient_id,), TRUE));
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
        $blood_pressure = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'blood_pressure',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        # Here's for blood_sugar
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_BLOOD_SUGAR, array('patient_id' => $patient_id,), TRUE);
        $blood_sugar = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'blood_sugar',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();

        # Here's for weight_bmi
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_WEIGHT_BMI, array('patient_id' => $patient_id,), TRUE);
        $weight_bmi = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'weight_bmi',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();
        # Here's for marcumar
        $this->m->port->m->db_select();
        $this->m->port->m->where('rec_date <=', date('Y-m-d', $time));
        $this->m->port->m->where('rec_time <=', date('H:i', $time));
        $this->m->port->m->limit($limit);
        $graph_entries = $this->mgraph->get_table(self::TABLE_MARCUMAR, array('patient_id' => $patient_id,), TRUE);
        $marcumar = !empty($graph_entries) ? array((object) array(
                'feed_type' => 'marcumar',
                'entries' => $graph_entries,
                'id' => 0,
                'document_date' => isset($graph_entries[0]->rec_date) ? $graph_entries[0]->rec_date : date('Y-m-d', $time),
            ),) : array();
        $entries = array();
        $entries = array_merge($entries, $conditions);
        $entries = array_merge($entries, $diagnosis);
        $entries = array_merge($entries, $medication);
        $entries = array_merge($entries, $vaccination);
        $entries = array_merge($entries, $blood_pressure);
        $entries = array_merge($entries, $blood_sugar);
        $entries = array_merge($entries, $weight_bmi);
        $entries = array_merge($entries, $marcumar);

        $output = $this->load->view('access/patient_medical_record', array(
            'entries' => $entries,
            'diagnosis' => $diagnosis,
            'medication' => $medication,
            'vaccination' => $vaccination,
            'conditions' => $conditions,
            'blood_pressure' => $blood_pressure,
            'blood_sugar' => $blood_sugar,
            'weight_bmi' => $weight_bmi,
            'marcumar' => $marcumar,
                ), TRUE);
        return $output;
    }

    /**
     *
     */
    public function update_afterwards() {
        $afterwards_message = nl2br(htmlentities($this->input->post('afterwards_message'), ENT_QUOTES, 'UTF-8'));
        $email_subject = nl2br(htmlentities($this->input->post('email_subject'), ENT_QUOTES, 'UTF-8'));
        $email_body = nl2br(htmlentities($this->input->post('email_body'), ENT_QUOTES, 'UTF-8'));
        $email_closing = nl2br(htmlentities($this->input->post('email_closing'), ENT_QUOTES, 'UTF-8'));
        //$email_signature                  = nl2br(htmlentities($this->input->post('email_signature'), ENT_QUOTES, 'UTF-8'));

        $logo_upload_result = $this->do_upload('logo');
        //$signature_upload_result = $this->do_upload('email_signature');

        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $this->m->user_id(),), 1);

        if ($query->num_rows() <= 0) {
            $this->m->port->b->set('doctor_id', $this->m->user_id());
            $this->m->port->b->set('afterwards_message', $afterwards_message);
            $this->m->port->b->set('email_subject', $email_subject);
            $this->m->port->b->set('email_body', $email_body);
            $this->m->port->b->set('email_closing', $email_closing);
            //$this->m->port->b->set('email_signature'                 , $email_signature);
            if ($logo_upload_result) {
                $this->m->port->b->set('logo', base_url($logo_upload_result['upload_path'] . $logo_upload_result['file_name']));
                $this->m->port->b->set('d_file_data', json_encode($logo_upload_result));
            }
            //if ($signature_upload_result)
            //{
            //$this->m->port->b->set('logo', base_url($signature_upload_result['upload_path'].$signature_upload_result['file_name']));
            //}
            $this->m->port->b->db_select();
            $this->m->port->b->insert('doctor_termin_settings');
        } else {
            $this->m->port->b->set('afterwards_message', $afterwards_message);
            $this->m->port->b->set('email_subject', $email_subject);
            $this->m->port->b->set('email_body', $email_body);
            $this->m->port->b->set('email_closing', $email_closing);
            //$this->m->port->b->set('email_signature'        , $email_signature);
            if ($logo_upload_result) {
                $this->m->port->b->set('logo', base_url($logo_upload_result['upload_path'] . $logo_upload_result['file_name']));
                $this->m->port->b->set('d_file_data', json_encode($logo_upload_result));
            }
            //if ($signature_upload_result)
            //{
            //$this->m->port->b->set('email_signature', base_url($signature_upload_result['upload_path'].$signature_upload_result['file_name']));
            //}
            $this->m->port->b->where('doctor_id', $this->m->user_id());
            $this->m->port->b->db_select();
            $this->m->port->b->update('doctor_termin_settings');
        }
    }

    /**
     *
     */
    public function update_reminders() {

        $reminder_email_subject = nl2br(htmlentities($this->input->post('reminder_email_subject'), ENT_QUOTES, 'UTF-8'));
        $reminder_email_body = nl2br(htmlentities($this->input->post('reminder_email_body'), ENT_QUOTES, 'UTF-8'));
        $reminder_email_closing = nl2br(htmlentities($this->input->post('reminder_email_closing'), ENT_QUOTES, 'UTF-8'));
        $reminder_time = $this->input->post('reminder_time');
        $reminder_time_wrapper = $this->input->post('reminder_time_wrapper');

        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $this->m->user_id(),), 1);

        if ($query->num_rows() <= 0) {
            $this->m->port->b->set('doctor_id', $this->m->user_id());
            $this->m->port->b->set('reminder_email_subject', $reminder_email_subject);
            $this->m->port->b->set('reminder_email_body', $reminder_email_body);
            $this->m->port->b->set('reminder_email_closing', $reminder_email_closing);
            $this->m->port->b->set('reminder_time', $reminder_time);
            $this->m->port->b->set('reminder_time_wrapper', $reminder_time_wrapper);

            $this->m->port->b->db_select();
            $this->m->port->b->insert('doctor_termin_settings');
        } else {
            $this->m->port->b->set('reminder_email_subject', $reminder_email_subject);
            $this->m->port->b->set('reminder_email_body', $reminder_email_body);
            $this->m->port->b->set('reminder_email_closing', $reminder_email_closing);
            $this->m->port->b->set('reminder_time', $reminder_time);
            $this->m->port->b->set('reminder_time_wrapper', $reminder_time_wrapper);
            $this->m->port->b->where('doctor_id', $this->m->user_id());

            $this->m->port->b->db_select();
            $this->m->port->b->update('doctor_termin_settings');
        }
    }

    /**
     *
     */
    public function update_followup() {

        $followup_email_subject = nl2br(htmlentities($this->input->post('followup_email_subject'), ENT_QUOTES, 'UTF-8'));
        $followup_email_body = nl2br(htmlentities($this->input->post('followup_email_body'), ENT_QUOTES, 'UTF-8'));
        $followup_email_closing = nl2br(htmlentities($this->input->post('followup_email_closing'), ENT_QUOTES, 'UTF-8'));
        $followup_time = $this->input->post('followup_time');
        $followup_time_wrapper = $this->input->post('followup_time_wrapper');

        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $this->m->user_id(),), 1);

        if ($query->num_rows() <= 0) {
            $this->m->port->b->set('doctor_id', $this->m->user_id());
            $this->m->port->b->set('followup_email_subject', $followup_email_subject);
            $this->m->port->b->set('followup_email_body', $followup_email_body);
            $this->m->port->b->set('followup_email_closing', $followup_email_closing);
            $this->m->port->b->set('followup_time', $followup_time);
            $this->m->port->b->set('followup_time_wrapper', $followup_time_wrapper);

            $this->m->port->b->db_select();
            $this->m->port->b->insert('doctor_termin_settings');
        } else {
            $this->m->port->b->set('followup_email_subject', $followup_email_subject);
            $this->m->port->b->set('followup_email_body', $followup_email_body);
            $this->m->port->b->set('followup_email_closing', $followup_email_closing);
            $this->m->port->b->set('followup_time', $followup_time);
            $this->m->port->b->set('followup_time_wrapper', $followup_time_wrapper);
            $this->m->port->b->where('doctor_id', $this->m->user_id());

            $this->m->port->b->db_select();
            $this->m->port->b->update('doctor_termin_settings');
        }
    }

    public function get_termin_settings() {

        $this->m->port->b->db_select();
        $query = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $this->m->user_id(),), 1);
        $tset = array();
        foreach ($query->result() as $row) {
            $tset['doctor_id'] = $row->doctor_id;
            $tset['afterwards_message'] = $row->afterwards_message;
            $tset['logo'] = $row->logo;
            $tset['email_subject'] = $row->email_subject;
            $tset['email_body'] = $row->email_body;
            $tset['email_closing'] = $row->email_closing;
            $tset['email_signature'] = $row->email_signature;
            $tset['reminder_email_subject'] = $row->reminder_email_subject;
            $tset['reminder_email_body'] = $row->reminder_email_body;
            $tset['reminder_email_closing'] = $row->reminder_email_closing;
            $tset['followup_email_subject'] = $row->followup_email_subject;
            $tset['followup_email_body'] = $row->followup_email_body;
            $tset['followup_email_closing'] = $row->followup_email_closing;
            $tset['reminder_time'] = $row->reminder_time;
            $tset['reminder_time_wrapper'] = $row->reminder_time_wrapper;
            $tset['followup_time'] = $row->followup_time;
            $tset['followup_time_wrapper'] = $row->followup_time_wrapper;
        }
        return $tset;
    }

    /**
     *
     */
    public function get_me() {
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $this->m->user_id(),), 1);

        $ret = array();
        foreach ($query->result() as $row) {
            $ret[] = $this->get_id($row->id);
        }

        return $ret;
    }

    /**
     *
     */
    public function get_share($shareid) {

        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $shareid,), 1);


        if ($query->num_rows() === 1) {
            $ret = array();
            foreach ($query->result() as $row) {
                $ret[] = $this->get_id($row->id);
            }

            return $ret;
        } else {
            return FALSE;
        }
    }

    /**
     *
     */
    public function get_epres_list() {
        //get eprescription information which is status 0 from eprescription, means not prescribed yet for specific patient... 
        /* $this->m->port->m->db_select();
          $this->m->port->m->select("p.*", FALSE);
          $this->m->port->m->from("eprescription AS p");
          $this->m->port->m->where('delete_status',0);
          $this->m->port->m->where('status',0); */
        $this->m->port->m->db_select();
        $this->m->port->m->order_by('id', 'desc');
        $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0,'status'=>1), 100);
        $result = array();
        $prescription_records = array();

        foreach ($query->result() as $key => $row) {
            $familydoc = explode(',', $row->familydoctor);
            if (!empty($row->familydoctor) && !in_array($this->m->user_id(), $familydoc)) {
                
            } else {
                $query = $this->m->port->p->get_where('patients', array('id' => $row->patient_id), 4);
                $patientdetails = $query->result();
                $row->patientid = $row->patient_id;
                $row->patient_id = $patientdetails[0]->name . ' ' . $patientdetails[0]->surname;


                array_push($prescription_records, $row);
            }
            //$row->patient_id='1';
        }
        $result = array_splice($prescription_records, 0, 4);
        return $result;
    }

    public function profile_visit_record() {


        $this->m->port->p->select("`p`.`name`,`p`.`surname`,`p`.`regid`,`d`.`name` as `doctor_name`,`d`.`surname` as `doctor_surname`,`dv`.`visit_date`", FALSE);

        $this->m->port->p->from("doctor_visit AS dv");
        $this->m->port->p->join("patients AS p", "dv.patient_id = p.id", 'inner');
        $this->m->port->p->join("doctors AS d", "dv.doctor_id = d.id", 'inner');
        $this->m->port->p->where("dv.doctor_id", $this->m->user_id());
        $this->m->port->p->order_by('visit_date', 'desc');
        $this->m->port->p->limit(5);
        $this->m->port->p->db_select();
        $query = $this->m->port->p->get();
        return $query->result();
    }

    /**
     * return the termins created by doctors
     * @param  [type] $doctor_id [id of the doctor]
     * @param  [type] $startdate [date choosen from the patient appointment calendar]
     * @return [type] $insurance_type         [type of the insurance public or private]
     * function is called from ajaxterminappointments from reservation.php file
     */
    public function get_date_reservations($doctor_id, $startdate,$insurance_type) {
        $cond = null;
        $cond1 = null;
        if($insurance_type == 'public'){
            $cond = array('doctor_id' => $doctor_id, 'DATE(start)' => $startdate,'insurance_public'=>1,'repetitive !='=>1);
            $cond1 = array('doctor_id' => $doctor_id,'day'=>date('N',strtotime($startdate)), 'repetitive'=>1,'insurance_public'=>1);
        }else if($insurance_type == 'private'){
            $cond = array('doctor_id' => $doctor_id, 'DATE(start)' => $startdate,'insurance_private'=>1,'repetitive !='=>1);
            $cond1 = array('doctor_id' => $doctor_id,'day'=>date('N',strtotime($startdate)), 'repetitive'=>1,'insurance_private'=>1);
        }
        $this->m->port->b->order_by('start');
        $this->m->port->b->db_select();
        if($cond != null && $cond1 != null){       
            
            $this->m->port->b->select('mask_event_id');
            $mask_query = $this->m->port->b->get_where('doctor_termins',array('doctor_id'=>$doctor_id,'mask'=>1,'mask_event_id !='=>0,'DATE(start)' => $startdate));
            $mask_array = array('0');
            if($mask_query->num_rows()>0){
                foreach ($mask_query->result() as $row) {
                    array_push($mask_array,$row->mask_event_id);
                }
            }

            $this->m->port->b->where($cond);
            $this->m->port->b->where_not_in('id',$mask_array);
            $query = $this->m->port->b->get('doctor_termins');
            
            $this->m->port->b->order_by('start');
            $this->m->port->b->where($cond1);
            $this->m->port->b->where_not_in('id',$mask_array);
            $query1 = $this->m->port->b->get('doctor_termins');
            $result = array();
            $result1 = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $temp = array();
                    $temp['id'] = $row->id;
                    $temp['start'] = date("Y-m-d H:i",strtotime($row->start));
                    $temp['end']  = date("Y-m-d H:i",strtotime($row->end));
                    array_push($result, (object)$temp);
                }
            }
            if ($query1->num_rows() > 0) {
                foreach ($query1->result() as $row) {
                    $temp = array();
                    $temp['id'] = $row->id;
                    $temp['start'] = date("Y-m-d H:i",strtotime($startdate.date("H:i",strtotime($row->start))));
                    $temp['end']  = date("Y-m-d H:i",strtotime($startdate.date("H:i",strtotime($row->end))));
                    array_push($result1, (object)$temp);
                }
            }

            $result_array = array_merge($result,$result1);
            // usort($result_array, function($a, $b) {
            //     if(strtotime($a->start) == strtotime($b->end)){
            //         return 0;
            //     }
            //     return strtotime($a->start)<strtotime($b->end)? -1: 1;

            // });
            return $result_array;
        }else{
            return array();
        }
    }



    public function reminder() {
        if ($this->input->post('start_time') != '') {
            $start = $this->input->post('start') . ' ' . $this->input->post('start_time');
            $start = date('Y-m-d h:i:s', strtotime($start));
        } else {
            $start = $this->input->post('start');
            $start = date('Y-m-d h:i:s', strtotime($start));
        }
        if ($this->input->post('end_time') != '') {
            $end = $this->input->post('end') . ' ' . $this->input->post('end_time');
            $end = date('Y-m-d h:i:s', strtotime($end));
        } else {
            $end = $this->input->post('end');
            $end = date('Y-m-d h:i:s', strtotime($end));
        }

        $doctor_id = $this->input->post('doctor_id');
        $user_id = $this->input->post('user_id');
        $gender = $this->input->post('gender');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email'); //patient
        $telephone = $this->input->post('telephone');
        $insurance = $this->input->post('insurance');
        $insurance_provider = $this->input->post('insurance_provider');
        if ($insurance_provider && is_array($insurance_provider))
            $insurance_provider = implode(',', $insurance_provider);
        $treatment = $this->input->post('treatment');
        $patient_notes = $this->input->post('patient_notes');
        $return_visitor = $this->input->post('return_visitor') ? 1 : 0;

        if (!$doctor_id) {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $doctor_id,), 1);
        if ($query->num_rows() > 0) {
            $doctor_row = $query->row();
        } else {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->b->set('doctor_id', $doctor_id);

        if ($user_id) {
            $this->m->port->p->db_select();
            $this->m->port->p->db_select();
            $query = $this->m->port->p->get_where('patients', array('id' => $user_id,), 1);
            if ($query->num_rows() > 0) {
                $patient_row = $query->row();

                $this->m->port->b->set('patient_id', $patient_row->id);
                $this->m->port->b->set('gender', $patient_row->gender);
                $this->m->port->b->set('first_name', $patient_row->name);
                $this->m->port->b->set('last_name', $patient_row->surname);
                $this->m->port->b->set('email', $patient_row->email);
                $this->m->port->b->set('telephone', $patient_row->telephone);
                $this->m->port->b->set('insurance', $insurance);
                $this->m->port->b->set('insurance_provider', $insurance_provider);
            } else {
                return ($this->_error[] = self::ERROR_NO_PATIENT) ? FALSE : FALSE;
            }
        } else {
            $this->m->port->b->set('patient_id', $user_id);
            $this->m->port->b->set('gender', $gender);
            $this->m->port->b->set('first_name', $first_name);
            $this->m->port->b->set('last_name', $last_name);
            $this->m->port->b->set('email', $email);
            $this->m->port->b->set('telephone', $telephone);
            $this->m->port->b->set('insurance', $insurance);
            $this->m->port->b->set('insurance_provider', $insurance_provider);
        }

        $val_start = strtotime($start);

        if ($val_start !== FALSE && $val_start !== -1) {
            $this->m->port->b->set('start', $start);
            // $this->m->port->b->set('end', $end);
        } else {
            return ($this->_error[] = Mod::ERROR_DATE_INVALID) ? FALSE : FALSE;
        }
        $this->m->port->b->set('end', $end);
        $this->m->port->b->set('treatment', $treatment);
        $this->m->port->b->set('return_visitor', $return_visitor);
        $this->m->port->b->set('text_patient_notes', $patient_notes);

        $this->m->port->b->db_select();
        $result = $this->m->port->b->insert('reservations');
        $last_id = $this->m->port->b->insert_id(); //last reservation id
        $reserve_query = $this->m->port->b->get_where('reservations', array('id' => $last_id,), 1);
        $reservation_info = $reserve_query->row();

        $start = $reservation_info->start;
        $first_name = $reservation_info->first_name;
        $last_name = $reservation_info->last_name;
        $email = $reservation_info->email;
        $gender = $reservation_info->gender;
        $telephone = $reservation_info->telephone;
        // echo $telephone;

        $doc_setting_termin = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $doctor_id,), 1);

        $doc_email_set = $doc_setting_termin->row();

        $doctor_id = $doc_email_set->doctor_id;
        $email_subject = $doc_email_set->email_subject;
        $afterwards_message = $doc_email_set->afterwards_message;
        $email_body = $doc_email_set->email_body;
        $email_closing = $doc_email_set->email_closing;
        $email_signature = $doc_email_set->email_signature;
        $logo = $doc_email_set->logo;

        if ($result > 0) {
            $user_result['email_subject'] = $email_subject;
            $user_result['logo'] = $logo;
            $user_result['email_body'] = $email_body;
            $user_result['email_closing'] = $email_closing;
            $user_result['email_signature'] = $email_signature;
            $user_result['start'] = $start;
            $user_result['first_name'] = $first_name;
            $user_result['last_name '] = $last_name;
            $user_result['email     '] = $email;
            $user_result['gender    '] = $gender;
            $user_result['telephone '] = $telephone;


            $subject = $email_subject ? $email_subject : "Cyomed: Confirmation for your appointment with Cyomed Doctor";
            $msg1 = $this->load->view('portal/reservation/reservation_confirm_email_view', $user_result, true);
            $this->moemail->send_email($email, $subject, $msg1);
        }
        return ($result) ? $result : (($this->_error[] = Mod::ERROR_DB_INSERT) ? FALSE : FALSE);
    }

    public function followup() {
        if ($this->input->post('start_time') != '') {
            $start = $this->input->post('start') . ' ' . $this->input->post('start_time');
            $start = date('Y-m-d h:i:s', strtotime($start));
        } else {
            $start = $this->input->post('start');
            $start = date('Y-m-d h:i:s', strtotime($start));
        }
        if ($this->input->post('end_time') != '') {
            $end = $this->input->post('end') . ' ' . $this->input->post('end_time');
            $end = date('Y-m-d h:i:s', strtotime($end));
        } else {
            $end = $this->input->post('end');
            $end = date('Y-m-d h:i:s', strtotime($end));
        }

        $doctor_id = $this->input->post('doctor_id');
        $user_id = $this->input->post('user_id');
        $gender = $this->input->post('gender');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email'); //patient
        $telephone = $this->input->post('telephone');
        $insurance = $this->input->post('insurance');
        $insurance_provider = $this->input->post('insurance_provider');
        if ($insurance_provider && is_array($insurance_provider))
            $insurance_provider = implode(',', $insurance_provider);
        $treatment = $this->input->post('treatment');
        $patient_notes = $this->input->post('patient_notes');
        $return_visitor = $this->input->post('return_visitor') ? 1 : 0;

        if (!$doctor_id) {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->p->db_select();
        $query = $this->m->port->p->get_where('doctors', array('id' => $doctor_id,), 1);
        if ($query->num_rows() > 0) {
            $doctor_row = $query->row();
        } else {
            return ($this->_error[] = self::ERROR_NO_DOCTOR) ? FALSE : FALSE;
        }

        $this->m->port->b->set('doctor_id', $doctor_id);

        if ($user_id) {
            $this->m->port->p->db_select();
            $this->m->port->p->db_select();
            $query = $this->m->port->p->get_where('patients', array('id' => $user_id,), 1);
            if ($query->num_rows() > 0) {
                $patient_row = $query->row();

                $this->m->port->b->set('patient_id', $patient_row->id);
                $this->m->port->b->set('gender', $patient_row->gender);
                $this->m->port->b->set('first_name', $patient_row->name);
                $this->m->port->b->set('last_name', $patient_row->surname);
                $this->m->port->b->set('email', $patient_row->email);
                $this->m->port->b->set('telephone', $patient_row->telephone);
                $this->m->port->b->set('insurance', $insurance);
                $this->m->port->b->set('insurance_provider', $insurance_provider);
            } else {
                return ($this->_error[] = self::ERROR_NO_PATIENT) ? FALSE : FALSE;
            }
        } else {
            $this->m->port->b->set('patient_id', $user_id);
            $this->m->port->b->set('gender', $gender);
            $this->m->port->b->set('first_name', $first_name);
            $this->m->port->b->set('last_name', $last_name);
            $this->m->port->b->set('email', $email);
            $this->m->port->b->set('telephone', $telephone);
            $this->m->port->b->set('insurance', $insurance);
            $this->m->port->b->set('insurance_provider', $insurance_provider);
        }

        $val_start = strtotime($start);

        if ($val_start !== FALSE && $val_start !== -1) {
            $this->m->port->b->set('start', $start);
            // $this->m->port->b->set('end', $end);
        } else {
            return ($this->_error[] = Mod::ERROR_DATE_INVALID) ? FALSE : FALSE;
        }
        $this->m->port->b->set('end', $end);
        $this->m->port->b->set('treatment', $treatment);
        $this->m->port->b->set('return_visitor', $return_visitor);
        $this->m->port->b->set('text_patient_notes', $patient_notes);

        $this->m->port->b->db_select();
        $result = $this->m->port->b->insert('reservations');
        $last_id = $this->m->port->b->insert_id(); //last reservation id
        $reserve_query = $this->m->port->b->get_where('reservations', array('id' => $last_id,), 1);
        $reservation_info = $reserve_query->row();

        $start = $reservation_info->start;
        $first_name = $reservation_info->first_name;
        $last_name = $reservation_info->last_name;
        $email = $reservation_info->email;
        $gender = $reservation_info->gender;
        $telephone = $reservation_info->telephone;
        // echo $telephone;

        $doc_setting_termin = $this->m->port->b->get_where('doctor_termin_settings', array('doctor_id' => $doctor_id,), 1);

        $doc_email_set = $doc_setting_termin->row();

        $doctor_id = $doc_email_set->doctor_id;
        $email_subject = $doc_email_set->email_subject;
        $afterwards_message = $doc_email_set->afterwards_message;
        $email_body = $doc_email_set->email_body;
        $email_closing = $doc_email_set->email_closing;
        $email_signature = $doc_email_set->email_signature;
        $logo = $doc_email_set->logo;

        if ($result > 0) {
            $user_result['email_subject'] = $email_subject;
            $user_result['logo'] = $logo;
            $user_result['email_body'] = $email_body;
            $user_result['email_closing'] = $email_closing;
            $user_result['email_signature'] = $email_signature;
            $user_result['start'] = $start;
            $user_result['first_name'] = $first_name;
            $user_result['last_name '] = $last_name;
            $user_result['email     '] = $email;
            $user_result['gender    '] = $gender;
            $user_result['telephone '] = $telephone;


            $subject = $email_subject ? $email_subject : "Cyomed: Confirmation for your appointment with Cyomed Doctor";
            $msg1 = $this->load->view('portal/reservation/reservation_confirm_email_view', $user_result, true);
            $this->moemail->send_email($email, $subject, $msg1);
        }
        return ($result) ? $result : (($this->_error[] = Mod::ERROR_DB_INSERT) ? FALSE : FALSE);
    }
    public function get_accepted_reservations_data($doctor_id,$start_date)
     {
       $start = date("Y-m-d",strtotime($start_date));

         return $this->get_cond_reservations(array('doctor_id' => $doctor_id, 'deleted' => 0, 'archived' => 0, 'DATE(start)' => $start, 'accept' => 1, ));
     }

    public function get_latest_epres() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->m->port->m->db_select();
        $this->m->port->m->order_by('id', 'desc');
        $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0, 'patient_id' => $_ci->m->user_id()), 1);

        $prescription_records = array();

        foreach ($query->result() as $key => $row) {
            $familydoc = explode(',', $row->familydoctor);
            if (!empty($row->familydoctor) && !in_array($this->m->user_id(), $familydoc)) {
                
            } else {
                $query = $this->m->port->p->get_where('patients', array('id' => $row->patient_id), 1);
                $patientdetails = $query->result();

                $row->patient_id = $row->patient_id;
                $row->regid = $patientdetails[0]->regid;
                $row->patient_name = $patientdetails[0]->name . ' ' . $patientdetails[0]->surname;
                $row->email = $patientdetails[0]->email;
                $row->telephone = $patientdetails[0]->telephone;

                array_push($prescription_records, $row);
            }
            //$row->patient_id='1';
        }

        return $prescription_records;
    }
public function list_of_applications($patient=false) 
{
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      
    return $this->m->role_diff(
      function() use ($_ci,$patient)
      {
                            $this->m->port->m->db_select();
                            $this->m->port->m->order_by('id','desc');
                            
                            $this->m->port->p->db_select();
                            if($patient){
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('doctor_inserted_id' => $this->m->user_id(),'patient_id' => $this->m->us_id(),));
                            if ($accessibility->num_rows() > 0) {
                             $family_doctor=$accessibility->result();
                             $where_field='(doctorcheck ="2" or familydoctor in ('.$_ci->m->user_id().'))';
                            } else {
                                $family_doctor='';
                             $where_field='(doctorcheck ="2")';  
                            }                                

                              $this->m->port->m->where($where_field);
                            $query = $this->m->port->m->get_where('eprescription', array('patient_id' => $this->m->us_id(), 'delete_status' => 0,'status'=>1 ) );
                            }
                            else{
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('doctor_inserted_id' => $this->m->user_id(),));
                            if ($accessibility->num_rows() > 0) {
                             $family_doctor=$accessibility->result();
                             $where_field='(doctorcheck ="2" or familydoctor in ('.$_ci->m->user_id().'))';
                            } else {
                                $family_doctor='';
                             $where_field='(doctorcheck ="2")';  
                            }                                
                                
                             $this->m->port->m->where($where_field);
                            $query = $this->m->port->m->get_where('eprescription', array('delete_status' => 0,'status'=>1 ) );                
                            }
                        return $query->result();
   
      },
      function() use ($_ci)
      {
            $this->m->port->m->db_select();
            $query = $this->m->port->m->get_where('eprescription', array('patient_id' => $this->m->user_id(), 'delete_status' => 0,'status >'=>1 ) );
        return $query->result();
      }
    );
   
    
}

public function doctor_existance($regid){  
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();     
        $_ci->m->port->p->db_select();
        $_ci->m->port->p->where('regid', $regid);
        $_ci->m->port->p->where('confirm_status', 1);

        $query = $_ci->m->port->p->get('doctors');
//        echo $_ci->m->port->p->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        }
        return false;
}

public function doctor_connected_listing(){
      static $_ci;
      if (empty($_ci)) $_ci =& get_instance();
      
        $this->m->port->p->db_select();
        $this->m->port->p->where('confirm_status', 1);
        $this->m->port->p->where('Dr_approv', 1);
        $this->m->port->p->where('id !=', $this->m->user_id());
        $result=  array();
        $query = $this->m->port->p->get('doctors');
        
        if($query->num_rows() > 0){
        $result=$query->result();
        }
        
        return $result;
}
}

/* End of file modoc.php */
/* Location: ./application/models/modoc.php */