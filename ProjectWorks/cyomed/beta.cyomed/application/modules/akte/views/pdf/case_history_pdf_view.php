<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	</head>
	<body>
		<div class="cs_mainDiv">
			<div class="cs_patientdetails">
				<div class="cs_divpatientdetail">
					<div class="left"><?php echo $this->lang->line('patient_name'); ?></div>
					<div class="right"><?php echo @$patient_details->name.' '.@$patient_details->surname; ?></div>
				</div>
				<div class="cs_divpatientdetail">
					<div class="left"><?php echo $this->lang->line('patient_id'); ?></div>
					<div class="right"><?php echo @$patient_details->regid; ?></div>
				</div>
			</div>
			<div class="cs_logo">
				<a href="" title="Cyomed"><img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/></a>
			</div>			
			<h2 class="cs_mainTitle"><?php echo $this->lang->line('patients_home_case_history'); ?></h2>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('main_symptom_and_actual_case_history'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->symptom_current_history ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('general_anamnesis'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->vegetative_anamnese ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('pre_existing_conditions'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->pre_existing_conditions ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('medication'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('actual_medication'); ?></li>
			            <li><?php echo $this->lang->line('former_medication'); ?></li>
			            <li><?php echo $this->lang->line('medication_when_needed'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->drug_history ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('allergies_and_incompatibilities'); ?></h4>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->allergies ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('stimulants_and_drugs'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('alcohol'); ?></li>
			            <li><?php echo $this->lang->line('nicotine'); ?></li>
			            <li><?php echo $this->lang->line('drugs'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->related_products ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('family_case_history'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('parents'); ?></li>
						<li><?php echo $this->lang->line('siblings'); ?></li>
						<li><?php echo $this->lang->line('children'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->family_history ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('social_case_history'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('profession'); ?></li>
						<li><?php echo $this->lang->line('disability'); ?></li>
						<li><?php echo $this->lang->line('pension'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->social_history ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('actual_doctors'); ?></h4>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->attending_physicians ?></div>
			</div>
			
			<h2 class="cs_mainTitle"><?php echo $this->lang->line('findings'); ?></h2>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('general_findings'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('general_condition'); ?></li>
						<li><?php echo $this->lang->line('nutritional_status'); ?></li>
						<li><?php echo $this->lang->line('Psyche'); ?></li>
						<li><?php echo $this->lang->line('foetor'); ?></li>
						<li><?php echo $this->lang->line('skin_and_mucose'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->general_findings ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('head_and_neck'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->head_and_neck ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('thorax_and_lungs'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->thorax_and_lungs ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('heart_circulation_vessels'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->heart_circulation_blood_vessels ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('abdomen'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->abdomen ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('musculosceletal_system'); ?></h4>
			        <ul>
						<li><?php echo $this->lang->line('spine'); ?></li>
						<li><?php echo $this->lang->line('joints'); ?></li>
						<li><?php echo $this->lang->line('muscles'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->motion_apparatus ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('nervous_system'); ?></h4>
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
			    <div class="cs_right"><?php echo @$entries[0]->nervous_system ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('appearance'); ?></h4>
			        <ul>
			            <li><?php echo $this->lang->line('cleanliness'); ?></li>
						<li><?php echo $this->lang->line('mouth'); ?></li>
						<li><?php echo $this->lang->line('decubitus'); ?></li>
						<li><?php echo $this->lang->line('tinea'); ?></li>
					</ul>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->maintenance_state ?></div>
			</div>
			<div class="cs_details">
			    <div class="cs_left">
			        <h4 class="cs_title"><?php echo $this->lang->line('other_findings'); ?></h4>
			    </div>
			    <div class="cs_right"><?php echo @$entries[0]->other_findings ?></div>
			</div>
		</div>
	</body>
</html>
