<h4 class="content-title"><u>Live View</u><i class="fa fa-eye"></i> </h4>

<div class="form-group">
	<div class="col-sm-2">
		<h5>Subject:</h5>
	</div>
	<div class="col-sm-10">
		<?php echo $followup_email_subject ? $followup_email_subject : 'Booking followup'; ?>
	</div>
</div>


<div class="form-group">
	<div class="col-sm-2">
		<h5>To:</h5>
	</div>
	<div class="col-sm-10">john@cyomed.com</div>
</div>


<div class="well">

	<div class="row" style="height: 60px;">
		<div class="col-sm-2">
			<img data-src="<?=(isset($logo) ? $logo : base_url().'/assets/img/logo/logo.png'); ?>" src="<?=(isset($logo) ? $logo : base_url().'/assets/img/logo/logo.png'); ?>" alt="logo" width="100%" height="100%"  />		
		</div>
	</div>
	<hr/>

	<p><?php echo $followup_email_body ? $followup_email_body: 'Just wanted to say thanks very much for your recent booking with us.<br/>
		If you have any feedback at all, please do let us know.'; ?></p>


		<p><?php echo $followup_email_closing ? $followup_email_closing : 'Notes: Here comes the closing notes'; ?>
		</p>

	</div>
