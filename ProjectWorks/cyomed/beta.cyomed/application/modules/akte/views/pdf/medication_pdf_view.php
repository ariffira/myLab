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
			<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('pwidget_medication_title_doc'); ?></div>
			<div class="right">Page {PAGENO} - {nb}</div>
		</div>
	</htmlpagefooter>
	mpdf-->
	
	<div class="postContainer">
	
	    <div class="postTitle">
	    	<div class="left"><?php echo $medication->name; ?></div>
			<div class="right"><?php echo date('d.m.Y', strtotime($medication->document_date)); ?></div>
		</div>
	
		<div class="page">
			<div class="left">
	
				<table class="box_table" cellpadding="10" >
					<tbody>
						<tr> 
							<td style="font-weight: bold;" > <?php echo $this->lang->line('pwidget_medication_name'); ?>:</td>
							<td style="font-weight: bold;" > <?php echo $medication->name; ?></td>
						</tr>
						<tr> 
							<td style="font-weight: bold;" > <?php echo $this->lang->line('pwidget_medication_document_date'); ?>:</td>
							<td style="font-weight: bold;" > <?php echo date('d.m.Y', strtotime($medication->document_date)); ?></td>
						</tr>
	
						<tr> 
							<td > <?php echo $this->lang->line('pwidget_medication_prescribed'); ?>:</td>
							<td > <input type="checkbox" value="1" id="prescribed<?php echo $medication->id; ?>" name="prescribed" <?php echo $medication->prescribed ? 'checked="checked"' : ''; ?> disabled="disabled" /></td>
						</tr>
	
					</tbody>
				</table>	
			</div>
	
			<div class="right" style="width:35%;">
				<table class="box_table" cellpadding="10"   >
					<tbody>
						<tr> 
							<td > <?php echo $this->lang->line('pwidget_medication_atc_code'); ?>:</td>
							<td > <?php echo $medication->atc_code; ?></td>
						</tr>
						<tr> 
							<td > <?php echo $this->lang->line('pwidget_medication_substance'); ?>:</td>
							<td > <?php echo $medication->substance; ?></td>
						</tr>
						<tr> 
							<td > <?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>:</td>
							<td > <?php echo $medication->dose_rate; ?></td>
						</tr>
	
					</tbody>
				</table>
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
					<td style="background-color:#888888;"><?php echo $this->lang->line('pwidget_medication_times_taken'); ?></td>
					<td colspan="3">
					<?php
  						  $medication->taken_time = !empty($medication) ? explode(',', $medication->taken_time):'';
  					?>
					<?php for($i=0;$i<24;$i++):?>
        			  <?php for($j=0;$j<60;$j=$j+5):?>
        			    <?php echo $medication->taken_time && ((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j) == $medication->taken_time || is_array($medication->taken_time) && in_array((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j), $medication->taken_time) ) ? (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j).', ' : '' ;?>
        			  <?php endfor; ?>
        			<?php endfor; ?>
        			</td>
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


	</body>
</html>
