<?php $this->ui->tile->base_init(); ?>
<?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>
<div class="row">
  	<div class="col-md-12">
    	<div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
	      	<?php
	        	$this->ui->tile->rebase();
				$this->ui->tile->options('accordion', 'active');
				$this->ui->tile->options('accordion_active', empty($detail_id) ? ($accordion_active = 'active') : FALSE);
	
				$this->ui->tile->title('content', $this->lang->line('patients_home_new_case_history'));
			    $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
	      		$this->ui->tile->body(
	      			'content',
	      			$this->load->view('casehistory/casehistory_entry_view', array(), TRUE)
	      		);
	      		echo $this->ui->tile->output();
	      	?>
        </div>
	</div>
</div>
<?php endif;?>

<?php 
    $this->ui->tabs->base_init();
?>
  <div class="row">
	        	<div class="col-md-12">
<div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
	<?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
	    <?php foreach ($entries as $entry_index => $entry) : ?>
			
	          		<?php $this->ui->tile->rebase(); ?>
	          		<?php
	            		if (Ui::$bs_tname == 'mvpr110')
	            		{
							$this->ui->tile->options('accordion', 'active');
	              			$this->ui->tile->options('accordion_parent', $accordion_parent_id);
	              			//$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
	              			$this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
	            		}
			            $this->ui->tile->title('content', $this->lang->line('patients_home_case_history').' - '.$entry->date_added);
			            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
			            
			            if ($this->m->user_role() == M::ROLE_DOCTOR) {
				            $this->ui->tile->body(
		              			'content',
		             			$this->load->view('casehistory/casehistory_entry_view', array(
				                'entry' => $entry,
				                'readonly' => FALSE,
				                'update_btn' => TRUE,
				                'emergency_btn' => FALSE,
				                'confirm_btn' => FALSE,
				                'archive_btn' => FALSE,
				                'delete_btn' => TRUE,
				              ), TRUE)
							);
			            }
			            else {
				            $this->ui->tile->body(
		              			'content',
		             			$this->load->view('casehistory/casehistory_entry_view', array(
				                'entry' => $entry,
				                'readonly' => FALSE,
				                'update_btn' => FALSE,
				                'emergency_btn' => FALSE,
				                'confirm_btn' => FALSE,
				                'archive_btn' => FALSE,
				                'delete_btn' => FALSE,
				              ), TRUE)
							);
			            }
	            		echo $this->ui->tile->output();
					?>
				
		<?php endforeach; ?>
	<?php endif; ?>
</div>
                            </div>
			</div>
<script src="<?php echo base_url().'assets/js/jquery.imagemapster.js'?>"></script>
<script><!--
	$.pageSetup($('#content'));
	$(document).ready(function(){
		$('html, body').animate({
	    	scrollTop: $("div.is-open").offset().top
		},1000);
	});
	$('img').mapster({
		fillColor: 'ff0000',
		fillOpacity: 0.3
	});
	
	<?php if ($this->m->user_role() == M::ROLE_DOCTOR) : ?>
		$(".body-img").click(function(e){
		   	var parentOffset = $(this).parent().offset(); 
		   	//or $(this).offset(); if you really just want the current element's offset
		   	var relX = e.pageX - parentOffset.left - 4;
		   	var relY = e.pageY - parentOffset.top - 4;
		  	// alert(relX+'----'+relY);
		   	$(this).append('<span class="pointer" title="pointer" style="left:'+relX+'px;top:'+relY+'px"></span>');

			var bodylocationsValue = $(this).parent().find("#bodylocations").val();
			
		   	if(bodylocationsValue=='')
		   	{
		   		$(this).parent().find("#bodylocations").val(relX+","+relY);
			}
		   	else
		   	{
		   		$(this).parent().find("#bodylocations").val(bodylocationsValue+'||'+relX+","+relY);
			}
		});
		$(".resetbodylocations").click(function(){
			$(".resetbodylocations").parent().find(".body-img").html("");
			$(".resetbodylocations").parent().find("#bodylocations").val("");
		});
	<?php endif; ?>
            
$(document).ready(function(){
		$(".blue-heading").each(function(){
				$(this).find('.panel-heading')
				.removeClass("panel-heading")
				.addClass('panel-heading1');
		});
	});
--></script>

  
<style>
	.accordion-simple .panel .panel-heading1 .panel-title:hover {opacity: 0.9;}
	.accordion-simple .panel .panel-heading1 .panel-title{ color:#fff}
	
    .accordion-simple .panel .panel-heading1 div.panel-title i.fa{color:#fff}
    
    .accordion-simple .panel .panel-heading1 .panel-title a{ color:#fff}
	
    .accordion-simple .panel .panel-heading1 {background-color:#093a80 !important}
    .accordion-simple .panel .panel-heading1 .panel-title .accordion-caret:before{color:#fff!important} 

  </style>
  