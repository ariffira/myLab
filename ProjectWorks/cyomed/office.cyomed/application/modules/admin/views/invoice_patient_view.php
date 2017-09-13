
  <div class="col-md-12">

    <div class="alert alert-warning">
      <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
          <label for="searchField" class="control-label col-sm-3">Select field</label>
          <div class="col-sm-9">
            <select id="searchField" name="search_field" class="form-control">
              <?php if (count($patients) > 0) : foreach ($patients[0] as $field => $value) : ?>
                <?php if (!is_array($value)) : ?>
                  <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
                <?php endif; ?>
              <?php endforeach; endif; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="searchValue" class="control-label col-sm-3">Search for value</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="searchValue" name="search_value" value="" placeholder="Search for value" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-danger btn-block">Search</button>
          </div>
        </div>
      </form>
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />

    <div class="row">
      <div class="col-md-12">

        <div class="panel-group" id="accordion">
          <?php foreach ($patients as $row) : ?>
            <?php $panel_type = 'default'; ?>
            <?php $panel_type = !isset($row->confirm_status) || !$row->confirm_status ? 'warning' : $panel_type; ?>
            <?php $panel_type = !isset($row->Dr_approv) || !$row->Dr_approv ? 'danger' : $panel_type; ?>
            <div class="panel panel-<?php echo $panel_type; ?>">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $accordion_id = $row->id ? $row->id : random_string('alnum', 16); ?>">
                    Invoice info of
                    <strong><?php echo isset($row->id) ? ($row->id.' / ') : ''; ?> <?php echo isset($row->title) ? $row->title : ''; ?> <?php echo isset($row->academic_grade) ? $row->academic_grade : ''; ?> <?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></strong>
                    <small class="text-danger"><?php echo isset($row->regid) ? $row->regid : ''; ?></small>
                    <small class="text-info"><?php echo isset($row->email) ? $row->email : ''; ?></small>
                  </a>
                </h4>
              </div>
              <div id="collapse<?php echo $accordion_id; ?>" class="panel-collapse collapse">
                <div class="panel-body">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#collapse<?php echo $accordion_id; ?>Invoice" role="tab" data-toggle="tab">Invoice log</a></li>
                    <li><a href="#collapse<?php echo $accordion_id; ?>BasicInfo" role="tab" data-toggle="tab">Basic info</a></li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="collapse<?php echo $accordion_id; ?>Invoice">

                      <div class="well well-sm">
                        <div class="panel-group" id="accordion<?php echo $accordion_id; ?>InvoiceAccordion">

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>InvoiceAccordion" href="#collapse<?php echo $accordion_id ?>InvoiceAccordionBasic">
                                  Current invoice info
                                </a>
                              </h4>
                            </div>
                            <div id="collapse<?php echo $accordion_id ?>InvoiceAccordionBasic" class="panel-collapse collapse in">
                              <div class="panel-body">
                                <h4>Current invoice info</h4>
                                <div class="row">
                                  <?php foreach ($row as $field => $value) : if(strpos($field, 'payment') !== FALSE && $field != 'payment' || in_array($field, array('package', ))) : ?>
                                    <?php if(strpos($field, 'payment') !== FALSE && $field != 'payment') : $row->$field = $value = $this->encrypt->decode($value); endif; ?>
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-sm-4" style="word-wrap: break-word;">
                                          <p class="bg-info"><?php echo $field; ?></p>
                                        </div>
                                        <div class="col-sm-8" style="word-wrap: break-word;">
                                          <?php echo $value; ?>
                                        </div>
                                      </div>
                                    </div>
                                  <?php endif; endforeach; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                          <?php if (isset($row->payment) && is_array($row->payment) && count($row->payment) > 0) : foreach ($row->payment as $payment) : ?>
                            <?php $changed_part = ''; ?>
                            <?php foreach ($payment as $field => $value) : ?>
                              <?php if(isset($row->$field) && $value != $row->$field && strpos($field, 'payment') !== FALSE && $field != 'payment') : $changed_part = 'Rechnung Info changed'; endif; ?>
                            <?php endforeach; ?>
                            <?php $changed_part .= ($row->package != $payment->package ? (($changed_part ? '' : ' & ').'Package changed') : ''); ?>
                            <?php $changed_part = $changed_part ? $changed_part : 'Nothing changed.'; ?>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>InvoiceAccordion" href="#collapse<?php echo $accordion_id ?>InvoiceAccordion<?php echo $payment->id; ?>">
                                    Invoice log on
                                    <strong><?php echo isset($payment->cdate) ? date('Y-m-d H:i:s', strtotime($payment->cdate)) : ''; ?> <?php echo isset($row->package) ? $row->package : ''; ?></strong>
                                    <small class="text-primary">Difference with current info: <strong><?php echo $changed_part; ?></strong></small>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $accordion_id ?>InvoiceAccordion<?php echo $payment->id; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                  <h4>Invoice log on <small><?php echo isset($payment->cdate) ? date('Y-m-d H:i:s', strtotime($payment->cdate)) : ''; ?> / package: <?php echo isset($row->package) ? $row->package : ''; ?></small></h4>
                                  <div class="row">
                                    <?php foreach ($payment as $field => $value) : ?>
                                      <div class="col-md-12">
                                        <div class="row">
                                          <div class="col-sm-4" style="word-wrap: break-word;">
                                            <p class="bg-<?php echo isset($row->$field) && $value != $row->$field ? 'danger' : 'info'; ?>"><?php echo $field; ?></p>
                                          </div>
                                          <div class="col-sm-8" style="word-wrap: break-word;">
                                            <?php echo $value; ?>
                                          </div>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; endif; ?>

                        </div>
                      </div>

                    </div>
                    <div class="tab-pane fade" id="collapse<?php echo $accordion_id; ?>BasicInfo">

                      <h4>Plain Info for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
                      <div class="row">
                        <?php foreach ($row as $field => $value) : ?>
                          <div class="col-md-4">
                            <div class="row">
                              <div class="col-sm-4" style="word-wrap: break-word;">
                                <p class="bg-info"><?php echo $field; ?></p>
                              </div>
                              <div class="col-sm-8" style="word-wrap: break-word;">
                                <?php if (in_array($field, Mod::$activation_fields)) : ?>
                                  <?php echo activation_field($value, $field, 'patient/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$country_fields)) : ?>
                                  <?php echo country_field($value, $field, 'patient/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$speciality_fields)) : ?>
                                  <?php echo speciality_field($value, $field, 'patient/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$access_permission_fields)) : ?>
                                  <?php echo access_permission_field($value, $field, 'patient/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$patient_package_fields)) : ?>
                                  <?php echo patient_package_field($value, $field, 'patient/update_field/'.$row->id); ?>
                                <?php else : ?>
                                  <?php echo !is_array($value) ? text_field($value, $field, 'patient/update_field/'.$row->id) : 'Array'; ?>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>

                      <h4>Modules Activation for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
                      <div class="row">
                        <?php foreach (Mod::$online_modules as $module) : $module = (object)$module; ?>
                          <div class="col-md-4">
                            <div class="row">
                              <div class="col-sm-4" style="word-wrap: break-word;">
                                <p class="bg-info"><?php echo $module->text; ?></p>
                              </div>
                              <div class="col-sm-8" style="word-wrap: break-word;">
                                <?php echo activation_field(isset($row->modules[$module->module]) && $row->modules[$module->module]->activate ? TRUE : FALSE, $module->module, 'patient/activate_module/'.$row->id); ?>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>

                      <h4>Macros for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
                      <div class="row">
                        <div class="col-md-12">
                          <p>
                            <button type="button" class="btn btn-primary">Send confirmation email</button>
                          </p>
                        </div>
                      </div>

                      <hr />

                    </div>
                  </div>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />

  </div>
