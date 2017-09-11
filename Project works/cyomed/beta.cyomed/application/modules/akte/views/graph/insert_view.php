<?php !isset($entry) ? (($entry = new stdClass()) && ($entry->id = 0)) : NULL; ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<?php $this->load->language('pwidgets/plot_graph', $this->m->user_value('language')); ?>
<?php $insert=empty($entry->id); ?>

<script type='text/javascript'>
$(document).ready(function(){
    $('#upr_limit_change, .upr_limit_change').click(function(){
        if($(this).attr('checked') == false){
        	$(this).closest('.form-group').find('#changeme_up').attr("disabled","disabled");
        } else {
            $(this).closest('.form-group').find('#changeme_up').removeAttr('disabled');
        }
    });
    $('#lwr_limit_change, .lwr_limit_change').click(function(){
        if($(this).attr('checked') == false){
            $(this).closest('.form-group').find('#changeme_low').attr("disabled","disabled");
        } else {
			$(this).closest('.form-group').find('#changeme_low').removeAttr('disabled');
        }
    });
});
</script>

<script type="text/javascript">
    function customAlphaNum(event,regx,chars,showCode){
		var eCharCode = event.which;
		var allChars = [];
		for(var i in chars){
			allChars[i] = chars[i].charCodeAt(0);
		}
		if(String.fromCharCode(eCharCode).match('^['+regx+']*$') || allChars.indexOf(eCharCode) >= 0 || eCharCode == 8 || eCharCode == 0 || eCharCode == 13 )
                return true;
                 else{
                    alert('Please enter a numeric value');
                    return false;
                 }
                
	}
	
//	$('input.numeric').on('keypress',function(e){
//		 return customAlphaNum(e,'0-9');
//	});
//        var specialKeys = new Array();
//        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
             return customAlphaNum(e,'0-9.');
//            var keyCode = e.which ? e.which : e.keyCode
//            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
//            if(ret)
//            {
//                 
//            }
//            else
//            {
//            alert("Please enter a numeric value");        
//            }
//           
//            return ret;
        }
