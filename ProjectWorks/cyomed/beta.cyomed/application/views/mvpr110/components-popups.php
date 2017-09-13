<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>Popups & Alerts &middot; MVP Ready Admin</title>

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

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="./js/plugins/magnific/magnific-popup.css">

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


          <li class="dropdown active">

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


          <li class="dropdown ">

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

        <h2 class="">Popups & Alerts</h2>

        <br><br>



        <section class="demo-section">

          <h4 class="content-title"><u>Bootstrap Modal</u></h4>

          <p>
            <a data-toggle="modal" href="#basicModal" class="btn btn-default demo-element">Default Modal</a>
            &nbsp;&nbsp;
            <a data-toggle="modal" href="#styledModal" class="btn btn-secondary demo-element">Styled Modal</a>
            &nbsp;&nbsp;
            <a data-toggle="modal" href="#bigModal" class="btn btn-primary demo-element">Large Modal</a>
          </p>

        </section> <!-- /.demo-section -->




        <section class="demo-section">

          <div class="row">
        
            <div class="col-md-5">
              
              <h4 class="heading">Single Image Popup</h4>

              <a class="ui-lightbox" href="./img/photos/rust-lg.jpg" title="Caption. Can be aligned it to any side and contain any HTML.">
                <img src="./img/photos/rust-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
              </a>
              &nbsp;
              <a class="ui-lightbox" href="./img/photos/blur-lg.jpg" title="This image fits only horizontally.">
                <img src="./img/photos/blur-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
              </a>
              &nbsp;
              <a class=" ui-lightbox" href="./img/photos/lens-lg.jpg">
                <img src="./img/photos/lens-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
              </a>

            </div>
            
            <div class="col-md-5">
              
              <h4 class="heading">Gallery Image Popup</h4>

              <div class="ui-lightbox-gallery">
                <a class="" href="./img/photos/rust-lg.jpg" title="Caption. Can be aligned it to any side and contain any HTML.">
                  <img src="./img/photos/rust-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
                </a>
                &nbsp;
                <a class="" href="./img/photos/blur-lg.jpg" title="This image fits only horizontally.">
                  <img src="./img/photos/blur-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
                </a>
                &nbsp;
                <a class="" href="./img/photos/lens-lg.jpg">
                  <img src="./img/photos/lens-sm.jpg" class="thumbnail" style="display: inline-block" width="100" alt="Gallery Image">
                </a>

              </div> <!-- /.ui-lightbox-gallery -->
              
            </div>
            
            <div class="col-md-2">
              
              <h4 class="heading">Video Popup</h4>

              <a class="ui-lightbox-video" href="http://www.youtube.com/watch?v=0O2aH4XLbto">Open YouTube video</a><br>
              <a class="ui-lightbox-video" href="https://vimeo.com/45830194">Open Vimeo video</a><br>
              <a class="ui-lightbox-video" href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom">Open Google Map</a>
              
            </div>

          </div>
          
        </section> <!-- /.demo-section -->


        <br>



        <section class="demo-section">

          <div class="row">

            <div class="col-sm-6">

              <h4 class="content-title"><u>Simple Labels</u></h4>

              <p>A label, with optional background colors. Use the labelclass to create a label</p>

              <div style="font-size: 16px;">
              <span class="label label-default demo-element">Default</span>
              <span class="label label-primary demo-element">Primary</span>
              <span class="label label-secondary demo-element">Secondary</span>
              <span class="label label-tertiary demo-element">Tertiary</span>
              <span class="label label-success demo-element">Success</span>
              <span class="label label-info demo-element">Info</span>
              <span class="label label-warning demo-element">Warning</span>
              <span class="label label-danger demo-element">Danger</span>
              </div>

              <br><br>

            </div> <!-- /.col -->

            <div class="col-sm-6">
              <h4 class="content-title"><u>Badge Variation</u></h4>

              <p>A Badge, with optional background colors. Use the badgeclass to create a Badge</p>

              <span class="badge badge-default demo-element demo-element">4</span>
              <span class="badge badge-primary demo-element">13</span>
              <span class="badge badge-secondary demo-element">13</span>
              <span class="badge badge-tertiary demo-element">13</span>
              <span class="badge badge-success demo-element">167</span>
              <span class="badge badge-info demo-element">5</span>
              <span class="badge badge-warning demo-element">11</span>
              <span class="badge badge-danger demo-element">8</span>

            </div> <!-- /.col -->

          </div> <!-- /.row -->

        </section> <!-- /.demo-section -->





        <section class="demo-section">

          <div class="row">

            <div class="col-sm-6">

              <h4 class="content-title"><u>Dropdown Buttons</u></h4>

              <div class="btn-group demo-element">
                <button type="button" class="btn btn-tertiary dropdown-toggle" data-toggle="dropdown">
                Regular Dropdown <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:;">Action</a></li>
                  <li><a href="javascript:;">Another action</a></li>
                  <li><a href="javascript:;">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:;">Separated link</a></li>
                </ul>
              </div> <!-- /.btn-gruop -->

              <div class="btn-group demo-element">
                <button type="button" class="btn btn-tertiary">Split Dropdown</button>

                <button type="button" class="btn btn-tertiary dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:;">Action</a></li>
                  <li><a href="javascript:;">Another action</a></li>
                  <li><a href="javascript:;">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:;">Separated link</a></li>
                </ul>
              </div> <!-- /.btn-gruop -->

              <div class="btn-group dropup demo-element">
                <button type="button" class="btn btn-tertiary">Dropup</button>

                <button type="button" class="btn btn-tertiary dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                </button>

                <ul class="dropdown-menu">
                  <li><a href="javascript:;">Action</a></li>
                  <li><a href="javascript:;">Another action</a></li>
                  <li><a href="javascript:;">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:;">Separated link</a></li>
                </ul>
              </div> <!-- /.btn-gruop -->

              <br><br>

            </div> <!-- /.col -->


            <div class="col-sm-6">

              <h4 class="content-title"><u>Dropdown Menu</u></h4>

              <ul class="dropdown-menu demo-dropdown-menu" role="menu">
                <li><a tabindex="-1" href="#"><i class="fa fa-bookmark"></i> &nbsp;Action</a></li>
                <li><a tabindex="-1" href="#"><i class="fa fa-cloud"></i> &nbsp;Another action</a></li>
                <li><a tabindex="-1" href="#"><i class="fa fa-legal"></i> &nbsp;Something else here</a></li>

                <li class="divider"></li>

                <li class="dropdown-submenu">
                <a tabindex="-1" href="#">
                <i class="fa fa-asterisk"></i> 
                &nbsp;&nbsp;Sub Menu
                </a>

                  <ul class="dropdown-menu">
                    <li>
                      <a href="javascript:;">Sub Item #1</a>
                    </li>
                    <li>
                      <a href="javascript:;">Sub Item #2</a>
                    </li>
                    <li>
                      <a href="javascript:;">Sub Item #3</a>
                    </li>
                  </ul>
                </li>
              </ul>

            </div> <!-- /.col -->

          </div> <!-- /.row -->

        </section> <!-- /.demo-section -->




        <section class="demo-section">

          <h4 class="content-title"><u>Tool Tips</u></h4>

          <div class="row">

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-tooltip" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
              Tooltip on right
              </button>
            </div> <!-- /.col -->

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-tooltip" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>
            </div> <!-- /.col -->

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-tooltip" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>
            </div> <!-- /.col -->

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-tooltip" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>
            </div> <!-- /.col -->

          </div> <!-- /.row -->

        </section> <!-- /.demo-section -->





        <section class="demo-section">

          <h4 class="content-title"><u>Pop Overs</u></h4>

          <div class="row">

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-popover" data-toggle="tooltip" data-placement="right" data-trigger="hover" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam." title="Tooltip on right">
              Popover on right
              </button>
            </div> <!-- /.col -->

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-popover" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam." title="Tooltip on top">
              Popover on top
              </button>
            </div> <!-- /.col -->

            <div class="col-sm-3">
              <button type="button" class="btn btn-default demo-element ui-popover" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam." title="Tooltip on bottom">
              Popover on bottom
              </button>
            </div> <!-- /.col -->

            <div class="col-sm-3">		        
              <button type="button" class="btn btn-default demo-element ui-popover" data-toggle="tooltip" data-placement="left" data-trigger="hover" data-content="Sed posuere consectetur est at lobortis. Aenean eu leo quam." title="Tooltip on left">
              Popover on left
              </button>
            </div> <!-- /.col -->

          </div> <!-- /.row -->

        </section> <!-- /.demo-section -->




        <section class="demo-section">

          <h4 class="content-title"><u>Simple Alert</u></h4>

          <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong>Well done!</strong> You successfully read this important alert message.
          </div> <!-- /.alert -->

          <div class="alert alert-info">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
          </div> <!-- /.alert -->

          <div class="alert alert-warning">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong>Warning!</strong> Best check yo self, you're not looking too good.
          </div> <!-- /.alert -->

          <div class="alert alert-danger">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
          </div> <!-- /.alert -->

        </section> <!-- /.demo-section -->




        <section class="demo-section">

          <div class="row">

            <div class="col-sm-4">

              <div class="portlet">

                <h4 class="content-title">
                <u>Progress Bars</u>
                </h4>

                <div class="progress">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                  <span class="sr-only">40% Complete (primary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress">
                  <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                  <span class="sr-only">60% Complete (secondary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress">
                  <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                  <span class="sr-only">80% Complete (tertiary)</span>
                  </div>
                </div> <!-- /.progress -->

              </div> <!-- /.portlet -->

            </div> <!-- /.col -->


            <div class="col-sm-4">

              <div class="portlet">

                <h4 class="content-title">
                <u>Progress Striped</u> <small>(Active)</small>
                </h4>

                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                  <span class="sr-only">40% Complete (primary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress progress-striped active progress-striped active">
                  <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                  <span class="sr-only">60% Complete (secondary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                  <span class="sr-only">80% Complete (tertiary)</span>
                  </div>
                </div> <!-- /.progress -->

              </div> <!-- /.portlet -->

            </div> <!-- /.col -->


            <div class="col-sm-4">

              <div class="portlet">

                <h4 class="content-title">
                <u>Progress Sizes</u>
                </h4>

                <div class="progress progress-sm">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                  <span class="sr-only">40% Complete (primary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress progress-md">
                  <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                  <span class="sr-only">60% Complete (secondary)</span>
                  </div>
                </div> <!-- /.progress -->

                <div class="progress progress-lg">
                  <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                  <span class="sr-only">80% Complete (tertiary)</span>
                  </div>
                </div> <!-- /.progress -->
              
              </div> <!-- /.col -->

            </div> <!-- /.portlet -->

          </div> <!-- /.row -->

        </section><!-- /.demo-section -->


      </div> <!-- /.container -->





      <div id="basicModal" class="modal fade">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">Basic Modal</h3>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>

              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.&hellip;</p>
            </div> <!-- /.modal-body -->

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> <!-- /.modal-footer -->

          </div> <!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

      </div><!-- /.modal -->



      <div id="styledModal" class="modal modal-styled fade">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">Styled Modal</h3>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>

              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.&hellip;</p>
            </div> <!-- /.modal-body -->

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> <!-- /.modal-footer -->

          </div> <!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

      </div><!-- /.modal -->



      <div id="bigModal" class="modal modal-styled fade" tabindex="-1" role="dialog">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" >Large Modal</h3>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
              <h4>Text in a modal</h4>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>

              <h4>Popover in a modal</h4>
              <p>This <a href="javascript:;" role="button" class="btn btn-default ui-popover" title="" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A Title">button</a> should trigger a popover on click.</p>

              <h4>Tooltips in a modal</h4>
              <p><a href="javascript:;" class="ui-tooltip" title="" data-original-title="Tooltip">This link</a> and <a href="javascript:;" class="ui-tooltip" title="" data-original-title="Tooltip">that link</a> should have tooltips on hover.</p>

              <hr>

              <h4>Overflowing text to show scroll behavior</h4>
              <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
              <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
              <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
              <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
              <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
              <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div> <!-- /.modal-body -->

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> <!-- /.modal-footer -->

          </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

      </div> <!-- /.modal -->

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

<!-- Plugin JS -->
<script src="./js/plugins/magnific/jquery.magnific-popup.js"></script>

<!-- App JS -->
<script src="./js/mvpready-core.js"></script>
<script src="./js/mvpready-admin.js"></script>

</body>
</html>