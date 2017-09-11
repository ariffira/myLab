  
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
                        Größe (m)
                      </th>
                      <th>
                        Gewicht (kg)
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
                        $time .= (!empty($entry->rec_time) && strlen($entry->rec_time) == 5 ? $entry->rec_time : ($entry->rec_time.':00')).':00';
                        if (($time = strtotime($time)) === FALSE)
                        {
                          if (($time = strtotime($entry->rec_date.' '.'00:00:00')) === FALSE)
                          {
                            if (($time = strtotime($entry->rec_date.' '.'00:00:00')) === FALSE)
                            {
                              continue;
                            }
                          }
                        }

                        if ($time < 0)
                        {
                          continue;
                        }
                      ?>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('d.m.Y', $time); ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('H:i', $time); ?></label>
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
          'modal_title' => 'Neu Punkte - Blutdruck',
          'table' => 'heart_frequency',
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

        $modal.find('[name="rr_sys"]').attr('value', v = (typeof dataField['rr_sys'] !== 'undefined' ? dataField['rr_sys'] : '') ).val(v);
        $modal.find('[name="rr_dia"]').attr('value', v = (typeof dataField['rr_dia'] !== 'undefined' ? dataField['rr_dia'] : '') ).val(v);
        $modal.find('[name="puls"]').attr('value', v = (typeof dataField['puls'] !== 'undefined' ? dataField['puls'] : '') ).val(v);

        $modal.find('[name="bloodsugar"]').attr('value', v = (typeof dataField['bloodsugar'] !== 'undefined' ? dataField['bloodsugar'] : '') ).val(v);
        $modal.find('[name="HbA1C"]').attr('value', v = (typeof dataField['HbA1C'] !== 'undefined' ? dataField['HbA1C'] : '') ).val(v);

        $modal.find('[name="size"]').attr('value', v = (typeof dataField['size'] !== 'undefined' ? dataField['size'] : '') ).val(v);
        $modal.find('[name="weight"]').attr('value', v = (typeof dataField['weight'] !== 'undefined' ? dataField['weight'] : '') ).val(v);
        $modal.find('[name="bmi"]').attr('value', v = (typeof dataField['bmi'] !== 'undefined' ? dataField['bmi'] : '') ).val(v);

        $modal.find('[name="lower_limit"]').attr('value', v = (typeof dataField['lower_limit'] !== 'undefined' ? dataField['lower_limit'] : '') ).val(v);
        $modal.find('[name="upper_limit"]').attr('value', v = (typeof dataField['upper_limit'] !== 'undefined' ? dataField['upper_limit'] : '') ).val(v);              
        $modal.find('[name="INR"]').attr('value', v = (typeof dataField['INR'] !== 'undefined' ? dataField['INR'] : '') ).val(v);
        $modal.find('[name="quick"]').attr('value', v = (typeof dataField['quick'] !== 'undefined' ? dataField['quick'] : '') ).val(v);

        $modal.find('[name="access"][value="' + (typeof dataField['access_permission'] !== 'undefined' ? dataField['access_permission'] : '')  + '"]').iCheck('check');

        $modal.find('.btn-insert').toggleClass('hidden', true);
        $modal.find('.btn-update').toggleClass('hidden', false);
        $modal.find('.btn-delete').toggleClass('hidden', false);

        $modal.modal('show');

        $("#linechart-tooltip").hide();
      });

      // ================
      // MODAL OPEN EVENT
      // ================
      $('#<?php echo $new_point_modal_id; ?>').on('show.bs.modal', function () {
        if (!$(this).data('entry')) {
          $(this).find('btn-insert').toggleClass('hidden', false);
          $(this).find('btn-update').toggleClass('hidden', true);
          $(this).find('btn-delete').toggleClass('hidden', true);
        } else {
          $(this).find('btn-insert').toggleClass('hidden', true);
          $(this).find('btn-update').toggleClass('hidden', false);
          $(this).find('btn-delete').toggleClass('hidden', false);
        }

        $("#linechart-tooltip").hide();
      })


    });

    $.pageSetup($('#<?php echo $scope_id; ?>'));

  </script>