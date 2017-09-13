<h4 class="content-title"><u>Cyomed GMBH: Termin</u><i class="fa fa-eye"></i> </h4>

<div class="form-group">
	<div class="col-sm-12">
		<h5>Subject:<?php echo $email_subject ? $email_subject : 'Buchung @cyomed / IhrArzt24'; ?></h5>
	</div>
	
</div>



<div class="well">
<!-- 	<div class="row" style="background-color: #2f4354;">
		<div class="col-sm-2">
			<a href="<?php echo $logo ? $logo : '//placehold.it/379x512'; ?>" class="thumbnail">
				<img data-src="<?php echo $logo ? $logo : '//placehold.it/379x512'; ?>" src="<?php echo $logo ? $logo : '//placehold.it/379x512'; ?>" alt="logo" width="40px" height="40px"  />
			</a>
		</div>
	</div> -->

	<p><?php echo $email_body ? $email_body : 'Thanks for your booking!'; ?></p>
	<p></p>

	<p>Reservation Information for appointment:</p>
	<table class="table">
		<tbody>
			<tr>
				<th>Termin Time:</th> 
				<td><?php echo $start;?></td>
			</tr>
			<tr>
				<th>Surname:</th> 
				<td><?php echo $this->m->user_value('surname'); ?></td>
			</tr>
			<tr>
				<th>Gender:</th> <td><?php echo $this->m->user_value('gender'); ?></td>
			</tr>
			<tr>
				<th>First Name :</th> <td><?php echo $this->m->user_value('name'); ?></td>
			</tr>
			<!-- <tr>
				<th>Last name :</th> <td><?php echo $this->m->user_value('last_name'); ?></td>
			</tr> -->
			<tr>
				<th>Email address:</th> <td><?php echo $this->m->user_value('email'); ?></td>
			</tr>
			<tr>
				<th>Telephone:</th> <td><?php echo $this->m->user_value('telephone'); ?></td>
			</tr>
		</tbody>
	</table>

	<p></p>
	<p><?php echo $email_closing ? $email_closing : 'Notes: Here comes the closing notes'; ?>
	</p>

	<p></p>
	<p><strong>Thanking By,</strong></p>

	<div class="row">
		Cyomed GMBH @2015, all rights reserved to cyomed GmbH, düsseldorf , germany.
		This is an automatic email.
	<!-- <div class="col-sm-4">
		<a href="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" class="thumbnail">
			<img data-src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" alt="signaturebild" width="100px" height="20px" />
		</a>
	</div> -->
	</div> 

	</div>
