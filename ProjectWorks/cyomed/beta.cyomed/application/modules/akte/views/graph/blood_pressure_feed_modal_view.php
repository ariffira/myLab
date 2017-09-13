
<?php if(isset($fields) && is_array($fields) && count($fields) > 0) : ?>

<?php else : ?>
  <?php
    $fields = array(
      (object)array('field' => 'rr_sys', 'label' => 'RR systolisch', 'axis' => 0, ),
      (object)array('field' => 'rr_dia', 'label' => 'RR diastolisch', 'axis' => 0, ),
    );
  ?>
<?php endif; ?>

<?php foreach ($fields as $field_index => $field) : ?>

  <?php
    for ( $new_color_rand = mt_rand(1, 4) ; !empty($color_rand) && $color_rand == $new_color_rand ; $new_color_rand = mt_rand(1, 4) ) {}
    $color_rand = $new_color_rand;

    $fields[$field_index]->color =
        $color_rand <= 1 ? array('255', '214', '0') : 
      ( $color_rand <= 2 ? array('91', '192', '222', ) : 
      ( $color_rand <= 3 ? array('217', '83', '79', ) : 
      ( $color_rand <= 4 ? array('92', '184', '92', ) : array('0', '0', '0', )
    ) ) );
  ?>

<?php endforeach; ?>

<!-- Modal <?php echo !empty($modal_id) ? $modal_id : ''; ?> --> 
<div class="modal fade" id="<?php echo !empty($modal_id) ? $modal_id : ''; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo !empty($modal_title) ? $modal_title : ''; ?></h4>
      </div>
      <div class="modal-body p-l-20 p-r-20">
        <!-- # MODAL CONTENT # -->
        <div id="<?php echo $graph_id = 'graph_'.random_string('alnum', 32); ?>" class="main-chart" style="height: 250px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-alt btn-sm btn-close" data-dismiss="modal">&times; Schließen</button>
      </div>
    </div>
  </div>
</div>

<?php
    $this->load->view('graph/insert_modal_view', array(
      'modal_id' => $new_point_modal_id = 'newPointModal_'.random_string('alnum', 32),
      'modal_title' => $this->lang->line('pwidget_plot_graph_new_point'),
      'table' => 'heart_frequency',
      'entry' => (object) array(
        'id' => 0,
        'rr_sys' => '',
        'rr_dia' => '',
        'puls' => '',
      ),
    ));
  ?>

<script type="text/javascript">
  // ================
  // MODAL OPEN EVENT
  // ================
  $('#<?php echo $modal_id; ?>').on('show.bs.modal', function () {
    var $modal = $('#<?php echo $modal_id; ?>');

    if ($('.modal.in').not(this).length) {
      $modal.modal('hide');
      return;
    }

    /* --------------------------------------------------------
       Date Time Picker
      -----------------------------------------------------------*/
    (function() {
      // Date Only
      if ($modal.find('.date-only')[0]) {
        $modal.find('.date-only').datetimepicker({
          pickTime: false
        });
      }

      //Time only
      if ($modal.find('.time-only')[0]) {
        $modal.find('.time-only').datetimepicker({
          pickDate: false
        });
      }

      //12 Hour Time
      if ($modal.find('.time-only-12')[0]) {
        $modal.find('.time-only-12').datetimepicker({
          pickDate: false,
          pick12HourFormat: true
        });
      }

      $modal.find('.datetime-pick input:text').off('click').on('click', function() {
        $(this).closest('.datetime-pick').find('.add-on i').click();
      });
    })();

    $("#linechart-tooltip").hide();
  });

  $('#<?php echo $modal_id; ?>').on('shown.bs.modal', function () {
    var $modal = $('#<?php echo $modal_id; ?>');

    if ($('.modal.in').not(this).length) {
      $modal.modal('hide');
    }

    <?php $this->load->view('graph/tile_script_view', array(
      'tile_script_graph_id' => $graph_id,
      'tile_script_entries' => $entries,
      'tile_script_fields' => $fields,
      'tile_script_new_point_modal_id' => $new_point_modal_id, 
    )); ?>
  });

</script>
