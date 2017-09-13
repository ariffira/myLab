 
<?php
    $this->ui->tile->base_init();
    $this->ui->tile->options('class', 'tile m-b-10');
    /*$this->ui->tile->title('content', 'Insert');*/
    $this->ui->tile->body->options('class', array('p-10', 'p-l-20', 'p-r-20', ));
  
   if(isset($_GET['regid']))
   {
      $this->load->view('myprofile/patient_list_view', array(
      'patients' => $this->modoc->get_patientdetailbyname(NULL,$_GET['regid']),'regid'=>$_GET['regid'],));   
   }
   else
   {
     $this->load->view('myprofile/patient_list_view', array(
     'patients' => $this->modoc->get_patients(),'regid'=>'',));   
   }
    /*$this->load->view('myprofile/access_patient_view', array(
       'v_users' => $this->modoc->get_patientdetail($_GET['regid']),
     ));
    unset($_GET['regid']);*/
   
 ?>
<script type="text/javascript">
   $('.ajax-load-link').click(function(e) 
         {
            
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
           
          
       });
         $('.ajax-profile-link').click(function(e) 
         {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
       });
</script>
  <script>
    $.pageSetup($('#content'));
  </script>