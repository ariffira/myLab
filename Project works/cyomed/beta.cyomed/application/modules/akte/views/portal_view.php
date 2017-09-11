
	<?php $this->ui->tile->base_init(); ?>

	<div class="row">

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Akte');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.ajax_site_url('akte/overview').'"><img src="'.base_url('assets/img/portal/Akte.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Termin');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.site_url('termine').'"><img src="'.base_url('assets/img/portal/eAppointment.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Rezpet');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.site_url('rezpet').'"><img src="'.base_url('assets/img/portal/ePrescription.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'eConsult');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.ajax_site_url('akte/econsult').'"><img src="'.base_url('assets/img/portal/eConsult.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

	</div>

	<div class="row">

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Sofort Consult');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.site_url('vidcon').'"><img src="'.base_url('assets/img/portal/eVideoChat.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'eTeaching');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.site_url('eteaching').'"><img src="'.base_url('assets/img/portal/eTeaching.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Medisocial');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.site_url('medisocial').'"><img src="'.base_url('assets/img/portal/MediSocial.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>

		<div class="col-md-3 col-xs-6">
      <?php
    		$this->ui->tile->title('content', 'Übersichtseite');
    		$this->ui->tile->body->options('class', array('p-10', 'text-center', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	'<a href="'.'//cyomed.com/'.'"><img src="'.base_url('assets/img/portal/Portal.png').'" class="img-thumbnail" /></a>'
    	  );
    	  echo $this->ui->tile->output();
      ?>
		</div>
		
	</div>