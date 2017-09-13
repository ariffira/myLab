  
  <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); $new_point_modal_id = 'modal'.random_string('alnum', 32); ?>" >

    <div class="col-md-12">

      <?php $this->ui->tile->rebase(); ?>
      <?php
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));

        $this->ui->tile->options('class', 'm-b-10 m-t-5 m-l-0 m-r-0');
        $this->ui->tile->title('content', $this->lang->line('pwidget_plot_graph_table'));

        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          function() use ($entries, $new_point_modal_id) {
            ?>
        
            <?php ob_start();  ?>

              <div class="table-responsive overflow">
                <table class="table tile table-condensed table-striped">
                  <thead>
                    <tr>
                      <th>
                        <?php echo $this->lang->line('pwidget_plot_graph_insert_date'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_plot_graph_insert_time'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_plot_graph_height'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_plot_graph_weight'); ?>
                      </th>
                      <th>
                        BMI
                      </th>
                      <th>
                        &nbsp;
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($entries) && is_array($entries) && count($entries) > 0) : foreach ($entries as $entry_index => $entry) : ?>
                      <?php
                        // if (empty($entry->rr_sys) || empty($entry->rr_dia) || empty($entry->puls)) continue;

                        $time = $entry->rec_date.' ';
                       
                        $time .= (!empty($entry->rec_time) ? $entry->rec_time : $entry->rec_time.':00');
//                        if (($time = strtotime($time)) === FALSE)
//                        {
//                          if (($time = strtotime($entry->rec_date.' '.'00:00:00')) === FALSE)
//                          {
//                            if (($time = strtotime($entry->rec_date.' '.'00:00:00')) === FALSE)
//                            {
//                              continue;
//                            }
//                          }
//                        }
//
//                        if ($time < 0)
//                        {
//                          continue;
//                        }
                      ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('d.m.Y', strtotime($time)); ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('H:i', strtotime($time)); ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->size) ? $entry->size: ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->weight) ? $entry->weight: ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->bmi) ? $entry->bmi: ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <a href="<?php echo site_url('akte/vital_values/delete/weight_bmi/'.$entry->id); ?>" class="btn btn-alt btn-xs btn-tool btn-tool-delete" id="<?php echo $btn_tool_delete_id = 'btnTool'.random_string('alnum', 32); ?>"><span class="icomoon i-remove-2"></span></a>
                          <button type="button" class="btn btn-alt btn-xs btn-tool btn-tool-update" id="<?php echo $btn_tool_update_id = 'btnTool'.random_string('alnum', 32); ?>"><span class="icomoon i-quill-2"></span></button>
                          <script type="text/javascript" class="essenScript">
                            $('#<?php echo $btn_tool_update_id; ?>').closest('tr').data('entry', <?php echo json_encode($entry) ?>);
                          </script>
                        </td>
                      </tr>
                    <?php endforeach; endif; ?>
                  </tbody>
                </table>
              </div>

            <?php 
              $buffer = ob_get_contents();
              @ob_end_clean();
            ?>

            <?php

            return $buffer;
          }
        );
      ?>

      <?php
        echo $this->ui->tile->output();
      ?>

      <?php
        $this->load->view('graph/insert_modal_view', array(
          'modal_id' => $new_point_modal_id,
          'modal_title' => 'Bearbeiten Punkte - Gewicht & BMI',
          'table' => 'weight_bmi',
          'entry' => (object) array(
            'id' => 0,
            'size' => '',
            'weight' => '',
            'bmi' => '',
          ),
        ));
      ?>

    </div>

  </div>

  <script>

    $(document).ready(function() {

      // ======================================
      // TOOL BTN on last columns of table rows
      // ======================================

      $('.btn-tool.btn-tool-update').click(function() {
        var $modal = $('#<?php echo $new_point_modal_id; ?>'), v, data = $(this).closest('tr').data('entry');

        if (!data) return;

        $modal.data('entry', data);
        
        $modal.find('[name="rec_date"]').val(moment(data['rec_date']).format('DD.MM.YYYY'));
        $modal.find('[name="rec_time"]').val(data['rec_time']);

        // Date Time Picker

        (function() {
          //Date Only
          if ($modal.find('.date-only')[0]) {
            $modal.find('.date-only')
              .datetimepicker('destroy')
              .datetimepicker({
                pickTime: false
              });
          }

          //Time only
          if ($modal.find('.time-only')[0]) {
            $modal.find('.time-only')
              .datetimepicker('destroy')
              .datetimepicker({
                pickDate: false
              });
          }

          //12 Hour Time
          if ($modal.find('.time-only-12')[0]) {
            $modal.find('.time-only-12')
              .datetimepicker('destroy')
              .datetimepicker({
                pickDate: false,
                pick12HourFormat: true
              });
          }
        })();

        var dataField = data;

     
        $modal.find('[name="size"]').attr('value', v = (typeof dataField['size'] !== 'undefined' ? dataField['size'] : '') ).val(v);
        $modal.find('[name="weight"]').attr('value', v = (typeof dataField['weight'] !== 'undefined' ? dataField['weight'] : '') ).val(v);
        $modal.find('[name="bmi"]').attr('value', v = (typeof dataField['bmi'] !== 'undefined' ? dataField['bmi'] : '') ).val(v);
        $modal.modal('show');

     
      });

    });

    $.pageSetup($('#<?php echo $scope_id; ?>'));

  </script>