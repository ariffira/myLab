  
  <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); $new_point_modal_id = 'modal'.random_string('alnum', 32); ?>" >

    <div class="col-md-12">

      <?php $this->ui->tile->rebase(); ?>
      <?php
        $this->load->language('global/general_text', $this->m->user_value('language'));
        $this->load->language('pwidgets/plot_graph', $this->m->user_value('language'));

        $this->ui->tile->options('class', '');
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
                        Blutzucker (mg/dl)
                      </th>
                      <th>
                        HbA1C
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
                            <label><?php echo !empty($entry->bloodsugar) ? $entry->bloodsugar: ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->HbA1C) ? $entry->HbA1C: ''; ?></label>
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

      <?php/*
        $this->load->view('graph/insert_modal_view', array(
          'modal_id' => $new_point_modal_id,
          'modal_title' => 'Neu Punkte - Blutdruck',
          'table' => 'heart_frequency',
          'entry' => (object) array(
            'id' => 0,
            'bloodsugar' => '',
            'HbA1C' => '',
          ),
        ));
  */    ?>

    </div>

  </div>

  