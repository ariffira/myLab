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
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('patients_vaccination_card_page_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->

<div class="postContainer">

    <div class="postTitle">
    	<div class="left"><?php echo $vaccination->Handelsname; ?></div>
		<div class="right"><?php echo date('d.m.Y', strtotime($vaccination->document_date)); ?></div>
	</div>

	<div class="page">
		<div  class="left" style="">
			<?php echo $this->lang->line('patients_vaccination_card_doctor'); ?>:&nbsp;<b><?php echo $vaccination->Praxis; ?></b>
		</div>
		<div class="right" style="font-size: 8pt; ">
			<?php echo $this->lang->line('patients_vaccination_card_date'); ?>:&nbsp;<?php echo date('d.m.Y', strtotime($vaccination->document_date)); ?><br/>
			<?php echo $this->lang->line('patients_vaccination_card_reminder_on'); ?>:&nbsp;<?php echo $vaccination->date; ?>
		</div>
	</div>

	<div class="page">
		<table class="card_table"  >
			<thead >
			<tr>
				<th style=""><?php echo $this->lang->line('patients_vaccination_card_trade_name'); ?></th>
				<th style=""><?php echo $this->lang->line('patients_vaccination_card_batch_no'); ?></th>
				<th style="">Symptoms</th>
			</tr>
		</thead>
		<tbody >
			<tr>
				<td ><?php echo $vaccination->Handelsname; ?></td>
				<td ><?php echo $vaccination->vaccination; ?></td>
				<td >
					<ul>
					<?php if ($vaccination->Tetanus==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_tetanus');?></li>
					<?php } ?>
					<?php if ($vaccination->Diphtherie==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_diphtheria'); ?></li>
					<?php } ?>
					<?php if ($vaccination->Poliomyeltis==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_poliomyeltis');?></li>
					<?php } ?>
					<?php if ($vaccination->Perstussis==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_perstussis');?></li>
					<?php } ?>
					<?php if ($vaccination->HepatitisA==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Hepatitis_A');?></li>
					<?php } ?>
					<?php if ($vaccination->HepatitisB==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Hepatitis_B');?></li>
					<?php } ?>
					<?php if ($vaccination->MMR==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_MMR');?></li>
					<?php } ?>
					<?php if ($vaccination->Varizellen==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_varicella');?></li>
					<?php } ?>
					<?php if ($vaccination->Meningokokken==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_meningococcal');?></li>
					<?php } ?>
					<?php if ($vaccination->Pneumokokken==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_pneumococcal');?></li>
					<?php } ?>
					<?php if ($vaccination->Rotavirus==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Rotavirus');?></li>
					<?php } ?>
					<?php if ($vaccination->Influenza==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Influenza');?></li>
					<?php } ?>
					<?php if ($vaccination->Cholera ==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Cholera ');?></li>
					<?php } ?>
					<?php if ($vaccination->FSME==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_FSME');?></li>
					<?php } ?>
					<?php if ($vaccination->HPV==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_HPV');?></li>
					<?php } ?>
					<?php if ($vaccination->JapanischeEnzephalitis==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Japan_Encephalitis');?></li>
					<?php } ?>
					<?php if ($vaccination->Tollwut==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_rabies');?></li>
					<?php } ?>
					<?php if ($vaccination->Typhus==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_typhoid');?></li>
					<?php } ?>
					<?php if ($vaccination->Gelbfieber==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_yellow_fever');?></li>
					<?php } ?>
					<?php if ($vaccination->Zoster==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_Zoster');?></li>
					<?php } ?>
					<?php if ($vaccination->FreierImpfeintrag1==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_1');?></li>
					<?php } ?>
					<?php if ($vaccination->FreierImpfeintrag2==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_2');?></li>
					<?php } ?>
					<?php if ($vaccination->FreierImpfeintrag3==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_3');?></li>
					<?php } ?>
					<?php if ($vaccination->FreierImpfeintrag4==1) {?>
						<li><?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_4');?></li>
					<?php } ?>
				</ul>

				</td>
			</tr>
		</tbody>
		</table>
	</div>

</div>
<div class="page"></div>
<div class="page"></div>


</body>
</html>
