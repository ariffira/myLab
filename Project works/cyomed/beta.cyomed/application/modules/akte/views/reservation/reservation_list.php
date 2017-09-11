<?php
//echo $this->m->port->b->last_query();die;
//       $this->load->language('global/general_text',$this->m->user_value('language'));
//    $this->load->language('global/overview',$this->m->user_value('language'));
//    $this->load->language('patients/home',$this->m->user_value('language'));
    
?>
<div class="block block-theme1 block-cyan-chart">
	<h2 class="title">
		<?php echo $this->lang->line('appoinment_list')?>
	</h2>
    <div class="chart-block">
    	<table class="table table-hover" id="id-tbl" >
        	<thead>
            	<tr> 
                	<th width="20%">
                    	<?php echo $this->lang->line('patients_home_date');?>
                       	<b class="caret"></b>
                    </th>
                    <th width="20%" nowrap>
                    	<?php echo $this->lang->line('patients_home_entry_time');?>
                        <b class="caret"></b>
                    </th>
                    <th width="20%" nowrap>
                    	<?php 
                    		if($this->m->user_role() == M::ROLE_DOCTOR):
                        		echo $this->lang->line('overview_doctor_prof_patient');
                            else:
                            	echo $this->lang->line('overview_doctor_prof_doctor');
                            endif;
						?>
                        <b class="caret"></b>
					</th>
					<th width="20%" nowrap>
                        <?php echo "Status";?>
                        <b class="caret"></b>
					</th>
                    <th width="20%" nowrap>
                    	<?php echo "Action";?>
                        <b class="caret"></b>
                    </th>
				</tr>
			</thead>
			<tbody>
            	<?php
		        	foreach($reservation as $reservation):
				?>
						<tr>
                                    <td width="20%"><?php echo date("d-m-Y",strtotime($reservation->start)); ?></td>
		                    <td width="20%"><?php echo date("h:i",strtotime($reservation->start))." to ".date("h:i",strtotime($reservation->end)); ?></td>
		                    <?php 
		                    	if($this->m->user_role() == M::ROLE_DOCTOR): 
		                    ?>
                            		<td width="20%"><?php echo $reservation->patient->name.' '.$reservation->patient->surname;?></td>
	                               

                                         <?php if($reservation->accept==1): ?>                                                     
                                			
                                                    <?php 
                                                       
                                                       if($reservation->request==1):
                                                            echo '<td width="20%">Requested for Cancellation</td>';//change to a 2 r 0
                                                           if(date("Y-m-d H:i:s",strtotime($reservation->start)) > date("Y-m-d H:i:s")): ?> 
												<td>
											
                        <button class="btn btn-success" id="cancel_reservation_button" onclick="return Accept_Cancelation('<?php echo $reservation->id;?>','<?php echo ($url)?$url:"";?>');" ia-action="reservation-action" data-action="accept">
                                <span class="icomoon i-checkmark-circle-2"></span> Accept
                        </button>
			<div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $reservation->id;?>"></div>
												</td>
											<?php else:?>
						                    	<td>&nbsp;</td>
		                    				<?php endif;?>
                                                                        
                                                         <?php   
                                                       else:echo '<td width="20%">Confirmed</td>';
                                                       endif;?>  
                                                       
                                                        
                                	<?php elseif($reservation->accept==2): ?>                                                     
                                    		<td width="20%"><?php echo "Cancelled";?></td>
									<?php else: ?>                                                     
                                    		<td width="20%"><?php echo "Pending";?></td>
									<?php endif; ?>
                                    <?php if($reservation->accept==0):?>
											<?php if(date("Y-m-d H:i:s",strtotime($reservation->start)) > date("Y-m-d H:i:s")): ?> 
												<td>
                                                            <button class="btn btn-success" id="accept_reservation_button" onclick="return acceptResv_list('<?php echo $reservation->id;?>','<?php echo ($url)?$url:"";?>');" ia-action="reservation-action" data-action="accept">
                                                                    <span class="icomoon i-checkmark-circle-2"></span>
                                                            </button>
	                                            	<div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $reservation->id;?>"></div>
													
													<button class="btn btn-danger" id="cancel_reservation_button" onclick="return cancelResv('<?php echo $reservation->id;?>','<?php echo ($url)?$url:"";?>');" ia-action="reservation-action" data-action="accept">
	                                                	<span class="icomoon i-close-3"></span> 
	                                                </button>
					                                <div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $reservation->id;?>"></div>
												</td>
											<?php else:?>
						                    	<td>&nbsp;</td>
		                    				<?php endif;?>
				                    <?php else:?>
				                    	<td>&nbsp;</td>
                    				<?php endif;?>
							<?php 
                            	else:
                            ?>
                                	<td width="20%"><?php echo $reservation->doctor->name.' '.$reservation->doctor->surname;?></td>  
                                        
                                	<?php if($reservation->accept==1): ?> 
                                          <?php // if($reservation->request==1): ?> 
