<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservation extends MX_Controller {

    /**
     *
     */
    public function index() {
        // redirect(base_url().'../');
    }

    /**
     *
     */
    public function login() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->ui->mc->base_init();

        $this->ui->mc->title->content = '';

        $insurance_provider = $this->insurance_provider->get()->result();

        $this->ui->mc->content->content = $_ci->load->view('portal/reservation/check_user_view', array(
            'insurance_provider' => $insurance_provider,
            'pagination' => $pagination,
            'active_search' => TRUE,
                ), TRUE);


        $this->output->set_output($this->ui->mc->output());
    }

    /**
     *
     */
    // public function logout($id)
    // {
    //   static $_ci;
    //   if (empty($_ci)) $_ci =& get_instance();
    //   $this->ui->mc->base_init();
    //   $this->ui->mc->title->content = 'Reservation';
    //   $doctor = $this->modoc->get_id($id);
    //   if (!$doctor)
    //   {
    //     redirect(base_url().'../');
    //     exit();
    //   }
    //   $termin = (object) array(
    //     'start' => $this->input->get('start'), 
    //   );
    //   $insurance_provider = $this->insurance_provider->get()->result();
    //   $current_url = current_url().'?'.$this->input->server('QUERY_STRING');
    //   $this->load->library('encrypt');
    //   $encrypted_url = $this->encrypt->encode($current_url, 'IhrArzt24');
    //   $this->ui->mc->content->content = $_ci->load->view('portal/reservation/check_user_view', array(
    //         'insurance_provider' => $insurance_provider,
    //         'doctors' => $doctors,
    //         'doctor' => $doctor,
    //         'termin' => $termin, 
    //         'pagination' => $pagination,
    //         'post_data' => json_encode($post_data), 
    //         'page_scripts' => array('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places', ),
    //         'active_search' => TRUE, 
    //       ), TRUE);
    //   $this->output->set_output($this->ui->mc->output());
    // }

    /**
     *
     */
    public function logout($id) {

        $doctor = $this->modoc->get_id($id);

        if (!$doctor) {
            redirect(base_url() . '../');
            exit();
        }

        $termin = (object) array(
                    'start' => $this->input->get('start'),
        );
        $insurance_provider = $this->insurance_provider->get()->result();

        $current_url = current_url() . '?' . $this->input->server('QUERY_STRING');
        $this->load->library('encrypt');
        $encrypted_url = $this->encrypt->encode($current_url, 'IhrArzt24');

        $page_data = array(
            'insurance_provider' => $insurance_provider,
            'doctor' => $doctor,
            'termin' => $termin,
            'current_url' => $current_url,
            'encrypted_url' => $encrypted_url,
        );

        $page_content = $this->load->view('portal/reservation/logout_view', $page_data, TRUE);

        $output_data = array(
            'page_class' => '',
            'page_stylesheets' => array(),
            'page_scripts' => array('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places',),
            'page_content' => $page_content,
            'active_search' => TRUE,
        );

        $this->load->view('struct_clean_view', $output_data);
    }

    public function logout_patient($id) {

        $doctor = $this->modoc->get_id($id);

        if (!$doctor) {
            redirect(base_url() . '../');
            exit();
        }
        
        $termin = (object) array(
                    'terminid' => $this->input->get('terminid'),
                    'start' => $this->input->get('start'),
                    'specification' =>$this->input->get('specification'),
                    'end' => $this->input->get('endDate')
        );
        $insurance_provider = $this->insurance_provider->get()->result();

        $current_url = current_url() . '?' . $this->input->server('QUERY_STRING');
        $this->load->library('encrypt');
        $encrypted_url = $this->encrypt->encode($current_url, 'IhrArzt24');
        if($this->input->get('user_role')=='role_doctor'){
            $patinet_id = $this->input->get('patient_id');
            $patient_data = $this->m->user_details($patinet_id,"role_patient");
        }
        $page_data = array(
            'insurance_provider' => $insurance_provider,
            'doctor' => $doctor,
            'termin' => $termin,
            'current_url' => $current_url,
            'encrypted_url' => $encrypted_url,
            'user_role' => $this->input->get('user_role'),
            'patient_data' =>$patient_data
        );

        $page_content = $this->load->view('portal/reservation/logout_view_patient', $page_data, TRUE);

        $output_data = array(
            'page_class' => '',
            'page_stylesheets' => array(),
            'page_scripts' => array('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places',),
            'page_content' => $page_content,
            'active_search' => TRUE,
        );

        $this->load->view('struct_clean_view_new', $output_data);
    }

    /**
     *
     */
    public function reserve() {

        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();

        $this->ui->mc->base_init();

        $this->ui->mc->title->content = '';


        if ($this->input->post()) {
            if ($this->modoc->reserve()) {

                $doctor = $this->modoc->get_id($this->input->post('doctor_id'));

                $termin = (object) array(
                            'start' => $this->input->post('start'),
                );

                $insurance_provider = $this->insurance_provider->get_assoc();

                $success_info = array();
                foreach (array(
            'doctor_id',
            'gender',
            'first_name',
            'last_name',
            'email',
            'telephone',
            'insurance',
            'insurance_provider',
            'treatment',
            'return_visitor',
            'patient_notes',
                ) as $key) {
                    if ($this->input->post($key)) {
                        switch ($key) {
                            case 'doctor_id':
                                $success_info['doctor'] = $doctor->academic_grade . ' ' . $doctor->name . ' ' . $doctor->surname;
                                break;

                            default:
                                $success_info[$key] = $this->input->post($key);
                                break;
                        }
                    }
                }
                $page_data = array(
                    'insurance_provider' => $insurance_provider,
                    'doctor' => $doctor,
                    'termin' => $termin,
                    'success_info' => $success_info,
                );

                $page_content = $this->load->view('portal/reservation/success_view', $page_data, TRUE);

                $output_data = array(
                    'page_class' => '',
                    'page_stylesheets' => array(),
                    'page_scripts' => array('https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places',),
                    'page_content' => $page_content,
                );

                $this->load->view('struct_clean_view', $output_data);
            } else {
                $this->logout();
            }
        } else {
            redirect(base_url() . '../');
        }
    }

    public function reserve_patient() {
        static $_ci;
        if (empty($_ci))
            $_ci = & get_instance();
        $this->ui->mc->base_init();
        if ($this->input->post()) {
            if ($this->modoc->reserve()) {
                echo 1;
                die();
            }
        } else {
            echo 0;
            die();
        }
    }

    public function ajaxterminappointments() {
        if (isset($_POST['start']) && !empty($_POST['start'])) {
            $startDate = new DateTime($_POST['start']);
            if($startDate == date("Y-m-d")){
                $renderdate = $startDate;
            }else{
                $renderdate = $startDate->format("Y-m-d");
            }

           // if(strtotime($renderdate) > strtotime(date("Y-m-d",time()))){
           //      $startdate = $startDate->format("Y-m-d 00:00:00");
           // }
           // elseif(strtotime($renderdate) == strtotime(date("Y-m-d",time()))){
           //      $time=date('H:i:s',time());
           //      $startdate = $startDate->format("Y-m-d ".$time);
           // }
           // else{
           //     return false;
           // }
            $doctor_id = $_POST['did'];
            $specification = $_POST['specification'];
            $insurance_type = $_POST['insurance'];
            $string = '';
            //$enddate = $startDate->format("Y-m-d 23:59:59");
            $patient_id = $_POST['patient_id'];
            $user_role = $_POST['user_role'];

            //check for max_advance_booking
            $max_advance_booking = $this->modoc->get_max_advance_booking($doctor_id);
            $temp = explode(" ", $max_advance_booking);
            switch ($temp[1]) {
            	case 'days':
            		$max_advance_booking = $temp[0];
            		break;

            	case 'weeks':
            		$max_advance_booking = $temp[0]*7;
            		break;

            	case 'months':
            		$max_advance_booking = $temp[0]*30;
            		break;

            	default:
            		$max_advance_booking = $temp[0];
            		break;
            }

            if(date_diff(new DateTime("now"),date_create($renderdate))->format('%R%a') > $max_advance_booking){
            	echo '<br><h6>Maximim frühbuchbar erreicht.</h6>'.'<br>';
            	die();
            }

            $reservation_data = $this->modoc->get_date_reservations($doctor_id, $renderdate ,$insurance_type);
            // $reserved_data = $this->modoc->get_accepted_reservations_data($doctor_id,$renderdate);
            // $reserved_am = array();
            // $reserved_pm = array();
            $no_of_termin = 0;
    //         if(count($reserved_data)>0){
    //         	foreach($reserved_data as $key=>$val){
    //             	// print $val->start;  
    //               	$start_time =  date("A", strtotime($val->start));
    //              	// print $start_time;
    //              	// die();
    //                	if($start_time=='AM'){
    //                 	$reserved_am[]=array(
	   //                      "start_date" => $val->start,
	   //                      "end_date" => $val->end
    //                     );
    //                	} 
    //                	elseif($start_time=='PM'){
    //                 	$reserved_pm[]=array(
	   //                      "start_date" => $val->start,
	   //                      "end_date" => $val->end
    //                     );   
    //                }
				// }
    //         }
            /*echo "<pre>";
            echo date("Y-m-d H:i:s");
            print_r($reservation_data);
            die;*/
            
            if (isset($reservation_data) && sizeof($reservation_data) > 0) {
                $string = "<table width='50%' style='float:left;'>";
                $string .= "<tr><td><center><strong>AM</strong></center></td></tr>";
                $now = date("Y-m-d H:i:s");
                foreach ($reservation_data as $rd) {
                	$flag = 0; 
                   	$flag1 = 0; 
                  	$meditarian = date("A", strtotime($rd->start));
                   	if($meditarian=='AM'){
                   		$start = new DateTime($rd->start);
                   		if($rd->start >= $now) {
                   			
                   		// }
                    	// else if(count($reserved_am)>0){
	                    // 	foreach($reserved_am as $reservedAm){
	                    //     	$reserved_s_time = date("h:i",strtotime($reservedAm['start_date']));
	                    //      	$reserved_e_time = date("h:i",strtotime($reservedAm['end_date']));        
	                    //      	$r_s_t = date("h:i",strtotime($rd->start));
	                    //       	$r_e_t = date("h:i",strtotime($rd->end));
	                    //       	if($reserved_s_time==$r_s_t && $reserved_e_time==$r_e_t){
	                    //         	$flag = 1;
	                    //        	}
	                    //    	}
                     //   	}
                       	// if($flag==0){ 
                            $no_of_termin++;
                        	$string .= '<tr><td><a href="javascript:void(0);" class="appointment-link appointment" onclick="bookappointment(' . "'" . $doctor_id . "'" . ',' . "'" .$rd->id. "'" . "," . "'" . $rd->start . "'" . ',' . "'" . $rd->end . "'" . ',' . "'" . $specification . "'" . ',' . "'" . $patient_id . "'" . ',' . "'" . $user_role . "'" . ');">' . date("h:i", strtotime($rd->start)) . '&nbsp;-&nbsp;' . date("h:i", strtotime($rd->end)) . '</a></td></tr>';
                       	}else{
                            //$string .= '<tr><td><div class="appointment-link appointment">'. date("h:i", strtotime($rd->start)) . '&nbsp;-&nbsp;' . date("h:i", strtotime($rd->end)) . '</div></td></tr>';
                       	}
                       
					} 
				}
                $string .= "</table>";
                $string1 = "<table width='50%'>";
                $string1 .= "<tr><td><center><strong>PM</strong></center></td></tr>";
                foreach ($reservation_data as $rd) {
                	$meditarian1 = date("A", strtotime($rd->start));
                    if($meditarian1=='PM'){
                   		if($rd->start >= $now) {
                   		// 	$flag1 = 1;
                   		// }
                    	// elseif(count($reserved_am)>0){
	                    // 	foreach($reserved_pm as $reservedPm){
	                    //     	$reserved_s_time = date("h:i",strtotime($reservedPm['start']));
	                    //       	$reserved_e_time = date("h:i",strtotime($reservedPm['end']));        
	                    //       	$r_s_t = date("h:i",strtotime($rd->start));
	                    //       	$r_e_t = date("h:i",strtotime($rd->end)); 
	                    //        	if($reserved_s_time==$r_s_t && $reserved_e_time==$r_e_t){
	                    //         	$flag1 = 1;
	                    //        	}
	                    //    	}
                    	// }
                        
                     //    if($flag1==0){ 
                            $no_of_termin++;
                            $string1 .= '<tr><td><a href="javascript:void(0);" class="appointment-link appointment" onclick="bookappointment(' . "'" . $doctor_id . "'" . ',' . "'" .$rd->id. "'" . "," . "'" . $rd->start . "'" . ',' . "'" . $rd->end . "'" . ',' . "'" . $specification . "'" . ',' . "'" . $patient_id . "'" . ',' . "'" . $user_role . "'" . ');">' . date("h:i", strtotime($rd->start)) . '&nbsp;-&nbsp;' . date("h:i", strtotime($rd->end)) . '</a></td></tr>';
                       	}
                       	else
                       	{
                        	//$string1 .= '<tr><td><div class="appointment-link appointment">'. date("h:i", strtotime($rd->start)) . '&nbsp;-&nbsp;' . date("h:i", strtotime($rd->end)) . '</div></td></tr>';
                       	}
					} 
				}
                $string1 .= "</table>";
            }
            if($no_of_termin > 0){
                echo $string.$string1;
            }else{
                //todo: check reservations table with this doctor_id& rednderdate and patient_id for wait=1,
                // if 1 then its waiting list or else click for waiting list
                $query = $this->m->port->b->get_where('reservations', array('doctor_id' => $doctor_id,'patient_id' => $patient_id,'start' => $renderdate,'wait' => 1, ), 1);
               
                if ($query->num_rows() > 0)
                {
                   $button = '<button class="btn btn-default" align="center">You are in waiting list</button>';
                   echo '<br><h6>Für den ausgewählte Tag ist keinen Termin verfügbar.</h6>'.'<br>'.$button;
                }
                else
                {
                    $button = '<button id="wlist" class="btn btn-default" onclick="gotowaitinglist('.$doctor_id.','."'".$renderdate."'".')" align="center">Auf die warte liste</button>';
                    echo '<br><h6>Für den ausgewählte Tag ist keinen Termin verfügbar.</h6>'.'<br>'.$button;
                }
               
            }
            exit();
        }
    }

}

/* End of file reservation.php */
/* Location: ./application/controllers/profile/reservation.php */