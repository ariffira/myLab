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
                    
                    <div class="s-widgets">
                        <div class="m-5">
                            <a href="#compose-message" data-toggle="modal" class="btn btn-sm btn-block">Compose Message</a>  
                        </div>
                        
                        <div class="list-group m-t-10 list-group-flat">
                            <a href="#" class="list-group-item active">Inbox<span class="badge badge-trp">23</span></a>
                            <a href="#" class="list-group-item">Important<span class="badge badge-trp">12</span></a>
                            <a href="#" class="list-group-item">Starred<span class="badge badge-trp">02</span></a>
                            <a href="#" class="list-group-item">Drafts<span class="badge badge-trp">05</span></a>
                            <a href="#" class="list-group-item">Sent Mail</a>
                            <a href="#" class="list-group-item">Spam<span class="badge badge-trp">85</span></a>
                        </div>
                                        
                        <div class="list-group list-group-flat m-t-15">
                            <a href="#" class="list-group-item"><span class="message-tag progress-bar-warning"></span>Work</a>
                            <a href="#" class="list-group-item"><span class="message-tag progress-bar-danger"></span>Personal</a>
                            <a href="#" class="list-group-item"><span class="message-tag progress-bar-info"></span>Promotions</a>
                            <a href="#" class="list-group-item"><span class="message-tag progress-bar-success"></span>Clients</a>
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
                    <li class="dropdown">
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
                    <li class="dropdown active">
                        <a class="sa-side-page" href="">
                            <span class="menu-item">Pages</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="list-view.html">List View</a></li>
                            <li><a href="profile-page.html">Profile Page</a></li>
                            <li><a class="active" href="messages.html">Messages</a></li>
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
                
                <h4 class="page-title b-0">Messages</h4>
                
                <div class="message-list list-container">
                    <header class="listview-header media">
                        <input type="checkbox" class="pull-left list-parent-check" value="">
                            
                        <ul class="list-inline pull-right m-t-5 m-b-0">
                            <li class="pagin-value hidden-xs">35-70</li>
                            <li>
                                <a href="" title="Previous" class="tooltips">
                                    <i class="sa-list-back"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" title="Next" class="tooltips">
                                    <i class="sa-list-forwad"></i>
                                </a>
                            </li>
                        </ul>
                        
                        <ul class="list-inline list-mass-actions pull-left">
                            <li>
                                <a data-toggle="modal" href="#compose-message" title="Add" class="tooltips">
                                    <i class="sa-list-add"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" title="Refresh" class="tooltips">
                                    <i class="sa-list-refresh"></i>
                                </a>
                            </li>
                            <li class="show-on" style="display: none;">
                                <a href="" title="Move" class="tooltips">
                                    <i class="sa-list-move"></i>
                                </a>
                            </li>
                            <li class="show-on" style="display: none;">
                                <a href="" title="Delete" class="tooltips">
                                    <i class="sa-list-delete"></i>
                                </a>
                            </li>
                        </ul>

                        <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">
                        
                        <div class="clearfix"></div>
                    </header>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow f-bold">Christian Bale</span>
                            </div>
                            <div class="pull-right list-date">9.46 am</div> 
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Per an error perpetua, fierent fastidii recteque ad pro. Mei id brute intellegam</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow f-bold">Angel Norton Junior</span>
                            </div>
                            <div class="pull-right list-date">7.56 am</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum sem ligula, vulputate et</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Stirling Sheard</span>
                            </div>
                            <div class="pull-right list-date">Feb 1</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Nullam adipiscing tempus ornare. Sed varius nisl ac feugiat feugiat. Nam rhoncus nibh a eros ullamcorper pulvinar</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Reginald Horace</span>
                            </div>
                            <div class="pull-right list-date">Jan 31</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Sed varius nisl ac feugiat feugiat. Nam rhoncus nibh a eros ullamcorper pulvinar</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Jeremy Robbins</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Mark Henry</span>
                            </div>
                            <div class="pull-right list-date">Jan 28</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Li Europan lingues es membres del sam familie. Lor separat existentie es</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">David Mirage Paul</span>
                            </div>
                            <div class="pull-right list-date">Jan 27</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Suscipit lorem. Cras felis nunc, semper ac tristique ac, tincidunt ac odio. Nulla semper scelerisque </span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Thomus Alva Edition</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Alexandar Ven Dixxin</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Nunc porta metus quis quam bibendum, ac egestas mauris feugiat.</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Jeremy Robbins</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Quisque placerat turpis elementum, lobortis neque ut, consequat lorem.</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Vin Diesel</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Morbi varius ipsum faucibus, sodales dolor eu, tempus massa.</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Hendrick Wotkinson</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Donec dapibus porta nunc a lacinia. Praesent non odio sed elit posuere venenatis eget ut massa. Nullam convallis commodo </span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">James Anderon</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Dnunc, faucibus tempus quam ultrices vitae. Nullam eget elit posuere mi aliquam vehicula. Suspendisse potenti.</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Steve Saphires</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Quisque tristique pellentesque lacus ac aliquet. Maecenas condimentum aliquam ligula tincidunt commodo</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Mendes Carolina</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Sed pretium nulla et lacus cursus porttitor. Morbi pellentesque mauris vitae magna facilisis facilisis</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="media">
                        <input type="checkbox" class="pull-left list-check">

                        <a class="media-body" href="message-detail.html">
                            <div class="pull-left list-title">
                                <span class="t-overflow">Paul Ven Deck</span>
                            </div>
                            <div class="pull-right list-date">Jan 30</div>
                            <div class="media-body hidden-xs">
                                <span class="t-overflow">Ut tristique suscipit lorem. Cras felis nunc, semper ac tristique ac, tincidunt ac odio. Nulla semper scelerisque </span>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Compose -->
                <div class="modal fade" id="compose-message">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">NEW MESSAGE</h4>
                            </div>
                            <div class="modal-header p-0">
                                <input type="text" class="form-control input-sm input-transparent" placeholder="To...">
                            </div>
                            <div class="modal-header p-0">
                                <input type="text" class="form-control input-sm input-transparent" placeholder="Subject...">
                            </div>
                            <div class="p-relative">
                                <div class="message-options">
                                    <img src="img/icon/tile-actions.png" alt="">
                                </div>
                                <textarea class="message-editor" placeholder="Message..."></textarea>
                            </div>
                            <div class="modal-footer m-0">
                                <button class="btn">Send</button>
                                <button class="btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
        </section>
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        
        <!--  Form Related -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        
        <!-- Text Editor -->
        <script src="js/editor.min.js"></script> <!-- WYSIWYG Editor -->
        
        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->
        
        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        
        
        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                //Editor
                $('.message-editor').summernote({
                    toolbar: [
                      //['style', ['style']], // no style button
                      ['style', ['bold', 'italic', 'underline', 'clear']],
                      ['fontsize', ['fontsize']],
                      ['color', ['color']],
                      ['para', ['ul', 'ol', 'paragraph']],
                      //['height', ['height']],
                      ['insert', ['picture', 'link']], // no insert buttons
                      //['table', ['table']], // no table button
                      //['help', ['help']] //no help button
                    ],
                    height: 200,
                    resizable: false
                });
                
                $('.message-options').click(function(){
                    $(this).closest('.modal').find('.note-toolbar').toggle(); 
                });  
            });
        </script>
    </body>
</html>

