<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php 
	if(count($doctors)>0):
		if(!isset($hide_insertMany) || !$hide_insertMany)
		{
			$action = site_url('akte/access/insertMany');
		}
		else 
		{
			$action = site_url('akte/access/update');
		}
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
		          <?php if (!isset($hide_update) || !$hide_update || !isset($hide_insertMany) || !$hide_insertMany) : ?>
		            <th>
		              <?php echo $this->lang->line('patients_my_doctors_access_permission'); ?> 
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
		        <?php $i = 1; foreach ($doctors as $row ) : ?>
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
		            <?php if (!isset($hide_update) || !$hide_update || !isset($hide_insertMany) || !$hide_insertMany) : ?>
		              <td>
		                <div class="checkbox m-0 m-b-5">
		                  <label>
		                    <input type="checkbox" value="1" id="inputMyDoctorAccess<?php echo $row->id; ?>" name="access[<?php echo $row->id; ?>]" <?php echo $row->access_rights == 1 ? "checked=checked" : ""; ?> />
		                  </label>
		                </div>
		              </td>
		            <?php endif; ?>
		            <?php if (!isset($hide_delete) || !$hide_delete) : ?>
		              <td>
		                <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/access/delete/'.$row->id); ?>" ><span class="icomoon i-remove-2"></span> <?php echo $this->lang->line('patients_my_doctors_remove'); ?></button>
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
		      	<?php if (!isset($hide_update) || !$hide_update) : ?>
		        	<button class="btn btn-alt btn-xs" ><span class="icomoon i-loop-4"></span>
		         		<?php echo $this->lang->line('general_text_button_update'); ?>
		      		</button>
		      	<?php endif; ?>
		      	<?php if (!isset($hide_insertMany) || !$hide_insertMany) : ?>
					<button class="btn btn-alt btn-lg" type="submit">
        				<span class="icomoon i-user-plus"></span> 
        				<?php echo $this->lang->line('general_text_button_add');?>
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
	