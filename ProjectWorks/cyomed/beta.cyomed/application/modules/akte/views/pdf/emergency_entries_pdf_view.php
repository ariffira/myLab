	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	</head>


	<body>
<!--mpdf
<htmlpageheader name="myHTMLHeader">
<div class="header">
	<div class="left">
		<img src="assets/img/logos/logo10.png"  width="50%"  />
	</div>

	<div class="right">
		<b><?php echo $profile->name; ?> <?php echo $profile->surname; ?> </b><br/>
		<font size="2" >Age:</font> <b><?php echo date_diff(date_create($profile->dob), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $profile->gender; ?></b> <br/>
		<font size="2" >e:</font> <?php echo $profile->email; ?><br/>
	</div>
</div>
</htmlpageheader>

<htmlpagefooter name="myHTMLFooter">
	<div class="footer">
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('general_text_lang_emergency_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->

<!--Emergency Contact   -->
<div class="postContainer">
    <div class="postTitle">
    	<div class="left"><?php echo $this->lang->line('general_text_lang_emergency_contact'); ?></div>
	</div>

	<div class="page">
		<div  class="leftbox" style="width: 40%;">
			<b><i><?php echo $this->lang->line('general_text_lang_emergency_contact'); ?></i></b><br/>
			<?php echo $this->lang->line('pwidgets_my_account_person_name'); ?>:&nbsp;<b><?php echo $profile->emergency_name; ?></b><br/>
			<?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?>:&nbsp;<b><?php echo $profile->emergency_telephone; ?></b><br/>	
		</div>
		<div class="rightbox" style="width: 40%;">
			<b><i><?php echo $this->lang->line('general_text_lang_emergency_hous_doc'); ?></i></b><br/>
			<?php echo $this->lang->line('pwidgets_my_account_person_name'); ?>:&nbsp;<b><?php echo $profile->family_doctor_name; ?></b><br/>
			<!--<?php echo $this->lang->line('pwidgets_my_account_doctor_id'); ?>:&nbsp;<b><?php echo $profile->family_doctor_id; ?></b><br/>-->
			<?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?>:&nbsp;<b><?php echo $profile->family_doctor_telephone; ?></b><br/>	
		</div>
	</div>

</div>
<div class="page"></div>
<div class="page"></div>

<!--Emergency Diagnosis    -->
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('pwidget_diagnosis_emergency_diagnosis'); ?>
		</div>

		<div class="page">
			<table class="list_table"  >

				<thead >
					<tr>
						<th width="14%" ><?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?></th>
						<th width="10%" ><?php echo $this->lang->line('pwidget_diagnosis_icd_code');  ?></th>
						<th width="35%" ><?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?></th>
						<th width="35%" ><?php echo $this->lang->line('pwidget_diagnosis_extra_diagnosis'); ?></th>
						<th width="11%" style="text-align: right;" ><?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?></th>
					</tr>
				</thead>

				<tbody >

					<?php foreach ($diagnosis as $value) : ?>
					<tr>
						<td ><?php echo $value->document_date; ?></td>
						<td ><?php echo $value->icd_code; ?></td>
						<td ><?php echo $value->title; ?></td>
						<td ><?php echo $value->description; ?></td>
						<td style="text-align: right;" ><input type="checkbox" value="1" id="allergy<?php echo $diagnosis->id; ?>" name="allergy" <?php echo $value->allergy == '1' ? 'checked="checked"' : ''; ?> /></td>
					</tr>
				<?php endforeach; ?> 

			</tbody>
		</table>
	</div>
</div>

<div class="page"></div>
<div class="page"></div>


<!--Allergies -->   
<div class="postContainer">
    <div class="postTitle">
    	<!--
    	<div class="left"><?php echo $medication->name; ?></div>
		<div class="right"><?php echo $medication->document_date; ?></div>
		-->
		<?php echo $this->lang->line('patients_allergies_page_title'); ?>
	</div>

<div class="page">
<table class="list_table"  >

	<thead >
		<tr>
			<th width="14%" ><?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?></th>
			<th width="10%" ><?php echo $this->lang->line('pwidget_diagnosis_icd_code');  ?></th>
			<th width="35%" ><?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?></th>
			<th width="35%" ><?php echo $this->lang->line('pwidget_diagnosis_extra_diagnosis'); ?></th>
			<th width="11%" style="text-align: right;" ><?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?></th>
		</tr>
	</thead>

	<tbody >
	<?php foreach ($allergy as $value) : ?>
		<tr>
			<td ><?php echo $value->document_date; ?></td>
			<td ><?php echo $value->icd_code; ?></td>
			<td ><?php echo $value->title; ?></td>
			<td ><?php echo $value->description; ?></td>
			<td style="text-align: right;" ><input type="checkbox" value="1" id="allergy<?php echo $diagnosis->id; ?>" name="allergy" <?php echo $value->allergy == '1' ? 'checked="checked"' : ''; ?> /></td>
		</tr>
	<?php endforeach; ?> 

	</tbody>
</table>
</div>
</div>
<div class="page"></div>
<div class="page"></div>

<!--Medication -->
<?php foreach ($medication as $medication) : ?>
<div class="postContainer">
    <div class="posttitle">
    	<div class="left"><?php echo $this->lang->line('pwidget_medication_title_doc'); ?>  | <?php echo $medication->name; ?></div>
		<div class="right"><?php echo date('d.m.Y', strtotime($medication->document_date)); ?></div>
	</div>

	<div class="page">
		<div  class="leftbox" style="width: 40%;">
			<?php echo $this->lang->line('pwidget_medication_name'); ?>:&nbsp;<b><?php echo $medication->name; ?></b><br/>
			<?php echo $this->lang->line('pwidget_medication_document_date'); ?>:&nbsp;<b><?php echo $medication->document_date; ?></b><br/>
			<?php echo $this->lang->line('pwidget_medication_prescribed'); ?>:&nbsp;<input type="checkbox" value="1" id="prescribed<?php echo $medication->id; ?>" name="prescribed" <?php echo $medication->prescribed ? 'checked="checked"' : ''; ?> disabled="disabled" />
		</div>
		<div class="rightbox" style="width: 30%;">
			<?php echo $this->lang->line('pwidget_medication_atc_code'); ?>:&nbsp;<b><?php echo $medication->atc_code; ?></b><br/>
			<?php echo $this->lang->line('pwidget_medication_substance'); ?>:&nbsp;<b><?php echo $medication->substance; ?></b><br/>
			<?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>:&nbsp;<?php echo $medication->dose_rate; ?><br/>
		</div>
	</div>

	<div class="page">
		<table class="card_table"  >
			<tr>
				<td style="background-color:#888888;"></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_taking_needed'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_taking_regularly'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_since'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_until'); ?></td>
			</tr>
			<tr>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_taking_title'); ?></td>
				<td ><input type="checkbox" value="1" id="taking_needed<?php echo $medication->id; ?>" name="taking_needed" <?php echo $medication->taking_needed ? 'checked="checked"' : ''; ?> /></td>
				<td ><input type="checkbox" value="1" id="taking_regularly<?php echo $medication->id; ?>" name="taking_regularly" <?php echo $medication->taking_regularly ? 'checked="checked"' : ''; ?> /></td>
				<td ><?php echo $medication->taken_since ? date("d.m.Y", strtotime($medication->taken_since)) : ''; ?></td>
				<td ><?php echo $medication->bis_to ? date("d.m.Y", strtotime($medication->bis_to)) : ''; ?></td>
			</tr>
		</table>
		<table class="card_table"  >
			<tr>
				<td style="background-color:#888888;"></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_morning'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_noon'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_evening'); ?></td>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_night'); ?></td>
			</tr>
			<tr>
				<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_time_title'); ?></td>
				<td ><?php echo $medication->taken_morning_time; ?></td>
				<td ><?php echo $medication->taken_lunch_time; ?></td>
				<td ><?php echo $medication->taken_evening_time; ?></td>
				<td ><?php echo $medication->taken_night_time; ?></td>
			</tr>
		</table>
		<table class="list_table" style="border-bottom: solid .3px #888888;"  >
			<tr>
				<td style="width:25% " align="left"><?php echo $this->lang->line('pwidget_medication_set_period'); ?></td>
				<td style="width:75%" align="left"><?php echo $medication->repeating_periods; ?></td>
			</tr>
		</table>
	</div>

	<div class="page">
		<table class="single_table"  >
			<tr>
				<td  style="width:20%; border: none;" ><?php echo $this->lang->line('pwidget_medication_comments'); ?>:</td>
				<td  style="width:80% ;border: 0.1mm solid #888888;"><?php echo $medication->comments; ?> </td>
			</tr>
		</table>
	</div>
</div>
<div class="page"></div>
<div class="page"></div>
<?php endforeach; ?> 


</body>
</html>
