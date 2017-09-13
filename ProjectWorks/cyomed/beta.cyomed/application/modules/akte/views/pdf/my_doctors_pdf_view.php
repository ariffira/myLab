	<?php set_time_limit(2000); ?>


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
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('patients_my_doctors_page_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->


<?php if ($doctors) { ?>
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('patients_my_doctors_list_title'); ?>
		</div>

		<div class="page">
			<table class="card_table"  >

				<thead >
					<tr>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_id'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_name'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_last_name'); ?></th>
						<th width="25%" style="" ><?php echo $this->lang->line('patients_my_doctors_city'); ?> </th>
					</tr>
				</thead>

				<tbody >

					<?php foreach ($doctors as $value) : ?>
					<tr>
						<td ><?php echo isset($value->doctor_id) ? $value->doctor_id : $value->regid; ?></td>
						<td ><?php echo $value->name; ?></td>
						<td ><?php echo $value->surname; ?></td>
						<td ><?php echo $value->city; ?></td>
					</tr>
				<?php endforeach; ?> 

			</tbody>
		</table>
	</div>
</div>

<div class="page"></div>
<div class="page"></div>
<?php } ?>


<?php if ($all_doctors) { ?>
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div style="width:50%; float:left;"><?php echo $medication->name; ?></div>
				<div style="width:50%; float:right; text-align: right; "><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('patients_my_doctors_alllist_title'); ?>
		</div>

		<div class="page">
			<table class="card_table"  >

				<thead >
					<tr>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_id'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_name'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('patients_my_doctors_last_name'); ?></th>
						<th width="25%" style="" ><?php echo $this->lang->line('patients_my_doctors_city'); ?> </th>
					</tr>
				</thead>

				<tbody >

					<?php foreach ($all_doctors as $value) : ?>
					<tr>
						<td ><?php echo isset($value->doctor_id) ? $value->doctor_id : $value->regid; ?></td>
						<td ><?php echo $value->name; ?></td>
						<td ><?php echo $value->surname; ?></td>
						<td ><?php echo $value->city; ?></td>
					</tr>
				<?php endforeach; ?> 

			</tbody>
		</table>
	</div>
</div>

<div class="page"></div>
<div class="page"></div>
<?php } ?>	


</body>
</html>
