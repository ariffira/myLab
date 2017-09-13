      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>ED</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>CYOMED</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar fixed navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php if (!isset($hide_topnav) || !$hide_topnav) : ?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if ($this->mod->user_value('avatar') && @getimagesize($this->mod->user_value('avatar'))) : ?>
                    <img data-src="<?php echo $this->mod->user_value('avatar'); ?>" src="<?php echo $this->mod->user_value('avatar'); ?>" class="user-image" alt="Profilbild" />                    
                  <?php else : ?>
                    <img data-src="//placehold.it/768x1024" src="//placehold.it/128x128" class="user-image" alt="Profilbild" />
                  <?php endif ; ?>
                     <span class="hidden-xs">
                  
                  <?php echo $this->mod->user_value('name'); ?>
                  <?php echo $this->mod->user_value('surname'); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php if ($this->mod->user_value('avatar') && @getimagesize($this->mod->user_value('avatar'))) : ?>
                      <img data-src="<?php echo $this->mod->user_value('avatar'); ?>" src="<?php echo $this->mod->user_value('avatar'); ?>" class="img-circle" alt="Profilbild" />                      
                    <?php else : ?>
                      <img data-src="//placehold.it/768x1024" src="//placehold.it/128x128" class="img-circle" alt="Profilbild" />
                    <?php endif ; ?>
                     <p>
                      <?php echo $this->mod->user_value('name'); ?>
                      <?php echo $this->mod->user_value('surname'); ?>
                      <small><b>ROLE:</b>
                        <?php 
                          $role = $this->mod->user_value('role');
                          if ($role == 9) {
                            echo "Super admin"; 
                          }
                          elseif ($role == 2) {
                            echo "Chat Care Service"; 
                          }
                        ?>
                      </small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#auth/profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    
                    <div class="pull-right">
                      <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <?php endif; ?>
        </nav>
      </header> 