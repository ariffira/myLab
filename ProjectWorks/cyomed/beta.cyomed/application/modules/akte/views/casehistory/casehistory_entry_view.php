<?php
	$entry = !empty($entry) ? $entry : array(
    	'id' => 0,
  	);
	$entry = (object)$entry;
  	$insert = empty($entry->id);
  	//loading languages
	$this->load->language('global/general_text',$this->m->user_value('language'));
  	$this->load->language('patients/home',$this->m->user_value('language'));
  	$this->load->language('patients/casehistory',$this->m->user_value('language'));
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
<form class="form-horizontal" id="casehistory-form" role="form" method="post" action="<?php echo site_url('akte/casehistory/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
	<input type="hidden" name="id" value="<?php echo $entry->id ?>" />
	<section class="col-md-12 col-sm-12 content-area">
	    <div class="row row1">
	        <div class="col-md-12">
	            <div class="block  block-cyan-chart">
	            	<?php if(empty($insert)): ?>
		 	        	<a href="<?php echo smart_site_url('akte/pdfget/casehistory/'.$entry->id); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span> <?php echo $this->lang->line('patients_home_case_history_pdf'); ?></a>
        			<?php endif; ?>
                    <h2 class="ana-head"><?php echo $this->lang->line('patients_home_case_history'); ?></h2>
	                <div class="panel-group panelcase" id="accordion<?php echo $entry->id ?>" role="tablist" aria-multiselectable="true">
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingOne<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseOne<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span> <?php echo $this->lang->line('main_symptom_and_actual_case_history'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseOne<?php echo $entry->id ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
		                                    <li><?php echo $this->lang->line('localisation_and_range'); ?></li>
								            <li><?php echo $this->lang->line('quality'); ?></li>
								            <li><?php echo $this->lang->line('degree_of_severity'); ?></li>
								            <li><?php echo $this->lang->line('when_do_the_symptoms_appear'); ?></li>
								            <li><?php echo $this->lang->line('anything_that_influences_the_symptoms'); ?></li>
								            <li><?php echo $this->lang->line('when_did_the_symptoms_appear_first'); ?></li>
								            <li><?php echo $this->lang->line('accompanying_symptoms'); ?></li>
								            <li><?php echo $this->lang->line('pre_existing_conditions_with_respect_to_symptom'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="symptom_current_history" id="symptom_current_history" cols="" rows="8"><?php echo @$entry->symptom_current_history;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingTwo<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseTwo<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('general_anamnesis'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseTwo<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
											<li><?php echo $this->lang->line('hunger_thirst'); ?></li>
											<li><?php echo $this->lang->line('weight'); ?></li>
											<li><?php echo $this->lang->line('cough_sputum_dyspnea'); ?></li>
											<li><?php echo $this->lang->line('bowel_movement'); ?></li>
											<li><?php echo $this->lang->line('urination'); ?></li>
											<li><?php echo $this->lang->line('fever_chills'); ?></li>
											<li><?php echo $this->lang->line('night_sweat'); ?></li>
											<li><?php echo $this->lang->line('sleep'); ?></li>
											<li><?php echo $this->lang->line('menstruation_sexual'); ?></li>
	                                	</ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="vegetative_anamnese" id="vegetative_anamnese" cols="" rows="9"><?php echo @$entry->vegetative_anamnese;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingThree<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseThree<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseThree<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('pre_existing_conditions'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseThree<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                        <li><?php echo $this->lang->line('nerves_sensory_organs_mind'); ?></li>
											<li><?php echo $this->lang->line('heart_and_circulation'); ?></li>
								            <li><?php echo $this->lang->line('cardiovascular_risk_factors'); ?></li>
								            <li><?php echo $this->lang->line('lungs_and_bronchial_tubes'); ?></li>
								            <li><?php echo $this->lang->line('kidneys'); ?></li>
								            <li><?php echo $this->lang->line('stomach_and_bowel'); ?></li>
								            <li><?php echo $this->lang->line('liver_gall_bladder_pancreas'); ?></li>
								            <li><?php echo $this->lang->line('Metabolism'); ?></li>
											<li><?php echo $this->lang->line('blood_diseases'); ?></li>
											<li><?php echo $this->lang->line('rheumatism'); ?></li>
											<li><?php echo $this->lang->line('tumor_cancer'); ?></li>
											<li><?php echo $this->lang->line('infections_vaccinations'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="pre_existing_conditions" id="pre_existing_conditions" cols="" rows="12"><?php echo @$entry->pre_existing_conditions;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingFour<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseFour<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseFour<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span> <?php echo $this->lang->line('medication'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFour<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                        <li><?php echo $this->lang->line('actual_medication'); ?></li>
								            <li><?php echo $this->lang->line('former_medication'); ?></li>
								            <li><?php echo $this->lang->line('medication_when_needed'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="drug_history" id="drug_history" cols="" rows="3"><?php echo @$entry->drug_history;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingFive<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseFive<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseFive<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('allergies_and_incompatibilities'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFive<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFive">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4"></div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="allergies" id="allergies" cols="" rows="7"><?php echo @$entry->allergies;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingSix<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseSix<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseSix<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('stimulants_and_drugs'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSix<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseSix">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                    	<li><?php echo $this->lang->line('alcohol'); ?></li>
								            <li><?php echo $this->lang->line('nicotine'); ?></li>
								            <li><?php echo $this->lang->line('drugs'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="related_products" id="related_products" cols="" rows="3"><?php echo @$entry->related_products;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingSaven<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseSaven<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseSaven<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span> <?php echo $this->lang->line('family_case_history'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSaven<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseSaven">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                    	<li><?php echo $this->lang->line('parents'); ?></li>
											<li><?php echo $this->lang->line('siblings'); ?></li>
											<li><?php echo $this->lang->line('children'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="family_history" id="family_history" cols="" rows="3"><?php echo @$entry->family_history;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingEight<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseEight<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseEight<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('social_case_history'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseEight<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseEight">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
											<li><?php echo $this->lang->line('profession'); ?></li>
											<li><?php echo $this->lang->line('disability'); ?></li>
											<li><?php echo $this->lang->line('pension'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="social_history" id="social_history" cols="" rows="3"><?php echo @$entry->social_history;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingNine<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseNine<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseNine<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('actual_doctors'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseNine<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4"></div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="attending_physicians" id="attending_physicians" cols="" rows="7"><?php echo @$entry->attending_physicians;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                
		                <h2 class="ana-head">
		                	<?php echo $this->lang->line('findings'); ?> 
		                    <!--<span class="font11 pull-right">Alter ______Jahre, Größe ______ cm, Gewicht______ kg</span>-->
		                </h2>
	                
	                	<div class="panel panel-default">
	                        <div class="" role="tab" id="headingTen<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseTen<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseTen<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('general_findings'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseTen<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                    	<li><?php echo $this->lang->line('general_condition'); ?></li>
											<li><?php echo $this->lang->line('nutritional_status'); ?></li>
											<li><?php echo $this->lang->line('Psyche'); ?></li>
											<li><?php echo $this->lang->line('foetor'); ?></li>
											<li><?php echo $this->lang->line('skin_and_mucose'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="general_findings" id="general_findings" cols="" rows="5"><?php echo @$entry->general_findings;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingElvn<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseElvn<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseElvn<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('head_and_neck'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseElvn<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingElvn<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
		                                    <li><?php echo $this->lang->line('calotte'); ?></li>
											<li><?php echo $this->lang->line('meningism'); ?></li>
											<li><?php echo $this->lang->line('eyes'); ?></li>
											<li><?php echo $this->lang->line('lips'); ?></li>
											<li><?php echo $this->lang->line('teeth'); ?></li>
											<li><?php echo $this->lang->line('mouth_throat_tongue'); ?></li>
											<li><?php echo $this->lang->line('thyroid_gland'); ?></li>
											<li><?php echo $this->lang->line('lymph_nodes'); ?></li>
											<li><?php echo $this->lang->line('jugular_veins'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="head_and_neck" id="head_and_neck" cols="" rows="9"><?php echo @$entry->head_and_neck;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingThten<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseThten<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseThten<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('thorax_and_lungs'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseThten<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThten<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                        <li><?php echo $this->lang->line('rib_cage_or_thorax'); ?></li>
											<li><?php echo $this->lang->line('lymph_nodes'); ?></li>
											<li><?php echo $this->lang->line('lung_borders'); ?></li>
											<li><?php echo $this->lang->line('sound'); ?></li>
											<li><?php echo $this->lang->line('breathing_sound'); ?></li>
											<li><?php echo $this->lang->line('other_sounds'); ?></li>
											<li><?php echo $this->lang->line('breasts'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="thorax_and_lungs" id="thorax_and_lungs" cols="" rows="7"><?php echo @$entry->thorax_and_lungs;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingFoutn<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseFoutn<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseFoutn<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span> <?php echo $this->lang->line('heart_circulation_vessels'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFoutn<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFoutn">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
		                                    <li><?php echo $this->lang->line('heart_rhythm'); ?></li>
											<li><?php echo $this->lang->line('heart_sounds'); ?></li>
											<li><?php echo $this->lang->line('abnormal_sounds'); ?></li>
											<li><?php echo $this->lang->line('peripheral_pulses'); ?></li>
											<li><?php echo $this->lang->line('circulation_noises'); ?></li>
											<li><?php echo $this->lang->line('oedemas'); ?></li>
											<li><?php echo $this->lang->line('varicoses'); ?></li>
											<li><?php echo $this->lang->line('recapillarisation'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="heart_circulation_blood_vessels" id="heart_circulation_blood_vessels" cols="" rows="8"><?php echo @$entry->heart_circulation_blood_vessels;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingFifthin<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseFifthin<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseFifthin<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('abdomen'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFifthin<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFifthin">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                        <li><?php echo $this->lang->line('abdominal_wall'); ?>
												<ul>
													<li><?php echo $this->lang->line('pressure_pain'); ?></li>
													<li><?php echo $this->lang->line('resistances'); ?></li>
													<li><?php echo $this->lang->line('hernias'); ?></li>
													<li><?php echo $this->lang->line('intestinal_noises'); ?></li>
													<li><?php echo $this->lang->line('ascites'); ?></li>
												</ul>
											</li>
											<li><?php echo $this->lang->line('liver'); ?></li>
											<li><?php echo $this->lang->line('spleen'); ?></li>
											<li><?php echo $this->lang->line('kidneys'); ?></li>
											<li><?php echo $this->lang->line('genitals'); ?></li>
											<li><?php echo $this->lang->line('rectum'); ?></li>
											<li><?php echo $this->lang->line('prostate_gland'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="abdomen" id="abdomen" cols="" rows="12"><?php echo @$entry->abdomen;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingSixtin<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseSixtin<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseSixtin<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphglyphicon glyphicon-minus icon-minus glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('musculosceletal_system'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSixtin<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseSixtin">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
											<li><?php echo $this->lang->line('spine'); ?></li>
											<li><?php echo $this->lang->line('joints'); ?></li>
											<li><?php echo $this->lang->line('muscles'); ?></li>
						            	</ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="motion_apparatus" id="motion_apparatus" cols="" rows="3"><?php echo @$entry->motion_apparatus;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingSventin<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseSventin<?php echo $entry->id ?>" aria-expanded="true" aria-controls="collapseSventin<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphicon-minus icon-minus"></i>
	                                    </span>	<?php echo $this->lang->line('nervous_system'); ?>
	                            	</a>
	                            </h4>
	                        </div>
	                        <div id="collapseSventin<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseSventin">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                    	<li><?php echo $this->lang->line('pupils'); ?></li>
											<li><?php echo $this->lang->line('light_reaction'); ?></li>
											<li><?php echo $this->lang->line('eye_movement'); ?></li>
											<li><?php echo $this->lang->line('cranial_nerves'); ?></li>
											<li><?php echo $this->lang->line('reflexes'); ?></li>
											<li><?php echo $this->lang->line('motor_skills'); ?></li>
											<li><?php echo $this->lang->line('sensibility'); ?></li>
											<li><?php echo $this->lang->line('langue_and_voice'); ?></li>
	                                    </ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="nervous_system" id="nervous_system" cols="" rows="8"><?php echo @$entry->nervous_system;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingEightin<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseEightin<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseEightin<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('appearance'); ?>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseEightin<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseEightin">
	                            <div class="panel-body colmn-box1">
	                                <div class=" col-md-4">
	                                    <ul>
	                                    	<li><?php echo $this->lang->line('cleanliness'); ?></li>
											<li><?php echo $this->lang->line('mouth'); ?></li>
											<li><?php echo $this->lang->line('decubitus'); ?></li>
											<li><?php echo $this->lang->line('tinea'); ?></li>
										</ul>
	                                </div>
	                                <div class=" col-md-8">
	                                    <textarea class="form-control" name="maintenance_state" id="maintenance_state" cols="" rows="4"><?php echo @$entry->maintenance_state;?></textarea>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="panel panel-default">
	                        <div class="" role="tab" id="headingNinetin<?php echo $entry->id ?>">
	                            <h4 class="colmn-head1">
	                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseNinetin<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseNinetin<?php echo $entry->id ?>">
	                                    <span class="plus-ico">
	                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
	                                        <i class="glyphicon glyphicon-minus icon-minus"></i>
	                                    </span><?php echo $this->lang->line('other_findings'); ?>
	        
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseNinetin<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNinetin<?php echo $entry->id ?>">
	                            <div class="panel-body colmn-box1">
       								<div class="col-md-2 padding-left padding-right">
       									<div class="body-pointer text-center">
   											<div class="body-img" style="background:url(<?php echo $patient_details->gender=='' || $patient_details->gender==1 || empty($patient_details->gender)? base_url('assets/img/male.png'): base_url('assets/img/female.png');?>) center top no-repeat; background-size: contain; height:200px;cursor:pointer; ">
   												<?php 
   													if(isset($entry->bodylocations) && !empty($entry->bodylocations))
   													{
	   													foreach ($entry->bodylocations as $value)
	   													{
	   														echo '<span class="pointer" title="pointer" style="left:'.$value[0].'px;top:'.$value[1].'px"></span>';
	   													}
   													}
   												?>
   											</div>
   											<?php if ($this->m->user_role() == M::ROLE_DOCTOR) : ?>
   												<input type="button" class="resetbodylocations" value="Reset">
            								<?php endif; ?>
            								<input type="hidden" id="bodylocations" name="bodylocations" value="" />
            								<div class="clr"></div>
        								</div>
                                	</div>
                                	<div class="pull-right col-md-9" style="padding-top:20px;">
                                		<textarea class="form-control" name="other_findings" id="other_findings" cols="" rows="9"><?php echo @$entry->other_findings;?></textarea>
                                	</div> 
							    </div>
	                        </div>
	                	</div>
	                	<?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>
		                	<div class="panel panel-default">
		                        <div class="" role="tab" id="headingTwenty<?php echo $entry->id ?>">
		                            <h4 class="colmn-head1">
		                                <a class="collapsed colpsd" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $entry->id ?>" href="#collapseTwenty<?php echo $entry->id ?>" aria-expanded="false" aria-controls="collapseTwenty<?php echo $entry->id ?>">
		                                    <span class="plus-ico">
		                                        <i class="glyphicon glyphicon-plus icon-plus "></i>
		                                        <i class="glyphicon glyphicon-minus icon-minus"></i>
		                                    </span><?php echo $this->lang->line('remarks'); ?>
		                                </a>
		                            </h4>
		                        </div>
		                        <div id="collapseTwenty<?php echo $entry->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseTwenty">
		                            <div class="panel-body colmn-box1">
		                                <div class="col-md-6 col-md-offset-3">
		                                    <textarea class="form-control" name="remarks" id="remarks" cols="" rows="6"><?php echo @$entry->remarks;?></textarea>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		            	<?php endif;?>
	            	</div>
	        	</div>
	    	</div>
		</div>
	</section>
	<div class="form-group m-b-5" >
    	<div class="col-sm-12 text-right">
      		<?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
        		<button class="btn btn-alt btn-lg" type="submit">
        			<span class="icomoon i-file-plus-2"></span> 
        			<?php echo $this->lang->line('general_text_button_add'); ?>
        		</button>
      		<?php endif; ?>
			<?php if (isset($update_btn) && $update_btn && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="submit">
					<span class="icomoon i-loop-4"></span> 
					<?php echo $this->lang->line('general_text_button_update'); ?>
				</button>
			<?php endif; ?>
			<?php if (isset($emergency_btn) && $emergency_btn && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/casehistory/emergency/'.$entry->id); ?>" >
					<span class="icomoon i-aid"></span>
					<?php echo $this->lang->line('pwidget_diagnosis_emergency_button'); ?>
				</button>
			<?php endif; ?>
			<?php if (isset($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/casehistory/confirm/'.$entry->id); ?>" >
					<span class="icomoon i-signup"></span>
					<?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>
				</button>
			<?php endif; ?>
			<?php if (isset($archive_btn) && $archive_btn && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/casehistory/archive/'.$entry->id); ?>" >
					span class="icomoon i-drawer-3"></span> 
					<?php echo $this->lang->line('pwidget_diagnosis_archieve_button'); ?>
				</button>
			<?php endif; ?>
			<?php if (isset($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
				<button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/casehistory/delete/'.$entry->id); ?>" >
					<span class="icomoon i-remove-2"></span> 
					<?php echo $this->lang->line('general_text_button_delete'); ?>
				</button>
			<?php endif; ?> 
    </div>
  </div>
</form>

