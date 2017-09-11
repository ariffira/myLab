<div class="item-block">
	<div class="row">
		<div class="col-sm-12">
			<?php if (!empty($infos['drug'])):?>
				<?php foreach ($infos['drug'] as $drug) :?>
					<table class="table">
						<tbody>
							<tr>
								<th>Name</th>
								<td><?php echo isset($drug->name)? $drug->name : ''?></td>
							</tr>
							<tr>
								<th>Type</th>
								<td><?php echo isset($drug->type)? $drug->type : ''?></td>
							</tr>
							<tr>
								<th>Group</th>
								<td>
									<?php if (!empty($infos['group'])):?>
										<?php foreach ($infos['group'] as $group) :?>
											<?php echo isset($group->group)? $group->group : ''?>, 
										<?php endforeach;?>
									<?php endif;?>
								</td>
							</tr>
							<tr>
								<th>Description</th>
								<td><?php echo isset($drug->description)? $drug->description : ''?></td>
							</tr>
							<tr>
								<th>Synonym</th>
								<td>
									<?php if (!empty($infos['synonym'])):?>
									<table id="drug_synonym" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
            								<tr>
	            								<th>Synonym</th>
	            								<th>Language</th>
            								</tr>
            							</thead>
            							<tfoot>
            								<tr>
	            								<th>Synonym</th>
	            								<th>Language</th>
            								</tr>
            							</tfoot>
            							<tbody>
            							<?php foreach ($infos['synonym'] as $synonym) :?>
            								<tr>
            									<td><?php echo isset($synonym->value)? $synonym->value : ''?></td>
            									<td></td>
            								</tr>
            							<?php endforeach;?>
            							</tbody>
									</table>
									<?php endif;?>

								</td>
							</tr>
							<tr>
								<th>Products</th>
								<td>
									<?php if (!empty($infos['product'])):?>
									<table id="drug_pp_product" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
            								<tr>
	            								<th>Name</th>
	            								<th>Dosage</th>
	            								<th>Strength</th>
	            								<th>Route</th>
            								</tr>
            							</thead>
            							<tfoot>
            								<tr>
	            								<th>Name</th>
	            								<th>Dosage</th>
	            								<th>Strength</th>
	            								<th>Route</th>
            								</tr>
            							</tfoot>
            							<tbody>
            							<?php foreach ($infos['product'] as $product) :?>
            								<tr>
            									<td><?php echo isset($product->name)? $product->name : ''?></td>
            									<td><?php echo isset($product->dosage)? $product->dosage : ''?></td>
            									<td><?php echo isset($product->strength)? $product->strength : ''?></td>
            									<td><?php echo isset($product->route)? $product->route : ''?></td>
            								</tr>
            							<?php endforeach;?>
            							</tbody>
									</table>
									<?php endif;?>
								</td>
							</tr>
							<!--
							<tr>
								<th>Generic Prescription Products</th>
								<td><?php echo isset($drug->type)? $drug->type : ''?></td>
							</tr>
							-->
							<tr>
								<th>International Brands</th>
								<td>
									<?php if (!empty($infos['intbrand'])):?>
									<table id="drug_intbrand" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
            								<tr>
	            								<th>Name</th>
	            								<th>Company</th>
            								</tr>
            							</thead>
            							<tfoot>
            								<tr>
	            								<th>Name</th>
	            								<th>Company</th>
            								</tr>
            							</tfoot>
            							<tbody>
            							<?php foreach ($infos['intbrand'] as $intbrand) :?>
            								<tr>
            									<td><?php echo isset($intbrand->name)? $intbrand->name : ''?></td>
            									<td><?php echo isset($intbrand->company)? $intbrand->company : ''?></td>
            								</tr>
            							<?php endforeach;?>
            							</tbody>
									</table>
									<?php endif;?>
								</td>
							</tr>
							<tr>
								<th>Categories</th>
								<td>
									<?php if (!empty($infos['category'])):?>
										<?php foreach ($infos['category'] as $category) :?>
												<?php echo isset($category->category)? $category->category : ''?>, 
										<?php endforeach;?>
									<?php endif;?>
								</td>
							</tr>
							<tr>
								<th>CAS Number</th>
								<td><?php echo isset($drug->cas_number)? $drug->cas_number : ''?></td>
							</tr>
						</tbody>
					</table>


				<?php endforeach;?>
			<?php endif;?>

		</div>
	</div>
</div>
