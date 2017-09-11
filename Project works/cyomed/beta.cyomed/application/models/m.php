<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M extends CI_Model 
{
    const SUCCESS = 'success';
    const FAIL = 'fail';
    const SECURE_ALREADY = 'secure_already';
    const SECURE_SELECTED = 'secure_selected';
    const SECURE_CREATED = 'secure_proceeded';
    const SECURE_FAIL = 'secure_fail';
    const ERROR_EMAIL = 'error_email';
    const ERROR_PASSWORD = 'error_password';
    const ERROR_TIMEOUT = 'error_timeout';
    const ERROR_DB_INSERT = 'error_db_insert';
    const ROLE_DOCTOR = 'role_doctor';
    const ROLE_PATIENT = 'role_patient';
    public static $default_field = 'id';
    public static $default_cond = array('delete_status' => 0,);
    public static $encrypted_fields_bin2hex = FALSE;
    public $lang;
    public $attempt;
    /*
      |--------------------------------------------------------------------------
      | PUBLIC ACCESSIBLE ATTRIBUTE
      |--------------------------------------------------------------------------
      |
     */
    public $port = NULL;
    /*
      |--------------------------------------------------------------------------
      | PRIVATE ATTRIBUTE
      |--------------------------------------------------------------------------
      |
     */
    private $_error = array();
    # Current User
    private $_login = FALSE;
    private $_uid = 0;
    private $_urole = NULL;
    private $u = NULL;
    # Selected User, or say, selected patient
    private $_sregid = 0;
    private $_sid = 0;
    private $_saccess = 2;
    private $s = NULL;
    

    /**
     * 
     */
    public function __construct() {
        // Call the Model constructor
        parent::__construct();

        // if (session_id() == '' || session_status() == PHP_SESSION_NONE) {
        //   session_start();
        // }

        $_ci = & get_instance();
        $_ci->m = & $this;
        $this->load->library('encrypt');
        $this->load->library('aes_encrypt');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->port = (object) array(
                    'b' => $this->load->database('bare', TRUE),
                    'p' => $this->load->database('personal', TRUE),
                    'm' => $this->load->database('medical', TRUE),
                    'd' => $this->load->database('drugbank', TRUE),
        );

        // Language detect as browser language

        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        switch ($lang){
            case "de":
                //echo "PAGE DE";
                $this->lang = 'de';
                break;
         
            default:
                //echo "PAGE EN - Setting Default";
                $this->lang = 'en';
                break;
        }

        $this->load->model('db_check');
        // ->c();
        $this->load->model('country');
        $this->load->model('insurance_provider');
        $this->load->model('language');
        $this->load->model('speciality');


        $this->load->model('dummy');

        $this->load->model('modoc');
        $this->load->model('mopat');
        $this->load->model('mopack');
        $this->load->model('moterm');
        $this->load->model('miconsult');

        $this->load->model('moemail');

        $this->load->model('module');
        $this->load->model('minvoice');


        $this->login_check();

        # Load UI driver
        $this->load->driver('ui');
        $this->ui->init();
    }

    /*
      |--------------------------------------------------------------------------
      | LOGIN & LOGOUT
      |--------------------------------------------------------------------------
      |
      | All functions concerns to login actions.
      |
     */

    /**
     *
     */
    public function login_check() {
        $user = FALSE;
        $selected = FALSE;

        if ($this->session->userdata('login')) {
            $user_id = $this->encrypt->decode($this->session->userdata('user_id'));
            $user_role = $this->encrypt->decode($this->session->userdata('user_role'));

            if (is_numeric($user_id) && in_array($user_role, array(self::ROLE_PATIENT, self::ROLE_DOCTOR))) {
                switch ($user_role) {
                    case self::ROLE_PATIENT:
                        $user = $this->mopat->get_id($user_id);
                        break;

                    case self::ROLE_DOCTOR:
                        $user = $this->modoc->get_id($user_id);

                        $selected_id = $this->encrypt->decode($this->session->userdata('selected_id'));
                        $selected_regid = $this->encrypt->decode($this->session->userdata('selected_regid'));

                        $selected = $this->mopat->get_id($selected_id);
                        if (empty($selected) || empty($selected->regid) || $selected->regid != $selected_regid) {
                            $selected = FALSE;
                        } else {
                            $this->m->port->p->db_select();
                            $accessibility = $this->m->port->p->get_where('my_doctors', array('patient_id' => $selected_id, 'doctor_inserted_id' => $user_id,), 1);

                            if ($accessibility->num_rows() > 0) {
                                $this->_saccess = 1;
                            } else {
                                $this->_saccess = 2;
                            }
                        }
                        break;

                    default:
                        $user = NULL;
                        break;
                }
            }
        }

        if ($user) {
            $this->_login = TRUE;
            $this->_uid = $user_id;
            $this->_urole = $user_role;
            $this->u = $user;
        } else {
            $this->_login = FALSE;
            $this->_uid = 0;
            $this->_urole = NULL;
            $this->u = NULL;

            $this->session->unset_userdata('login');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('user_role');
        }

        if ($selected) {
            $this->_sid = $selected_id;
            $this->_sregid = $selected_regid;
            $this->s = $selected;
        } else {
            $this->_sid = 0;
            $this->_sregid = 0;
            $this->s = NULL;

            $this->session->unset_userdata('selected_id');
            $this->session->unset_userdata('selected_regid');
        }
    }

    /**
     */
    public function login_check_redirect() {
        $this->login_check();
        if (!$this->_login) {
            redirect('portal');
            exit();
        }
    }

    /**
     *
     */
    public function login($email, $password = NULL, $role_doctor = TRUE) 
    {
       $query = $this->role_diff(function() use ($email) 
       {
            return $this->port->p->get_where('doctors', array('email' => $email, 'confirm_status' => 1, 'login_attempt <= ' => 3, 'blocked_time <= ' => 'NOW()',), 1);
       }, function() use ($email) 
       {
            return $this->port->p->get_where('patients', array('email' => $email, 'confirm_status' => 1, 'login_attempt <= ' => 3, 'blocked_time <= ' => 'NOW()',), 1);
       }, $role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT);

      if ($password === NULL) 
      {
            return $query->num_rows() > 0 ? $query->row() : ( ($this->_error[] = self::ERROR_EMAIL) ? FALSE : FALSE);
      }
  
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $today = date('Y-m-d H:i:s');
            $d1 = new DateTime($today);
            $d2 = new DateTime($row->blocked_time);
            if ($row->password == md5($password) && $d2 < $d1) {
                $this->login_successful($email, $password, $role_doctor);
                $this->session->set_userdata('login', $this->_login = TRUE);
                $this->session->set_userdata('user_id', $this->_uid = $this->encrypt->encode($row->id));
                $this->session->set_userdata('user_role', $this->_urole = $this->encrypt->encode($role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT));
				$this->session->set_userdata('user_gender', $this->_ugender = $row->gender);
				
                return TRUE;
            } else {
                $this->login_attempt($email, $password, $role_doctor);
                return ($this->_error[] = self::ERROR_PASSWORD) ? FALSE : FALSE;
            }
        } else {
            return ($this->_error[] = self::ERROR_EMAIL) ? FALSE : FALSE;
        }
    }
