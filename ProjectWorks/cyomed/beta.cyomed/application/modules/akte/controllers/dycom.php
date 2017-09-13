<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dycom extends MX_Controller {

    public function index() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('patients/home', $this->m->user_value('language'));

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {

            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/overview/timeline?check=dycom');
        }
        /*         * *end here** */
        $this->ui->mc->title->content = $this->lang->line('patients_home_page_title');

        $this->m->role_diff(
                function() use ($_ci) {
            if (!$_ci->m->us_id()) {
                $this->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
                return;
            }
            $_ci->ui->mc->content->content = $_ci->load->view('dycom/dycom_feed_view', array(), TRUE);
        }, function() use ($_ci) {

            $_ci->ui->mc->content->content = $_ci->load->view('dycom/dycom_feed_view', array(), TRUE);
        }
        );

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    public function feed($limit = null) {


        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

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
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/overview/timeline?check=dycom');
        }
        /*         * *end here** */

        $output = $this->m->role_diff(
                function() use ($_ci, $time, $limit, $showmorelimit) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $output = $_ci->load->view('dycom/dycom_feed_view', array(), TRUE);
            return $output;
        }, function() use ($_ci, $time, $limit, $showmorelimit) {
            $output = $_ci->load->view('dycom/dycom_feed_view', array(), TRUE);
            return $output;
        }
        );
        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($output);
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    public function mrstudy() {
        static $_ci;

        $this->config->load('ia24ui', TRUE, TRUE);
        $uid = $this->m->user_id();
        $this->m->port->p->db_select();
        $this->load->library('Aes_encrypt');
        $query = $this->m->port->p->query("select * from patients where id=$uid");
        $fields = $query->row();
        $regid = $fields->regid;
        $role = "patient";
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $pathUrl = 'http://' . $_SERVER['HTTP_HOST'] . "/cyomedgit/trunk/termin/beta.cyomed/";
        } else {
            $pathUrl = 'http://' . $_SERVER['HTTP_HOST'] . "/cyomed/";
        }
	

        $path = bin2hex($this->aes_encrypt->en($regid)) . '/dicom_studies/';
        //$path ='dicom/';

        $json = array(
            "patientName" => "",
            "patientId" => "",
            "studyDate" => "",
            "modality" => "",
            "studyDescription" => "",
            "numImages" => '',
            "studyId" => "mrstudy",
            "seriesList" => array(
                array(
                    "seriesDescription" => "3-PLANE LOC",
                    "seriesNumber" => "1",
                    'instanceList' => array(array(
                            "imageId" => $path . $_REQUEST['imgId']
                        ))
                )
            )
        );
        echo json_encode($json);
        exit();
    }

}
