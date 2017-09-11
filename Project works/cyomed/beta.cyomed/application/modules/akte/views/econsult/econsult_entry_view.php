<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;

  $insert = empty($entry->id);

  $this->load->language('patients/all_access', $this->m->user_value('language'));
  $this->load->language('global/general_text', $this->m->user_value('language'));
  $this->load->language('patients/iconsult', $this->m->user_value('language'));
  
?>

<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/'.(isset($patient_id)?'alleconsult/':'econsult/').( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
	<input type="hidden" name="id" value="<?php echo $entry->id ?>" />
        <?php if (isset($patient_id)) : ?>
        <input type="hidden" name="patient_id" value="<?php echo $entry->patient_id ?>" />
        <?php endif;?>
 	<?php  if ($this->m->user_role() == M::ROLE_PATIENT) :?>
    	<div class="col-sm-12"> 
     		<div class="form-group">
       			<label for="country" class="control-label"><?php //echo $this->lang->line('epres_question_doctor');?></label>
      			<div class="radio-inline cyomed_doc_select"  >
            		<label>
             			<input type="radio"   value="2" name="cyomeddoctor" <?php if(empty($entry->doctorcheck) || 2==$entry->doctorcheck || 1!=$entry->doctorcheck) echo "checked='checked'" ?> />
                       	<?php echo $this->lang->line('patients_iconsult_cyomed_doct'); ?>
            		</label>
       			</div>
				<div class="radio-inline family_doc_select">
           			<label>
            			<input type="radio" value="1" name="cyomeddoctor"  <?php if(isset($entry->doctorcheck)){if($entry->doctorcheck==1) echo "checked='checked'";} if(isset($family_doctor)){if(!(is_array($family_doctor)) && !empty($family_doctor)) echo 'disabled="disabled" readonly="readonly"';} ?>   />
                		<?php echo $this->lang->line('patients_iconsult_cyomed_personal'); ?>
          			</label>
       			</div>
     		</div>
     		<div class="col-sm-6">
     			<?php  if(isset($family_doctor)):
     				 	if(is_array($family_doctor) && !empty($family_doctor)): ?>
					<div class="form-group family_doc_list" <?php if ($entry->doctorcheck!=1) echo 'style="display: none;"';?> > 
    					<label for="country" class="col-sm-5 control-label"> <?php echo $this->lang->line('patients_iconsult_cyomed_personal_chose'); ?> </label>
     					<div class="col-sm-6">
       						<select name="doctor_id[]" data-placeholder="Choose Doctor" multiple class="select" tabindex="8">
					        <?php 
						    	if($entry->familydoctor){
						        	$family_selected_doctor_array=explode(',', $entry->familydoctor);
								}
						        foreach($family_doctor as $key=>$value)
						        {
							?>
           							<option value="<?php echo $value->doctor_inserted_id;?>" <?php if(in_array($value->doctor_inserted_id,$family_selected_doctor_array) && isset($family_selected_doctor_array)) echo "selected='selected'";  ?>>
            							<?php echo $value->name." ".$value->surname;?>
           							</option>
							<?php 
            					}
           					?>
     						</select>
          				</div>
      				</div>
				<?php endif; endif; ?>
     		</div>
    	</div>
	<?php endif; ?>
	<div class="col-sm-12">
		<div class="form-group" style="margin-bottom: 0;">
    		<label for="keyword<?php echo $entry->id; ?>" class="control-label text-white">
      			<?php echo $this->lang->line('patients_iconsult_keyword');  ?>
   			</label>
			<div class="">
                            <input type="text" class="form-control" name="keyword" maxlength="100" id="keyword<?php echo $entry->id; ?>" value="<?php echo !empty($entry->keyword) ? form_prep($entry->keyword) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_iconsult_keyword'); ?>" required />
      			<!--
      			<?php if (isset($entry->question_status)) : ?>
        			<p class="help-block">
          				<?php if ($entry->question_status == 1) : ?>
            				<span class="text-success">
              					<?php echo $this->lang->line('patients_iconsult_answered_question'); ?>
            				</span>
          				<?php else : ?>
            				<span class="text-danger">
              					<?php echo $this->lang->line('patients_iconsult_open_question'); ?>
            				</span>
          				<?php endif; ?>
        			</p>
				<?php endif; ?>-->
			</div>
		</div>
		<div class="form-group" style="float: left;clear: none;width: 50%;">
			<label for="message<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      			<?php echo $this->lang->line('patients_iconsult_message'); ?>
    		</label>
    		<div class="col-sm-9">
                    <textarea class="form-control" maxlength="500" rows="2" name="message" id="message<?php echo $entry->id; ?>" placeholder="<?php echo $this->lang->line('patients_iconsult_message'); ?>" required ><?php echo !empty($entry->message) ? form_prep($entry->message) : ''; ?></textarea>
    		</div>
  		</div> 
	</div>
  	<div class="col-sm-6">
  		<div class="form-group">
  			<label for="document_date<?php echo $entry->id; ?>" class="control-label text-white">
      			<?php echo $this->lang->line('patients_iconsult_question_date'); ?>
    		</label>
    		<div class="input-icon datetime-pick date-only">
                    <input type="text" class="form-control input-sm" readonly="readonly" name="document_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_iconsult_question_date'); ?>" />
        		<span class="add-on">
          			<i class="fa fa-calendar"></i>
        		</span>
      		</div>
    	</div>
  	</div>
	<div class="col-sm-6" style="clear:both;"> 
    	<div class="form-group">
    		<?php  if (isset($entry->replies) && is_array($entry->replies) && count($entry->replies) > 0) : ?>
    			<div class="tile m-t-15 m-b-15">
          			<h2 class="tile-title"><?php echo $this->lang->line('patients_iconsult_reply'); ?></h2>
	          		<div class="overflow" style="max-height:<?php echo Ui::$bs_tname == 'mvpr110' ? '376px' : '200px' ?>;">
	            		<div class="message-list list-container">
	              			<?php foreach ($entry->replies as $reply) :?>
	                			<?php if (Ui::$bs_tname == 'sa103') :    ?>
	                  				<div class="media" >
	                    				<a class="media-body" href="javascript:void(0);">
	                      					<?php if ($reply->reply_by) :  ?>
	                        					<div class="pull-left list-title">
	                          						<span class="t-overflow f-bold"></span>
	                        					</div>
	                        					<div class="pull-right list-date m-r-10"><?php echo date('d.m.Y', strtotime( $reply->reply_date ) ); ?></div> 
	                        					<div class="media-body hidden-xs">
	                          						<span class="t-overflow"><?php echo $reply->reply_message; ?></span>
	                        					</div>
	                      					<?php else : ?>
	                        					<div class="pull-left list-title">
	                          						<span class="t-overflow f-bold"><?php echo $reply->doc_reg_id; ?></span><br />
	                          						<?php echo !empty($reply->doctor) && !empty($reply->doctor->academic_grade) ? $reply->doctor->academic_grade : '' ; ?>
	                          						<?php echo !empty($reply->doctor) && !empty($reply->doctor->name) ? $reply->doctor->name : '' ; ?>
	                          						<?php echo !empty($reply->doctor) && !empty($reply->doctor->surname) ? $reply->doctor->surname : '' ; ?>
	                        					</div>
	                        					<div class="pull-right list-date m-r-10"><?php echo date('d.m.Y', strtotime( $reply->reply_date ) ); ?></div> 
	                        					<div class="media-body hidden-xs">
	                          						<span class=""><?php echo $reply->reply_message; ?></span>
	                        					</div>
	                      					<?php endif; ?>
	                    				</a>
	                  				</div>
	                			<?php endif; ?>
                			
	                			<?php if (Ui::$bs_tname == 'mvpr110') :     ?>
	                  				<div class="feed-item feed-item-<?php $arr = array('idea', 'image', 'file', 'bookmark', 'question', ); echo $arr[mt_rand(0, count($arr) - 1)]; ?>">
										<div class="feed-icon">
	                      					<i class="fa fa-<?php $arr = array('lightbulb-o', 'picture-o', 'cloud-upload', 'bookmark', 'question', ); echo $arr[mt_rand(0, count($arr) - 1)]; ?>"></i>
	                    				</div> <!-- /.feed-icon -->
	
	                    				<div class="feed-subject">
	                     					<p>
	                        					<?php if ($reply->reply_by) : ?>
	                          						<strong>Sie</strong>
	                          						haben gesagt:
	                        					<?php else : ?>
	                         						Doktor
						                          	<a href="javascript:;">
						                            	<strong><?php echo $reply->doc_reg_id; ?></strong>
						                          	</a>
	                          						<strong>
	                            						<?php echo !empty($reply->doctor) && !empty($reply->doctor->academic_grade) ? $reply->doctor->academic_grade : '' ; ?>
	                            						<?php echo !empty($reply->doctor) && !empty($reply->doctor->name) ? $reply->doctor->name : '' ; ?>
	                            						<?php echo !empty($reply->doctor) && !empty($reply->doctor->surname) ? $reply->doctor->surname : '' ; ?>
													</strong>
	                          						hat gesagt:
	                        					<?php endif; ?>
	                     					</p>
	                     				</div> <!-- /.feed-subject -->
	
	                    				<div class="feed-content">
	                      					<ul class="icons-list">
	                        					<li>
	                          						<i class="icon-li fa fa-quote-left"></i>
	                          						<?php                         
                                                        echo $reply->reply_message; 
                                                    ?>
	                        					</li>
	                      					</ul>
	                    				</div> <!-- /.feed-content -->
	
					                    <div class="feed-actions">
					                    	<a href="javascript:;" class="pull-left"><i class="fa fa-thumbs-up"></i> </a>
					                      	<a href="javascript:;" class="pull-left"><i class="fa fa-comment-o"></i> </a>
						                    <a href="javascript:;" class="pull-right"><i class="fa fa-clock-o"></i> <?php echo date('d.m.Y', strtotime( $reply->reply_date ) ); ?></a>
					                    </div> <!-- /.feed-actions -->
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
	            		</div>
	          		</div>
	        	</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if($entry->id != 0) :?>
  		<?php 
  			if (!isset($entry->insert) || !$entry->insert) : 
      			if(!((!isset($entry->replies) || !(count($entry->replies) > 0)) && $this->m->user_role() == M::ROLE_PATIENT)):
		?>
	    			<div class="form-group col-sm-6">
      					<label for="reply_message<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
							<?php echo $this->lang->line('patients_iconsult_reply'); ?>
      					</label>
      					<div class="col-sm-9">
      						<textarea class="form-control" rows="5" maxlength="700" name="reply_message" id="reply_message<?php echo $entry->id; ?>" placeholder="<?php echo 'Nachricht'; ?>" ><?php echo !empty($entry->reply_message) ? form_prep($entry->reply_message) : ''; ?></textarea> 
      						<button class="btn btn-alt btn-lg reply_button col-sm-3 pull-right" style="margin-top:6px;" type="submit" id="<?php echo $entry->id; ?>" name="reply" value="reply" ><?php echo $this->lang->line('patients_iconsult_reply'); ?></button>
      					</div>
    				</div>
  		<?php  
  				endif; 
  			endif; 
  		?>
	<?php endif; ?>
	
	<!--
	<?php if($entry->id != 0) :?>
  		<?php 
  			if (!isset($entry->insert) || !$entry->insert) : 
        		if(!((!isset($entry->replies) || !(count($entry->replies) > 0)) && $this->m->user_role() == M::ROLE_PATIENT)):
  		?>
    				<div class="col-sm-2">
      					<label for="question_status<?php echo $entry->id; ?>" class="col-sm-7 control-label text-white">
        					<?php echo $this->lang->line('patients_iconsult_reply_to'); ?>
      					</label>
      					<div class="col-sm-1">
        					<div class="checkbox">
          						<label>
            						<div class="checkbox_box">
              							<input type="checkbox" value="1" id="question_status<?php echo $entry->id; ?>" name="question_status" <?php echo isset($entry->question_status) && $entry->question_status == '1' ? 'checked="checked"' : ''; ?> />
              							<label for="question_status<?php echo $entry->id; ?>"></label>
              						<div>
              					</label>
              					</div>
				            </div>
          						
        					</div>
      					</div>
    				</div>
  		<?php 		
  				endif;
			endif; 
  		?>
	<?php endif; ?>-->
  
  <div class="col-sm-4">
