<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akte extends MX_Controller {
 /**
     *
     */
    public function __construct() 
    {
        $this->m->login_check_redirect();
    }

    /**
     *
     */
    public function index($url = NULL) 
    {        
        //lang load for design
        $this->load->language('global/general_text', $this->m->user_value('language'));
        
        $this->config->load('ia24ui', TRUE, TRUE);
        $this->ui->html
                ->base_init()
                ->load_config('html');
        #Active URL
        if (empty($url)) 
        {
            $url = $this->input->get('r');
        }
        if (empty($url)) 
        {
            $url = $this->input->post('r');
        }
        
        if ($url = $this->encrypt->decode($url))
            $this->ui->html
                    ->set_active_url($url);
        else
            $this->ui->html
                    ->set_active_url('akte/overview');

        # mvpr theme
        if (empty($mvprt))
        {
            $mvprt = $this->input->get('mvprt');
        }

        if (empty($mvprt)) {
            $mvprt = $this->input->post('mvprt');
        }

        if (empty($mvprt)) {
            $mvprt = $this->session->userdata('mvprt');
        }

        if (!empty($mvprt)) {
            if ($mvprt != 'clear') {
                $this->session->set_userdata('mvprt', $mvprt);

                if (Ui::$bs_tname == 'mvpr110') {
                    $this->ui->html
                            ->set_css($mvprt);
                } else {
                    redirect('akte');
                    return;
                }
            } else {
                $this->session->unset_userdata('mvprt');
                redirect('akte');
                return;
            }
        }

        # mvpr theme
        if (empty($sa103t)) {
            $sa103t = $this->input->get('sa103t');
        }

        if (empty($sa103t)) {
            $sa103t = $this->input->post('sa103t');
        }

        if (empty($sa103t)) {
            $sa103t = $this->session->userdata('sa103t');
        }

        if (!empty($sa103t)) {
            if ($sa103t != 'clear') {
                $this->session->set_userdata('sa103t', $sa103t);
                if (Ui::$bs_tname == 'sa103') {
                    $this->ui->html
                            ->set_css($sa103t, 'sa_css');
                } else {
                    redirect('akte');
                    return;
                }
            } else {
                $this->session->unset_userdata('sa103t');
                redirect('akte');
                return;
            }
        }

       $this->output->set_output(
                $this->ui->html->output()
        );
    }

    public function runtastic() 
    {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
       $entry_array= $this->runtastic_data();
//       print_R($entry_array);die;
//        $activity_array = (object) $activity_array;
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
                    ->set_active_url('akte/runtastic');
       }
      /***end here***/
        $output = $_ci->load->view('overview/runtastic',  $entry_array, TRUE);
         /**displaying for output***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($output);
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    /****end here***/
        
    }
    private function runtastic_data(){
        
                static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $myRuntasticActivities = array();
        $activity_array = array();
        $running_speed = '';
        $pushup_speed = '';
        $pullup_speed = '';
        $squat_speed = '';

        $running_pace = '';
        $pushup_pace = '';
        $pullup_pace = '';
        $squat_pace = '';

        $running_heartrate_avg = '';
        $pushup_heartrate_avg = '';
        $pullup_heartrate_avg = '';
        $squat_heartrate_avg = '';

        $running_distance = '';
        $pushup_distance = '';
        $pullup_distance = '';
        $squat_distance = '';

        $running_duration = '';
        $pushup_duration = '';
        $pullup_duration = '';
        $squat_duration = '';

        $user_role = $_ci->m->user_role();
        $data = $_ci->m->getAppdata($user_role,'runtastic');
        if (isset($data) && count((array)$data) > 0 && is_string($data->data) &&
                (is_object(json_decode($data->data)) || is_array(json_decode($data->data))) ) {
            $myRuntasticActivities = json_decode($data->data);
        
        $myRuntasticActivities = (array) $myRuntasticActivities;       
        foreach($myRuntasticActivities as $activity){
            $act_date = $activity->date->year.'-'.$activity->date->month.'-'.$activity->date->day.' '.$activity->date->hour.':'.$activity->date->minutes.':'.$activity->date->seconds;
            $act_datetime = strtotime($act_date);
            $activity_array[$act_datetime] = $activity;
       }
       ksort($activity_array);
       $running_speed = '[';
        $pushup_speed = '[';
        $pullup_speed = '[';
        $squat_speed = '[';

        $running_pace = '[';
        $pushup_pace = '[';
        $pullup_pace = '[';
        $squat_pace = '[';

        $running_heartrate_avg = '[';
        $pushup_heartrate_avg = '[';
        $pullup_heartrate_avg = '[';
        $squat_heartrate_avg = '[';

        $running_distance = '[';
        $pushup_distance = '[';
        $pullup_distance = '[';
        $squat_distance = '[';

        $running_duration = '[';
        $pushup_duration = '[';
        $pullup_duration = '[';
        $squat_duration = '[';

        foreach ($activity_array as $key => $val) {
            
            /*
             * for speed
             */
            if ($val->type == 'running') {
                $date=$val->date->month-1;
                $running_speed .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->speed . '],';
            }
            if ($val->type == 'pushups') {
                $date=$val->date->month-1;
                $pushup_speed .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->speed . '],';
            }
            if ($val->type == 'pullups') {
                $date=$val->date->month-1;
                $pullup_speed .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->speed . '],';
            }
            if ($val->type == 'squats') {
                $date=$val->date->month-1;
                $squat_speed .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->speed . '],';
            }

            /*
             *  for  pace
             */

            if ($val->type == 'running') {
                $date=$val->date->month-1;
                $running_pace .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->pace . '],';
            }
            if ($val->type == 'pushups') {
                $date=$val->date->month-1;
                $pushup_pace .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->pace . '],';
            }
            if ($val->type == 'pullups') {
                $date=$val->date->month-1;
                $pullup_pace .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->pace . '],';
            }
            if ($val->type == 'squats') {
                $date=$val->date->month-1;
                $squat_pace .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->pace . '],';
            }

            /*
             *  heartrate_avg
             */

            if ($val->type == 'running') {
                $date=$val->date->month-1;
                $running_heartrate_avg .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->heartrate_avg . '],';
            }
            if ($val->type == 'pushups') {
                $date=$val->date->month-1;
                $pushup_heartrate_avg .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->heartrate_avg . '],';
            }
            if ($val->type == 'pullups') {
                $date=$val->date->month-1;
                $pullup_heartrate_avg .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->heartrate_avg . '],';
            }
            if ($val->type == 'squats') {
                $date=$val->date->month-1;
                $squat_heartrate_avg .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $val->heartrate_avg . '],';
            }

            /*
             *   for distance
             */

            if ($val->type == 'running') {
                $date=$val->date->month-1;
                $running_distance .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . ($val->distance / 1000) . '],';
            }
            if ($val->type == 'pushups') {
                $date=$val->date->month-1;
                $pushup_distance .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . ($val->distance / 1000) . '],';
            }
            if ($val->type == 'pullups') {
                $date=$val->date->month-1;
                $pullup_distance .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . ($val->distance / 1000) . '],';
            }
            if ($val->type == 'squats') {
                $date=$val->date->month-1;
                $squat_distance .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . ($val->distance / 1000) . '],';
            }

            /*
             *  for duration
             */
            $duration = number_format((($val->duration / 1000) / 60), 2, '.', '');
            if ($val->type == 'running') {
                $date=$val->date->month-1;
                $running_duration .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $duration . '],';
            }
            if ($val->type == 'pushups') {
                $date=$val->date->month-1;
                $pushup_duration .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $duration . '],';
            }
            if ($val->type == 'pullups') {
                $date=$val->date->month-1;
                $pullup_duration .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $duration . '],';
            }
            if ($val->type == 'squats') {
                $date=$val->date->month-1;
                $squat_duration .='[Date.UTC(' . $val->date->year . ',' . $date . ',' . $val->date->day . '),' . $duration . '],';
            }
        }
        $running_speed.=']';
        $pushup_speed.=']';
        $pullup_speed .=']';
        $squat_speed .=']';

        $running_pace.=']';
        $pushup_pace.=']';
        $pullup_pace .=']';
        $squat_pace .=']';

        $running_heartrate_avg.=']';
        $pushup_heartrate_avg.=']';
        $pullup_heartrate_avg .=']';
        $squat_heartrate_avg .=']';

        $running_distance.=']';
        $pushup_distance.=']';
        $pullup_distance.=']';
        $squat_distance.=']';

        $running_duration.=']';
        $pushup_duration.=']';
        $pullup_duration.=']';
        $squat_duration.=']';

        $activity_array = array_reverse($activity_array);
    }
//           if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
//       {
//     
//       }
//       else
//       {
//       $this->config->load('ia24ui', TRUE, TRUE);
//       $this->ui->html
//                ->base_init()
//                ->load_config('html');
//       $this->ui->html
//                    ->set_active_url('akte/runtastic');
//       }
//      /***end here***/
//        $output = $_ci->load->view('overview/runtastic_graph',  $entry_array, TRUE);
//         /**displaying for output***/
//    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
//    {
//       $this->output->set_output($output);
//    }
//    else
//    {
//     $this->output->set_output($this->ui->html->output());
//    }

//    print_R(array(
//            'entries' => $activity_array,
//            'graph_running_speed' => $running_speed,
//            'graph_pushups_speed' => $pushup_speed,
//            'pullup_speed' => $pullup_speed,
//            'squat_speed' => $squat_speed,
//            'running_pace' => $running_pace,
//            'pushups_pace' => $pushup_pace,
//            'pullup_pace' => $pullup_pace,
//            'squat_pace' => $squat_pace,
//            'running_heartrate_avg' => $running_heartrate_avg,
//            'pushup_heartrate_avg' => $pushup_heartrate_avg,
//            'pullup_heartrate_avg' => $pullup_heartrate_avg,
//            'squat_heartrate_avg' => $squat_heartrate_avg,
//            'running_distance' => $running_distance,
//            'pushup_distance' => $pushup_distance,
//            'pullup_distance' => $pullup_distance,
//            'squat_distance' => $squat_distance,
//            'running_duration' => $running_duration,
//            'pushup_duration' => $pushup_duration,
//            'pullup_duration' => $pullup_duration,
//            'squat_duration' => $squat_duration
//                ));
    return array(
            'entries' => $activity_array,
            'graph_running_speed' => $running_speed,
            'graph_pushups_speed' => $pushup_speed,
            'pullup_speed' => $pullup_speed,
            'squat_speed' => $squat_speed,
            'running_pace' => $running_pace,
            'pushups_pace' => $pushup_pace,
            'pullup_pace' => $pullup_pace,
            'squat_pace' => $squat_pace,
            'running_heartrate_avg' => $running_heartrate_avg,
            'pushup_heartrate_avg' => $pushup_heartrate_avg,
            'pullup_heartrate_avg' => $pullup_heartrate_avg,
            'squat_heartrate_avg' => $squat_heartrate_avg,
            'running_distance' => $running_distance,
            'pushup_distance' => $pushup_distance,
            'pullup_distance' => $pullup_distance,
            'squat_distance' => $squat_distance,
            'running_duration' => $running_duration,
            'pushup_duration' => $pushup_duration,
            'pullup_duration' => $pullup_duration,
            'squat_duration' => $squat_duration
                );
//    echo "<pre>";
//    print_R( array(
//            'entries' => $activity_array,
//            'graph_running_speed' => $running_speed,
//            'graph_pushups_speed' => $pushup_speed,
//            'pullup_speed' => $pullup_speed,
//            'squat_speed' => $squat_speed,
//            'running_pace' => $running_pace,
//            'pushups_pace' => $pushup_pace,
//            'pullup_pace' => $pullup_pace,
//            'squat_pace' => $squat_pace,
//            'running_heartrate_avg' => $running_heartrate_avg,
//            'pushup_heartrate_avg' => $pushup_heartrate_avg,
//            'pullup_heartrate_avg' => $pullup_heartrate_avg,
//            'squat_heartrate_avg' => $squat_heartrate_avg,
//            'running_distance' => $running_distance,
//            'pushup_distance' => $pushup_distance,
//            'pullup_distance' => $pullup_distance,
//            'squat_distance' => $squat_distance,
//            'running_duration' => $running_duration,
//            'pushup_duration' => $pushup_duration,
//            'pullup_duration' => $pullup_duration,
//            'squat_duration' => $squat_duration
//                ));
//            $output = $_ci->load->view('overview/runtastic_graph',  array(
//            'entries' => $activity_array,
//            'graph_running_speed' => $running_speed,
//            'graph_pushups_speed' => $pushup_speed,
//            'pullup_speed' => $pullup_speed,
//            'squat_speed' => $squat_speed,
//            'running_pace' => $running_pace,
//            'pushups_pace' => $pushup_pace,
//            'pullup_pace' => $pullup_pace,
//            'squat_pace' => $squat_pace,
//            'running_heartrate_avg' => $running_heartrate_avg,
//            'pushup_heartrate_avg' => $pushup_heartrate_avg,
//            'pullup_heartrate_avg' => $pullup_heartrate_avg,
//            'squat_heartrate_avg' => $squat_heartrate_avg,
//            'running_distance' => $running_distance,
//            'pushup_distance' => $pushup_distance,
//            'pullup_distance' => $pullup_distance,
//            'squat_distance' => $squat_distance,
//            'running_duration' => $running_duration,
//            'pushup_duration' => $pushup_duration,
//            'pullup_duration' => $pullup_duration,
//            'squat_duration' => $squat_duration
//                ), TRUE);
//            echo $output;
      
    }
    public function updateruntastic() {
        
        static $_ci;
        $api_name='runtastic';
        if (empty($_ci))
            $_ci = & get_instance();

        $user_name = $_REQUEST['run_username'];
        $password = $_REQUEST['run_password'];
        $user_role = $_ci->m->user_role();

        $data = $_ci->m->getAppdata($user_role,$api_name);
        
        $this->load->library('runtastic');
        $runtastic = new Runtastic();
        $runtastic->setUsername($user_name);

        $runtastic->setPassword($password);
        $runtastic->setTimeout(20);

        if ($runtastic->login()) {
            $app_user_id = $runtastic->getUid();
            $myRuntasticActivities = $runtastic->getActivities(null, null, date('Y'));
            //$myRuntasticActivities = $runtastic->getActivities();
            if (count($data) > 0) {
               $return= $this->m->updateAppData($app_user_id, $myRuntasticActivities,$user_role,$api_name);
            } else {
               $return= $this->m->insertAppData($app_user_id, $myRuntasticActivities,$user_role,$api_name);
            }
        } else {
                $return=false;
//            echo 'Ihr Benutzername oder Passwort falsch, sind wir nicht in der Lage, aktuelle Daten zu synchronisieren, jetzt alten Daten nur Listen';
        }
           $value=$this->runtastic_data();
        if($return){
        $output = $_ci->load->view('overview/runtastic_graph',  $value, TRUE);
        echo $output;
        }
        else{
        echo false;    
        }             
        exit;
    }

    /**
     *
     */
    public function active_url($url = NULL) {
        $this->index($url);
    }

    public function autologin($url = NULL) 
    {
        echo 'OK';
    }
    
    
     public function withings() {
         
        
         static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
         $key='6bbe9d6c5d23cfe7cd510cc38f211c1f84bee17f5b79e20331b06375985';
         $secrect='d39d3c19854761698b20236db2802f2bd53fb2c6c9124f0575cf1f09c0e4465';
         $api_name='withings';
         $user_role = $_ci->m->user_role();
         $data = $_ci->m->getAppdata($user_role,$api_name);
       
       
        $this->load->library('session');
        //for the withhings api call
        $this->load->library('withings');
        $sig_method = new OAuthSignatureMethod_HMAC_SHA1();
        $plaintext_method = new OAuthSignatureMethod_PLAINTEXT();
       
        $withhing_url = "https://oauth.withings.com/account/";
        $callback_url= base_url('index.php/akte/withings');
        
        $consumer = new OAuthConsumer($key,$secrect, $callback_url);
        
 if(!isset($_REQUEST['userid']) && empty($_REQUEST['userid'])){
       //get the first token url
       $req_req = OAuthRequest::from_consumer_and_token($consumer, NULL, "GET", $withhing_url . "request_token?oauth_callback=".urlencode($callback_url));
       $req_req->sign_request($sig_method, $consumer, NULL);

       //get the token
       $response = file_get_contents($req_req);
       parse_str ($response,$req_token_tab);
       $req_token = new OAuthToken($req_token_tab["oauth_token"],$req_token_tab["oauth_token_secret"]);
       
       //use the token
       $auth_req = OAuthRequest::from_consumer_and_token($consumer, $req_token, "GET", $withhing_url. "authorize");
       $auth_req->sign_request($sig_method, $consumer, $req_token);
       
       $this->session->unset_userdata($req_token);
       $this->session->set_userdata('req_token',$req_token_tab);
        echo $auth_req;die;
 }
 else{
            $req_token=$this->session->userdata('req_token');
            $req_token = new OAuthToken($req_token["oauth_token"],$req_token["oauth_token_secret"]);
           $userid = $_GET['userid'];
         //get the taken url
            $acc_req = OAuthRequest::from_consumer_and_token($consumer, $req_token, "GET", $withhing_url. "access_token?userid=$userid");
            $acc_req->sign_request($sig_method, $consumer, $req_token);
            
            $response = file_get_contents($acc_req);
            parse_str ($response,$access_token_tab);
            
            
        $acc_tok = new OAuthToken($access_token_tab["oauth_token"],$access_token_tab["oauth_token_secret"]);
        $start_date=date('U',strtotime(date('Y-01-01')));
        $end_date=date('U',strtotime(date('Y-m-d')));
        $req = OAuthRequest::from_consumer_and_token($consumer, $acc_tok, "GET", "http://wbsapi.withings.net/measure?action=getmeas&userid=$userid&startdate=$start_date&enddate=$end_date");
        
        $req->sign_request($sig_method, $consumer, $acc_tok);
        
        $response = file_get_contents($req);
          $withhing_array=json_decode($response);

          if (count($data) > 0) {
             if($withhing_array->status==0){

               $status= $this->m->updateAppData($userid, $response,$user_role,$api_name);
            } 
            else {
                $status=0;
            }
            }
           else{
          $status= $this->m->insertAppData($userid, $response,$user_role,$api_name);
           }
  
        $output = $_ci->load->view('overview/withings',
                     array(
                         'status'=>$status
                     ),TRUE
                     );
          $this->output->set_output($output);

 }
      
    }

