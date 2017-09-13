<!-- Custom styles for fullcalendar -->
 <script type="text/javascript">
  less = {
    env : 'production',
    async:true
  };
</script>
<style>
    .owl-theme .owl-controls .owl-buttons div{ padding:2px 10px;opacity:1; background: none}
    .owl-prev .left{ background:url("<?php echo base_url()."/assets/img/privious-icoi.png"; ?>")no-repeat!important; height: 16px;}        
    .owl-next .right{ background:url("<?php echo base_url()."/assets/img/netx-ico.png"; ?>")no-repeat!important; height: 16px;}
    .col-header{ border: 1px solid #e1e1e1}
    #owl-wrapper .owl-item
    {
        margin:20px !important;
    }
    .appointment
    {
        background:#12B343 !important; color:#fff;
    }
    .col-header
    {
        background:#ffffff;
        color:#000000;
    }.appointment{top:2px}
    
    .owl-theme .owl-controls {
    margin-top: 10px;
    position: absolute;
    right: 0;
    text-align: center;
    top: -50px;
}
    .owl-carousel .owl-wrapper-outer{background: #f1f1f1; border:1px solid #ececec; padding: 10px;}
</style>
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
    <!--[if lt IE 9]>
    <script src="./js/libs/excanvas.compiled.js"></script>
    <![endif]-->

    <!-- Common variables -->
    <script>
      $.siteUrl = "<?php echo site_url(); ?>";
      $.baseUrl = "<?php echo base_url(); ?>";
      $.uiName = "<?php echo Ui::$bs_tname; ?>";
    </script>
    
    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.js'); ?>"></script>
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
      <?php
       if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
      <?php $this->load->view('plugins/entry_record_view', array('doctor' => $doctor, )); ?>
      <?php endforeach; endif; ?>
    </div>
 