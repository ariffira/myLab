<?php
class Outlookapi {
    private $outlook_auth_endpoint = 'https://login.live.com/oauth20_authorize.srf';
    private $outlook_auth_key = 'outlook_auth_key';
    private $outlook_token_url = 'https://login.live.com/oauth20_token.srf';
    private $outlook_api_endpoint = 'https://apis.live.net/v5.0/';
    private $client_id = NULL;
    private $client_secret = NULL;
    private $redirect_uri = NULL;
    private $scopes = array('wl.calendars_update', 'wl.offline_access');
    private $ci = NULL;
    private $http = NULL;
    private $access_token = NULL;
    private $refresh_token = NULL;

    /*
     * @method: constructor
     */
    public function __construct() {
	$this->ci = & get_instance();
	$this->ci->load->helper('curl');
	$this->ci->load->library('session');
	$this->http = new Curl();
	$authdata=$this->getAuthData();
	if($authdata){
	    $this->setAccessToken($authdata);
	    $this->setRefreshToken($authdata);
	}else{
	    $this->setAccessToken(NULL);
	    $this->setRefreshToken(NULL);
	}
    }
    /*
     * @method: get auth url
     */

    public function getAuthUrl() {
	$params = array(
	    'client_id' => $this->client_id,
	    'response_type' => 'code',
	    'scope' => rtrim(implode(' ', $this->scopes)),
	    'redirect_uri' => $this->redirect_uri,
	);
	return $this->outlook_auth_endpoint . '?' . http_build_query($params);
    }

    /*
     * @method: authorize code
     */

    public function Authorize($code = '') {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Unknown Error';
	$params = array(
	    'grant_type' => 'authorization_code',
	    'client_id' => $this->client_id,
	    'code' => $code,
	    'redirect_uri' => $this->redirect_uri,
	    'client_secret' => $this->client_secret,
	);
	$response = $this->http->post($this->outlook_token_url, $params);
	$isError=  $this->isErrorObject($response);
	if($isError){
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	}else{
	    $output['error']=0;
	    $output['txt']=  $response;
	    $this->setAuthData($response);
	}
	return $output;
    }

    public function refreshToken() {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Unknown Error';
	if ($this->refresh_token) {
	    $params = array(
		'grant_type' => 'refresh_token',
		'client_id' => $this->client_id,
		'refresh_token' => $this->getRefreshToken(),
		'redirect_uri' => $this->redirect_uri,
		'client_secret' => $this->client_secret,
	    );
	    $response = $this->http->post($this->outlook_token_url, $params);
	    $isError=  $this->isErrorObject($response);
	    if($isError){
		$output['error'] = 1;
		$output['txt'] = $isError;
	    }else{
		$output['error'] = 0;
		$output['txt'] = $response;
		$this->setAuthData($response);
	    }
	} else {
	    $output['error'] = 1;
	    $output['txt'] = 'Invalid Refresh Token Provided';
	}
	return $output;
    }

    //// getters & Setters////
    public function getAccessToken() {
	$authdata=$this->getAuthData();
	if($authdata){
	$this->setAccessToken($authdata);
	}
	return $this->access_token;
    }

    public function setAccessToken($access_token = '') {
	$this->access_token = $access_token;
	if (is_object($access_token)) {
	    $this->access_token = @$access_token->access_token;
	}
    }

    public function getRefreshToken() {
	$authdata=$this->getAuthData();
	if($authdata)
	{
	    $this->setRefreshToken($authdata);
	}
	return $this->refresh_token;
    }

    public function setRefreshToken($refresh_token = '') {
	$this->refresh_token = $refresh_token;
	if (is_object($refresh_token)) {
	    $this->refresh_token = @$refresh_token->refresh_token;
	}
    }

    public function getClient_id() {
	return $this->client_id;
    }

    public function setClient_id($client_id) {
	$this->client_id = $client_id;
    }

    public function getClient_secret() {
	return $this->client_secret;
    }

    public function setClient_secret($client_secret) {
	$this->client_secret = $client_secret;
    }

    public function getRedirect_uri() {
	return $this->redirect_uri;
    }

    public function setRedirect_uri($redirect_uri) {
	$this->redirect_uri = $redirect_uri;
    }

    public function getScopes() {
	return $this->scopes;
    }

    public function setScopes($scopes) {
	foreach ($scopes as $scope) {
	    $this->scopes[] = $scopes;
	}
    }

    /*
     * @method: get primary calendar
     */

    public function getPrimaryCalendar() {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Invalid Access Token';
	$response = $this->http->get($this->outlook_api_endpoint . 'me/calendars', array("access_token" => $this->getAccessToken()));
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else if (!empty($response->data)) {
	    foreach ($response->data as $calendar) {
		if (!empty($calendar->is_default) && $calendar->is_default) {
		    $output['error'] = 0;
		    $output['txt'] = $calendar->id;
		    break;
		    return $output;
		}
	    }
	} else {
	    $output['error'] = 1;
	    $output['txt'] = 'No Calendars Found';
	}
	return $output;
    }

