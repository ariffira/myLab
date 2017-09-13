<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>FAQ &middot; MVP Ready Admin</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Google Font: Open Sans -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="./css/font-awesome.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./css/bootstrap.min.css">

  <!-- App CSS -->
  <link rel="stylesheet" href="./css/mvpready-admin.css">
  <link rel="stylesheet" href="./css/mvpready-flat.css">
  <!-- <link href="./css/custom.css" rel="stylesheet">-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body class=" ">

<div id="wrapper">

  <header class="navbar navbar-inverse" role="banner">

    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-cog"></i>
        </button>

        <a href="./" class="navbar-brand navbar-brand-img">
          <img src="./img/logo.png" alt="MVP Ready">
        </a>
      </div> <!-- /.navbar-header -->


      <nav class="collapse navbar-collapse" role="navigation">

        <ul class="nav navbar-nav noticebar navbar-left">

          <li class="dropdown">
            <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="navbar-visible-collapsed">&nbsp;Notifications&nbsp;</span>
              <span class="badge badge-primary">3</span>
            </a>

            <ul class="dropdown-menu noticebar-menu noticebar-hoverable" role="menu">
              <li class="nav-header">
                <div class="pull-left">
                  Notifications
                </div>

                <div class="pull-right">
                  <a href="javascript:;">Mark as Read</a>
                </div>
              </li>

              <li>
                <a href="./page-notifications.html" class="noticebar-item">
                  <span class="noticebar-item-image">
                    <i class="fa fa-cloud-upload text-success"></i>
                  </span>
                  <span class="noticebar-item-body">
                    <strong class="noticebar-item-title">Templates Synced</strong>
                    <span class="noticebar-item-text">20 Templates have been synced to the Mashon Demo instance.</span>
                    <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> 12 minutes ago</span>
                  </span>
                </a>
              </li>

              <li>
                <a href="./page-notifications.html" class="noticebar-item">
                  <span class="noticebar-item-image">
                    <i class="fa fa-ban text-danger"></i>
                  </span>
                  <span class="noticebar-item-body">
                    <strong class="noticebar-item-title">Sync Error</strong>
                    <span class="noticebar-item-text">5 Designs have been failed to be synced to the Mashon Demo instance.</span>
                    <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> 20 minutes ago</span>
                  </span>
                </a>
              </li>

              <li class="noticebar-menu-view-all">
                <a href="./page-notifications.html">View All Notifications</a>
              </li>
            </ul>
          </li>



          <li class="dropdown">
            <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope"></i>
              <span class="navbar-visible-collapsed">&nbsp;Messages&nbsp;</span>
            </a>

            <ul class="dropdown-menu noticebar-menu noticebar-hoverable" role="menu">                
              <li class="nav-header">
                <div class="pull-left">
                  Messages
                </div>

                <div class="pull-right">
                  <a href="javascript:;">New Message</a>
                </div>
              </li>

              <li>
                <a href="./page-notifications.html" class="noticebar-item">
                  <span class="noticebar-item-image">
                    <img src="./img/avatars/avatar-1-md.jpg" style="width: 50px" alt="">
                  </span>

                  <span class="noticebar-item-body">
                    <strong class="noticebar-item-title">New Message</strong>
                    <span class="noticebar-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                    <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> 20 minutes ago</span>
                  </span>
                </a>
              </li>

              <li>
                <a href="./page-notifications.html" class="noticebar-item">
                  <span class="noticebar-item-image">
                    <img src="./img/avatars/avatar-2-md.jpg" style="width: 50px" alt="">
                  </span>

                  <span class="noticebar-item-body">
                    <strong class="noticebar-item-title">New Message</strong>
                    <span class="noticebar-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                    <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> 5 hours ago</span>
                  </span>
                </a>
              </li>

              <li class="noticebar-menu-view-all">
                <a href="./page-notifications.html">View All Messages</a>
              </li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-exclamation-triangle"></i>
              <span class="navbar-visible-collapsed">&nbsp;Alerts&nbsp;</span>
            </a>

            <ul class="dropdown-menu noticebar-menu noticebar-hoverable" role="menu">                
              <li class="nav-header">
                <div class="pull-left">
                  Alerts
                </div>
              </li>

              <li class="noticebar-empty">                  
                <h4 class="noticebar-empty-title">No alerts here.</h4>
                <p class="noticebar-empty-text">Check out what other makers are doing on Explore!</p>                
              </li>
            </ul>
          </li>

        </ul>



        <ul class="nav navbar-nav navbar-right">    

          <li>
            <a href="javsacript:;">About</a>
          </li>    

          <li>
            <a href="javascript:;">Resources</a>
          </li>    

          <li class="dropdown navbar-profile">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
              <img src="./img/avatars/avatar-1-xs.jpg" class="navbar-profile-avatar" alt="">
              <span class="navbar-profile-label">rod@rod.me &nbsp;</span>
              <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu" role="menu">

              <li>
                <a href="./page-profile.html">
                  <i class="fa fa-user"></i> 
                  &nbsp;&nbsp;My Profile
                </a>
              </li>

              <li>
                <a href="./page-pricing.html">
                  <i class="fa fa-dollar"></i> 
                  &nbsp;&nbsp;Plans & Billing
                </a>
              </li>

              <li>
                <a href="./page-settings.html">
                  <i class="fa fa-cogs"></i> 
                  &nbsp;&nbsp;Settings
                </a>
              </li>

              <li class="divider"></li>

              <li>
                <a href="./account-login.html">
                  <i class="fa fa-sign-out"></i> 
                  &nbsp;&nbsp;Logout
                </a>
              </li>

            </ul>

          </li>

        </ul>

      </nav>

    </div> <!-- /.container -->

  </header>


  <div class="mainnav">

    <div class="container">

      <a class="mainnav-toggle" data-toggle="collapse" data-target=".mainnav-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </a>

      <nav class="collapse mainnav-collapse" role="navigation">

        <form class="mainnav-form pull-right" role="search">
          <input type="text" class="form-control input-md mainnav-search-query" placeholder="Search">
          <button class="btn btn-sm mainnav-form-btn"><i class="fa fa-search"></i></button>
        </form>

        <ul class="mainnav-menu">

          <li class="dropdown ">
          	<a href="./index.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
          	Dashboards
          	<i class="mainnav-caret"></i>
          	</a>

          	<ul class="dropdown-menu" role="menu">
              <li>
                <a href="./index.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Analytics Dashboard
                </a>
              </li>

              <li>
                <a href="./dashboard-2.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Sidebar Dashboard
                </a>
              </li>

              <li>
                <a href="./dashboard-3.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Reports Dashboard
                </a>
              </li>
          	</ul>
          </li>


          <li class="dropdown ">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            Components
            <i class="mainnav-caret"></i>					
            </a>

            <ul class="dropdown-menu" role="menu">

              <li>
                <a href="./components-tabs.html">
                <i class="fa fa-bars"></i> 
                &nbsp;&nbsp;Tabs &amp; Accordions
                </a>
              </li>

              <li>
                <a href="./components-popups.html">
                <i class="fa fa-calendar-o"></i> 
                &nbsp;&nbsp;Popups &amp; Alerts
                </a>
              </li>

              <li>
                <a href="./components-validation.html">
                <i class="fa fa-check"></i> 
                &nbsp;&nbsp;Validation
                </a>
              </li>

              <li>
                <a href="./components-datatables.html">
                <i class="fa fa-table"></i> 
                &nbsp;&nbsp;Data Tables
                </a>
              </li>

              <li>
                <a href="./components-gallery.html">
                <i class="fa fa-picture-o"></i> 
                &nbsp;&nbsp;Gallery
                </a>
              </li>

              <li>
                <a href="./components-charts.html">
                <i class="fa fa-bar-chart-o"></i> 
                &nbsp;&nbsp;Charts
                </a>
              </li>		  
            </ul>
          </li>


          <li class="dropdown active">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            Sample Pages
            <i class="mainnav-caret"></i>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="./page-pricing.html">
                <i class="fa fa-money"></i> 
                &nbsp;&nbsp;Plans & Billing
                </a>
              </li>

              <li>
                <a href="./page-profile.html">
                <i class="fa fa-user"></i> 
                &nbsp;&nbsp;Profile
                </a>
              </li>

              <li>
                <a href="./page-settings.html">
                <i class="fa fa-cogs"></i> 
                &nbsp;&nbsp;Settings
                </a>
              </li>

              <li>
                <a href="./page-faq.html">
                <i class="fa fa-question"></i> 
                &nbsp;&nbsp;FAQ
                </a>
              </li>
            </ul>
          </li>


          <li class="dropdown ">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            Extras
            <i class="mainnav-caret"></i>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="./page-notifications.html">
                <i class="fa fa-bell"></i> 
                &nbsp;&nbsp;Notifications
                </a>
              </li>			

              <li>
                <a href="./extras-icons.html">
                <i class="fa fa-smile-o"></i> 
                &nbsp;&nbsp;Font Icons
                </a>
              </li> 

              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">
                <i class="fa fa-ban"></i> 
                &nbsp;&nbsp;Error Pages
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="./page-404.html">
                    <i class="fa fa-ban"></i> 
                    &nbsp;&nbsp;404 Error
                    </a>
                  </li>

                  <li>
                    <a href="./page-500.html">
                    <i class="fa fa-ban"></i> 
                    &nbsp;&nbsp;500 Error
                    </a>
                  </li>
                </ul>
              </li>

              <li class="dropdown-submenu">

                <a tabindex="-1" href="#">
                <i class="fa fa-lock"></i> 
                &nbsp;&nbsp;Login Pages
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="./account-login.html">
                    <i class="fa fa-unlock"></i> 
                    &nbsp;&nbsp;Login
                    </a>
                  </li>

                  <li>
                    <a href="./account-login-social.html">
                    <i class="fa fa-unlock"></i> 
                    &nbsp;&nbsp;Login Social
                    </a>
                  </li>

                  <li>
                    <a href="./account-signup.html">
                    <i class="fa fa-star"></i> 
                    &nbsp;&nbsp;Signup
                    </a>
                    </li>

                  <li>
                    <a href="./account-forgot.html">
                    <i class="fa fa-envelope"></i> 
                    &nbsp;&nbsp;Forgot Password
                    </a>
                  </li>
                </ul>
              </li> 

            </ul>

          </li>

        </ul>

      </nav>

    </div> <!-- /.container -->

  </div> <!-- /.mainnav -->

  <div class="content">

    <div class="container">

        <div class="layout layout-stack-sm layout-main-left">

          <div class="col-sm-4 col-sm-push-8 layout-sidebar">

            <div class="well text-center">
              <p><i class="fa fa-question-circle fa-5x text-muted"></i></p>
              <h4>Have a Question?</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <a href="javascript:;" class="btn btn-secondary">Get it Answered!</a>
            </div> <!-- /.well -->

            <br>

            <div class="portlet">

              <h4>Categories</h4>

              <div class="list-group">

                <a href="javascript:;" class="list-group-item">
                Account Settings
                <span class="badge badge-primary">6</span>
                </a>  

                <a href="javascript:;" class="list-group-item">
                API Questions
                <span class="badge badge-primary">5</span>
                </a>  

                <a href="javascript:;" class="list-group-item">
                Billing
                <span class="badge badge-primary">12</span>
                </a>  

                <a href="javascript:;" class="list-group-item">
                Copyright &amp; Legal
                <span class="badge badge-primary">4</span>
                </a> 
            </div> <!-- /.list-group -->

          </div> <!-- /.portlet -->

        </div> <!-- /.layout-sidebar -->



        <div id="faq-questions" class="col-sm-8 col-sm-pull-4 layout-main">

          <h2 class="">Frequently Asked Questions</h2>

          <br><br>

          <h4 class="content-title"><u>General Questions</u></h4>

          <div id="accordion-help" class="panel-group accordion-simple">

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-help" href="#faq-general-1"><i class="fa faq-accordion-caret"></i>Mauris cursus massa quis lorem lacinia, eget dictum sapien pellentesque? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-general-1" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-help" href="#faq-general-2"><i class="fa faq-accordion-caret"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-general-2" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-help" href="#faq-general-3"><i class="fa faq-accordion-caret"></i>Sed vel dui rutrum, dignissim tortor? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-general-3" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-help" href="#faq-general-4"><i class="fa faq-accordion-caret"></i>Pellentesque quis lacus vestibulum, pulvinar massa sit amet, vulputate mauris? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-general-4" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

          </div> <!-- /.accordion -->

          <br><br>

          <h4 class="content-title"><u>Pre-Sale Questions</u></h4>

          <div id="accordion-customization" class="panel-group accordion-simple">

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customization" href="#faq-presale-1"><i class="fa faq-accordion-caret"></i>Etiam sit amet metus nec magna aliquam venenatis? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-presale-1" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customization" href="#faq-presale-2"><i class="fa faq-accordion-caret"></i>Integer aliquam quam at felis consequat volutpat? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-presale-2" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customization" href="#faq-presale-3"><i class="fa faq-accordion-caret"></i>In vel lacus eget neque ultricies posuere? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-presale-3" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customization" href="#faq-presale-4"><i class="fa faq-accordion-caret"></i>Aliquam consequat ante at viverra pellentesque? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-presale-4" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

            <div class="panel">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customization" href="#faq-presale-5"><i class="fa faq-accordion-caret"></i>Morbi rhoncus odio ut ipsum cursus venenatis? </a>
                </h4>
              </div><!-- .panel-heading -->

              <div id="faq-presale-5" class="panel-collapse collapse">
                <div class="panel-body">
                <p>Nam vulputate diam risus, quis auctor augue varius et. Donec laoreet erat fringilla lorem tempus fringilla. Quisque posuere risus enim, eget aliquam metus auctor congue. Ut condimentum odio sed odio congue ornare. Fusce et elit volutpat dolor porttitor vulputate. Sed vitae sollicitudin metus. Nunc ut sem in magna pellentesque commodo. Sed tristique metus condimentum quam molestie tristique.</p>
                </div><!-- .panel-body -->
              </div> <!-- ./panel-collapse -->
            </div><!-- .panel -->

          </div> <!-- /.accordion -->

        </div> <!-- /.col -->

      </div> <!-- /.row -->

    </div> <!-- /.container -->

  </div> <!-- .content -->

</div> <!-- /#wrapper -->

<footer class="footer">
  <div class="container">
    <p class="pull-left">Copyright &copy; 2013 MVP Ready.</p>
  </div>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Core JS -->
<script src="./js/libs/jquery-1.10.2.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="./js/libs/excanvas.compiled.js"></script>
<![endif]-->
<!-- App JS -->
<script src="./js/mvpready-core.js"></script>
<script src="./js/mvpready-admin.js"></script>

</body>
</html>