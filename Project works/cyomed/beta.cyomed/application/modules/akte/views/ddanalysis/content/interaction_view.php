<div class="item-block">
	<div class="row">
		<div class="col-sm-12">

			<?php if (!empty($infos['drug_interaction'])):?>
				<h4><?php echo isset($given_name)? $given_name : ''?>(<?php echo isset($given_substance)? $given_substance : ''?>)<>Other drug interactions</h4>
				
				<table class="table">
					<tbody>
						<tr>
							<th>Drug</th>
							<th>Interaction</th>
						</tr>
					<?php foreach ($infos['drug_interaction'] as $drug_interaction) :?>
						<tr>
							<th><?php echo isset($drug_interaction->name)? $drug_interaction->name : ''?></th>
							<td><?php echo isset($drug_interaction->description)? $drug_interaction->description : ''?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			<?php endif;?>
			<hr/>
			<?php if (!empty($infos['food_interaction'])):?>
				<h4 ><?php echo isset($given_name)? $given_name : ''?>(<?php echo isset($given_substance)? $given_substance : ''?>)<>Food interaction</h4>
				<div class="list-group">
				<?php foreach ($infos['food_interaction'] as $food_interaction) :?>
					<div class="list-group-item">
						<?php echo isset($food_interaction->value)? $food_interaction->value : ''?>
					</div>
				<?php endforeach;?>
				</div>
			<?php endif;?>

		</div>
	</div>
</div>