public function WithingsData(){
      static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        
         $api_name='withings';
         $user_role = $_ci->m->user_role();
         $data = $_ci->m->getAppdata($user_role,$api_name);
         $weight=array('date'=>array(),'value'=>array());
         $height=array('date'=>array(),'value'=>array());
         $fatfmass=array('date'=>array(),'value'=>array());
         $fatratio=array('date'=>array(),'value'=>array());
         $fatwmass=array('date'=>array(),'value'=>array());
         $dbp=array('date'=>array(),'value'=>array());
         $sbp=array('date'=>array(),'value'=>array());
         $hp=array('date'=>array(),'value'=>array());
         $others=array('date'=>array(),'value'=>array());
         $withing_data=array();
         $graph_weight="";
           $graph_fatwmass="";
            $graph_dbp="";
            $graph_sbp="";
            $graph_hp="";

      if (isset($data) && count((array)$data) > 0 && is_string($data->data) && (is_object(json_decode(json_decode($data->data))) || is_array(json_decode(json_decode($data->data)))) ) {
            $myWtihingsActivities = json_decode($data->data);
            $withing_data=json_decode($myWtihingsActivities);
        foreach ($withing_data->body->measuregrps as $measure){

            if($measure->category == 1){
                
                foreach($measure->measures as $measurement_value){
                    $measurement=($measurement_value->value)*(pow(10, $measurement_value->unit));
                    
                    switch ($measurement_value->type){
                        case 1:
                            array_push($weight['value'], $measurement);
                            array_push($weight['date'], $measure->date);
                            
                            break;
                        case 4:
                            array_push($height['value'], $measurement);
                            array_push($height['date'], $measure->date);
                         break;
                        case 5:
                           array_push($fatfmass['value'], $measurement);
                            array_push($fatfmass['date'], $measure->date);
                              break;
                        case 6:
                             array_push($fatratio['value'], $measurement);
                            array_push($fatratio['date'], $measure->date);
                            break;
                        case 8:
                             array_push($fatwmass['value'], $measurement);
                            array_push($fatwmass['date'], $measure->date);
                           break;
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
                        default :
                           array_push($others['value'], $measurement);
                            array_push($others['date'], $measure->date);
                             break;

                    }
                  }
              }
           }
           
          if (count($weight['date']) > 0) {
            $graph_weight='[';
            for($j=0;$j<count($weight['date']);$j++){
               $date= date('d',$weight['date'][$j]);
               $month=date('m',$weight['date'][$j])-1;
               $year=date('Y',$weight['date'][$j]);
                $graph_weight.='[Date.UTC('.$year.','.$month.','.$date.'),'. $weight['value'][$j] . '],';              
            }
            $graph_weight.=']';
          } 
//          if (count($height['date']) > 0) {
//          $graph_height='[';
//            for($j=0;$j<count($height['date']);$j++){
//               $date= date('d',$height['date'][$j]);
//               $month=date('m',$height['date'][$j]);
//               $year=date('Y',$height['date'][$j]);
//                $graph_height.='[Date.UTC('.$year.','.$month.','.$date.'),'. $height['value'][$j] . '],';              
//            }
//            $graph_height.=']';
//          }
            if (count($fatwmass['date']) > 0) {
          $graph_fatwmass='[';
            for($j=0;$j<count($fatwmass['date']);$j++){
               $date= date('d',$fatwmass['date'][$j]);
               $month=date('m',$fatwmass['date'][$j])-1;
               $year=date('Y',$fatwmass['date'][$j]);
                $graph_fatwmass.='[Date.UTC('.$year.','.$month.','.$date.'),'. $fatwmass['value'][$j] . '],';              
            }
            $graph_fatwmass.=']';
            }
            
         
            if (count($hp['date']) > 0) {
            $graph_hp='[';
            for($j=0;$j<count($hp['date']);$j++){
               $date= date('d',$hp['date'][$j]);
               $month=date('m',$hp['date'][$j])-1;
               $year=date('Y',$hp['date'][$j]);
                $graph_hp.='[Date.UTC('.$year.','.$month.','.$date.'),'. $hp['value'][$j] . '],';              
            }
            $graph_hp.=']';
            }
            
           
            if (count($dbp['date']) > 0) {
             $graph_dbp='[';
            for($j=0;$j<count($dbp['date']);$j++){
               $date= date('d',$dbp['date'][$j]);
               $month=date('m',$dbp['date'][$j])-1;
               $year=date('Y',$dbp['date'][$j]);
                $graph_dbp.='[Date.UTC('.$year.','.$month.','.$date.'),'. $dbp['value'][$j] . '],';              
            }
            $graph_dbp.=']';
            }
            
          
            if (count($sbp['date']) > 0) {
              $graph_sbp='[';
            for($j=0;$j<count($sbp['date']);$j++){
               $date= date('d',$sbp['date'][$j]);
               $month=date('m',$sbp['date'][$j])-1;
               $year=date('Y',$sbp['date'][$j]);
                $graph_sbp.='[Date.UTC('.$year.','.$month.','.$date.'),'. $sbp['value'][$j] . '],';              
            }
            $graph_sbp.=']';
            }
        }
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
                    ->set_active_url('akte/withingsdata');
     }
      /***end here***/
       $output = $_ci->load->view('overview/withingsdata',array(
           'data'=>$withing_data,
            'weight'=>$graph_weight,
//            'height'=>$graph_height,
//            'fatfmass'=>$graph_fatwmass,
//            'fatratio'=>$fatratio,
            'fatwmass'=>$graph_fatwmass,
            'dbp'=>$graph_dbp,
            'sbp'=>$graph_sbp,
            'hp'=>$graph_hp,
//           'check'=>$check
           ),TRUE);
        /**displaying for output***/
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
    {
       $this->output->set_output($output);
    }
    else
    {
     $this->output->set_output($this->ui->html->output());
    }
    /****end here***/
       


}
}

/* End of file akte.php */
/* Location: ./application/modules/akte/controllers/akte.php */