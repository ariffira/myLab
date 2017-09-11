<div class="mainnav" style="display:none;"  >
    <div class="container">
         <a class="mainnav-toggle" data-toggle="collapse" data-target=".mainnav-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars"></i>
        </a>
<?php /* <div class="navbar-header hidden-sm visible-md visible-lg">
<a href="<?php echo site_url('akte');?>" class="navbar-brand navbar-brand-img">
<img src="<?php echo base_url('assets/img/logo/cyomedlogo3.png'); ?>" alt="Cyomed" style="height:43px;">
</a>
</div> <!-- /.navbar-header --> */ ?>
 <nav class="collapse mainnav-collapse collapsed" role="navigation">
     
            <!-- Side Menu -->
            <ul class="mainnav-menu">
                <?php $sidenav = $this->config->item(Ui::$bs_tname . '::sidenav', 'ia24ui'); ?>

                <?php if (!empty($sidenav) && is_array($sidenav) && count($sidenav) > 0) : ?>
                    <?php foreach ($sidenav as $item_key => $item) : ?>
                        <li class="<?php echo!empty($item['active']) ? 'active' : '' ?> <?php echo!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? 'dropdown' : ''; ?>">
                            <a href="<?php echo!empty($item['url']) ? (!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? smart_site_url($item['url']) : smart_site_url($item['url'])) : '' ?>" class="<?php echo!empty($item['class']) ? $item['class'] : '' ?> <?php echo!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? 'dropdown-toggle' : ( empty($item['not_ajax']) ? 'ajax-nav-links' : ''); ?>" <?php echo!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? 'data-toggle="dropdown" data-hover="dropdown"' : ''; ?> >
                                <span class="menu-item">
                                    <?php echo!empty($item['icon']) ? ('<span class="' . $item['icon'] . '"></span>') : '' ?>
                                    <?php echo!empty($item['title']) ? $item['title'] : '' ?>
                                    <?php echo!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0 ? '<i class="mainnav-caret"></i>' : ''; ?>
                                </span>
                            </a>
                            <?php if (!empty($item['sub']) && is_array($item['sub']) && count($item['sub']) > 0) : ?>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($item['sub'] as $sub_key => $sub) : ?>
                                        <li class="<?php echo!empty($sub['active']) ? 'active' : '' ?> <?php echo!empty($sub['sub']) && is_array($sub['sub']) && count($sub['sub']) > 0 ? 'dropdown-submenu' : ''; ?>">
                                            <a href="<?php echo!empty($sub['url']) ? (!empty($sub['sub']) && is_array($sub['sub']) && count($sub['sub']) > 0 ? 'javascript:void(0);' : smart_site_url($sub['url'])) : '' ?>" class="<?php echo!empty($sub['class']) ? $sub['class'] : '' ?> <?php echo!empty($sub['sub']) && is_array($sub['sub']) && count($sub['sub']) > 0 ? '' : ( empty($sub['not_ajax']) ? 'ajax-nav-links' : ''); ?>">
                                                <?php echo!empty($sub['icon']) ? ('<span class="' . $sub['icon'] . '"></span>') : '' ?>
                                                <?php echo!empty($sub['title']) ? $sub['title'] : '' ?>
                                            </a>


                                            <?php if (!empty($sub['sub']) && is_array($sub['sub']) && count($sub['sub']) > 0) : ?>
                                                <ul class="dropdown-menu" role="menu">
                                                    <?php foreach ($sub['sub'] as $secs_key => $secs) : ?>
                                                        <li class="<?php echo!empty($secs['active']) ? 'active' : '' ?> <?php echo!empty($secs['sub']) && is_array($secs['sub']) && count($secs['sub']) > 0 ? 'dropdown-submenu' : ''; ?>">
                                                            <a href="<?php echo!empty($secs['url']) ? (!empty($secs['sub']) && is_array($secs['sub']) && count($secs['sub']) > 0 ? 'javascript:void(0);' : smart_site_url($secs['url'])) : '' ?>" class="<?php echo!empty($secs['class']) ? $secs['class'] : '' ?> <?php echo!empty($secs['sub']) && is_array($secs['sub']) && count($secs['sub']) > 0 ? '' : ( empty($secs['not_ajax']) ? 'ajax-nav-links' : ''); ?>">
                                                                <?php echo!empty($secs['icon']) ? ('<span class="' . $secs['icon'] . '"></span>') : '' ?>
                                                                <?php echo!empty($secs['title']) ? $secs['title'] : '' ?>
                                                            </a>                                    
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                      </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
</nav>
                                       
       
    </div> 
</div> 