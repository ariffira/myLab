<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use OAuth\OAuth1\Service\FitBit;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class Fit extends MX_Controller 
{
        
    private $key='a3ebc55562adfcb141957903d5560fad';
    private $secret='8a417766c51d26ed4d2cc7e407d933ad';

    
    function __construct(){
        
              
            $this->m->login_check_redirect();

    }
    
    public function index() 
    {
        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
          
        $this->ui->mc->base_init();
        
        $api_name='fitbit';
        $user_role = $_ci->m->user_role();
        $data = $_ci->m->getAppdata($user_role, $api_name);
        
        $result1=array();
        $latest_date=date('d-m-y',strtotime(""));
        $graph_stpes="";
        $user_profile=array();
        $graph_sleep="";
        $graph_distance="";
        
         if (!empty($_GET['oauth_token']) && isset($_GET['oauth_token'])) {
//        //fitbit api
          require_once APPPATH . 'modules/akte/libraries/oauth/vendor/autoload.php';
          $serviceFactory = new \OAuth\ServiceFactory();
          $storage = new Session();
          $redirect_uri = site_url("akte/fit");
          $credentials = new Credentials(
                $this->key,
                $this->secret,
            $redirect_uri
          );
          $fitbitService = $serviceFactory->createService('FitBit', $credentials, $storage);
//          
          //if oauth tocken is creted
         
    $token = $storage->retrieveAccessToken('FitBit');
     $fitbitService->requestAccessToken(
        $_GET['oauth_token'],
        $_GET['oauth_verifier'],
        $token->getRequestTokenSecret()
    );
    $date=date("Y-m-d",time());
    $result=new stdClass();
    
    $user = json_decode($fitbitService->request('user/-/profile.json'));
    if(isset($user) && is_object($user))
        $result->user=$user;
//    echo "<pre>";print_r($user);//done

//    $body = json_decode($fitbitService->request('user/-/body/date/'.$date.'.json'));
//    if(isset($body) && is_object($body))
//    $result->body=$body;
////    echo "<pre>";print_r($body);//done

//    $activity = json_decode($fitbitService->request('user/-/activities.json'));
//    if(isset($activity) && is_object($activity))
//    $result->activity=$activity;
//////    echo "<pre>";print_r($activity);//done

//    $food = json_decode($fitbitService->request('user/'.$user->user->encodedId.'/foods/log/date/'.$date.'.json'));
//    if(isset($activity) && is_object($food))
//    $result->food=$food;
////    echo "<pre>";print_r($food);//done

//    $sleep= json_decode($fitbitService->request('user/'.$user->user->encodedId.'/sleep/date/'.$date.'.json'));
//    if(isset($sleep) && is_object($sleep))
//    $result->sleep=$sleep;
//    //    echo "<pre>";print_r($sleep);//done  
    
   $sleep= json_decode($fitbitService->request('user/-/sleep/minutesAsleep/date/today/1y.json'));
    if(isset($sleep) && is_object($sleep))
    $result->sleep=$sleep;
    //    echo "<pre>";print_r($sleep);//done  
    
    $activitie_steps= json_decode($fitbitService->request('user/-/activities/steps/date/today/1y.json'));
    if(isset($activitie_steps) && is_object($activitie_steps))
    $result->activitie_steps=$activitie_steps;
     
     $distance= json_decode($fitbitService->request('user/-/activities/distance/date/today/1y.json'));
    if(isset($distance) && is_object($distance))
    $result->distance=$distance;
    
    $userid=$result->user->user->encodedId;
    
      
           if (count((array)$data) > 0 && !empty($result) && count((array)$result)>0) {
               $response=json_encode($result);
               $status= $this->m->updateAppData($userid, $response,$user_role,$api_name);
            }
             elseif(!empty ($result) && count((array)$result)>0){
                 $response=json_encode($result);
                 $status= $this->m->insertAppData($userid, $response,$user_role,$api_name);
           }
           else {
            $status=0;
           }
  
        $output = $_ci->load->view('overview/fitbiterror',
                     array(
                         'status'=>$status
                     ),TRUE
                     );
          $this->output->set_output($output);
        }
  
       else if(isset($data) && count((array)$data) > 0 && is_string($data->data) && (is_object(json_decode(json_decode($data->data))) || is_array(json_decode(json_decode($data->data)))) ){
//                   if () {
        $result=json_decode($data->data);
        $result1=json_decode($result);

//           echo "<pre>";print_r($result1);echo "</pre>";
           $user_profile=$result1->user->user->topBadges;
           
                    
           $activity="activities-steps";
           $steps=$result1->activitie_steps->$activity;
           $graph_stpes='[';
           foreach ($steps as $step){
               if($step->dateTime>$latest_date)
                   $latest_date=$step->dateTime;
               $date= date('d',  strtotime($step->dateTime));
               $month=sprintf("%02d",date('m',strtotime($step->dateTime))-1);
               $year=date('Y',strtotime($step->dateTime));
              $graph_stpes.='[Date.UTC('.$year.','.$month.','.$date.'),'. $step->value . '],';              
            }
            $graph_stpes.=']';
            
           
           $sleep_value="sleep-minutesAsleep";
           $sleeps=$result1->sleep->$sleep_value;
           $graph_sleep='[';
           foreach ($sleeps as $sleep){
                if($sleep->dateTime>$latest_date)
                   $latest_date=$sleep->dateTime;
               $date= date('d',  strtotime($sleep->dateTime));
               $month=sprintf("%02d",date('m',strtotime($sleep->dateTime))-1);
               $year=date('Y',strtotime($sleep->dateTime));
              $graph_sleep.='[Date.UTC('.$year.','.$month.','.$date.'),'. $sleep->value . '],';              
            }
            $graph_sleep.=']';
            
            $distance_value="activities-distance";
           $distances=$result1->distance->$distance_value;
           $graph_distance='[';
           foreach ($distances as $distance){
               if($distance->dateTime>$latest_date)
                   $latest_date=$distance->dateTime;
               $date= date('d',  strtotime($distance->dateTime));
               $month=sprintf("%02d",date('m',strtotime($distance->dateTime))-1);
               $year=date('Y',strtotime($distance->dateTime));
              $graph_distance.='[Date.UTC('.$year.','.$month.','.$date.'),'. $distance->value . '],';              
            }
            $graph_distance.=']';
       }
      if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
        {
            
        }
        else
        {
            
            
            ?>
           <script type="text/javascript">
            window.opener.document.getElementById("fitbit_link").click();
            window.close();
           </script>  
            <?php 
            $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/fit');
           
        }
        $this->ui->mc->title->content = 'Rechte';
        $output = $_ci->load->view('overview/fitbit', array(
            'data'=>$result1,
            'graph_stpes'=>$graph_stpes,
            'profile'=>$user_profile,
            'sleep'=>$graph_sleep,
            'distance'=>$graph_distance,
            'latest_date'=>$latest_date,
                ), TRUE
        );

        /** displaying for output***/
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->output->set_output($output);
        } else {
            $this->output->set_output($this->ui->html->output());
        }
        
}

function geturi(){
        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
            //fitbit api
          require_once APPPATH . 'modules/akte/libraries/oauth/vendor/autoload.php';
          $redirect_uri = site_url("akte/fit");
          $serviceFactory = new \OAuth\ServiceFactory();
          $storage = new Session();
          $credentials = new Credentials(
           $this->key,
           $this->secret,
            $redirect_uri
          );
          
          $fitbitService = $serviceFactory->createService('FitBit', $credentials, $storage);
             if($_ci->m->lang=='de')$locale= "de_DE";
             else $locale= "en_US";
            $token = $fitbitService->requestRequestToken();
            $url = $fitbitService->getAuthorizationUri(array('oauth_token' => $token->getRequestToken(),'locale'=>$locale,"requestCredentials"=>true));
            echo $url;
}
          
}
