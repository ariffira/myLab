<?php $has_sidebar = isset($sidebar) && is_array($sidebar) && count($sidebar) > 0 ? TRUE : FALSE; ?>
<?php $active_1 = isset($active_1) && $active_1 ? 'active' : ''; ?>
<?php $active_2 = isset($active_2) && $active_2 ? 'active' : ''; ?>
<?php $active_3 = isset($active_3) && $active_3 ? 'active' : ''; ?>
<?php $active_4 = isset($active_4) && $active_4 ? 'active' : ''; ?>
<?php $active_5 = isset($active_5) && $active_5 ? 'active' : ''; ?>
<!DOCTYPE html>
<html lang="en">

  <?php $this->load->view('includes/header', isset($data_array) ? $data_array : array()); ?>

  <body class="skin-blue sidebar-mini fixed">
  <div class="wrapper">

    <?php $this->load->view('includes/topnav', isset($data_array) ? $data_array : array()); ?>

    <?php $sidebar_row_class = $has_sidebar ? 'row-offcanvas row-offcanvas-left' : ''; ?>
    <?php $sidebar_col_class = $has_sidebar ? 'col-xs-12 col-sm-9' : 'col-sm-12'; ?>

    <?php if ($has_sidebar) : ?>
    <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            <?php foreach ($sidebar as $row) : ?>
              <li class="<?php echo !empty($row['header']) ? 'header' : ''; ?>">
                <?php if (empty($row['header'])) : ?>
                  <a href="<?php echo !empty($row['href']) ? $row['href'] : '#'; ?>" >
                    <i class="<?php echo $row['iclass']; ?>"></i> <span><?php echo $row['text']; ?></span> 
                  </a>
                <?php else: ?>
                  <?php echo !empty($row['text']) ? $row['text'] : ''; ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
    <?php endif; ?>

    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <div class="row">
           <?php echo isset($page_content) && $page_content ? $page_content : ''; ?>
          </div><!-- /.row -->

        </section><!-- /.content -->
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->

    <?php $this->load->view('includes/footer', isset($data_array) ? $data_array : array()); ?>

    <?php $this->load->view('includes/scripts', isset($data_array) ? $data_array : array()); ?>

   </div> 
  </body>

</html>


