<?php
$this->load->language('pwidgets/rezept',$this->m->user_value('language'));
?>
<script type="text/javascript">  
$(document).ready(function() 
{
  $('#cyomed_doc').on('ifClicked', function(event){
  $("#family_doc_list").hide();
  });
  $('#family_doc').on('ifClicked', function(event){
   $("#family_doc_list").show();
  });
  $(".otherland").hide();
  // $(".follow_up").hide();
  /*
  $("#follow_up").change(function()
  {
    if($("#follow_up").val()=='yes'){
     $(".follow_up").slideDown();
     $(".follow_up").prop('required',true);
    }
    else if($("#follow_up").val()=='no'||$("#follow_up").val()===''){
      $(".follow_up").slideUp();
     $(".follow_up").prop('required',false);
     }
  });*/
  /*
  $("#country").change(function()
  {
    if($("#country").val()=='83')
    {
     $(".germany").show();
     $(".otherland").hide();
    }   
    else{
      $(".otherland").show();
      $(".germany").hide();
    }
      
  });
*/
    $(".otherland").show();
    $(".germany").hide();
  // $("#question_form").submit(function(e){
  //   e.preventDefault();
  //  if($("#follow_up")===""){
  //    $("#follow_up").focus();
  //    alert('bitte wählen');
  //  }
  // });
  
  $('#question_form').validationEngine();
  
});
</script>
<form class="form-horizontal" role="form" name="frm" id="question_form" method="post" action="<?php echo site_url('rezept/rezept/insert_answers'); ?>" enctype="multipart/form-data">
    
    <div class="progress" style="position:fixed; width: 38%;">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
    40% Complete (success)
  </div>
</div>
   
    <div class="form-group"> 
     <label for="country" class="col-sm-6 control-label"><?php //echo $this->lang->line('epres_question_doctor');?></label>
      <div class="col-sm-6">
       <div class="radio-inline" id="cyomed_doc" >
            <label>
                <input type="radio"   value="2" name="cyomeddoctor" checked  />
                      Cyomed Doctor
            </label>
       </div>
       <div class="radio-inline" id="family_doc">
           <label>
            <input type="radio" style="opacity:1;" value="1" class="cyomed_doc" name="cyomeddoctor"  <?php echo empty($familydoclist)?'disabled="disabled"':''; ?>   />
                     Personal Doctor
          </label>
       </div>
     </div>
    </div>
    <div class="form-group" id="family_doc_list" style="display:none;"> 
    <label for="country" class="col-sm-6 control-label"></label>
     <div class="col-sm-6">
         <select name="doctor_id[]" data-placeholder="Choose Doctor"  multiple class="select" tabindex="8">
           <?php 
           foreach($familydoclist as $key=>$value)
           {
           ?>
           <option value="<?php echo $value->doctor_inserted_id;?>">
            <?php echo $value->name." ".$value->surname;?>
           </option>
           <?php 
            }
           ?>
     </select>
          </div>
      </div>
  
    <div class="form-group">
      <label for="country" class="col-sm-6 control-label"><?php echo $this->lang->line('epres_question_country');?><span class="text-danger">*</span></label>
      <div class="col-sm-6">
        <select type="text" name="country" id="country" class="form-control validate[required]">
        <?php foreach ($this->country->get("country_name")->result() as $c) : ?>
          <option value="<?php echo $c->id; ?>" <?php echo $c->id == '83' ? 'selected="selected"' : '' ?>> <?php echo $c->country_name; ?></option>
        <?php endforeach; ?>
      </select>
      </div>
    </div>
    <!-- Followup -->
    <div class="form-group">
      <label for="follow_up" class="col-sm-6 control-label"><?php echo $this->lang->line('pwidgets_follow_up');?><span class="text-danger">*</span></label>
      <div class="col-sm-6">
        <select type="text" class="form-control validate[required]" name="follow_up" id="follow_up">
          <option value=""><?php echo $this->lang->line('epres_follow_up_choose');?></option>
          <option value="yes"><?php echo $this->lang->line('epres_follow_up_option_1');?></option>
          <option value="no" ><?php echo $this->lang->line('epres_follow_up_option_2');?></option>
        </select>
      </div>
    </div>

   <!-- Wirkstoff list of the prescribable medicine from germany -->
