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
                            <li><a class="active" href="buttons.html">Buttons</a></li>
                            <li><a href="labels.html">Labels</a></li>
                            <li><a href="images-icons.html">Images &amp; Icons</a></li>
                            <li><a href="alerts.html">Alerts</a></li>
                            <li><a href="media.html">Media</a></li>
                            <li><a href="components.html">Components</a></li>
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
                            <span class="menu-item">CHARTS</span>
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
                
                <h4 class="page-title">BUTTONS</h4>
                
                <!-- Buttons -->
                <div class="block-area" id="buttons">
                    <h3 class="block-title">Buttons</h3>
                    <div class="clearfix"></div>
                    <p>All four sizes</p>
                    
                    <button class="btn btn-lg m-r-5">Large</button>
                    <button class="btn m-r-5">Default</button>
                    <button class="btn btn-sm m-r-5">Small</button>
                    <button class="btn btn-xs">Extra Small</button>
                </div>
                
                <hr class="whiter m-t-20" />
                
                <!-- Alternative -->
                <div class="block-area" id="alternative-buttons">
                    <h3 class="block-title">Alternative Button Style</h3>
                    <p>All four sizes</p>
                    
                    <button class="btn btn-lg btn-alt m-r-5">Large</button>
                    <button class="btn btn-alt m-r-5">Default</button>
                    <button class="btn btn-sm btn-alt m-r-5">Small</button>
                    <button class="btn btn-xs btn-alt m-r-5">Extra Small</button>
                </div>
                
                <hr class="whiter m-t-20" />
                
                <!-- Block Level -->
                <div class="block-area" id="block-level">
                    <h3 class="block-title">Block Level</h3>
                    <p>Create block level buttons those that span the full width of a parent</p>
                    <button class="btn btn-block m-b-10">Block Level</button>
                    <button class="btn btn-block btn-alt">Block Level</button>
                </div>
                
                <hr class="whiter m-t-20" />
                
                <!-- Disabled State -->
                <div class="block-area" id="disable-state">
                    <h3 class="block-title">Disabled State</h3>
                    <p>Make buttons look unclickable by fading them back 50%.</p>
                    <button class="btn btn-primary" disabled="disabled">Disabled</button>
                    <button class="btn" disabled="disabled">Disabled</button>
                </div>
                
                <hr class="whiter m-t-20" />
                
                <!-- Button Tags -->
                <div class="block-area" id="button-tags">
                    <h3 class="block-title">Button Tags</h3>
                    <p>Use the button classes on a, button, input, span Elements</p>
                    <a href="#" class="btn">Link</a>
                    <button class="btn">Button</button>
                    <input type="submit" value="Submit" class="btn">
                    <span class="btn">Span</span>
                </div>
                
                <hr class="whiter m-t-20" />
                
                <!-- Button Groups -->
                <div class="block-area" id="button-groups">
                    <h3 class="block-title">Button Groups</h3>
                    <p>Basic example</p>
                    <div class="btn-group m-b-10">
                        <button type="button" class="btn-sm btn">Left</button>
                        <button type="button" class="btn-sm btn">Middle</button>
                        <button type="button" class="btn-sm btn">Right</button>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt">Left</button>
                        <button type="button" class="btn btn-sm btn-alt">Middle</button>
                        <button type="button" class="btn btn-sm btn-alt">Right</button>
                    </div>
                    
                    <p class="m-t-20">Button toolbar</p>
                    
                    <div class="btn-toolbar m-b-10">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm">1</button>
                            <button type="button" class="btn btn-sm">2</button>
                            <button type="button" class="btn btn-sm">3</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm">4</button>
                            <button type="button" class="btn btn-sm">5</button>
                            <button type="button" class="btn btn-sm">6</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm">7</button>
                            <button type="button" class="btn btn-sm">8</button>
                            <button type="button" class="btn btn-sm">9</button>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt">1</button>
                            <button type="button" class="btn btn-sm btn-alt">2</button>
                            <button type="button" class="btn btn-sm btn-alt">3</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt">4</button>
                            <button type="button" class="btn btn-sm btn-alt">5</button>
                            <button type="button" class="btn btn-sm btn-alt">6</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt">7</button>
                            <button type="button" class="btn btn-sm btn-alt">8</button>
                            <button type="button" class="btn btn-sm btn-alt">9</button>
                        </div>
                    </div>
                    
                    <p class="m-t-20">Nesting</p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm">1</button>
                        <button type="button" class="btn btn-sm">2</button>
                  
                        <div class="btn-group m-b-10">
                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                Dropdown
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dropdown link</a></li>
                                <li><a href="#">Dropdown link</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt">1</button>
                        <button type="button" class="btn btn-sm btn-alt">2</button>
                  
                        <div class="btn-group m-b-10">
                            <button type="button" class="btn btn-sm btn-alt dropdown-toggle" data-toggle="dropdown">
                                Dropdown
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dropdown link</a></li>
                                <li><a href="#">Dropdown link</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <p class="m-t-10">Vertical variation</p>
                    <div class="btn-group-vertical m-r-10">
                        <button type="button" class="btn btn-sm">1</button>
                        <button type="button" class="btn btn-sm">2</button>
                  
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                Dropdown
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dropdown link</a></li>
                                <li><a href="#">Dropdown link</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-sm">3</button>
                    </div>
                    
                    <div class="btn-group-vertical">
                        <button type="button" class="btn btn-xs btn-alt">1</button>
                        <button type="button" class="btn btn-xs btn-alt">2</button>
                  
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-alt dropdown-toggle" data-toggle="dropdown">
                                Dropdown
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dropdown link</a></li>
                                <li><a href="#">Dropdown link</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-xs btn-alt">3</button>
                    </div>

                    <p class="m-t-20">Justified link variation</p>
                    
                    <div class="btn-group btn-group-justified m-b-10">
                        <a href="#" class="btn btn-sm">Left</a>
                        <a href="#" class="btn btn-sm">Middle</a>
                        <a href="#" class="btn btn-sm">Right</a>
                    </div>
                    
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-sm btn-alt">Left</a>
                        <a href="#" class="btn btn-sm btn-alt">Middle</a>
                        <a href="#" class="btn btn-sm btn-alt">Right</a>
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

