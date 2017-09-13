
	<?php $this->ui->tile->base_init(); ?>

	<div class="row">

		<div class="col-md-12">
      <?php
    		$this->ui->tile->title('content', 'Kein patienten gewählt');
    		$this->ui->tile->body->options('class', array('p-10', 'm-10', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'Bitte erstmal ein Patient wählen'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

  </div>

  <script>
    $.pageSetup($('#content'));
  </script>