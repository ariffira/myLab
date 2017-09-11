<div class="item-block">
	<div class="row">
		<div class="col-sm-12">
			<?php if (!empty($infos['classification'])):?>
				<?php foreach ($infos['classification'] as $classification) :?>
					<table class="table">
						<tbody>
							<tr>
								<th>Description</th>
								<td><?php echo isset($classification->description)? $classification->description : ''?></td>
							</tr>
							<tr>
								<th>Kingdom</th>
								<td><?php echo isset($classification->kingdom)? $classification->kingdom : ''?></td>
							</tr>
							<tr>
								<th>Super Class</th>
								<td><?php echo isset($classification->superclass)? $classification->superclass : ''?></td>
							</tr>
							<tr>
								<th>Class</th>
								<td><?php echo isset($classification->class)? $classification->class : ''?></td>
							</tr>
							<tr>
								<th>Sub Class</th>
								<td><?php echo isset($classification->subclass)? $classification->subclass : ''?></td>
							</tr>
							<!--
							<tr>
								<th>Direct Parent</th>
								<td>
									
								</td>
							</tr>
							<tr>
								<th>Alternative Parents</th>
								<td>
									
								</td>
							</tr>
							<tr>
								<th>Substituent</th>
								<td>
									
								</td>
							</tr>
							-->
						</tbody>
					</table>


				<?php endforeach;?>
			<?php endif;?>

		</div>
	</div>
</div>
