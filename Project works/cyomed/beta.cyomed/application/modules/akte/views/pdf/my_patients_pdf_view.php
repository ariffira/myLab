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


</div>
</htmlpageheader>

<htmlpagefooter name="myHTMLFooter">
	<div class="footer">
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('pwidget_doc_patients_list_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->


<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('pwidget_doc_patients_list_title'); ?>
		</div>

		<div class="page">
			<table class="card_table"  >

				<thead >
					<tr>
						<th width="25%" ><?php echo $this->lang->line('pwidget_doc_patients_id'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('pwidget_doc_patients_name'); ?></th>
						<th width="25%" ><?php echo $this->lang->line('pwidget_doc_patients_last_name'); ?></th>
						<th width="25%" style="" ><?php echo $this->lang->line('pwidget_doc_patients_city'); ?> </th>
					</tr>
				</thead>

				<tbody >

					<?php foreach ($patients as $value) : ?>
					<tr>
						<td ><?php echo isset($value->patient_id) ? $value->patient_id : $value->regid; ?></td>
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


</body>
</html>
