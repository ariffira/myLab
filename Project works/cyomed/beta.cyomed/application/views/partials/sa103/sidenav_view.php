			<!-- Sidebar -->
			<aside id="sidebar">
				
				<!-- Sidbar Widgets -->
				<div class="side-widgets overflow">
					<!-- Profile Menu -->
					<div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
						<a href="javascript:void(0);" data-toggle="dropdown">
							<!-- <img class="profile-pic animated" src="<?php echo base_url('assets/sa103/img/profile-pic.jpg'); ?>" alt=""> -->
							<img class="profile-pic animated" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/120x120'; ?>" />
						</a>
						<ul class="dropdown-menu profile-menu">
							<li><a class="ajax-nav-links" href="<?php echo site_url('akte/profile'); ?>">Profil</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
							<li><a class="ajax-nav-links" href="javascript:void(0);">Nachrichten</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
							<li><a class="ajax-nav-links" href="<?php echo site_url('akte/access'); ?>">Rechte</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
							<li><a class="              " href="<?php echo site_url('portal/both/logout'); ?>">Auslogen</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
						</ul>
						<h4 class="m-0"><?php echo $this->m->user_value('name'); ?> <?php echo $this->m->user_value('surname'); ?></h4>
						<?php echo $this->m->user_value('regid'); ?>
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
					<?php $sidenav = $this->config->item('sidenav', 'ia24ui'); ?>
					<?php if ( ! empty($sidenav) && is_array($sidenav) && count($sidenav) > 0 ) : ?>
						<?php foreach ($sidenav as $item_key => $item) : ?>
							<li class="<?php echo !empty($item['active']) ? 'active' : '' ?> <?php echo !empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? 'dropdown' : ''; ?>">
								<a href="<?php echo !empty($item['url']) ? (!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? smart_site_url($item['url']) : smart_site_url($item['url'])) : '' ?>" class="<?php echo !empty($item['class']) ? $item['class'] : '' ?>">
									<span class="menu-item">
										<?php echo !empty($item['icon']) ? ('<span class="'.$item['icon'].'"></span>') : '' ?>
										<?php echo !empty($item['title']) ? $item['title'] : '' ?>
									</span>
								</a>
								<?php if (!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0) : ?>
									<ul class="list-unstyled menu-item">
										<?php foreach ($item['sub'] as $sub_key => $sub) : ?>
											<li class="<?php echo !empty($sub['active']) ? 'active' : '' ?>">
												<a href="<?php echo !empty($sub['url']) ? (!empty($sub['sub']) && is_array($sub['sub']) && count($sub['sub']) > 0 ? 'javascript:void(0);' : smart_site_url($sub['url'])) : '' ?>" class="<?php echo !empty($sub['class']) ? $sub['class'] : '' ?>">
													<?php echo !empty($sub['icon']) ? ('<span class="'.$sub['icon'].'"></span>') : '' ?>
													<?php echo !empty($sub['title']) ? $sub['title'] : '' ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>

			</aside>