<!--                                                                        <td> You have requested for Cancelation  </td>-->
                                           <?php // else: ?>   
                                        <td width="20%"><?php echo "Confirmed";?></td>
                                        <?php // endif; ?>
                                            <?php // if($reservation->request==0): ?> 
                                        		<?php if(date("Y-m-d H:i:s",strtotime($reservation->start)) > date("Y-m-d H:i:s")): ?> 
                                                    <td>
<!--							<button class="btn btn-danger" id="cancel_reservation_button" onclick="return cancelResvReqest('<?php echo $reservation->id;?>','<?php echo ($url)?$url:"";?>');" ia-action="reservation-action" data-action="accept">
                                                                 request for cancel   
                                                            <span class="icomoon i-close-3"></span> 
	                                                </button>-->
                                    <button class="btn btn-danger" id="cancel_reservation_button" onclick="return cancelResv('<?php echo $reservation->id;?>','<?php echo ($url)?$url:"";?>');" ia-action="reservation-action" data-action="accept">
	                                                	<span class="icomoon i-close-3"></span> 
	                                                </button>
                                                        <div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $reservation->id;?>"></div>
					             </td>
		                    				<?php endif;
//                                                                endif;?>
				                                            
                                			
                                	<?php elseif($reservation->accept==2): ?>                                                     
                                    		<td width="20%"><?php echo "Cancelled";?></td>
									<?php else: ?>                                                     
                                    		<td width="20%"><?php echo "Pending";?></td>
									<?php endif; ?>
                                    <?php if($reservation->accept==0):?>
											<?php if(date("Y-m-d H:i:s",strtotime($reservation->start)) > date("Y-m-d H:i:s")): ?> 
												<td>
													<button class="btn btn-danger" id="cancel_reservation_button" onclick="return cancelResv('<?php echo $reservation->id;?>','');" ia-action="reservation-action" data-action="accept">
	                                                	<span class="icomoon i-close-3"></span> 
	                                                </button>
					                                <div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $reservation->id;?>"></div>
					                        	</td>
											<?php else:?>
						                    	<td>&nbsp;</td>
		                    				<?php endif;?>
				                    <?php else:?>
				                    	<td>&nbsp;</td>
                    				<?php endif;?>
							<?php 
								endif; 
							?>
		        		</tr>
		       	<?php
		        	endforeach;
		    	?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(".btnCancelAppointment").click(function(e){
		var ajaxurl = "<?php echo site_url('akte/reservation/cancel_reservation/'); ?>";
		jQuery.ajax({
			type:'POST',
			data:{id:$(this).attr('reservationid')},
			url: ajaxurl,
			cache:false,
			contentType: "application/x-www-form-urlencoded",
			beforeSend: function(){
				var image_path ="<?php echo base_url('assets/img/ajax-loader.gif'); ?>";
				$("<img class='loader' src='"+image_path+"' />").insertBefore("button[type='submit']");
           
				$("input").prop("disabled",true);
				$("button").prop("disabled",true);
			},
			success:function(responseText)
			{
				//responseText = responseText.split("||");
				if(responseText=='1')
				{
					alert("Password changed sucessfully");
					$("input").val("");
					$("button").val("");
				}
				else
				{
					alert(responseText);
				}

				$(".loader").remove();
				$("input").prop("disabled",false);
				$("button").prop("disabled",false);
			},
			failure: function(errMsg) {
				alert(errMsg);
			}
		});
	});
</script>