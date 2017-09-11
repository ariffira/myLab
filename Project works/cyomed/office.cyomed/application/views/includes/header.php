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

  <title>Cyomed | Admin</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url('assets/theme-admin/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
 
  <!-- DATA TABLES -->
  <link href="<?php echo base_url('assets/theme-admin/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- Theme style -->
  <link href="<?php echo base_url('assets/theme-admin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
  folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url('assets/theme-admin/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- iCheck -->
  <link href="<?php echo base_url('assets/theme-admin/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="<?php echo base_url('assets/theme-admin/plugins/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="<?php echo base_url('assets/theme-admin/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- bootstrap wysihtml5 - text editor -->
  <link href="<?php echo base_url('assets/theme-admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet" type="text/css" />
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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

  <link href="<?php echo base_url('/assets/chat/css/qm.css');?>" rel="stylesheet">

  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url('assets/less/app.less'); ?>" />
 
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
      env : 'production',
    };
  </script>

  <!--<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.3/less.min.js"></script>-->
  <script src="<?php echo base_url('assets/scripts/libs/less-1.7.3.min.js'); ?>"></script>

</head>



