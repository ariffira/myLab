<div class="col-md-12">
	<div class="box box-warning box-solid">
    	<div class="box-body">
    		<form class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo site_url('admin/medicine/insert_fields'); ?>">
        		<h4>Add New Medicine </h4>
        		<div class="form-group">
          			<label for="searchField" class="control-label col-sm-3">Medicine Code</label>
          			<div class="col-sm-9">
            			<input type="text" class="form-control" id="code" name="code" value="" placeholder="Medicine Code" />
          			</div>
        		</div>
        		<div class="form-group">
        			<label for="searchField" class="control-label col-sm-3">Sickness</label>
                  	<div class="col-sm-9">
            			<input type="text" class="form-control" id="sickness" name="sickness" value="" placeholder="Sickness" />
          			</div>
        		</div>
        		<div class="form-group">
		          	<label for="searchField" class="control-label col-sm-3">Medicine Name</label>
		          	<div class="col-sm-9">
		            	<input type="text" class="form-control" id="medicine" name="medicine" value="" placeholder="Medicine Name" />
		          	</div>
		        </div>
				<div class="form-group">
          			<div class="col-sm-offset-3 col-sm-9">
            			<button type="submit" class="btn btn-danger col-sm-5">Add Medicine</button>
          			</div>
        		</div>
      		</form>
      		<script type="text/javascript">
	    		<?php if(isset($error) && $error<>""): ?>
	    			alert("<?php echo $error;?>");
	    		<?php endif; ?> 
    		</script>
      	</div>
	</div>
</div>
