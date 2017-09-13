  <?php 
//    $this->ui->init()->tile->base_init();
//   $this->ui->title->options('class', 'page-title')->content($this->lang->line('patients_my_doctors_list_title'))->output();
//    echo   $this->ui->tile->body(
//      'content',
//       $this->load->view('profile/doctorconnect_insert_view', array(), TRUE)
//    );
    # Block for insertion
//    echo $this->ui->tile->output();
    
      
   echo $this->ui->title->options('class', 'page-title')->content( $this->lang->line('general_text_button_add'))->output();
   echo $this->load->view(      
       'profile/doctorconnect_insert_view', array()
    );
//    
//print_R($this->mopat->get_doctorsconnet());die;
    # My Doctors
    echo $this->ui->title->options('class', 'page-title')->content($this->lang->line('patients_my_doctors_list_title'))->output();
        
   echo $this->load->view('profile/doctorconnect_list_view', array(
      	'doctors' => $this->mopat->get_doctorsconnet(),
	'hide_checkbox' => FALSE,
       	'hide_update' => FALSE,
      	'hide_delete' => FALSE,
        'hide_status'=>False,
    ));
    
  

    # All approved Doctors
    echo $this->ui->title->options('class', 'page-title')->content($this->lang->line('patients_my_doctors_alllist_title'))->output();
    
//    print_r($this->modoc->doctor_connected_listing());die;
//    print_r($this->modoc->get_approved());die;
    echo $this->load->view('profile/doctorconnect_list_view', array(
        'doctors' => $this->modoc->doctor_connected_listing(),
       	'hide_checkbox' => TRUE,
       	'hide_update' => TRUE,
      	'hide_delete' => TRUE,
        'hide_status'=>True,
    ));

?>
  <script>
    $.pageSetup($('#content'));
    $(document).ready(function(){
        $("#btn_delete_doctor").click(function(){
            $("#btn_delete_doctor").closest('form').attr('action',"<?php echo site_url('akte/profile/doctor_connect_deleteMany'); ?>");
        });
	});
  </script>