    /*
     * @method: get all events for current month
     */

    public function getEvents() {
	$info = $this->getPrimaryCalendar();
	if ($info['error']) {
	    return $info;
	} else {
	    $id = $info['txt'];
	    $url = $this->outlook_api_endpoint . '/' . $id . '/events';
	    $response = $this->http->get($url, array('access_token' => $this->getAccessToken()));
	    $isError = $this->isErrorObject($response);
	    if ($isError) {
		$info['error'] = 1;
		$info['txt'] = $isError;
	    } else {
		if (!empty($response->data)) {
		    $info['error'] = 0;
		    $info['txt'] = $response->data;
		} else {
		    $info['error'] = 0;
		    $info['txt'] = array();
		}
	    }
	}
	return $info;
    }

    /*
     * @method : get event
     */

    public function getEvent($id = 0) {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'No Events Found';
	if ($id) {
	    $url = $this->outlook_api_endpoint . '/' . $id;
	    $response = $this->http->get($url, array('access_token' => $this->getAccessToken()));
	    $isError = $this->isErrorObject($response);
	    if ($isError) {
		$output['error'] = 1;
		$output['txt'] = $isError;
	    } else {
		$output['error'] = 0;
		$output['txt'] = $response;
	    }
	}
	return $output;
    }

    /*
     * @method: create event
     * 
     */

    public function createEvent($data) {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Invalid Request or Data';
	$params = array(
	    'name' => 'NA',
	    'description' => 'NA',
	    'visibility' => 'public',
	    'access_token' => $this->getAccessToken()
	);
	if (isset($data['name'])) {
	    $params['name'] = $data['name'];
	}
	if (isset($data['description'])) {
	    $params['description'] = $data['description'];
	}
	if (isset($data['start_time'])) {
	    $params['start_time'] = $this->formatDateTime($data['start_time'], "+05:30");
	}
	if (isset($data['end_time'])) {
	    $params['end_time'] = $this->formatDateTime($data['end_time'], "+05:30");
	}
	if (isset($data['is_all_day'])) {
	    $params['is_all_day'] = $data['is_all_day'];
	}
	if (isset($data['availability'])) {
	    $params['availability'] = $data['availability'];
	}
	$url = $this->outlook_api_endpoint . '/me/events';
	$response = $this->http->post($url, $params);
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	}
	return $output;
    }

    /*
     * 
     * @method: update event
     */

    public function updateEvent($id = 0, $data) {
	$output = array();
	$output['error'] = 1;
	$output['txt'] = 'Invalid Request or Data';
	if (!$id) {
	    $output['error'] = 1;
	    $output['txt'] = 'Event ID is Required';
	    return $output;
	}
	$params = array(
	    'name' => 'NA',
	    'description' => 'NA',
	    'visibility' => 'public',
	    'access_token' => $this->getAccessToken()
	);
	if (isset($data['name'])) {
	    $params['name'] = $data['name'];
	}
	if (isset($data['description'])) {
	    $params['description'] = $data['description'];
	}
	if (isset($data['start_time'])) {
	    $params['start_time'] = $this->formatDateTime($data['start_time'], "+05:30");
	}
	if (isset($data['end_time'])) {
	    $params['end_time'] = $this->formatDateTime($data['end_time'], "+05:30");
	}
	if (isset($data['is_all_day'])) {
	    $params['is_all_day'] = $data['is_all_day'];
	}
	if (isset($data['availability'])) {
	    $params['availability'] = $data['availability'];
	}
	$url = $this->outlook_api_endpoint . '/me/events/' . $id;
	$response = $this->http->patch($url, $params);
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	}
	return $output;
    }

    /*
     * @method: delete event
     */

    public function deleteEvent($event_id = 0) {
	$output = array();
	$url = $this->outlook_api_endpoint .$event_id.'?access_token='.$this->getAccessToken();
	$response = $this->http->delete($url);
	$isError = $this->isErrorObject($response);
	if ($isError) {
	    $output['error'] = 1;
	    $output['txt'] = $isError;
	} else {
	    $output['error'] = 0;
	    $output['txt'] = $response;
	}
	return $output;
    }
    /*
     * @method format time date for event
     */
    private function formatDateTime($datetimestr = '', $gmtoffset = '') {
	$datetime = @strtotime($datetimestr);
	$outputformat = date('Y-m-d H:i:s', $datetime);
	$outputformat = str_replace(' ', 'T', $outputformat) . $gmtoffset;
	return $outputformat;
    }
    /*
     * @method check api error object
     */
    private function isErrorObject($response) {
	if (isset($response->error)) {
	    return @$response->error->message;
	} elseif (empty($response)) {
	    return "Empty Response";
	} else {
	    return 0;
	}
    }
    public function getAuthData(){
	return $this->ci->session->userdata($this->outlook_auth_key);
    }
    public function setAuthData($data){
	$this->ci->session->set_userdata($this->outlook_auth_key,$data);
    }
    public function unsetAuthData(){
	$this->ci->session->unset_userdata($this->outlook_auth_key);
    }

}
