<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <title>Tabs & Accordions &middot; MVP Ready Admin</title>

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

			<h2>Tabs & Accordions</h2>

			<br><br>

			<div class="row">

				<div class="col-md-12">

				  <h4 class="page-header">Tab Nav</h4>
											
					<ul id="myTab1" class="nav nav-tabs">
						<li class="active">
							<a href="#home" data-toggle="tab">Home</a>
						</li>
						<li class="">
							<a href="#profile" data-toggle="tab">Profile</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b>
							</a>

							<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
								<li class=""><a href="#dropdown1" tabindex="-1" data-toggle="tab">@fat</a></li>
								<li><a href="#dropdown2" tabindex="-1" data-toggle="tab">@mdo</a></li>
							</ul>
						</li>
					</ul>

					<div id="myTab1Content" class="tab-content">
						<div class="tab-pane fade active in" id="home">
							<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="profile">
							<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="dropdown1">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="dropdown2">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>
					</div>
    
    

    

						    <br>
						    <br>
						    <br>




				    <h4 class="page-header">Pill Tabs</h4>

				    
					<ul id="myTab2" class="nav nav-pills">
						<li class="active">
							<a href="#home-2" data-toggle="tab">Home</a>
						</li>
						<li>
							<a href="#profile-2" data-toggle="tab">Profile</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown">
								Dropdown <b class="caret"></b>
							</a>

							<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
								<li><a href="#dropdown3" tabindex="-1" data-toggle="tab">@fat</a></li>
								<li><a href="#dropdown4" tabindex="-1" data-toggle="tab">@mdo</a></li>
							</ul>
						</li>
					</ul>

					<div id="myTab2Content" class="tab-content">
						<div class="tab-pane fade in active" id="home-2">
							<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="profile-2">
							<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="dropdown3">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>

						<div class="tab-pane fade" id="dropdown4">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>

							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						</div>
					</div>



    

				    <br>
				    <br>
				    <br>







					    <h4 class="page-header">Stacked Tabs</h4>


					    <div class="row">

					    	<div class="col-md-3 col-sm-5">
					    
							    <ul id="myTab" class="nav nav-pills nav-stacked">
							        <li class="active"><a href="#home-3" data-toggle="tab"><i class="fa fa-home"></i> &nbsp;&nbsp;Home</a></li>
							        <li class=""><a href="#profile-3" data-toggle="tab"><i class="fa fa-user"></i> &nbsp;&nbsp;Profile</a></li>
							        <li class="dropdown">
							          <a href="javascript:;" id="myTabDrop3" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-chevron-sign-down"></i> &nbsp;&nbsp;Dropdown <b class="caret"></b></a>
							          <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
							            <li class=""><a href="#dropdown5" tabindex="-1" data-toggle="tab">@fat</a></li>
							            <li><a href="#dropdown6" tabindex="-1" data-toggle="tab">@mdo</a></li>
							          </ul>
							        </li>
							      </ul>

							</div> <!-- /.col -->

							<div class="col-md-9 col-sm-7">

								<div id="myTabContent" class="tab-content stacked-content">
									<div class="tab-pane fade active in" id="home-3">
										<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>

										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
									</div>

									<div class="tab-pane fade" id="profile-3">
										<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>

										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
									</div>

									<div class="tab-pane fade" id="dropdown5">
										<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>

										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
									</div>

									<div class="tab-pane fade" id="dropdown6">
										<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>

										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
									</div>
								</div>

							</div> <!-- /.col -->

						</div> <!-- /.row -->



					    

					    <br>
					    <br>
					    <br>






						<h4 class="page-header">Accordion Panel</h4>


						<div class="panel-group accordion" id="accordion">

							<div class="panel panel-default open">
								<div class="panel-page-header">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapseOne">
										Collapsible Group Item #1
										</a>
									</h4>
								</div>

								<div id="collapseOne" class="panel-collapse collapse in">
									<div class="panel-body">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
									</div>
								</div>
							</div> <!-- /.panel-default -->

							<div class="panel panel-default">
								<div class="panel-page-header">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapseTwo">
										Collapsible Group Item #2
										</a>
									</h4>
								</div>

								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
									</div>
								</div>
							</div> <!-- /.panel-default -->

							<div class="panel panel-default">
								<div class="panel-page-header">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapseThree">
										Collapsible Group Item #3
										</a>
									</h4>
								</div>

								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
									</div>
								</div>
							</div> <!-- /.panel-default -->

						</div> <!-- /.accordion -->
						    

				</div> <!-- /.col-md -->


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