<div class="item-block">
	<div class="row">
		<div class="col-sm-12">
			
					<table class="table">
						<tbody>
							<tr>
								<th>ATC Code</th>
								<td>
									<?php if (!empty($infos['atc_code'])):?>
										<?php foreach ($infos['atc_code'] as $atc_code) :?>
											<?php echo isset($atc_code->atc_code)? $atc_code->atc_code : ''?>
										<?php endforeach;?>
									<?php endif;?>
								</td>
							</tr>
							
						</tbody>
					</table>


				

		</div>
	</div>
</div>
