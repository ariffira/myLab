<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myprofile
        extends MX_Controller {
    /**
     *
     */
    const TABLE_HEART_FREQUENCY = 'heart_frequency';
    const TABLE_BLOOD_SUGAR = 'blood_sugar';
    const TABLE_WEIGHT_BMI = 'weight_bmi';
    const TABLE_MARCUMAR = 'marcumar';
    public function index() {
        
        $this->load->language('global/general_text', $this->m->user_value('language')); 
        $this->load->language('global/overview',$this->m->user_value('language'));

        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
        if (isset($_GET['regid']))
        {
         $_ci->modoc->select_regid($_GET['regid']);
        }
        $this->ui->mc->base_init();
        /*** for adding header***/
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
        {
     
        }
        else
        {
        $this->config->load('ia24ui', TRUE, TRUE);
        $this->ui->html
                ->base_init()
                ->load_config('html');
        $this->ui->html
                    ->set_active_url('akte/myprofile');
        }
        /***end here***/
        $this->ui->mc->title->content = '';
        $_ci->load->model('graph/mgraph');
        $graph_category = $_ci->mgraph->get_all();
        $this->m->role_diff(
                function() use ($_ci){
                    $this->ui->mc->content->content = $_ci->load->view('myprofile/doctor_access_struct_view', array(),TRUE);
                },function() use ($_ci){
                    $this->ui->mc->content->content = $_ci->load->view('myprofile/patient_access_struct_view', array(), TRUE);
                }
        );
        /**displaying for output***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($this->ui->mc->output());
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    /****end here***/
    }

    /**
     *
     */
    public function insert($regid) {

        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        if (empty($regid)) {
            $regid = $this->input->post('regid');
        }

        if (empty($regid)) {
            $regid = $this->input->get('regid');
        }

        $this->m->role_diff(
                function() use ($_ci, $regid) {
                    if (empty($regid))
                        return FALSE;
                    $_ci->modoc->select_regid($regid);
                }, function() use ($_ci) {
                    $doctor = $_ci->m->modoc->get_regid($this->input->post('doctor_id'));

                    if (!isset($doctor->id) || !$doctor->id) {
                        return FALSE;
                    }

                    $query = $this->m->port->p->get_where('my_doctors', array('patient_id' => $_ci->m->user_id(), 'doctor_inserted_id' => $doctor->id,), 1);

                    if ($query->num_rows() > 0) {
                        return $query->row()->doctor_inserted_id;
                    }

                    $insert_params = array(
                        'patient_id' => $_ci->m->user_id(),
                        'doctor_inserted_id' => $doctor->id,
                        'doctor_id' => $doctor->regid,
                        'doctor_name' => $doctor->name . ' ' . $doctor->surname,
                        'access_rights' => $_ci->input->post('my_doctor_access') ? $_ci->input->post('my_doctor_access') : 0,
                        'date_added' => TRUE,
                    );
                    $this->m->db_set('p', $insert_params, array('id', 'patient_id', 'doctor_inserted_id', 'access_rights',), array('date_added',), array('doctor_id', 'doctor_name',));
                    $this->m->port->p->db_select();
                    $this->m->port->p->insert('my_doctors');
                    return $this->m->port->p->insert_id();
                }
        );
        ajax_redirect('akte/myprofile');
    }

    /**
     *
     */
    public function update($id = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->m->role_diff(
                function() use ($_ci, $id) {
                    return FALSE;
                }, function() use ($_ci, $id) {
                    if ($id === NULL) {
                        $access = $_ci->input->post('access');

                        $_ci->m->port->p->where('patient_id', $_ci->m->user_id());

                        if (!is_array($access)) {
                            if (!$_ci->input->post('batch')) {
                                return FALSE;
                            } else {
                                $_ci->m->port->p->db_select();
                                $_ci->m->port->p->set('access_rights', $access);
                                return $_ci->m->port->p->update('my_doctors');
                            }
                        } else {

                            $_ci->m->port->p->where('patient_id', $_ci->m->user_id());
                            $_ci->m->port->p->set('access_rights', 1);
                            $_ci->m->port->p->update('my_doctors');

                            foreach ($access as $key => $value) {
                                $_ci->m->port->p->where('id !=', $key);
                            }

                            $_ci->m->port->p->set('access_rights', 0);
                            $_ci->m->port->p->update('my_doctors');
                        }

                        return TRUE;
                    } else {
                        $access = $_ci->input->post('access');
                        if (is_array($access)) {
                            if (isset($access[$id])) {
                                $access = $access[$id] ? 1 : 0;
                            } else {
                                return FALSE;
                            }
                        } else {
                            $access = $access ? 1 : 0;
                        }

                        $_ci->m->port->p->db_select();
                        $_ci->m->port->p->where('id', $id);
                        $_ci->m->port->p->where('patient_id', $_ci->m->user_id());
                        $_ci->m->port->p->set('access_rights', $access);

                        return $_ci->m->port->p->update('my_doctors');
                    }
                }
        );

        ajax_redirect('akte/myprofile');
    }

    /**
     *
     */
    public function delete($id) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        if (empty($id)) {
            $id = $this->input->get('id');
        }

        if (empty($id)) {
            $id = $this->input->post('id');
        }

        $this->m->role_diff(
                function() use ($_ci, $id) {
                    $_ci->m->port->p->db_select();
                    $_ci->m->port->p->where('id', $id);
                    $_ci->m->port->p->where('doctor_inserted_id', $_ci->m->user_id());

                    return $_ci->m->port->p->delete('my_doctors');
                }, function() use ($_ci, $id) {
                    $_ci->m->port->p->db_select();
                    $_ci->m->port->p->where('id', $id);
                    $_ci->m->port->p->where('patient_id', $_ci->m->user_id());

                    return $_ci->m->port->p->delete('my_doctors');
                }
        );

        ajax_redirect('akte/myprofile');
    }

    /**
     *
     */
    public function view($regid) 
    {
        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
        $_ci->load->model('casehistory/mcasehistory');
        
        $this->ui->mc->base_init();
        $_ci->modoc->select_regid($regid);
        $_ci->load->model('iconsult/miconsult');
        $this->ui->mc->title->content = '';
        $this->load->view('myprofile/patient_profile_view', array(
          'v_users' => $this->modoc->get_patientdetail($regid),
          'econsult' => $_ci->miconsult->get_all(),
            'casehistory'=>$_ci->mcasehistory->get_all()
        ));

        //$this->output->set_output($this->ui->mc->output());
        //ajax_redirect('akte/myprofile');
    }

    /*     * *
     * * */

    public function addnewpatient() 
    {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        $this->ui->mc->base_init();
        $this->ui->mc->title->content = '';
        $this->m->role_diff(function() use ($_ci, $regid) {
                $this->ui->mc->content->content = $_ci->load->view('myprofile/doctor_access_struct_view', array(
                        'v_users' => $_ci->modoc->get_patientdetail($_ci->m->user_id()),
                            ), TRUE);
                }, function() use ($_ci, $regid) {
                    $this->ui->mc->content->content = $_ci->load->view('myprofile/doctor_access_struct_view', array(
                        'v_users' => $_ci->mopat->get_doctors(),
                            ), TRUE);
        });
        $this->output->set_output($this->ui->mc->output());
        ajax_redirect('akte/myprofile/?docid=' . $regid);
    }

    public function insertpatient() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        $patient_id = $this->m->doc_patreg();
        if ($this->m->last_error() == 'already_exist') {
            $alert = "Email Already Exist";
        }
        $_ci->m->user()->regid;
        $this->m->role_diff(
                function() use ($_ci, $patient_id) {
                    if (!empty($patient_id)) {
                        $doctor = $_ci->m->modoc->get_regid($_ci->m->user()->regid);
                        if (!isset($doctor->id) || !$doctor->id) {
                            return FALSE;
                        }
                        $query = $this->m->port->p->get_where('my_doctors', array('patient_id' => $patient_id, 'doctor_inserted_id' => $doctor->id,), 1);
                        if ($query->num_rows() > 0) {
                            return $query->row()->doctor_inserted_id;
                        }
                        $insert_params = array(
                            'patient_id' => $patient_id,
                            'doctor_inserted_id' => $doctor->id,
                            'doctor_id' => $doctor->regid,
                            'doctor_name' => $doctor->name . ' ' . $doctor->surname,
                            'access_rights' => 1,
                            'date_added' => TRUE,
                        );
                        $this->m->db_set('p', $insert_params, array('id', 'patient_id', 'doctor_inserted_id', 'access_rights',), array('date_added',), array('doctor_id', 'doctor_name',));
                        $this->m->port->p->db_select();
                        $this->m->port->p->insert('my_doctors');
                        return $this->m->port->p->insert_id();
                    }
                }, function() use ($_ci) {
                    
                }
        );
        ajax_redirect('akte/myprofile');
    }

    /**
     *
     */
}

/* End of file access.php */
/* Location: ./application/modules/akte/controllers/access.php */