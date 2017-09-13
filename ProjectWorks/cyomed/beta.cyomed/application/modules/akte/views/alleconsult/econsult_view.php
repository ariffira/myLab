<?php

    $this->load->language('patients/all_access', $this->m->user_value('language'));
    $this->load->language('global/general_text', $this->m->user_value('language'));
    $this->load->language('patients/iconsult', $this->m->user_value('language'));

  ?>
<div class="econ-text">
  
  <?php $this->ui->tile->base_init(); ?>

  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    
    <div class="row">

    <a href="<?php echo smart_site_url('akte/pdfget/iconsult/all'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span> eConsult Pdf</a>
      <div class="col-md-12">

        <?php if (Ui::$bs_tname == 'mvpr110') : ?>
          <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
        <?php endif; ?>

        <?php
          $this->ui->tile->rebase();
          if (Ui::$bs_tname == 'mvpr110')
          {
            $this->ui->tile->options('accordion', 'active');
          }
          $this->ui->tile->title('content', $this->lang->line('patients_iconsult_new_entry'));
          $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
          $this->ui->tile->body(
            'content',
            $this->load->view('alleconsult/econsult_entry_view', array(), TRUE)
          );
          echo $this->ui->tile->output();
        ?>

        <?php if (Ui::$bs_tname == 'mvpr110') : ?>
          </div>
        <?php endif; ?>

      </div>

    </div>

  <?php endif; ?>

  <?php 
    $this->ui->tabs->base_init();
  ?>

  <!-- Tab All -->

  <?php $tab_all =& $this->ui->tabs->create(); ?>

  <?php $entries = !empty($category) && !empty($category->all) ? $category->all : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->rebase();
            if (Ui::$bs_tname == 'mvpr110')
            {
              $this->ui->tile->options('accordion', 'active');
              $this->ui->tile->options('accordion_parent', $accordion_parent_id);
              $this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
            }
            $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->keyword.' _ '.(!empty($entry->question_status) ? '<small class="text-success">'.$this->lang->line('patients_iconsult_answered_question').'</small>' : '<small class="text-danger">'.$this->lang->line('patients_iconsult_open_question').'</small>'));

            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => FALSE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
                  'family_doctor'=>$family_doctor
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      </div>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_all->nav->content = '<h4>' . $this->lang->line('patients_iconsult_all_questions') . '</h4>';
    $tab_all->pane->content = $buffer;

    // $this->ui->tabs->append($tab_all);
  ?>

  <!-- Tab Opened -->

  <?php $tab_opened =& $this->ui->tabs->create(); ?>
  <?php $tab_opened->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->opened) ? $category->opened : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
      <a href="<?php echo smart_site_url('akte/pdfget/iconsult/opened'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span> Offen eConsult Pdf</a>
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->rebase();
            if (Ui::$bs_tname == 'mvpr110')
            {
              $this->ui->tile->options('accordion', 'active');
              $this->ui->tile->options('accordion_parent', $accordion_parent_id);
              $this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
            }
            $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->keyword.' _ '.(!empty($entry->question_status) ? '<small class="text-success">'.$this->lang->line('patients_iconsult_answered_question').'</small>' : '<small class="text-danger">'.$this->lang->line('patients_iconsult_open_question').'</small>'));
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => FALSE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      </div>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_opened->nav->content = '<h4>' . $this->lang->line('patients_iconsult_open_question') . '</h4>';
    $tab_opened->pane->content = $buffer;

    // $this->ui->tabs->append($tab_opened);
  ?>

    <!-- Tab closed -->

  <?php $tab_closed =& $this->ui->tabs->create(); ?>
  
  <?php $entries = !empty($category) && !empty($category->closed) ? $category->closed : array(); ?>

  <?php ob_start();  ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
      <a href="<?php echo smart_site_url('akte/pdfget/iconsult/closed'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span> Closed eConsult Pdf</a>
    <?php endif; ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : $accordion_active = FALSE; ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->rebase();
            if (Ui::$bs_tname == 'mvpr110')
            {
              $this->ui->tile->options('accordion', 'active');
              $this->ui->tile->options('accordion_parent', $accordion_parent_id);
              $this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
            }
            $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->keyword.' _ '.(!empty($entry->question_status) ? '<small class="text-success">'.$this->lang->line('patients_iconsult_answered_question').'</small>' : '<small class="text-danger">'.$this->lang->line('patients_iconsult_open_question').'</small>'));
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => TRUE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      </div>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_closed->nav->content = '<h4>' . $this->lang->line('patients_iconsult_reply_to') . '</h4>';
    $tab_closed->pane->content = $buffer;

    // $this->ui->tabs->append($tab_closed);
  ?>


  <!-- Output -->

  <?php echo $this->ui->tabs->output(); ?>
</div>
  <script type="text/javascript">  
$(document).ready(function() 
{
    $.pageSetup($('#content'));  
   
});
$(document).ready(function() 
{
  $('.cyomed_doc_select').on('ifClicked', function(event){
      var select_box=$(this).parents('form:first').find('.family_doc_list');
      select_box.hide();
  });
  
  $('.family_doc_select').on('ifClicked', function(event){
            var select_box=$(this).parents('form:first').find('.family_doc_list');
            select_box.show();
  });
});
</script>
<style type="text/css">
  .econ-text .nav-tabs{ margin-top:10px;}
  .econ-text ul.nav-tabs{ border-bottom:1px solid #d1d1d1!important;}
  .econ-text ul.nav-tabs li{ margin-bottom:-1px;}
  </style>