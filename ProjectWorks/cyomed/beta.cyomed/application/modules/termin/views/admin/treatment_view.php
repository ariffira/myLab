<div class="row">

  <div class="col-md-12">
    <form role="form" id="formTerminSettings" method="post">

      <h3>Behandlungseinstellungen für Termine</h3>
      <p class="help-block text-muted">Lorem ipsum Nisi ad commodo culpa dolore magna dolor in voluptate nostrud sunt proident proident mollit non ut consectetur incididunt dolor esse tempor aliqua tempor sint consequat nisi voluptate velit eiusmod occaecat in consectetur consequat nisi ut esse ullamco.</p>

      <fieldset class="form-horizontal">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Behandlungseinstellungen für Termine</h3>
          </div>
          <div class="panel-body">
            <?php $index = 1; foreach ($this->mod->user()->specs_assoc as $speciality) : ?>
              <?php foreach ($speciality->treatment as $treatment) : ?>
                <div class="form-group form-group-termin-wrapper">
                  <div class="col-md-6 col-sm-4 form-inline text-left">
                    <label for="inputTreatmentName" class="form-control-static hidden-sm" style="width:48%;min-width:213px;"><?php echo $index.'.'; ?>&nbsp;<?php echo $speciality->name; ?></label>
                    <input type="text" class="form-control input-treatment-name" style="width:48%;min-width:213px;" id="inputTreatmentName" placeholder="Benutzerdefinierten Namen">
                  </div>
                  <div class="col-md-3 col-sm-4 text-left">
                    <select class="select-termin-start chosen-select bs-form-control">
                      <?php foreach ($this->mod->user()->specs_assoc as $row) : ?>
                        <optgroup label="<?php echo $row->name; ?>">
                          <option value="<?php echo $row->code; ?>,0">..allgemeinen Termin</option>
                          <?php foreach ($row->treatment as $t) : ?>
                            <option value="<?php echo $row->code; ?>,<?php echo $t->code; ?>" <?php echo $treatment->code == $t->code ? 'selected="selected"' : ''; ?> ><?php echo $t->name; ?></option>
                          <?php endforeach; ?>
                        </optgroup>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-3 text-left">
                    <select class="form-control select-termin-dur">
                      <?php for ($i = 10; $i <= 90; $i+=5) : ?>
                        <option value="<?php echo $i; ?>" <?php echo $i === 30 ? ' selected="selected" ' : ''; ?> ><?php echo $i.' Minuten'; ?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="col-sm-1 text-left">
                    <button type="button" class="btn btn-warning button-regular-termin-remove"><span class="icomoon i-switch"></span></button>
                    <!-- <button type="button" class="btn btn-success button-regular-termin-remove"><span class="icomoon i-checkmark-circle-2"></span></button> -->
                  </div>
                </div>
              <?php $index++; endforeach; ?>
            <?php endforeach; ?>
            <div class="form-group form-group-termin-wrapper hidden">
              <div class="col-md-6 col-sm-4 form-inline text-left">
                <label for="inputTreatmentName" class="form-control-static hidden-sm" style="width:48%;min-width:213px;">Benutzerdefinierten&nbsp;Namen</label>
                <input type="text" class="form-control input-treatment-name" style="width:48%;min-width:213px;" id="inputTreatmentName" placeholder="Benutzerdefinierten Namen">
              </div>
              <div class="col-md-3 col-sm-4 form-inline text-left">
                <select class="form-control select-termin-start">
                  <?php foreach ($this->mod->user()->specs_assoc as $row) : ?>
                    <optgroup label="<?php echo $row->name; ?>">
                      <option value="<?php echo $row->code; ?>,0">..allgemeinen Termin</option>
                      <?php foreach ($row->treatment as $t) : ?>
                        <option value="<?php echo $row->code; ?>,<?php echo $t->code; ?>"><?php echo $t->name; ?></option>
                      <?php endforeach; ?>
                    </optgroup>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-2 col-sm-3 form-inline text-left">
                <select class="form-control select-termin-dur">
                  <?php for ($i = 10; $i <= 90; $i+=5) : ?>
                    <option value="<?php echo $i; ?>" <?php echo $i === 30 ? ' selected="selected" ' : ''; ?> ><?php echo $i.' Minuten'; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="col-sm-1 text-left">
                <button type="button" class="btn btn-warning button-regular-termin-remove"><span class="icomoon i-switch"></span></button>
                <!-- <button type="button" class="btn btn-success button-regular-termin-remove"><span class="icomoon i-checkmark-circle-2"></span></button> -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">&nbsp;</label>
              <div class="col-sm-9 form-inline">
                <button type="button" class="btn btn-success button-regular-termin-add"><span class="icomoon i-plus-circle-2"></span> Hinzufügen</button>
              </div>
            </div>
          </div>
          <!-- <div class="panel-footer">Panel footer</div> -->
        </div>

      </fieldset>

      <hr/>

      <fieldset class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">&nbsp;</label>
          <div class="col-sm-9">
            <button type="submit" class="btn btn-primary">Speichern</button>
          </div>
        </div>
      </fieldset>

    </form>
  </div>
</div>