
  <?php $all_fields = isset($all_fields) && is_array($all_fields) ? $all_fields : ( ! empty($patients) ? array_keys((array)$patients[0]) : array()); ?>
  <?php $fields = isset($fields) && is_array($fields) ? $fields : $all_fields; ?>

  <div class="col-md-12" id="patient-view">

    <div class="box box-danger box-solid">
      <div class="box-body">
        <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
          <div class="row">
            <?php if ( ! empty($all_fields) ) : foreach ($all_fields as $field) : ?>
              <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="field_<?php echo $field ?>" <?php echo in_array($field, $fields) ? 'checked="checked"' : ''; ?> />
                    <?php echo $field; ?>
                  </label>
                </div>
              </div>
            <?php endforeach; endif; ?>
          </div>
        </form>
      </div>
    </div>

    <div class="box box-warning box-solid">
      <div class="box-body">
        <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
          <div class="form-group">
            <label for="searchField" class="control-label col-sm-3">Search field</label>
            <div class="col-sm-9">
              <select id="searchField" name="search_field" class="form-control">
                <?php if ( ! empty($fields) ) : foreach ($fields as $field) : ?>
                  <option value="<?php echo $field; ?>" <?php echo $this->input->get('search_field') == $field ? 'selected="selected"' : ''; ?> ><?php echo $field; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="searchValue" class="control-label col-sm-3">Search for value</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="searchValue" name="search_value" value="<?php echo $this->input->get('search_value') ? form_prep($this->input->get('search_value')) : ''; ?>" placeholder="Search for value" />
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

    <div class="box">
      <div class="table-responsive box-body" style="overflow:auto;">
        <table class="table table-condensed table-hover table-striped">
          <thead>
            <?php if ( ! empty($fields) ) : foreach ($fields as $field) : ?>
              <th>
                <?php echo $field; ?>
              </th>
            <?php endforeach; endif; ?>
          </thead>
          <tbody>
            <?php foreach ($patients as $row) : ?>
              <!-- <tr onclick="javascript:window.location='<?php echo site_url('admin/patient/entry/'.$row->id); ?>';"> -->
              <tr>
                <?php if ( ! empty($fields) ) : foreach ($fields as $field) : ?>
                  <td>
                    <?php if (isset($row->{$field})) : ?>
                      <?php echo !is_array($row->{$field}) ? $row->{$field} : 'Array'; ?>
                    <?php endif; ?>
                  </td>
                <?php endforeach; endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />
          
    <?php foreach ($patients as $row) : ?>

      <div class="box">
        <div class="row box-body">
          <div class="col-md-12">

            <h4>Plain Info for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
            <div class="row">
              <?php if ( ! empty($fields) ) : foreach ($fields as $field) : ?>
                <div class="col-md-4">
                  <?php if (isset($row->{$field})) : $value = $row->{$field}; ?>
                    <div class="row">
                      <div class="col-sm-4" style="word-wrap: break-word;">
                        <p class="bg-info"><?php echo $field; ?></p>
                      </div>
                      <div class="col-sm-8 text-right" style="word-wrap: break-word;">
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
                  <?php endif; ?>
                </div>
              <?php endforeach; endif; ?>
            </div>
            <hr />

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
            <hr />

            <h4>Macros for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
            <div class="row">
              <div class="col-md-12">
                <p>
                  <button type="button" class="btn btn-primary">Send confirmation email</button>
                  <?php if($row->login_attempt>=3 && $row->blocked_time>date('Y-m-d H:s:i')):?>
                  	<a href="<?php echo site_url('admin/patient/activate_account/'.$row->id); ?>" class="btn btn-primary" style="margin-left: 10px;">Activate Account</a>
                  <?php endif;?>
                </p>
              </div>
            </div>
            <hr />

            <div class="row">
              <div class="col-md-3">
                <p>
                  From <input type="date" name="from" class="form-control" value="<?php echo date('Y-m-d', time() - 86400 * 30); ?>" />
                </p>
              </div>
              <div class="col-md-3">
                <p>
                  to <input type="date" name="to" class="form-control" value="<?php echo date('Y-m-d', time()); ?>" />
                </p>
              </div>
              <div class="col-md-6">
                <p>
                  <br/>
                  <button type="button" class="btn btn-danger">Generate invoice</button>
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- <div class="box box-priramy"></div> -->
      <hr/>

    <?php endforeach; ?>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

  </div>


  <script type="text/javascript">
    App && App.pageSetup && jQuery && jQuery.isFunction && jQuery.isFunction(App.pageSetup) ? + function () {
      App.pageSetup('#patient-view');
    } () : 1;
  </script>