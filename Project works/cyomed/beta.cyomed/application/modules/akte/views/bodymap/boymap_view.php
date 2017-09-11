
	<?php $this->ui->tile->base_init(); ?>

	<div class="row">

		<div class="col-sm-12">

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
        <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
      <?php endif; ?>

      <?php
        $this->ui->tile->rebase();
        if (Ui::$bs_tname == 'mvpr110')
        {
          $this->ui->tile->options('accordion', 'active');
          $this->ui->tile->options('accordion_active', empty($detail_id) ? ($accordion_active = 'active') : FALSE);
        }
    		$this->ui->tile->title('content', $this->lang->line('patients_bodymap_new_entry'));
    		$this->ui->tile->body->options('class', array('p-10', 'm-10', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	$this->load->view('bodymap/bodymap_entry_view', array(), TRUE)
    	  );
    	  echo $this->ui->tile->output();
      ?>

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
        </div>
      <?php endif;?>

		</div>

  </div>

  <?php 
    $this->ui->tabs->base_init();
  ?>
  
  
  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
    <?php foreach ($entries as $entry_index => $entry) : ?>

      <div class="row">

        <div class="col-sm-12">
		
<?php if (Ui::$bs_tname == 'mvpr110') : ?>
    <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
  <?php endif; ?>
		
          <?php $this->ui->tile->rebase(); ?>
          <?php
            if (Ui::$bs_tname == 'mvpr110')
            {
              $this->ui->tile->options('accordion', 'active');
              $this->ui->tile->options('accordion_parent', $accordion_parent_id);
              //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
              $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
            }
            $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->date_added)));
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('bodymap/bodymap_entry_view', array(
                'entry' => $entry,
                'update_btn' => TRUE,              
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
		  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
			</div>
		  <?php endif; ?>

        </div>

      </div>

    <?php endforeach; ?>
  <?php endif; ?>

  
  <script>
    $.pageSetup($('#content'));
	$(document).ready(function(){
		$('html, body').animate({
	    	scrollTop: $("div.is-open").offset().top
		},1000);
	});
	$(document).ready(function(){
		$(".blue-heading").each(function(){
				$(this).find('.panel-heading')
				.removeClass("panel-heading")
				.addClass('panel-heading1');
		});
	});
	
  </script>



<style>
	.accordion-simple .panel .panel-heading1 .panel-title:hover {opacity: 0.9;}
	.accordion-simple .panel .panel-heading1 .panel-title{ color:#fff}
	
    .accordion-simple .panel .panel-heading1 div.panel-title i.fa{color:#fff}
    
    .accordion-simple .panel .panel-heading1 .panel-title a{ color:#fff}
	
    .accordion-simple .panel .panel-heading1 {background-color:#093a80 !important}
    .accordion-simple .panel .panel-heading1 .panel-title .accordion-caret:before{color:#fff!important} 

  </style>
  
<style type="text/css">
    .body-img{
        position:relative;
    }
    @-webkit-keyframes shadow{
        0%{
            box-shadow:0 0 2px rgba(0,0,0,.2);
        }
        50%{
            box-shadow:0 0 10px rgba(255,0,0,.9);
        }
        100%{
            box-shadow:0 0 2px rgba(0,0,0,.2);
        }
    }
    .body-img .pointer{
        position:absolute;
        width:8px;
        height:8px;
        border:2px solid #FFF;
        background:red;
        border-radius:50%;
        -webkit-animation:shadow .5s linear infinite;
    }
    /*.bodymap_frm{margin-top: 30px;}*/
    .padd0{ padding: 0}
/*    input[type="radio"]{opacity: 1 !important;}*/
    .input-icon .add-on {
        position: absolute;
        top: 1px;
        left: 1px;
        padding: 5px 4px 2px 5px;
        display: block !important;
        font-size: 15px;
        background: rgba(0, 0, 0, 0.15) none repeat scroll 0% 0%;
    }
    .accordion-simple .colaccess .col-sm-12{ width: 58.33333333%}
</style>
        

 <style>   
	.col-md-1 {
    	width: 10%;
	}   
	.input-slider .slider-selection {
		background: #BABABA;
	}
	.slider.slider-horizontal {
		width: 100%;
	}
        .tooltip-inner{
            margin-top: -23px !important;
        }
        .emotion-img img{ width:32px;}
        
</style>