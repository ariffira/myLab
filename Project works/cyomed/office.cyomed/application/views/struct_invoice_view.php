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

    <!-- ========= -->
    <!-- CONTAINER -->
    <!-- ========= -->

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

    </div><!--/.container-->

    <?php $this->load->view('partials/scripts_view'); ?>

  </body>

</html>