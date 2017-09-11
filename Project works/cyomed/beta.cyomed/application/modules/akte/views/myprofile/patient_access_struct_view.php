  <?php
    $this->ui->init()->tile->base_init();
    $this->ui->tile->options('class', 'tile m-b-10');
    $this->ui->tile->title('content', 'Insert');
    $this->ui->tile->body->options('class', array('p-10', 'p-l-20', 'p-r-20', ));
     $this->ui->tile->output();
   	if(isset($_GET['regid']))
   	{
   		echo $this->ui->title->options('class', 'page-title')->content('All Doctors')->output();
   		
	    $this->load->view('access/doctor_list_view', array(
			'doctors' => $this->mopat->get_doctordetails($_GET['regid']),
	      	'hide_update' => TRUE,
	      	'hide_delete' => TRUE,
			'hide_checkbox' => TRUE,
	    	'hide_insertMany'=>FALSE
	    ));
   	}
   	else 
   	{
	    $this->ui->tile->body(
	      'content',
	       $this->load->view('access/doctor_insert_view', array(), TRUE)
	    );
	    $this->ui->tile->output();
	
	    # Block for insertion
	    echo $this->ui->tile->output();
	
	    # My Doctors
	    echo $this->ui->title->options('class', 'page-title')->content('My Doctors')->output();
	    
	    $this->load->view('access/doctor_list_view', array(
	      'doctors' => $this->mopat->get_doctors(),
	    ));
    
  	    # All approved Doctors
	    echo $this->ui->title->options('class', 'page-title')->content('Available Doctors')->output();
	    
	    $this->load->view('access/doctor_list_view', array(
	      'doctors' => $this->modoc->get_approved(),
	      'hide_update' => TRUE,
	      'hide_delete' => TRUE,
	      'hide_insertMany' => TRUE
	    ));
   	}
?>
  <script>
    $.pageSetup($('#content'));
  </script>