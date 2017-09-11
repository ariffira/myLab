<?php !isset($entry) ? (($entry = new stdClass()) && ($entry->id = 0)) : NULL; ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<?php $this->load->language('pwidgets/plot_graph', $this->m->user_value('language')); ?>

<!-- Modal <?php echo !empty($modal_id) ? $modal_id : ''; ?> --> 
<div class="modal fade" id="<?php echo !empty($modal_id) ? $modal_id : ''; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo !empty($modal_title) ? $modal_title : ''; ?></h4>
      </div>
      <div class="modal-body p-l-20 p-r-20">
        <?php $this->load->view('graph/insert_view', array(
          'table' => empty($table) ? NULL : $table,
          'entry' => empty($entry) ? NULL : $entry,
          'not_modal' => FALSE,
        )); ?>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-alt btn-sm btn-delete" data-submit-location="<?php echo site_url('akte/vital_values'.'/delete/'.$table.'/'); ?>">
          <span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
        <button type="submit" class="btn btn-alt btn-sm btn-update" data-submit-location="<?php echo site_url('akte/vital_values'.'/update/'.$table.'/'); ?>">
          <span class="icomoon i-loop-4"></span> 
          <?php echo $this->lang->line('general_text_button_update'); ?>
        </button>
        <button type="submit" class="btn btn-alt btn-sm btn-insert" data-submit-location="<?php echo site_url('akte/vital_values'.'/insert/'.$table.'/'); ?>">
          <span class="icomoon i-plus-circle"></span>
          <?php echo $this->lang->line('general_text_button_add'); ?>
        </button>
        <button type="button" class="btn btn-alt btn-sm btn-close" data-dismiss="modal">&times; Schließen</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // ====================================
  // TILE CONFIG DROPDOWN new point clear
  // ====================================

  $('a[data-toggle="modal"][href="#<?php echo $modal_id; ?>"]').click(function() {
    $('#<?php echo $modal_id; ?>').removeData('entry');
  });

  // ================
  // MODAL OPEN EVENT
  // ================
  $('#<?php echo $modal_id; ?>').on('shown.bs.modal', function () {
    var
      $modal = $('#<?php echo $modal_id; ?>'),
      v,
      data = $modal.data('entry');
    if (!$(this).data('entry')) {
      $(this).find('.btn-insert').toggleClass('hidden', false);
      $(this).find('.btn-update').toggleClass('hidden', true);
      $(this).find('.btn-delete').toggleClass('hidden', true);

      $(this).find('input, select, textarea').val('');
      $(this).find('[name="rec_date"]').val(moment().format('DD.MM.YYYY'));
      $(this).find('[name="rec_time"]').val(moment().format('HH:mm'));
    } else {      
      $modal.find('[name="rec_date"]').val(moment(data['rec_date']).format('DD.MM.YYYY'));
      $modal.find('[name="rec_time"]').val(data['rec_time']);
               

      var dataField = data;

//      $modal.find('[name="rr_sys"]').attr('value', v = (typeof dataField['rr_sys'] !== 'undefined' ? dataField['rr_sys'] : '') ).val(v);
//      $modal.find('[name="rr_dia"]').attr('value', v = (typeof dataField['rr_dia'] !== 'undefined' ? dataField['rr_dia'] : '') ).val(v);
//      $modal.find('[name="puls"]').attr('value', v = (typeof dataField['puls'] !== 'undefined' ? dataField['puls'] : '') ).val(v);

//      $modal.find('[name="bloodsugar"]').attr('value', v = (typeof dataField['bloodsugar'] !== 'undefined' ? dataField['bloodsugar'] : '') ).val(v);
//      $modal.find('[name="HbA1C"]').attr('value', v = (typeof dataField['HbA1C'] !== 'undefined' ? dataField['HbA1C'] : '') ).val(v);

//      $modal.find('[name="size"]').attr('value', v = (typeof dataField['size'] !== 'undefined' ? dataField['size'] : '') ).val(v);
//      $modal.find('[name="weight"]').attr('value', v = (typeof dataField['weight'] !== 'undefined' ? dataField['weight'] : '') ).val(v);
//      $modal.find('[name="bmi"]').attr('value', v = (typeof dataField['bmi'] !== 'undefined' ? dataField['bmi'] : '') ).val(v);

//      $modal.find('[name="lower_limit"]').attr('value', v = (typeof dataField['lower_limit'] !== 'undefined' ? dataField['lower_limit'] : '') ).val(v);
//      $modal.find('[name="upper_limit"]').attr('value', v = (typeof dataField['upper_limit'] !== 'undefined' ? dataField['upper_limit'] : '') ).val(v);              
//      $modal.find('[name="INR"]').attr('value', v = (typeof dataField['INR'] !== 'undefined' ? dataField['INR'] : '') ).val(v);
//      $modal.find('[name="quick"]').attr('value', v = (typeof dataField['quick'] !== 'undefined' ? dataField['quick'] : '') ).val(v);

      $modal.find('[name="access"][value="' + (typeof dataField['access_permission'] !== 'undefined' ? dataField['access_permission'] : '')  + '"]').iCheck('check');

      $modal.find('.btn-insert').toggleClass('hidden', true);
      $modal.find('.btn-update').toggleClass('hidden', false);
      $modal.find('.btn-delete').toggleClass('hidden', false);

      $("#linechart-tooltip").hide();
    }

    /* --------------------------------------------------------
       Date Time Picker
      -----------------------------------------------------------*/
    (function() {
          //Date Only
          
          if ($modal.find('.date-only')[0]) {
           $modal.find('.date-only').each(function(){
            $(this).datetimepicker({	  
            pickTime: false,
            format:"DD.MM.YYYY",
            }).on('changeDate', function() { 
            $(this).datetimepicker('hide');
                });
            });
          }

          //Time only
          if ($modal.find('.time-only')[0]) {
           $modal.find('.time-only').each(function(){
            $(this).datetimepicker({
            pickDate: false,
            })
            });
         }

          //12 Hour Time
          if ($modal.find('.time-only-12')[0]) {
            $modal.find('.time-only-12')
              .datetimepicker({
                pickDate: false,
                pick12HourFormat: true
              });
          }
        })();

    $("#linechart-tooltip").hide();
  });

  $('#<?php echo $modal_id; ?>').find('[type="submit"][data-submit-location]').click(function() {
    var id = $(this).closest('.modal').data('entry');

    id = id ? id['id'] : 0;

    $(this).closest('.modal').find('.modal-body').find('form').attr('action', $(this).attr('data-submit-location') + '/' + id).submit();
  });

</script>
