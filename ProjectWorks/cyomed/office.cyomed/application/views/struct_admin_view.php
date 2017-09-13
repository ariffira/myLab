<?php $has_sidebar = isset($sidebar) && is_array($sidebar) && count($sidebar) > 0 ? TRUE : FALSE; ?>
<?php $active_1 = isset($active_1) && $active_1 ? 'active' : ''; ?>
<?php $active_2 = isset($active_2) && $active_2 ? 'active' : ''; ?>
<?php $active_3 = isset($active_3) && $active_3 ? 'active' : ''; ?>
<?php $active_4 = isset($active_4) && $active_4 ? 'active' : ''; ?>
<?php $active_5 = isset($active_5) && $active_5 ? 'active' : ''; ?>
<!DOCTYPE html>
<html lang="en">

  <?php $this->load->view('partials/header_view'); ?>

  <body class="<?php echo isset($page_class) && $page_class ? $page_class : ''; ?>">

    <?php $this->load->view('partials/navbar_view', array('sidebar' => isset($sidebar) ? $sidebar : NULL, )); ?>

    <!-- ========= -->
    <!-- CONTAINER -->
    <!-- ========= -->

    <?php if (isset($jumbotron) && $jumbotron) : ?>
      <!-- <div class="jumbotron" style="background-image: url(<?php echo base_url('assets/images/frontpage_pics/5.jpg'); ?>);background-position:20% 10%;background-size:cover;padding-top:150px;">
        <div class="container" style="background: #330303;opacity: 0.55;border-radius: 6px;color:white;">
          <h1 class="text-warning">Cyomed Administration Panel</h1>
          <h4><?php echo is_object($jumbotron) && isset($jumbotron->title) ? $jumbotron->title : ucfirst(basename(__FILE__, '.php')); ?></h4>
          <p>
            I will put some simple documentation and intro somewhere in the backend.<br>
          </p>
          <p>
            <button class="btn btn-primary" role="button" data-toggle="offcanvas"><span class="icomoon i-list-4"></span></button>
            <button class="btn btn-danger" role="button" >Mehr »</button>
          </p>
        </div>
      </div> -->
    <?php endif; ?>

    <div class="container">

      <?php $sidebar_row_class = $has_sidebar ? 'row-offcanvas row-offcanvas-left' : ''; ?>
      <?php $sidebar_col_class = $has_sidebar ? 'col-xs-12 col-sm-9' : 'col-sm-12'; ?>

      <div class="row <?php echo $sidebar_row_class; ?>">

        <?php if ($has_sidebar) : ?>
          <div class="col-xs-8 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
              <?php foreach ($sidebar as $row) : ?>
                <a href="<?php echo isset($row['href']) && $row['href'] ? (strpos($row['href'], 'http') !== FALSE ? $row['href'] : site_url($row['href'])) : '#'; ?>" class="list-group-item <?php echo isset($row['active']) && $row['active'] ? 'active' : (strpos(current_url(), $row['href']) !== FALSE ? 'active' : ''); ?> <?php echo isset($row['class']) && $row['class'] ? $row['class'] :''; ?>">
                  <?php echo $row['text']; ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div><!--/span-->
        <?php endif; ?>

        <div class="<?php echo $sidebar_col_class; ?>" style="<?php if ($has_sidebar) : ?> min-height:500px; <?php endif; ?>">

          <?php echo isset($page_content) && $page_content ? $page_content : ''; ?>

        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <!-- <footer class="site-footer" role="contentinfo">
        <?php if (!isset($internal_footer) || !$internal_footer) : ?>
          <div class="row">
            <div class="col-sm-4">
              <h3>Lorem ipsum Incididunt magna aliqua.</h3>
              <p>Lorem ipsum Quis dolore dolor in laborum ut qui commodo Ut consectetur exercitation aliquip proident.</p>
            </div>
            <div class="col-sm-4">
              <h3>Lorem ipsum Incididunt magna aliqua.</h3>
              <dl class="dl-horizontal">
                <dt>Lorem ipsum Ut ex laborum aliquip ad in.</dt>
                <dd>Lorem ipsum Irure deserunt laboris Ut proident ullamco irure reprehenderit consectetur officia Excepteur.</dd>
                <dt>Lorem ipsum Pariatur eu consectetur.</dt>
                <dd>Lorem ipsum In cillum dolore ad ea do anim deserunt in anim incididunt.</dd>
                <dt>Lorem ipsum Fugiat cillum officia ut.</dt>
                <dd>Lorem ipsum Ut fugiat commodo laborum nisi dolore sint ut labore proident ex ad irure proident veniam magna dolor Ut consequat ullamco laborum anim labore minim dolore deserunt esse ut eu.</dd>
              </dl>
            </div>
            <div class="col-sm-4">
              <h3>Lorem ipsum Incididunt magna aliqua.</h3>
              <ul>
                <li><?php echo date('Y-m-d', time() - mt_rand(1,100) * 86400); ?> Lorem ipsum Sit in officia sit velit in dolor commodo qui reprehenderit laboris in.</li>
                <li><?php echo date('Y-m-d', time() - mt_rand(1,100) * 86400); ?> Lorem ipsum Amet tempor dolor nisi et tempor qui nostrud esse sunt minim magna do.</li>
                <li><?php echo date('Y-m-d', time() - mt_rand(1,100) * 86400); ?> Lorem ipsum Id sit labore minim commodo cillum Excepteur enim fugiat consectetur fugiat et.</li>
                <li><?php echo date('Y-m-d', time() - mt_rand(1,100) * 86400); ?> Lorem ipsum Consectetur sed magna eiusmod veniam ad proident ad dolore anim dolore dolor elit veniam dolor do.</li>
                <li><?php echo date('Y-m-d', time() - mt_rand(1,100) * 86400); ?> Lorem ipsum Aliqua dolor eiusmod ex velit veniam exercitation cillum eu sunt eiusmod.</li>
              </ul>
            </div>
          </div>
        <?php endif; ?>
      </footer> -->

    </div><!--/.container-->

    <?php $this->load->view('partials/scripts_view'); ?>

  </body>

</html>