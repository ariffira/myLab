<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>Plans & Billing &middot; MVP Ready Admin</title>

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

      <h3 class="content-title"><u>Plans & Billing</u></h3>

      <div class="row">

        <div class="col-sm-7 col-md-5">

          <div class="well">
            <h4>You are currently on the <span class="text-primary">Starter</span> plan</h4>
            <p>Your  monthly charge for the <strong>$9.00</strong> is paid on the 11th of each month.</p>

            <br>

            <h5>Card Details</h5>

              <table class="table">
                <tbody>
                  <tr>
                    <th>Card Type</th>
                    <td>Visa</td>
                  </tr>

                  <tr>
                    <th>Card Number</th>
                    <td>************9349 &nbsp;<small>(<a href="javascript:;">change card</a>)</small></td>
                  </tr>

                  <tr>
                    <th>Valid Until</th>
                    <td>07/16</td>
                  </tr>
                </tbody>
              </table>

          </div> <!-- /.well -->

        </div> <!-- /.col -->

        <div class="col-sm-5 col-md-4">

          <div class="portlet portlet-boxed">

            <div class="portlet-body">

              <h4 class="content-title"><u>Account Usage</u></h4>

              <div class="progress-stat">

                <div class="progress-stat-label">
                HDD Space
                </div>

                <div class="progress-stat-value">
                1.7/10 GB
                </div>

                <div class="progress progress-sm">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100" style="width: 17%">
                  <span class="sr-only">17 HDD Space Used</span>
                  </div>
                </div> <!-- /.progress -->

              </div> <!-- /.progress-stat -->

              <div class="progress-stat">

                <div class="progress-stat-label">
                Users
                </div>

                <div class="progress-stat-value">
                5/10
                </div>

                <div class="progress progress-sm">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                  <span class="sr-only">50% Users Used</span>
                  </div>
                </div> <!-- /.progress -->

              </div> <!-- /.progress-stat -->

              <div class="progress-stat">

                <div class="progress-stat-label">
                Projects
                </div>

                <div class="progress-stat-value">
                9/10
                </div>

                <div class="progress progress-sm">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                  <span class="sr-only">90% Projects Used</span>
                  </div>
                </div> <!-- /.progress -->

              </div> <!-- /.progress-stat -->

            </div> <!-- /.portlet-body -->

          </div> <!-- /.portlet -->

        </div> <!-- /.col -->

      </div> <!-- /.row -->

      <br>


      <h3 class="content-title"><u>Available Plans</u></h3>

      <br>

      <div class="row">

        <div class="col-sm-12 col-md-10 col-md-offset-1">

          <div class="row">

            <div class="col-sm-4">

              <div class="pricing-plan">

                <div class="pricing-plan-ribbon-current ui-tooltip" title="Current Plan!">
                  <i class="fa fa-check"></i>
                </div>

                <div class="pricing-header">
                  <h3 class="pricing-plan-title">Starter</h3>				    		
                  <p class="pricing-plan-label">For Individuals</p>   
                </div>

                <div class="pricing-plan-price">
                  <span class="pricing-plan-amount">$9</span> / month
                </div>

                <ul class="pricing-plan-details">	    			
                  <li><strong>10 GB</strong> Disk Space</li>
                  <li><strong>5</strong> Sub Domains</li>	   
                  <li><strong>10</strong> MySQL Databases</li>	
                  <li><strong>1</strong> User</li>	    	 	    				
                </ul>

                <a href="javascript:;" class="btn btn-primary disabled">Current Plan</a>

              </div> <!-- /.pricing-plan -->

            </div> <!-- /.col -->


            <div class="col-sm-4">

              <div class="pricing-plan">

                <div class="pricing-header">				    		
                  <h3 class="pricing-plan-title">Basic</h3>					    		
                  <p class="pricing-plan-label">For blogs &amp; small business</p>  				    		
                </div>

                <div class="pricing-plan-price">
                  <span class="pricing-plan-amount">$24</span> / month
                </div>

                <ul class="pricing-plan-details">	    			
                  <li><strong>20 GB</strong> Disk Space</li>
                  <li><strong>10</strong> Sub Domains</li>	   
                  <li><strong>50</strong> MySQL Databases</li>	
                  <li><strong>Unlimited</strong> Users</li>	  	 	    				
                </ul>

                <a href="javascript:;" class="btn btn-primary">Upgrade</a>

              </div> <!-- /.pricing-plan -->

            </div> <!-- /.col -->


            <div class="col-sm-4">
              <div class="pricing-plan">

                <div class="pricing-plan-ribbon-secondary ui-tooltip" title="Best Value!">
                  <i class="fa fa-star"></i>
                </div>

                <div class="pricing-header">
                  <h3 class="pricing-plan-title">Pro</h3>				    		
                  <p class="pricing-plan-label">For consultants</p>   
                </div>

                <div class="pricing-plan-price">
                  <span class="pricing-plan-amount">$49</span> / month
                </div>

                <ul class="pricing-plan-details">	    			
                  <li><span class="pricing-plan-help" title="" data-content="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus." data-original-title="What's a user?"><strong>40 GB</strong> Disk Space</span></li>
                  <li><span class="pricing-plan-help" title="" data-content="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus." data-original-title="What's a project?"><strong>20</strong> Sub Domains</span></li>	   
                  <li><span class="pricing-plan-help" title="" data-content="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus." data-original-title="What's storage for?"><strong>80</strong> MySQL Databases</span></li>	
                  <li><span class="pricing-plan-help" title="" data-content="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus." data-original-title="What's storage for?"><strong>Unlimited</strong> Users</span></li>   	  	 	    				
                </ul>

                <a href="javascript:;" class="btn btn-primary">Upgrade</a>

              </div> <!-- /.pricing-plan -->

            </div> <!-- /.col -->

          </div> <!-- /.row -->

        </div> <!-- /.col -->

      </div> <!-- /.row -->


      <h4 class="text-center">
      Need More?
      <span>We offer larger plans for companies with even more contacts.</span>
      <a href="javascript:;">Learn More <i class="fa fa-external-link"></i></a>
      </h4>


      <br>
      <br>
      <br>


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

<!-- Plugin JS -->
<script src="./js/demos/pricing.js"></script>


</body>
</html>