</script>
<form class="form-horizontal" role="form" <?php if (!empty($not_modal)) : ?>id="frminsert" name="frminsert" <?php else: ?>  id="frmupdate" name="frmupdate" <?php endif;?> method="post" action="<?php echo site_url('akte/vital_values/'.($entry->id ? 'update/' : 'insert/').(!empty($table) ? $table : 'smart').'/'.$entry->id); ?>" >

  <input type="hidden" name="graph_type" value="<?php echo !empty($table) ? $table : ''; ?>" />
  <!--
  <div class="form-group">
    <label for="document_date<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">
      <?php echo $this->lang->line('pwidget_plot_graph_insert_date'); ?>
    </label>
    <div class="col-sm-4">
      <div class="input-icon datetime-pick date-only">
      <input type="text" class="form-control input-sm" name="rec_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', isset($entry->rec_date) && $entry->rec_date ? strtotime($entry->rec_date) : time() ); ?>" placeholder="Datum" />
        <span class="add-on">
          <i class="fa fa-calendar"></i>
        </span>
      </div>
    </div>
    <label for="document_time<?php echo $entry->id; ?>" class="control-label col-sm-1 text-white">
      <?php echo $this->lang->line('pwidget_plot_graph_insert_time'); ?>
    </label>
    <div class="col-sm-4">
      <div class="input-icon datetime-pick time-only">
      <input type="text" class="form-control input-sm" data-format="hh:mm" name="rec_time" id="document_time<?php echo $entry->id; ?>" value="<?php echo date('H:i', isset($entry->rec_time) && $entry->rec_time ? strtotime($entry->rec_time) : time() ); ?>" placeholder="Uhrzeit" />
        <span class="add-on">
          <i class="fa fa-clock-o"></i>
        </span>
      </div>
    </div>
  </div>
  -->
  <!-- Heart Frequency -->

      <?php if (isset($entry->rr_sys)) : ?>
        <div class="form-group">

          <label for="rr_sys<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">RR systolisch</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="rr_sys" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="rr_sys<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->rr_sys); ?>" placeholder="RR systolisch" required/>
          </div>
          <!-- <label for="document_date<?php echo $entry->id; ?>" class="control-label col-sm-1 text-white">
            <?php echo $this->lang->line('pwidget_plot_graph_insert_date'); ?>
          </label>
          <div class="col-sm-3">
            <div class="input-icon datetime-pick date-only">
              <input type="text" class="form-control input-sm" name="rec_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', isset($entry->rec_date) && $entry->rec_date ? strtotime($entry->rec_date) : time() ); ?>" placeholder="Datum" />
              <span class="add-on">
                <i class="fa fa-calendar"></i>
              </span>
            </div>
          </div> -->

        </div>
      <?php endif; ?>

      <?php if (isset($entry->rr_dia)) : ?>
        <div class="form-group">

          <label for="rr_dia<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">RR diastolisch</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="rr_dia" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="rr_dia<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->rr_dia); ?>" placeholder="RR diastolisch" required/>
          </div>
          <!-- <label for="document_time<?php echo $entry->id; ?>" class="control-label col-sm-1 text-white">
            <?php echo $this->lang->line('pwidget_plot_graph_insert_time'); ?>
          </label>
          <div class="col-sm-3">
            <div class="input-icon datetime-pick time-only">
              <input type="text" class="form-control input-sm" data-format="hh:mm" name="rec_time" id="document_time<?php echo $entry->id; ?>" value="<?php echo date('H:i', isset($entry->rec_time) && $entry->rec_time ? strtotime($entry->rec_time) : time() ); ?>" placeholder="Uhrzeit" />
              <span class="add-on">
                <i class="fa fa-clock-o"></i>
              </span>
            </div>
          </div> -->

        </div>
      <?php endif; ?>

      <?php if (isset($entry->puls)) : ?>
        <div class="form-group">
          <label for="puls<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">Puls</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="puls" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="puls<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->puls); ?>" placeholder="Puls" />
          </div>
        </div>
      <?php endif; ?>

      <!-- Blood Sugar -->

      <?php if (isset($entry->bloodsugar)) : ?>
      
      <div class="form-group">
          <label for="bloodsugar<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">
            <?php echo $this->lang->line('pwidget_plot_graph_blood_sugar_Value'); ?>
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control required" name="bloodsugar" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="bloodsugar<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->bloodsugar); ?>" placeholder=" <?php echo $this->lang->line('pwidget_plot_graph_blood_sugar_Value'); ?>" />
          </div>
        </div>
      <?php endif; ?>

      <?php if (isset($entry->HbA1C)) : ?>
        <div class="form-group">
          <label for="HbA1C<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">HbA1C % (optional)</label>
          <div class="col-sm-9">
            <input type="text" class="form-control required" name="HbA1C" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="HbA1C<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->HbA1C); ?>" placeholder="HbA1C % (optional)" />
          </div>
        </div>
      <?php endif; ?>

      <!-- Weight/BMI -->
      <?php if (isset($entry->size)) : ?>
        <div class="form-group rsp-form">
          <label for="size<?php echo $entry->id; ?>" class="control-label col-sm-3 col-sm-4 text-white">
            <?php echo $this->lang->line('pwidget_plot_graph_height'); ?>
          </label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="size" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required id="size" value="<?php echo form_prep($entry->size); ?>" placeholder="" />
          </div>

          <label for="size<?php echo $entry->id; ?>" class="control-label col-sm-1 col-xs-3 text-white"> or </label>
          <div class="col-sm-2 col-xs-5">
            <select type="text" name="opt2" id="opt2" class="form-control">
              <option value="1">1'</option>
              <option value="2">2'</option>
              <option value="3">3'</option>
              <option value="4">4'</option>
              <option value="5">5'</option>
              <option value="6">6'</option>
              <option value="7">7'</option>
              <option value="8">8'</option>
              <option name=feet value="9">9'</option>
            </select>
          </div>
          <div class="col-sm-2 col-xs-5" style="padding-left: 5px; ">
            <select type="text" name="opt3" id="opt3" class="form-control" >
              <option value="0">0"</option>
              <option value="1">1"</option>
              <option value="2">2"</option>
              <option value="3">3"</option>
              <option value="4">4"</option>
              <option value="5">5"</option>
              <option value="6">6"</option>
              <option value="7">7"</option>
              <option value="8">8"</option>
              <option value="9">9"</option>
              <option value="10">10"</option>
              <option value="11">11"</option>
            </select>
          </div>

        </div>
      <?php endif; ?>

      <?php if (isset($entry->weight)) : ?>
        <div class="form-group">
          <label for="weight<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">
            <?php echo $this->lang->line('pwidget_plot_graph_weight'); ?>
          </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" name="weight" id="weight" required value="<?php echo form_prep($entry->weight); ?>" placeholder="<?php echo $this->lang->line('pwidget_plot_graph_weight'); ?> " />
          </div>
        </div>
      <?php endif; ?>

      <?php if (isset($entry->bmi)) : ?>
        <div class="form-group">
          <label for="bmi<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">BMI</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="bmi" readonly="true" id="bmi" value="<?php echo form_prep($entry->bmi); ?>" placeholder="" />
          </div>
        </div>
      <?php endif; ?>

      <!-- Marcumar -->

      <?php if (isset($entry->INR)) : ?>
        <div class="form-group">
          <label for="INR<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">INR</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="INR" id="INR<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->INR); ?>" min="1" max="4.5" step="0.1" placeholder="INR" />
          </div>
        </div>
      <?php endif; ?>

      <?php if (isset($entry->quick)) : ?>
        <div class="form-group">
          <label for="quick<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">Quick %</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="quick" id="quick<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->quick); ?>" min="10" max="40" step="1" placeholder="Quick %" />
          </div>
        </div>
      <?php endif; ?>

