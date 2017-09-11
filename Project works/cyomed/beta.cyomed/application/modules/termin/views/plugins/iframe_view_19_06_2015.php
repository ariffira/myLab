<!DOCTYPE html>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="format-detection" content="telephone=no">
<meta charset="UTF-8">

<meta name="description" content="<?php echo isset($description) ? $description : ''; ?>" />
<meta name="keywords" content="<?php echo isset($keywords) ? $keywords : ''; ?>" />

<title><?php echo isset($title) ? $title : 'Cyomed'; ?></title>

<link rel="shortcut icon" href="<?php echo base_url('assets/img/icon/favicon.ico'); ?>" type="image/icon">
<link rel="icon" href="<?php echo base_url('assets/img/icon/favicon.ico'); ?>" type="image/icon">
<!-- ============== -->
<!-- MVPR110 STARTS -->
<!-- ============== -->

<!-- Google Font: Open Sans -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic" />
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oswald:400,300,700" />

<!-- jQuery UI smoothness -->
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/smoothness/jquery-ui.css" />

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/css/font-awesome.min.css'); ?>" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/css/bootstrap.min.css'); ?>" />


<!-- Icon Fonts -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/icomoon.css'); ?>" />

<!-- Owl Carousel Assets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/owl-carousel/owl.theme.css'); ?>" />

<!-- Custom styles for fullcalendar -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.print.css'); ?>" media='print' />

<style>
.owl-calendar{
  padding:0 15px;
}
.owl-calendar-list li{
  min-width:60px;
}
.owl-calendar .col-header,
.owl-calendar .appointment-link,
.owl-calendar .appointment.more{
  background:#7ac5d2;
  padding:5px 7px;  
  font-size:10px;
  text-align:center;
  color:#FFF;
  margin:0 1px 1px;
        display: block;
}
.owl-calendar .appointment-link,
.owl-calendar .appointment.more{
  background:#EEE;
  color:#333;
  font-size:12px;
}
.owl-calendar .appointment.more > .appointments{
  display:none;
  position:absolute;
}
.owl-calendar-list .appointment.more:hover > .appointments{
  display:block;
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev,
.owl-calendar .owl-controls .owl-buttons div.owl-next{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 14px;
  height: 100%;
  border-radius: 0px;
  margin: 0px;
  padding: 0px;
  text-indent:-9999px;
}
.owl-calendar .owl-controls .owl-buttons div.owl-next{
  left: auto;
  right: 0px;
  background-image:url(<?php echo base_url("assets/img/left-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-next:hover{
  background-image:url(<?php echo base_url("assets/img/left-white.gif"); ?>);
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev{
  background-image:url(<?php echo base_url("assets/img/right-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev:hover{
  background-image:url(<?php echo base_url("assets/img/right-white.gif"); ?>);
}
</style>


<script type="text/javascript">
  less = {
    env : 'production',
    async:true
  };
</script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.3/less.min.js"></script>-->
<script src="<?php echo base_url('assets/js/less-1.7.3.min.js'); ?>"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->


  <!-- Javascript Libraries -->
  <!-- jQuery -->
  <!-- jQuery Library -->
  <script src="<?php echo base_url('assets/sa103/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sa103/js/jquery-ui.min.js'); ?>"></script><!-- jQuery UI -->
  <script src="<?php echo base_url('assets/mvpr110/js/readmore.js'); ?>"></script> 
  <script src="<?php echo base_url('assets/sa103/js/jquery.easing.1.3.js'); ?>"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/sa103/js/bootstrap.min.js'); ?>"></script>

    <!--[if lt IE 9]>
    <script src="./js/libs/excanvas.compiled.js"></script>
    <![endif]-->

    <!-- Common variables -->
    <script>
      $.siteUrl = "<?php echo site_url(); ?>";
      $.baseUrl = "<?php echo base_url(); ?>";
      $.uiName = "<?php echo Ui::$bs_tname; ?>";
    </script>


    <!-- Moment.js -->
    <script src="<?php echo base_url('assets/js/moment-with-langs.min.js'); ?>"></script>

    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- jquery.form -->
    <script src="<?php echo base_url('assets/vendor/jquery.form/jquery.form.min.js'); ?>"></script>

    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.js'); ?>"></script>

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/gcal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/lang-all.js'); ?>"></script>


    <!--  -->
    <!-- APP part -->
    <!--  -->
    <script type="text/javascript">
      $.baseUrl = "<?php echo base_url(); ?>";
      $.siteUrl = "<?php echo site_url(); ?>";
      $.activeUrl = "<?php echo !empty($active_url) ? smart_site_url($active_url) : ''; ?>";
    </script>

    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugintermin.js'); ?>"></script>
    

    <!-- ================ -->
    <!-- IA24 STRUCT ENDS -->
    <!-- ================ -->


   <div class="doc-lists">

    <?php if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
      <?php $this->load->view('plugins/entry_record_view', array('doctor' => $doctor, )); ?>
      <?php endforeach; endif; ?>
    </div>


    </html>