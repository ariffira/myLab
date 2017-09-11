<div class="row">

  <div class="col-md-12">
    <form role="form" id="formTerminSettings" method="post">

      <h3>Zeiträume für Terminanfragen</h3>
      <p class="help-block text-muted">Sie möchten keine konkreten Termine anbieten? Hier können Sie Zeiträume für Terminanfragen ihrer Patienten bereitstellen. Bei einer Anfrage haben Sie so die Möglichkeit, je nach Terminsituation einen konkreten Termin zu bestätigen.</p>

      <fieldset class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-5 control-label">Öffentlich Sichtbarkeit temporär deaktivieren</label>
          <div class="col-sm-7">
            <label class="radio-inline">
              <input type="radio" name="regular_termin_on" id="inputActivated1" value="1" <?php echo $this->mod->user_radio('regular_termin_on', '1'); ?> > Nein
            </label>
            <label class="radio-inline">
              <input type="radio" name="regular_termin_on" id="inputActivated0" value="0" <?php echo $this->mod->user_radio('regular_termin_on', '0'); ?> > Ja
            </label>
          </div>
        </div>
      </fieldset>

      <fieldset class="form-horizontal">
        <!-- Nav pills -->
        <ul class="nav nav-pills" role="tablist">
          <?php for ($index = 0, $day_label = array('Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag', ); $index < 7; $index++) : ?>
            <li class="<?php echo $index == 0 ? 'active' : ''; ?>">
              <a href="#tabDay<?php echo $index + 1; ?>" role="tab" data-toggle="tab"><?php echo $day_label[$index]; ?></a>
            </li>
          <?php endfor; ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <?php for ($index = 0, $day_label = array('Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag', ); $index < 7; $index++) : ?>
            <div class="tab-pane fade <?php echo $index == 0 ? 'in active' : ''; ?>" id="tabDay<?php echo $index + 1; ?>" data-day="<?php echo $index + 1; ?>">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Zeiträume für <strong><?php echo $day_label[$index]; ?></strong></h3>
                </div>
                <div class="panel-body">
                  <?php
                    $output_termins = array();
                    foreach ($this->mod->user()->regular_termins as $row) {
                      if ($row->day == $index + 1) {
                        $output_termins[] = $row;
                      } else {
                        continue;
                      }
                    }
                  ?>
                  <input type="hidden" class="regular-termins-count" name="regular_termins_count[<?php echo $index + 1; ?>]" value="<?php echo count($output_termins); ?>" />
                  <?php $em = FALSE; ?>
                  <?php foreach ($output_termins as $row) : ?>
                    <div class="form-group" data-regular-termin-id="<?php echo $row->id; ?>">
                      <div class="col-sm-2 form-inline text-right">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="input-termin-ready" name="ready[<?php echo $row->id; ?>]" value="1" <?php echo $row->ready ? ' checked="checked" ' : ''; ?> > Öffentlich sichtbar
                        </label>
                      </div>
                      <div class="col-sm-3 form-inline text-center">
                        <!-- <select class="form-control select-termin-start" name="termin_start[<?php echo $row->id; ?>]" id="selectTerminStart<?php echo $row->id; ?>">
                          <?php for ($i = 5; $i <= 23; $i++) : ?>
                            <option value="<?php echo $i; ?>" <?php echo date('H', strtotime($row->start)) == $i ? ' selected="selected" ' : ''; ?> ><?php printf('%02d:00 ', $i); ?></option>
                          <?php endfor; ?>
                        </select>
                        :
                        <select class="form-control select-termin-dur" name="termin_dur[<?php echo $row->id; ?>]" id="selectTerminDuration<?php echo $row->id; ?>">
                          <?php for ($i = 10; $i <= 90; $i+=5) : ?>
                            <option value="<?php echo $i; ?>" <?php echo $i * 60 == strtotime($row->end) - strtotime($row->start) ? ' selected="selected" ' : '' ; ?> ><?php echo $i.' Minuten'; ?></option>
                          <?php endfor; ?>
                        </select> -->
                        <input type="text" name="termin_start[<?php echo $row->id; ?>]" id="termin_start[<?php echo $row->id; ?>]" class="form-control time-picker" value="<?php echo date('H:i', strtotime($row->start)); ?>" style="width:90px;" />
                        -
                        <input type="text" name="termin_end[<?php echo $row->id; ?>]" id="termin_end[<?php echo $row->id; ?>]" class="form-control time-picker" value="<?php echo date('H:i', strtotime($row->end)); ?>" style="width:90px;" />
                      </div>
                      <div class="col-sm-5 form-inline text-center">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="input-termin-insurance" name="insurance[<?php echo $row->id; ?>][]" value="1" <?php echo $row->insurance_private ? ' checked="checked" ' : ''; ?> > Privat versichert / Selbstzahler
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" class="input-termin-insurance" name="insurance[<?php echo $row->id; ?>][]" value="2" <?php echo $row->insurance_public ? ' checked="checked" ' : ''; ?> > Gesetzlich versichert
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" class="input-termin-single" name="single[<?php echo $row->id; ?>]" value="0" <?php echo $row->insurance_public || $row->insurance_private ? '' : ' checked="checked" '; ?> > Eingene Belegung
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" class="input-termin-mask" name="mask[<?php echo $row->id; ?>]" value="1" <?php echo $row->mask ? ' checked="checked" ' : ''; ?> > Schließzeiten
                        </label>
                      </div>
                      <div class="col-sm-2 text-center">
                        <button type="button" class="btn btn-danger btn-sm button-regular-termin-remove"><span class="icomoon i-close-3"></span> Löschen</button>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <input type="hidden" class="regular-termins-added" name="regular_termins_added[<?php echo $index + 1; ?>]" value="0" data-day="<?php echo $index + 1; ?>" />
                  <div class="form-group hidden form-group-termin-wrapper">
                    <div class="col-sm-2 form-inline text-right">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="input-termin-ready" value="1" > Öffentlich sichtbar
                      </label>
                    </div>
                    <div class="col-sm-3 form-inline text-center">
                      <!-- <select class="form-control select-termin-start">
                        <?php for ($i = 5; $i <= 23; $i++) : ?>
                          <option value="<?php echo $i; ?>" <?php echo $i === 9 ? ' selected="selected" ' : ''; ?> ><?php printf('%02d:00', $i); ?></option>
                        <?php endfor; ?>
                      </select>
                      :
                      <select class="form-control select-termin-dur">
                        <?php for ($i = 10; $i <= 90; $i+=5) : ?>
                          <option value="<?php echo $i; ?>" <?php echo $i === 30 ? ' selected="selected" ' : ''; ?> ><?php echo $i.' Minuten'; ?></option>
                        <?php endfor; ?>
                      </select> -->
                      <input type="text" class="form-control select-termin-start time-picker" value="9:00" style="width:90px;" />
                      -
                      <input type="text" class="form-control select-termin-end time-picker" value="9:30" style="width:90px;" />
                    </div>
                    <div class="col-sm-5 form-inline text-center">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="input-termin-insurance" value="1" > Privat versichert / Selbstzahler
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" class="input-termin-insurance" value="2" > Gesetzlich versichert
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" class="input-termin-single" value="0" > Eingene Belegung
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" class="input-termin-mask" value="1" > Schließzeiten
                      </label>
                    </div>
                    <div class="col-sm-2 text-center">
                      <button type="button" class="btn btn-danger btn-sm button-regular-termin-remove"><span class="icomoon i-close-3"></span> Löschen</button>
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
            </div>
          <?php endfor; ?>
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