<!--       <?php if (isset($entry->upper_limit)) : ?>
        <div class="form-group">
          <label for="upper_limit<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">Ziel INR - Obergrenze</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="upper_limit" id="upper_limit<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->upper_limit); ?>" placeholder="Ziel INR - Obergrenze" />
          </div>
        </div>
      <?php endif; ?>

      <?php if (isset($entry->lower_limit)) : ?>
        <div class="form-group">
          <label for="lower_limit<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white">Ziel INR - Untergrenze</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="lower_limit" id="lower_limit<?php echo $entry->id; ?>" value="<?php echo form_prep($entry->lower_limit); ?>" placeholder="Ziel INR - Untergrenze" />
          </div>
        </div>
      <?php endif; ?> -->

      <?php if (isset($entry->upper_limit)) : ?>
        <div class="form-group">
          <label for="upper_limit<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white"><?php echo $this->lang->line('pwidget_plot_graph_marcumar_upper_limit'); ?></label>
          <div class="col-sm-7">
            <input type="number" min="0" class="form-control" name="upper_limit" id="changeme_up" value="<?php echo form_prep($entry->upper_limit); ?>" disabled/>
          </div>
          <div class="col-sm-2">
            <span id="upr_limit_change" class="icomoon i-pencil-3 upr_limit_change"></span>
            <br><?php echo $this->lang->line('pwidget_plot_graph_marcumar_change'); ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if (isset($entry->lower_limit)) : ?>
        <div class="form-group">
          <label for="lower_limit<?php echo $entry->id; ?>" class="control-label col-sm-3 text-white"><?php echo $this->lang->line('pwidget_plot_graph_marcumar_lower_limit'); ?></label>
          <div class="col-sm-7">
            <input type="number" min="0" class="form-control" name="lower_limit" id="changeme_low" value="<?php echo form_prep($entry->lower_limit); ?>" disabled />
          </div>
          <div class="col-sm-2">
            <span id="lwr_limit_change" class="icomoon i-pencil-3 lwr_limit_change"></span>
            <br><?php echo $this->lang->line('pwidget_plot_graph_marcumar_change'); ?>
          </div>
        </div>
      <?php endif; ?>

