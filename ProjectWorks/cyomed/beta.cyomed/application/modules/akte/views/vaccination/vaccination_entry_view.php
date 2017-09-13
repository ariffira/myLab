
<?php

  $entry = !empty($entry) ? $entry : array(

    'id' => 0,

  );

  $entry = (object)$entry;

  $insert = empty($entry->id);

  $this->load->language('global/general_text',$this->m->user_value('language'));

  $this->load->language('patients/vaccination_card', $this->m->user_value('language'));

?>

<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/vaccination/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >

  <input type="hidden" name="id" value="<?php echo $entry->id ?>" />

  <?php if (!empty($static)) : ?>

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?> m-b-5">

      <h3 class="col-sm-3 control-label">

      <?php echo $this->lang->line('patients_vaccination_card_vaccination'); ?>

      </h3>

    </div>

     <div style="clear:both;" class="form-group m-b-5">

      <span  class="font-format">

         <?php if(!empty($entry->added_by))

         {

             echo $this->lang->line('general_addedby');

             ?>

          <?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?> 

          <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 

           echo $res->name."&nbsp;".$res->regid; 

       ?> <?php echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>

       <?php } ?>

      </span>

  </div>

  <?php endif; ?>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="Handelsname<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 

      <?php echo $this->lang->line('patients_vaccination_card_trade_name'); ?>

    </label>

    <div class="col-sm-9">

      <?php if (empty($static)): ?>

        <input type="text" class="form-control" name="Handelsname" id="Handelsname<?php echo $entry->id; ?>" value="<?php echo !empty($entry->Handelsname) ? form_prep($entry->Handelsname) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_trade_name'); ?>" required />

      <?php else : ?>

        <p class="form-control-static">

          <?php echo !empty($entry->Handelsname) ? form_prep($entry->Handelsname) : ''; ?> 

        </p>

      <?php endif; ?>

    </div>

  </div>



  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="vaccination<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 

      <?php echo $this->lang->line('patients_vaccination_card_batch_no'); ?>

    </label>

    <div class="col-sm-9">

      <?php if (empty($static)): ?>

        <input type="text" class="form-control" name="vaccination" id="vaccination<?php echo $entry->id; ?>" value="<?php echo !empty($entry->vaccination) ? form_prep($entry->vaccination) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_batch_no'); ?>" required />

      <?php else : ?>

        <p class="form-control-static">

          <?php echo !empty($entry->vaccination) ? form_prep($entry->vaccination) : ''; ?>

        </p>

      <?php endif; ?>

    </div>

  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="" class="col-sm-3 control-label text-white">

      <?php echo $this->lang->line('patients_vaccination_card_date'); ?>

    </label>

    <div class="col-sm-9">

      <?php if (empty($static)): ?>

        <div class="input-icon datetime-pick date-only">

          <input type="text" class="form-control input-sm" name="document_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_date'); ?>" />

          <span class="add-on">

            <i class="sa-plus fa fa-calendar"></i>

          </span>

        </div>

      <?php else : ?>

        <p class="form-control-static"><?php echo !empty($entry->document_date) ? date('d.m.Y', strtotime($entry->document_date)) : ''; ?></p>

      <?php endif; ?>

    </div>

  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="" class="col-sm-3 control-label text-white">

      <?php echo $this->lang->line('patients_vaccination_card_reminder_on'); ?>

    </label>

    <div class="col-sm-9">

      <?php if (empty($static)): ?>

        <div class="input-icon datetime-pick date-only">

          <input type="text" class="form-control input-sm" name="date" data-format="dd.MM.yyyy" id="date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->date) ? strtotime($entry->date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_reminder_on'); ?>" />

          <span class="add-on">

            <i class="sa-plus fa fa-calendar"></i>

          </span>

        </div>

      <?php else : ?>

        <p class="form-control-static"><?php echo !empty($entry->date) ? date('d.m.Y', strtotime($entry->date)) : ''; ?></p>

      <?php endif; ?>

    </div>

  </div>

  <div class="form-group form-group-no-hide <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="symptoms<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 

      Symptoms

    </label>

    <div class="col-sm-9">

      <select class="tag-select" name="symptoms[]" id="symptoms<?php echo $entry->id; ?>" multiple="multiple" data-placeholder="Symptoms" >

        <option value="Tetanus" <?php echo isset($entry->Tetanus) && $entry->Tetanus ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_tetanus'); ?>

        </option>



        <option value="Diphtherie" <?php echo isset($entry->Diphtherie) && $entry->Diphtherie ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_diphtheria'); ?>

        </option>

        <option value="Perstussis" <?php echo isset($entry->Perstussis) && $entry->Perstussis ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_perstussis'); ?>

        </option>

        <option value="Poliomyeltis" <?php echo isset($entry->Poliomyeltis) && $entry->Poliomyeltis ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_poliomyeltis'); ?>

        </option>

        <option value="HepatitisA" <?php echo isset($entry->HepatitisA) && $entry->HepatitisA ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Hepatitis_A'); ?>

        </option>

        <option value="HepatitisB" <?php echo isset($entry->HepatitisB) && $entry->HepatitisB ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Hepatitis_B'); ?>

        </option>

        <option value="MMR" <?php echo isset($entry->MMR) && $entry->MMR ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_MMR'); ?>

        </option>

        <option value="Varizellen" <?php echo isset($entry->Varizellen) && $entry->Varizellen ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_varicella'); ?>

        </option>

        <option value="Meningokokken" <?php echo isset($entry->Meningokokken) && $entry->Meningokokken ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_meningococcal'); ?>

        </option>

        <option value="Pneumokokken" <?php echo isset($entry->Pneumokokken) && $entry->Pneumokokken ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_pneumococcal'); ?>

        </option>

        <option value="Rotavirus" <?php echo isset($entry->Rotavirus) && $entry->Rotavirus ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Rotavirus'); ?>

        </option>

        <option value="Influenza" <?php echo isset($entry->Influenza) && $entry->Influenza ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Influenza'); ?>

        </option>

        <option value="Cholera" <?php echo isset($entry->Cholera) && $entry->Cholera ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Cholera'); ?>

        </option>

        <option value="FSME" <?php echo isset($entry->FSME) && $entry->FSME ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_FSME'); ?>

        </option>

        <option value="HPV" <?php echo isset($entry->HPV) && $entry->HPV ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_HPV'); ?>

        </option>

        <option value="JapanischeEnzephalitis" <?php echo isset($entry->JapanischeEnzephalitis) && $entry->JapanischeEnzephalitis ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Japan_Encephalitis'); ?>

        </option>

        <option value="Tollwut" <?php echo isset($entry->Tollwut) && $entry->Tollwut ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_rabies'); ?>

        </option>

        <option value="Typhus" <?php echo isset($entry->Typhus) && $entry->Typhus ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_typhoid'); ?>

        </option>

        <option value="Gelbfieber" <?php echo isset($entry->Gelbfieber) && $entry->Gelbfieber ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_yellow_fever'); ?>

        </option>

        <option value="Zoster" <?php echo isset($entry->Zoster) && $entry->Zoster ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_Zoster'); ?>

        </option>

        <option value="FreierImpfeintrag1" <?php echo isset($entry->FreierImpfeintrag1) && $entry->FreierImpfeintrag1 ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_1'); ?>

        </option>

        <option value="FreierImpfeintrag2" <?php echo isset($entry->FreierImpfeintrag2) && $entry->FreierImpfeintrag2 ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_2'); ?>

        </option>

        <option value="FreierImpfeintrag3" <?php echo isset($entry->FreierImpfeintrag3) && $entry->FreierImpfeintrag3 ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_3'); ?>

        </option>

        <option value="FreierImpfeintrag4" <?php echo isset($entry->FreierImpfeintrag4) && $entry->FreierImpfeintrag4 ? 'selected="selected"' : ''; ?> >

          <?php echo $this->lang->line('patients_vaccination_card_free_vaccin_entry_4'); ?>

        </option>

      </select>

    </div>

  </div>



  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <label for="Praxis<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 

      <?php echo $this->lang->line('patients_vaccination_card_doctor'); ?>

    </label>

    <div class="col-sm-9">

      <?php if (empty($static)) : ?>

        <input type="text" class="form-control" name="Praxis" id="Praxis<?php echo $entry->id; ?>" value="<?php echo !empty($entry->Praxis) ? form_prep($entry->Praxis) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_doctor'); ?>" />

      <?php else : ?>

        <p class="form-control-static"><?php echo !empty($entry->Praxis) ? $entry->Praxis : ''; ?></p>

      <?php endif; ?>

    </div>

  </div>





  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" style="clear:both">

    <label for="Datei<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">

      <?php echo $this->lang->line('patients_vaccination_card_data'); ?>

    </label>

    <div class="col-sm-9">



      <?php if (empty($static)) : ?>

        <input type="file" name="document_upload" id="document_upload<?php echo $entry->id; ?>" class="form-control input-sm" />

      <?php endif; ?>



      <?php if (!empty($entry->files) && is_array($entry->files) && count($entry->files) > 0) : ?>

        <p class="help-block">

          <table class="tile table table-condensed table-striped">

            <?php foreach ($entry->files as $file) : ?>

              <tr>

                <td class="text-center" style="vertical-align:middle;">

                  <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">

                    <?php if (in_array(strtolower($file->document_extension), array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>

                      <?php if (file_exists($this->mdoc->get_file_path($file))) : ?>

                        <img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=66&height=138&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" />

                      <?php else : ?>

                        <span class="icomoon icon32 i-image-2"></span>

                      <?php endif; ?>

                    <?php endif; ?>

                    <?php if (strtolower($file->document_extension) == 'pdf') : ?>

                      <span class="icomoon icon32 i-file-pdf"></span>

                    <?php endif; ?>

                    <?php if (strtolower($file->document_extension) == 'doc' || strtolower($file->document_extension) == 'docx') : ?>

                      <span class="icomoon icon32 i-file-word"></span>

                    <?php endif; ?>

                    <?php if (strtolower($file->document_extension) == 'odt') : ?>

                      <span class="icomoon icon32 i-files"></span>

                    <?php endif; ?>

                  </a>

                </td>

                <td class="text-center" style="vertical-align:middle;">

                  <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">

                    <?php echo Ui::$bs_tname == 'sa103' ? $this->ui->title->options('class', 'page-title')->content($file->document_caption)->output() : ''; ?>

                    <?php echo Ui::$bs_tname == 'mvpr110' ? $file->document_caption : ''; ?>

                  </a>

                </td>

                <td class="text-center" style="vertical-align:middle;">

                  <a href="<?php echo site_url('akte/vaccination/remove_file/'.$file->entry_id); ?>">

                    <span class="icomoon i-remove-2 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>

                  </a>

                </td>

                <!-- <td class="text-center" style="vertical-align:middle;">

                  <a href="<?php //echo site_url('akte/document/edit/'.$file->id); ?>">

                    <span class="icomoon i-pencil-6 icon16" style="<?php //echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>

                  </a>

                </td> -->

              </tr>

            <?php endforeach; ?>

          </table>

        </p>

      <?php endif; ?>



      <?php if (empty($static)) : ?>

        <p class="help-block">

          <small>

            <?php echo $this->lang->line('patients_home_file_upload_help'); ?>

          </small>

        </p>

      <?php endif; ?>

      

    </div>

  </div>



 

  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>

    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

      <label class="col-sm-3 control-label text-white">

        <?php echo $this->lang->line('patients_all_access_page_title'); ?>

      </label>

      <div class="col-sm-9">

        <div class="radio-inline">

          <label>

            <input type="radio" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> />

            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?>

          </label>

        </div>

        <div class="radio-inline">

          <label>

            <input type="radio" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' :($insert)?'checked="checked"':""; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> />

            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> 

          </label>

        </div>

        <div class="radio-inline">

          <label>

            <input type="radio" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> />

            <?php echo $this->lang->line('patients_all_access_private_mode'); ?>

          </label>

        </div>

        <?php if (empty($static)) : ?>

          <p class="help-block">

            <span style="color:red;">*</span>

            <?php echo $this->lang->line('patients_all_access_selection_info'); ?>

          </p>

        <?php endif; ?>

      </div>

    </div>

  <?php endif; ?>



  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">

    <div class="col-sm-12 text-right">

    

      <?php if (!empty($insert) && $insert && empty($hide_insert)) : ?>

        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>

      <?php endif; ?>



      <?php if (!empty($update_btn) && $update_btn && empty($hide_insert)) : ?>

        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>

      <?php endif; ?>



      <?php if (!empty($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>

        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/vaccination/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>

          <?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>

        </button>

      <?php endif; ?>



      <?php if (!empty($delete_btn) && $delete_btn && empty($hide_insert)) : ?>

        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/vaccination/delete/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 

          <?php echo $this->lang->line('general_text_button_delete'); ?>

        </button>

      <?php endif; ?>



    </div>

  </div>

</form>

<?php if(!empty($static))

{

?>

<div class="read-more"><a href="<?php echo site_url('/akte/vaccination'); ?>" class="ajax-vaccination-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>

<?php

}

?>

<script type="text/javascript">

        $('.ajax-vaccination-link').click(function(e) 

         {

          e.preventDefault();

          if ($(this).attr('href').indexOf('javascript:') < 0)

          $.loadUrl($(this).attr('href'), $('#content'));

         });

  </script>