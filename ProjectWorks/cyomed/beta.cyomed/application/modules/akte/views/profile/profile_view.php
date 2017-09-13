<style>
	@media (min-width: 768px) and (max-width: 1023px) {
		.input-icon .add-on {
			top:20px !important;
			left:1px;
		}
	}
	@media only screen and (width:1024px){
		.input-icon .add-on {
			top:20px !important;
			left:15px;
		}
	}
</style>


<?php $this->ui->tile->base_init(); ?>

<?php
	$this->load->model('document/mdoc');
?>
<?php $today= date('m/d/Y',strtotime(date('Y-m-d')));?>
<div class="container">
	<div class="layout layout-main-right layout-stack-sm">
		<div class="col-md-3 col-sm-12 layout-sidebar">
			<div class="nav-layout-sidebar-skip">
				<strong>Tab Navigation</strong> / <a href="#settings-content">Skip to Content</a> 
			</div>
			<ul id="myTab" class="nav nav-layout-sidebar nav-stacked">
				<li class="active">
					<a href="#profile-tab" data-toggle="tab">
						<i class="fa fa-user"></i> 
						&nbsp;&nbsp;<?php echo $this->lang->line('pwidgets_my_account_tab1');?> 
					</a>
				</li>

				<li>
					<a href="#password-tab" data-toggle="tab">
						<i class="fa fa-lock"></i> 
						&nbsp;&nbsp;<?php echo $this->lang->line('pwidgets_my_account_tab2');?> 
					</a>
				</li>

				<li>
					<a href="#messaging" data-toggle="tab">
						<i class="fa fa-dollar"></i>
						&nbsp;&nbsp;<?php echo $this->lang->line('pwidgets_my_account_tab3');?>
					</a>
				</li>
				<li>
					<a href="#setting" data-toggle="tab">
						<i class="fa fa-cogs"></i>
						&nbsp;&nbsp;<?php echo $this->lang->line('general_text_menu_setting');?>
					</a>
				</li>
				<?php  if ($this->m->user_role() == M::ROLE_DOCTOR):  ?>
					<li>
						<a href="#connect" data-toggle="tab">
							<i class="fa fa-connectdevelop"></i>
							&nbsp;&nbsp;<?php echo $this->lang->line('doctorconnect_text_menu_setting');?>
						</a>
					</li>
					<li>
						<a href="#practice" data-toggle="tab">
							<i class="fa fa-stethoscope"></i>
							&nbsp;&nbsp;<?php echo $this->lang->line('general_text_menu_practice');?>
						</a>
					</li>
					<li>
						<a href="#doc-setting" data-toggle="tab">
							<i class="fa fa-calendar"></i>
							&nbsp;&nbsp;<?php echo $this->lang->line('general_text_my_calender');?>
						</a>
					</li>
				<?php endif; ?>
			</ul>

		</div> <!-- /.col -->

		<div class="col-md-9 col-sm-12 layout-main">

			<div id="settings-content" class="tab-content stacked-content">

				<div class="tab-pane fade in active" id="profile-tab">

					<h3 class="content-title">
						<u>
							<?php echo $this->lang->line('pwidgets_my_acco_edit_prof');?>
						</u>
					</h3>

					<form class="form-horizontal" method="post" onsubmit="return formvalidation();" action="<?php echo site_url('akte/profile/update_profile'); ?>" enctype="multipart/form-data">

						<h4><?php echo $this->lang->line('pwidgets_my_acco_basic_info');?></h4>
						<div class="row">                	
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label class="col-sm-12"><?php echo $this->lang->line('pwidgets_my_account_id'); ?> <span class="icomoon hidden i-vcard"></span></label>
									<div class="col-sm-12"><?php echo $this->m->user_value('regid'); ?></div>
								</div>
								<div class="form-group">
									<label class="col-sm-12"><?php echo $this->lang->line('pwidgets_my_account_pin'); ?> <span class="icomoon hidden i-keyhole"></span></label>
									<div class="col-sm-12"><?php echo $this->m->user_value('pin'); ?></div>
								</div>

							</div>
							<div class="col-md-6 col-sm-6">
								<label for="document_upload"><?php echo $this->lang->line('pwidgets_my_acco_bild'); ?></label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 110px; height: 85px;line-height:normal;">
										<img class="profile-pic img-responsive" src="<?php  echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/120x120'; ?>" alt="Profile Avatar" />
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="width: 110px; height: 85px;line-height:normal;"></div>
									<div>
										<span class="btn btn-default btn-file">
											<span class="fileupload-new"><?php echo $this->lang->line('pwidgets_my_acco_select_img'); ?></span>
											<span class="fileupload-exists"><?php echo $this->lang->line('pwidgets_my_acco_change_img'); ?></span>
											<input type="file" name="document_upload" id="document_upload" />
										</span>                                
										<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('pwidgets_my_acco_remove_img'); ?></a>
									</div>                        
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-sm-4">
								<label for="language"><?php echo $this->lang->line('general_text_lang_title'); ?> <span class="icomoon hidden i-earth"></span></label>
								<div>
									<select name="language" id="language" class="form-control">
										<?php $this->load->helper('language'); echo lang_list('option'); ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6">
								<label for="language"><?php echo $this->lang->line('pwidgets_my_account_first_name'); ?><span class="red">&nbsp;*</span></label>
								<div>
									<input type="text" required class="form-control input-sm" name="name" id="name" value="<?php echo $this->m->user_value('name'); ?>" placeholder="<?php echo $this->lang->line('pwidgets_my_account_first_name'); ?>" />
									<div id="nameerror" class="red"></div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<label for="language"><?php echo $this->lang->line('pwidgets_my_account_last_name'); ?><span class="red">&nbsp;*</span></label>
								<div>
									<input type="text" required class="form-control input-sm" name="surname" id="surname" value="<?php echo $this->m->user_value('surname'); ?>" placeholder="" />
									<div id="surnameerror" class="red"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6">
								<label for="email"><?php echo $this->lang->line('pwidgets_my_account_email'); ?><span class="red">&nbsp;*</span></label>
								<div>
									<input type="text" required class="form-control input-sm" name="email" id="email" value="<?php echo $this->m->user_value('email'); ?>" placeholder="<?php echo $this->lang->line('pwidgets_my_account_email'); ?>" />
									<div id="emailerror" class="red"></div>
								</div>
							</div>
						</div>
						<?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>
							<div class="form-group">
								<div class="col-md-6 col-sm-6">
									<label for="academic_grade"><?php echo $this->lang->line('pwidget_profile_academic_grade'); ?></label>
									<div>
										<input type="text" class="form-control input-sm" name="academic_grade" id="academic_grade" value="<?php echo $this->m->user_value('academic_grade'); ?>" placeholder="<?php echo $this->lang->line('pwidget_profile_academic_grade'); ?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<label for="address"><?php echo $this->lang->line('pwidgets_my_account_doctor_address'); ?></label>
									<div>
										<input type="text" class="form-control input-sm" name="prac_address" id="prac_address" value="<?php echo $this->m->user_value('prac_address'); ?>" />
									</div>
								</div>
							</div>
						<?php endif ?>

						<?php if ($this->m->user_role() == M::ROLE_PATIENT): ?>
							<div class="form-group">
								<div class="col-md-6 col-sm-6">
									<label for="birthname"><?php echo $this->lang->line('pwidgets_my_account_birth_name'); ?></label>
									<div>
										<input type="text" class="form-control input-sm" name="birthname" id="birthname" value="<?php echo $this->m->user_value('birthname'); ?>" placeholder="" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<label for="dob"><?php echo $this->lang->line('pwidgets_my_account_birth_date'); ?><span class="red">&nbsp;*</span></label>
									<div>
										<div class="input-icon datetime-pick dob">
											<input type="text" required class="form-control input-sm input-sm"  name="dob" data-format="dd.MM.yyyy" id="dob" value="<?php echo date('d.m.Y', strtotime($this->m->user_value('dob'))); ?>" placeholder="" readonly="readonly" />
											<span class="add-on"><i class="fa fa-calendar"></i></span>
										</div>
										<div id="doberror" class="red"></div>
									</div>
								</div>
							</div>
						<?php endif ?>
						<div class="form-group">
							<div class="col-md-6 col-sm-6">
								<label><?php echo $this->lang->line('pwidgets_my_account_sex'); ?></label>
								<div>
									<div class="radio-inline">
										<label><input type="radio" value="2" id="gender_1" name="gender" <?php echo $this->m->user_value('gender') == '2' ? 'checked="checked"' : ''; ?> /> <?php echo $this->lang->line('pwidgets_my_account_sex_female'); ?></label>
									</div>
									<div class="radio-inline">
										<label><input type="radio" value="1" id="gender_2" name="gender" <?php echo $this->m->user_value('gender') == '1' ? 'checked="checked"' : ''; ?> /> <?php echo $this->lang->line('pwidgets_my_account_sex_male'); ?></label>
									</div>
								</div>
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-12 col-sm-12" style="margin-bottom:25px;">                 
								<?php $insurance_type = $this->m->user_value('insurance_type'); ?>
								<div class="radio-inline">
									<label>
										<input type="radio" class="form-control input-sm" name="insurance_type" id="insurance_type" value="1" placeholder="" <?=(isset($insurance_type) && $insurance_type == '1' ? "checked='checked'" : '');?> />
										<?php echo $this->lang->line('pwidgets_my_acco_insurance_pub');?> 
									</label>
								</div>
								<div class="radio-inline">
									<label>
										<input type="radio" class="form-control input-sm" name="insurance_type" id="insurance_type" value="2" placeholder="" <?=(isset($insurance_type) && $insurance_type == '2' ? "checked='checked'" : '');?> />
										<?php echo $this->lang->line('pwidgets_my_acco_insurance_pri');?>
									</label>
								</div>
							</div>
							<div class="col-md-6 col-sm-6" style="clear:both">
								<label for="insurance_provider">&nbsp;</label>
								<select name="insurance_provider" id="insurance_provider" class="form-control input-sm">
									<?php 
									if(isset($insurance_provider) && count($insurance_provider) > 0 ) {
										$val = $this->m->user_value('insurance_provider');
										foreach($insurance_provider as $ip):         
											if(isset($ip->code) && $val == $ip->code )
											{
												echo "<option value='".$ip->code."' selected='selected' >".$ip->name."</option>";  
											}else{
												echo "<option value='".$ip->code."'>".$ip->name."</option>";  
											}

											endforeach;
										}
									?>
								</select>
							</div>
							<div class="col-md-6 col-sm-6">
									<label for="subscriber_id">
										<?php echo $this->lang->line('pwidgets_my_acco_subscribe_id');?>
									</label>
									<div>
										<input type="text" class="form-control input-sm" name="subscriber_id" id="subscriber_id" value="<?php echo $this->m->user_value('subscriber_id'); ?>" />
									</div>
							</div>
						</div>
						<hr />
						<h4><?php echo $this->lang->line('pwidgets_my_acco_mail_addr'); ?></h4>
						<div class="form-group">
						<div class="col-md-12">
							<label for="address"><?php echo $this->lang->line('pwidgets_my_account_street_house_number'); ?></label>
							<div>
								<input type="text" class="form-control input-sm" name="address" id="address" value="<?php echo $this->m->user_value('address'); ?>" placeholder="" />
							</div>
						</div>
						</div>
						<div class="form-group">
						<div class="col-md-6 col-sm-6">
							<label for="zip"><?php echo $this->lang->line('pwidgets_my_account_zip_code'); ?></label>
							<div>
								<input type="text" class="form-control input-sm" name="zip" id="zip" value="<?php echo $this->m->user_value('zip'); ?>" placeholder="" />
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<label for="city"><?php echo $this->lang->line('pwidgets_my_account_city'); ?>  </label>
							<div>
								<input type="text" class="form-control input-sm" name="city" id="city" value="<?php echo $this->m->user_value('city'); ?>" placeholder="" />
							</div>
						</div>
						</div>
						<div class="form-group">
						<div class="col-md-6 col-sm-6">
							<label for="region"><?php echo $this->lang->line('pwidgets_my_account_region'); ?></label>
							<div><input type="text" class="form-control input-sm" name="region" id="region" value="<?php echo $this->m->user_value('region'); ?>" placeholder="" /></div>
						</div>
						<div class="col-md-6 col-sm-6">
							<label for="country"><?php echo $this->lang->line('pwidgets_my_account_country'); ?></label>
							<div>
								<select type="text" name="country" id="country" class="form-control" >
									<?php foreach ($this->country->get()->result() as $c) : ?>
										<option value="<?php echo $c->id; ?>" <?php echo $this->m->user_value('country') && $c->id == $this->m->user_value('country') ? 'selected="selected"' : '' ?> > <?php echo $c->country_name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						</div>
						<div class="form-group">
						<div class="col-md-6 col-sm-6">
							<label for="telephone"><?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?></label>
							<div>
								<input type="text" class="form-control input-sm" name="telephone"  placeholder="" id="telephone" value="<?php echo $this->m->user_value('telephone'); ?>" />
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<label for="mobile"><?php echo $this->lang->line('pwidgets_my_account_mobile_number'); ?></label>
							<div>
								<input type="text" class="form-control input-sm" name="mobile"   data-mask-maxlength="false"  id="mobile" value="<?php echo $this->m->user_value('mobile'); ?>"/>
							</div>
						</div>
						</div>
						<div class="form-group">
								<div class="col-md-6 col-sm-6">
									<label for="fax"><?php echo $this->lang->line('pwidgets_my_account_fax_number'); ?></label>
									<div>
										<input type="text" class="form-control input-sm" name="fax" id="fax" value="<?php echo $this->m->user_value('fax'); ?>"  />
									</div>
								</div>
						</div>        
						<?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?> 
								<div class="form-group">
									<div class="col-md-6 col-sm-6">
										<label for="inputStreetAdditional">Adresszusatz</label>
										<div>
											<input type="text" class="form-control" name="street_additional" value="<?php echo $this->m->user_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="Adresszusatz">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<label for="inputCoordinate">Koordinaten</label>
										<div>
											<div class="col-sm-4" style="padding-left:0px">
												<label for="inputCoordinateLat" class="col-sm-2 sr-only">Breite</label>
												<input type="text" class="form-control" name="coordinate_lat" id="inputCoordinateLat" value="<?php echo $this->m->user_value('coordinate_lat'); ?>" placeholder="Breite" readonly>
											</div>
											<div class="col-sm-4" style="padding-left:0px">
												<label for="inputCoordinateLng" class="col-sm-2 sr-only">L�nge</label>
												<input type="text" class="form-control" name="coordinate_lng" id="inputCoordinateLng"value="<?php echo $this->m->user_value('coordinate_lng'); ?>" placeholder="L�nge" readonly>
											</div>
											<div class="col-sm-4" style="padding-left:0px">
												<button type="button" id="inputCoordinate" class="btn btn-default btn-block">Apportieren</button>
											</div>
										</div>
									</div>
								</div>
						<?php endif;?>
						<hr />
						<h4>
							<?php echo $this->lang->line('pwidgets_my_acco_adn_info'); ?>
						</h4>
						<div class="form-group">
						<div class="col-md-6 col-sm-6">
							<label for="relationship_status"><?php echo $this->lang->line('pwidgets_my_account_relationshipstatus'); ?></label>
							<div>
								<select name="relationship_status" id="relationship_status" class="form-control">	
									<option value=""><?php echo $this->lang->line('pwidgets_my_acco_chose'); ?></option>
									<option  value="1" <?php echo ($this->m->user_value('relationship_status')==1) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_married'); ?></option>
									<option value="2" <?php echo ($this->m->user_value('relationship_status')==2) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_single'); ?></option>
									<option value="3" <?php echo ($this->m->user_value('relationship_status')==3) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_unknown'); ?></option>
									<option value="4" <?php echo ($this->m->user_value('relationship_status')==4) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_divorce'); ?></option>
									<option value="5" <?php echo ($this->m->user_value('relationship_status')==5) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_separate'); ?></option>
									<option value="6" <?php echo ($this->m->user_value('relationship_status')==6) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_widow'); ?></option>
									<option value="7" <?php echo ($this->m->user_value('relationship_status')==7) ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('pwidgets_my_acco_dom_partner'); ?></option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
									<label for="occupation"><?php echo $this->lang->line('pwidgets_my_account_occupation'); ?></label>
									<div>
										<select name="occupation" id="occupation" class="form-control">
											<option value=""><?php echo $this->lang->line('pwidgets_my_acco_chose'); ?></option>
											<option value="1" <?php echo ($this->m->user_value('occupation')==1) ? 'selected="selected"' : ''; ?>>Activist</option>
											<option value="2" <?php echo ($this->m->user_value('occupation')==2) ? 'selected="selected"' : ''; ?>>Agricultural</option>
											<option value="3" <?php echo ($this->m->user_value('occupation')==3) ? 'selected="selected"' : ''; ?>>Arts</option>
											<option value="4" <?php echo ($this->m->user_value('occupation')==4) ? 'selected="selected"' : ''; ?>>Business and financial operation</option>
											<option value="5" <?php echo ($this->m->user_value('occupation')==5) ? 'selected="selected"' : ''; ?>>Cleaning and maintenance</option>
											<option value="6" <?php echo ($this->m->user_value('occupation')==6) ? 'selected="selected"' : ''; ?>>Computer occupation</option>
											<option value="7" <?php echo ($this->m->user_value('occupation')==7) ? 'selected="selected"' : ''; ?>>Construction and extraction</option>
											<option value="8" <?php echo ($this->m->user_value('occupation')==8) ? 'selected="selected"' : ''; ?>>Consulting</option>
											<option value="9" <?php echo ($this->m->user_value('occupation')==9) ? 'selected="selected"' : ''; ?>>Copyist</option>
											<option value="10" <?php echo ($this->m->user_value('occupation')==10) ? 'selected="selected"' : ''; ?>>Design</option>
											<option value="11" <?php echo ($this->m->user_value('occupation')==11) ? 'selected="selected"' : ''; ?>>Education and training</option>
											<option value="12" <?php echo ($this->m->user_value('occupation')==12) ? 'selected="selected"' : ''; ?>>Engineering</option>
											<option value="13" <?php echo ($this->m->user_value('occupation')==13) ? 'selected="selected"' : ''; ?>>Entertainment</option>
											<option value="14" <?php echo ($this->m->user_value('occupation')==14) ? 'selected="selected"' : ''; ?>>Fashion</option>
											<option value="15" <?php echo ($this->m->user_value('occupation')==15) ? 'selected="selected"' : ''; ?>>Government</option>
											<option value="16" <?php echo ($this->m->user_value('occupation')==16) ? 'selected="selected"' : ''; ?>>Healthcare</option>
											<option value="17" <?php echo ($this->m->user_value('occupation')==17) ? 'selected="selected"' : ''; ?>>Hospitality</option>
											<option value="18" <?php echo ($this->m->user_value('occupation')==18) ? 'selected="selected"' : ''; ?>>Humanities</option>
											<option value="19" <?php echo ($this->m->user_value('occupation')==19) ? 'selected="selected"' : ''; ?>>Industrial</option>
											<option value="20" <?php echo ($this->m->user_value('occupation')==20) ? 'selected="selected"' : ''; ?>>Journalist</option>
											<option value="21" <?php echo ($this->m->user_value('occupation')==21) ? 'selected="selected"' : ''; ?>>Lawyer</option>
											<option value="22" <?php echo ($this->m->user_value('occupation')==22) ? 'selected="selected"' : ''; ?>>Legal Professions</option>
											<option value="23" <?php echo ($this->m->user_value('occupation')==23) ? 'selected="selected"' : ''; ?>>Management</option>
											<option value="24" <?php echo ($this->m->user_value('occupation')==24) ? 'selected="selected"' : ''; ?>>Maritime</option>
											<option value="25" <?php echo ($this->m->user_value('occupation')==25) ? 'selected="selected"' : ''; ?>>Media</option>
											<option value="26" <?php echo ($this->m->user_value('occupation')==26) ? 'selected="selected"' : ''; ?>>Military</option>
											<option value="28" <?php echo ($this->m->user_value('occupation')==28) ? 'selected="selected"' : ''; ?>>Political</option>
											<option value="29" <?php echo ($this->m->user_value('occupation')==29) ? 'selected="selected"' : ''; ?>>Product tester</option>
											<option value="30" <?php echo ($this->m->user_value('occupation')==30) ? 'selected="selected"' : ''; ?>>Production</option>
											<option value="31" <?php echo ($this->m->user_value('occupation')==31) ? 'selected="selected"' : ''; ?>>Religious</option>
											<option value="32" <?php echo ($this->m->user_value('occupation')==32) ? 'selected="selected"' : ''; ?>>Sales</option>
											<option value="33" <?php echo ($this->m->user_value('occupation')==33) ? 'selected="selected"' : ''; ?>>Science</option>
											<option value="34" <?php echo ($this->m->user_value('occupation')==34) ? 'selected="selected"' : ''; ?>>Service</option>
											<option value="35" <?php echo ($this->m->user_value('occupation')==35) ? 'selected="selected"' : ''; ?>>Sports</option>
											<option value="36" <?php echo ($this->m->user_value('occupation')==36) ? 'selected="selected"' : ''; ?>>Transport</option>
										</select>
									</div>
						</div>
						</div>
						<div class="form-group">
								<div class="col-md-6 col-sm-6">
									<label for="ethnicity"><?php echo $this->lang->line('pwidgets_my_account_ethnicity'); ?></label>
									<div>
										<select  name="ethnicity" class="form-control">
											<option value=""><?php echo $this->lang->line('pwidgets_my_acco_chose'); ?></option>
											<option value="8" <?php echo ($this->m->user_value('ethnicity')==8) ? 'selected="selected"' : ''; ?>>Hispanic or Latino</option>
											<option value="9" <?php echo ($this->m->user_value('ethnicity')==9) ? 'selected="selected"' : ''; ?>>Not Hispanic or Latino</option>
											<option value="10" <?php echo ($this->m->user_value('ethnicity')==10) ? 'selected="selected"' : ''; ?>>Patient Declined</option>
											<option value="15" <?php echo ($this->m->user_value('ethnicity')==15) ? 'selected="selected"' : ''; ?>>N/A</option>
											<option value="28" <?php echo ($this->m->user_value('ethnicity')==28) ? 'selected="selected"' : ''; ?>>UNKNOWN</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<label for="race"><?php echo $this->lang->line('pwidgets_my_account_race'); $race=explode(',',$this->m->user_value('race')); ?></label>
									<div>
										<select multiple="multiple"  name="race[]" id="" class="form-control">
											<option value="1" <?php echo (in_array('1',$race)) ? 'selected="selected"' : ''; ?>>African/African-American</option>
											<option value="2" <?php echo (in_array('2',$race)) ? 'selected="selected"' : ''; ?>>Asian</option>
											<option value="3" <?php echo (in_array('3',$race)) ? 'selected="selected"' : ''; ?>>Native American</option>
											<option value="4" <?php echo (in_array('4',$race)) ? 'selected="selected"' : ''; ?>>Pacific Islander/ Native Hawaiian</option>
											<option value="5" <?php echo (in_array('5',$race)) ? 'selected="selected"' : ''; ?>>Mixed Race</option>
											<option value="6" <?php echo (in_array('6',$race)) ? 'selected="selected"' : ''; ?>>Other</option>
											<option value="7" <?php echo (in_array('7',$race)) ? 'selected="selected"' : ''; ?>>Caucasian</option>
											<option value="11" <?php echo (in_array('11',$race)) ? 'selected="selected"' : ''; ?>>AMERICAN INDIAN OR ALASKA NATIVE</option>
											<option value="14" <?php echo (in_array('14',$race)) ? 'selected="selected"' : ''; ?>>N/A</option>
											<option value="16" <?php echo (in_array('16',$race)) ? 'selected="selected"' : ''; ?>>PATIENT DECLINED</option>
											<option value="17" <?php echo (in_array('17',$race)) ? 'selected="selected"' : ''; ?>>WHITE</option>
											<option value="18" <?php echo (in_array('18',$race)) ? 'selected="selected"' : ''; ?>>BLACK OR AFRICAN AMERICAN</option>
											<option value="19" <?php echo (in_array('19',$race)) ? 'selected="selected"' : ''; ?>>HISPANIC OR LATINO</option>
											<option value="22" <?php echo (in_array('22',$race)) ? 'selected="selected"' : ''; ?>>NATIVE HAWAIIAN OR OTHER PACIFIC ISLANDER</option>
											<!--<option value="26" <?php echo (in_array('26',$race)) ? 'selected="selected"' : ''; ?>></option>-->
											<option value="27" <?php echo (in_array('27',$race)) ? 'selected="selected"' : ''; ?>>UNKNOWN</option>
										</select>
									</div>
								</div>
						</div>    

						<?php if ($this->m->user_role() == M::ROLE_PATIENT): ?>                
								<hr />

								<div class="row">
									<div class="col-md-6 col-sm-6">
										<h4><?php echo $this->lang->line('pwidgets_my_account_emergency_contact_title'); ?></h4>
										<div class="form-group">                    
											<div class="col-md-12 col-sm-12"><label for="emergency_name"><?php echo $this->lang->line('pwidgets_my_account_person_name'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="emergency_name" id="emergency_name" value="<?php echo $this->m->user_value('emergency_name'); ?>" placeholder="" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12"><label for="emergency_doctor_id"><?php echo $this->lang->line('pwidgets_my_account_doctor_id'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="emergency_doctor_id" id="emergency_doctor_id" value="<?php echo $this->m->user_value('emergency_doctor_id'); ?>" placeholder="" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12"><label for="emergency_telephone"><?php echo $this->lang->line('pwidgets_my_account_emergency_contact_telephone'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="emergency_telephone" id="emergency_telephone" value="<?php echo $this->m->user_value('emergency_telephone'); ?>" placeholder="000-00000000" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<h4><?php echo $this->lang->line('pwidgets_my_account_family_doctor_title'); ?></h4>
										<div class="form-group">                    
											<div class="col-md-12 col-sm-12"><label for="family_doctor_name"><?php echo $this->lang->line('pwidgets_my_account_person_name'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="family_doctor_name" id="family_doctor_name" value="<?php echo $this->m->user_value('family_doctor_name'); ?>" placeholder="" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12"><label for="family_doctor_telephone"><?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="family_doctor_telephone" id="family_doctor_telephone" value="<?php echo $this->m->user_value('family_doctor_telephone'); ?>" placeholder="000-00000000" />
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12"><label for="family_doctor_id"><?php echo $this->lang->line('pwidgets_my_account_doctor_id'); ?></label>
												<div>
													<input type="text" class="form-control input-sm" name="family_doctor_id" id="family_doctor_id" value="<?php echo $this->m->user_value('family_doctor_id'); ?>" placeholder="" />
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php endif ?>


						<?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>
								<div class="form-group">
									<div class="col-md-6">
										<label for="website"><?php echo $this->lang->line('pwidgets_my_account_website'); ?></label>
										<div>
											<input type="text" class="form-control input-sm" name="website" id="website" value="<?php echo $this->m->user_value('website'); ?>" placeholder="" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="emergency_number"><?php echo $this->lang->line('pwidgets_my_account_emergency_number'); ?></label>
										<div>
											<input type="text" class="form-control input-sm" name="emergency_number" id="emergency_number" value="<?php echo $this->m->user_value('emergency_number'); ?>" placeholder="000-00000000" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<label for="specialization"><?php echo $this->lang->line('pwidgets_my_account_specialization'); ?></label>
										<div>
											<select type="text" name="specialization[]" id="specialization" class="tag-select-limited form-control"  multiple="multiple" >
												<?php foreach ($this->speciality->get_assoc() as $code => $spec) : ?>
													<option value="<?php echo $spec->id; ?>" <?php echo $this->m->user_value('specialization1') && ($spec->id == $this->m->user_value('specialization1') || is_array($this->m->user_value('specialization1')) && in_array($spec->id, $this->m->user_value('specialization1')) ) ? 'selected="selected"' : '' ?> > <?php echo $spec->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">                	
									<fieldset>
										<h3>Sprache(n)</h3>
										<div class="row">
											<div class="col-md-6">
												<label for="inputLanguagesSelector" class="control-label">Zur Auswahl bitte anklicken</label>
												<select multiple size="8" class="form-control" id="inputLanguagesSelector">
													<?php foreach($this->language->get_assoc() as $row) : ?>
														<option value="<?php echo $row->code; ?>"><?php echo $row->name; ?> / <?php echo $row->native; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="col-md-6">
												<label for="inputLanguages" class="control-label">&nbsp;</label>
												<select size="8" class="form-control" name="languages[]" id="inputLanguages" data-toggle="mSelector" data-selector="#inputLanguagesSelector" data-control-up="#inputLanguagesMoveUp" data-control-down="#inputLanguagesMoveDown" data-control-delete="#inputLanguagesDelete" >
													<?php foreach ($this->m->user()->native->langs_assoc as $code => $row) : ?>
														<option value="<?php echo $code; ?>"><?php echo $row->name; ?> / <?php echo $row->native; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group"></div>
										<div class="row">
											<div class="col-md-12 text-right">
												<button type="button" id="inputLanguagesMoveUp" class="btn btn-default">Nach oben</button>
												<button type="button" id="inputLanguagesMoveDown" class="btn btn-default">Nach unten</button>
												<button type="button" id="inputLanguagesDelete" class="btn btn-danger">Löschen</button>
												<button type="submit" class="btn btn-primary">Speichern</button>
											</div>
										</div>
										<hr />
									</fieldset>
									<fieldset>
										<h3>Textfelder</h3>
										<div class="row">
											<div class="col-md-6">
												<label for="inputClinic" class="control-label">Beschreibung</label>
												<textarea class="form-control" rows="5" name="text_description" id="inputClinic" placeholder="Beschreibung"><?php echo $this->m->user_value('text_description'); ?></textarea>
											</div>
											<div class="col-md-6">
												<label for="inputVET" class="control-label">Aus- und Weiterbildung</label>
												<textarea class="form-control" rows="5" name="text_vet" id="inputVET" placeholder="Aus- und Weiterbildung"><?php echo $this->m->user_value('text_vet'); ?></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label for="inputMoreForPatient" class="control-label">Weitere Informationen für Patienten</label>
												<textarea class="form-control" rows="5" name="text_more_for_patient" id="inputMoreForPatient" placeholder="Weitere Informationen für Patienten"><?php echo $this->m->user_value('text_more_for_patient'); ?></textarea>
											</div>
											<div class="col-md-6">
												<label for="inputMembership" class="control-label">Mitgliedschaften</label>
												<textarea class="form-control" rows="5" name="text_membership" id="inputMembership" placeholder="Mitgliedschaften"><?php echo $this->m->user_value('text_membership'); ?></textarea>
											</div>
										</div>
									</fieldset>
								</div>
						<?php endif; ?>
						<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>                  
						</div>
						</div>
					</form>


				</div> <!-- /.tab-pane -->

				<div class="tab-pane fade" id="password-tab">

						<h3 class="content-title"><u><?php echo $this->lang->line('pwidgets_my_account_tab2'); ?></u></h3>

						<form id="identicalForm" method="post" action="<?php echo site_url('akte/profile/update_password'); ?>" class="form-horizontal" enctype="multipart/form-data">

							<div class="form-group">

								<label class="col-sm-3"><?php echo $this->lang->line('pwidgets_my_account_old_pass'); ?><span class="red">&nbsp;*</span></label>

								<div class="col-sm-7">
									<input type="password" name="oldpassword" id="inputPassword" class="form-control" required placeholder="<?php echo $this->lang->line('pwidgets_my_account_old_pass'); ?>"/>
								</div> <!-- /.col -->

							</div> <!-- /.form-group -->
							<div class="form-group">

								<label class="col-sm-3"><?php echo $this->lang->line('pwidgets_my_account_new_pass'); ?><span class="red">&nbsp;*</span></label>

								<div class="col-sm-7">
									<input type="password" class="form-control" name="newpassword" id="inputPassword1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort" required />
								</div> <!-- /.col -->

							</div> <!-- /.form-group -->


							<div class="form-group">

								<label class="col-sm-3"><?php echo $this->lang->line('pwidgets_my_account_pass_confirm'); ?><span class="red">&nbsp;*</span></label>

								<div class="col-sm-7">
									<input type="password" class="form-control" name="confirmpassword" id="inputPassword2" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort wiederholen" required />
								</div> <!-- /.col -->

							</div> <!-- /.form-group -->


							<div class="form-group">

								<div class="col-sm-7 col-md-push-3">
									<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('pwidgets_my_account_submit'); ?></button>
									&nbsp;
									<button type="reset" class="btn btn-default"><?php echo $this->lang->line('pwidgets_my_account_cancel'); ?></button>
								</div> <!-- /.col -->

							</div> <!-- /.form-group -->

						</form>
				</div> <!-- /.tab-pane -->


				<div class="tab-pane fade" id="messaging">

						<h3 class="content-title"><u><?php echo $this->lang->line('pwidgets_my_account_service_packages'); ?></u></h3>
						<form action="#" class="form form-horizontal">
							<p><h3><?php echo $this->lang->line('pwidgets_my_acco_chose'); ?> </h3> </p>
							<div class="col-sm-12">
								<div class="form-group">
									<?php if ($this->m->user_role() == M::ROLE_PATIENT): ?>
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn btn-default " type="submit">
												<p class="icomoon font24 i-cart-4"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_free'); ?></p>
												<p class="fntfree"><?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>                
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn  btn-default " type="submit">
												<p class="icomoon font24 i-cart-checkout"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_basic'); ?></p>
												<p class="fntbasic"> <?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a> 
										</div>                
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn  btn-default " type="submit">
												<p class="icomoon font24 i-coin"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_complete'); ?> </p>
												<p class="fntcompl"><?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>                 
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn  btn-default " type="submit">
												<p class="icomoon font24 i-people"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_family'); ?></p>
												<p class="fntfamly"><?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>
									<?php else: ?>
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn btn-default " type="submit">
												<p class="icomoon font24 i-cart-4"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_free'); ?></p>
												<p class="fntfree"> <?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn btn-default" type="submit">
												<p class="icomoon font24 i-cart-checkout"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_eappointment'); ?></p>
												<p class="fntbasic"> <?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>                

										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn btn-default" type="submit">
												<p class="icomoon font24 i-coin"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_eprescription'); ?> </p>
												<p class="fntcompl"><?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>                 
										<div class="col-md-3 col-sm-6 responsive-package">
											<a href="#" class="btn btn-default" type="submit">
												<p class="icomoon font24 i-people"></p>
												<p class="font22 fntbold"><?php echo $this->lang->line('pwidgets_my_account_packet_video'); ?></p>
												<p class="fntfamly"><?php echo $this->lang->line('pwidgets_my_account_packet_free_package'); ?></p>
											</a>
										</div>
									<?php endif;?>
								</div>
							</div> <!-- /.form-group -->

						</form>
				</div> <!-- /.tab-pane -->
				<div class="tab-pane fade" id="setting">
						<h3 class="content-title"><u><?php echo $this->lang->line('general_text_menu_setting');?></u></h3>            
						<?php 
						echo $last_tab;
						?>
				</div> 

				<?php   if ($this->m->user_role() == M::ROLE_DOCTOR){  ?>
					<div class="tab-pane fade" id="connect">
							<h3 class="content-title">
								<u><?php echo $this->lang->line('doctorconnect_text_menu_setting');?></u>
							</h3>            
							<?php 
							echo $this->load->view('profile/doctor_connect_struct_view');
							?>
					</div>
					<div class="tab-pane fade" id="doc-setting">
						<?php
							echo $this->load->view('termin/settings/new_settings_view');
						?>
					</div>
					<div class="tab-pane fade" id="practice">
							<h3 class="content-title"><u><?php echo $this->lang->line('general_text_menu_practice');?></u></h3>            
							<form id="identicalForm" method="post" action="<?php echo site_url('akte/profile/update_practice'); ?>" class="form-horizontal" enctype="multipart/form-data">                        
								<div class="form-group">
									<fieldset>
										<h4><?php echo $this->lang->line('pwidgets_practice_des'); ?></h4>
										<div class="row">
											<div class="col-md-6">
												<label for="doctorassoctext1" class="control-label">Wir bieten</label>
												<textarea class="form-control" rows="5" name="doctorassoctext1" id="doctorassoctext1" placeholder="Wir bieten"><?php echo $this->m->user_value('doctorassoctext1'); ?></textarea>
											</div>
											<div class="col-md-6">
												<label for="inputVET" class="control-label">Aktuell</label>
												<textarea class="form-control" rows="5" name="doctorassoctext2" id="doctorassoctext2" placeholder="Aktuell"><?php echo $this->m->user_value('doctorassoctext2'); ?></textarea>
											</div>
											<div class="col-md-12">
												<label for="inputMoreForPatient" class="control-label">Practices</label>
												<textarea class="form-control" rows="5" name="doctorassoctext3" id="doctorassoctext3" placeholder="Practices"><?php echo $this->m->user_value('doctorassoctext3'); ?></textarea>
											</div>
										</div>
									</fieldset>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-12 col-sm-12">  
											<span>
												<h4><?php echo $this->lang->line('pwidgets_practice_img'); ?></h4>
											</span>
										</div>
										<div class="col-md-4 col-sm-4">
											<!--                    	<label for="doctorassoc1"><?php // echo $this->lang->line('pwidgets_my_acco_bild'); ?></label>-->
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail">
													<img class="profile-pic img-responsive" src="<?php  echo ($img_path = $this->mdoc->get_associate_image($this->m->user_value('doctorassoc1'))) ? base_url($img_path) : '//placehold.it/120x120'; ?>" alt="Profile Avatar" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileupload-new"><?php echo $this->lang->line('pwidgets_my_acco_select_img'); ?></span>
														<span class="fileupload-exists"><?php echo $this->lang->line('pwidgets_my_acco_change_img'); ?></span>
														<input type="file" name="doctorassoc1" id="doctorassoc1" />
													</span>                                
													<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('pwidgets_my_acco_remove_img'); ?></a>
												</div>                        
											</div>
										</div>                
										<div class="col-md-4 col-sm-4">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" >
													<img class="profile-pic img-responsive" src="<?php  echo ($img_path = $this->mdoc->get_associate_image($this->m->user_value('doctorassoc2'))) ? base_url($img_path) : '//placehold.it/120x120'; ?>" alt="Profile Avatar" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileupload-new"><?php echo $this->lang->line('pwidgets_my_acco_select_img'); ?></span>
														<span class="fileupload-exists"><?php echo $this->lang->line('pwidgets_my_acco_change_img'); ?></span>
														<input type="file" name="doctorassoc2" id="doctorassoc2" />
													</span>                                
													<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('pwidgets_my_acco_remove_img'); ?></a>
												</div>                        
											</div>
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" >
													<img class="profile-pic img-responsive" src="<?php  echo ($img_path = $this->mdoc->get_associate_image($this->m->user_value('doctorassoc3'))) ? base_url($img_path) : '//placehold.it/120x120'; ?>" alt="Profile Avatar" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="width: 200px; height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileupload-new"><?php echo $this->lang->line('pwidgets_my_acco_select_img'); ?></span>
														<span class="fileupload-exists"><?php echo $this->lang->line('pwidgets_my_acco_change_img'); ?></span>
														<input type="file" name="doctorassoc3" id="doctorassoc3" />
													</span>                                
													<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('pwidgets_my_acco_remove_img'); ?></a>
												</div>                        
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-center">
										<button class="btn btn-alt btn-lg" type="submit">
											<span class="icomoon i-loop-4">

											</span> 
											<?php echo $this->lang->line('general_text_button_update'); ?>
										</button>                  
									</div>
								</div>
							</form>
					</div>            
				<?php } ?>


			</div> <!-- /.tab-content -->

		</div> <!-- /.col -->

	</div> <!-- /.row -->


</div> <!-- /.container -->


<script type="text/javascript">		

	$("#myTab li a[href^='#']").on('click', function(e) {

    	// prevent default anchor click behavior
    	e.preventDefault();

    	// store hash
    	var hash = this.hash;

    	// animate
    	$('html, body').animate({
    		scrollTop: $(hash).offset().top
    	}, 300, function(){
    		scrollTop: $(hash).offset().top
    	    // when done, add hash to url
    	    // (default click behaviour)
    		//window.location.hash = hash;
    	});
    });

	$('input[type="file"]').change(function(){
		var file = $('input[type="file"]').val();
		var exts = ['jpg','png','jpeg','gif','tif'];
       	// first check if file field has any value
       	if ( file ) {
         	// split file name at dot
         	var get_ext = file.split('.');
         	// reverse name to check extension
         	get_ext = get_ext.reverse();
         	// check file type is valid as given in 'exts' array
         	if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
           	//alert( 'Allowed extension!' );
        	} else {
        		alert( 'Invalid file! You can upload jpg, png, jpeg, gif, tif only.');
        		$('.fileinput').fileinput('clear');
        	}
      	}
   	});
			

	<?php if(isset($active_tab) && $active_tab<>"") :?>
		$("a[href='#<?php echo $active_tab;?>']").click();
	<?php endif;?>
	
</script>
<script type="text/javascript">
	$("#identicalForm").submit(function(e){
		e.preventDefault();
		var passwordRegex = new RegExp(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{6,}/);

		if(jQuery("#inputPassword").val()=="")
		{
			alert("Please enter old password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery("#inputPassword").val()))
		{
			alert("Password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery("#inputPassword1").val()=="")
		{
			alert("Please enter new password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery("#inputPassword1").val()))
		{
			alert("New password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery("#inputPassword2").val()=="")
		{
			alert("Please enter confirm password.");
			return false;
		}
		else if(!passwordRegex.test(jQuery("#inputPassword2").val()))
		{
			alert("Confirm password must contain at least 6 characters, including UPPER/lowercase and numbers.");
			return false;
		}
		else if(jQuery("#inputPassword1").val()!=jQuery("#inputPassword2").val())
		{
			alert("Password and confirm password must be same.");
			return false;
		}
		else 
		{
			var ajaxurl = "<?php echo site_url('akte/profile/update_password/0'); ?>";
			jQuery.ajax({
				type:'POST',
				data:{oldpassword:jQuery("#inputPassword").val(),
				newpassword:jQuery("#inputPassword1").val(),
				confirmpassword:jQuery("#inputPassword2").val()},
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
		}
	});
</script>
<script>
	function formvalidation()
	{
		var name = document.getElementById("name").value;
		var surname = document.getElementById("surname").value;
		var email = document.getElementById("email").value;

		if(name=="")
		{
			document.getElementById("nameerror").innerHTML = "Bitte geben Sie einen Namen ..!";  
			document.getElementById("name").focus();
			return false;
		}
		else
		{
			document.getElementById("nameerror").innerHTML = "";
		}

		if(surname=="")
		{
			document.getElementById("surnameerror").innerHTML = "Bitte geben Sie einen Namen ..!";  
			document.getElementById("surname").focus();
			return false;
		}
		else
		{
			document.getElementById("surnameerror").innerHTML = "";
		}

		if(email=="")
		{
			document.getElementById("emailerror").innerHTML = "Bitte geben Sie einen Namen ..!";  
			document.getElementById("email").focus();
			return false;
		}
		else
		{
			document.getElementById("emailerror").innerHTML = "";
		}

		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

		if(emailRegex.test(email))
		{
			document.getElementById("emailerror").innerHTML = "";
		}
		else
		{
			document.getElementById("emailerror").innerHTML = "Bitte geben Sie eine g�ltige E-Mail-Adresse ein ..!";  
			document.getElementById("email").focus();
			return false;
		}

		var currentDate = new Date('<?php echo $today;?>');
		var str=$('#dob').val();
		var res = str.split(".");
		var dob = res[1]+'/'+res[0]+'/'+res[2];
		var dob1 = new Date(dob);
		if(dob1 > currentDate)
		{
			document.getElementById("doberror").innerHTML = "Bitte geben Sie eine gültige Geburtsdatum ..!";  
			document.getElementById("dob").focus();
			return false;
		}
		else
		{
			document.getElementById("doberror").innerHTML = "";
		} 
	}

	$(function(){
		$.pageSetup($('#main-content'));
		$('input').on('ifUnchecked',function(e){
			$checkbox = $(this);
			console.log($checkbox.attr('name'));
			$(this).closest('.day-check').next().css('opacity','0');
			$(this).closest('.day-check').next().css('pointer-events','none');
		});
		$('input').on('ifChecked',function(e){
			$checkbox = $(this);
			console.log($checkbox.attr('name'));
			$(this).closest('.day-check').next().css('opacity','1');
			$(this).closest('.day-check').next().css('pointer-events','auto');
		});
	});
</script>

