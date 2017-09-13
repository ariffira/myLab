<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>Super Admin Responsive Template</title>
            
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/form.css" rel="stylesheet">
        <link href="css/calendar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/icons.css" rel="stylesheet">
        <link href="css/generics.css" rel="stylesheet"> 
    </head>
    <body id="skin-blur-violate">
        <header id="header" class="media">
            <a href="" id="menu-toggle"></a> 
            <a class="logo pull-left" href="index.html">SUPER ADMIN 1.0</a>
            
            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                        <a data-drawer="messages" class="drawer-toggle" href="">
                            <i class="sa-top-message"></i>
                            <i class="n-count animated">5</i>
                            <span>Messages</span>
                        </a>
                    </div>
                    <div class="pull-left tm-icon">
                        <a data-drawer="notifications" class="drawer-toggle" href="">
                            <i class="sa-top-updates"></i>
                            <i class="n-count animated">9</i>
                            <span>Updates</span>
                        </a>
                    </div>

                    
                    
                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>

                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            
            <!-- Sidebar -->
            <aside id="sidebar">
                
                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="" data-toggle="dropdown">
                            <img class="profile-pic animated" src="img/profile-pic.jpg" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            <li><a href="">My Profile</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="">Messages</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="">Settings</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="">Sign Out</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                        </ul>
                        <h4 class="m-0">Malinda Hollaway</h4>
                        @malinda-h
                    </div>
                    
                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                    
                    <!-- Feeds -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                           News Feeds
                        </h2>
                        
                        <div class="s-widget-body">
                            <div id="news-feed"></div>
                        </div>
                    </div>
                    
                    <!-- Projects -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                            Projects on going
                        </h2>
                        
                        <div class="s-widget-body">
                            <div class="side-border">
                                <small>Joomla Website</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="progress-bar tooltips progress-bar-danger" style="width: 60%;" data-original-title="60%">
                                          <span class="sr-only">60% Complete</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Opencart E-Commerce Website</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-info" style="width: 43%;" data-original-title="43%">
                                          <span class="sr-only">43% Complete</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Social Media API</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-warning" style="width: 81%;" data-original-title="81%">
                                          <span class="sr-only">81% Complete</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>VB.Net Software Package</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 10%;" data-original-title="10%">
                                          <span class="sr-only">10% Complete</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Chrome Extension</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 95%;" data-original-title="95%">
                                          <span class="sr-only">95% Complete</span>
                                     </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Side Menu -->
                <ul class="list-unstyled side-menu">
                    <li>
                        <a class="sa-side-home" href="index.html">
                            <span class="menu-item">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-typography" href="typography.html">
                            <span class="menu-item">Typography</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-widget" href="content-widgets.html">
                            <span class="menu-item">Widgets</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-table" href="tables.html">
                            <span class="menu-item">Tables</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="sa-side-form" href="">
                            <span class="menu-item">Form</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="form-elements.html">Basic Form Elements</a></li>
                            <li><a href="form-components.html">Form Components</a></li>
                            <li><a href="form-examples.html">Form Examples</a></li>
                            <li><a href="form-validation.html">Form Validation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown active">
                        <a class="sa-side-ui" href="">
                            <span class="menu-item">User Interface</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="labels.html">Labels</a></li>
                            <li><a href="images-icons.html">Images &amp; Icons</a></li>
                            <li><a href="alerts.html">Alerts</a></li>
                            <li><a href="media.html">Media</a></li>
                            <li><a class="active" href="components.html">Components</a></li>
                            <li><a href="other-components.html">Others</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="sa-side-photos" href="">
                            <span class="menu-item">PHOTO GALLERY</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="photo-gallery.html">Google Images like</a></li>
                            <li><a href="photo-gallery-alt.html">Photo Gallery - 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sa-side-chart" href="charts.html">
                            <span class="menu-item">Charts</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-folder" href="file-manager.html">
                            <span class="menu-item">File Manager</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-calendar" href="calendar.html">
                            <span class="menu-item">Calendar</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="sa-side-page" href="">
                            <span class="menu-item">Pages</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="list-view.html">List View</a></li>
                            <li><a href="profile-page.html">Profile Page</a></li>
                            <li><a href="messages.html">Messages</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="404.html">404 Error</a></li>
                        </ul>
                    </li>
                </ul>
                

            </aside>
        
            <!-- Content -->
            <section id="content" class="container">
            
                <!-- Messages Drawer -->
                <div id="messages" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Send a New Message</a>
                            <span class="drawer-close">&times;</span>
                            
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - 2 Hours ago</small><br>
                                    <a class="t-overflow" href="">Mauris consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">David Villa - 5 Hours ago</small><br>
                                    <a class="t-overflow" href="">Suspendisse in purus ut nibh placerat Cras pulvinar euismod nunc quis gravida. Suspendisse pharetra</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Harris worgon - On 15/12/2013</small><br>
                                    <a class="t-overflow" href="">Maecenas venenatis enim condimentum ultrices fringilla. Nulla eget libero rhoncus, bibendum diam eleifend, vulputate mi. Fusce non nibh pulvinar, ornare turpis id</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Mitch Bradberry - On 14/12/2013</small><br>
                                    <a class="t-overflow" href="">Phasellus interdum felis enim, eu bibendum ipsum tristique vitae. Phasellus feugiat massa orci, sed viverra felis aliquet quis. Curabitur vel blandit odio. Vestibulum sagittis quis sem sit amet tristique.</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - On 15/12/2013</small><br>
                                    <a class="t-overflow" href="">Ipsum wintoo consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">David Villa - On 16/12/2013</small><br>
                                    <a class="t-overflow" href="">Suspendisse in purus ut nibh placerat Cras pulvinar euismod nunc quis gravida. Suspendisse pharetra</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Harris worgon - On 17/12/2013</small><br>
                                    <a class="t-overflow" href="">Maecenas venenatis enim condimentum ultrices fringilla. Nulla eget libero rhoncus, bibendum diam eleifend, vulputate mi. Fusce non nibh pulvinar, ornare turpis id</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Mitch Bradberry - On 18/12/2013</small><br>
                                    <a class="t-overflow" href="">Phasellus interdum felis enim, eu bibendum ipsum tristique vitae. Phasellus feugiat massa orci, sed viverra felis aliquet quis. Curabitur vel blandit odio. Vestibulum sagittis quis sem sit amet tristique.</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/5.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Wendy Mitchell - On 19/12/2013</small><br>
                                    <a class="t-overflow" href="">Integer a eros dapibus, vehicula quam accumsan, tincidunt purus</a>
                                </div>
                            </div>
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VIEW ALL</small></a>
                        </div>
                    </div>
                </div>
                
                <!-- Notification Drawer -->
                <div id="notifications" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Notification Settings</a>
                            <span class="drawer-close">&times;</span>
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - 2 Hours ago</small><br>
                                    <a class="t-overflow" href="">Mauris consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">David Villa - 5 Hours ago</small><br>
                                    <a class="t-overflow" href="">Suspendisse in purus ut nibh placerat Cras pulvinar euismod nunc quis gravida. Suspendisse pharetra</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Harris worgon - On 15/12/2013</small><br>
                                    <a class="t-overflow" href="">Maecenas venenatis enim condimentum ultrices fringilla. Nulla eget libero rhoncus, bibendum diam eleifend, vulputate mi. Fusce non nibh pulvinar, ornare turpis id</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Mitch Bradberry - On 14/12/2013</small><br>
                                    <a class="t-overflow" href="">Phasellus interdum felis enim, eu bibendum ipsum tristique vitae. Phasellus feugiat massa orci, sed viverra felis aliquet quis. Curabitur vel blandit odio. Vestibulum sagittis quis sem sit amet tristique.</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Nadin Jackson - On 15/12/2013</small><br>
                                    <a class="t-overflow" href="">Ipsum wintoo consectetur urna nec tempor adipiscing. Proin sit amet nisi ligula. Sed eu adipiscing lectus</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">David Villa - On 16/12/2013</small><br>
                                    <a class="t-overflow" href="">Suspendisse in purus ut nibh placerat Cras pulvinar euismod nunc quis gravida. Suspendisse pharetra</a>
                                </div>
                            </div>
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VIEW ALL</small></a>
                        </div>
                    </div>
                </div>
                
                <!-- Breadcrumb -->
                <ol class="breadcrumb hidden-xs">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol>
                
                <h4 class="page-title">COMPONENTS</h4>
                
                <!-- Dorpdown -->
                <div class="block-area" id="dropdown">
                    <h3 class="block-title">Dropdown</h3>
                    
                    <p>Default Dropdown with alternative (after Driggering)</p>
                    <div class="dropdown open">
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown open" style="margin-left: 180px;">
                        <ul class="dropdown-menu dropdown-menu-alt" role="menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <p style="margin-top: 150px;">With Animation(Only on modern browsers)</p>
                    <!-- Bounce In -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">Bounce In</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated bounceIn">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Fade In -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">Fade In</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated fadeIn">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Flip In X -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Flip In X</button>
                        <ul class="dropdown-menu animated flipInX">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Flip In Y -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">Flip In Y</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Roll In -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">Roll In</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated rollIn">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- slide In Down -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">slide In Down</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated slideInDown">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Speed In -->
                    <div class="btn-group m-b-5">
                        <button type="button" class="btn btn-sm">Speed In</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu animated lightSpeedIn">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <p class="m-t-15">Alignments:</p>
                    <div class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle underline" data-toggle="dropdown">Dropdown Left</a>
                        <ul class="dropdown-menu pull-left">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle underline" data-toggle="dropdown">Dropdown Right</a>
                        <ul class="dropdown-menu pull-left">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <p class="m-t-20">Dropups - Trigger dropdown menus above elements</p>
                    <div class="dropdown dropup">
                        <a href="#" class="dropdown-toggle underline" data-toggle="dropdown">This is a Dropup</a>
                        <ul class="dropdown-menu pull-left">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <p class="m-t-20">Button Dropdowns</p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm">Action</button>
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>

                    <p class="m-t-20">Button dropdowns work with buttons of all sizes</p>
                    
                    <!-- Large button group -->
                    <div class="btn-group">
                        <button class="btn btn-lg dropdown-toggle" type="button" data-toggle="dropdown">
                            Large button <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Default button group -->
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            Default button <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Small button group -->
                    <div class="btn-group">
                        <button class="btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                            Small button <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <!-- Extra small button group -->
                    <div class="btn-group">
                        <button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                            Extra small button <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <br/><br/>
                </div>
                
                <hr class="whiter" />
                
                <!-- Modal -->
                <div class="block-area" id="modal">
                    <h3 class="block-title">Modal</h3>
                    
                    <p>Example Modal (After triggering)</p>
                    
                    <div class="modal" style="position: relative; display: block; z-index: 0;"> <!-- Style for just preview -->
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm">Save changes</button>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="m-t-20">Modal - Live Demo (Click to open)</p>
                    <div class="m-b-20">
                            <a data-toggle="modal" href="#modalDefault" class="btn btn-sm">Modal - Default</a>
                            <a data-toggle="modal" href="#modalNarrower" class="btn btn-sm">Modal - Narrower</a>
                            <a data-toggle="modal" href="#modalWider" class="btn btn-sm">Modal - Wider</a>
                    </div>
                    
                    <!-- Modal Default -->	
                    <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper. Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla. Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm">Save changes</button>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Narrower -->	
                    <div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper. Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla. Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm">Save changes</button>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Wider -->	
                    <div class="modal fade" id="modalWider" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper. Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla. Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm">Save changes</button>
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <hr class="whiter" />
                
                <!-- Tab -->
                <div class="block-area" id="tabs">
                    <h3 class="block-title">Tabs</h3>
                    
                    <p>Basic Example</p>
                    <div class="tab-container tile">
                        <ul class="nav tab nav-tabs">
                            <li class="active"><a href="#home">Home</a></li>
                            <li><a href="#profile">Profile</a></li>
                            <li><a href="#messages23">Messages</a></li>
                            <li><a href="#settings">Settings</a></li>
                        </ul>
                          
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                            <div class="tab-pane" id="profile">
                                <p>Quisque hendrerit lorem lectus, id vestibulum nibh facilisis lobortis. Vestibulum interdum massa rhoncus lorem vehicula faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin convallis venenatis pulvinar. In hac habitasse platea dictumst. Aliquam quis ipsum commodo, venenatis sapien at, ullamcorper neque. Integer vitae lacus volutpat, molestie elit eget, sollicitudin erat. Aliquam ac nisl ligula. Etiam vulputate sodales elit, et interdum mauris semper eu. Nam rhoncus nibh quis quam ullamcorper volutpat. Nam sed ultricies libero, a commodo lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed tincidunt turpis. Vivamus blandit, libero sit amet laoreet convallis, enim nisl tristique dolor, et fringilla arcu ipsum eu quam.</p>
                            </div>
                            <div class="tab-pane" id="messages23">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="settings">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                        </div>
                    </div>
                    
                    <p>Tabs on bottom</p>
                    <div class="tab-container tile">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-b">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                            <div class="tab-pane" id="profile-b">
                                <p>Quisque hendrerit lorem lectus, id vestibulum nibh facilisis lobortis. Vestibulum interdum massa rhoncus lorem vehicula faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin convallis venenatis pulvinar. In hac habitasse platea dictumst. Aliquam quis ipsum commodo, venenatis sapien at, ullamcorper neque. Integer vitae lacus volutpat, molestie elit eget, sollicitudin erat. Aliquam ac nisl ligula. Etiam vulputate sodales elit, et interdum mauris semper eu. Nam rhoncus nibh quis quam ullamcorper volutpat. Nam sed ultricies libero, a commodo lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed tincidunt turpis. Vivamus blandit, libero sit amet laoreet convallis, enim nisl tristique dolor, et fringilla arcu ipsum eu quam.</p>
                            </div>
                            <div class="tab-pane" id="messages-b">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="settings-b">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                        </div>
                        <ul class="nav tab nav-tabs">
                            <li class="active"><a href="#home-b">Home</a></li>
                            <li><a href="#profile-b">Profile</a></li>
                            <li><a href="#messages-b">Messages</a></li>
                            <li><a href="#settings-b">Settings</a></li>
                        </ul>
                    </div>
                    
                    <p>Right Aligned</p>
                    <div class="tab-container tile">
                        <ul class="nav tab nav-tabs tab-right">
                            <li class="active"><a href="#home2">Home</a></li>
                            <li><a href="#profile2">Profile</a></li>
                            <li><a href="#messages2">Messages</a></li>
                            <li><a href="#settings2">Settings</a></li>
                        </ul>
                          
                        <div class="tab-content">
                            <div class="tab-pane active" id="home2">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                            <div class="tab-pane" id="profile2">
                                <p>Quisque hendrerit lorem lectus, id vestibulum nibh facilisis lobortis. Vestibulum interdum massa rhoncus lorem vehicula faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin convallis venenatis pulvinar. In hac habitasse platea dictumst. Aliquam quis ipsum commodo, venenatis sapien at, ullamcorper neque. Integer vitae lacus volutpat, molestie elit eget, sollicitudin erat. Aliquam ac nisl ligula. Etiam vulputate sodales elit, et interdum mauris semper eu. Nam rhoncus nibh quis quam ullamcorper volutpat. Nam sed ultricies libero, a commodo lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed tincidunt turpis. Vivamus blandit, libero sit amet laoreet convallis, enim nisl tristique dolor, et fringilla arcu ipsum eu quam.</p>
                            </div>
                            <div class="tab-pane" id="messages2">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="settings2">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                        </div>
                    </div>
                    
                    <p>Vertical Tabs - Left</p>
                    <div class="tab-container tile media">
                        <ul class="tab pull-left tab-vertical nav nav-tabs">
                            <li class="active"><a href="#home3">Home</a></li>
                            <li><a href="#profile3">Profile</a></li>
                            <li><a href="#messages3">Messages</a></li>
                            <li><a href="#settings3">Settings</a></li>
                        </ul>
                          
                        <div class="tab-content media-body">
                            <div class="tab-pane active" id="home3">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                            <div class="tab-pane" id="profile3">
                                <p>Quisque hendrerit lorem lectus, id vestibulum nibh facilisis lobortis. Vestibulum interdum massa rhoncus lorem vehicula faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin convallis venenatis pulvinar. In hac habitasse platea dictumst. Aliquam quis ipsum commodo, venenatis sapien at, ullamcorper neque. Integer vitae lacus volutpat, molestie elit eget, sollicitudin erat. Aliquam ac nisl ligula. Etiam vulputate sodales elit, et interdum mauris semper eu. Nam rhoncus nibh quis quam ullamcorper volutpat. Nam sed ultricies libero, a commodo lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed tincidunt turpis. Vivamus blandit, libero sit amet laoreet convallis, enim nisl tristique dolor, et fringilla arcu ipsum eu quam.</p>
                            </div>
                            <div class="tab-pane" id="messages3">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="settings3">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <p>Vertical Tabs - Right</p>
                    <div class="tab-container tile media">
                        <ul class="tab pull-right tab-vertical nav nav-tabs">
                            <li class="active"><a href="#home4">Home</a></li>
                            <li><a href="#profile4">Profile</a></li>
                            <li><a href="#messages4">Messages</a></li>
                            <li><a href="#settings4">Settings</a></li>
                        </ul>
                          
                        <div class="tab-content media-body">
                            <div class="tab-pane active" id="home4">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="profile4">
                                <p>Quisque hendrerit lorem lectus, id vestibulum nibh facilisis lobortis. Vestibulum interdum massa rhoncus lorem vehicula faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin convallis venenatis pulvinar. In hac habitasse platea dictumst. Aliquam quis ipsum commodo, venenatis sapien at, ullamcorper neque. Integer vitae lacus volutpat, molestie elit eget, sollicitudin erat. Aliquam ac nisl ligula. Etiam vulputate sodales elit, et interdum mauris semper eu. Nam rhoncus nibh quis quam ullamcorper volutpat. Nam sed ultricies libero, a commodo lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed tincidunt turpis. Vivamus blandit, libero sit amet laoreet convallis, enim nisl tristique dolor, et fringilla arcu ipsum eu quam.</p>
                            </div>
                            <div class="tab-pane" id="messages4">
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                                <p>Duis eleifend sapien nec nisl semper, vitae accumsan arcu feugiat. Suspendisse potenti. Aenean vestibulum massa ut congue accumsan. Donec sapien nulla, sollicitudin eu odio fringilla, vulputate ornare quam. Morbi congue in sem non congue. Vivamus diam velit, lacinia eu lorem ac, pellentesque lobortis arcu. Morbi congue dolor sed arcu imperdiet posuere.</p>
                            </div>
                            <div class="tab-pane" id="settings4">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel enim non dui fermentum sollicitudin. In id metus dolor. Suspendisse dapibus, metus vitae posuere gravida, odio orci dictum purus, vitae lobortis elit lacus id sem. Vestibulum ut rhoncus dui. Sed congue vestibulum fermentum. Nulla imperdiet quam et ipsum lobortis laoreet. Phasellus in lectus ligula. Suspendisse potenti. Aliquam massa nulla, congue ut quam sed, scelerisque laoreet massa. Ut ultrices aliquet suscipit.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
              
                
                <hr class="whiter" />
                
                <!-- Collapse -->
                <div class="block-area" id="collapse">
                    <h3 class="block-title">Collapse</h3>
                    <p>Example Collapse</p>
                    <div class="accordion tile">
                        <div class="panel-group block" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Collapsible Group Item #1
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Collapsible Group Item #2
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Collapsible Group Item #3
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="whiter" />
                
                <!-- Tooltips -->
                <div class="block-area" id="tooltips">
                    <h3 class="block-title">Tooltips</h3>
                    
                    <p>Examples - Hover over the links below to see tooltips</p>
                    <p>Tight pants next level keffiyeh <a href="#" class="tooltips underline" data-toggle="tooltip" title="Default tooltip">you probably</a> haven't heard of them. Photo booth beard raw denim letterpress vegan messenger bag stumptown. Farm-to-table seitan, mcsweeney's fixie sustainable quinoa 8-bit american apparel <a href="#" class="tooltips underline" data-toggle="tooltip" title="Another tooltip">have a</a> terry richardson vinyl chambray. Beard stumptown, cardigans banh mi lomo thundercats. Tofu biodiesel williamsburg marfa, four loko mcsweeney's cleanse vegan chambray. A really ironic artisan <a href="#" class="tooltips underline" data-toggle="tooltip" title="Another one here too">whatever keytar</a>, scenester farm-to-table banksy Austin <a href="#" class="tooltips underline" data-toggle="tooltip" title="The last tip!">twitter handle</a> freegan cred raw denim single-origin coffee viral.</p>
                    
                    <br/>
                    <p>All four directions</p>
                    <div class="m-b-15">
                        <button class="btn btn-sm tooltips" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Left</button>
                        <button class="btn btn-sm tooltips" data-toggle="tooltip" data-placement="top" title="Tooltip on left">Top</button>
                        <button class="btn btn-sm tooltips" data-toggle="tooltip" data-placement="right" title="Tooltip on left">Right</button>
                        <button class="btn btn-sm tooltips" data-toggle="tooltip" data-placement="bottom" title="Tooltip on left">Bottom</button>
                    </div>
                </div>
                
                 <hr class="whiter" />
                
                <!-- Popover -->
                <div class="block-area" id="popover">
                    <h3 class="block-title">Popover</h3>
                    
                    <p>Popover on Click</p>
                    <div>
                        <!-- Top -->
                        <button class="btn btn-sm pover btn-small" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Top
                        </button>
                        
                        <!-- Right -->
                        <button class="btn btn-sm pover btn-small" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Right
                        </button>
                        
                        <!-- Bottom -->
                        <button class="btn btn-sm pover btn-small" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Bottom
                        </button>
                        
                        <!-- Left -->
                        <button class="btn btn-sm pover btn-small" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Left
                        </button>
                    </div>
                    
                    <br />
                    <p>Popover on Hover</p>
                    <div class="m-b-15">
                        <!-- Top -->
                        <button class="btn btn-sm pover btn-small" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Top
                        </button>
                        
                        <!-- Right --> 
                        <button class="btn btn-sm pover btn-small" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Right
                        </button>
                        
                        <!-- Bottom -->
                        <button class="btn btn-sm pover btn-small" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Bottom
                        </button>
                        
                        <!-- Left -->
                        <button class="btn btn-sm pover btn-small" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="Popover Title">
                            Left
                        </button>
                    </div>
                </div>    
                
                <hr class="whiter" />
                
                <!-- Progress Bars -->
                <div class="block-area" id="progress-bars">
                    <h3 class="block-title">Progress Bars</h3>
                    
                    <div class="tile p-20">
                        <p>Default Progress bars</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
    
                        <p class="m-t-15">Contextual alternatives</p>
                        <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                        </div>
                        <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>
                        <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                        </div>
                        <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                        </div>
                        
                        <p class="m-t-15">Striped Progress bars with alternative style</p>
                        <div class="progress progress-striped progress-alt">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                        </div>
                        <div class="progress progress-striped progress-alt">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>
                        <div class="progress progress-striped progress-alt">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                        </div>
                        <div class="progress progress-striped progress-alt">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                        </div>
                        
                        <p class="m-t-15">Animated Progress bar (Not in old IEs)</p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                <span class="sr-only">45% Complete</span>
                            </div>
                        </div>
                        
                        <p class="m-t-15">Stacked Progress bar</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: 35%">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                            <div class="progress-bar progress-bar-warning" style="width: 20%">
                                <span class="sr-only">20% Complete (warning)</span>
                            </div>
                            <div class="progress-bar progress-bar-danger" style="width: 10%">
                                <span class="sr-only">10% Complete (danger)</span>
                            </div>
                        </div>
                        
                        <p class="m-t-15">Progressbar small</p>
                        <div class="progress progress-small">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                        </div>
                        <div class="progress progress-small">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>
                        <div class="progress progress-small">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                        </div>
                        <div class="progress progress-small">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                        </div>
                        
                        <p class="m-t-15">Vertical Progress bars</p>
                        
                        <!-- Vertical Bottom -->
                        <div class="progress progress-vertical bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%"></div>
                        </div>
                        <div class="progress progress-vertical bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="height: 20%"></div>
                        </div>
                        <div class="progress progress-vertical bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%"></div>
                        </div>
                        <div class="progress progress-vertical bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%"></div>
                        </div>
                        
                        <div class="progress progress-vertical bottom m-r-20" style="height: 150px;">
                            <div class="progress-bar progress-bar-success" style="height: 35%">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                            <div class="progress-bar progress-bar-warning" style="height: 20%">
                                <span class="sr-only">20% Complete (warning)</span>
                            </div>
                            <div class="progress-bar progress-bar-danger" style="height: 10%">
                                <span class="sr-only">10% Complete (danger)</span>
                            </div>
                        </div>
                        
                        <!-- Vertical Top -->
                        <div class="progress progress-striped progress-vertical" style="height: 150px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical" style="height: 150px;">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="height: 20%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical" style="height: 150px;">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical" style="height: 150px;">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%"></div>
                        </div>
                        
                        <div class="progress progress-vertical m-r-20" style="height: 150px;">
                            <div class="progress-bar progress-bar-success" style="height: 35%">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                            <div class="progress-bar progress-bar-warning" style="height: 20%">
                                <span class="sr-only">20% Complete (warning)</span>
                            </div>
                            <div class="progress-bar progress-bar-danger" style="height: 10%">
                                <span class="sr-only">10% Complete (danger)</span>
                            </div>
                        </div>
                        
                        <!-- Small Vertical -->
                        <div class="progress progress-striped progress-vertical small bottom" style="height: 150px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical small bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="height: 20%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical small bottom" style="height: 150px;">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical small bottom m-r-20" style="height: 150px;">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%"></div>
                        </div>
                        
                        <!-- Alternative Styled Vertical -->
                        <div class="progress progress-striped progress-vertical progress-alt" style="height: 150px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical progress-alt" style="height: 150px;">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="height: 20%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical progress-alt" style="height: 150px;">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%"></div>
                        </div>
                        <div class="progress progress-striped progress-vertical progress-alt" style="height: 150px;">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%"></div>
                        </div>
                    </div>

                    <br/><br/><br/>
                </div>
            </section>
        </section>
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        
        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->
        
        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        
        
        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        
    </body>
</html>

