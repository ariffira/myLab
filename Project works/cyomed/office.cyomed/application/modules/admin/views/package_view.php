<div class="row">
  <div class="col-md-12">
    <?php $alert = isset($alert) && $alert ? $alert : $this->session->flashdata('page_alert'); ?>

    <?php if (is_string($alert) && $alert) : $alert = array('text' => $alert, ); endif; ?>

    <?php if (is_array($alert)) : ?>
      <?php foreach ($alert as $key => $value) : ?>
        <?php if (!is_numeric($key)) : $value = $alert; endif; ?>
        <div class="<?php echo isset($value['class']) && $value['class'] ? $value['class'] : 'alert alert-danger'; ?>">
          <?php echo isset($value['text']) && $value['text'] ? $value['text'] : 'Fehler aufgetreten.'; ?>
        </div>
        <?php if (!is_numeric($key)) : break; endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <?php if (isset($packages) && is_array($packages) && count($packages) > 0) : $index = 0; foreach ($packages as $row) : ?>
    <li class="<?php echo $index ? '' : 'active'; ?>">
      <a href="#packageTab<?php echo $row->id; ?>" role="tab" data-toggle="tab">
        <?php echo 'For '.($row->for == 1 ? 'patient' : 'doctor').'<br />'.$row->name; ?>
      </a>
    </li>
  <?php $index++; endforeach; endif; ?>

  <li class="<?php echo isset($packages) && is_array($packages) && count($packages) > 0 ? '' : 'active'; ?>">
    <a href="#packageTab0" role="tab" data-toggle="tab">
      <span class="icomoon i-folder-plus" style="font-size:37px;"></span>
    </a>
  </li>

  <?php isset($packages) && is_array($packages) ? ($packages[] = new stdClass()) : ($packages = array(new stdClass(), )) ; ?>
</ul>

<hr/>

