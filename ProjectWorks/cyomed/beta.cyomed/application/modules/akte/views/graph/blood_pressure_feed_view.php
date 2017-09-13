<?php $this->ui->feed_item->base_init(); ?>
  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
  <?php $this->ui->feed_item->rebase(); ?>
      <?php
//        $this->ui->feed_item->icon = 'fa fa-heartbeat';
//        $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>'.' - RR sys. &amp; RR dia.');
        // $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>'.' - Puls');
        $this->ui->feed_item->content->options('class', 'p-r-20');
        $this->ui->feed_item->content(
          'content',
          '<div class="thumbnail p-15" id="'.($feed_id = 'feedScope_'.random_string('alnum', 32)).'">'.
            $this->load->view('graph/blood_pressure_tile_view', array(
              'title' =>strtoupper($this->lang->line('graph_title_bloodpressure')),
              'entries' => $entries,
              'fields' => array(
                (object)array('field' => 'rr_sys', 'label' => strtoupper($this->lang->line('graph_blood_pres_x_cord_sys')), 'axis' => 0, ),
                (object)array('field' => 'rr_dia', 'label' => strtoupper($this->lang->line('graph_blood_pres_x_cord_dias')), 'axis' => 0, ),
              ),
              'valuepostfix'=>'MMHG',
                'withing'=>false,
                'feed'=>true,            
            ), TRUE).
          '</div>'
        );
//        $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
//        $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
//        $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>');
        echo $this->ui->feed_item->output();
      ?>

      <?php
        $this->load->view('graph/blood_pressure_feed_modal_view', array(
          'modal_id' => $feed_modal_id = 'feedModal_'.random_string('alnum', 32), 
          'modal_title' => strtoupper($this->lang->line('graph_title_bloodpressure')),
          // 'modal_title' => 'Puls',
          'entries' => $entries,
           
          'fields' => array(
            (object)array('field' => 'rr_sys', 'label' =>strtoupper($this->lang->line('graph_blood_pres_x_cord_sys')), 'axis' => 0, ),
            (object)array('field' => 'rr_dia', 'label' => strtoupper($this->lang->line('graph_blood_pres_x_cord_dias')), 'axis' => 0, ),
               
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

      <?php $this->ui->feed_item->rebase(); ?>
      <?php
//        $this->ui->feed_item->icon = 'fa fa-heartbeat';
        // $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>'.' - RR sys. &amp; RR dia.');
//        $this->ui->feed_item->title('content', '<a href="javascript:;">'.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>'.' - Puls');
        $this->ui->feed_item->content->options('class', 'p-r-20');
        $this->ui->feed_item->content(
          'content',
          '<div class="thumbnail p-15" id="'.($feed_id = 'feedScope_'.random_string('alnum', 32)).'">'.
            $this->load->view('graph/blood_pressure_tile_view', array(
                'feed'=>true,
               'title' => strtoupper($this->lang->line('graph_title_heart_puls')),
              'entries' => $entries,
                'withing'=>true,
              'fields' => array(
                (object)array('field' => 'puls', 'label' => strtoupper($this->lang->line('graph_title_heart_puls')), ),
              ),
            ), TRUE).
          '</div>'
        );
//        $this->ui->feed_item->actions->append('like', '<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> 123</a>');
//        $this->ui->feed_item->actions->append('comment', '<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> 29</a>');
//        $this->ui->feed_item->actions->append('time', '<a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> '.date('d.m.Y', strtotime($entries[0]->rec_date)).'</a>');
//        echo "nitesh";die;
        echo $this->ui->feed_item->output();
        
      ?>
       <?php
        $this->load->view('graph/blood_pressure_feed_modal_view', array(
          'modal_id' => $feed_modal_id = 'feedModal_'.random_string('alnum', 32), 
          // 'modal_title' => 'RR sys. &amp; RR dia.',
          'modal_title' => strtoupper($this->lang->line('graph_title_heart_puls')),
          'entries' => $entries,
          'fields' => array(
            (object)array('field' => 'puls', 'label' => strtoupper($this->lang->line('graph_title_heart_puls')), ),
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
      
<?php else: ?>
	<div class='msg-no-record'><h4>No record found</h4></div>
<?php endif; ?>
  <script>    
      
$('.ajax-load-link').click(function(e) 

         {

          e.preventDefault();

         

          if ($(this).attr('href').indexOf('javascript:') < 0)

          $.loadUrl($(this).attr('href'), $('#content'));

         });

    $.pageSetup($('#feedContent'));
  </script>