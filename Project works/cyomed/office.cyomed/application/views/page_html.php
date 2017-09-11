
<!DOCTYPE html>
<html lang="en">

  <?php $this->load->view('includes/header'); ?>

  <body class="<?php echo isset($page_class) && $page_class ? $page_class : ''; ?>">

           <?php echo isset($page_content) && $page_content ? $page_content : ''; ?>


    <?php $this->load->view('includes/scripts'); ?>

  </body>

</html>





