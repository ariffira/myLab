
<?php
$tabs = array(
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_day'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_day'),
		'tabArray' => $accepted_filtered->day,
		'active' => TRUE, 
		),
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_work_day'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_work_day'),
		'tabArray' => $accepted_filtered->workdays,
		'active' => FALSE, 
		),
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_week'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_week'),
		'tabArray' => $accepted_filtered->week,
		'active' => FALSE, 
		),
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_month'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_month'),
		'tabArray' => $accepted_filtered->month,
		'active' => FALSE, 
		),
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_later'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_later'),
		'tabArray' => $accepted_filtered->later,
		'active' => FALSE, 
		),
	(object) array(
		'tabId' => $this->lang->line('upcoming_tab_id_overview'),
		'tabLabel' => $this->lang->line('upcoming_tab_id_overview'),
		'tabArray' => $accepted_filtered->overview,
		'active' => FALSE, 
		),
	);
	?>

	<!-- Nav pills -->
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ($tabs as $tab) : ?>
			<li class="<?php echo $tab->active ? 'active' : ''; ?>"><a href="#<?php echo $tab->tabId; ?>" role="tab" data-toggle="tab"><?php echo $tab->tabLabel; ?></a></li>
		<?php endforeach; ?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php foreach ($tabs as $tab) : ?>
			<div class="tab-pane fade <?php echo $tab->active ? 'in active' : ''; ?>" id="<?php echo $tab->tabId; ?>">
				<div class="portlet">
					<h4 class="portlet-title"><u><?php echo $this->lang->line('apntmnt_duration_for');?> <strong><?php echo $tab->tabId; ?></strong></u></h4>
					<div class="portlet-body">
						<?php if (isset($tab->tabArray) && is_array($tab->tabArray) && count($tab->tabArray) > 0) : ?>
							<table class="table table-condensed table-hover table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th><?php echo $this->lang->line('apntmnt_date');?></th>
										<th><?php echo $this->lang->line('apntmnt_time');?></th>
										<th><?php echo $this->lang->line('apntmnt_pat_name');?></th>
										<th><?php echo $this->lang->line('apntmnt_options');?></th>
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
													<button class="btn btn-default" rel="tooltip" data-toggle="tooltip" data-placement="top" title="gelesen" ia-action="reservation-action" data-action-submit="[ia-action='reservation-action'][data-action='read']:first" data-action-checkbox="[name='checked_reservation[<?php echo $row->id; ?>]']">
														<span class="icomoon i-envelop-opened"></span>
													</button>
												<?php endif; ?>
												<button class="btn btn-info" rel="popover" data-toggle="popover" title="Termin <?php echo date('H:i d.m.Y', strtotime($row->start)); ?>" data-content="
													<?php if ($row->start < $row->end) : ?>
														<h4>Dauer <small><?php echo (strtotime($row->end) - strtotime($row->start)) / 60; ?> Minuten</small></h4>
													<?php endif; ?>
													<h4><?php echo $this->lang->line('apntmnt_pat_name');?> <small><?php echo form_prep($row->first_name); ?> <?php echo form_prep($row->last_name); ?></small></h4>
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
								<button class="btn btn-success" ia-action="reservation-action" data-action="accept">
									<span class="icomoon i-checkmark-circle-2"></span>
									<?php echo $this->lang->line('accept_btn');?>
								</button>
								<button class="btn btn-danger" ia-action="reservation-action" data-action="delete">
									<span class="icomoon i-close-3"></span>
									<?php echo $this->lang->line('delete_btn');?>
								</button>
							<?php else : ?>
								<table class="table table-condensed table-hover table-striped text-center">
									<thead>
										<tr>
											<th class="text-center text-muted">
												<small>Cyomed</small>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $this->lang->line('apntmnt_null_info');?></td>
										</tr>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>