<?php
class Followup extends MX_Controller {
    public function index(){
		static $_ci;
        if (empty($_ci)) $_ci =& get_instance();

        $_ci->m->port->b->db_select('ia24at_reservations');
        
        $query  = $_ci->m->port->b->query("SELECT dts.doctor_id, patient_id, d.first_name dfname, d.last_name dlname, r.start termin_time, r.email, CASE WHEN r.gender = 1 THEN 'Male' WHEN r.gender = 2 THEN 'Female' ELSE 'Other' END AS gender, r.first_name pfname, r.last_name plname, r.telephone, followup_email_subject, followup_email_body, followup_email_closing FROM ia24at_doctor_termin_settings dts LEFT JOIN ia24at_doctors d ON dts.doctor_id = d.doctor_id LEFT JOIN ia24at_reservations r ON dts.doctor_id = r.doctor_id AND Date(r.end) = Curdate() - dts.followup_time WHERE followup_time_wrapper = 1 ORDER BY dts.doctor_id, patient_id");
        
   	 	if ($query->num_rows() > 0) {
   	 		$result = $query->result_array();
   	 		foreach ($result as $value)
   	 		{
   	 			$email = $value['email'];
   	 			$subject = empty($value['followup_email_subject'])?'Booking Follow Up':$value['followup_email_subject'];
   	 			$user_result['followup_email_body'] = $value['followup_email_body'];
	            $user_result['followup_email_closing'] = $value['followup_email_closing'];
   	 			
	            $user_result['first_name'] = $value['pfname'];
	            $user_result['last_name'] = $value['plname'];
	            $user_result['email'] = $value['email'];
				$emailcontent = $this->load->view('cron/email/followup', $user_result, true);

				/*echo $email.'<br>';
				echo $subject.'<br>';
				echo $emailcontent.'<br><br>';*/
				
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <webmaster@cyomed.com>' . "\r\n";

				mail($email, $subject, $emailcontent,$headers);
	            //$this->moemail->send_email($email, $subject, $emailcontent);
   	 		}
        }
    }
}