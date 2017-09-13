<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use OAuth\OAuth2\Service\JawboneUP;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class Jawbone extends MX_Controller 
{
            //for localhost
    private $key='u3I03nK40dI';
    private $secret='416efc078a65e9fe33ababbaf6ea70ed878963b5';

    
    function __construct(){
        
            
            $this->m->login_check_redirect();

    }

  public function index() 
    {
        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
          
        $this->ui->mc->base_init();
        
        $api_name='jawbone';
        $user_role = $_ci->m->user_role();
        
        $data = $_ci->m->getAppdata($user_role, $api_name);
        $step_graph_array="";
        $graph_sleep="";
        $result1=array();
        $latest_date="";
        
         if (!empty($_GET['code']) && isset($_GET['code'])) {
//        //fitbit api
          require_once APPPATH . 'modules/akte/libraries/oauth/vendor/autoload.php';
          $serviceFactory = new \OAuth\ServiceFactory();
          $storage = new Session();
          $redirect_uri = site_url("akte/jawbone");
          $credentials = new Credentials(
                $this->key,
                $this->secret,
            $redirect_uri
          );
          $jawboneService = $serviceFactory->createService('JawboneUP', $credentials, $storage,array('sleep_read','mood_read'));
//          
          //if oauth tocken is creted
         
      $token = $jawboneService->requestAccessToken($_GET['code']);
      $response=array();
      $userinfo= json_decode($jawboneService->request('/users/@me'),true);
      $response['userinfo']=$userinfo;
      
      $usermood= json_decode($jawboneService->request('/users/@me/mood'),true);
      $response['usermood']=$usermood;

      $usersleep = json_decode($jawboneService->request('/users/@me/sleeps'),true);
      $response['usersleep']=$usersleep;

      $usertrend = json_decode($jawboneService->request('/users/@me/trends'), true);
      $response['usertrend']=$usertrend;

      $usertimezone = json_decode($jawboneService->request('/users/@me/timezone'), true);
      $response['usertimezone']=$usertimezone;

      $usersettng= json_decode($jawboneService->request('/users/@me/settings'), true);
      $response['usersettng']=$usersettng;
       
      $usergoal = json_decode($jawboneService->request('/users/@me/goals'), true);
      $response['usergoal']=$usergoal;


      $usermoves = json_decode($jawboneService->request('/users/@me/moves'), true);
      $response['usermoves']=$usermoves;
      
      
//       $userheart = json_decode($jawboneService->request('/users/@me/heartrates'), true);
//      $response['userheart']=$userheart;
      
      $usergeneric = json_decode($jawboneService->request('/users/@me/generic_events'), true);
      $response['usergeneric']=$usergeneric;
      
            
       $usermeal = json_decode($jawboneService->request('/users/@me/meals'), true);
      $response['usermeal']=$usermeal;
      
       foreach($response as $key=>$respons){
          
          if($respons['meta']['code']==200 && $respons['meta']['message']=='OK'){
             
              $userid=$respons['data']['xid'];
              break;
          }
        
      }
      
      foreach($response as $key=>$respons){
          
          if(!($respons['meta']['code']==200 && $respons['meta']['message']=='OK')){
             
              $response[$key]=false;
          }
        else {
          
            $response[$key]=$respons['data'];
        }
       
      }
           if (count((array)$data) > 0 && !empty($response) && count((array)$response)>0) {
               
               $result_api=json_encode($response);
               $status= $this->m->updateAppData($userid, $result_api,$user_role,$api_name);
            } 
             elseif(!empty($response) && count((array)$response)>0){
                 
                 $result_api=json_encode($response);
                 $status= $this->m->insertAppData($userid, $result_api,$user_role,$api_name);
           }
           else {
               
                $status=0;
           }
  
        $output = $_ci->load->view('overview/jawbonedata',
                     array(
                         'status'=>$status
                     ),TRUE
                     );
          $this->output->set_output($output);
        }
            elseif(isset ($_GET['error']) && $_GET['error']=="access_denied"){
                $status=0;
            $output = $_ci->load->view('overview/jawbonedata',
                     array(
                         'status'=>$status
                     ),TRUE
                     );
          $this->output->set_output($output);
        }
       else{
        // for the sleep time and the hour of the time that how the user is sleeped.
            if(isset($data) && count((array)$data)>0   && is_string($data->data) && (is_object(json_decode(json_decode($data->data))) || is_array(json_decode(json_decode($data->data)))) ){
             $graph_array=array();
                    $result=json_decode($data->data);
                   $result1=json_decode($result);
//                   echo "<pre>";print_R($result1);die;
            if(count($result1->usersleep->items) && !empty($result1->usersleep->items)){
                 $i=0;
            $value_exit=false;
           foreach ($result1->usersleep->items as $sleep){
               $date=date('d-m-Y',  strtotime($sleep->date));
              foreach($graph_array as $key=>$elment){
                  if(in_array($date, $elment)){
                     $graph_array[$key]['value']+= $elment['value']+$sleep->details->duration;
                     $value_exit=true;
                  }
              }
             if(!$value_exit){
                      $graph_array[$i]['date']=$date;
                      $graph_array[$i]['value']=$sleep->details->duration;
                 }
                else {
                    $value_exit=FALSE;
                }
               $i++;
           }
            }
            $latest_date=$graph_array[0]['date'];
//          print_r($graph_array);die;
           if(count($graph_array)>0 && !empty($graph_array)){
            $graph_sleep='[';
           foreach($graph_array as $sleep_value){
//               if($sleep_value['date']>$latest_date)
//                   $latest_date=$sleep_value['date'];
                 $date= date('d',  strtotime($sleep_value['date']));
               $month=sprintf("%02d",date('m',strtotime($sleep_value['date']))-1);
               $year=date('Y',strtotime($sleep_value['date']));
               $sleep_value['value']=$sleep_value['value']/3600;
               $graph_sleep.='[Date.UTC('.$year.','.$month.','.$date.'),'. $sleep_value['value'] . '],';              
               
           }
            $graph_sleep.=']';
           }
            // for the step count of the user that how much the user steps
            if(count($result1->usermoves->items)>0 && !empty($result1->usermoves->items)){
            $step_graph_array='[';
            $i=0;
            $value_exit=false;
           foreach ($result1->usermoves->items as $steps){
                if($sleep_value['date']>$latest_date)
                   $latest_date=$sleep_value['date'];
                 $date= date('d',  strtotime($steps->date));
               $month=sprintf("%02d",date('m',strtotime($steps->date))-1);
               $year=date('Y',strtotime($steps->date));
               
               $step_graph_array.='[Date.UTC('.$year.','.$month.','.$date.'),'. $steps->details->steps . '],';              
              
           }
            $step_graph_array.=']';
  
            }
            
       }
      if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
        {
            
        }
        else
        {
           $this->config->load('ia24ui', TRUE, TRUE);
            $this->ui->html
                    ->base_init()
                    ->load_config('html');
            $this->ui->html
                    ->set_active_url('akte/jawbone');
           
        }
        
        $this->ui->mc->title->content = 'Rechte';
        $output = $_ci->load->view('overview/jawbone', array(
            'data'=>$result1,
           'sleep'=>$graph_sleep,
            'steps'=>$step_graph_array,
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
}

function geturi(){
        static $_ci;
        if (empty($_ci))
        $_ci = & get_instance();
            //fitbit api
          require_once APPPATH . 'modules/akte/libraries/oauth/vendor/autoload.php';
          $redirect_uri = site_url("akte/jawbone");
          $serviceFactory = new \OAuth\ServiceFactory();
          $storage = new Session();
          $credentials = new Credentials(
                $this->key,
                $this->secret,
            $redirect_uri
          );
          
          $jawboneService = $serviceFactory->createService('JawboneUP', $credentials, $storage,array('sleep_read','mood_read','move_read','meal_read','weight_read','generic_event_read','extended_read','location_read'));
            $url = $jawboneService->getAuthorizationUri();
            echo $url;
            die;
}
      
public function search_array($needle, $haystack) {
     if(in_array($needle, $haystack)) {
          return true;
     }
     foreach($haystack as $element) {
          if(is_array($element) && $this->search_array($needle, $element))
               return true;
     }
   return false;
}

}
