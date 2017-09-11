<div class="item-block">
	<div class="row">
		<div class="col-sm-12">
			<?php if (!empty($infos['drug'])):?>
				<?php foreach ($infos['drug'] as $drug) :?>
					<table class="table">
						<tbody>
							<tr>
								<th>Indication</th>
								<td><?php echo isset($drug->indication)? $drug->indication: ''?></td>
							</tr>
							<tr>
								<th>Pharmacodynamics</th>
								<td><?php echo isset($drug->pharmacodynamics)? $drug->pharmacodynamics : ''?></td>
							</tr>
							<tr>
								<th>Mechanism of action</th>
								<td><?php echo isset($drug->mechanism_of_action)? $drug->mechanism_of_action : ''?></td>
							</tr>
							<tr>
								<th>Absorption</th>
								<td><?php echo isset($drug->absorption)? $drug->absorption : ''?></td>
							</tr>
							<tr>
								<th>Volume of distribution</th>
								<td><?php echo isset($drug->volume_of_distribution)? $drug->volume_of_distribution : ''?></td>
							</tr>
							<tr>
								<th>Metabolism</th>
								<td><?php echo isset($drug->metabolism)? $drug->metabolism : ''?></td>
							</tr>
							<tr>
								<th>Route of elimination</th>
								<td><?php echo isset($drug->route_of_elimination)? $drug->route_of_elimination : ''?></td>
							</tr>
							<tr>
								<th>Half life</th>
								<td><?php echo isset($drug->half_life)? $drug->half_life : ''?></td>
							</tr>
							<tr>
								<th>Clearance</th>
								<td><?php echo isset($drug->clearance)? $drug->clearance : ''?></td>
							</tr>
							<tr>
								<th>Toxicity</th>
								<td><?php echo isset($drug->toxicity)? $drug->toxicity : ''?></td>
							</tr>
							<tr>
								<th>Affected Organism</th>
								<td>
									
								</td>
							</tr>
						</tbody>
					</table>


				<?php endforeach;?>
			<?php endif;?>

		</div>
	</div>
</div>
