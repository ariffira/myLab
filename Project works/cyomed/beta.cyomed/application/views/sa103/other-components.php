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
                            <li><a href="components.html">Components</a></li>
                            <li><a class="active" href="other-components.html">Others</a></li>
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
                
                <h4 class="page-title">OTHER COMPONENTS</h4>
                                
                <!-- Jumbotron -->
                <div class="block-area" id="jumbotron">
                     <h3 class="block-title">Jumbotron</h3>
                     <div class="jumbotron tile-light">
                          <div class="container">
                               <h1>Hello, world!</h1>
                               <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                               <p><a class="btn btn-alt btn-lg">Learn more</a></p>
                          </div>
                     </div>
                </div>
                
                <hr class="whiter" />
                
                <!-- Page Header -->
                <div class="block-area" id="page-header">
                    <h3 class="block-title">Page Header</h3>
                    
                    <p>Default Page Header</p>
                    
                    <hr class="whiter" />
                    <h2 class="page-title">This is a Page Header</h2>
                    
                    <p class="m-t-20">Page Header with Sub text</p>
                    
                    <hr class="whiter" />
                    <h2 class="page-title">This is a Page Header <small class="s-text">and this is a sub text</small></h2>

                    <p class="m-t-20">Page header with Breadcrumb</p>
                    
                    <hr class="whiter" />
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Typography</a></li>
                        <li class="active">Data</li>
                    </ol>
                    <h2 class="page-title">Another Page Header</h2>
                    <br/><br/>
                </div>
                
                <hr class="whiter" />
                
                <!-- Content Boxes -->
                <div class="block-area" id="content-boxes">
                     <h3 class="block-title">Content Boxes</h3>
                     
                     <div class="row">
                          <div class="col-sm-6 col-md-4">
                               <div class="thumbnail tile">
                                    <img src="img/gallery/1.jpg" alt="">
                                    <div class="p-15">
                                        <h4>Thumbnail label</h4>
                                        <p>Nullam congue mauris at auctor pharetra. Phasellus dictum accumsan justo, sit amet mattis odio semper in. Nulla consectetur quam in dolor faucibus, ac facilisis nunc luctus. Etiam sapien arcu, scelerisque at mollis a, placerat non eros.</p>
                                        <p>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                        </p>
                                    </div>
                               </div>
                          </div>
                          
                          <div class="col-sm-6 col-md-4">
                               <div class="thumbnail tile">
                                    <img src="img/gallery/3.jpg" alt="">
                                    <div class="p-15">
                                        <h4>Thumbnail label</h4>
                                        <p>Nullam congue mauris at auctor pharetra. Phasellus dictum accumsan justo, sit amet mattis odio semper in. Nulla consectetur quam in dolor faucibus, ac facilisis nunc luctus. Etiam sapien arcu, scelerisque at mollis a, placerat non eros.</p>
                                        <p>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                        </p>
                                    </div>
                               </div>
                          </div>
                          
                          <div class="col-sm-6 col-md-4">
                               <div class="thumbnail tile">
                                    <img src="img/gallery/5.jpg" alt="">
                                    <div class="p-15">
                                        <h4>Thumbnail label</h4>
                                        <p>Nullam congue mauris at auctor pharetra. Phasellus dictum accumsan justo, sit amet mattis odio semper in. Nulla consectetur quam in dolor faucibus, ac facilisis nunc luctus. Etiam sapien arcu, scelerisque at mollis a, placerat non eros.</p>
                                        <p>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                            <a href="#" class="btn btn-info btn-sm">Button</a>
                                        </p>
                                    </div>
                               </div>
                          </div>
                     </div>
                </div>
                
                <hr class="whiter m-t-10" />
                
                <!-- Media Object -->
                <div class="block-area" id="media-object">
                     <h3 class="block-title">Media Object</h3>
                     
                     <p>The default media allow to float a media object (images, video, audio) to the left or right of a content block.</p>
                     <br />
                     <div class="media">
                          <a class="pull-left" href="#">
                               <img class="media-object" src="img/profile-pics/1.jpg" alt="">
                          </a>
                          <div class="media-body">
                               <h5 class="media-heading">Media heading</h5>
                               Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus fringilla. Donec lacinia congue felis in faucibus.
                          </div>
                     </div>
                     <div class="media">
                          <a class="pull-left" href="#">
                               <img class="media-object" src="img/profile-pics/2.jpg" alt="">
                          </a>
                          <div class="media-body">
                               <h5 class="media-heading">Media heading</h5>
                               Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                               <div class="media">
                                    <a class="pull-left" href="#">
                                         <img class="media-object" src="img/profile-pics/3.jpg" alt="">
                                    </a>
                                    <div class="media-body">
                                         <h5 class="media-heading">Media heading</h5>
                                         Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                               </div>
                          </div>
                     </div>
                     
                     <br/><br/>
                     <p>With a bit of extra markup, you can use media inside list (useful for comment threads or articles lists).</p>
                     <br />
                     <ul class="media-list">
                          <li class="media">
                               <a class="pull-left" href="#">
                                    <img class="media-object" src="img/profile-pics/1.jpg" alt="">
                               </a> 
                               <div class="media-body">
                                    <h5 class="media-heading">Media heading</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus fringilla. Donec lacinia congue felis in faucibus.

                                    <!-- Nested media object -->
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="img/profile-pics/2.jpg" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="media-heading">Nested media heading</h5>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus fringilla. Donec lacinia congue felis in faucibus.
                                            
                                            <!-- Nested media object -->
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object" src="img/profile-pics/3.jpg" alt="">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Nested media heading</h5>
                                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <!-- Nested media object -->
                                    <div class="media">
                                         <a class="pull-left" href="#">
                                             <img class="media-object" src="img/profile-pics/4.jpg" alt="">
                                         </a>
                                         <div class="media-body">
                                            <h5 class="media-heading">Nested media heading</h5>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus fringilla. Donec lacinia congue felis in faucibus.
                                         </div>
                                    </div>
                               </div>
                          </li>
                          <li class="media">
                               <a class="pull-right" href="#">
                                    <img class="media-object" src="img/profile-pics/5.jpg" alt="">
                               </a>
                               <div class="media-body">
                                    <h5 class="media-heading">Media heading</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus fringilla. Donec lacinia congue felis in faucibus.
                               </div>
                          </li>
                     </ul>
                </div>
                
                <hr class="whiter m-t-10" />
                
                <!-- List Groups -->
                <div class="block-area" id="list-groups">
                    <h3 class="block-title">List Groups</h3>
                    
                    <p>Basic example</p>
                    <ul class="list-group block">
                         <li class="list-group-item">Cras justo odio</li>
                         <li class="list-group-item">Dapibus ac facilisis in</li>
                         <li class="list-group-item">Morbi leo risus</li>
                         <li class="list-group-item">Porta ac consectetur ac</li>
                         <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    
                    <p>With Badges</p>
                    <ul class="list-group block">
                         <li class="list-group-item">Cras justo odio<span class="badge">14</span></li>
                         <li class="list-group-item">Dapibus ac facilisis in<span class="badge">23</span></li>
                         <li class="list-group-item">Morbi leo risus<span class="badge">9</span></li>
                         <li class="list-group-item">Porta ac consectetur ac<span class="badge">10</span></li>
                         <li class="list-group-item">Vestibulum at eros<span class="badge">2</span></li>
                    </ul>
                    
                    <p>With Links</p>
                    <div class="list-group block">
                         <a href="#" class="list-group-item active">Cras justo odio<span class="badge">14</span></a>
                         <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                         <a href="#" class="list-group-item">Morbi leo risus</a>
                         <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                         <a href="#" class="list-group-item">Vestibulum at eros</a>
                    </div>
               </div>
               
               <hr class="whiter" />
               
               <!-- Panel -->
               <div class="block-area" id="Panel">
                    <h3 class="block-title">Panel</h3>
                    
                    <div class="panel panel-default tile">
                         <div class="panel-heading">
                              <h3 class="panel-title">Panel title</h3>
                         </div>
                         <div class="panel-body">
                              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                         </div>
                         <div class="panel-footer">Panel footer</div>
                    </div>
               </div>
               
               <hr class="whiter" />
               
               <!-- Well -->
               <div class="block-area" id="well">
                    <h3 class="block-title">Well</h3>
                    <p>Use the well as a simple effect on an element to give it an inset effect.</p>
                    <div class="well tile">
                         Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
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