/****used for forcefully changes password***/
    public function login_changepassword($email, $password = NULL, $role_doctor = TRUE) 
    {
        $query = $this->role_diff(function() use ($email) {
            return $this->port->p->get_where('doctors', array('email' => $email, 'confirm_status' => 1,), 1);
        }, function() use ($email) {
            return $this->port->p->get_where('patients', array('email' => $email, 'confirm_status' => 1,), 1);
        }, $role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT);

        $results = $query->row();
       
        if(empty($results->security_answer_id) && $role_doctor == TRUE)
        {
              $redirect = 'portal/doctor/forgot/security_access';
        }
        elseif(empty($results->security_answer_id)&& $role_doctor == FALSE)
        {
            $redirect = 'portal/patient/forgot/security_access';
        }
        else
        {
            $redirect='akte';
       }
          return $redirect;
    }
    public function force_pass_change($email,$password=NULL,$role_doctor=true){
        $query = $this->role_diff(function() use ($email,$password) {
            return $this->port->p->get_where('doctors', array('email' => $email,'confirm_status' => 1,'password'=>md5($password)), 1);
        }, function() use ($email,$password) {
            return $this->port->p->get_where('patients', array('email' => $email,'confirm_status' => 1,'password'=>md5($password)), 1);
        }, $role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT);
        if(!($query->num_rows()>0)){
            return false;
        }
          $results = $query->row();
        $change_password_date = $results->last_password_change_date;
        $current_time = time();
        $password_90_days = strtotime($change_password_date . '+90 days');
        $this->session->set_userdata('force_change', array("id"=>$results->id,"password"=>$password));
         if (empty($results->force_login) && $role_doctor == FALSE) 
         {
           $redirect = 'portal/patient/forgot/forcepass_reset'; 
         }
         else
         {
            if ($current_time > $password_90_days) 
            {
                if ($role_doctor)
                    $redirect = 'portal/doctor/forgot/forcepass_reset?force_pass=1';
                else
                    $redirect = 'portal/patient/forgot/forcepass_reset?force_pass=1';
            }
            else
                $redirect = '';
         }
         return $redirect;

    }

    public function login_successful($email, $password = NULL, $role_doctor = TRUE) 
    {
        // date_default_timezone_set("Asia/Kolkata");
        $query = $this->role_diff(function() use ($email) 
        {
            return $this->port->p->get_where('doctors', array('email' => $email, 'confirm_status' => 1,), 1);
        }, function() use ($email) {
            return $this->port->p->get_where('patients', array('email' => $email, 'confirm_status' => 1,), 1);
        }, $role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT);
        $userdetail = $query->row();
        if (!empty($userdetail)) {
            $this->port->p->db_select();
            if ($userdetail->last_password_change_date == '0000-00-00 00:00:00') {
                $current_date_time = date("Y-m-d h:i:s");
                $this->port->p->set('last_password_change_date', $current_date_time);
            }
            $this->port->p->set('login_attempt', 0);
            $this->port->p->where('id', $userdetail->id);
            if ($role_doctor == TRUE) {
                $this->m->port->p->update('doctors');
            } else {
                $this->m->port->p->update('patients');
            }
        }
    }

    public function login_attempt($email, $password = NULL, $role_doctor = TRUE) 
    {
        // date_default_timezone_set("Asia/Kolkata");
        $query = $this->role_diff(function() use ($email) {
            return $this->port->p->get_where('doctors', array('email' => $email, 'confirm_status' => 1,), 1);
        }, function() use ($email) {
            return $this->port->p->get_where('patients', array('email' => $email, 'confirm_status' => 1,), 1);
        }, $role_doctor ? self::ROLE_DOCTOR : self::ROLE_PATIENT);
        $userdetail = $query->row();
        if (!empty($userdetail)) {
            if ($userdetail->login_attempt < 3) {
                $this->attempt = 2 - (int) $userdetail->login_attempt;
                $login_attempt = (int) $userdetail->login_attempt + 1;

                $this->port->p->db_select();
                if ($userdetail->login_attempt == 2) {
                    $cur_time = date("Y-m-d H:i:s");
                    $duration = '+120 minutes';
                    $profile_blocktime = date('Y-m-d H:i:s', strtotime($duration, strtotime($cur_time)));
                    $this->port->p->set('blocked_time', $profile_blocktime);
                }
                $this->port->p->set('login_attempt', $login_attempt);
                $this->port->p->where('id', $userdetail->id);
                if ($role_doctor == TRUE) {
                    $this->m->port->p->update('doctors');
                } else {
                    $this->m->port->p->update('patients');
                }
            } else {
                $this->attempt = 3;
            }
        }
    }

    /*     * error msg */

    public function invalid_login_error() 
    {
        return (int) $this->attempt;
    }

    /* end here */

    /**
     *
     */
    public function logout() 
    {
        $this->_login = FALSE;
        $this->_uid = 0;
        $this->_urole = NULL;
        $this->u = NULL;

        $this->session->unset_userdata('login');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
    }

    /*
      |--------------------------------------------------------------------------
      | REGISTER
      |--------------------------------------------------------------------------
      |
      | All functions concerns to register.
      |
     */

    /**
     *
     */
    public function docreg()
    {
        static $_ci;
        if (empty($_ci)) $_ci =& get_instance();

        $_ci->load->language('reg', $this->lang);

        $email = $this->input->post('email');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $birthday = date("Y-m-d", strtotime($this->input->post('birthday')));
        $academic_grade = $this->input->post('academic_grade');
        $password = $this->input->post('password');
        $speciality = $this->input->post('speciality');
        $speciality_additional = $this->input->post('speciality_additional');

        $speciality = is_array($speciality) ? implode(',', $speciality) : $speciality;
        $speciality_additional = is_array($speciality_additional) ? implode(',', $speciality_additional) : $speciality_additional;

        $mobile = $this->input->post('mobile');
        $telephone = $this->input->post('telephone');
        $fax = $this->input->post('fax');
        $street = $this->input->post('street');
        $street_additional = $this->input->post('street_additional');
        $postal_code = $this->input->post('postal_code');
        $locality = $this->input->post('locality');
        $region = $this->input->post('region');
        $country = $this->input->post('country');
        $website = $this->input->post('website');
        $emergency_number = $this->input->post('emergency_number');
        $terms = $this->input->post('terms');

        $this->port->p->db_select();
        $query = $this->port->p->get_where('doctors', array('email' => $email,), 1);

        if ($query->num_rows() > 0) {
            return ($this->_error[] = self::ERROR_EMAIL) ? FALSE : FALSE;
        }

        $this->port->p->db_select();
        $this->port->p->set('regid', 'D' . strtoupper(substr(md5(uniqid(rand(), 1)), 2, 9)));
        $this->port->p->set('pin', sprintf("%04d", mt_rand(0, 9999)));
        $this->port->p->set('email', $email);
        $this->port->p->set('academic_grade', $academic_grade);
        $this->port->p->set('name', $first_name);
        $this->port->p->set('surname', $last_name);
        //$this->port->p->set('dob'                , $birthday );
        $this->port->p->set('gender', $gender);
        $this->port->p->set('password', md5($password));

        $this->port->p->set('specialization1', $speciality);
        $this->port->p->set('specialization2', $speciality_additional);

        $this->port->p->set('address', $street);
        $this->port->p->set('zip', $postal_code);
        $this->port->p->set('region', $region);
        $this->port->p->set('city', $locality);
        $this->port->p->set('country', $country);
        $this->port->p->set('telephone', $telephone);
        $this->port->p->set('mobile', $mobile);
        $this->port->p->set('fax', $fax);
        $this->port->p->set('website', $website);
        $this->port->p->set('emergency_number', $emergency_number);
        $this->port->p->set('cdate', "NOW()", FALSE);
        $this->port->p->set('confirm_status', 0);
        $this->port->p->set('confirm_code', $confirm_code = random_string('alnum', 16));
        $this->port->p->set('Dr_approv', 0);
        $this->port->p->set('last_password_change_date', date("Y-m-d h:i:s"));

        if ($success = $this->port->p->insert('doctors')) {
            $this->port->p->db_select();
            $last_id = $this->port->p->insert_id();

            $this->login($this->input->post('email'), $this->input->post('password'));

            $user_result['name'] = $first_name;
            $user_result['surname'] = $last_name;
            $user_result['gender'] = $gender;
            $user_result['confirm_code'] = $confirm_code;
            $user_result['email'] = $email;

            $subject = $_ci->lang->line('reg_lang_2nd_email_sub');
            $msg1 = $this->load->view('doctor/email/doctor_first_confirmation_email_view', $user_result, true);
            
        	if($_SERVER['SERVER_NAME']==TEST_SERVER)
            {
            	$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <webmaster@cyomed.com>' . "\r\n";

				mail($email, $subject, $msg1,$headers);
            }
            else 
            {
            	$this->moemail->send_email($email, $subject, $msg1);
            }

            return $last_id;
        } else {
            return ($this->_error[] = self::ERROR_DB_INSERT) ? FALSE : FALSE;
        }
    }

    /**
     *
     */
    public function patreg() {

        static $_ci;
        if (empty($_ci)) $_ci =& get_instance();

        $_ci->load->language('reg', $this->lang);

        $email = $this->input->post('email');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $birthday = date("Y-m-d", strtotime($this->input->post('birthday')));
        $password = $this->input->post('password');
        $mobile = $this->input->post('mobile');
        $telephone = $this->input->post('telephone');
        $fax = $this->input->post('fax');
        $street = $this->input->post('street');
        $street_additional = $this->input->post('street_additional');
        $postal_code = $this->input->post('postal_code');
        $locality = $this->input->post('locality');
        $region = $this->input->post('region');
        $country = $this->input->post('country');
        $terms = $this->input->post('terms');
        

        $this->port->p->db_select();
        $query = $this->port->p->get_where('patients', array('email' => $email,), 1);

        if ($query->num_rows() > 0) {
            return ($this->_error[] = self::ERROR_EMAIL) ? FALSE : FALSE;
        }

        $this->port->p->db_select();
        $this->port->p->set('regid', 'P' . strtoupper(substr(md5(uniqid(rand(), 1)), 2, 9)));
        $this->port->p->set('pin', sprintf("%04d", mt_rand(0, 9999)));
        $this->port->p->set('email', $email);
        $this->port->p->set('name', $first_name);
        $this->port->p->set('surname', $last_name);
        $this->port->p->set('birthname', $this->input->post('birthname'));
        $this->port->p->set('dob', $birthday);
        $this->port->p->set('gender', $gender);
        $this->port->p->set('address', $street);
        $this->port->p->set('zip', $postal_code);
        $this->port->p->set('region', $region);
        $this->port->p->set('city', $locality);
        $this->port->p->set('country', $country);
        $this->port->p->set('telephone', $telephone);
        $this->port->p->set('mobile', $mobile);
        $this->port->p->set('fax', $fax);
        $this->port->p->set('promocode', $this->input->post('promocode'));
        $this->port->p->set('password', md5($password));
        $this->port->p->set('package', "option1");
        $this->port->p->set('cdate', "NOW()", FALSE);
        $this->port->p->set('doctor_access', 1);
        $this->port->p->set('others_access', 1);
        $this->port->p->set('confirm_status', 0);
        $this->port->p->set('confirm_code', $confirm_code = random_string('alnum', 16));
        $this->port->p->set('Pat_approv', 1);
        $this->port->p->set('last_password_change_date', date("Y-m-d h:i:s"));
        if ($success = $this->port->p->insert('patients')) {
            $this->port->p->db_select();
            $last_id = $this->port->p->insert_id();

            $this->login($this->input->post('email'), $this->input->post('password'), FALSE);

            $user_result['name'] = $first_name;
            $user_result['surname'] = $last_name;
            $user_result['gender'] = $gender;
            $user_result['confirm_code'] = $confirm_code;
            $user_result['email'] = $email;
            $subject = $_ci->lang->line('reg_lang_2nd_email_sub');
            $msg1 = $this->load->view('patient/email/patient_first_confirmation_email_view', $user_result, true);
           
            if($_SERVER['SERVER_NAME']==TEST_SERVER)
            {
            	$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <webmaster@cyomed.com>' . "\r\n";

				mail($email, $subject, $msg1,$headers);
            }
            else 
            {
            	$this->moemail->send_email($email, $subject, $msg1);
            }

            return $last_id;
        } else {
            return ($this->_error[] = self::ERROR_DB_INSERT) ? FALSE : FALSE;
        }
    }

    /*
     */

    public function doc_patreg() {
		$first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $telephone = $this->input->post('telephone');
        $gender = $this->input->post('gender');
        $city = $this->input->post('city');
        $password = $this->input->post('first_name').strtoupper(substr(md5(uniqid(rand(), 1)), 2, 3));
        
        
        $this->port->p->db_select();
        $query = $this->port->p->get_where('patients', array('email' => $email,), 1);
        if ($query->num_rows() > 0) {
            //return ($this->_error[] = self::ERROR_EMAIL) ? 'Already Exist' : FALSE;
            
            $this->_error[] = self::ERROR_EMAIL;
        	return FALSE;
        }
        $this->port->p->db_select();
        $this->port->p->set('regid', 'P' . strtoupper(substr(md5(uniqid(rand(), 1)), 2, 9)));
        $this->port->p->set('email', $email);
        $this->port->p->set('name', $first_name);
        $this->port->p->set('surname', $last_name);
        $this->port->p->set('gender', $gender);
        $this->port->p->set('city', $city);        
        $this->port->p->set('telephone', $telephone);
        $this->port->p->set('mobile', $mobile);
        $this->port->p->set('password', md5($password));
        $this->port->p->set('package', "option1");
        $this->port->p->set('cdate', "NOW()", FALSE);
        $this->port->p->set('doctor_access', 1);
        $this->port->p->set('others_access', 1);
        $this->port->p->set('confirm_status', 1);
        $this->port->p->set('confirm_code', $confirm_code = random_string('alnum', 16));
        $this->port->p->set('Pat_approv', 1);
        $this->port->p->set('force_login', '0');
        if ($success = $this->port->p->insert('patients')) {
            $this->port->p->db_select();
            $last_id = $this->port->p->insert_id();
            $this->login($this->input->post('email'), $this->input->post('password'), FALSE);
            $user_result['name'] = $first_name;
            $user_result['surname'] = $last_name;
            $user_result['gender'] = $gender;
            $user_result['confirm_code'] = $confirm_code;
            $user_result['email'] = $email;
            $subject = "Willkommen bei Cyomed";
            //$msg1 = $this->load->view('patient/email/patient_first_confirmation_email_view', $user_result, true);
            $msg1 = "<html>
<body>";
            if ($gender == 1) {
                $gendermsg = "geehrte Frau";
            } else {
                $gendermsg = "geehrter Herr";
            }
            $msg1.="
<p>Sehr " . $gendermsg . "&nbsp;" . $first_name . "&nbsp;" . $last_name . ",</p>
<p>Wilkommen Sie bei cyomed. </p>
<p> Hier Ihre Temporary password ";
            $msg1 .= ":".$password."</p>
<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p><strong>Ihr Cyomed Team</strong></p>
</body>
</html>";
           
        	if($_SERVER['SERVER_NAME']==TEST_SERVER)
            {
            	$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <webmaster@cyomed.com>' . "\r\n";

				mail($email, $subject, $msg1,$headers);
            }
            else 
            {
            	$this->moemail->send_email($email, $subject, $msg1);
            }
            
            return $last_id;
        } else {
            return ($this->_error[] = self::ERROR_DB_INSERT) ? FALSE : FALSE;
        }
    }

    /*

     */
    /*
      |--------------------------------------------------------------------------
      | SECURITY
      |--------------------------------------------------------------------------
      |
     */

    /**
     * when wants to change his existing password
     */
    public function update_password() 
    {
        $password_old = $this->input->post('password_old');
        $password_new = $this->input->post('password_new');
        $password_repeat = $this->input->post('password_repeat');
        $query = $this->port->p->get_where(
                $this->role_diff(array(
                    self::ROLE_DOCTOR => function() {
                        return 'doctors';
                    },
                    self::ROLE_PATIENT => function() {
                        return 'patients';
                    },
                )), array(
            'id' => $this->_uid,
            'password' => md5($password_old),
                ), 1
        );

        if ($query->num_rows() <= 0) {
            return ($this->_error[] = self::ERROR_PASSWORD) ? FALSE : FALSE;
        }
        $this->port->p->set('password', md5($password_new));
        $current_date_time = date("Y-m-d h:i:s");
        $this->port->p->set('last_password_change_date', $current_date_time);
        $this->port->p->where('id', $this->_uid);
        return $result = $this->port->p->update(
                $this->role_diff(array(
                    self::ROLE_DOCTOR => function() {
                        return 'doctors';
                    },
                    self::ROLE_PATIENT => function() {
                        return 'patients';
                    },
                ))
        );
    }

    /*
      |--------------------------------------------------------------------------
      | USER & USER_* FUNCTIONS
      |--------------------------------------------------------------------------
      |
     */

    /**
     *
     */
    public function user_id() 
   {
        return $this->_uid;
    }

    /**
     *
     */
    public function user_role() {
        return $this->_urole;
    }

    /**
     *
     */
    public function user() {
     return $this->u;
    }

    public function user_details($addedby,$userrole)
    {
        $this->port->p->db_select();
       
       if($userrole=='role_doctor')
       {
               $result=$this->port->p->get_where('doctors', array('id' => $addedby), 1);
               $res= $result->row();
       }
       else
       {
               $result= $this->port->p->get_where('patients', array('id' => $addedby),1);
               $res= $result->row();
       }
       return $res;
    }
    /**
     *
     */
    public function user_value($field, $default = '') {
        foreach (array('', 'native', 'doctor_settings') as $nszone) {
            if ($nszone && isset($this->u->$nszone)) {
                if (isset($this->u->$nszone->$field)) {
                    return form_prep($this->u->$nszone->$field);
                }
            } else {
                if (isset($this->u->$field)) {
                    return form_prep($this->u->$field);
                }
            }
        }
        return $default;
    }

    /**
     *
     */
    public function us_id() {
        return !empty($this->s) && !empty($this->s->id) ? $this->s->id : FALSE;
    }

    /**
     *
     */
    public function us_access() {
        return $this->_saccess;
    }

    /**
     *
     */
    public function us() {
        return $this->s;
    }

    /**
     *
     */
    public function us_value($field, $default = '') {
        foreach (array('', 'native', 'doctor_settings') as $nszone) {
            if ($nszone && isset($this->s->$nszone)) {
                if (isset($this->s->$nszone->$field)) {
                    return form_prep($this->s->$nszone->$field);
                }
            } else {
                if (isset($this->s->$field)) {
                    return form_prep($this->s->$field);
                }
            }
        }
        return $default;
    }

    /**
     *
     */
    public function user_checkbox($field, $value = '1', $default = FALSE) {
        foreach (array('', 'native', 'doctor_settings') as $nszone) {
            if ($nszone && isset($this->u->$nszone)) {
                if (isset($this->u->$nszone->$field)) {
                    return $this->u->$nszone->$field == $value ? ' checked="checked" ' : '';
                }
            } else {
                if (isset($this->u->$field)) {
                    return $this->u->$field == $value ? ' checked="checked" ' : '';
                }
            }
        }
        return $default ? ' checked="checked" ' : '';
    }

    /**
     *
     */
    public function user_radio($field, $value = '1', $default = FALSE) {
        foreach (array('', 'native', 'doctor_settings') as $nszone) {
            if ($nszone && isset($this->u->$nszone)) {
                if (isset($this->u->$nszone->$field)) {
                    return $this->u->$nszone->$field == $value ? ' checked="checked" ' : '';
                }
            } else {
                if (isset($this->u->$field)) {
                    return $this->u->$field == $value ? ' checked="checked" ' : '';
                }
            }
        }
        return $default ? ' checked="checked" ' : '';
    }

    /**
     *
     */
    public function user_select($field, $value, $default = FALSE) {
        foreach (array('', 'native', 'doctor_settings') as $nszone) {
            if ($nszone && isset($this->u->$nszone)) {
                if (isset($this->u->$nszone->$field)) {
                    return $this->u->$nszone->$field == $value ? ' selected="selected" ' : '';
                }
            } else {
                if (isset($this->u->$field)) {
                    return $this->u->$field == $value ? ' selected="selected" ' : '';
                }
            }
        }
        return $default ? ' selected="selected" ' : '';
    }

    /*
      |--------------------------------------------------------------------------
      | MISC
      |--------------------------------------------------------------------------
      |
     */

    /**
     *
     */
    public function last_error() {
        return ($c = count($this->_error)) > 0 ? $this->_error[$c - 1] : FALSE;
    }

    /**
     *
     */
    public function role_diff() {
        $args = func_get_args();

        // One array para = array(
        //   role1 => array( 'func' => ('func_name' | closure ) , 'args' => array(args) , )
        //   role2 => array( 'func' => ('func_name' | closure ) , 'args' => array(args) , )
        // )
        if (count($args) == 1) {
            if (is_array($args[0])) {
                $closures = $args[0];

                if (!empty($closures[$this->_urole])) {
                    $closure = $closures[$this->_urole];

                    if (is_array($closure)) {
                        if (!empty($closure['func'])) {
                            return call_user_func_array($closure['func'], !empty($closure['func']) ? $closure['func'] : array());
                        } elseif (is_string($closure[0]) || is_closure($closure[0])) {
                            $func = array_shift($closure[0]);
                            return call_user_func_array($func, $closure[0]);
                        }
                    }

                    if (is_string($closure) || is_closure($closure)) {
                        return call_user_func_array($closure, array());
                    }
                }
            }

            return FALSE;
        }

        // 2 Closures Passed, 1.doctor closure, 2.patient closure, [3. role]
        if (count($args) == 2 || count($args) == 3) {
            $closure = FALSE;
            $doc_func = $args[0];
            $pat_func = $args[1];

            if (count($args) == 2 && $this->_urole == self::ROLE_DOCTOR || count($args) == 3 && $args[2] == self::ROLE_DOCTOR) {
                $closure = $doc_func;
            }

            if (count($args) == 2 && $this->_urole == self::ROLE_PATIENT || count($args) == 3 && $args[2] == self::ROLE_PATIENT) {
                $closure = $pat_func;
            }

            if (is_array($closure)) {
                if (!empty($closure['func'])) {
                    return call_user_func_array($closure['func'], !empty($closure['func']) ? $closure['func'] : array());
                } elseif (is_string($closure[0]) || is_closure($closure[0])) {
                    $func = array_shift($closure[0]);
                    return call_user_func_array($func, $closure[0]);
                }
            }

            if (is_string($closure) || is_closure($closure)) {
                return call_user_func_array($closure, array());
            }

            return FALSE;
        }

        // 2 Closures and their args passed, [a role as the 5. para can be passed]
        if (count($args) == 4 || count($args) == 5) {
            $closure = FALSE;
            $doc_func = $args[0];
            $doc_args = is_array($args[1]) ? $args[1] : array($args[1],);
            $pat_func = $args[2];
            $pat_args = is_array($args[3]) ? $args[3] : array($args[3],);

            if (count($args) == 4 && $this->_urole == self::ROLE_DOCTOR || count($args) == 5 && $args[4] == self::ROLE_DOCTOR) {
                $closure = $doc_func;
                $funcarg = $doc_args;
            }

            if (count($args) == 4 && $this->_urole == self::ROLE_PATIENT || count($args) == 5 && $$args[4] == self::ROLE_PATIENT) {
                $closure = $pat_func;
                $funcarg = $pat_args;
            }

            if (is_array($closure)) {
                if (!empty($closure['func'])) {
                    return call_user_func_array($closure['func'], $funcarg + (!empty($closure['func']) ? $closure['func'] : array() ));
                } elseif (is_string($closure[0]) || is_closure($closure[0])) {
                    $func = array_shift($closure[0]);
                    return call_user_func_array($func, $funcarg + ( $closure[0] ));
                }
            }

            if (is_string($closure) || is_closure($closure)) {
                return call_user_func_array($closure, $funcarg);
            }

            return FALSE;
        }

        return FALSE;
    }

    /*
      |--------------------------------------------------------------------------
      | SELECTING
      |--------------------------------------------------------------------------
      |
      |
     */

    /**
     *
     */
    public function get($db, $table, $condition, $encrypted_fields = array(), $default_cond = NULL,$additional_params =array(),$limit='') {


        if (!is_array($condition)) {
            $condition = array(self::$default_field => $condition,);
        }

//        if (count($condition) <= 0) {
//            return array();
//        }

        if ($default_cond === NULL) {
            $default_cond = self::$default_cond;
        }

        if (!is_array($encrypted_fields)) {
            $encrypted_fields = array();
        }
        if(!empty($additional_params)){
            $this->m->port->$db->order_by($additional_params['order_by_field'],$additional_params['order_by_method']);
            if(isset($additional_params['limit']) && $additional_params['limit']!=''){
                $this->m->port->$db->limit($additional_params['limit']);
            }
        }
        
        foreach ($condition as $field => $value) {
            if ($field) {
                if (in_array($field, $encrypted_fields)) {
                    $this->m->port->$db->where($field, $this->aes_encrypt->en($value));
                } else {
                    $this->m->port->$db->where($field, $value);
                }
            }
        }

        foreach ($default_cond as $field => $value) {
            if ($field && !isset($condition[$field])) {
                $this->m->port->$db->where($field, $value);
            }
        }

        $this->m->port->$db->from($table);

        $this->m->port->$db->db_select();
        
        $query = $this->m->port->$db->get();

        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                # Encrypted values
                if (@$encrypted_fields[0] != 'familyhistory') {
                    if (count($encrypted_fields) > 0) {
                        foreach ($encrypted_fields as $field) {
                            if (self::$encrypted_fields_bin2hex) {
                                $row->{$field . '_aes'} = remove_invisible_characters(bin2hex($row->$field));
                            } else {
                                $row->{$field . '_aes'} = $row->$field;
                            }
                            $row->$field = remove_invisible_characters($this->aes_encrypt->de($row->$field));
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
    public function db_where($db, $condition, $encrypted_fields = array(), $default_cond = NULL) {
        if (!is_array($condition)) {
            $condition = array(self::$default_field => $condition,);
        }

        if (count($condition) <= 0) {
            return FALSE;
        }

        if ($default_cond === NULL) {
            $default_cond = self::$default_cond;
        }

        if (!is_array($encrypted_fields)) {
            $encrypted_fields = array();
        }

        foreach ($condition as $field => $value) {
            if ($field) {
                if (in_array($field, $encrypted_fields)) {
                    $value = $this->aes_encrypt->en($value);
                }

                $this->m->port->$db->where($field, $value);
            }
        }

        foreach ($default_cond as $field => $value) {
            if ($field) {
                $this->m->port->$db->where($field, $value);
            }
        }

        return TRUE;
    }

    /**
     *
     */
    public function db_set($db, $arr, $plain_fields, $datetime_fields, $encrypted_fields) {
        foreach ($arr as $field => $value) {
            if (in_array($field, $encrypted_fields)) {
                $this->m->port->$db->set($field, $arr[$field] = $this->aes_encrypt->en($value));
            }
        }

        foreach ($plain_fields as $field) {
            if (isset($arr[$field])) {
                $this->m->port->$db->set($field, $arr[$field]);
            }
        }

        foreach ($datetime_fields as $field) {
            if (isset($arr[$field])) {
                if ($arr[$field] === TRUE) {
                    $this->m->port->$db->set($field, 'NOW()', FALSE);
                } else {
                    $this->m->port->$db->set($field, $arr[$field]);
                }
            }
        }
    }

    /*
     *  Update Ip address of vistiors
     */

        function updateIp($email_data, $role_doctor = false) 
    {

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        $this->port->p->set('ip_address', $ip);
        $this->port->p->where('email', $email_data);
        if ($role_doctor) {
            $result = $this->port->p->update('doctors');
        } else {
            $result = $this->port->p->update('patients');
        }
        return $result;
   }

    public function get_Age_difference($start_date, $end_date) {
        $startdate = explode('-', $start_date);
        $start_year = (int) $startdate['0'];
        $start_month = (int) $startdate['1'];
        $start_day = (int) $startdate['2'];
        $currentdate = explode('-', $end_date);
        $current_year = (int) $currentdate['0'];
        $current_month = (int) $currentdate['1'];
        $current_date = (int) $currentdate['2'];
        $result = '';

        /** days of each month * */
        for ($x = 1; $x <= 12; $x++) {

            $dim[$x] = date('t', mktime(0, 0, 0, $x, 1, date('Y')));
        }


        /** calculate differences * */
        $m = $current_month - $start_month;
        $d = $current_date - $start_date;
        $y = $current_year - $start_year;


        /** if the start day is ahead of the end day * */
        if ($d < 0) {

            $today_day = $current_date + $dim[$current_month];
            $today_month = $current_month - 1;
            $d = $today_day - $start_date;
            $m = $today_month - $start_month;
            if (($today_month - $start_month) < 0) {

                $today_month += 12;
                $today_year = $current_year - 1;
                $m = $today_month - $start_month;
                $y = $today_year - $start_year;
            }
        }


        /** if start month is ahead of the end month * */
        if ($m < 0) {

            $today_month = $current_month + 12;
            $today_year = $current_year - 1;
            $m = $today_month - $start_month;
            $y = $today_year - $start_year;
        }


        /** Calculate dates * */
        if ($y < 0) {

            $result = "Start Date Entered is a Future date than End Date.";
        } else {
            switch ($y) {

                case 0 : $result .= '';
                    break;
                case 1 : $result .= $y . ($m == 0 && $d == 0 ? ' year old' : ' year');
                    break;
                default : $result .= $y . ($m == 0 && $d == 0 ? ' years old' : ' years');
            }


            /*  switch($m) {

              case 0: $result .= ''; break;
              case 1: $result .= ($y == 0 && $d == 0 ? $m.' month old' : ($y == 0 && $d != 0 ? $m.' month' : ($y != 0 && $d == 0 ? ' and '.$m.' month old' : ', '.$m.' month'))); break;
              default: $result .= ($y == 0 && $d == 0 ? $m.' months old' : ($y == 0 && $d != 0 ? $m.' months' : ($y != 0 && $d == 0 ? ' and '.$m.' months old' : ', '.$m.' months'))); break;

              }


              switch($d) {

              case 0: $result .= ($m == 0 && $y == 0 ? 'Today' : ''); break;
              case 1: $result .= ($m == 0 && $y == 0 ? $d.' day old' : ($y != 0 || $m != 0 ? ' and '.$d.' day old' : '')); break;
              default: $result .= ($m == 0 && $y == 0 ? $d.' days old' : ($y != 0 || $m != 0 ? ' and '.$d.' days old' : ''));

              } */
        }

        return $result;
    }
    
    public function getAppdata($user_role,$api_name)
    {
        $user_id = $this->user_id();
        $this->port->p->where('user_id', $user_id);
        $result = $this->port->p->get_where('app_data', array( 'user_role' => $user_role,'app_name' => $api_name), 1);
        if($result->num_rows()>0){
        return $result->row();
        }
        else{
            return array();
        }
    }
    
    public function insertAppData($app_user_id,$app_data,$user_role,$app_name){
        $user_id = $this->user_id();
        $this->port->p->set('user_id',$user_id);
        $this->port->p->set('app_user_id',$app_user_id);
        $app_data = json_encode($app_data);
        $this->port->p->set('data',$app_data);
        $this->port->p->set('app_name',$app_name);
        $this->port->p->set('user_role',$user_role);    
        return  $this->port->p->insert('app_data');
    }
    
    public function updateAppData($app_user_id,$app_data,$user_role,$app_name){
        $user_id = $this->user_id();
        $this->port->p->where('user_id',$user_id);
        $this->port->p->set('app_user_id',$app_user_id);
        $app_data = json_encode($app_data);
        $this->port->p->set('data',$app_data);
        $this->port->p->where('app_name',$app_name);
        $this->port->p->where('user_role',$user_role);    
        return $this->port->p->update('app_data');
    }
    
/**
 *this function for the notify for patient and doctor while they login from different ip 
 */
    public function notify_ip_msg(){
        $status=0;
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

         $data=$this->getCityIp($ip);
         $current_city=  strtolower($data[0]);
         $current_country=strtolower($data[1]);
         
         $isipexist=$this->isIpLoginExist($current_city,$current_country);
     
         
        if($isipexist){

            $id=$isipexist->id;
            $older_ip=$isipexist->ip_address;


            if($ip!=$older_ip){

                $this->updateLoginIp($id,$ip);

            }

        }
        else{
                $this->insertLoginIp($ip,$current_city,$current_country);
                $status=1;
        }
       return $status;
    }
    
   /**
    *this fnction is for the  get the city or country code while login by using thirt party
    * @param type $ip string
    * @return type array
    */ 
    public function getCityIp($ip){
        $addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        $city = isset($addr_details['geoplugin_city'])?stripslashes(ucfirst($addr_details['geoplugin_city'])):'';
        $countrycode = stripslashes(ucfirst($addr_details['geoplugin_countryCode']));
        $data=array($city,$countrycode);
        return $data;
    }
    
    /**
     *function for check if there is exist data for user with city or country while login
     * @param type $city string
     * @param type $country string
     * @return type 
     */
    public function isIpLoginExist($city,$country){
        $user_id=  $this->user_id();
        $user_role=  $this->user_role();
        $result = $this->port->p->get_where('login_ip_tracking_record', array( 'city_name'=>$city,'country_code'=>$country, 'user_role' => $user_role,'user_id' => $user_id), 1);
        return $result->row();
     
    }
    
    /**
     *this function for update the data of the user with different ip while login
     * @param type $id integer
     * @param type $ip string
     * @return type 
     */
    public function updateLoginIp($id,$ip){
        
         $this->port->p->set('login_date_time',date("Y-m-d H:i:s"));
         $this->port->p->set('ip_address',$ip);
         $this->port->p->where('id',$id );
        return $this->port->p->update('login_ip_tracking_record');
    }
    
    /**
     *this function for insert the data of the user related to the login ip
     * @param type $ip
     * @param type $city
     * @param type $countrycode
     * @return type 
     */
    public function insertLoginIp($ip,$city,$countrycode){
          $user_id=  $this->user_id();
        $user_role=  $this->user_role();    
        $this->port->p->set('ip_address',$ip);
        $this->port->p->set('login_date_time',date("Y-m-d H:i:s"));
         $this->port->p->set('city_name',$city);
         $this->port->p->set('country_code',$countrycode);
          $this->port->p->set('user_id',$user_id);
        $this->port->p->set('user_role',$user_role);
        return $this->port->p->insert('login_ip_tracking_record');
     
    }
    
    public function getprofiledata()
    {
        if($this->user_role()=='role_doctor')
         {
           $user_id=  $this->user_id();  
           $user_role=  $this->user_role();    
           $this->port->p->db_select();
          
           $result=$this->port->p->get_where('doctors', array('id' => $user_id,), 1);
           $profileobj = $result->row();
           $profilestatus=0;
          
           /*** Profile Data ***/
           if(!empty($profileobj->name))
           {
                $profilestatus+=15;
           }
           if(!empty($profileobj->surname))
           {
                $profilestatus+=15;
           }
           if(!empty($profileobj->academic_grade))
           {
                $profilestatus+=10; 
           }
           if(!empty($profileobj->prac_address))
           {
                $profilestatus+=10; 
           }
           /**** end here ***/
           
           /*** mailing address ***/
           if(!empty($profileobj->address))
           {
                $profilestatus+=4;
           }
           if(!empty($profileobj->zip))
           {
                $profilestatus+=4;
           }
           if(!empty($profileobj->city))
           {
                $profilestatus+=4; 
           }
           if(!empty($profileobj->region))
           {
                $profilestatus+=4; 
           }
           if(!empty($profileobj->country))
           {
                $profilestatus+=4; 
           }
           if(!empty($profileobj->telephone))
           {
                $profilestatus+=4; 
           }
           if(!empty($profileobj->mobile))
           {
                $profilestatus+=3; 
           }
           if(!empty($profileobj->fax))
           {
                $profilestatus+=3; 
           }
           /*** end here ***/
          
           /*** Additional Detail ***/
          
           if(!empty($profileobj->relationship_status))
           {
                $profilestatus+=3; 
           }
          
           if(!empty($profileobj->emergency_number))
           {
                $profilestatus+=3; 
           }
         
           if(!empty($profileobj->occupation))
           {
                $profilestatus+=3; 
           }
           
           if(!empty($profileobj->specialization1))
           {
                $profilestatus+=3; 
           }
           if(!empty($profileobj->ethnicity))
           {
                $profilestatus+=3; 
           }
           if(!empty($profileobj->race))
           {
                $profilestatus+=3; 
           }
           if(!empty($profileobj->website))
           {
                $profilestatus+=2; 
           }
           /*** end here ***/
           /*echo $profilestatus; exit;*/
           return $profilestatus;       
         }
         else
         {
             return 0;
         }
    }
}



/* End of file m.php */
/* Location: ./application/models/m.php */