<!--     <label for="document_upload<?php //echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php //echo $this->lang->line('patients_iconsult_appendix'); ?>
    </label -->
		<div class="col-sm-12">
<!--			<div class="row">-->
				<!--<div class="col-sm-6">
				<div class="fileupload fileupload-new" data-provides="fileupload">
				<span class="btn btn-file btn-sm btn-alt">
				<span class="fileupload-new">Select file</span>
				<span class="fileupload-exists">Change</span>
				<input type="file" name="document_upload" id="document_upload<?php // echo $entry->id; ?>" />
				</span>
				<span class="fileupload-preview"></span>
				<a href="#" class="close close-pic fileupload-exists" data-dismiss="fileupload">
				<i class="fa fa-times"></i>
				</a>
				</div>
				</div> -->

	        	<!--test first entry and hide if 0 -->
				<?php /*if($entry->id != 0) :?>
	        		<div class="col-sm-12 text-right">
	          			<?php 
	          				if (!isset($entry->insert) || !$entry->insert) : 
	                			if(!((!isset($entry->replies) || !(count($entry->replies) > 0)) && $this->m->user_role() == M::ROLE_PATIENT)):
						?>
                                                    
                                                    <input class="btn btn-alt btn-md" type="submit" name="reply" value="reply">
	          			<?php 
								endif; 
				          	endif; 
			          	?>
	        		</div>
	        	<?php endif;*/ ?>
