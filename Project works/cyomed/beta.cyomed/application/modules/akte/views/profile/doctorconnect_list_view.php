<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php 
$action = site_url('akte/profile/doctor_connect_update');
if(count($doctors)>0):
?>

		<form class="form" action="<?php echo $action; ?>" method="post">
		 <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
		
		  <div class="table-responsive overflow m-b-15">
		    <table class="table tile">
		      <thead>
		        <tr>
		          <?php if (!isset($hide_checkbox) || !$hide_checkbox) : ?>
		          	<th>&nbsp;</th>
		          <?php endif;?>
		       	 <th>
		            <?php echo $this->lang->line('patients_my_doctors_id'); ?>
		          </th>
		          <th>
		            <?php echo $this->lang->line('patients_my_doctors_name'); ?>
		          </th>
		          <th>
		            <?php echo $this->lang->line('patients_my_doctors_last_name'); ?>  
		          </th>
		          <th>
		           <?php echo $this->lang->line('patients_my_doctors_city'); ?> 
		          </th>
                             <?php if (!isset($hide_status) || !$hide_status): ?>
                          <th>
		         Status
		          </th>
                          <?php endif; ?>
		          <?php if (!isset($hide_delete) || !$hide_delete) : ?>
		            <th>
		              <?php echo $this->lang->line('patients_my_doctors_remove'); ?> 
		            </th>
		          <?php endif; ?>                            
		        </tr>
		      </thead>
		      <tbody>
                          
		        <?php 
                        $i = 1; foreach ($doctors as $row ) : ?>
		          <tr>
		          	<?php if (!isset($hide_checkbox) || !$hide_checkbox) : ?>
			            <td>
			              <div class="form-group">
			                <input type="checkbox" id="check_doctor_<?php echo $row->id; ?>" name="check_doctor[<?php echo $row->id; ?>]" value="1">
			              </div>
			            </td>
					<?php endif; ?>
		            <td>
		              <div class="form-group">
		                <label><?php echo isset($row->doctor_id) ? $row->doctor_id : $row->regid; ?></label>
		              </div>
		            </td>
		            <td>
		              <div class="form-group">
		                <label><?php echo $row->name; ?></label>
		              </div>
		            </td>
		            <td>
		              <div class="form-group">
		                <label><?php echo $row->surname; ?></label>
		              </div>
		            </td>
		            <td>
		              <div class="form-group">
		                <label><?php echo $row->city; ?></label>
		              </div>
		            </td>

                             <?php if (!isset($hide_status) || !$hide_status): ?>
                              <td>
                                    <?php if(!$row->status && $row->sender_id==$this->m->user_id()): ?>
                                        not approved
                                      <?php elseif($row->status): ?>
                                        Confirmed
                                     <?php else: ?>
            <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/profile/apporve_doctor_connect/'.$row->id); ?>" ><span class="icomoon i-checkmark-circle-2"></span> <?php echo $this->lang->line('patients_my_doctors_accept'); ?></button>
                                    <?php endif; ?>  
    		              </td>
		            <?php endif; ?>
		            <?php if (!isset($hide_delete) || !$hide_delete) : ?>
		              <td>
		                <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/profile/doctor_connect_delete/'.$row->id); ?>" ><span class="icomoon i-remove-2"></span> <?php echo $this->lang->line('patients_my_doctors_remove'); ?></button>
		              </td>
		            <?php endif; ?>
                                <?php if (!isset($hide_status) || !$hide_status): ?>
                              <td>
    		              </td>
		            <?php endif; ?>
		          </tr>
		        <?php $i++; endforeach; ?>
		      </tbody>
		    </table>
		  </div>
		
		<div class="form-group">
			<div class="col-sm-12 text-right">
		      	<?php if (!isset($hide_delete) || !$hide_delete) : ?>
		        	<button class="btn btn-alt btn-xs" id="btn_delete_doctor">
		        		<span class="icomoon i-remove-2"></span> 
		        		<?php echo $this->lang->line('patients_my_doctors_remove'); ?>
		        	</button>
		      	<?php endif; ?>
			</div>
		</div>
	</form>
<?php 
	else:
?>
	<div class='msg-no-record'><h4>No record found</h4></div>
<?php 
	endif;
?>
	