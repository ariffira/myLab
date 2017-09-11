<h4 class="content-title"><u>Live View</u><i class="fa fa-eye"></i> </h4>

<div class="form-group">
	<div class="col-sm-2">
		<h5>Subject:</h5>
	</div>
	<div class="col-sm-10">
		<?php echo $email_subject ? $email_subject : 'Buchung @cyomed / IhrArzt24'; ?>
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

	<p><?php echo $email_body ? $email_body : 'Thanks for your booking!'; ?></p>
	<p></p>

	<p>Here are the details for your records...</p>
	<table class="table">
		<tbody>
			<tr><th>Termin Time:</th> <td>2015-05-11 11:00:00</td></tr>
			<tr><th>Doctor:</th> <td><?php echo $this->m->user_value('surname'); ?></td></tr>
			<tr><th>Gender:</th> <td>Frau / Herr</td></tr>
			<tr><th>First Name:</th> <td>John</td></tr>
			<tr><th>Last name:</th> <td>Smith</td></tr>
			<tr><th>Email:</th> <td>john@cyomed.com</td></tr>
			<tr><th>Telephone:</th> <td>+49xxxxxxxx</td></tr>
		</tbody>
	</table>

	<p></p>
	<p><?php echo $email_closing ? $email_closing : 'Notes: Here comes the closing notes'; ?>
	</p>

	<!--
	<p></p>
	<p><strong>Thanking By,</strong></p>
	<div class="row">
	<div class="col-sm-4">
		<a href="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" class="thumbnail">
			<img data-src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" alt="signaturebild" width="100px" height="20px" />
		</a>
	</div>
	</div>
	-->
	</div>
