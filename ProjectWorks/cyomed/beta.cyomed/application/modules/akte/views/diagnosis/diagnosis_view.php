<?php

  $this->load->language('pwidgets/diagnosis', $this->m->user_value('language'));
  $this->load->language('global/general_text', $this->m->user_value('language'));

?>
	<?php $this->ui->tile->base_init(); ?>
  
	<div class="row">

    <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'all'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span> <?php echo $this->lang->line('pwidget_diagnosis_diagnosis');?> Pdf</a>
		<div class="col-sm-12 m-b-5">

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
        <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
      <?php endif; ?>

      <?php
    		$this->ui->tile->rebase();
        if (Ui::$bs_tname == 'mvpr110')
        {
          $this->ui->tile->options('accordion', 'active');
          $this->ui->tile->options('accordion_active', empty($diagnosis_type) || empty($detail_id) ? ($accordion_active = 'active') : FALSE);
        }
        $this->ui->tile->title('content', $this->lang->line('diagnosis_new_entry'));
    		$this->ui->tile->body->options('class', array('p-10', 'm-10', ));
    	  $this->ui->tile->body(
    	  	'content',
    	  	$this->load->view('diagnosis/diagnosis_entry_view', array(), TRUE)
    	  );
    	  echo $this->ui->tile->output();
      ?>

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
        </div>
      <?php endif; ?>

		</div>

  </div>

  <?php 
    $this->ui->tabs->base_init();
  ?>

  <!-- Tab Emergency -->

  <?php $tab_emergency =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='emergency') $tab_unconfirmed->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->emergency) ? $category->emergency : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
   <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'emergency'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_emergency').' Pdf';?></a>

          <div class="col-sm-12">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple  blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

       
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => FALSE,
                  'confirm_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
         

      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
               </div>

        </div>
  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_emergency->nav->content = '<h4>' .$this->lang->line('diagnosis_tab_title_emergency').'</h4>';
    $tab_emergency->pane->content = $buffer;

    // $this->ui->tabs->append($tab_emergency);
  ?>

  <!-- Tab confirmed -->

  <?php $tab_confirmed =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='confirmed') $tab_confirmed->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->confirmed) ? $category->confirmed : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
   <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'confirmed'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_confirm').' Pdf';?></a>

          <div class="col-sm-12">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

       
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                  'confirm_btn' => FALSE,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
         

      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
               </div>

        </div>
  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_confirmed->nav->content =  '<h4>'.$this->lang->line('diagnosis_tab_title_confirm').'</h4>';
    $tab_confirmed->pane->content = $buffer;

    // $this->ui->tabs->append($tab_confirmed);
  ?>

  <!-- Tab unconfirmed -->

  <?php $tab_unconfirmed =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='unconfirmed') $tab_unconfirmed->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->unconfirmed) ? $category->unconfirmed : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'unconfirmed'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_unconfirm').' Pdf';?></a>

          <div class="col-sm-12">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

      
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                  'confirm_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
       
      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
                 </div>

        </div>

  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_unconfirmed->nav->content =  '<h4>'.$this->lang->line('diagnosis_tab_title_unconfirm').'</h4>';
    $tab_unconfirmed->pane->content = $buffer;

    // $this->ui->tabs->append($tab_unconfirmed);
  ?>

  <!-- Tab allergy -->

  <?php $tab_allergy =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='allergy') $tab_allergy->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->allergy) ? $category->allergy : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
   <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'allergy'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_allergy').' Pdf';?></a>

          <div class="col-sm-12 ">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

       
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => FALSE,
                  'confirm_btn' => FALSE,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
         

      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
       </div>

        </div>
    </div>
  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_allergy->nav->content =  '<h4>'.$this->lang->line('diagnosis_tab_title_allergy')
