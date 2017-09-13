<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends MX_Controller {
	public $port = NULL;
	
	public function __construct() {
		$this->load->library('session');
		
		$this->port = (object) array(
				'b' => $this->load->database('bare', TRUE),
				'p' => $this->load->database('personal', TRUE),
				'm' => $this->load->database('medical', TRUE),
		);
	}
	
	public function download($id) {
		
		if ($this->session->userdata('login')) {
			$this->port->m->db_select();
			
			$querfile = $this->port->m->get_where('patients_docs', array('id' => $id));
			
			
			//foreach ($querfile->result() as $row) {
			if ($row = $querfile->result()) {
				//print_r($row);
				echo $row[0]->document_key;
			}
			
			echo 'eingeloggt ' . $id;
		}else {
		
			echo 'nicht eingeloggt';
		}
		/*
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename="'. $file_name .'"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '. filesize($filepath));
		
		// Datei ausgeben.
		@readfile($filepath);
		*/
	}
	
	function mc_decrypt($decrypt, $mc_key) {
		//$decoded = base64_decode($decrypt);
		$decoded = $decrypt;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		//$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($decoded), MCRYPT_MODE_ECB, $iv));
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mc_key, $decoded, MCRYPT_MODE_ECB, $iv);
	
		return $decrypted;
	}
	
}

/* End of file files.php */
/* Location: ./application/controllers/files.php */