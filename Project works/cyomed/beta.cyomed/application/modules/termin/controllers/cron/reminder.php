<?php
class Reminder extends MX_Controller {
    public function index(){
		static $_ci;
        if (empty($_ci)) $_ci =& get_instance();

        $_ci->m->port->b->db_select('ia24at_reservations');
        
        $query  = $_ci->m->port->b->query("SELECT dts.doctor_id, patient_id, d.first_name dfname, d.last_name dlname, r.start termin_time, r.email, CASE WHEN r.gender=1 THEN 'Male' WHEN r.gender=2 THEN 'Female' ELSE 'Other' END AS gender, r.first_name pfname, r.last_name plname, r.telephone, reminder_email_subject, reminder_email_body, reminder_email_closing FROM ia24at_doctor_termin_settings dts LEFT JOIN ia24at_doctors d ON dts.doctor_id = d.doctor_id LEFT JOIN ia24at_reservations r ON dts.doctor_id = r.doctor_id AND DATE(r.start) = CURDATE() + dts.reminder_time where reminder_time_wrapper=1 ORDER BY dts.doctor_id, patient_id");
        
   	 	if ($query->num_rows() > 0) {
   	 		$result = $query->result_array();
   	 		foreach ($result as $value)
   	 		{
   	 			$email = $value['email'];
   	 			$subject = empty($value['reminder_email_subject'])?'Booking Reminder':$value['reminder_email_subject'];
   	 			$user_result['reminder_email_body'] = $value['reminder_email_body'];
	            $user_result['reminder_email_closing'] = $value['reminder_email_closing'];
   	 			
   	 			$user_result['termin_time'] = $value['termin_time'];
	            $user_result['doctor'] = $value['dfname'].' '.$value['dfname'];
	            $user_result['gender'] = $value['gender'];
	            $user_result['first_name'] = $value['pfname'];
	            $user_result['last_name'] = $value['plname'];
	            $user_result['email'] = $value['email'];
	            $user_result['telephone'] = $value['telephone'];
				$emailcontent = $this->load->view('cron/email/reminder', $user_result, true);

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