<?php /*?>  <div class="form-group germany">
      <label for="wirkstoff_g" class="col-sm-6 control-label"> 
        <?php echo $this->lang->line('pwidgets_drug');?>
      </label>
      <div class="col-sm-6">
        <select class="select" name="wirkstoff_g" id="wirkstoff_g">
          <?php foreach ($medicine as $row=>$value): ?>
            <option value = "<?php echo $value?>" ><?php echo $value?></option>
        <?php endforeach; ?>
        </select>
      </div>
    </div><?php */?>


    <div class="form-group otherland">
      <label for="wirkstoff" class="col-sm-6 control-label"><?php echo $this->lang->line('pwidgets_drug');?><span class="text-danger">*</span></label>
      <div class="col-sm-6">
        <input type="text" class="form-control validate[required]" name="wirkstoff" id="wirkstoff" />
      </div>
    </div>

    <!-- Handelsname -->
      <div class="form-group">
      <label for="Handelsname" class="col-sm-6 control-label"> 
        <?php echo $this->lang->line('pwidgets_Handelsname');?>
      </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="Handelsname" id="Handelsname" />
      </div>
    </div>

    <!-- Atc -->
    <div class="form-group otherland">
      <label for="atc_code" class="col-sm-6 control-label">
        <?php echo $this->lang->line('pwidgets_atc_code');?>
      </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="atc_code" id="atc_code"/>
      </div>
    </div>

    <!-- Atc -->