.'</h4>';
    $tab_allergy->pane->content = $buffer;

    // $this->ui->tabs->append($tab_allergy);
  ?>

  <!-- Tab travel -->

  <?php $tab_travel =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='travel') $tab_unconfirmed->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->travel) ? $category->travel : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'travel'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_travel').' Pdf';?></a>

          <div class="col-sm-12 ">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

      
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => FALSE,
                  'confirm_btn' => FALSE,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
     
      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
                   </div>

        </div>

  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_travel->nav->content =  '<h4>' .$this->lang->line('diagnosis_tab_title_travel')
.'</h4>';
    $tab_travel->pane->content = $buffer;

    // $this->ui->tabs->append($tab_travel);
  ?>

  <!-- Tab allergy -->

  <?php $tab_archived =& $this->ui->tabs->create(); ?>
  <?php if($diagnosis_type=='archived') $tab_unconfirmed->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->archived) ? $category->archived : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
     <div class="row">
      <a href="<?php echo smart_site_url('akte/pdfget/diagnosis/'.'archived'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo ' '.$this->lang->line('diagnosis_tab_title_archive').' Pdf';?></a>

          <div class="col-sm-12 ">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

     
            <?php
              $this->ui->tile->rebase();
              if (Ui::$bs_tname == 'mvpr110')
              {
                $this->ui->tile->options('accordion', 'active');
                $this->ui->tile->options('accordion_parent', $accordion_parent_id);
                //$this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
                $this->ui->tile->options('accordion_active', !empty($detail_id) && $detail_id==$entry->id ? ($accordion_active = 'active') : FALSE);
              }
              $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->title);
              $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
              $this->ui->tile->body(
                'content',
                $this->load->view('diagnosis/diagnosis_entry_view', array(
                  'entry' => $entry,
                  'readonly' => FALSE,
                  'update_btn' => TRUE,
                  'emergency_btn' => FALSE,
                  'confirm_btn' => FALSE,
                  'archive_btn' => $this->m->user_role() == M::ROLE_DOCTOR,
                ), TRUE)
              );
              echo $this->ui->tile->output();
            ?>
         

      <?php endforeach; ?>
    <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
               </div>

        </div>
  <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_archived->nav->content =  '<h4>' .$this->lang->line('diagnosis_tab_title_archive')
.'</h4>';
    $tab_archived->pane->content = $buffer;

    // $this->ui->tabs->append($tab_archived);
  ?>

  <!-- Output -->
  <div class="box-shadow" style="background: #fff; padding:10px;">
  <?php echo $this->ui->tabs->output(); ?>
  </div>
  <script>
    $.pageSetup($('#content'));
    $(document).ready(function(){
		$('html, body').animate({
	    	scrollTop: $("div.is-open").offset().top
		},1000);
	});
  </script>

  <script type="text/javascript">
      $(function() {
        /****
            Autocomplete functions used for Diagnosis Page
          
        ****/
  
          $("input[name='icd_code']").each(function() {
            var $icd = $(this);

            $icd.autocomplete({

              source: $.siteUrl + "/akte/autocomplete/icd_by_code",
              minLength: 1,

              select: function(event, ui){
                $icd.closest("form").find("input").each(function(){
                  if($(this).attr('name')=='disease_name')
                    $(this).val(ui.item.diagnosis);
                });
              }
            });
          });

          $("input[name='disease_name']").each(function() {
            var $diagnosis = $(this);

            $diagnosis.autocomplete({

              source: $.siteUrl + "/akte/autocomplete/icd_by_name",
              minLength: 1,
              maxHeight: 15,

              select: function(event, ui){
                $diagnosis.closest("form").find("input").each(function(){
                  if($(this).attr('name')=='icd_code')
                    $(this).val(ui.item.icd);
                });
              }
            });

          });

        //Styling for the autocomplete widgets with maximum height and scrollbar
          $(".ui-autocomplete").css({"color":"white","max-Height":"250px","overflow-y":"auto","overflow-x":"hidden"});
         // $(".ui-autocomplete").addClass("select");

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
  
