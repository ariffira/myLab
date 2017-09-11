
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
      <?php // if (empty($this->m->user())) : ?>
        <!-- added css for login page design-->
        <link  href="<?php echo base_url('assets/mvpr110/css/avenir-font.css');?>" rel="stylesheet">
        <link  href="<?php echo base_url('assets/mvpr110/css/custom-theme.css');?>" rel="stylesheet">
        <!--end here-->
        <?php //endif; ?> 
		<!-- ============ -->
		<!-- SA103 STARTS -->
		<!-- ============ -->

	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/bootstrap.min.css'); ?>" />-->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/animate.min.css'); ?>" />
	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/font-awesome.min.css'); ?>" />-->
	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/form.css'); ?>" />-->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/calendar.css'); ?>" />
	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/style.css'); ?>" />-->
	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/icons.css'); ?>" />-->
	    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/generics.css'); ?>" />-->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sa103/css/file-manager.css'); ?>" /> -->

		<!-- ========== -->
		<!-- SA103 ENDS -->
		<!-- ========== -->

	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/css/mvpready-admin.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/css/mvpready-flat.css'); ?>" />

	<?php if (!empty($mvpr_css) && $mvpr_css != 'admin') : ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/css/mvpready-admin-'.$mvpr_css.'.css'); ?>" />
	<?php endif; ?>

	<!-- Plugin CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/js/plugins/dataTables/dataTables.bootstrap.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/js/plugins/fileupload/bootstrap-fileupload.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/mvpr110/js/plugins/magnific/magnific-popup.css'); ?>" />

	<!-- ============ -->
	<!-- MVPR110 ENDS -->
	<!-- ============ -->

    <!-- Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/icomoon.css'); ?>" />

    <!-- Owl Carousel Assets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/owl-carousel/owl.theme.css'); ?>" />

    <!-- Custom styles for fullcalendar -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.print.css'); ?>" media='print' />


    <!-- Chosen Assets -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/chosen/chosen.min.css'); ?>" /> -->

    <!-- Bootstrap datetimepicker Assets -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>" /> -->

    <!-- elFinder -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/elfinder/css/elfinder.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/elfinder/css/theme.css'); ?>" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mvpr110/css/file-manager.css'); ?>" /> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/5.2.3/css/bootstrap-slider.min.css" rel="stylesheet">
    <?php if (Ui::$bs_tname == 'sa103') : ?>
    	<link rel="stylesheet/less" type="text/css" href="<?php echo base_url('assets/less/app.less'); ?>" />
	<?php endif; ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    	<link rel="stylesheet/less" type="text/css" href="<?php echo base_url('assets/less/app-mvpr110.less'); ?>" />
	<?php endif; ?>

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