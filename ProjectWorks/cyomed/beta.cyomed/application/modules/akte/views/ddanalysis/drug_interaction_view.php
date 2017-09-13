<div class="row">
	
	<div class="col-sm-9">
		<?php if (!empty($medication_list)):?>
			<?php foreach ($infos['drug_interaction'] as $drug_interaction):?>
				<?php foreach ($medication_list as $medication) :?>
					<?php if ($medication->substance==$drug_interaction->name):?>
						<div class="block block-aktuell">
							<div class="block-foot">
								<?php echo isset($given_name)? $given_name : ''?>(<?php echo isset($given_substance)? $given_substance : ''?>)<><?php echo isset($medication->name)? $medication->name: ''?>(<?php echo isset($medication->substance)? $medication->substance: ''?>) interaction
							</div>
							<div class="list-group">
								<div class="list-group-item">
									<p class="list-group-item-text"><?php echo isset($drug_interaction->description)? $drug_interaction->description : ''?></p>
								</div>
							</div>
						</div>
					<?php endif;?>
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endif;?>

		<?php if (!empty($infos['food_interaction'])):?>
			<div class="block block-aktuell">
				<div class="block-foot">
					<?php echo isset($given_name)? $given_name : ''?>(<?php echo isset($given_substance)? $given_substance : ''?>)<> Food interaction
				</div>
				<div class="list-group">
					<div class="list-group-item">
						<?php foreach ($infos['food_interaction'] as $food_interaction) :?>
							<p class="list-group-item-text"><?php echo isset($food_interaction->value)? $food_interaction->value : ''?></p>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			
		<?php endif;?>

	</div>
	<div class="col-sm-3">
		<?php if (!empty($medication_list)):?>
			<?php foreach ($infos['drug_interaction'] as $drug_interaction):?>
				<?php foreach ($medication_list as $medication) :?>
					<?php if ($medication->substance==$drug_interaction->name):?>
						<?php if ($this->m->us_id()) : ?>
							<div class="block block-aktuell">
								<div class="block-foot">
									Patient Medication List
								</div>
								<div class="list-group"> 
									<a href="javascript:;" class="list-group-item">
										<h3 class="pull-right">
											<img class="img-responsive" src="<?php $this->load->model('document/mdoc');
											echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" />
										</h3>
										<h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
										<p class="list-group-item-text"><?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
									</a>
									<?php if (!empty($medication_list)):?>
										<?php foreach ($medication_list as $medication) :?>
											<a href="javascript:;" class="list-group-item">
												<?php echo isset($medication->name)? $medication->name : ''?>
												<i class="fa fa-chevron-right list-group-chevron"></i>
											</a>
										<?php endforeach;?>
									<?php endif;?>
								</div>
							</div>
						<?php endif; ?>
					<?php endif;?>
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endif;?>
	</div>
	

	
</div>

