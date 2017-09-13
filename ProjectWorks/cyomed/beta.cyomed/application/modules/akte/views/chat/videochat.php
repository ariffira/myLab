

<div class="row-fluid" >
	<div class="block-foot font-bold">CYOMED VIDEO SERVICE</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">

	</div>

	<div class="panel-body">
		<form class = "form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
			<?php for($i=0;$i<3;$i++): ?>
			<div class= 'form-group-fluid center-block' >
					<div class="col-sm-7">		
						<h5 class="title"><span class="status status-online"></span>
							<img src="<?php echo base_url('/assets/images/avatars/service.jpg');?>" width="40px">
							Cyomed Service <?php echo $i+1;?>
						</h5>
					</div>
					<div class='col-sm-4 pull-right'>	
						<button href="#" class="btn btn-primary btn-sm">Submit Request</button>
					</div>
			</div>
		<?php endfor;?>
			<div class="form-group">
				<div class='col-md-offset-3 col-md-9'></div>
			</div>
		</form>
	</div>
</div>

<script>
    $.pageSetup($('#content'));
</script>
	

