<?php $this->ui->feed_item->base_init(); ?>
  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
    <?php $this->ui->feed_item->rebase(); ?>
      <?php
        $this->ui->feed_item->icon = 'fa fa-street-view';
        $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>'.' - Gewicht &amp; BMI');
        $this->ui->feed_item->content->options('class', 'p-r-20');
        $this->ui->feed_item->content(
          'content',
          '<div class="thumbnail p-15" id="'.($feed_id = 'feedScope_'.random_string('alnum', 32)).'">'.
            $this->load->view('graph/weight_bmi_tile_view', array(
              'title' => $this->lang->line('overview_lang_blood_bmi_title'),
              // 'hide_menu' => TRUE, 
              'entries' => $entries,
              'colorclass'=>$colorclass,
              'fields' => array(
                (object)array('field' => 'bmi', 'label' => 'BMI', ),
                (object)array('field' => 'weight', 'label' => 'Gewicht (kg)', ),
                (object)array('field' => 'size', 'label' => 'Größe (m)', 'disable_fill' => TRUE, ),
              ),
                'feed'=>true,
            ), TRUE).
          '</div>'
        );
        $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
        $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
        $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>');
        echo $this->ui->feed_item->output();
      ?>
<?php
        $this->load->view('graph/weight_bmi_feed_modal_view', array(
          'modal_id' => $feed_modal_id = 'feedModal_'.random_string('alnum', 32), 
          'modal_title' => $this->lang->line('overview_lang_blood_bmi_title'),
          'entries' => $entries,
          'fields' => array(
            (object)array('field' => 'bmi', 'label' => 'BMI', ),
            (object)array('field' => 'weight', 'label' => 'Gewicht (kg)', ),
            (object)array('field' => 'size', 'label' => 'Größe (m)', 'disable_fill' => TRUE, ),
          ),
        ));
      ?>

      <script>
        // $('#<?php echo $feed_id; ?>').on('click', function(e) {
        $('#<?php echo $feed_id; ?>').click(function(e) {

          var $target = $(e.target);

          if ($target.closest('.portlet').length && !$target.closest('.tile-config').length && !$('.modal.in').length) {
            $('#<?php echo $feed_modal_id; ?>').modal('show');
          }

        }).hover(function() {
          $(this).css('cursor','pointer');
        }, function() {
          $(this).css('cursor','auto');
        });
      </script>
 <?php  endif; ?>
  <script>
    $.pageSetup($('#feedContent'));
  </script>