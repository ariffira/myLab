 
<?php
//    $this->ui->tile->base_init();
//    $this->ui->tile->options('class', 'tile m-b-10');
//    $this->ui->tile->title('content', $this->lang->line('general_text_button_add'));
//
//    $this->ui->tile->body->options('class', array('p-10', 'p-l-20', 'p-r-20', ));
//    echo '<div style="float:right;cursor:pointer;margin-bottom:10px;"><a href='. site_url('akte/access/addnewpatient').' class="btn btn-default">';
//    echo $this->lang->line('general_add_new_pat'). '</a></div><div style="clear:both;"></div>';
//    $this->ui->tile->body(
//      'content',
//      $this->load->view('access/patient_insert_view', array(), TRUE)
//    );    
//    # Block for insertion
//    echo $this->ui->tile->output();
    
    echo $this->ui->title->options('class', 'page-title')->content( $this->lang->line('general_text_button_add'))->output();
    echo $this->load->view(      
       'access/patient_insert_view', array()
    );
   
    # My Patients
    echo '<h4 class="block-title page-title">'. $this->lang->line('general_text_menu_my_patients_top') .'</h4>';
    
    $this->load->view('access/patient_list_view', array(
      'patients' => $this->modoc->get_patients(),
    ));
    
    
     if(isset($_GET['regid']))
     {
       $this->load->view('access/access_patient_view', array(
       'v_users' => $this->modoc->get_patientdetail($_GET['regid']),
       
      ));
      unset($_GET['regid']);
     }
      if(isset($_GET['docid']))
     {
      $this->load->view('access/patient_entry_view', array(
      ));
      unset($_GET['regid']);
     }
    
  ?>
<script type="text/javascript">
   $('#videochat').modal('show');
</script>
  <script>
    $.pageSetup($('#content'));
  </script>