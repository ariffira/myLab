<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vital_values extends MX_Controller {

    /**
     *
     */
    private function _has_chosen() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        $return = $this->m->role_diff(
                function() use ($_ci) {
            if (!$_ci->m->us_id()) {
                $_ci->ui->mc->base_init();
                $_ci->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_diagram_title');
                $_ci->ui->mc->content->content = $_ci->load->view('not_chosen_view', array(), TRUE);
                return TRUE;
            }

            return FALSE;
        }, function() use ($_ci) {
            return FALSE;
        }
        );

        if ($return) {
            $this->output->set_output($this->ui->mc->output());
            return TRUE;
        }

        return FALSE;
    }

    /**
     *
     */
    public function index() {

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        if ($this->_has_chosen())
            return;

        $this->load->model('graph/mgraph');

        $this->ui->mc->base_init();

        $this->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_diagram_title');

        $category = $this->mgraph->get_all();

        $this->ui->mc->remove_content('content')->remove_content('hr');

        # =============== #
        # heart_frequency #
        # =============== #
        $this->ui->mc->append_content('heart_frequency_block_title', '<div class="p-l-15 m-0">' . $this->ui->title->base_init()->options('tag', 'h4')->content('heart_frequency')->output() . '</div>');

        $this->ui->mc->append_content('blood_pressure_quick_stat')->content = $this->load->view('graph/quick_stat_mc_view', array(
            'quick_stats' => array(
                array(
                    'desc' => 'RR systolisch',
                    'entries' => $category->heart_frequency,
                    'field' => 'rr_sys',
                ),
                array(
                    'desc' => 'RR diastolisch',
                    'entries' => $category->heart_frequency,
                    'field' => 'rr_dia',
                ),
                array(
                    'desc' => 'Puls',
                    'entries' => $category->heart_frequency,
                    'field' => 'puls',
                ),
            )
                ), TRUE);

        $this->ui->mc->append_content('blood_pressure_tile')->content = $this->load->view('graph/blood_pressure_tile_view', array(
            'entries' => $category->heart_frequency,
                ), TRUE);

        $this->ui->mc->append_content('blood_pressure_hr', '<hr class="whiter" />');

        # =========== #
        # blood_sugar #
        # =========== #
        $this->ui->mc->append_content('blood_sugar_block_title', '<div class="p-l-15 m-0">' . $this->ui->title->base_init()->options('tag', 'h4')->content('blood_sugar')->output() . '</div>');

        $this->ui->mc->append_content('blood_sugar_quick_stat')->content = $this->load->view('graph/quick_stat_mc_view', array(
            'quick_stats' => array(
                array(
                    'desc' => 'Blutzucker (mg/dl)',
                    'entries' => $category->blood_sugar,
                    'field' => 'bloodsugar',
                ),
                array(
                    'desc' => 'HbA1C',
                    'entries' => $category->blood_sugar,
                    'field' => 'HbA1C',
                ),
            )
                ), TRUE);

        $this->ui->mc->append_content('blood_sugar_tile')->content = $this->load->view('graph/blood_sugar_tile_view', array(
            'entries' => $category->blood_sugar,
                ), TRUE);

        $this->ui->mc->append_content('blood_sugar_hr', '<hr class="whiter" />');

        # ========== #
        # weight_bmi #
        # ========== #
        $this->ui->mc->append_content('weight_bmi_block_title', '<div class="p-l-15 m-0">' . $this->ui->title->base_init()->options('tag', 'h4')->content('weight_bmi')->output() . '</div>');

        $this->ui->mc->append_content('weight_bmi_quick_stat')->content = $this->load->view('graph/quick_stat_mc_view', array(
            'quick_stats' => array(
                array(
                    'desc' => 'Gewicht (kg)',
                    'entries' => $category->weight_bmi,
                    'field' => 'weight',
                ),
                array(
                    'desc' => 'BMI',
                    'entries' => $category->weight_bmi,
                    'field' => 'bmi',
                ),
            )
                ), TRUE);

        $this->ui->mc->append_content('weight_bmi_tile')->content = $this->load->view('graph/weight_bmi_tile_view', array(
            'entries' => $category->weight_bmi,
                ), TRUE);

        $this->ui->mc->append_content('weight_bmi_hr', '<hr class="whiter" />');

        # ======== #
        # marcumar #
        # ======== #
        $this->ui->mc->append_content('marcumar_block_title', '<div class="p-l-15 m-0">' . $this->ui->title->base_init()->options('tag', 'h4')->content('marcumar')->output() . '</div>');

        $this->ui->mc->append_content('marcumar_quick_stat')->content = $this->load->view('graph/quick_stat_mc_view', array(
            'quick_stats' => array(
                array(
                    'desc' => 'Quick (%)',
                    'entries' => $category->marcumar,
                    'field' => 'quick',
                ),
                array(
                    'desc' => 'INR',
                    'entries' => $category->marcumar,
                    'field' => 'INR',
                ),
            )
                ), TRUE);

        $this->ui->mc->append_content('marcumar_tile')->content = $this->load->view('graph/marcumar_tile_view', array(
            'entries' => $category->marcumar,
                ), TRUE);

        $this->ui->mc->append_content('marcumar_hr', '<hr class="whiter" />');

        // $this->ui->mc->append_content('additional_block_1')->content = '&nbsp;';
        // $this->ui->mc->append_content('additional_block_2')->content = '&nbsp;';

        $this->output->set_output($this->ui->mc->output());
    }

    /**
     *
     */
    public function feed($time = NULL, $limit = 15) {
        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        // static $_ci;
        // if (empty($_ci)) $_ci =& get_instance();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/overview/timeline?check=vital_values');
        }
        /*         * *end here** */
        $output = '';
        Modules::run('akte/vital_values/blood_pressure_feed', $time, $limit);
        $output .= $this->output->get_output();
        Modules::run('akte/vital_values/blood_sugar_feed', $time, $limit);
        $output .= $this->output->get_output();
        Modules::run('akte/vital_values/weight_bmi_feed', $time, $limit);
        $output .= $this->output->get_output();
        Modules::run('akte/vital_values/marcumar_feed', $time, $limit);
        $output .= $this->output->get_output();

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($output);
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    /**
     *
     */
    public function blood_pressure($feed = NULL) {
        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));
        
        /*
         *  fetch withings data
         */
        $dbp = array('date' => array(), 'value' => array());
        $sbp = array('date' => array(), 'value' => array());
        $hp = array('date' => array(), 'value' => array());
        $api_name = 'withings';
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        $user_role = $_ci->m->user_role();
        $data = $_ci->m->getAppdata($user_role, $api_name);
        if (isset($data) && count($data) > 0) {
            $myWtihingsActivities = json_decode($data->data);
            $withing_data = json_decode($myWtihingsActivities);

            foreach ($withing_data->body->measuregrps as $measure) {

                if ($measure->category == 1) {

                    foreach ($measure->measures as $measurement_value) {
                        $measurement = ($measurement_value->value) * (pow(10, $measurement_value->unit));

                        switch ($measurement_value->type) {
                            case 9:
                                array_push($dbp['value'], $measurement);
                                array_push($dbp['date'], $measure->date);
                                break;
                            case 10:
                                array_push($sbp['value'], $measurement);
                                array_push($sbp['date'], $measure->date);
                                break;
                            case 11:
                                array_push($hp['value'], $measurement);
                                array_push($hp['date'], $measure->date);
                                break;
                        }
                    }
                }
            }
        }

        $graph_dbp = '';
        if (count($dbp['date']) > 0) {
            $graph_dbp = '[';
            for ($j = 0; $j < count($dbp['date']); $j++) {
                $date = date('d', $dbp['date'][$j]);
                $month = date('m', $dbp['date'][$j]) - 1;
                $year = date('Y', $dbp['date'][$j]);
                $graph_dbp.='[Date.UTC(' . $year . ',' . $month . ',' . $date . '),' . $dbp['value'][$j] . '],';
            }
            $graph_dbp.=']';
        }
        $graph_sbp = '';
        if (count($sbp['date']) > 0) {
            $graph_sbp = '[';
            for ($j = 0; $j < count($sbp['date']); $j++) {
                $date = date('d', $sbp['date'][$j]);
                $month = date('m', $sbp['date'][$j]) - 1;
                $year = date('Y', $sbp['date'][$j]);
                $graph_sbp.='[Date.UTC(' . $year . ',' . $month . ',' . $date . '),' . $sbp['value'][$j] . '],';
            }
            $graph_sbp.=']';
        }
        
        
        /*========withings data ============= */
        
        if ($this->_has_chosen())
            return;

        if (!empty($feed))
            return $this->blood_pressure_feed();

        $this->load->model('graph/mgraph');

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/vital_values/blood_pressure');
        }
        /*         * *end here** */
        $this->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_blood_pressure_title');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', time()));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', time()));

        $this->ui->mc->content->content = $this->load->view('graph/blood_pressure_view', array(
            'entries' => $this->mgraph->get_heart_frequency(),
            'graph_dbp' =>$graph_dbp,"graph_sbp" =>$graph_sbp
                ), TRUE);

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    /**
     *
     */
    public function blood_pressure_feed($time = NULL, $limit = 15) {
        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        
         /*
         *  fetch withings data
         */
        $dbp = array('date' => array(), 'value' => array());
        $sbp = array('date' => array(), 'value' => array());
        $hp = array('date' => array(), 'value' => array());
        $api_name = 'withings';
        $user_role = $_ci->m->user_role();
        $data = $_ci->m->getAppdata($user_role, $api_name);
        if (isset($data) && count($data) > 0) {
            $myWtihingsActivities = json_decode($data->data);
            $withing_data = json_decode($myWtihingsActivities);

            foreach ($withing_data->body->measuregrps as $measure) {

                if ($measure->category == 1) {

                    foreach ($measure->measures as $measurement_value) {
                        $measurement = ($measurement_value->value) * (pow(10, $measurement_value->unit));

                        switch ($measurement_value->type) {
                            case 9:
                                array_push($dbp['value'], $measurement);
                                array_push($dbp['date'], $measure->date);
                                break;
                            case 10:
                                array_push($sbp['value'], $measurement);
                                array_push($sbp['date'], $measure->date);
                                break;
                            case 11:
                                array_push($hp['value'], $measurement);
                                array_push($hp['date'], $measure->date);
                                break;
                        }
                    }
                }
            }
        }

        $graph_dbp = '';
        if (count($dbp['date']) > 0) {
            $graph_dbp = '[';
            for ($j = 0; $j < count($dbp['date']); $j++) {
                $date = date('d', $dbp['date'][$j]);
                $month = date('m', $dbp['date'][$j]) - 1;
                $year = date('Y', $dbp['date'][$j]);
                $hour = date("H",$dbp['date'][$j]);
                $min = date("i",$dbp['date'][$j]);
                $second = date("s",$dbp['date'][$j]);                
                $graph_dbp.='[Date.UTC(' . $year . ',' . $month . ',' . $date . ','.$hour.','.$min.','.$second.'),' . $dbp['value'][$j] . '],';
            }
            $graph_dbp.=']';
        }
        $graph_sbp = '';
        if (count($sbp['date']) > 0) {
            $graph_sbp = '[';
            for ($j = 0; $j < count($sbp['date']); $j++) {
                $date = date('d', $sbp['date'][$j]);
                $month = date('m', $sbp['date'][$j]) - 1;
                $year = date('Y', $sbp['date'][$j]);
                $hour = date("H",$sbp['date'][$j]);
                $min = date("i",$sbp['date'][$j]);
                $second = date("s",$sbp['date'][$j]);
                $graph_sbp.='[Date.UTC(' . $year . ',' . $month . ',' . $date .','.$hour.','.$min.','.$second.'),' . $sbp['value'][$j] . '],';
            }
            $graph_sbp.=']';
        }
        $graph_hp="";
        if (count($hp['date']) > 0) {
        $graph_hp='[';
            for($j=0;$j<count($hp['date']);$j++){
               $date= date('d',$hp['date'][$j]);
               $month=date('m',$hp['date'][$j])-1;
               $year=date('Y',$hp['date'][$j]);
                $hour = date("H",$hp['date'][$j]);
                $min = date("i",$hp['date'][$j]);
                $second = date("s",$hp['date'][$j]);
               $graph_hp.='[Date.UTC('.$year.','.$month.','.$date.','.$hour.','.$min.','.$second.'),'. $hp['value'][$j] . '],';              
            }
            $graph_hp.=']';
        }
        
        /*========withings data ============= */
        
        
        
        
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
                    ->set_active_url('akte/overview/timeline?check=bloodpressure');
        }
        /*         * *end here** */
        if (isset($_REQUEST['id'])) {
            $colorclass = "blog-cyan";
        } else {
            $colorclass = "blog-blue";
        }
        $output = $this->m->role_diff(
                function() use ($_ci, $time, $limit, $colorclass,$graph_dbp,$graph_sbp,$graph_hp) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_heart_frequency();
            $output = $_ci->load->view('graph/blood_pressure_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                'graph_dbp' => $graph_dbp,
                'graph_sbp' => $graph_sbp,
                'graph_hp' => $graph_hp,
                    ), TRUE);

            return $output;
        }, function() use ($_ci, $time, $limit, $colorclass,$graph_dbp,$graph_sbp,$graph_hp) {
            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where("concat(rec_date,' ',rec_time) <=", date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_heart_frequency();

            $output = $_ci->load->view('graph/blood_pressure_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                'graph_dbp' => $graph_dbp,
                'graph_sbp' =>$graph_sbp,
                'graph_hp' =>$graph_hp
                    ), TRUE);

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

    /**
     *
     */
    public function blood_sugar($feed = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        if ($this->_has_chosen())
            return;

        if (!empty($feed))
            return $this->blood_sugar_feed();

        $this->load->model('graph/mgraph');

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/vital_values/blood_sugar');
        }
        /*         * *end here** */
        $this->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_blood_sugar_title');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', time()));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', time()));

        $this->ui->mc->content->content = $this->load->view('graph/blood_sugar_view', array(
            'entries' => $this->mgraph->get_blood_sugar(),
                ), TRUE);

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    /**
     *
     */
    public function blood_sugar_feed($time = NULL, $limit = 15) {
        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

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
                    ->set_active_url('akte/overview/timeline?check=bloodsugar');
        }
        /*         * *end here** */
        if (isset($_REQUEST['id'])) {
            $colorclass = "blog-cyan";
        } else {
            $colorclass = "blog-blue";
        }
        $output = $this->m->role_diff(
                function() use ($_ci, $time, $limit, $colorclass) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_blood_sugar();

            $output = $_ci->load->view('graph/blood_sugar_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                    ), TRUE);

            return $output;
        }, function() use ($_ci, $time, $limit, $colorclass) {
            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_blood_sugar();

            $output = $_ci->load->view('graph/blood_sugar_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                    ), TRUE);

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

    /**
     *
     */
    public function weight_bmi($feed = NULL) {
                static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        if ($this->_has_chosen())
            return;

        if (!empty($feed))
            return $this->weight_bmi_feed();

        $this->load->model('graph/mgraph');

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/vital_values/weight_bmi');
        }
        /*         * *end here** */
        $this->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_weight_title');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', time()));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', time()));
        $this->ui->mc->content->content = $this->load->view('graph/weight_bmi_view', array(
            'entries' => $this->mgraph->get_weight_bmi(),
                ), TRUE);

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    /**
     *
     */
    public function weight_bmi_feed($time = NULL, $limit = 15) {

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

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
                    ->set_active_url('akte/overview/timeline?check=weightandbmi');
        }
        /*         * *end here** */
        if (isset($_REQUEST['id'])) {
            $colorclass = "blog-cyan";
        } else {
            $colorclass = "blog-blue";
        }
        $output = $this->m->role_diff(
                function() use ($_ci, $time, $limit, $colorclass) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_weight_bmi();
            $output = $_ci->load->view('graph/weight_bmi_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                    ), TRUE);

            return $output;
        }, function() use ($_ci, $time, $limit, $colorclass) {
            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('rec_date <=', date('Y-m-d', $time));
            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_weight_bmi();
            $output = $_ci->load->view('graph/weight_bmi_feed_view', array(
                'entries' => $entries,
                'colorclass' => $colorclass,
                    ), TRUE);

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

    /**
     *
     */
    public function marcumar($feed = NULL) {
                static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

        if ($this->_has_chosen())
            return;

        if (!empty($feed))
            return $this->marcumar_feed();

        $this->load->model('graph/mgraph');

        $this->ui->mc->base_init();
        /*         * * for adding header** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        } else {
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/vital_values/marcumar');
        }
        /*         * *end here** */
        $this->ui->mc->title->content = $this->lang->line('pwidget_plot_graph_marcumar_title');
            $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', time()));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', time()));

        $this->ui->mc->content->content = $this->load->view('graph/marcumar_view', array(
            'entries' => $this->mgraph->get_marcumar(),
                ), TRUE);

        /*         * displaying for output** */
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($this->ui->mc->output());
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        /*         * **end here** */
    }

    /**
     *
     */
    public function marcumar_feed($time = NULL, $limit = 15) {
        //loading languages
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));
        $this->load->language('global/overview', $this->m->user_value('language'));

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
                    ->set_active_url('akte/overview/timeline?check=marcumar');
        }
        /*         * *end here** */
        $output = $this->m->role_diff(
                function() use ($_ci, $time, $limit) {
            if (!$_ci->m->us_id()) {
                return $_ci->load->view('not_chosen_view', array(), TRUE);
            }

            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
        $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_marcumar();

            $output = $_ci->load->view('graph/marcumar_feed_view', array(
                'entries' => $entries,
                    ), TRUE);

            return $output;
        }, function() use ($_ci, $time, $limit) {
            $_ci->load->model('graph/mgraph');
            $_ci->m->port->m->db_select();
            $_ci->m->port->m->where('concat(rec_date,rec_time) <=', date('Y-m-d H:i:s', $time));
//            $_ci->m->port->m->where('rec_time <=', date('H:i:s', $time));
            $_ci->m->port->m->limit($limit);
            $entries = $_ci->mgraph->get_marcumar();
            
            $output = $_ci->load->view('graph/marcumar_feed_view', array(
                'entries' => $entries,
                    ), TRUE);

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

    /**
     *
     */
    private function _convert_rec_datetime($rec_date = NULL, $rec_time = NULL) {
        $rec_date = $rec_date ? $rec_date : $this->input->post('rec_date');

        $rec_time = $rec_time ? $rec_time : $this->input->post('rec_time');

        $rec_datetime = FALSE;

        if ($rec_time) {
            if (strtotime($rec_date . ' ' . $rec_time) !== FALSE) {
                $rec_datetime = strtotime($rec_date . ' ' . $rec_time);
            } elseif (strtotime($rec_date . ' ' . $rec_time . ':00') !== FALSE) {
                $rec_datetime = strtotime($rec_date . ' ' . $rec_time . ':00');
            } elseif (strtotime($rec_date . ' ' . $rec_time . ':00:00') !== FALSE) {
                $rec_datetime = strtotime($rec_date . ' ' . $rec_time . ':00:00');
            } elseif (strtotime($rec_date . ' ' . '00:00:00') !== FALSE) {
                $rec_datetime = strtotime($rec_date . ' ' . '00:00:00');
            }
        } else {
            if (strtotime($rec_date . ' ' . '00:00:00') !== FALSE) {
                $rec_datetime = strtotime($rec_date . ' ' . '00:00:00');
            }
        }

        return $rec_datetime;
    }

    /**
     *
     */
    private function _table_to_controller($table) {
        switch ($table) {
            case 'heart_frequency':
                return 'blood_pressure';

            case 'blood_sugar':
                return 'blood_sugar';

            case 'weight_bmi':
                return 'weight_bmi';

            case 'marcumar':
                return 'marcumar';

            default:
                return $table;
        }
    }

    /**
     *
     */
    public function insert($table = NULL, $id = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $_ci->load->model('graph/mgraph');

        if (empty($table) || !in_array($table, array(Mgraph::TABLE_HEART_FREQUENCY, Mgraph::TABLE_BLOOD_SUGAR, Mgraph::TABLE_WEIGHT_BMI, Mgraph::TABLE_MARCUMAR,))) {
            ajax_redirect('akte/vital_values/');
            return;
        }

        Mgraph::$graph_table = $table;

        $rec_datetime = $this->_convert_rec_datetime($this->input->post('rec_date'), $this->input->post('rec_time'));

        if (!$rec_datetime) {
            ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
            return;
        }

        echo $result = $this->m->role_diff(
        function() use ($_ci, $rec_datetime) {

    $insert_data = array(
        'patient_id' => $_ci->m->us_id(),
        'added_by' => $_ci->m->user_id(),
        'user_role' => $_ci->m->user_role(),
        'access_permission' => $_ci->m->us_access(),
        'graph_generation' => 0,
        'rec_date' => date('Y-m-d', $rec_datetime),
        'rec_time' => date('H:i:s', $rec_datetime),
        'date_added' => true,
            // 'date_modified'      => date('Y-m-d'),
    );
   
    foreach ($_ci->input->post() as $key => $value) {
        if (in_array($key, Mgraph::$plain_fields)) {
            $insert_data[$key] = $value;
        }
    }

    if (!empty($insert_data['size'])) {
        if ($insert_data['size'] > 100)
            $insert_data['size'] /= 100;

        if (!empty($insert_data['weight'])) {
            $insert_data['bmi'] = calculate_bmi($insert_data['size'], $insert_data['weight']);
        }
    }

    foreach (array('lower_limit', 'upper_limit') as $field_to_multi) {
        if (isset($insert_data[$field_to_multi])) {
            $_ci->mgraph->update_multiple(
                    array('patient_id' => $_ci->m->us_id(),), array($field_to_multi => $insert_data[$field_to_multi],)
            );
        }
    }

    return $_ci->mgraph->insert($insert_data);
}, function() use ($_ci, $rec_datetime) {

    $insert_data = array(
        'patient_id' => $_ci->m->user_id(),
        'added_by' => $_ci->m->user_id(),
        'user_role' => $_ci->m->user_role(),
        'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0,
        'graph_generation' => 0,
        'rec_date' => date('Y-m-d', $rec_datetime),
        'rec_time' => date('H:i:s', $rec_datetime),
        'date_added' => true,
            // 'date_modified'      => date('Y-m-d'),
    );

    foreach ($_ci->input->post() as $key => $value) {
        if (in_array($key, Mgraph::$plain_fields)) {
            $insert_data[$key] = $value;
        }
    }

    if (!empty($insert_data['size'])) {
        //if ($insert_data['size'] > 100) $insert_data['size'] /= 100;

        if (!empty($insert_data['weight'])) {
            $insert_data['bmi'] = calculate_bmi($insert_data['size'], $insert_data['weight']);
        }
    }

    foreach (array('lower_limit', 'upper_limit') as $field_to_multi) {
        if (isset($insert_data[$field_to_multi])) {
            $_ci->mgraph->update_multiple(
                    array('patient_id' => $_ci->m->us_id(),), array($field_to_multi => $insert_data[$field_to_multi],)
            );
        }
    }

    return $_ci->mgraph->insert($insert_data);
}
        );

        ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
    }

    /**
     *
     */
    public function update($table = NULL, $id = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        if (empty($id)) {
            $id = $this->input->post('id');
        }

        if (empty($id)) {
            $id = $this->input->get('id');
        }

        $_ci->load->model('graph/mgraph');

        if (empty($id) || empty($table) || !in_array($table, array(Mgraph::TABLE_HEART_FREQUENCY, Mgraph::TABLE_BLOOD_SUGAR, Mgraph::TABLE_WEIGHT_BMI, Mgraph::TABLE_MARCUMAR,))) {
            ajax_redirect('akte/vital_values/');
            return;
        }

        Mgraph::$graph_table = $table;

        $rec_datetime = $this->_convert_rec_datetime($this->input->post('rec_date'), $this->input->post('rec_time'));

        echo $result = $this->m->role_diff(
        function() use ($_ci, $id, $rec_datetime) {
    if (empty($id))
        return FALSE;

    if (!$_ci->m->us_id())
        return FALSE;

    $update_data = array(
        'patient_id' => $_ci->m->us_id(),
        'access_permission' => $_ci->m->us_access(),
        'graph_generation' => 0,
        // 'date_added'         => date('Y-m-d'),
        'date_modified' => date('Y-m-d'),
    );

    if ($rec_datetime) {
        $update_data['rec_date'] = date('Y-m-d', $rec_datetime);
        $update_data['rec_time'] = date('H:i:s', $rec_datetime);
    }

    foreach ($_ci->input->post() as $key => $value) {
        if (in_array($key, Mgraph::$plain_fields)) {
            $update_data[$key] = $value;
        }
    }

    if (!empty($update_data['size'])) {
        if ($update_data['size'] > 100)
            $update_data['size'] /= 100;

        if (!empty($update_data['weight'])) {
            $update_data['bmi'] = calculate_bmi($update_data['size'], $update_data['weight']);
        }
    }

    foreach (array('lower_limit', 'upper_limit') as $field_to_multi) {
        if (isset($update_data[$field_to_multi])) {
            $_ci->mgraph->update_multiple(
                    array('patient_id' => $_ci->m->us_id(),), array($field_to_multi => $update_data[$field_to_multi],)
            );
        }
    }

    return $_ci->mgraph->update(
                    array(
                'id' => $id,
                'patient_id' => $_ci->m->us_id(),
                'access_permission >=' => $_ci->m->us_access(),
                    ), $update_data
    );
}, function() use ($_ci, $id, $rec_datetime) {
    if (empty($id))
        return FALSE;

    $update_data = array(
        'patient_id' => $_ci->m->user_id(),
        'access_permission' => in_array($_ci->input->post('access'), array('0', '1', '2')) ? $_ci->input->post('access') : 0,
        'graph_generation' => 0,
        // 'date_added'         => date('Y-m-d'),
        'date_modified' => date('Y-m-d'),
    );

    if ($rec_datetime) {
        $update_data['rec_date'] = date('Y-m-d', $rec_datetime);
        $update_data['rec_time'] = date('H:i:s', $rec_datetime);
    }

    foreach ($_ci->input->post() as $key => $value) {
        if (in_array($key, Mgraph::$plain_fields)) {
            $update_data[$key] = $value;
        }
    }

    if (!empty($update_data['size'])) {
        //if ($update_data['size'] > 100) $update_data['size'] /= 100;

        if (!empty($update_data['weight'])) {
            $update_data['bmi'] = calculate_bmi($update_data['size'], $update_data['weight']);
        }
    }

    foreach (array('lower_limit', 'upper_limit') as $field_to_multi) {
        if (isset($update_data[$field_to_multi])) {
            $_ci->mgraph->update_multiple(
                    array('patient_id' => $_ci->m->user_id(),), array($field_to_multi => $update_data[$field_to_multi],)
            );
        }
    }

    return $_ci->mgraph->update(
                    array(
                'id' => $id,
                'patient_id' => $_ci->m->user_id(),
                    ), $update_data
    );
}
        );

        ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
    }

    /**
     *
     */
    public function delete($table = NULL, $id = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        if (empty($id)) {
            $id = $this->input->post('id');
        }

        if (empty($id)) {
            $id = $this->input->get('id');
        }

        $_ci->load->model('graph/mgraph');

        if (empty($id) || empty($table) || !in_array($table, array(Mgraph::TABLE_HEART_FREQUENCY, Mgraph::TABLE_BLOOD_SUGAR, Mgraph::TABLE_WEIGHT_BMI, Mgraph::TABLE_MARCUMAR,))) {
            ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
            return;
        }

        Mgraph::$graph_table = $table;

        $this->m->role_diff(
                function() use ($_ci, $id) {
            if (empty($id))
                return FALSE;

            if (!$_ci->m->us_id())
                return FALSE;

            return $_ci->mgraph->delete(
                            array(
                                'id' => $id,
                                'patient_id' => $_ci->m->us_id(),
                                'access_permission >=' => $_ci->m->us_access(),
                            )
            );
        }, function() use ($_ci, $id) {
            if (empty($id))
                return FALSE;

            return $_ci->mgraph->delete(
                            array(
                                'id' => $id,
                                'patient_id' => $_ci->m->user_id(),
                            )
            );
        }
        );

        ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
    }

    /**
     *
     */
    public function archive($table = NULL, $id = NULL) {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        if (empty($id)) {
            $id = $this->input->post('id');
        }

        if (empty($id)) {
            $id = $this->input->get('id');
        }

        $_ci->load->model('graph/mgraph');

        if (empty($id) || empty($table) || !in_array($table, array(Mgraph::TABLE_HEART_FREQUENCY, Mgraph::TABLE_BLOOD_SUGAR, Mgraph::TABLE_WEIGHT_BMI, Mgraph::TABLE_MARCUMAR,))) {
            ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
            return;
        }

        Mgraph::$graph_table = $table;

        $this->m->role_diff(
                function() use ($_ci, $id) {
            if (empty($id))
                return FALSE;

            if (!$_ci->m->us_id())
                return FALSE;

            return $_ci->mgraph->update(
                            array(
                        'id' => $id,
                        'patient_id' => $_ci->m->us_id(),
                        'access_permission >=' => $_ci->m->us_access(),
                            ), array(
                        'delete_status' => 1,
                        'date_modified' => TRUE,
                            )
            );
        }, function() use ($_ci, $id) {
            if (empty($id))
                return FALSE;

            return $_ci->mgraph->update(
                            array(
                        'id' => $id,
                        'patient_id' => $_ci->m->user_id(),
                            ), array(
                        'delete_status' => 1,
                        'date_modified' => TRUE,
                            )
            );
        }
        );

        ajax_redirect('akte/vital_values/' . $this->_table_to_controller($table) . '/');
    }

}

/* End of file vital_values.php */
/* Location: ./application/modules/akte/controllers/vital_values.php */