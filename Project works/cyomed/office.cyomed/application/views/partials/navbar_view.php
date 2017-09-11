<?php $has_sidebar = isset($sidebar) && is_array($sidebar) && count($sidebar) > 0 ? TRUE : FALSE; ?>
<?php $active_1 = isset($active_1) && $active_1 ? 'active' : ''; ?>
<?php $active_2 = isset($active_2) && $active_2 ? 'active' : ''; ?>
<?php $active_3 = isset($active_3) && $active_3 ? 'active' : ''; ?>
<?php $active_4 = isset($active_4) && $active_4 ? 'active' : ''; ?>
<?php $active_5 = isset($active_5) && $active_5 ? 'active' : ''; ?>

<!-- ======= -->
<!-- NAV BAR -->
<!-- ======= -->

<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php if ($has_sidebar) : ?>
        <div class="navbar-brand visible-xs">
          <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="icomoon i-list"></i></button>
        </div>
      <?php endif; ?>
      <a class="navbar-brand" href="#" data-toggle="offcanvas">IhrArzt24 | Admin</a>
    </div>
    <?php if (!isset($hide_topnav) || !$hide_topnav) : ?>
      <div class="collapse navbar-collapse">
        <!-- <ul class="nav navbar-nav navbar-left">
          <li class="hidden-sm <?php echo $active_1; ?>"><a href="<?php echo site_url('admin/top1'); ?>">Top 1</a></li>
          <li class="hidden-sm <?php echo $active_2; ?>"><a href="<?php echo site_url('admin/top2'); ?>">Top 2 <span class="badge"><?php echo mt_rand(1,99); ?></span></a></li>
          <li class="visible-sm">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Top 1 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo $active_1; ?>"><a href="<?php echo site_url('admin/top1'); ?>">Top 1</a></li>
              <li class="<?php echo $active_2; ?>"><a href="<?php echo site_url('admin/top2'); ?>">Termine <span class="badge"><?php echo mt_rand(1,99); ?></span></a></li>
            </ul>
          </li>
          <li class="visible-lg <?php echo $active_3; ?>"><a href="<?php echo site_url('admin/top3'); ?>">Top 3</a></li>
          <li class="visible-lg <?php echo $active_4; ?>"><a href="<?php echo site_url('admin/top4'); ?>">Top 4</a></li>
          <li class="visible-lg <?php echo $active_5; ?>"><a href="<?php echo site_url('admin/top5'); ?>">Top 5</a></li>
          <li class="hidden-lg <?php echo $active_3.' '.$active_4.' '.$active_5; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mehr <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo $active_3; ?>"><a href="<?php echo site_url('admin/top3'); ?>">Top 3</a></li>
              <li class="<?php echo $active_4; ?>"><a href="<?php echo site_url('admin/top4'); ?>">Top 4</a></li>
              <li class="<?php echo $active_5; ?>"><a href="<?php echo site_url('admin/top5'); ?>">Top 5</a></li>
            </ul>
          </li>
        </ul> -->
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo site_url('#'); ?>">Home</a></li>
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icomoon i-wrench-3"></span> Top 6 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">Top Cata-1</li>
              <li class=""><a href="<?php echo site_url('admin/top6_1'); ?>">Top 6 - 1</a></li>
              <li class=""><a href="<?php echo site_url('admin/top6_2'); ?>">Top 6 - 2</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Top Cata-2</li>
              <li class=""><a href="<?php echo site_url('admin/top6_3'); ?>">Top 6 - 3</a></li>
              <li class=""><a href="<?php echo site_url('admin/top6_4'); ?>">Top 6 - 4</a></li>
              <li class=""><a href="<?php echo site_url('admin/top6_5'); ?>">Top 6 - 5</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Languages&nbsp;/&nbsp;Sprache(n)</li>
              <li><a href="#">English / English</a></li>
              <li><a href="#">German / Deutsch</a></li>
            </ul>
          </li> -->
          <li><a href="<?php echo site_url('user/logout'); ?>">Abmelden</a></li>
        </ul>
      </div><!-- /.nav-collapse -->
    <?php endif; ?>
  </div><!-- /.container -->
</div><!-- /.navbar -->