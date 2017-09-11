<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Googlefit extends MX_Controller 

{
        
    private $key='1058500518003-e1eegjtolf14u6uaefhlcdapg83bl5e1.apps.googleusercontent.com';
    private $secret='a8jbKNkqUoaM7DCoRnWtvCUB';

    
    function __construct(){
        
               
            $this->m->login_check_redirect();

    }

        /**
     *
     */

    public function index() 

    {

        static $_ci;

        if (empty($_ci))

        $_ci = & get_instance();

        $this->ui->mc->base_init();

        

        $api_name='googlefit';

        $user_role = $_ci->m->user_role();

        $data = $_ci->m->getAppdata($user_role, $api_name);
        $client_id = $this->key;
        
          $authUrl='';
          $activity_array=array();
          $step_count="";
                   
        $client_secret =$this->secret;;
        $redirect_uri = site_url('akte/googlefit');

        $this->load->library('session');

        require_once(APPPATH . 'modules/akte/libraries/google-api/templates/base.php');

        require_once(APPPATH . 'modules/akte/libraries/google-api/src/Google/autoload.php');

        /************************************************

          Make an API request on behalf of a user. In

          this case we need to have a valid OAuth 2.0

          token for the user, so we need to send them

          through a login flow. To do this we need some

          information from our API console project.

         ************************************************/

        $client = new Google_Client();

        $client->setClientId($client_id);

        $client->setClientSecret($client_secret);

        $client->setRedirectUri($redirect_uri);

        $client->addScope("https://www.googleapis.com/auth/fitness.activity.read");

        if (isset($_GET['code']))

        {

            $client->authenticate($_GET['code']);

            $access_token =$client->getAccessToken();

            $this->session->set_userdata('access_token',$access_token);

            $token=$this->session->userdata('access_token');

        }

        if (isset($token) && $token) 

        {

            $client->setAccessToken($token);

            if ($client->isAccessTokenExpired())

            {

             $this->session->unset_userdata('access_token','');

            }

            $fitness_service = new Google_Service_Fitness($client);

            $dataSources = $fitness_service->users_dataSources;

            $dataSets = $fitness_service->users_dataSources_datasets;

            $listDataSources = $dataSources->listUsersDataSources("me");

            $timezone = "GMT+0700";

            $today = date("Y-m-d");

            $endTime = strtotime($today . ' 00:00:00 ' . $timezone);

            $startTime = strtotime('-30 day', $endTime);

           $step=array();

            while ($listDataSources->valid()) 

            {

             $dataSourceItem = $listDataSources->next();

              if ($dataSourceItem['dataType']['name'] == "com.google.step_count.delta")

              {

               $dataStreamId = $dataSourceItem['dataStreamId'];

               $listDatasets = $dataSets->get("me", $dataStreamId, $startTime . '000000000' . '-' . $endTime . '000000000');

               $i=0;

               while ($listDatasets->valid()) 

               {

                 $dataSet = $listDatasets->next();

                 $dataSetValues = $dataSet['value'];

                 if ($dataSetValues && is_array($dataSetValues)) 

                 {

                    foreach ($dataSetValues as $key=> $dataSetValue) 

                    {

                       $step_count[$i]['step_count'] = $dataSetValue['intVal'];

                       $step_count[$i]['startTimeNanos']= $dataSet['startTimeNanos'];

                       $step_count[$i]['endTimeNanos']= $dataSet['endTimeNanos'];

                    }

                 }

                 $i++;

               }

               $step=serialize($step_count);
              };
             }

             if (count((array)$data) > 0 && count((array)$step_count)>0 && !empty($step_count)) 
             {
               $this->m->updateAppData($_ci->m->user_id(),$step,$_ci->m->user_role(),$api_name);
             } 
             elseif(!empty($step_count) && count((array)$step_count)>0)
             {
               $this->m->insertAppData($_ci->m->user_id(),$step,$_ci->m->user_role(),$api_name);
             }  
             else{
                 $status=0;
             }
        } 
        /***get step count record****/
       if(isset($data) && count((array)$data)>0 && is_string($data->data) && (is_array(unserialize(json_decode($data->data))) || is_object(unserialize(json_decode($data->data))))){
       $step_array=unserialize(json_decode($data->data));
        foreach($step_array as $key=>$activity)

        {

            $activity_startdate=date('Y-m-d H:i:s',$activity['startTimeNanos']/1000000000);

            $activity_enddate=date('Y-m-d H:i:s',$activity['endTimeNanos']/1000000000);

            $step_count=$activity['step_count'];

            $activity_array[date('Y-m-d',$activity['startTimeNanos']/1000000000)]['step_count'][] = $activity['step_count'];

            $activity_array[date('Y-m-d',$activity['startTimeNanos']/1000000000)]['startTimeNanos']= date('Y-m-d',$activity['startTimeNanos']/1000000000);

            $activity_array[date('Y-m-d',$activity['startTimeNanos']/1000000000)]['endTimeNanos']= date('Y-m-d',$activity['endTimeNanos']/1000000000);

        }

        ksort($activity_array);

        $step_count = '[';

        foreach ($activity_array as $key => $val) 

        {

          $date=explode('-',$key);

          $year=$date[0];

          $month=(int)$date[1]-1;

          $day=(int)$date[2];

          $date=$date[0].",".$month.",".$day; 

          $totalstep = array_sum($val['step_count']);

          $step_count .='[Date.UTC(' .$date . '),' . $totalstep . '],';

        }

        $step_count.=']';

        

        $activity_array = array_reverse($activity_array);
        
        //$activity_array = (object) $activity_array;

        //***** end here***/
       }
        $authUrl = $client->createAuthUrl();

         /***for adding header***/

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')

        {

            

        }

        else

        {

            ?>

           <script type="text/javascript">

            window.opener.document.getElementById("fit_link").click();

            window.close();

           </script>  

            <?php 

            $this->config->load('ia24ui', TRUE, TRUE);

            $this->ui->html

                    ->base_init()

                    ->load_config('html');

            $this->ui->html

                    ->set_active_url('akte/googlefit');

           

        }
        /*         * *end here** */

        $this->ui->mc->title->content = 'Rechte';
        $output = $_ci->load->view('overview/fitdata', array(
            'oauthurl' => $authUrl,
            'data'=>$activity_array,
            'step_count'=>$step_count,
                ), TRUE
        );



        /** displaying for output***/

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

            $this->output->set_output($output);

        } else {

            $this->output->set_output($this->ui->html->output());

        }

        /****end here***/

    }      

}



/* End of file access.php */

/* Location: ./application/modules/akte/controllers/access.php */