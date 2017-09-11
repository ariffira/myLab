
	<?php $this->ui->tile->base_init(); ?>

	<div class="row">

		<div class="col-md-12">
      <?php
    		$this->ui->tile->title('content', $this->lang->line('general_text_lang_content'));
    		$this->ui->tile->body->options('class', array('p-10', 'm-10', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	 $this->lang->line('general_text_please_choose')
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

  </div>

  <script>
    $.pageSetup($('#content'));
  </script>