<!-- 
      <div class="form-group">
        <label for="" class="control-label col-sm-3 text-white">
          <?php echo $this->lang->line('pwidget_plot_graph_insert_date'); ?>
        </label>
        <div class="col-sm-4">
          <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="rec_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', isset($entry->rec_date) && $entry->rec_date ? strtotime($entry->rec_date) : time() ); ?>" placeholder="Datum" style="" />
            <span class="add-on">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        </div>
        <label for="" class="control-label col-sm-1 text-white">
          <?php echo $this->lang->line('pwidget_plot_graph_insert_time'); ?>
        </label>
        <div class="col-sm-4">
          <div class="input-icon datetime-pick time-only">
          <input type="text" class="form-control input-sm" data-format="hh:mm" name="rec_time" id="document_time<?php echo $entry->id; ?>" value="<?php echo date('H:i', isset($entry->rec_time) && $entry->rec_time ? strtotime($entry->rec_time) : time() ); ?>" placeholder="Uhrzeit" style="" />
            <span class="add-on">
              <i class="fa fa-clock-o"></i>
            </span>
          </div>
        </div>
      </div> -->

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <label class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_plot_graph_insert_date'); ?>
    </label>
    <div class="col-sm-3">
      <?php if (empty($static)) : ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="rec_date" data-format="dd.MM.yyyy" id="rec_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->rec_date) ? strtotime($entry->rec_date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_home_entry_date'); ?>" />
          <span class="add-on">
            <i class="fa fa-calendar"></i>
          </span>
        </div>
      <?php else: ?>
        <p class="form-control-static"><?php echo date('d.m.Y', !empty($entry->rec_date) ? strtotime($entry->rec_date) : time()); ?></p>
      <?php endif; ?>
    </div>
    <label class="col-sm-1 control-label text-white">
      <?php echo $this->lang->line('pwidget_plot_graph_insert_time'); ?>
    </label>
    <div class="col-sm-3">
      <?php if (empty($static)) : ?>
        <div class="input-icon datetime-pick time-only">
          <input type="text" class="form-control input-sm" name="rec_time" data-format="hh:mm:ss" id="rec_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->rec_time) ? $entry->rec_time : date('H:i:s', time()); ?>" placeholder="<?php echo $this->lang->line('patients_home_entry_time'); ?>" />
          <span class="add-on">
            <i class="fa fa-clock-o"></i>
          </span>
        </div>
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->rec_time) ? $entry->rec_time : date('H:i:s', time()); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <div class="form-group">
      <label class="col-sm-3 control-label  text-white" style="word-break: break-all;"><?php echo $this->lang->line('patients_all_access_page_title'); ?></label>
      <div class="col-sm-9">
        <div class="radio-inline">
          <label>
            <input type="radio" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?>
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' : ($insert)?'checked="checked"':""; ?> />
            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> <span style="color:red">*</span>
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('patients_all_access_private_mode'); ?>
          </label>
        </div>
        <p class="help-block">
          <span style="color:red;">*</span>
          <?php echo $this->lang->line('patients_all_access_selection_info'); ?>
        </p>
      </div>
    </div>
  <?php endif; ?>

  <?php if (!empty($not_modal)) : ?>
    <?php if (isset($entry->id) && $entry->id) : ?>
      <div class="form-group">
        <div class="col-sm-12 text-right">
          <!-- <button class="btn btn-alt btn-lg" onclick="javascript:window.location='<?php echo site_url('akte/'.(!empty($table) ? $table : 'smart')); ?>'">
            <span class="icomoon i-enter-4"></span>
            <?php echo $this->lang->line('general_text_button_back'); ?>
          </button> -->
          <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/'.'delete/'.(!empty($table) ? $table : 'smart').'/'.$entry->id); ?>">
            <span class="icomoon i-remove-2"></span> 
            <?php echo $this->lang->line('general_text_button_delete'); ?>
          </button>
          <button class="btn btn-alt btn-lg"><span class="icomoon i-loop-4"></span> 
            <?php echo $this->lang->line('general_text_button_update'); ?>
          </button>
        </div>
      </div>
    <?php elseif (empty($hide_insert)) : ?>
      <div class="form-group">
        <div class="col-sm-12 text-right">
          <button class="btn btn-alt btn-lg"><span class="icomoon i-plus-circle"></span>
            <?php echo $this->lang->line('general_text_button_add'); ?>
          </button>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>

</form>
<script type="text/javascript">
	$("#frminsert, #frmupdate").submit(function(){
		$(".error").removeClass("error");
		$(this).find('.required').each(function() {
		    switch($(this).attr("type")) {
			    case 'text':
				    	if($(this).val()=="")
				    	{
				    		$(this).addClass("error");
					    }
		    }
		});
		if($(".error").length>0)
		{
			return false;
		}
		return true;
	});
</script>
<style>
	.error {
		border: 2px solid red;
	}
</style>



