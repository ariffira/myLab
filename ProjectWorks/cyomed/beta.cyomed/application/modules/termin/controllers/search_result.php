<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_result extends MX_Controller {

  /**
   *
   */
  public function index()
  {
    //lang load for design
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('termin_search',  $this->m->user_value('language'));
    
    $post_data = array();
    $speciality = $this->speciality->get()->result();
    $post_data['location'] = isset($_POST['location'])? $_POST['location'] : '';
    $post_data['specialty'] = isset($_POST['specialty'])? $_POST['specialty'] : 0;
    $post_data['distance'] = isset($_POST['distance']) ? (intval($_POST['distance'])+1)*5000 : 5000;
    $post_data['insurance'] = isset($_POST['insurance'])? $_POST['insurance'] : 'public';

    $doctors = $this->modoc->getTerminDoc($post_data);
    if($post_data['location']!=''){
     $startaddress = $this->getLatLong($post_data['location']);
    
    $oqs = $this->input->server('QUERY_STRING'); 
    
    $i = 1;
    $latlong = array();
    foreach ($doctors as $key => $row) {
      $doctors[$key]->marker_num = $s + $i++;
      $latlong = $this->getLatLong($doctors[$key]->address.','.$doctors[$key]->city);
      $doctors[$key]->distance = round($this->Haversine($startaddress,$latlong)*1.609344,2);
      if($doctors[$key]->distance > $post_data['distance']/1000)
        unset($doctors[$key]);
    }
}
    static $_ci;
    if (empty($_ci)) $_ci =& get_instance();
   
    $this->ui->mc->base_init();

    $this->ui->mc->title->content = '';

   echo $this->ui->mc->content->content = $_ci->load->view('termin_view', array(
          'speciality' => $speciality,
          'doctors' => $doctors,
          'pagination' => $pagination,
          'location' => $_POST['location'],
          'specialty' => $_POST['specialty'],
          'distance' => $_POST['distance'],
          'insurance' => $post_data['insurance'],
          'post_data' => json_encode($post_data), 
          'active_search' => TRUE, 
        ), TRUE);
   die();
   $this->output->set_output($this->ui->mc->output());
    
  }


  public function getLatLong($address) {

    $address = str_replace(' ', '+', $address);
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $geoloc = curl_exec($ch);
    
    curl_close($ch);
    $json = json_decode($geoloc);

    return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);
 
  }

  public function Haversine($start, $finish) {
 
    $theta = $start[1] - $finish[1]; 
    $distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515; 
 
    return $distance;
 
  }
}

/* End of file search_result.php */
/* Location: ./application/controllers/search_result.php */