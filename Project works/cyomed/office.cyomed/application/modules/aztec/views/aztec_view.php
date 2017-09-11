
  <?php $all_fields = isset($all_fields) && is_array($all_fields) ? $all_fields : ( ! empty($patients) ? array_keys((array)$patients[0]) : array()); ?>
  <?php $fields = isset($fields) && is_array($fields) ? $fields : $all_fields; ?>

  <div class="col-md-12" id="patient-view">

    <div class="box box-primary box-solid">
      <div class="box-body">
        <form class="form-horizontal" method="get" action="<?php echo site_url('aztec/aztec'); ?>" enctype="application/x-www-form-urlencoded">
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
          <div class="row">
            <div class="col-md-12">
              <p>&nbsp;</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-right">
              <input type="submit" class="btn btn-block btn-primary" value="Refresh" />
            </div>
          </div>

          
        </form>
      </div>
    </div>

    <div class="box box-warning box-solid">
      <div class="box-body">
        <form class="form-horizontal" method="get" action="<?php echo site_url('aztec/aztec'); ?>" enctype="application/x-www-form-urlencoded">
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

  </div>


  <script type="text/javascript">
    typeof App !== 'undefined' && jQuery.isFunction(App.pageSetup) ? + function () {
      App.pageSetup('#patient-view');
    } () : 1;
  </script>