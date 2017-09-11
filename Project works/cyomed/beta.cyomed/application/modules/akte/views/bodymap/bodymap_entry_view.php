<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  //loading languages
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/all_access', $this->m->user_value('language'));
  $this->load->language('pwidgets/bodymap', $this->m->user_value('language'));
  if ($this->m->user_role() == M::ROLE_PATIENT) : 
        $patient_details = $this->m->user_details($this->m->user_id(),'role_patient');
   else:
        $patient_details = $this->m->user_details($this->m->us_id(),'role_patient');     
  endif;
  if(isset($entry->pain_intensity) && !empty($entry->pain_intensity) && $entry->pain_intensity!=""){
      $pain_intensity=$entry->pain_intensity;
  }
  else{
      $pain_intensity=0;
  }
?>
<form id="<?php echo $form_id = 'image-'.random_string('alnum', 32);?>" role="form" method="post"  action="<?php echo site_url('akte/bodymap/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>"  enctype="multipart/form-data" <?php echo!empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo!empty($disabled) ? 'data-disabled="disabled"' : ''; ?>>
<!--<form class="form-horizontal"  onsubmit="bodymapValidation();"  id="bodymap-form bodymapFrm" role="form" method="post" action="<?php echo site_url('akte/bodymap/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>"  <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >-->
<input type="hidden" name="id" value="<?php echo $entry->id ?>" />
<input type="hidden" value="<?php echo  !empty($entry->x_position)?$entry->x_position:''?>" id="x_position" name="x_position" readonly class="x_position"/>                   
<input type="hidden" value="<?php echo  !empty($entry->y_position)?$entry->y_position:''?>" id="y_position"  name="y_position" readonly class="y_position"/>
<div class='blog-list'>
        <div class="col-md-5 padd0">
        <div class="body-pointer">
            <?php  $accordion_parent_id = 'image-'.random_string('alnum', 32); ?>
            <div class="body-img" id="<?php echo  $accordion_parent_id;?>" style="background:url('<?php echo $patient_details->gender=='' || $patient_details->gender==1 || empty($patient_details->gender)?base_url('assets/images/frontpage_pics/front_body_male.png'): base_url('assets/images/frontpage_pics/front_body_female.png');?>') center top no-repeat;  height:367px; width:246px; min-height:367px; min-width:253px; max-height:367px; max-width:253px; cursor:pointer; position:relative; ">
                 <span class="point <?php if($entry->y_position || $entry->x_position) echo  'pointer' ?>" style="<?php if($entry->y_position || $entry->x_position) echo 'top:'.$entry->y_position.'px;left:'.$entry->x_position.'px';?>"></span>
            </div>
           <div class="clr"></div>
        </div>
        </div>
        <div class="col-md-7">
            
    <div class="form-group2 <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    
    <label for="pain_intensity<?php echo $entry->id; ?>" class="control-label col-sm-5">
        <?php echo $this->lang->line('pain_intensity'); ?>
    </label>
        
    <div class="col-md-5 col-sm-5 col-xs-10">
      <?php if (empty($static)) : ?>
	    <input type="text" class="input-slider1" name="pain" id="pain_intensity<?php echo $entry->id; ?>" 
                   value="<?php echo !empty($pain_intensity) ? $pain_intensity : 1; ?>" 
                   data-slider-value="<?php echo $pain_intensity!='' ? $pain_intensity : 1; ?>" 
                   data-slider-min="1" data-slider-max="10" data-slider-step="1" 
                   data-slider-id='pain_intensity<?php echo $entry->id; ?>Slider' <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
      <?php else: ?>
        <div class="progress">
          <div class="progress-bar progress-bar-<?php echo !empty($pain_intensity) ? ($pain_intensity <= 4 ? 'success' : ($pain_intensity <= 6 ? 'warning' : 'danger') ) : 'primary'; ?>" role="progressbar" aria-valuenow="<?php echo !empty($pain_intensity) ? $pain_intensity * 10 : 0; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo !empty($pain_intensity) ? $pain_intensity * 10 : 0; ?>%">
            <span class="sr-only"><?php echo !empty($pain_intensity) ? $pain_intensity * 10 : 0; ?>% <?php echo $this->lang->line('patients_home_complaint_scale'); ?> (primary)</span>
          </div>
        </div>
      <?php endif; ?>
    </div>
        
      <?php 
    
    for($i=1;$i<11;$i++):  ?>
         <div class ="col-md-2 col-sm-2 col-xs-3 emotion-img" name="emotion" >
             <?php
    if(!empty($pain_intensity) && $pain_intensity):?>        
          <?php if ($pain_intensity==$i):?>           
              <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" emotion='<?php echo $i; ?>'>            
        <?php else:?>
            <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
          <?php endif;?>
            
        <?php elseif($i==1):?>
             <img src="<?php echo base_url('assets/img/emotion/1.png'); ?>" class="pull-right"  emotion='<?php echo $i; ?>'>
        <?php else:?>             
            <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
        <?php endif;?>
            </div>
      <?php endfor;?> 
        <div class="clear"></div>
  </div>            

                <div class="form-group2">
                    <label  class="control-label col-sm-5"> <?php echo $this->lang->line('pain_type'); ?> </label>
                    <div class="col-sm-7 padd-m0"> 
                        <label class="radio-inline">   
                         <?php echo $this->lang->line('acute'); ?>
                            <input type="radio" checked class="p_type" name="pain_type" value="acute" <?php echo ($entry->pain_type=='acute' && !empty($entry->pain_type))? 'checked="checked"':""; ?>/>
                        </label>
                 
                  <label class="radio-inline">  
                      <?php echo $this->lang->line('chronic'); ?> <input type="radio" class="p_type" name="pain_type" value="chronic" <?php echo ($entry->pain_type=='chronic' && !empty($entry->pain_type))? 'checked="checked"':""; ?>/> 
                  </label>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                 <div class="form-group2">
                    <label  class="control-label col-sm-5">  <?php echo $this->lang->line('qualities'); ?></label>
                   <div class="col-sm-7 padd-m0">  <select name="qualities" class="form-control" required="">
                        <option value=""><?php echo $this->lang->line('select_qualities'); ?></option>
                        <option value="pounding" <?php echo ($entry->qualities=='pounding' && !empty($entry->qualities))? 'selected="selected"':""; ?>> <?php echo $this->lang->line('pounding') ?></option>
                        <option value="stabbing" <?php echo ($entry->qualities=='stabbing' && !empty($entry->qualities))? 'selected="selected"':""; ?>><?php echo $this->lang->line('stabbing') ?></option>
                        <option value="dull" <?php echo ($entry->qualities=='dull' && !empty($entry->qualities))? 'selected="selected"':""; ?>><?php echo $this->lang->line('dull') ?></option>
                        <option value="cramplike"<?php echo ($entry->qualities=='cramplike' && !empty($entry->qualities))? 'selected="selected"':""; ?>><?php echo $this->lang->line('cramplike') ?></option>
                        <option value="aching" <?php echo ($entry->qualities=='aching' && !empty($entry->qualities))? 'selected="selected"':""; ?>><?php echo $this->lang->line('aching') ?></option>
                        <option value="burning" <?php echo ($entry->qualities=='burning' && !empty($entry->qualities))? 'selected="selected"':""; ?>><?php echo $this->lang->line('burning') ?></option>
                    </select>  </div>
                    <div class="clear"></div>
                </div>
                
                 <div class="form-group2">
                    <label  class="control-label col-sm-5">  <?php echo $this->lang->line('date_from'); ?> </label>
                   <div class="col-sm-7 padd-m0"> <div class="input-icon datetime-pick date-only">
                        <input type="text" data-provide="datepicker" class="form-control input-sm" readonly required="" id="date_from" name="date_from" data-format="dd.MM.yyyy" value="<?php echo date('d.m.Y', !empty($entry->date_from) ? strtotime($entry->date_from) : time()); ?>" placeholder="<?php echo $this->lang->line('enter_date'); ?>" />
                        <span class="add-on">
                            <i class="fa fa-calendar"></i>
                        </span>                    
                    </div>
                    
                </div>
                    <div class="clear"></div>
                    
                 </div>
                
                 <div class="form-group2">
                    <label  class="control-label col-sm-5">  <?php echo $this->lang->line('time_from'); ?></label>
                    <div class="col-sm-7 padd-m0"> 
                        <div class="input-icon datetime-pick time-only">
                            <input type="text" class="form-control input-sm" name="time_from" data-format="hh:mm:ss" id="time_from<?php echo $entry->id; ?>" value="<?php echo date('H:i:s', !empty($entry->time_from) ? strtotime($entry->time_from) : time()); ?>" placeholder="<?php echo $this->lang->line('time_from'); ?>" readonly="readonly" />
                            <span class="add-on">
                                <i class="fa fa-clock-o"></i>
                            </span> 
                        </div>
                    </div>
                    <div class="clear">                      
                    </div>
                </div>
 <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
                 <div class="form-group2 colaccess">
                    <label  class="control-label col-sm-5"> <?php echo $this->lang->line('patients_all_access_page_title'); ?> </label>
                      <div class="col-sm-12" style="padding-right:0">
        <div class="radio-inline">
          <label>
            <input type="radio" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?>
          </label>
        </div>
                          
        <div class="radio-inline">
          <label>
            <input type="radio" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' :($insert)?'checked="checked"':""; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> 
          </label>
        </div>
                          
        <div class="radio-inline">
          <label>
            <input type="radio" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_access_private_mode'); ?>
          </label>
        </div>
                             
                      </div>
                    <div class="clear"></div>
                      <?php if (empty($static)) : ?>
          <p class="help-block">
            <span style="color:red;">*</span>
            <?php echo $this->lang->line('patients_all_access_selection_info'); ?>
          </p>
        <?php endif; ?>
          
            <div class="clear"></div>
                </div> <?php endif; ?>
        </div><div class="clear"></div>
        
