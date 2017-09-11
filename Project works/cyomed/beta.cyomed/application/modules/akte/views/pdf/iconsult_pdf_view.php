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
<sethtmlpageheader  name="myHTMLHeader<?php echo $i;?>">
<div class="header">
		<div class="left">
			<img src="assets/img/logo/cyomedlogo3.png"  width="50%"  />
		</div>
	
		<div class="right">
			<?php if ($this->m->user_role()==M::ROLE_PATIENT):?>
				<b><?php echo $this->m->user_value('name'); ?> <?php echo $this->m->user_value('surname'); ?> </b><br/>
				<font size="2" >Age:</font> <b><?php echo date_diff(date_create($this->m->user_value('dob')), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $this->m->user_value('gender'); ?></b> <br/>
				<font size="2" >email:</font> <?php echo $this->m->user_value('email'); ?><br/>
			<?php elseif($this->m->user_role()==M::ROLE_DOCTOR):  ?>
				<b><?php echo $patient->name.' '.$patient->surname; ?> </b><br/>
				<font size="2" >Age:</font> <b><?php echo date_diff(date_create($patient->dob), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $patient->gender; ?></b> <br/>
				<font size="2" >email:</font> <?php echo $patient->email; ?><br/>
			<?php endif;?>
		</div>
	</div>
	</sethtmlpageheader>

<htmlpagefooter name="myHTMLFooter">
	<div class="footer">
		<div class="left" >{DATE d.m.y}  | <?php echo $this->lang->line('patients_iconsult_page_title'); ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->


<?php if ($closed) { ?>
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('patients_iconsult_answered_question'); ?>
	</div>
	<?php foreach ($closed as $iconsult) : ?>
	<div class="box">
		<div class="title">
			<table class="single_table"  >
				<tr>
					<td style="width:70%; text-align: left; "><?php echo $iconsult->keyword; ?></td>
					<td style="width:30%; text-align: right; "><?php echo $iconsult->document_date; ?></td>
				</tr>
			</table>
		</div>

		<div class="page">
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt;"><font color="#c70000"><?php echo $this->lang->line('patients_iconsult_questions'); ?></font></div>
			<table class="para_table">
				<tbody>
					<tr>
						<td width="25%"><?php echo $this->lang->line('patients_iconsult_message'); ?></td>
						<td width="75%"><?php echo $iconsult->message; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="page">
			<?php if (isset($iconsult->replies) && is_array($iconsult->replies) && count($iconsult->replies) > 0) : ?>
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt; "> <font color="#007b1f"><?php echo $this->lang->line('patients_iconsult_answers'); ?></font></div>
			<table class="para_table">
				<tbody>
					<?php foreach ($iconsult->replies as $reply) : ?>
					<tr>
						<?php if ($reply->reply_by) : ?>
							<td width="25%">
								<?php // $patient_row = isset($this->mdoctor) && isset($this->mdoctor->patient) ? $this->mdoctor->patient : $this->mpatient->patient; ?>             
	              				<?php echo $patient->regid; ?><br/>
	              				<?php echo $patient->patient->name.' '.$patient->surname; ?>
              					<br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php else : ?>
              				<td width="25%">
              					<?php echo $reply->doctor->regid; ?><br/>
              					<?php echo $reply->doctor->name.' '.$reply->doctor->surname; ?><br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php endif; ?>
              		</tr>
              		<?php endforeach; ?>
              	</tbody>
              </table>
              <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?> 
</div>

<div class="page"></div>
<div class="page"></div>
<?php } ?>


<?php if ($opened) { ?>
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('patients_iconsult_open_question'); ?>
	</div>
	<?php foreach ($opened as $iconsult) : ?>
	<div class="box">
		<div class="title">
			<table class="single_table"  >
				<tr>
					<td style="width:70%; text-align: left; "><?php echo $iconsult->keyword; ?></td>
					<td style="width:30%; text-align: right; "><?php echo $iconsult->document_date; ?></td>
				</tr>
			</table>
		</div>

		<div class="page">
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt;"><font color="#c70000"><?php echo $this->lang->line('patients_iconsult_questions'); ?></font></div>
			<table class="para_table">
				<tbody>
					<tr>
						<td width="25%"><?php echo $this->lang->line('patients_iconsult_message'); ?></td>
						<td width="75%"><?php echo $iconsult->message; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="page">
			<?php if (isset($iconsult->replies) && is_array($iconsult->replies) && count($iconsult->replies) > 0) : ?>
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt; "> <font color="#007b1f"><?php echo $this->lang->line('patients_iconsult_answers'); ?></font></div>
			<table class="para_table">
				<tbody>
					<?php foreach ($iconsult->replies as $reply) : ?>
					<tr>
						<?php if ($reply->reply_by) : ?>
							<td width="25%">
								<?php // $patient_row = isset($this->mdoctor) && isset($this->mdoctor->patient) ? $this->mdoctor->patient : $this->mpatient->patient; ?>             
	              				<?php echo $reply->patient->regid; ?><br/>
	              				<?php echo $reply->patient->name.' '.$reply->patient->surname; ?>
              					<br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php else : ?>
              				<td width="25%">
              					<?php echo $reply->doctor->regid; ?><br/>
              					<?php echo $reply->doctor->name.' '.$reply->doctor->surname; ?><br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php endif; ?>
              		</tr>
              		<?php endforeach; ?>
              	</tbody>
              </table>
              <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?> 
</div>

<div class="page"></div>
<div class="page"></div>
<?php } ?>


<?php if ($all) { ?>
<div class="postContainer">
	<div class="postTitle">
    			<!--
    			<div class="left"><?php echo $medication->name; ?></div>
				<div class="right"><?php echo $medication->document_date; ?></div>
			-->
			<?php echo $this->lang->line('patients_iconsult_all_questions'); ?>
	</div>
	<?php foreach ($all as $iconsult) : ?>
	<div class="box">
		<div class="title">
			<table class="single_table"  >
				<tr>
					<td style="width:70%; text-align: left; "><?php echo $iconsult->keyword; ?></td>
					<td style="width:30%; text-align: right; "><?php echo $iconsult->document_date; ?></td>
				</tr>
			</table>
		</div>

		<div class="page">
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt;"><font color="#c70000"><?php echo $this->lang->line('patients_iconsult_questions'); ?></font></div>
			<table class="para_table">
				<tbody>
					<tr>
						<td width="25%"><?php echo $this->lang->line('patients_iconsult_message'); ?></td>
						<td width="75%"><?php echo $iconsult->message; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="page">
			<?php if (isset($iconsult->replies) && is_array($iconsult->replies) && count($iconsult->replies) > 0) : ?>
			<div style="margin-left: 5px; margin-right:5px; font-size:8pt; "> <font color="#007b1f"><?php echo $this->lang->line('patients_iconsult_answers'); ?></font></div>
			<table class="para_table">
				<tbody>
					<?php foreach ($iconsult->replies as $reply) : ?>
					<tr>
                                            
						<?php if ($reply->reply_by) : ?>
							<td width="25%">
								<?php // $patient_row = isset($this->mdoctor) && isset($this->mdoctor->patient) ? $this->mdoctor->patient : $this->mpatient->patient; print_r($patient_row);echo "afs";die; ?>             
	              				<?php echo $reply->patient->regid; ?><br/>
	              				<?php echo $reply->patient->name.' '.$reply->patient->surname; ?>
              					<br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php else : ?>
              				<td width="25%">
              					<?php echo $reply->doctor->regid; ?><br/>
              					<?php echo $reply->doctor->name.' '.$reply->doctor->surname; ?><br/>
              					<small><?php echo date('d.m.Y',strtotime( $reply->reply_date ) ); ?></small>
              				</td>
              				<td width="75%"><?php echo $reply->reply_message; ?></td>
              			<?php endif; ?>
              		</tr>
              		<?php endforeach; ?>
              	</tbody>
              </table>
              <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?> 
</div>

<div class="page"></div>
<div class="page"></div>
<?php ; } ?>



</body>
</html>
