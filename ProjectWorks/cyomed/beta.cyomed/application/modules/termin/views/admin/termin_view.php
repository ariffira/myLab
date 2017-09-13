<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <h3>Neueste Termine</h3>
        <blockquote>
          <p><small>Hier sehen Sie neu eingegangene Terminbuchungen. Mit Klick auf den Haken bestätigen Sie, dass Sie den neuen Termin registriert haben.</small></p>
        </blockquote>
        <div class="well-sm">
          <table class="table table-condensed table-hover table-striped">
            <thead>
              <tr>
                <th class="warning">Ungelesen</th>
                <th class="danger">Privat versichert</th>
                <th class="info">Gesetzlich versichert</th>
                <th>Allgemein</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <?php if (isset($unread) && is_array($unread) && count($unread) > 0) : ?>
            <table class="table table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Datum</th>
                  <th>Zeit</th>
                  <th>Patient</th>
                  <th>Nachbearbeitung</th>
                </tr>
              </thead>
              <tbody>
                
                <?php foreach ($unread as $row) : ?>
                  <tr>
                    <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                      <input type="checkbox" class="checked-reservation" name="checked_reservation[<?php echo $row->id; ?>]" value="1">
                    </td>
                    <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('d.m.Y', strtotime($row->start)); ?></td>
                    <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('H:i', strtotime($row->start)); ?></td>
                    <td class="<?php echo $row->insurance ? ($row->insurance == '1' ? 'danger' : 'info') : ''; ?>"><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></td>
                    <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                      <?php if (!$row->read) : ?>
                        <button class="btn btn-default" rel="tooltip" data-toggle="tooltip" data-placement="top" title="gelesen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='read']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-envelop-opened"></span></button>
                      <?php endif; ?>
                      <button class="btn btn-info" rel="popover" data-toggle="popover" title="Termin <?php echo date('H:i d.m.Y', strtotime($row->start)); ?>" data-content="
                      <?php if ($row->start < $row->end) : ?>
                        <h4>Dauer <small><?php echo (strtotime($row->end) - strtotime($row->start)) / 60; ?> Minuten</small></h4>
                      <?php endif; ?>
                      <h4>Patient <small><?php echo form_prep($row->first_name); ?> <?php echo form_prep($row->last_name); ?></small></h4>
                      <h4>Anrede <small><?php echo $row->gender == '1' ? 'Frau' : 'Herr'; ?></small></h4>
                      <h4>Email <small><?php echo form_prep($row->email); ?></small></h4>
                      <h4>Mobil <small><?php echo form_prep($row->telephone); ?></small></h4>
                      <?php if ($row->insurance) : ?> <h4>Versicherungsart <small><?php echo $row->insurance == '1' ? 'privat' : 'gesetzlich'; ?></small></h4> <?php endif; ?>
                      <?php if ($row->treatment && is_array($row->treatment)) : ?>
                        <h4>
                          Behandlungsgrund
                          <small>
                            <br/><?php echo isset($row->treatment[0]) && $row->treatment[0] ? form_prep($row->treatment[0]) : ''; ?>
                            <br/><?php echo isset($row->treatment[1]) && $row->treatment[1] ? form_prep($row->treatment[1]) : ''; ?>
                          </small>
                        </h4>
                      <?php endif; ?>
                      <h4>Notizen <small><?php echo form_prep($row->text_patient_notes); ?></small></h4>
                      "><span class="icomoon i-info-2"></span></button>
                      <?php if (!$row->accept) : ?>
                        <button class="btn btn-success" rel="tooltip" data-toggle="tooltip" data-placement="top" title="akzeptieren" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='accept']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-checkmark-circle-2"></span></button>
                      <?php endif; ?>
                      <button class="btn btn-warning dialog-open-bearbeiten" rel="tooltip" data-toggle="tooltip" data-bearbeiten-id="<?php echo $row->id; ?>" data-placement="top" title="bearbeiten"><span class="icomoon i-tools"></span></button>
                      <button class="btn btn-danger" rel="tooltip" data-toggle="tooltip" data-placement="top" title="archivieren" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='archive']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-box-add"></span></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <button class="btn btn-default" ia-action="reservation-action" data-action="read"><span class="icomoon i-envelop-opened"></span> Als gelesen markieren</button>
            <button class="btn btn-success" ia-action="reservation-action" data-action="accept"><span class="icomoon i-checkmark-circle-2"></span> Akzeptieren</button>
            <button class="btn btn-danger" ia-action="reservation-action" data-action="archive"><span class="icomoon i-box-add"></span> Archivieren</button>
          <?php else : ?>
            <table class="table table-condensed table-hover table-striped text-center"><thead><tr><th class="text-center text-muted"><small>IhrArzt24</small></th></tr></thead><tbody><tr><td>Keine neueste Termine</td></tr></tbody></table>
          <?php endif; ?>
        </div>
        <hr />
      </div>
    </div>
    <?php if (!empty($display_feedback)) : ?>
      <div class="row">
        <div class="col-md-12">
          <h3>Bewertungen freischalten</h3>
          <blockquote>
            <p><small>Hier sehen Sie vergangene Termine. Sobald Sie einen Termin als stattgefunden speichern, erhält der Patient eine E-Mail mit der Aufforderung zur Bewertung (sofern Sie Bewertungen in Ihrem Profil zulassen). Zugleich wandert der Termin ins Archiv.</small></p>
          </blockquote>
          <div class="well-sm">

            <?php if (isset($past) && is_array($past) && count($past) > 0) : ?>
              <table class="table table-condensed table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Datum</th>
                    <th>Zeit</th>
                    <th>Patient</th>
                    <th>Nachbearbeitung</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php foreach ($past as $row) : ?>
                    <tr>
                      <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                        <input type="checkbox" class="checked-reservation" name="checked_reservation[<?php echo $row->id; ?>]" value="1">
                      </td>
                      <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('d.m.Y', strtotime($row->start)); ?></td>
                      <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('H:i', strtotime($row->start)); ?></td>
                      <td class="<?php echo $row->insurance ? ($row->insurance == '1' ? 'danger' : 'info') : ''; ?>"><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></td>
                      <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                        <?php if (!$row->read) : ?>
                          <button class="btn btn-default" rel="tooltip" data-toggle="tooltip" data-placement="top" title="gelesen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='read']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-envelop-opened"></span></button>
                        <?php endif; ?>
                        <button class="btn btn-info" rel="popover" data-toggle="popover" title="Termin <?php echo date('H:i d.m.Y', strtotime($row->start)); ?>" data-content="
                        <?php if ($row->start < $row->end) : ?>
                          <h4>Dauer <small><?php echo (strtotime($row->end) - strtotime($row->start)) / 60; ?> Minuten</small></h4>
                        <?php endif; ?>
                        <h4>Patient <small><?php echo form_prep($row->first_name); ?> <?php echo form_prep($row->last_name); ?></small></h4>
                        <h4>Anrede <small><?php echo $row->gender == '1' ? 'Frau' : 'Herr'; ?></small></h4>
                        <h4>Email <small><?php echo form_prep($row->email); ?></small></h4>
                        <h4>Mobil <small><?php echo form_prep($row->telephone); ?></small></h4>
                        <?php if ($row->insurance) : ?> <h4>Versicherungsart <small><?php echo $row->insurance == '1' ? 'privat' : 'gesetzlich'; ?></small></h4> <?php endif; ?>
                        <?php if ($row->treatment && is_array($row->treatment)) : ?>
                          <h4>
                            Behandlungsgrund
                            <small>
                              <br/><?php echo isset($row->treatment[0]) && $row->treatment[0] ? form_prep($row->treatment[0]) : ''; ?>
                              <br/><?php echo isset($row->treatment[1]) && $row->treatment[1] ? form_prep($row->treatment[1]) : ''; ?>
                            </small>
                          </h4>
                        <?php endif; ?>
                        <h4>Notizen <small><?php echo form_prep($row->text_patient_notes); ?></small></h4>
                        "><span class="icomoon i-info-2"></span></button>
                        <?php if (!$row->accept) : ?>
                          <button class="btn btn-success" rel="tooltip" data-toggle="tooltip" data-placement="top" title="akzeptieren" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='accept']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-checkmark-circle-2"></span></button>
                        <?php endif; ?>
                        <button class="btn btn-warning dialog-open-bearbeiten" rel="tooltip" data-toggle="tooltip" data-bearbeiten-id="<?php echo $row->id; ?>" data-placement="top" title="bearbeiten"><span class="icomoon i-tools"></span></button>
                        <button class="btn btn-danger" rel="tooltip" data-toggle="tooltip" data-placement="top" title="archivieren" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='archive']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-box-add"></span></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <button class="btn btn-default" ia-action="reservation-action" data-action="read"><span class="icomoon i-envelop-opened"></span> Als gelesen markieren</button>
              <button class="btn btn-success" ia-action="reservation-action" data-action="accept"><span class="icomoon i-checkmark-circle-2"></span> Akzeptieren</button>
              <button class="btn btn-danger" ia-action="reservation-action" data-action="archive"><span class="icomoon i-box-add"></span> Archivieren</button>
            <?php else : ?>
              <table class="table table-condensed table-hover table-striped text-center"><thead><tr><th class="text-center text-muted"><small>IhrArzt24</small></th></tr></thead><tbody><tr><td>Keine Termine</td></tr></tbody></table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <h3>Anstehende Termine <button class="btn btn-success btn-xs dialog-new-appointment"><span class="icomoon i-plus-circle"></span> Neu Termin</button></h3>
    <blockquote>
      <p><small>Hier sehen Sie Ihre aktuellen Termine.</small></p>
    </blockquote>

    <?php
      $tabs = array(
        (object) array(
          'tabId' => 'tabDay',
          'tabLabel' => 'Tag',
          'tabArray' => $accepted_filtered->day,
          'active' => TRUE, 
        ),
        (object) array(
          'tabId' => 'tabWorkdays',
          'tabLabel' => 'Arbeitswoche',
          'tabArray' => $accepted_filtered->workdays,
          'active' => FALSE, 
        ),
        (object) array(
          'tabId' => 'tabWeek',
          'tabLabel' => 'Woche',
          'tabArray' => $accepted_filtered->week,
          'active' => FALSE, 
        ),
        (object) array(
          'tabId' => 'tabMonth',
          'tabLabel' => 'Monat',
          'tabArray' => $accepted_filtered->month,
          'active' => FALSE, 
        ),
        (object) array(
          'tabId' => 'tabLater',
          'tabLabel' => 'Spätere',
          'tabArray' => $accepted_filtered->later,
          'active' => FALSE, 
        ),
        (object) array(
          'tabId' => 'tabOverview',
          'tabLabel' => 'Übersicht',
          'tabArray' => $accepted_filtered->overview,
          'active' => FALSE, 
        ),
      );
    ?>

    <!-- Nav pills -->
    <ul class="nav nav-pills" role="tablist">
      <?php foreach ($tabs as $tab) : ?>
        <li class="<?php echo $tab->active ? 'active' : ''; ?>"><a href="#<?php echo $tab->tabId; ?>" role="tab" data-toggle="tab"><?php echo $tab->tabLabel; ?></a></li>
      <?php endforeach; ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <?php foreach ($tabs as $tab) : ?>
        <div class="tab-pane fade <?php echo $tab->active ? 'in active' : ''; ?>" id="<?php echo $tab->tabId; ?>">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Panel tabDay</h3>
            </div>
            <div class="panel-body">
              <?php if (isset($tab->tabArray) && is_array($tab->tabArray) && count($tab->tabArray) > 0) : ?>
                <table class="table table-condensed table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Datum</th>
                      <th>Zeit</th>
                      <th>Patient</th>
                      <th>Nachbearbeitung</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($tab->tabArray as $row) : ?>
                      <tr>
                        <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                          <input type="checkbox" class="checked-reservation" name="checked_reservation[<?php echo $row->id; ?>]" value="1">
                        </td>
                        <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('d.m.Y', strtotime($row->start)); ?></td>
                        <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('H:i', strtotime($row->start)); ?></td>
                        <td class="<?php echo $row->insurance ? ($row->insurance == '1' ? 'danger' : 'info') : ''; ?>"><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></td>
                        <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                          <?php if (!$row->read) : ?>
                            <button class="btn btn-default" rel="tooltip" data-toggle="tooltip" data-placement="top" title="gelesen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='read']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-envelop-opened"></span></button>
                          <?php endif; ?>
                          <button class="btn btn-info" rel="popover" data-toggle="popover" title="Termin <?php echo date('H:i d.m.Y', strtotime($row->start)); ?>" data-content="
                          <?php if ($row->start < $row->end) : ?>
                            <h4>Dauer <small><?php echo (strtotime($row->end) - strtotime($row->start)) / 60; ?> Minuten</small></h4>
                          <?php endif; ?>
                          <h4>Patient <small><?php echo form_prep($row->first_name); ?> <?php echo form_prep($row->last_name); ?></small></h4>
                          <h4>Anrede <small><?php echo $row->gender == '1' ? 'Frau' : 'Herr'; ?></small></h4>
                          <h4>Email <small><?php echo form_prep($row->email); ?></small></h4>
                          <h4>Mobil <small><?php echo form_prep($row->telephone); ?></small></h4>
                          <?php if ($row->insurance) : ?> <h4>Versicherungsart <small><?php echo $row->insurance == '1' ? 'privat' : 'gesetzlich'; ?></small></h4> <?php endif; ?>
                          <?php if ($row->treatment && is_array($row->treatment)) : ?>
                            <h4>
                              Behandlungsgrund
                              <small>
                                <br/><?php echo isset($row->treatment[0]) && $row->treatment[0] ? form_prep($row->treatment[0]) : ''; ?>
                                <br/><?php echo isset($row->treatment[1]) && $row->treatment[1] ? form_prep($row->treatment[1]) : ''; ?>
                              </small>
                            </h4>
                          <?php endif; ?>
                          <h4>Notizen <small><?php echo form_prep($row->text_patient_notes); ?></small></h4>
                          "><span class="icomoon i-info-2"></span></button>
                          <?php if (!$row->accept) : ?>
                            <button class="btn btn-success" rel="tooltip" data-toggle="tooltip" data-placement="top" title="akzeptieren" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='accept']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-checkmark-circle-2"></span></button>
                          <?php endif; ?>
                          <button class="btn btn-warning dialog-open-bearbeiten" rel="tooltip" data-toggle="tooltip" data-bearbeiten-id="<?php echo $row->id; ?>" data-placement="top" title="bearbeiten"><span class="icomoon i-tools"></span></button>
                          <button class="btn btn-danger" rel="tooltip" data-toggle="tooltip" data-placement="top" title="löschen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='delete']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-close-3"></span></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <button class="btn btn-default" ia-action="reservation-action" data-action="read"><span class="icomoon i-envelop-opened"></span> Als gelesen markieren</button>
                <button class="btn btn-success" ia-action="reservation-action" data-action="accept"><span class="icomoon i-checkmark-circle-2"></span> Akzeptieren</button>
                <button class="btn btn-danger" ia-action="reservation-action" data-action="delete"><span class="icomoon i-close-3"></span> Löschen</button>
              <?php else : ?>
                <table class="table table-condensed table-hover table-striped text-center"><thead><tr><th class="text-center text-muted"><small>IhrArzt24</small></th></tr></thead><tbody><tr><td>Keine anstehenden Termine</td></tr></tbody></table>
              <?php endif; ?>
            </div>
            <div class="panel-footer">Panel footer</div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-12">
    <h3>Archivierte Termine</h3>
    <blockquote>
      <p><small>Hier sehen Sie den Status vergangener Termine.</small></p>
    </blockquote>
    <div class="well-sm">
      <?php if (isset($archive) && is_array($archive) && count($archive) > 0) : ?>
        <table class="table table-condensed table-hover table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Datum</th>
              <th>Zeit</th>
              <th>Patient</th>
              <th>Nachbearbeitung</th>
            </tr>
          </thead>
          <tbody>
            
            <?php foreach ($archive as $row) : ?>
              <tr>
                <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                  <input type="checkbox" class="checked-reservation" name="checked_reservation[<?php echo $row->id; ?>]" value="1">
                </td>
                <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('d.m.Y', strtotime($row->start)); ?></td>
                <td class="<?php echo !$row->read ? 'warning' : ''; ?>"><?php echo date('H:i', strtotime($row->start)); ?></td>
                <td class="<?php echo $row->insurance ? ($row->insurance == '1' ? 'danger' : 'info') : ''; ?>"><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></td>
                <td class="<?php echo !$row->read ? 'warning' : ''; ?>">
                  <?php if (!$row->read) : ?>
                    <button class="btn btn-default" rel="tooltip" data-toggle="tooltip" data-placement="top" title="gelesen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='read']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-envelop-opened"></span></button>
                  <?php endif; ?>
                  <button class="btn btn-info" rel="popover" data-toggle="popover" title="Termin <?php echo date('H:i d.m.Y', strtotime($row->start)); ?>" data-content="
                  <?php if ($row->start < $row->end) : ?>
                    <h4>Dauer <small><?php echo (strtotime($row->end) - strtotime($row->start)) / 60; ?> Minuten</small></h4>
                  <?php endif; ?>
                  <h4>Patient <small><?php echo form_prep($row->first_name); ?> <?php echo form_prep($row->last_name); ?></small></h4>
                  <h4>Anrede <small><?php echo $row->gender == '1' ? 'Frau' : 'Herr'; ?></small></h4>
                  <h4>Email <small><?php echo form_prep($row->email); ?></small></h4>
                  <h4>Mobil <small><?php echo form_prep($row->telephone); ?></small></h4>
                  <?php if ($row->insurance) : ?> <h4>Versicherungsart <small><?php echo $row->insurance == '1' ? 'privat' : 'gesetzlich'; ?></small></h4> <?php endif; ?>
                  <?php if ($row->treatment && is_array($row->treatment)) : ?>
                    <h4>
                      Behandlungsgrund
                      <small>
                        <br/><?php echo isset($row->treatment[0]) && $row->treatment[0] ? form_prep($row->treatment[0]) : ''; ?>
                        <br/><?php echo isset($row->treatment[1]) && $row->treatment[1] ? form_prep($row->treatment[1]) : ''; ?>
                      </small>
                    </h4>
                  <?php endif; ?>
                  <h4>Notizen <small><?php echo form_prep($row->text_patient_notes); ?></small></h4>
                  "><span class="icomoon i-info-2"></span></button>
                  <button class="btn btn-warning dialog-open-bearbeiten" rel="tooltip" data-toggle="tooltip" data-bearbeiten-id="<?php echo $row->id; ?>" data-placement="top" title="bearbeiten"><span class="icomoon i-tools"></span></button>
                  <button class="btn btn-danger" rel="tooltip" data-toggle="tooltip" data-placement="top" title="löschen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='delete']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']"><span class="icomoon i-close-3"></span></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <button class="btn btn-default" ia-action="reservation-action" data-action="read"><span class="icomoon i-envelop-opened"></span> Als gelesen markieren</button>
        <button class="btn btn-danger" ia-action="reservation-action" data-action="delete"><span class="icomoon i-close-3"></span> Löschen</button>
      <?php else : ?>
        <table class="table table-condensed table-hover table-striped text-center"><thead><tr><th class="text-center text-muted"><small>IhrArzt24</small></th></tr></thead><tbody><tr><td>Keine archivierte Termine</td></tr></tbody></table>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $this->load->view('dialog/bearbeiten_view'); ?>

<?php $this->load->view('dialog/neu_termin_view'); ?>

<script type="text/javascript">
  var bearbeitenData = {};
  <?php foreach ($tabs as $tab) : ?>
    <?php if (isset($tab->tabArray) && is_array($tab->tabArray) && count($tab->tabArray) > 0) : ?>
      <?php foreach ($tab->tabArray as $row) : ?>
        bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>

  <?php foreach ($unread as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>

  <?php foreach ($past as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>

  <?php foreach ($archive as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>
</script>
