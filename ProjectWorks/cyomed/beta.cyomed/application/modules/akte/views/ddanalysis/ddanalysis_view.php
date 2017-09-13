<?php $this->ui->tile->base_init(); ?>

<div class="row">

  <div class="col-sm-12 ">

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
      $this->ui->tile->title('content', 'Analysis-'. $given_name .'('.$given_substance.')');
      $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
      $this->ui->tile->body(
        'content',
        $this->load->view('ddanalysis/drug_interaction_view', array(
          'infos' => $infos,
          'medication_list' => $medication_list,
          ), TRUE)
        );
      echo $this->ui->tile->output();
      ?>

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
      </div>
    <?php endif; ?>

  </div>

</div>


<div class="row">
  <div class="col-sm-12 " style="background: #FFF;">
    
      <ul id="myTab1" class="nav nav-tabs">
        <li class="active">
          <a href="#interactions" data-toggle="tab" aria-expanded="true">Interactions</a>
        </li>

        <li class="">
          <a href="#identification" data-toggle="tab" aria-expanded="false">Identification</a>
        </li>

        <li class="">
          <a href="#taxonomy" data-toggle="tab" aria-expanded="false">Taxonomy</a>
        </li>

        <li class="">
          <a href="#pharmacology" data-toggle="tab" aria-expanded="false">Pharmacology</a>
        </li>

        <!--
        <li class="">
          <a href="#pharmaeconomics" data-toggle="tab" aria-expanded="false">Pharmaeconomics</a>
        </li>
        -->

        <li class="">
          <a href="#references" data-toggle="tab" aria-expanded="false">References</a>
        </li>
      </ul>

      <div id="myTab1Content" class="tab-content" style="border:1px solid #ddd;">
        <div class="tab-pane fade active in" id="interactions">
          <?php echo $this->load->view('content/interaction_view' ,array(
              'infos' => $infos,
            ), TRUE); ?>
        </div>
        <div class="tab-pane fade" id="identification">
          <?php echo $this->load->view('content/identification_view' ,array(
              'infos' => $infos,
            ), TRUE); ?>
        </div>

        <div class="tab-pane fade" id="taxonomy">
          <?php echo $this->load->view('content/taxonomy_view' ,array(
              'infos' => $infos,
            ), TRUE); ?>
        </div>
        <div class="tab-pane fade" id="pharmacology">
          <?php echo $this->load->view('content/pharma_view' ,array(
              'infos' => $infos,
            ), TRUE); ?>
        </div>
        <!--
        <div class="tab-pane fade" id="pharmaeconomics">
          <?php echo $name; ?>
        </div>
        -->
        <div class="tab-pane fade" id="references">
          <?php echo $this->load->view('content/references_view' ,array(
              'infos' => $infos,
            ), TRUE); ?>
        </div>
      </div>

    
  </div>
</div>


<!--
 <?php $this->ui->tabs->base_init();?>
-->

<!-- Tab Drug details -->
<!--
 <?php $tab_drug =& $this->ui->tabs->create(); ?>

 <?php ob_start();  ?>

 <?php if (Ui::$bs_tname == 'mvpr110') : ?>
   <div class="row">
    
    <div class="col-sm-12">
      <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple  blue-heading">
      <?php endif; ?>

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

  ?>
-->


<script type="text/javascript">
$(document).ready(function(){
    $(".blue-heading").each(function(){
        $(this).find('.panel-heading')
        .removeClass("panel-heading")
        .addClass('panel-heading1');
    });

    $('#drug_synonym').DataTable();
    $('#drug_pp_product').DataTable();
    $('#drug_intbrand').DataTable();
  }); 

</script>

 <style>
  .accordion-simple .panel .panel-heading1 .panel-title:hover {opacity: 0.9;}
  .accordion-simple .panel .panel-heading1 .panel-title{ color:#fff}
  
    .accordion-simple .panel .panel-heading1 div.panel-title i.fa{color:#fff}
    
    .accordion-simple .panel .panel-heading1 .panel-title a{ color:#fff}
  
    .accordion-simple .panel .panel-heading1 {background-color:#093a80 !important}
    .accordion-simple .panel .panel-heading1 .panel-title .accordion-caret:before{color:#fff!important} 

    .item-block { padding: 15px 0; padding-left: 25px !important; margin: 10px !important;background: #FFF;}
    .item {padding-bottom: 10px; padding-top: 10px;border-bottom: 1px dotted #ddd;}

  </style>