<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class R_question extends MX_Controller {

    protected $data = NULL;

    /**
     *
     */
    public function index() {

        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->load->language('eprescription/epres', $this->m->user_value('language'));

        $this->ui->mc->base_init();

        $this->ui->mc->title->content = $this->lang->line('epres_online_eprescription');

        $_ci->load->model('rezept/m_question');
//        $_ci->load->model('rezept/m_medicine');
        $_ci->load->model('rezept/m_epres');
        $_ci->load->model('akte/diagnosis/mdiagnosis');
        $_ci->load->model('akte/graph/mgraph');
        /*
         * get blood presure
         */
        
        $graph_data = $_ci->mgraph->get($this->m->user_id(), 'patient_id');
        krsort($graph_data);
        if(count($graph_data) >0){
            foreach($graph_data as $v){
                $questions['bp'] = $v->rr_sys;
                break; 
            }
        }
        
        $user_data = $_ci->m->user();
        $smoking_status =0;
        if($user_data->smoking_status==1 ||$user_data->smoking_status==3 || $user_data->smoking_status==6 || $user_data->smoking_status==4 
          || $user_data->smoking_status==8 || $user_data->smoking_status==5 || $user_data->smoking_status==2 || $user_data->smoking_status==9){
            $smoking_status = 1;
        }
        $diagnosis_datas = $_ci->mdiagnosis->get($this->m->user_id(), 'patient_id', false);
        $nierenschwache_status = 0;
        $gout_status = 0;
        $diabetic_status = 0;
        $heart_attack_status = 0;
        $stroke_status = 0;
        $durchblutungsst_status = 0;
        $allergy = array();
        $confEmerg = array();
        foreach ($diagnosis_datas as $diagnosis_data) {
            if ($diagnosis_data->status == 1 || $diagnosis_data->status == 2) {
                $confEmerg[$diagnosis_data->id] = trim($diagnosis_data->title);
                if ($diagnosis_data->status == 1) {
                    if ($diagnosis_data->icd_code == 'N18' || $diagnosis_data->icd_code == 'N17' || $diagnosis_data->icd_code == 'N19') {
                        $nierenschwache_status = 1;
                    }
                    if ($diagnosis_data->icd_code == 'M10') {
                        $gout_status = 1;
                    }
                    if ($diagnosis_data->icd_code == 'E10' || $diagnosis_data->icd_code == 'E11' || $diagnosis_data->icd_code == 'E12' || $diagnosis_data->icd_code == 'E13' || $diagnosis_data->icd_code == 'E14') {
                        $diabetic_status = 1;
                    }
                    if ($diagnosis_data->icd_code == 'I20' || $diagnosis_data->icd_code == 'I25') {
                        $heart_attack_status = 1;
                    }
                    if ($diagnosis_data->icd_code == 'I60' || $diagnosis_data->icd_code == 'I69') {
                        $stroke_status = 1;
                    }
                    if ($diagnosis_data->icd_code == 'I70') {
                        $durchblutungsst_status = 1;
                    }
                }
                if ($diagnosis_data->allergy == 1){
                    $allergy[$diagnosis_data->id] = trim($diagnosis_data->title);
                }
            }
            
        }

        //getting the list of questions and medicine for the selected sickness
        $questions['allergy'] = implode(",", $allergy);
        $questions['confEmerg'] = implode(",", $confEmerg);
        $questions['nierenschwache_status'] = $nierenschwache_status;
        $questions['gout_status'] = $gout_status;
        $questions['diabetic_status'] = $diabetic_status;
        $questions['heart_attack_status'] = $heart_attack_status;
        $questions['stroke_status'] = $stroke_status;
        $questions['durchblutungsst_status'] = $durchblutungsst_status;
        $questions['smoking_status'] = $smoking_status;
        $questions['questions'] = $_ci->m_question->get();
//        $questions['medicine'] = $_ci->m_medicine->get();
        $questions['familydoclist'] = $_ci->m_epres->get_familydoctor($this->m->user_id());
//        echo "<pre>";print_R($questions);die;
        $this->ui->mc->content->content = $this->load->view('rezept/questions_view', $questions, TRUE);

        $this->output->set_output($this->ui->mc->output());
    }

}
