  <?php
    $this->ui->init()->tile->base_init();
    $this->ui->tile->options('class', 'tile m-b-10');
    $this->ui->tile->title('content', $this->lang->line('general_text_button_add'));
    $this->ui->tile->body->options('class', array('p-10', 'p-l-20', 'p-r-20', ));
    $this->ui->tile->body(
      'content',
       $this->load->view('access/doctor_insert_view', array(), TRUE)
    );
    $this->ui->tile->output();

    # Block for insertion
    echo $this->ui->tile->output();

    # My Doctors
    echo $this->ui->title->options('class', 'page-title')->content($this->lang->line('patients_my_doctors_list_title'))->output();
    
    $this->load->view('access/doctor_list_view', array(
      	'doctors' => $this->mopat->get_doctors(),
		'hide_checkbox' => FALSE,
       	'hide_update' => FALSE,
      	'hide_delete' => FALSE,
    	'hide_insertMany' => TRUE
    ));
    
  

    # All approved Doctors
    echo $this->ui->title->options('class', 'page-title')->content($this->lang->line('patients_my_doctors_alllist_title'))->output();
    
    $this->load->view('access/doctor_list_view', array(
      'doctors' => $this->modoc->get_approved(),
       	'hide_checkbox' => TRUE,
       	'hide_update' => TRUE,
      	'hide_delete' => TRUE,
    	'hide_insertMany' => TRUE
    ));

?>
  <script>
    $.pageSetup($('#content'));
    $(document).ready(function(){
        $("#btn_delete_doctor").click(function(){
            $("#btn_delete_doctor").closest('form').attr('action',"<?php echo site_url('akte/access/deleteMany'); ?>");
        });
	});
  </script>