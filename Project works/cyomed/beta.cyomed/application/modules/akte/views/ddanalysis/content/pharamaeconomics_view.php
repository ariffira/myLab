
	<div class="row">
		<div class="col-sm-12">

			<?php if (!empty($drug_interactions)):?>
				<div class="col-sm-3">
					Drug
				</div>
				<div class="col-sm-9">
					Interaction
				</div>
				<?php foreach ($drug_interactions as $drug_interaction) :?>
					<div class="col-sm-3">
						<?php echo isset($drug_interaction->name)? $drug_interaction->name : ''?>
					</div>
					<div class="col-sm-9">
						<?php echo isset($drug_interaction->description)? $drug_interaction->description : ''?>
					</div>
				<?php endforeach;?>
			<?php endif;?>

		</div>
	</div>