<div class="form-group2 <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <div class="col-md-12 padd-m0 text-right">
      <?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>
      <?php endif; ?>
      <?php if (isset($update_btn) && $update_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
      <?php endif; ?>
         <?php if (isset($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/bodymap/delete/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
      <?php endif; ?>
    </div>
    <div class="clear"></div>
  </div>            

    </div>
    
</form>    
<script src="<?php echo base_url() ?>assets/js/jquery.imagemapster.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

            $('img').mapster({
            fillColor: 'ff0000',
            fillOpacity: 0.3
            });
            
    $("#<?php echo $accordion_parent_id; ?>").click(function (e) {
       var form_id="<?php echo $form_id ?>";
//        alert(form_id);
        var Offset = $(this).offset();
        var relX = e.pageX - Offset.left;
        var relY = e.pageY - Offset.top;
//        $(this).closest('#x_position').val(relX);
//        alert($(this).closest('#x_position').val());
//        alert($("#<?php // echo $form_id ?>").closest(".y_position").val());
//        console.log( $(this));
//        alert('khk');
//        return false;
        $('#'+form_id+' .x_position').val(relX)
        $('#'+form_id+' .y_position').val(relY);
//        $(this).closest('#y_position').val(relY);
//        $('#'+form_id+' .x_position').css('left',relX+"px");
        $('#'+form_id+' .point').css({"left": relX+"px", 'top':relY+"px"});
        $('#'+form_id+' .point').addClass('pointer');
        
//        $($(this)).append('<span class="pointer" title="pointer" style="left:' + relX + 'px;top:' + relY + 'px"></span>')
            });
    
    /***use for condition entry validation***/
//    $(".form-group2").find('.condition-submit1').click(function (e) {
//        if($('#x_position').val() == "" && $('#y_position').val() == ""){
//            alert("Please select your pain position in bodymap");
//            return false;
//        }
//        var $forms = $('#bodymapFrm');
//        e.preventDefault();
//            $forms.length ? $($forms[0]).ajaxSubmit({                     success: function () {
//                $('.ajax-feed-link.active').click();
//                    }
//            }) : '';
//        });
    
    });
    
</script>
<script type="text/javascript">
  $(function() {
  
    var slider = new Slider("#pain_intensity<?php echo $entry->id; ?>", {
		formatter: function(value) {
			return value;
		}
	});
      
    $("#pain_intensity<?php echo $entry->id; ?>").slider().off('slide').on('change', function(slideStop){
            $(this).closest(".form-group2").find("img").each(function(){
            $(this).hide();

            if(parseInt($(this).attr('emotion'))==parseInt(slideStop.value.newValue))
              	$(this).show();
//            if(slideStop.value.newValue == 10){
//				if($(this).attr('emotion')==9){
//                	$(this).show();
//              	}
//            }
//            else if(slideStop.value.newValue == 0){
//              	if($(this).attr('emotion')==1){
//                	$(this).show();
//            	}
//          	}
		});
	});
  }); 
 </script>
 
 