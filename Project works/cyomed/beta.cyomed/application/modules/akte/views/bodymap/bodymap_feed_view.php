<?php $this->ui->feed_item->base_init(); ?>
  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
  <?php 
    echo "<div class='blog-list'>";
    foreach ($entries as $entry_index => $entry) : ?>
       <?php $this->ui->feed_item->rebase(); ?>
        <?php
          $this->ui->feed_item->content(
            'content',
            $this->load->view('bodymap/bodymap_home_view', array(
              'entry' => $entry,
              'hide_insert' => TRUE,
              'static' => TRUE, 
              'readonly' => FALSE,
              'update_btn' => TRUE,
              'emergency_btn' => FALSE,
              'confirm_btn' => FALSE,
              'archive_btn' => FALSE,
              'delete_btn' => TRUE,
            ), TRUE)
          );
          echo $this->ui->feed_item->output();
        ?>
<?php endforeach; ?>
<?php  
	echo "</div><div class='blog-list' id='showmore_feed".$show_more."'></div>";
?>
<?php
if(!empty($tot_record)&&!empty($entries)&&$tot_record>5 && count($entries)>=5)
{
echo "<a href='".site_url("akte/bodymap/feed/?id=blue&showmore=$show_more")."' class='show_more' id='show_more".$show_more."' ><div class='btn btn-default pull-right'>Show More</div></a>";
}
?>
<?php else: ?>
	<div class='msg-no-record'><h4>No record found</h4></div>
<?php endif; ?>

<script>
      $('#show_more<?php echo $show_more;?>').click(function(e) 
      {
   
       $("#show_more<?php echo $show_more;?>").remove();
         e.preventDefault();
        if ($('#showmore_feed<?php echo $show_more;?>').length && $(this).attr('href').indexOf('javascript:') < 0) {
            $.loadUrl($(this).attr('href'), $('#showmore_feed<?php echo $show_more;?>'));
            $('#showmore_feed<?php echo $show_more;?>').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
        } 
       });
       $.pageSetup($('#feedContent'));
 </script>