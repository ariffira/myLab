<!DOCTYPE html>
<html lang="de" class="clean">

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

    <title>cyomed | Portal</title>

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
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/bootstrap.min.css'); ?>" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/bootstrap-theme.min.css'); ?>" /> -->
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url('assets/ia24at/less/app.less'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/docs.min.css'); ?>" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/icomoon.css'); ?>" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/ia24at/scripts/plugins/ie10-viewport-bug-workaround.js'); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if lte IE 9]>
      <script src="<?php echo base_url('assets/ia24at/scripts/libs/jquery-1.11.0.min.js'); ?>"></script>
    <![endif]-->

    <!-- Page css -->

    <!-- Chosen Assets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/scripts/vendor/chosen/chosen.min.css'); ?>" />

    <!-- jQuery-ui-Timepicker-addon Assets -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.css'); ?>" /> -->

    <!-- Bootstrap datetimepicker Assets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>" />

    <!-- Owl Carousel Assets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/owl-carousel/owl.carousel.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/owl-carousel/owl.theme.css'); ?>" />

    <!-- Custom styles for fullcalendar -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/fullcalendar/cupertino/jquery-ui.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/fullcalendar/fullcalendar.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/vendor/fullcalendar/fullcalendar.print.css'); ?>" media='print' />

    <!-- Custom overrides -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ia24at/stylesheets/custom.css'); ?>" />

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
    <script src="<?php echo base_url('assets/ia24at/scripts/libs/less-1.7.3.min.js'); ?>"></script>

  </head>
  
  <body class="<?php echo isset($page_class) && $page_class ? $page_class : ''; ?>">

    <!-- Fixed navbar -->
    <header class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('akte'); ?>"><?php echo img('assets/img/logo/logo.png'); ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if (isset($topnav) && is_array($topnav)) : foreach ($topnav as $row) : ?>
              <li <?php if (isset($row['li']) && is_array($row['li'])) : foreach ($row['li'] as $key => $value) : echo ' '.$key.'="'.$value.'" '; endforeach; endif; ?> >
                <?php if (isset($row['a']) && isset($row['a']['text'])) : $text = $row['a']['text']; unset($row['a']['text']); else: $text = ''; endif; ?>
                <?php if (isset($row['submenu']) && is_array($row['submenu'])) : ?>
                  <?php $row['a']['class'] = (isset($row['a']['class']) ? $row['a']['class'] : '').' dropdown-toggle'; ?>
                  <?php $row['a']['data-toggle'] = 'dropdown'; ?>
                  <?php $text .= '<span class="caret"></span>'; ?>
                <?php endif; ?>
                <a <?php if (isset($row['a']) && is_array($row['a'])) : foreach ($row['a'] as $key => $value) : echo ' '.$key.'="'.$value.'" '; endforeach; endif; ?> >
                  <?php echo $text; ?>
                </a>
                <?php if (isset($row['submenu']) && is_array($row['submenu'])) : ?>
                  <?php foreach ($row['submenu'] as $submenu) : ?>
                    <li <?php if (isset($submenu['li']) && is_array($submenu['li'])) : foreach ($submenu['li'] as $key => $value) : echo ' '.$key.'="'.$value.'" '; endforeach; endif; ?> >
                      <?php if (isset($submenu['a']) && isset($submenu['a']['text'])) : $text = $submenu['a']['text']; unset($submenu['a']['text']); else: $text = ''; endif; ?>
                      <a <?php if (isset($submenu['a']) && is_array($submenu['a'])) : foreach ($submenu['a'] as $key => $value) : echo ' '.$key.'="'.$value.'" '; endforeach; endif; ?> >
                        <?php echo $text; ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </li>
            <?php endforeach; endif; ?>
          </ul>
        </div>
      </div>
    </header>

    <!-- Begin page content -->
    <div class="container" id="content">
      <?php echo isset($page_content) && $page_content ? $page_content : ''; ?>
    </div>

    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <p class="text-muted">
          &copy;&nbsp;&nbsp;<?php echo date("Y"); ?>&nbsp;&nbsp;IhrArzt24 GmbH.
          <a href="http://cyomed.com/?page_id=806">Impressum</a>  |  <a href="http://cyomed.com/?page_id=1479">Nutzungsvertrag und Datenschutz</a>
        </p>
      </div>
    </footer>

    <!--  -->
    <!-- BASIC Part -->
    <!--  -->

    <!--[if lte IE 8]>
    <script src="<?php echo base_url('assets/ia24at/scripts/libs/jquery-1.11.0.min.js'); ?>"></script>
    <![endif]-->

    <!--[if gt IE 8]>
    <script src="<?php echo base_url('assets/ia24at/scripts/libs/jquery-2.1.0.min.js'); ?>"></script>
    <![endif]-->

    <!--[if !IE]> -->
    <script src="<?php echo base_url('assets/ia24at/scripts/libs/jquery-2.1.0.min.js'); ?>"></script>
    <!-- <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- jQuery.ui -->
    <script src="<?php echo base_url('assets/ia24at/scripts/plugins/jquery-ui-1.11.0.custom/jquery-ui.min.js'); ?>"></script>
   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/ia24at/scripts/libs/bootstrap.min.js'); ?>"></script>

    <!--  -->
    <!-- PLUGIN part -->
    <!--  -->

    <!-- Moment.js -->
    <script src="<?php echo base_url('assets/ia24at/scripts/plugins/moment-with-locales.js'); ?>"></script>
    <script src="<?php echo base_url('assets/ia24at/scripts/plugins/locale/de.js'); ?>"></script>

    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- Chosen -->
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/chosen/chosen.jquery.min.js'); ?>"></script>

    <!-- jQuery-ui-Timepicker-addon -->
    <!-- <script src="<?php echo base_url('assets/ia24at/scripts/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.js'); ?>"></script> -->

    <!-- Bootstrap datetimepicker Assets -->
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js'); ?>"></script>

    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/owl-carousel/owl.carousel.js'); ?>"></script>

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/fullcalendar/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/fullcalendar/gcal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/ia24at/scripts/vendor/fullcalendar/lang-all.js'); ?>"></script>

    <!-- Overrides -->
    <?php if (isset($page_scripts) && is_array($page_scripts) && count($page_scripts) > 0) : ?>
      <?php foreach ($page_scripts as $row) : ?>
        <?php if (is_string($row)) : ?>
          <script src="<?php echo strpos($row, 'http') !== 0 ? base_url($row) : $row; ?>"></script>
        <?php else: ?>
          <?php isset($row['src']) && $row['src'] ? ($row['src='] = base_url($row['src'])) : NULL; ?>
          <script <?php foreach ($row as $key => $value) : echo $key.'="'.$value.'"'; endforeach; ?> ></script>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <!--  -->
    <!-- APP part -->
    <!--  -->
    <script type="text/javascript">
      $.baseUrl = "<?php echo base_url(); ?>";
      $.siteUrl = "<?php echo site_url(); ?>";
    </script>

    <script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>

    <div class="layer"></div>

  </body>
</html>