<!-- Tab panes -->
<div class="tab-content">
  <?php if (isset($packages) && is_array($packages) && count($packages) > 0) : $index = 0; foreach ($packages as $row) : ?>
    <?php
      if (!isset($row->id) || !$row->id)
      {
        $row->id                  = 0;
        $row->for                 = 2;
        $row->name                = 'new_package_'.count($packages);
        $row->display_name        = 'new_package_'.count($packages);
        $row->intro               = '';
        $row->intro_top_right     = '';
        $row->price_cent          = 0;
        $row->running_time_type   = $this->mod->dy_config->package_running_time_type;
        $row->running_time        = $this->mod->dy_config->package_running_time;
        $row->running_time_quant  = $this->mod->dy_config->package_running_time_quant;
        $row->cancel_buffer_type  = $this->mod->dy_config->package_cancel_buffer_type;
        $row->cancel_buffer       = $this->mod->dy_config->package_cancel_buffer;
        $row->cancel_buffer_quant = $this->mod->dy_config->package_cancel_buffer_quant;
        $row->visual_order        = count($packages);
        $row->visual_class        = 'col-md-4 col-sm-6';
      }
    ?>

    <div class="tab-pane fade <?php echo $index ? '' : 'in active'; ?>" id="packageTab<?php echo $row->id; ?>">
      <form class="form-horizontal" method="post">

        <input type="hidden" name="package_id" value="<?php echo $row->id; ?>" />

        <h4>General</h4>

        <div class="form-group">
          <label for="packageSettingsFor" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
            <p class="form-control-static"><?php echo $row->id; ?></p>
          </div>
        </div>

        <div class="form-group">
          <label for="packageSettingsFor" class="col-sm-3 control-label">For</label>
          <div class="col-sm-9">
            <select id="packageSettingsFor" class="form-control" name="package_for" >
              <option value="1" <?php echo isset($row->for) && $row->for == 1 ? 'selected="selected"' : ''; ?> >Patient</option>
              <option value="2" <?php echo isset($row->for) && $row->for == 2 ? 'selected="selected"' : ''; ?> >Doctor</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="packageSettingsName" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input id="packageSettingsName" type="text" class="form-control" name="package_name" value="<?php echo form_prep($row->name); ?>" />
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            This is for internal use. Would be used also for program. Be careful to choose this name, avoiding conflicts.
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsDisplayName" class="col-sm-3 control-label">Display Name</label>
          <div class="col-sm-9">
            <input id="packageSettingsDisplayName" type="text" class="form-control" name="package_display_name" value="<?php echo form_prep($row->display_name); ?>" />
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            This is what would be displayed on users' side.
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsVisualOrder" class="col-sm-3 control-label">Visual Order</label>
          <div class="col-sm-9">
            <input id="packageSettingsVisualOrder" type="text" class="form-control" name="package_visual_order" value="<?php echo form_prep($row->visual_order); ?>" placeholder="Visual Order" />
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Packages would be displayed with <code>Visual Order</code> Ascending
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsVisualClass" class="col-sm-3 control-label">Visual Class</label>
          <div class="col-sm-9">
            <input id="packageSettingsVisualClass" type="text" class="form-control" name="package_visual_class" value="<?php echo form_prep($row->visual_class); ?>" placeholder="Visual Class" />
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            This field is for adjusting the width of each displayed packages(especially for patients) accoding to bootstrap grids convention. <br/>
            <code>col-md-4</code> would make the package hold a space of 4 columns on middle sized devices.<br/>
            <code>col-sm-6</code> would make the package hold a space of 6 columns on small sized devices.<br/>
            <code>col-xs-12</code> would make the package hold a space of 6 columns on very small devices.<br/>
            <strong>Note: In bs there are in total 12 columns</strong>
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsVisualNewRow" class="col-sm-3 control-label">New Row</label>
          <div class="col-sm-9">
            <div class="checkbox">
              <label>
                <input id="packageSettingsVisualNewRow" type="checkbox" name="package_visual_new_row" <?php echo isset($row->visual_new_row) && $row->visual_new_row ? 'checked="checked"' : ''; ?> />
                Visually starting a new row from this package
              </label>
            </div>            
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Starting a new row from this package, using bootstrap grid system mentioned above.
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsPrice" class="col-sm-3 control-label">Price holder</label>
          <div class="col-sm-9">
            <input id="packageSettingsPrice" type="text" class="form-control" name="package_intro_top_right" value="<?php echo form_prep($row->intro_top_right); ?>" />
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Only a price holder. Would be displayed on users' side.
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsPriceCent" class="col-sm-3 control-label">Price per cycle(IN CENTS)</label>
          <div class="col-sm-9">
            <input id="packageSettingsPriceCent" type="text" class="form-control" name="package_price_cent" value="<?php echo form_prep($row->price_cent); ?>" />
          </div>
          <p class="help-block col-sm-9 col-sm-offset-3">
            <span class="label label-danger">IMPORTANT</span> <small>This field would be posted as the price value to Payone.de</small>
          </p>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Example: <br/>
            <code>3000</code> for 30.00 EUR<br/>
            <code>2995</code> for 29.95 EUR<br/>
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsIntro" class="col-sm-3 control-label">Brief intro</label>
          <div class="col-sm-9">
            <textarea id="packageSettingsIntro" class="form-control summernote" name="package_intro" rows="5" ><?php echo $row->intro; ?></textarea>
          </div>
        </div>

        <hr />

        <h4>Running Time</h4>

        <div class="form-group">
          <label for="packageSettingsRunningTimeType" class="col-sm-3 control-label">Running time type</label>
          <div class="col-sm-9">
            <select id="packageSettingsRunningTimeType" class="form-control" name="package_running_time_type" >
              <option value="end_of" <?php echo isset($row->running_time_type) && $row->running_time_type == 'end_of' ? 'selected="selected"' : ''; ?> >end of</option>
              <option value="static" <?php echo isset($row->running_time_type) && $row->running_time_type == 'static' ? 'selected="selected"' : ''; ?> >static</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="packageSettingsRunningTime" class="col-sm-3 control-label">Running time</label>
          <div class="col-sm-3">
            <input id="packageSettingsRunningTime" class="form-control" placeholder="Running time" type="number" name="package_running_time" value="<?php echo form_prep($row->running_time); ?>" />
          </div>
          <label for="packageSettingsRunningTimeQuant" class="col-sm-2 control-label">Quantifier</label>
          <div class="col-sm-3">
            <select id="packageSettingsRunningTimeQuant" class="form-control" name="package_running_time_quant" >
              <option value="minute" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'minute' ? 'selected="selected"' : ''; ?> >minute</option>
              <option value="hour" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'hour' ? 'selected="selected"' : ''; ?> >hour</option>
              <option value="day" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'day' ? 'selected="selected"' : ''; ?> >day</option>
              <option value="week" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'week' ? 'selected="selected"' : ''; ?> >week</option>
              <option value="month" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'month' ? 'selected="selected"' : ''; ?> >month</option>
              <option value="quarter" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'quarter' ? 'selected="selected"' : ''; ?> >quarter</option>
              <option value="year" <?php echo isset($row->running_time_quant) && $row->running_time_quant == 'year' ? 'selected="selected"' : ''; ?> >year</option>
            </select>
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            When type chosen as <code>end_of</code>,<br/>
            <ul>
              <li>0 stand as for the end of the current month / year / day</li>
              <li>1 stand as for the end of the next month / year / day</li>
              <li>2 stand as for the end of the month / year / day after the next month / year / day</li>
              <li>...</li>
            </ul>
          </small>
        </div>

        <hr />

        <h4>Cancellation Buffer</h4>

        <div class="form-group">
          <label for="packageSettingsCancelBufferType" class="col-sm-3 control-label">Buffer type</label>
          <div class="col-sm-9">
            <select id="packageSettingsCancelBufferType" class="form-control" name="package_cancel_buffer_type" >
              <option value="end_of" <?php echo isset($row->cancel_buffer_type) && $row->cancel_buffer_type == 'end_of' ? 'selected="selected"' : ''; ?> >end of</option>
              <option value="static" <?php echo isset($row->cancel_buffer_type) && $row->cancel_buffer_type == 'static' ? 'selected="selected"' : ''; ?> >static</option>              
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="packageSettingsRunningTime" class="col-sm-3 control-label">Buffer time</label>
          <div class="col-sm-3">
            <input id="packageSettingsRunningTime" class="form-control" placeholder="Buffer time" type="number" name="package_cancel_buffer" value="<?php echo form_prep($row->cancel_buffer); ?>" />
          </div>
          <label for="packageSettingsRunningTimeQuant" class="col-sm-2 control-label">Quantifier</label>
          <div class="col-sm-3">
            <select id="packageSettingsRunningTimeQuant" class="form-control" name="package_cancel_buffer_quant" >
              <option value="minute" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'minute' ? 'selected="selected"' : ''; ?> >minute</option>
              <option value="hour" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'hour' ? 'selected="selected"' : ''; ?> >hour</option>
              <option value="day" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'day' ? 'selected="selected"' : ''; ?> >day</option>
              <option value="week" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'week' ? 'selected="selected"' : ''; ?> >week</option>
              <option value="month" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'month' ? 'selected="selected"' : ''; ?> >month</option>
              <option value="quater" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'quater' ? 'selected="selected"' : ''; ?> >quater</option>
              <option value="year" <?php echo isset($row->cancel_buffer_quant) && $row->cancel_buffer_quant == 'year' ? 'selected="selected"' : ''; ?> >year</option>
            </select>
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            When type chosen as <code>end_of</code>,<br/>
            <ul>
              <li>0 stand as for the end of the current month / year / day</li>
              <li>1 stand as for the end of the next month / year / day</li>
              <li>2 stand as for the end of the month / year / day after the next month / year / day</li>
              <li>...</li>
            </ul>
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsNoBuffers" class="col-sm-3 control-label">No buffer when upgrading to</label>
          <div class="col-sm-9">
            <select id="packageSettingsNoBuffers" class="bs-form-control chosen-select" name="package_no_buffers[]" data-placeholder="Upgrading to these at any time" multiple="multiple">
              <?php foreach ($packages as $another) : if (isset($another->id) && $another->id && $another->id != $row->id && $row->for == $another->for) : ?>
                <option value="<?php echo $another->id; ?>" <?php echo in_array($another->id, $row->no_buffers) ? 'selected="selected"' : ''; ?> ><?php echo $another->name; ?></option>
              <?php endif; endforeach; ?>
            </select>
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Giving users the ablity of upgrading immediately from one product to another. Such as from <code>free</code> to <code>basic</code> or from <code>complete</code> to <code>family</code>.
          </small>
        </div>

        <div class="form-group">
          <label for="packageSettingsActivatingModules" class="col-sm-3 control-label">Activating Modules</label>
          <div class="col-sm-9">
            <select id="packageSettingsActivatingModules" class="bs-form-control chosen-select" name="package_activating_modules[]" data-placeholder="Activating these modules when upgraded" multiple="multiple">
              <?php foreach (Mod::$online_modules as $m) : ?>
                <option value="<?php echo $m['module']; ?>" <?php echo in_array($m['module'], $row->activating_modules) ? 'selected="selected"' : ''; ?> ><?php echo $m['text']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <small class="help-block col-sm-9 col-sm-offset-3">
            Specify which modules would be activated when this package is booked. We have modules now as:
            <ul>
              <li><strong>Medical Condition</strong> <code>medical_condition</code></li>
              <li><strong>Diagnosis</strong> <code>diagnosis</code></li>
              <li><strong>Diagnosis Archive</strong> <code>diagnosis_archive</code></li>
              <li><strong>Allergies Diagnosis</strong> <code>diagnosis_allergies</code></li>
              <li><strong>Travel Diagnosis</strong> <code>diagnosis_travels</code></li>
              <li><strong>Medication</strong> <code>medication</code></li>
              <li><strong>Documents</strong> <code>document</code></li>
              <li><strong>Vital Values</strong> <code>graphs</code></li>
              <li><strong>Vaccination</strong> <code>vaccination</code></li>
              <li><strong>iConsult</strong> <code>iconsult</code></li>
              <li><strong>eAppointment</strong> <code>reservation</code></li>
            </ul>
          </small>
        </div>

        <hr />

        <h4>Terms &amp; Services</h4>

        <div class="well well-sm">

          <!-- Nav tabs -->
          <ul class="nav nav-pills" role="tablist">
            <?php if (isset($row->terms) && is_array($row->terms) && count($row->terms) > 0) : $t_index = 0; foreach ($row->terms as $term) : ?>
              <li class="<?php echo $t_index ? '' : 'active'; ?>">
                <a href="#termsTab<?php echo $row->id; ?>_<?php echo $term->id; ?>" role="tab" data-toggle="tab">
                  <?php echo 'For '.$row->name.'<br />'.$term->name; ?>
                </a>
              </li>
            <?php $t_index++; endforeach; endif; ?>

            <li class="<?php echo isset($row->terms) && is_array($row->terms) && count($row->terms) > 0 ? '' : 'active'; ?>">
              <a href="#termsTab<?php echo $row->id; ?>_0" role="tab" data-toggle="tab">
                <span class="icomoon i-folder-plus" style="font-size:37px;"></span>
              </a>
            </li>

            <?php isset($row->terms) && is_array($row->terms) ? ($row->terms[] = new stdClass()) : ($row->terms = array(new stdClass(), )) ; ?>
          </ul>

          <hr/>

          <!-- Tab panes -->
          <div class="tab-content">
            <?php if (isset($row->terms) && is_array($row->terms) && count($row->terms) > 0) : $t_index = 0; foreach ($row->terms as $term) : ?>
              <?php
                if (!isset($term->id) || !$term->id)
                {
                  $term->id                  = 0;
                  $term->for                 = $row->id;
                  $term->name                = 'term_'.($row->id).'_'.count($row->terms);
                  $term->intro               = 'term_'.($row->id).'_'.count($row->terms);
                }
              ?>

              <div class="tab-pane fade <?php echo $t_index ? '' : 'in active'; ?>" id="termsTab<?php echo $row->id; ?>_<?php echo $term->id; ?>">
                <div data-ia24admin-role="form">

                  <input type="hidden" name="term_id[<?php echo $term->id; ?>]" value="<?php echo $term->id; ?>" />
                  <input type="hidden" name="term_for[<?php echo $term->id; ?>]" value="<?php echo $row->id; ?>" />

                  <div class="form-group">
                    <label for="packageSettingsTermID" class="col-sm-3 control-label">Term ID</label>
                    <div class="col-sm-9">
                      <p class="form-control-static"><?php echo $term->id; ?></p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="packageSettingsTermFor" class="col-sm-3 control-label">Nested Package ID</label>
                    <div class="col-sm-9">
                      <p class="form-control-static"><?php echo $row->id; ?></p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="packageSettingsTermForName" class="col-sm-3 control-label">Nested Package Name</label>
                    <div class="col-sm-9">
                      <p class="form-control-static"><?php echo $row->name; ?></p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="packageSettings<?php echo $row->id; ?>_TermName" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                      <input id="packageSettings<?php echo $row->id; ?>_TermName" type="text" class="form-control" name="term_name[<?php echo $term->id; ?>]" value="<?php echo form_prep($term->name); ?>" />
                    </div>
                    <small class="help-block col-sm-9 col-sm-offset-3">
                      This is for internal use. Would be used also for program. Be careful to choose this name, avoiding conflicts.
                    </small>
                  </div>

                  <div class="form-group">
                    <label for="packageSettings<?php echo $row->id; ?>_TermIntro" class="col-sm-3 control-label">Term Content</label>
                    <div class="col-sm-9">
                      <textarea id="packageSettings<?php echo $row->id; ?>_TermIntro" class="form-control summernote" name="term_intro[<?php echo $term->id; ?>]" rows="5" ><?php echo $term->intro; ?></textarea>
                    </div>
                  </div>

                  <hr />

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <?php if (isset($term->id) && $term->id) : ?>
                        <div class="checkbox disabled">
                          <label>
                            This term is getting updated
                            <input type="checkbox" checked="checked" disabled="disabled" />
                          </label>
                        </div>
                        <div class="checkbox">
                          <label class="bg-danger">
                            Delete This
                            <input name="term_delete[<?php echo $term->id; ?>]" value="term_delete[<?php echo $row->id; ?>]" type="checkbox" />
                          </label>
                        </div>
                      <?php else : ?>
                        <div class="checkbox">
                          <label class="bg-success">
                            Insert This
                            <input name="term_insert[<?php echo $term->id; ?>]" value="term_insert[<?php echo $row->id; ?>]" type="checkbox" />
                          </label>
                        </div>
                      <?php endif; ?>
                    </div>
                    <?php if (isset($term->id) && $term->id) : ?>
                      <small class="help-block col-sm-9 col-sm-offset-3">
                        By checking <code>Delete This</code> would get all <strong>checked terms</strong> deleted.
                      </small>
                    <?php else : ?>
                      <small class="help-block col-sm-9 col-sm-offset-3">
                        Without checking <code>Insert This</code>, the new term will not get inserted.
                      </small>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
            <?php $t_index++; endforeach; endif; ?>
          </div>

        </div>

        <hr />

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
            <?php if (isset($row->id) && $row->id) : ?>
              <button type="submit" role="submit" name="update" value="update" class="btn btn-success">Update</button>
              <button type="submit" role="submit" name="delete" value="delete" class="btn btn-danger">Delete</button>
            <?php else : ?>
              <button type="submit" role="submit" name="insert" value="insert" class="btn btn-success">Insert</button>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  <?php $index++; endforeach; endif; ?>
</div>