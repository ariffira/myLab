<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod extends CI_Model {

  const ERROR_EMAIL = 'error_email';
  const ERROR_PASSWORD = 'error_password';

  const ERROR_DB_INSERT = 'error_db_insert';

  public static $default_cond = array('delete_status' => 0,);
  public static $encrypted_fields_bin2hex = FALSE;

  public static $activation_fields = array(
    'Dr_approv', 'confirm_status', 'iconsult_status', 
    'Pat_approv', 'private_access', 'doctor_access', 'others_access', 'payment_method', 'direct_debit', 'revocation', 
  );
  public static $country_fields = array('country', );
  public static $speciality_fields = array('speciality', 'specialization1', 'specialization2', 'additional_title1', 'additional_title2', 'additional_title3', );
  public static $access_permission_fields = array('access_permission', );
  public static $patient_package_fields = array('package', );
  public static $online_modules = array(
    array('module' => 'medical_condition', 'text' => 'Medical Condition', ),
    array('module' => 'diagnosis', 'text' => 'Diagnosis', ),
    array('module' => 'diagnosis_archive', 'text' => 'Diagnosis Archive', ),
    array('module' => 'diagnosis_allergies', 'text' => 'Allergies Diagnosis', ),
    array('module' => 'diagnosis_travels', 'text' => 'Travel Diagnosis', ),
    array('module' => 'medication', 'text' => 'Medication', ),
    array('module' => 'document', 'text' => 'Documents', ),
    array('module' => 'graphs', 'text' => 'Vital Values', ),
    array('module' => 'vaccination', 'text' => 'Vaccination', ),
    array('module' => 'iconsult', 'text' => 'iConsult', ),
    array('module' => 'reservation', 'text' => 'eAppointment', ),
  );
  public static $admin_online_modules = array(
    array('module' => 'patient', 'text' => 'Patient General Management', ),
    array('module' => 'doctor', 'text' => 'Doctor General Management', ),
    array('module' => 'reservation', 'text' => 'Reservation General Management', ),
    array('module' => 'email', 'text' => 'Email General Management', ),
    array('module' => 'admin', 'text' => 'Admin Users Management', ),
    array('module' => 'misc', 'text' => 'Misc. Items', ),
  );

  public $port = NULL;
  public $dy_config = NULL;

  private $_error = array();

  private $_login = FALSE;
  private $_user_id = 0;
  private $_user_role = NULL;
  private $u = NULL;

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();

    $_ci =& get_instance();
    $_ci->mod =& $this;

    $this->load->library('encrypt');
    $this->load->library('aes_encrypt');
    $this->load->library('session');
    $this->load->library('form_validation');

    // $this->load->database('production');
    $this->port = (object)array(
      '_' => $this->load->database('production', TRUE), 
      'p' => $this->load->database('port_personal', TRUE), 
      'm' => $this->load->database('port_medical', TRUE), 
    );

    $this->db_check();

    $this->load->model('language');
    $this->load->model('speciality');
    $this->load->model('insurance_provider');

    $this->load->model('modoc');
    $this->load->model('mopat');
    $this->load->model('moadmin');
    $this->load->model('mopack');
    $this->load->model('moterm');
    
    $this->load->model('moemail');

    $this->load->model('module');
    $this->load->model('minvoice');

    $this->login_check();
  }

  /**
   *
   */
  public function db_check()
  {
    // Table Config

    if (!$this->mod->port->p->table_exists('config'))
    {
      $this->load->dbforge();
      $this->mod->port->p->db_select();

      $this->dbforge->add_field($fields_config = array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'key' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'value' => array(
          'type' => 'TEXT',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('key');
      $this->dbforge->create_table('config');
    }

    $this->mod->port->p->db_select();
    $query = $this->mod->port->p->get('config');

    $this->dy_config = new stdClass();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $this->dy_config->{$row->key} = $row->value;
      }
    }

    foreach (array(
      'email_protocol' => 'smtp', 
      'email_smtp_host' => 'vwp3097.webpack.hosteurope.de', 
      'email_smtp_user' => 'wp1052892-102', 
      'email_smtp_pass' => 'DrZoidberg', 
      'email_smtp_port' => '25', 
      'email_mailtype' => 'html', 
      'email_sender_address' => 'kundenservice@ihrarzt24.de', 
      'email_sender_name' => 'Kundenservice IhrArzt24', 
      'package_running_time_type' => 'static', 
      'package_running_time' => '28', 
      'package_running_time_quant' => 'day', 
      'package_cancel_buffer_type' => 'static', 
      'package_cancel_buffer' => '28', 
      'package_cancel_buffer_quant' => 'day', 
      'doctor_confirm_subject' => 'Welcome to Cyomed - Email confirm',
      'doctor_confirm_content' => $this->load->view('templates/default_confirm_email_doctor_view', array(), TRUE),
      'patient_confirm_subject' => 'Welcome to Cyomed - Email confirm',
      'patient_confirm_content' => $this->load->view('templates/default_confirm_email_doctor_view', array(), TRUE),
      'invoice_template' => $this->load->view('templates/default_invoice_view', array(), TRUE), 
    ) as $config_key => $config_default_value)
    {
      if (!isset($this->dy_config->$config_key))
      {
        $this->dy_config->$config_key = $config_default_value;

        $this->mod->port->p->db_select();
        $this->mod->port->p->set('key', $config_key);
        $this->mod->port->p->set('value', $config_default_value);

        $this->mod->port->p->insert('config');
      }
    }
  }

  /**
   *
   */
  public function login_check()
  {
    $user = FALSE;

    if ($this->session->userdata('login'))
    {
      $user_id   = $this->encrypt->decode($this->session->userdata('user_id'));
      $user_role = $this->encrypt->decode($this->session->userdata('user_role'));

      $this->port->p->db_select();
      $query = $this->port->p->get_where('admin', array('id' => $user_id, ), 1);
      if ($query->num_rows() > 0)
      {
        $user = $query->row();
        $user_role = $user->role;
      }
    }

    if ($user)
    {
      $this->_login = TRUE;
      $this->_user_id = $user_id;
      $this->_user_role = $user_role;
      $this->u = $user;
    }
    else
    {
      $this->_login = FALSE;
      $this->_user_id = 0;
      $this->_user_role = NULL;
      $this->u = NULL;

      $this->session->unset_userdata('login');
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('user_role');
    }
  }

  /**
   *
   */
  public function login_redirect()
  {
    if (!$this->_login)
    {
      $this->output->set_status_header(302);
      $this->output->set_header('X-Cyomed-Redirect: '.site_url('auth/login'), false);
      // redirect('auth/login');
      return TRUE;
    }

    return FALSE;
  }

  /**
   *
   */
  public function login($email, $password = NULL)
  {
    
    $this->port->p->db_select();

    if (!$this->port->p->table_exists('admin'))
    {
      $this->load->dbforge();
      $this->port->p->db_select();

      $this->dbforge->add_field(array(
        'id' => array(
          'type' => 'INT',
          'unsigned' => TRUE,
          'auto_increment' => TRUE,
        ),
        'email' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'password' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'role' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
      ));

      $this->dbforge->add_key('id', TRUE);
      $this->dbforge->add_key('email');
      $this->dbforge->create_table('admin');

      $this->port->p->db_select();
      $this->port->p->set('email', $email);
      $this->port->p->set('password', md5($password));
      $this->port->p->set('role', 9);
      $this->port->p->insert('admin');
    }

    $query = $this->port->p->get_where('admin', array('email' => $email, ), 1);
    

    if ($password === NULL)
    {
      return $query->num_rows() > 0 ? $query->row() : ( ($this->_error[] = self::ERROR_email) ? FALSE : FALSE);
    }    

    if ($query->num_rows() > 0)
    {
      $row = $query->row();

      if ($row->password == md5($password))
      {
        $this->session->set_userdata('login', $this->_login = TRUE);
        $this->session->set_userdata('user_id', $this->_user_id = $this->encrypt->encode($row->id));
        $this->session->set_userdata('user_role', $this->_user_role = $this->encrypt->encode(isset($row->role) ? $row->role : 0));
        return TRUE;
      }
      else
      {
        return ($this->_error[] = self::ERROR_PASSWORD) ? FALSE : FALSE;
      }
    }
    else
    {
      return ($this->_error[] = self::ERROR_EMAIL) ? FALSE : FALSE;
    }
  }

  /**
   *
   */
  public function logout()
  {
    $this->_login = FALSE;
    $this->_user_id = 0;
    $this->_user_role = NULL;
    $this->u = NULL;

    $this->session->unset_userdata('login');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_role');
  }

  /**
   *
   */
  public function update_password()
  {
    $password_old    = $this->input->post('password_old');
    $password_new    = $this->input->post('password');
    $password_repeat = $this->input->post('password2');

    if ($password_new !== $password_repeat)
    {
      return ($this->_error[] = self::ERROR_PASSWORD) ? FALSE : FALSE;
    }

    $query = $this->port->p->get_where('admin', array('id' => $this->_user_id, 'password' => md5($password_old), ), 1);

    if ($query->num_rows() <= 0)
    {
      return ($this->_error[] = self::ERROR_PASSWORD) ? FALSE : FALSE;
    }

    $this->port->p->set('password', md5($password_new));
    $this->port->p->where('id', $this->_user_id);

    echo md5($password_new);

    return $result = $this->port->p->update('admin');
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
    public function register()
    {
    $email                 = $this->input->post('email');
    $first_name            = $this->input->post('first_name');
    $last_name             = $this->input->post('last_name');
    $password              = $this->input->post('password');
    $role                  = $this->input->post('role');


    $this->port->p->db_select();
    $query = $this->port->p->get_where('admin', array('email' => $email, ), 1);

    if ($query->num_rows() > 0)
    {
      return ($this->_error[] = self::ERROR_email) ? FALSE : FALSE;
    }

    $this->port->p->db_select();
    $this->port->p->set('regid'              , 'D'.strtoupper(substr(md5(uniqid(rand(), 1)), 2, 9)) );
    $this->port->p->set('email'              , $email );
    $this->port->p->set('name'               , $first_name );
    $this->port->p->set('surname'            , $last_name );
    $this->port->p->set('password'           , md5($password) );
    $this->port->p->set('role'               , $role );


    $this->port->p->set('cdate'              , "NOW()", FALSE );
    $this->port->p->set('confirm_status'     , 1 );
    $this->port->p->set('confirm_code'       , $confirm_code = random_string('alnum', 16) );

    if ($success = $this->port->p->insert('admin'))
    {
      $this->port->p->db_select();
      $last_id = $this->port->p->insert_id();

      //$this->login($this->input->post('email'), $this->input->post('password'));

      $user_result['name'] = $first_name;
      $user_result['surname'] = $last_name;
      $user_result['gender'] = $gender;
      $user_result['confirm_code'] = $confirm_code;
      $user_result['email'] = $email;

      //$subject= "Willkommen bei Cyomed";
      //$msg1 = $this->load->view('doctor/email/doctor_first_confirmation_email_view', $user_result, true);
      //$this->moemail->send_email($email,$subject,$msg1);

      return $last_id;
    }
    else
    {
      return ($this->_error[] = self::ERROR_DB_INSERT) ? FALSE : FALSE;
    }

  }

  /**
   *
   */
  public function do_upload($type = 'general')
  {
    $config = array();

    $config['upload_path'] = './assets/uploads/admin/'.md5($this->mod->user_id()).'/'.trim($type, '/').'/';
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
  public function update_profile()
  {

    $first_name            = $this->input->post('first_name');
    $last_name             = $this->input->post('last_name');


    $upload_result = $this->do_upload('avatar');

    $this->port->p->db_select();
    $this->port->p->set('name'               , $first_name );
    $this->port->p->set('surname'            , $last_name );



    if ($upload_result)
    {
      $this->port->p->set('avatar', base_url($upload_result['upload_path'].$upload_result['file_name']));
    }

    $this->port->p->where('id', $this->mod->user_id());

    $this->port->p->db_select();
    return $this->port->p->update('admin');

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
  public function user_id()
  {
    return $this->_user_id;
  }

  /**
   *
   */
  public function user_role()
  {
    return $this->_user_role;
  }

  /**
   *
   */
  public function user()
  {
    return $this->u;
  }

  public function user_value($field, $default = '')
  {
    return isset($this->u->$field) ? form_prep($this->u->$field) : $default;
  }

  public function user_checkbox($field, $value = '1', $default = FALSE)
  {
    return isset($this->u->$field) ? ($this->u->$field == $value ? ' checked="checked" ' : '') : ($default ? ' checked="checked" ' : '');
  }

  public function user_radio($field, $value = '1', $default = FALSE)
  {
    return isset($this->u->$field) ? ($this->u->$field == $value ? ' checked="checked" ' : '') : ($default ? ' checked="checked" ' : '');
  }

  public function user_select($field, $value, $default = FALSE)
  {
    return isset($this->u->$field) ? ($this->u->$field == $value ? ' selected="selected" ' : '') : ($default ? ' selected="selected" ' : '');
  }

  /**
   *
   */
  public function port(&$foreign, &$native, $infos = NULL)
  {
    if ($infos === NULL)
    {
      $infos = self::$default_porting_infos;
    }

    foreach ($infos as $foreign_col => $native_col)
    {
      if (isset($foreign->$foreign_col))
      {
        $native->$native_col = $foreign->$foreign_col;
      }
    }
  }

  /**
   *
   */
  public function get($db, $table, $condition, $encrypted_fields = array(), $default_cond = NULL) {


        if (!is_array($condition)) {
            $condition = array(self::$default_field => $condition,);
        }

        if (count($condition) <= 0) {
            return array();
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
                    $this->mod->port->$db->where($field, $this->aes_encrypt->en($value));
                } else {
                    $this->mod->port->$db->where($field, $value);
                }
            }
        }

        foreach ($default_cond as $field => $value) {
            if ($field && !isset($condition[$field])) {
                $this->mod->port->$db->where($field, $value);
            }
        }

        $this->mod->port->$db->from($table);

        $this->mod->port->$db->db_select();

        $query = $this->mod->port->$db->get();

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



}

/* End of file mod.php */
/* Location: ./application/models/mod.php */