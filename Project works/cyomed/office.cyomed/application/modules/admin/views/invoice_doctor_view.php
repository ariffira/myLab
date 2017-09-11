
  <div class="col-md-12">

    <div class="box box-warning box-solid">
    <div class="box-body">
      <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
          <label for="searchField" class="control-label col-sm-3">Select field</label>
          <div class="col-sm-9">
            <select id="searchField" name="search_field" class="form-control">
              <?php if (count($doctors) > 0) : foreach ($doctors[0] as $field => $value) : ?>
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
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />

    <div class="row">
      <div class="col-md-12">

        <div class="panel-group" id="accordion">
          <?php foreach ($doctors as $row) : ?>
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
                    <li class="active"><a href="#collapse<?php echo $accordion_id; ?>InvoiceGeneration" role="tab" data-toggle="tab">Invoice generation</a></li>
                    <li class="      "><a href="#collapse<?php echo $accordion_id; ?>Invoice" role="tab" data-toggle="tab">Invoice log</a></li>
                    <li class="      "><a href="#collapse<?php echo $accordion_id; ?>BasicInfo" role="tab" data-toggle="tab">Basic info</a></li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="collapse<?php echo $accordion_id; ?>InvoiceGeneration">

                      <div class="well well-sm well-topless">
                        <div class="panel-group" id="accordion<?php echo $accordion_id; ?>InvoiceGenerationAccordion">

                          <?php if (isset($row->invoice) && is_array($row->invoice) && count($row->invoice) > 0) : foreach ($row->invoice as $invoices_index => $invoices) : ?>
                            <?php if (!is_array($invoices) || count($invoices) <= 0) : continue; endif; ?>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>InvoiceGenerationAccordion" href="#collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>">
                                    Invoice log from
                                    <strong><?php echo isset($invoices[count($invoices) - 1]->cdate) ? date('Y-m-d H:i:s', strtotime($invoices[count($invoices) - 1]->cdate)) : ''; ?></strong>
                                    to
                                    <strong><?php echo isset($invoices[0]->cdate) ? date('Y-m-d H:i:s', strtotime($invoices[0]->cdate)) : ''; ?></strong>
                                    <small class="text-danger">Package: <strong><?php echo isset($invoices[count($invoices) - 1]->package) && $invoices[count($invoices) - 1]->package ? $invoices[count($invoices) - 1]->package : 'free'; ?></strong></small>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>" class="panel-collapse collapse">

                                <div class="well-sm">
                                  <div class="panel-group" id="collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>Subs">

                                    <?php $this->lang->load('payment'); ?>
                                    <?php if (isset($invoices) && is_array($invoices) && count($invoices) > 0) : foreach ($invoices as $invoice_index => $invoice) : ?>
                                      <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>Subs" href="#collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>Subs<?php echo $invoice->id; ?>">
                                              Invoice log on
                                              <strong><?php echo isset($invoice->cdate) ? date('Y-m-d H:i:s', strtotime($invoice->cdate)) : ''; ?></strong>
                                              <small class="text-danger">Package: <strong><?php echo isset($invoice->package) && $invoice->package ? $invoice->package : 'free'; ?></strong></small>
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapse<?php echo $accordion_id ?>InvoiceGenerationAccordion<?php echo $invoices_index; ?>Subs<?php echo $invoice->id; ?>" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <h4>Invoice log on <small><?php echo isset($invoice->cdate) ? date('Y-m-d H:i:s', strtotime($invoice->cdate)) : ''; ?> / package: <?php echo isset($row->package) ? $row->package : ''; ?></small></h4>
                                            <div class="row">
                                              <?php foreach ($invoice as $field => $value) : ?>
                                                <?php if (!is_string($value)) : continue; endif; ?>
                                                <div class="col-md-12">
                                                  <div class="row">
                                                    <div class="col-sm-4" style="word-wrap: break-word;">
                                                      <p class="bg-<?php echo isset($row->$field) && $value != $row->$field ? 'danger' : 'info'; ?>"><?php echo $this->lang->line($field) ? $this->lang->line($field) : ($this->lang->line('payment_'.$field) ? $this->lang->line('payment_'.$field) : $field); ?></p>
                                                    </div>
                                                    <div class="col-sm-8" style="word-wrap: break-word;">
                                                      <?php echo $value; ?>
                                                    </div>
                                                  </div>
                                                </div>
                                              <?php endforeach; ?>
                                            </div>
                                            <?php if(isset($invoice->meta) && is_array($invoice->meta)): ?>
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <h4>Payone Meta values</h4>
                                                  <div class="well well-sm">
                                                    <?php foreach ($invoice->meta as $meta) : ?>
                                                      <div class="row">
                                                        <?php $meta_field = $this->encrypt->decode($meta->key); ?>
                                                        <?php $meta_value = $this->encrypt->decode($meta->value); ?>
                                                        <div class="col-sm-4" style="word-wrap: break-word;">
                                                          <p class="bg-primary"><?php echo $meta_field; ?></p>
                                                        </div>
                                                        <div class="col-sm-8" style="word-wrap: break-word;">
                                                          <?php echo $meta_value; ?>
                                                        </div>                                                        
                                                      </div>
                                                    <?php endforeach; ?>
                                                  </div>
                                                </div>
                                              </div>
                                            <?php endif; ?>
                                          </div>

                                          <?php if ($invoice_index < count($invoices) - 1) : ?>
                                            <div class="panel-body">
                                              <h4>Macros</h4>
                                              <hr />
                                              <h5>Generate invoice</h5>
                                              <form class="form" role="form" action="<?php echo site_url('admin/invoice/generate'); ?>" method="post">
                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice->id; ?>" />
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <p class="">package</p>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <select class="form-control" name="invoice_package">
                                                        <?php !isset($packages) ? ($packages = $this->mopack->get_list()) : NULL; ?>
                                                        <?php foreach ($packages as $package) : ?>
                                                          <option value="<?php echo $package->name; ?>" <?php echo $invoice->package == $package->name ? 'selected="selected"' : ''; ?> ><?php echo $package->name; ?></option>
                                                        <?php endforeach; ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <p class="">from</p>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <p class="">to</p>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <input class="form-control" type="date" name="invoice_start_date" value="<?php echo date('Y-m-d', strtotime($invoices[$invoice_index + 1]->cdate)); ?>" />
                                                    </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <input class="form-control" type="time" name="invoice_start_time" value="<?php echo date('H:i:s', strtotime($invoices[$invoice_index + 1]->cdate)); ?>" />
                                                    </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <input class="form-control" type="date" name="invoice_end_date" value="<?php echo date('Y-m-d', strtotime($invoice->cdate)); ?>" />
                                                    </div>
                                                  </div>
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <input class="form-control" type="time" name="invoice_end_time" value="<?php echo date('H:i:s', strtotime($invoice->cdate)); ?>" />
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <button class="btn btn-primary" type="submit">Generate</button>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          <?php endif; ?>
                                        </div>
                                      </div>

                                    <?php endforeach; endif; ?>

                                  </div>
                                </div>

                              </div>
                            </div>
                          <?php endforeach; endif; ?>

                        </div>
                      </div>

                    </div>
                    <div class="tab-pane fade" id="collapse<?php echo $accordion_id; ?>Invoice">

                      <div class="well well-sm well-topless">
                        <div class="panel-group" id="accordion<?php echo $accordion_id; ?>InvoiceAccordion">

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>InvoiceAccordion" href="#collapse<?php echo $accordion_id ?>InvoiceAccordionBasic">
                                  Current invoice info
                                  <small class="text-danger">Package: <strong><?php echo isset($row->package) && $row->package ? $row->package : 'free'; ?></strong></small>
                                </a>
                              </h4>
                            </div>
                            <div id="collapse<?php echo $accordion_id ?>InvoiceAccordionBasic" class="panel-collapse collapse in">
                              <div class="panel-body">
                                <h4>
                                  Current invoice info
                                  <small class="text-danger">Package: <strong><?php echo isset($row->package) && $row->package ? $row->package : 'free'; ?></strong></small>
                                </h4>
                                <div class="row">
                                  <?php $this->lang->load('payment'); ?>
                                  <?php foreach ($row as $field => $value) : if(strpos($field, 'payment') !== FALSE && $field != 'payment' || in_array($field, array('package', ))) : ?>
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-sm-4" style="word-wrap: break-word;">
                                          <p class="bg-info"><?php echo $this->lang->line($field) ? $this->lang->line($field) : ($this->lang->line('payment_'.$field) ? $this->lang->line('payment_'.$field) : $field); ?></p>
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
                            <?php $changed_part .= ($row->package != $payment->package ? (($changed_part ? ' & ' : '').'Package changed') : ''); ?>
                            <?php $changed_part = $changed_part ? $changed_part : 'Nothing changed.'; ?>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion<?php echo $accordion_id; ?>InvoiceAccordion" href="#collapse<?php echo $accordion_id ?>InvoiceAccordion<?php echo $payment->id; ?>">
                                    Invoice log on
                                    <strong><?php echo isset($payment->cdate) ? date('Y-m-d H:i:s', strtotime($payment->cdate)) : ''; ?></strong>
                                    <small class="text-danger">Package: <strong><?php echo isset($payment->package) && $payment->package ? $payment->package : 'free'; ?></strong></small>
                                    <small class="text-primary">Difference with current info: <strong><?php echo $changed_part; ?></strong></small>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $accordion_id ?>InvoiceAccordion<?php echo $payment->id; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                  <h4>Invoice log on <small><?php echo isset($payment->cdate) ? date('Y-m-d H:i:s', strtotime($payment->cdate)) : ''; ?> / package: <?php echo isset($row->package) ? $row->package : ''; ?></small></h4>
                                  <div class="row">
                                    <?php $this->lang->load('payment'); ?>
                                    <?php foreach ($payment as $field => $value) : ?>
                                      <div class="col-md-12">
                                        <div class="row">
                                          <div class="col-sm-4" style="word-wrap: break-word;">
                                            <p class="bg-<?php echo isset($row->$field) && $value != $row->$field ? 'danger' : 'info'; ?>"><?php echo $this->lang->line($field) ? $this->lang->line($field) : ($this->lang->line('payment_'.$field) ? $this->lang->line('payment_'.$field) : $field); ?></p>
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
                                  <?php echo activation_field($value, $field, 'doctor/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$country_fields)) : ?>
                                  <?php echo country_field($value, $field, 'doctor/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$speciality_fields)) : ?>
                                  <?php echo speciality_field($value, $field, 'doctor/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$access_permission_fields)) : ?>
                                  <?php echo access_permission_field($value, $field, 'doctor/update_field/'.$row->id); ?>
                                <?php elseif (in_array($field, Mod::$patient_package_fields)) : ?>
                                  <?php echo doctor_package_field($value, $field, 'doctor/update_field/'.$row->id); ?>
                                <?php else : ?>
                                  <?php echo !is_array($value) ? text_field($value, $field, 'doctor/update_field/'.$row->id) : 'Array'; ?>
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
                                <?php echo activation_field(isset($row->modules[$module->module]) && $row->modules[$module->module]->activate ? TRUE : FALSE, $module->module, 'doctor/activate_module/'.$row->id); ?>
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
