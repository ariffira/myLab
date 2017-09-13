<head>
  
  <!--  -->
  <!-- META Area -->
  <!--  -->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="keywords" content="ihr,arzt,24,ihrarzt24,ihr arzt,online termin vereinbaren">
  <meta name="description" content="">

  <title>IhrArzt24 | Admin</title>

  <!--  -->
  <!-- Stylesheets -->
  <!--  -->

  <!-- Favicon -->
  <link rel="shortcut icon" href="">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />

  <!--[if gte IE 9]><!-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:100,300,400,700,900" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Gudea:100,300,400,700,900" />
  <!--<![endif]-->

  <!-- Basic Styles -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/bootstrap.min.css'); ?>" /> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/bootstrap-theme.min.css'); ?>" /> -->
  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url('assets/less/app.less'); ?>" />
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/font-awesome.min.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/icomoon.css'); ?>" />

  <!-- Page css -->
  <!-- Custom styles for offcanvas -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/offcanvas.css'); ?>" />

  <!-- Custom styles for fullcalendar -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/fullcalendar/cupertino/jquery-ui.min.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/fullcalendar/fullcalendar.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/fullcalendar/fullcalendar.print.css'); ?>" media='print' />

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="<?php echo base_url('assets/scripts/plugins/ie10-viewport-bug-workaround.js'); ?>"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!--[if lte IE 9]>
    <script src="<?php echo base_url('assets/scripts/libs/jquery-1.11.0.min.js'); ?>"></script>
    <script type="text/javascript">
      document.createElement("header");
      document.createElement("nav");
      document.createElement("aside");
      document.createElement("main");
      document.createElement("article");
      document.createElement("section");
      document.createElement("footer");
    </script>
    <style>
      .search > header {
        position: fixed;
        top: 0;
      }
    </style>
  <![endif]-->

  <!-- Owl Carousel Assets -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/owl-carousel/owl.carousel.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/owl-carousel/owl.theme.css'); ?>" />

  <!-- Chosen Assets -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/scripts/vendor/chosen/chosen.min.css'); ?>" />

  <!-- jQuery-ui-Timepicker-addon Assets -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.css'); ?>" />

  <!-- Summernote Assets -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/vendor/summernote/summernote.css'); ?>" />

  <!-- Overrides -->
  <?php if (isset($page_stylesheets) && is_array($page_stylesheets) && count($page_stylesheets) > 0) : ?>
    <?php foreach ($page_stylesheets as $row) : ?>
      <?php if (is_string($row)) : ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url($row); ?>" />
      <?php else: ?>
        <link
        <?php echo isset($row['rel']) && $row['rel'] ? 'rel="'.$row['rel'].'"' : 'rel="stylesheet"'; unset($row['rel']); ?>
        <?php echo isset($row['type']) && $row['type'] ? 'type="'.$row['type'].'"' : 'type="text/css"'; unset($row['type']); ?>
        <?php echo isset($row['href']) && $row['href'] ? 'href="'.base_url($row['href']).'"' : ''; unset($row['href']); ?>
        <?php foreach ($row as $key => $value) : ?> 
          <?php echo $key.'="'.$value.'"' ?>
        <?php endforeach; ?>
        />
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <script type="text/javascript">
    less = {
      env : 'development',
    };
  </script>
  <!--<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.3/less.min.js"></script>-->
  <script src="<?php echo base_url('assets/scripts/libs/less-1.7.3.min.js'); ?>"></script>

</head>