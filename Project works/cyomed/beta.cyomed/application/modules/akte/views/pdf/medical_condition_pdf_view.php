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
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('patients_home_page_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->

<div class="postContainer">

    <div class="postTitle">
    	<div class="left"><?php echo $mcond->title; ?></div>
		<div class="right"><?php echo date('d.m.Y', strtotime($mcond->document_date)); ?></div>
	</div>

	<div class="page">
		<div class="right">
			<?php echo $this->lang->line('patients_home_entry_date'); ?>:&nbsp;<?php echo date('d.m.Y', strtotime($mcond->document_date)); ?><br/>
			<?php echo $this->lang->line('patients_home_entry_time'); ?>:&nbsp;<?php echo $mcond->document_time; ?>
		</div>
	</div>
		
	<div class="page">
		<table class="list_table"  >
			<tbody >
				<tr >
					<td width="30%" ><?php echo $this->lang->line('patients_home_complaints'); ?>:</td>
					<td style="" width="70%"><?php echo $mcond->title; ?></td>
				</tr>
				<tr>
					<td width="30%"><?php echo $this->lang->line('patients_home_condition_detail'); ?>:</td>
					<td style="" width="70%"><?php echo $mcond->description ?></td>
				</tr>
				<tr >
					<td width="30%" ><?php echo $this->lang->line('patients_home_complaint_scale'); ?>:</td>
					<td style="" width="70%"><?php echo $mcond->befindlichkeit; ?></td>
				</tr>
			</tbody>
		</table>
	</div>

</div>
<div class="page"></div>
<div class="page"></div>


</body>
</html>
