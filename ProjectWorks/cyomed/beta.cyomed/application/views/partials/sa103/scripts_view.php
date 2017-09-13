    <!-- Javascript Libraries -->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/sa103/js/jquery.min.js'); ?>"></script> <!-- jQuery Library -->
    <script src="<?php echo base_url('assets/sa103/js/jquery-ui.min.js'); ?>"></script> <!-- jQuery UI -->
    <script src="<?php echo base_url('assets/sa103/js/jquery.easing.1.3.js'); ?>"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/sa103/js/bootstrap.min.js'); ?>"></script>

    <!-- Common variables -->
    <script>
      $.siteUrl = "<?php echo site_url(); ?>";
      $.baseUrl = "<?php echo base_url(); ?>";
      $.uiName = "<?php echo Ui::$bs_tname; ?>";
    </script>

    <!-- ============ -->
    <!-- SA103 STARTS -->
    <!-- ============ -->

    <!-- Charts -->
    <script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.js'); ?>"></script> <!-- Flot Main -->
    <script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.time.js'); ?>"></script> <!-- Flot sub -->
    <script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.animator.min.js'); ?>"></script> <!-- Flot sub -->
    <script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.resize.min.js'); ?>"></script> <!-- Flot sub - for repaint when resizing the screen -->

    <script src="<?php echo base_url('assets/sa103/js/sparkline.min.js'); ?>"></script> <!-- Sparkline - Tiny charts -->
    <script src="<?php echo base_url('assets/sa103/js/easypiechart.js'); ?>"></script> <!-- EasyPieChart - Animated Pie Charts -->
    <script src="<?php echo base_url('assets/sa103/js/charts.js'); ?>"></script> <!-- All the above chart related functions -->

    <!-- Map -->
    <script src="<?php echo base_url('assets/sa103/js/maps/jvectormap.min.js'); ?>"></script> <!-- jVectorMap main library -->
    <script src="<?php echo base_url('assets/sa103/js/maps/usa.js'); ?>"></script> <!-- USA Map for jVectorMap -->
    <script src="<?php echo base_url('assets/sa103/js/maps/world.js'); ?>"></script> <!-- World Map for jVectorMap -->

    <!--  Form Related -->
    <script src="<?php echo base_url('assets/sa103/js/validation/validate.min.js'); ?>"></script> <!-- jQuery Form Validation Library -->
    <script src="<?php echo base_url('assets/sa103/js/validation/validationEngine.min.js'); ?>"></script> <!-- jQuery Form Validation Library - requirred with above js -->
    <script src="<?php echo base_url('assets/sa103/js/select.min.js'); ?>"></script> <!-- Custom Select -->
    <script src="<?php echo base_url('assets/sa103/js/chosen.min.js'); ?>"></script> <!-- Custom Multi Select -->
    <script src="<?php echo base_url('assets/sa103/js/datetimepicker.min.js'); ?>"></script> <!-- Date & Time Picker -->
    <script src="<?php echo base_url('assets/sa103/js/colorpicker.min.js'); ?>"></script> <!-- Color Picker -->
    <script src="<?php echo base_url('assets/sa103/js/icheck.js'); ?>"></script> <!-- Custom Checkbox + Radio -->
    <script src="<?php echo base_url('assets/sa103/js/autosize.min.js'); ?>"></script> <!-- Textare autosize -->
    <script src="<?php echo base_url('assets/sa103/js/toggler.min.js'); ?>"></script> <!-- Toggler -->
    <script src="<?php echo base_url('assets/sa103/js/input-mask.min.js'); ?>"></script> <!-- Input Mask -->
    <script src="<?php echo base_url('assets/sa103/js/spinner.min.js'); ?>"></script> <!-- Spinner -->
    <script src="<?php echo base_url('assets/sa103/js/slider.min.js'); ?>"></script> <!-- Input Slider -->
    <script src="<?php echo base_url('assets/sa103/js/fileupload.min.js'); ?>"></script> <!-- File Upload -->

    <!-- Text Editor -->
    <script src="<?php echo base_url('assets/sa103/js/editor.min.js'); ?>"></script> <!-- WYSIWYG Editor -->
    <script src="<?php echo base_url('assets/sa103/js/markdown.min.js'); ?>"></script> <!-- Markdown Editor -->

    <!-- UX -->
    <script src="<?php echo base_url('assets/sa103/js/scroll.min.js'); ?>"></script> <!-- Custom Scrollbar -->

    <!-- Other -->
    <script src="<?php echo base_url('assets/sa103/js/calendar.min.js'); ?>"></script> <!-- Calendar -->
    <script src="<?php echo base_url('assets/sa103/js/feeds.min.js'); ?>"></script> <!-- News Feeds -->

    <script src="<?php echo base_url('assets/sa103/js/file-manager/elfinder.debug.js'); ?>"></script> <!-- File Manager -->
    
    <!-- All JS functions -->
    <script src="<?php echo base_url('assets/sa103/js/functions.js'); ?>"></script>

    <!-- ========== -->
    <!-- SA103 ENDS -->
    <!-- ========== -->

    <!-- ================== -->
    <!-- IA24 STRUCT STARTS -->
    <!-- ================== -->

    <!--  -->
    <!-- PLUGIN part -->
    <!--  -->

    <!-- Moment.js -->
    <script src="<?php echo base_url('assets/js/moment-with-langs.min.js'); ?>"></script>

    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.js'); ?>"></script>

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/vendor/fullcalendar/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar/gcal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar/lang-all.js'); ?>"></script>

    <!-- Google Code Prettify -->
    <script src="<?php echo base_url('assets/vendor/google-code-prettify/prettify.js'); ?>"></script>

    <!--  -->
    <!-- APP part -->
    <!--  -->
    <script type="text/javascript">
      $.baseUrl = "<?php echo base_url(); ?>";
      $.siteUrl = "<?php echo site_url(); ?>";
      $.activeUrl = "<?php echo !empty($active_url) ? smart_site_url($active_url) : ''; ?>";
    </script>

    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    


    <div class="layer"></div>

    <!-- ================ -->
    <!-- IA24 STRUCT ENDS -->
    <!-- ================ -->