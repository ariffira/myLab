
  <?php $this->ui->tile->base_init(); ?>

  <div class="row">
    <a href="<?php echo smart_site_url('akte/pdfget/medication'); ?>" class="btn btn-default pull-right" role="button"><span class="fa fa-file-pdf-o "></span><?php echo $this->lang->line('pwidget_medication_title_doc'); ?>  Pdf</a>

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
        $this->ui->tile->title('content', $this->lang->line('pwidget_medication_new_entry'));
        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('medication/medication_entry_view', array(), TRUE)
        );
        echo $this->ui->tile->output();
      ?>

      <?php if (Ui::$bs_tname == 'mvpr110') : ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
  

  <div id="ddanalysis"></div>

  <?php 
    $this->ui->tabs->base_init();
  ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
<div class="row">

        <div class="col-sm-12">
    <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple blue-heading">
  <?php endif; ?>

  <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
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
            $this->ui->tile->title('content', date('d.m.Y', strtotime($entry->document_date)).' - '.$entry->name);
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('medication/medication_entry_view', array(
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
      

    <?php endforeach; ?>
  <?php endif; ?>

  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
              </div>

      </div>
  <?php endif; ?>

  <script>
    $.pageSetup($('#content'));
    $(document).ready(function(){
    $('html, body').animate({
        scrollTop: $("div.is-open").offset().top
    },1000);
  });
  </script>

  <script type="text/javascript">
  $(function(){
    $("input[name='atc_code']").each(function() {
            var $atc = $(this);

            $atc.autocomplete({

              source: $.siteUrl + "/akte/autocomplete/atc_by_code",
              minLength: 1,

              select: function(event, ui){
                $atc.closest("form").find("input").each(function(){
                  if($(this).attr('name')=='substance')
                    $(this).val(ui.item.substance);
                });
            }
            });
          });

          $("input[name='substance']").each(function() {
            var $substance = $(this);

            $substance.autocomplete({

              source: $.siteUrl + "/akte/autocomplete/atc_by_name",
              minLength: 1,

              select: function(event, ui){
                $substance.closest("form").find("input").each(function(){
                  if($(this).attr('name')=='atc_code')
                    $(this).val(ui.item.atc);
                });
              }
            });
          });


        //Styling for the autocomplete widgets with maximum height and scrollbar
          $(".ui-autocomplete").css({"color":"white","max-Height":"250px","overflow-y":"auto","overflow-x":"hidden"});


  });


  $(document).ready(function(){
    $(".blue-heading").each(function(){
        $(this).find('.panel-heading')
        .removeClass("panel-heading")
        .addClass('panel-heading1');
    });
  }); 

    function ddanalysis(val_substance, val_name){
      var substance ;
      var name ;
      //$('#ddanalysis').removeClass('hidden');
      //console.log(substance);
      //console.log(name);
      $.ajax({

       type: "GET",
       url: $.siteUrl + '/akte/ddanalysis/drug_interaction/' ,
       data: { substance: val_substance, name: val_name },  // appears as $_GET['id'] @ your backend side
       success: function(data) {
           // data is ur summary
           $('#ddanalysis').html(data);
         }

       });
    } 


  </script>
 
   <style>
  .accordion-simple .panel .panel-heading1 .panel-title:hover {opacity: 0.9;}
  .accordion-simple .panel .panel-heading1 .panel-title{ color:#fff}
  
    .accordion-simple .panel .panel-heading1 div.panel-title i.fa{color:#fff}
    
    .accordion-simple .panel .panel-heading1 .panel-title a{ color:#fff}
  
    .accordion-simple .panel .panel-heading1 {background-color:#093a80 !important}
    .accordion-simple .panel .panel-heading1 .panel-title .accordion-caret:before{color:#fff!important} 

  </style>
  
