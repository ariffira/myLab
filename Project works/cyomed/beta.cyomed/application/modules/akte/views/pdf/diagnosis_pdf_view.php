<?php 
set_time_limit(2000);
?>

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
			<img src="assets/img/logo/cyomedlogo3.png"  width="50%"  />
		</div>
	
		<div class="right">
			<?php if ($this->m->user_role()==M::ROLE_PATIENT):?>
				<b><?php echo $this->m->user_value('name'); ?> <?php echo $this->m->user_value('surname'); ?> </b><br/>
				<font size="2" >Age:</font> <b><?php echo date_diff(date_create($this->m->user_value('dob')), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $this->m->user_value('gender'); ?></b> <br/>
				<font size="2" >email:</font> <?php echo $this->m->user_value('email'); ?><br/>
			<?php elseif($this->m->user_role()==M::ROLE_DOCTOR): ?>
				<b><?php echo $patient->name_combine; ?> </b><br/>
				<font size="2" >Age:</font> <b><?php echo date_diff(date_create($patient->dob), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $patient->gender; ?></b> <br/>
				<font size="2" >email:</font> <?php echo $patient->email; ?><br/>
			<?php endif;?>
		</div>
	</div>
	</htmlpageheader>
	
	<htmlpagefooter name="myHTMLFooter">
		<div class="footer">
			<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('pwidget_diagnosis_page_title'); ?></div>
			<div class="right">Page {PAGENO} - {nb}</div>
		</div>
	</htmlpagefooter>
	mpdf-->

	<?php foreach($diagnosis as $key => $diag):?>
		<div class="postContainer">
			<div class="postTitle">
					<?php echo $this->lang->line('pwidget_diagnosis_'.$key.'_diagnosis'); ?>
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
		
							<?php foreach ($diag as $value) : ?>
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
	<?php endforeach;?>

	</body>
</html>