<?php /*?>     <div class="form-group germany">
      <label for="atc_code_g" class="col-sm-6 control-label">
        <?php echo $this->lang->line('pwidgets_atc_code');?>
      </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="atc_code_g" id="atc_code_g"/>
      </div>
    </div>
    <?php */?>
      <!-- packsize -->
    <div class="form-group">
      <label for="inputpacksize" class="col-sm-6 control-label">
        <?php echo $this->lang->line('pwidgets_packsize');?>
      </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="packsize" id="inputpacksize"/>
      </div>
    </div>
  <!-- manufacturer -->
    <div class="form-group">
      <label for="inputmanufacturer" class="col-sm-6 control-label">
        <?php echo $this->lang->line('pwidgets_manufacturer');?>
      </label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="manufacturer" id="manufacturer" />
      </div>
    </div>

  

    <hr class = "whiter m-t-20">

    <?php
    $data_value ='';
    $data_chaecked ='';
    foreach($questions as $row): 
        
        ?>
      <div class="form-group <?php echo $row['class'];?>">
        <label class="col-sm-6 control-label"><?php echo $row['question']?></label>
        <div class="col-sm-6">
        <!-- input fields with text type -->
        <?php if($row['input_type']=='text'):
             if($row['id']==9){
            ?>     
        <input type="text" value="<?php echo $confEmerg; ?>" class="form-control <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" />
             <?php }elseif($row['id']==38){ ?>
        <input type="text" value="<?php echo $allergy; ?>" class="form-control <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" />
             <?php } elseif($row['id']==8){ ?>
        <input type="text" value="<?php echo $bp; ?>" class="form-control <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" />
    <?php }else{ ?>    
        <input type="text" class="form-control <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" />
             <?php }?>
        <!-- input fields with date type -->
        <?php elseif($row['input_type']=='date'):?>
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" data-format="dd.MM.yyyy"/>
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>

        <!-- input fields with select type -->
        <?php elseif($row['input_type']=='select'):?>
          <select class="form-control select <?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" id="question<?php echo $row['id']; ?>" >
            <?php for($i=1;$i<=$row['option_count'];$i++):?>
              <option value="<?php echo $row['option'.$i];?>"><?php echo $row['option'.$i];?></option>
            <?php endfor;?>
          </select>

        <!-- input fields with radio type -->
        <?php elseif($row['input_type']=='radio'):?>
            <?php for($i=1;$i<=$row['option_count'];$i++):?>
              <div class="radio-inline">
                <label>
                 <?php if(($row['id']==11 && $nierenschwache_status==1 && trim($row['option'.$i])=='ja') || ($row['id']==16 && $gout_status==1 && trim($row['option'.$i])=='ja')
                         || ($row['id']==17 && $diabetic_status==1 && trim($row['option'.$i])=='ja') || ($row['id']==20 && $heart_attack_status==1 && trim($row['option'.$i])=='ja')
                         || ($row['id']==21 && $stroke_status==1 && trim($row['option'.$i])=='ja') || ($row['id']==22 && $durchblutungsst_status==1 && trim($row['option'.$i])=='ja')
                         || ($row['id']==28 && $smoking_status==1 && trim($row['option'.$i])=='ja')
                         ){  ?> 
                  <input type="radio" checked="checked" class="<?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" value="<?php echo $row['option'.$i];?>" />
                 <?php }else{ ?>
                 <input type="radio"  class="<?php echo $row['class'];?>" name="question<?php echo $row['id']; ?>" value="<?php echo $row['option'.$i];?>" />
                 <?php }?>
    <?php echo $row['option'.$i];?>
                </label>
              </div>
            <?php endfor;?>

        <?php elseif($row['input_type']=='multi_time'): ?>
        <select type="text" name="question<?php echo $row['id']; ?>[]" class="form-control" multiple="multiple" id="question<?php echo $row['id']; ?>">
            <?php for($i=0;$i<24;$i++):?>
              <?php for($j=0;$j<60;$j=$j+5):?>
                <option value="<?php echo (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j);?>" ><?php echo (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j);?></option>
              <?php endfor; ?>
            <?php endfor; ?>
          </select>
        <?php endif;?>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- recent complains/problems -->
    <div class="form-group">
      <label for="comments" class="col-sm-6 control-label">
        <h5><?php echo $this->lang->line('epres_comments_title');?></h5>
      </label>
      <div class="col-sm-6">
        <textarea class="form-control" rows="5" name="comments" id="comments" placeholder="" ></textarea>
      </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
          <div class="checkbox-inline">
            <label>
              <div class="checkbox_box">
                <input type="checkbox" value="yes" name="agreement1" required="required" />
                <?php echo $this->lang->line('epres_user_agree_1');?>
              </div>
            </label>
          </div>
        </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <div class="checkbox-inline">
          <label>
            <div class="checkbox_box">
              <input type="checkbox" value="yes" name="agreement2" required="required"/>
                <?php echo $this->lang->line('epres_user_agree_2');?>
            </div>
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12 text-right">
        <button class="btn btn-alt btn-lg" type="submit"><span class="glyphicon glyphicon-ok"></span> <?php echo $this->lang->line('epres_data_submit_button');?> </button>
      </div>
    </div>
</form>
<script type="text/javascript">
//    $( "#question_form" ).delegate( ".form-control,input", "blur,ifClicked", function() { alert('fas');    });
//      $( "#question_form" ).delegate( "input", "ifClicked", function() {
//       alert('b');
//    });
//    $( "#question_form" ).each("input, select, textarea",function(i,val){
//        alert('dfas');
//    });
//    $("#question_form").on('blur select focus','input, select, textarea',function(){
//        
//        alert('fas');
//    });


//    $( "#question_form" ).delegate( ".form-control,input", "blur", function() {
//    alert("fsa");
//    });
    
//    $("#question_form").on('blur select focus','input, select, textarea',function(){
//        
//        alert('fas');
//    });

</script>
