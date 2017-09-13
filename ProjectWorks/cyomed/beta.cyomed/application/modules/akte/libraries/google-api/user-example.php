<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
include_once "templates/base.php";
session_start();
//echo dirname(__FILE__) . '/../src/Google/autoload.php'; exit;
require_once realpath(dirname(__FILE__) . '/src/Google/autoload.php');
/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
$client_id = '1058500518003-e1eegjtolf14u6uaefhlcdapg83bl5e1.apps.googleusercontent.com';
$client_secret = 'a8jbKNkqUoaM7DCoRnWtvCUB';
$redirect_uri = 'http://localhost/gapi/user-example.php';
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
//https://www.googleapis.com/auth/fitness.activity.read
//$client->addScope("https://www.googleapis.com/auth/fitness.activity.read");
$client->addScope("https://www.googleapis.com/auth/fitness.body.read");
/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service =new Google_Service_Fitness($client);
/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) 
{
  unset($_SESSION['access_token']);
}
/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) 
{
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}


/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) 
{

  $client->setAccessToken($_SESSION['access_token']);
   if ($client->isAccessTokenExpired()) {
    unset($_SESSION['access_token']);
  }

$fitness_service = new Google_Service_Fitness($client);
$dataSources = $fitness_service->users_dataSources;
$dataSets = $fitness_service->users_dataSources_datasets;

$listDataSources = $dataSources->listUsersDataSources("me");
$timezone = "GMT+0700";
$today = date("Y-m-d");
$endTime = strtotime($today.' 00:00:00 '.$timezone);
$startTime = strtotime('-30 day', $endTime);
//echo $startTime.'000000000'.'-'.$endTime.'000000000';
while($listDataSources->valid()) {
    $dataSourceItem = $listDataSources->next();
     if ($dataSourceItem['dataType']['name'] == "com.google.height") 
     {
        $dataStreamId = $dataSourceItem['dataStreamId'];
        $listDatasets = $dataSets->get("me", $dataStreamId, $startTime.'000000000'.'-'.$endTime.'000000000');
        while($listDatasets->valid()) 
        {
            $dataSet = $listDatasets->next();
            $dataSetValues = $dataSet['value'];

            if ($dataSetValues && is_array($dataSetValues)) {
                foreach($dataSetValues as $dataSetValue) {
                    $height += $dataSetValue['fpVal'];
                }
            }
        }
        echo "Height: ".$height."<br />";
    };
}
while($listDataSources->valid()) {
    $dataSourceItem = $listDataSources->next();
    
    if ($dataSourceItem['dataType']['name'] == "com.google.step_count.delta") 
    {
        $dataStreamId = $dataSourceItem['dataStreamId'];
        $listDatasets = $dataSets->get("me", $dataStreamId, $startTime.'000000000'.'-'.$endTime.'000000000');
     
        while($listDatasets->valid()) {
            $dataSet = $listDatasets->next();
            $dataSetValues = $dataSet['value'];

            if ($dataSetValues && is_array($dataSetValues)) {
                foreach($dataSetValues as $dataSetValue) 
                {
                    $step_count += $dataSetValue['intVal'];
                }
            }
        }

        print("STEP: ".$step_count."<br />");
        print "-------------------------------------------------------------------------------------";
    };
}
         

} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in and have a request to shorten
  a URL, then we create a new URL object, set the
  unshortened URL, and call the 'insert' method on
  the 'url' resource. Note that we re-store the
  access_token bundle, just in case anything
  changed during the request - the main thing that
  might happen here is the access token itself is
  refreshed if the application has offline access.
 ************************************************/
if ($client->getAccessToken()  && isset($_GET['url'])) {

$dataSources = $service->users_dataSources;
$dataSets = $service->users_dataSources_datasets;
$listDataSources = $dataSources->listUsersDataSources("me");
while($listDataSources->valid()) 
{
    $dataSourceItem = $listDataSources->next();
    if ($dataSourceItem['dataType']['name'] == "com.google.step_count.delta") {

        $dataStreamId = $dataSourceItem['dataStreamId'];
        $listDatasets = $dataSets->get("me", $dataStreamId, $startTime.'000000000'.'-'.$endTime.'000000000');

        $step_count = 0;
        while($listDatasets->valid()) {
            $dataSet = $listDatasets->next();
            $dataSetValues = $dataSet['value'];

            if ($dataSetValues && is_array($dataSetValues)) {
                foreach($dataSetValues as $dataSetValue) {
                    $step_count += $dataSetValue['intVal'];
                }
            }
        }
        print("STEP: ".$step_count."<br />");
        print "-------------------------------------------------------------------------------------";
    };
   
}

}

if (strpos($client_id, "googleusercontent") == false) {
  echo missingClientSecretsWarning();
  exit;
}

?>
<!--<div class="box">-->
<!--  <div class="request">-->
<?php 

if (isset($authUrl)) 
{
  echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
} 
else
{
  echo <<<END
    <form id="url" method="GET" action="{$_SERVER['PHP_SELF']}">
      <input name="url" class="url" type="text">
      <input type="submit" value="Shorten">
    </form>
    <a class='logout' href='?logout'>Logout</a>
END;
}
?>
<!--  </div>-->

<!--  <div class="shortened">-->
<?php
//if (isset($short)) {
//  var_dump($short);
//}
?>
<!--  </div>-->
<!--</div>-->
