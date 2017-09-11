<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>Profile &middot; MVP Ready Admin</title>

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

      <div class="row">

        <div class="col-md-3 col-sm-5">

          <div class="profile-avatar">
            <img src="./img/avatars/avatar-2-lg.jpg" class="profile-avatar-img thumbnail" alt="Profile Image">
          </div> <!-- /.profile-avatar -->

          <div class="list-group">  

            <a href="javascript:;" class="list-group-item">
              <i class="fa fa-asterisk text-primary"></i> &nbsp;&nbsp;Activity Feed

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 

            <a href="javascript:;" class="list-group-item">
              <i class="fa fa-book text-primary"></i> &nbsp;&nbsp;Projects

              <i class="fa fa-chevron-right list-group-chevron"></i>
              <span class="badge">3</span>
            </a> 

            <a href="javascript:;" class="list-group-item">
              <i class="fa fa-envelope text-primary"></i> &nbsp;&nbsp;Messages

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 

            <a href="javascript:;" class="list-group-item">
              <i class="fa fa-group text-primary"></i> &nbsp;&nbsp;Friends

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 

            <a href="javascript:;" class="list-group-item">
              <i class="fa fa-cog text-primary"></i> &nbsp;&nbsp;Settings

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
          </div> <!-- /.list-group -->



        </div> <!-- /.col -->



        <div class="col-md-6 col-sm-7">

          <h3>Nikita Williams</h3>

          <h5 class="text-muted">Visual, UI, UX Designer</h5>

          <hr>

          <p>
            <a href="javascript:;" class="btn btn-primary">Follow Nikita</a>
            &nbsp;&nbsp;
            <a href="javascript:;" class="btn btn-secondary">Send Message</a>
          </p>

          <hr>
          
          <ul class="icons-list">
            <li><i class="icon-li fa fa-envelope"></i> support@jumpstartthemes.com</li>
            <li><i class="icon-li fa fa-globe"></i> jumstartthemes.com</li>
            <li><i class="icon-li fa fa-map-marker"></i> Las Vegas, NV</li>
          </ul>    

          <br>

          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.</p>

          <hr>


          <br><br>

          <h4 class="content-title"><u>Activity Feed</u></h4>

            <div class="share-widget clearfix">

              <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea>

              <div class="share-widget-actions">
                <div class="share-widget-types pull-left">
                  <a href="javascript:;" class="fa fa-picture-o ui-tooltip" title="Post an Image"><i></i></a>
                  <a href="javascript:;" class="fa fa-video-camera ui-tooltip" title="Upload a Video"><i></i></a>
                  <a href="javascript:;" class="fa fa-lightbulb-o ui-tooltip" title="Post an Idea"><i></i></a>
                  <a href="javascript:;" class="fa fa-question-circle ui-tooltip" title="Ask a Question"><i></i></a>
                </div>	

              <div class="pull-right">
                <a class="btn btn-primary btn-sm" tabindex="2">Post</a>
              </div>

              </div> <!-- /.share-widget-actions -->

            </div> <!-- /.share-widget -->

            <br><br>

            <div class="feed-item feed-item-idea">

              <div class="feed-icon">
                <i class="fa fa-lightbulb-o"></i>
              </div> <!-- /.feed-icon -->

              <div class="feed-subject">
                <p><a href="javascript:;">Nikita Williams</a> shared an idea: <a href="javascript:;">Create an Awesome Idea</a></p>
              </div> <!-- /.feed-subject -->

              <div class="feed-content">
                <ul class="icons-list">
                  <li>
                    <i class="icon-li fa fa-quote-left"></i>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                  </li>
                </ul>
              </div> <!-- /.feed-content -->

              <div class="feed-actions">
                <a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a> 
                <a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>

                <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> 2 days ago</a>
              </div> <!-- /.feed-actions -->

            </div> <!-- /.feed-item -->



            <div class="feed-item feed-item-image">

              <div class="feed-icon">
                <i class="fa fa-picture-o"></i>
              </div> <!-- /.feed-icon -->

              <div class="feed-subject">
                <p><a href="javascript:;">Nikita Williams</a> posted the <strong>4 files</strong>: <a href="javascript:;">Annual Reports</a></p>
              </div> <!-- /.feed-subject -->

              <div class="feed-content">
                <div class="thumbnail" style="width: 375px">
                  <img src="./img/mockup.png" style="width: 100%;" alt="Gallery Image">
                </div> <!-- /.thumbnail -->
              </div> <!-- /.feed-content -->

              <div class="feed-actions">
                <a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a> 
                <a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>

                <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> 2 days ago</a>
              </div> <!-- /.feed-actions -->

            </div> <!-- /.feed-item -->



            <div class="feed-item feed-item-file">

              <div class="feed-icon">
                <i class="fa fa-cloud-upload"></i>
              </div> <!-- /.feed-icon -->

              <div class="feed-subject">
                <p><a href="javascript:;">Nikita Williams</a> posted the <strong>4 files</strong>: <a href="javascript:;">Annual Reports</a></p>
              </div> <!-- /.feed-subject -->

              <div class="feed-content">
                <ul class="icons-list">
                  <li>
                    <i class="icon-li fa fa-file-text-o"></i>
                    <a href="javascript:;">Annual Report 2007</a> - annual_report_2007.pdf
                  </li>

                  <li>
                    <i class="icon-li fa fa-file-text-o"></i>
                    <a href="javascript:;">Annual Report 2008</a> - annual_report_2007.pdf
                  </li>

                  <li>
                    <i class="icon-li fa fa-file-text-o"></i>
                    <a href="javascript:;">Annual Report 2009</a> - annual_report_2007.pdf
                  </li>

                  <li>
                    <i class="icon-li fa fa-file-text-o"></i>
                    <a href="javascript:;">Annual Report 2010</a> - annual_report_2007.pdf
                  </li>
                </ul>
              </div> <!-- /.feed-content -->

              <div class="feed-actions">
                <a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a> 
                <a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>

                <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> 2 days ago</a>
              </div> <!-- /.feed-actions -->

            </div> <!-- /.feed-item -->



            <div class="feed-item feed-item-bookmark">

              <div class="feed-icon">
                <i class="fa fa-bookmark"></i>
              </div> <!-- /.feed-icon -->

              <div class="feed-subject">
                <p><a href="javascript:;">Nikita Williams</a> bookmarked a page on Delicious: <a href="javascript:;">Jumpstart Themes</a></p>
              </div> <!-- /.feed-subject -->

              <div class="feed-content">
              </div> <!-- /.feed-content -->

              <div class="feed-actions">
                <a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a> 
                <a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>

                <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> 2 days ago</a>
              </div> <!-- /.feed-actions -->

            </div> <!-- /.feed-item -->



            <div class="feed-item feed-item-question">

              <div class="feed-icon">
                <i class="fa fa-question"></i>
              </div> <!-- /.feed-icon -->

              <div class="feed-subject">
                <p><a href="javascript:;">Nikita Williams</a> posted the question: <a href="javascript:;">Who can I call to get a new parking pass for the Rowan Building?</a></p>
              </div> <!-- /.feed-subject -->

              <div class="feed-content">
                <ul class="icons-list">
                  <li>
                    <i class="icon-li fa fa-quote-left"></i>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.
                  </li>
                </ul>
              </div> <!-- /.feed-content -->

              <div class="feed-actions">
                <a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a> 
                <a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>

                <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> 2 days ago</a>
              </div> <!-- /.feed-actions -->

            </div> <!-- /.feed-item -->

            <br class="visible-xs">            
            <br class="visible-xs">
            
          </div> <!-- /.col -->


          <div class="col-md-3">
            <h5 class="content-title"><u>Social Stats</u></h5>

            <div class="list-group">  

              <a href="javascript:;" class="list-group-item">
                  <h3 class="pull-right"><i class="fa fa-eye text-primary"></i></h3>
                  <h4 class="list-group-item-heading">38,847</h4>
                  <p class="list-group-item-text">Profile Views</p>                  
                </a>

              <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right"><i class="fa fa-facebook-square  text-primary"></i></h3>
                <h4 class="list-group-item-heading">3,482</h4>
                <p class="list-group-item-text">Facebook Likes</p>
              </a>

              <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right"><i class="fa fa-twitter-square  text-primary"></i></h3>
                <h4 class="list-group-item-heading">5,845</h4>
                <p class="list-group-item-text">Twitter Followers</p>
              </a>
            </div> <!-- /.list-group -->

            <br>

            <h5 class="content-title"><u>Project Activity</u></h5>

            <div class="well">


              <ul class="icons-list text-md">

                <li>
                  <i class="icon-li fa fa-location-arrow"></i>

                  <strong>Rod</strong> uploaded 6 files. 
                  <br>
                  <small>about 4 hours ago</small>
                </li>

                <li>
                  <i class="icon-li fa fa-location-arrow"></i>

                  <strong>Rod</strong> followed the research interest: <a href="javascript:;">Open Access Books in Linguistics</a>. 
                  <br>
                  <small>about 23 hours ago</small>
                </li>

                <li>
                  <i class="icon-li fa fa-location-arrow"></i>

                  <strong>Rod</strong> added 51 papers. 
                  <br>
                  <small>2 days ago</small>
                </li>
              </ul>

            </div> <!-- /.well -->

          </div> <!-- /.col -->

        </div> <!-- /.row -->

        <br><br>

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