<!--      		</div>-->
			<?php if (isset($entry->files) && is_array($entry->files) && count($entry->files) > 0) : ?>
				<p class="help-block">
			    	<table class="tile table table-condensed table-striped">
			        	<?php foreach ($entry->files as $file) : ?>
			            	<tr>
			                	<td class="text-center" style="vertical-align:middle;">
			                  		<a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
			                    		<?php if (in_array(strtolower($file->document_extension), array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>
			                      			<?php if (file_exists($this->mdoc->get_file_path($file))) : ?>
			                        			<img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=66&height=138&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" />
			                      			<?php else : ?>
			                        			<span class="icomoon icon32 i-image-2"></span>
			                      			<?php endif; ?>
			                    		<?php endif; ?>
			                    		<?php if (strtolower($file->document_extension) == 'pdf') : ?>
			                      			<span class="icomoon icon32 i-file-pdf"></span>
			                    		<?php endif; ?>
			                    		<?php if (strtolower($file->document_extension) == 'doc' || strtolower($file->document_extension) == 'docx') : ?>
			                      			<span class="icomoon icon32 i-file-word"></span>
			                    		<?php endif; ?>
			                    		<?php if (strtolower($file->document_extension) == 'odt') : ?>
			                      			<span class="icomoon icon32 i-files"></span>
			                    		<?php endif; ?>
									</a>
			                	</td>
			                	<td class="text-center" style="vertical-align:middle;">
			                  		<a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
			                    		<?php echo Ui::$bs_tname == 'sa103' ? $this->ui->title->options('class', 'page-title')->content($file->document_caption)->output() : ''; ?>
			                    		<?php echo Ui::$bs_tname == 'mvpr110' ? $file->document_caption : ''; ?>
			                  		</a>
			                	</td>
			                	<td class="text-center" style="vertical-align:middle;">
			                  		<a href="<?php echo site_url('akte/condition/remove_file/'.$file->entry_id); ?>">
			                    		<span class="icomoon i-remove-2 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
			                  		</a>
			                	</td>
			                	<td class="text-center" style="vertical-align:middle;">
			                  		<a href="<?php echo site_url('akte/document/edit/'.$file->id); ?>">
			                    		<span class="icomoon i-pencil-6 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
			                  		</a>
			                	</td>
			              	</tr>
			        	<?php endforeach; ?>
			    	</table>
				</p>
			<?php endif; ?>

			<!--<p class="help-block">
		    	<small>
		        	<?php // echo $this->lang->line('patients_iconsult_file_type'); ?>
		        </small>
			</p> -->
    	</div>
	</div>

	<?php /* ?> if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <div class="form-group">
      <label class="col-sm-3 control-label text-white">
        <?php echo $this->lang->line('patients_all_access_page_title'); ?>
      </label>
      <div class="col-sm-9">
        <div class="radio-inline">
          <label>
            <input type="radio" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?>
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> 
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('patients_all_access_private_mode'); ?>
          </label>
        </div>
        <p class="help-block">
          <span style="color:red;">*</span>
          <?php echo $this->lang->line('patients_all_access_selection_info'); ?>
        </p>
      </div>
    </div>
  	<?php endif; <?php */ ?>

  	
	<div class="form-group">
		<div class="col-sm-12 text-right">
    		<?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="submit">
					<span class="icomoon i-file-plus-2"></span> 
					<?php echo $this->lang->line('general_text_button_add'); ?>
				</button>
			<?php endif; ?>
			
			<?php if (isset($update_btn) && $update_btn) : ?>
				<button class="btn btn-alt btn-lg" type="submit">
					<span class="icomoon i-loop-4"></span> 
					<?php echo $this->lang->line('general_text_button_update'); ?>
				</button>
			<?php endif; ?>
			
			<?php if (isset($confirm_btn) && $confirm_btn) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/econsult/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>
			    	<?php echo $this->lang->line('patients_iconsult_reply_to'); ?>
				</button>
			<?php endif; ?>
			
			<?php if (isset($archive_btn) && $archive_btn) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/econsult/archive/'.$entry->id); ?>" ><span class="icomoon i-drawer-3"></span> 
			    	<?php echo $this->lang->line('general_text_button_archieve'); ?>
				</button>
			<?php endif; ?>
			     
			<?php if (isset($delete_btn) && $delete_btn && $this->m->user_role() == M::ROLE_PATIENT) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/econsult/delete/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
					<?php echo $this->lang->line('general_text_button_delete'); ?>
				</button>
			<?php endif; ?>
    	</div>
	</div>
</form>
