    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/theme-admin/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>

    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/theme-admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
    
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/sparkline/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/theme-admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/knob/jquery.knob.js'); ?>" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/theme-admin/plugins/daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/theme-admin/plugins/slimScroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('assets/theme-admin/plugins/fastclick/fastclick.min.js'); ?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/theme-admin/dist/js/app.min.js'); ?>" type="text/javascript"></script>    
        
   
    <!-- offcanvas -->
    <script src="<?php echo base_url('assets/scripts/plugins/offcanvas.js'); ?>"></script>

    <!-- Moment.js -->
    <script src="<?php echo base_url('assets/scripts/plugins/moment-with-langs.min.js'); ?>"></script>

    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/scripts/vendor/owl-carousel/owl.carousel.js'); ?>"></script>

    <!-- Google Maps -->
    <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>-->
    <!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/scripts/vendor/fullcalendar/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/scripts/vendor/fullcalendar/gcal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/scripts/vendor/fullcalendar/lang-all.js'); ?>"></script>

    <!-- Chosen -->
    <script src="<?php echo base_url('assets/scripts/vendor/chosen/chosen.jquery.min.js'); ?>"></script>

    <!-- jQuery-ui-Timepicker-addon -->
    <script src="<?php echo base_url('assets/scripts/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.js'); ?>"></script>

    <!-- Summernote -->
    <script src="<?php echo base_url('assets/scripts/vendor/summernote/summernote.min.js'); ?>"></script>

    <!-- include summernote-ko-KR -->
    <script src="<?php echo base_url('assets/scripts/vendor/summernote/lang/summernote-ko-KR.js'); ?>"></script>

    <!--  -->
    <!-- APP part -->
    <!--  -->
    <script src="<?php echo base_url('assets/scripts/app.js'); ?>"></script>

    <script type="text/javascript">
      CyomedApp ? + function() {
        CyomedApp.setBaseUrl("<?php echo base_url(); ?>");
        CyomedApp.setSiteUrl("<?php echo site_url(); ?>");
        <?php if (!empty($active_url)) : ?>
            CyomedApp.activeUrl = '<?php echo $active_url; ?>';
        <?php endif; ?>
      }() : 1;
    </script>