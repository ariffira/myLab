<?php $this->ui->feed_item->base_init();

?>
  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
<?php echo "<div class='blog-list'>";?>
    <?php foreach ($entries as $entry_index => $entry) : ?>
        <?php $this->ui->feed_item->rebase(); ?>
        <?php
          if (!empty($entry->feed_type))
            switch ($entry->feed_type) {
              case 'condition':
                $this->ui->feed_item->icon = 'fa fa-smile-o';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - befinden: '.'<a href="javascript:;">'.$entry->title.'</a>');
                break;
              case 'diagnosis':
                $this->ui->feed_item->icon = 'fa fa-stethoscope';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - '.(empty($entry->entry_from) ? 'Diagnose' : 'Travel Diagnose').': '.'<a href="javascript:;">'.$entry->title.'</a>');
                break;
              case 'vaccination':
                $this->ui->feed_item->icon = 'fa fa-medkit';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Impfung: '.'<a href="javascript:;">'.$entry->Handelsname.'</a>');
                break;
              default:
                $this->ui->feed_item->icon = 'fa fa-asterisk';
                $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entry->document_date)).'</a>'.' - Feed: '.'<a href="javascript:;">#'.$entry->id.'</a>');
                break;
            }
          $this->ui->feed_item->content->options('class', '');

          if (!empty($entry->feed_type))
            if (in_array($entry->feed_type, array('condition', 'diagnosis', 'medication', 'vaccination','casehistory' ))) {
              $this->ui->feed_item->content(
                'content',
                $this->load->view(($entry->feed_type).'/'.($entry->feed_type).'_home_view', array(
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
              $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
              $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
              $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entry->document_date)).'</a>');
              echo $this->ui->feed_item->output();
            } else {
              $this->ui->feed_item->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
              $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
              $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entry->document_date)).'</a>');
              echo $this->ui->feed_item->output();
            }
        ?>

    <?php endforeach;
   
    ?>
  <?php echo "</div><div class='blog-list' id='showmore_feed".$show_more."'></div>";?>
<?php
if(!empty($tot_record)&&!empty($entries)&&$tot_record>5 && count($entries)>=5)
{

  echo "<a href='".site_url("akte/document/feed/?id=purple&showmore=$show_more")."' class='show_more' id='show_more".$show_more."' ><div class='btn btn-default pull-right'>Show More</div></a><div class='clear'></div>";
}
?>
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
      $('.ajax-load-link').click(function(e) 
         {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
         });
    $.pageSetup($('#feedContent'));
  </script>
