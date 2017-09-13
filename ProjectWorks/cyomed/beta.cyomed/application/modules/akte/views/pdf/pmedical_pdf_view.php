<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
<div class="postContainer">
    <div class="postTitle">Patient Medical Records</div>
    	<div class="page">
		<table class="card_table"  >
		<tbody >
			<tr>
				<td colspan="3"><?php $this->ui->feed_item->base_init(); ?>
<?php 
if(isset($pdfcheck))
{
 $i = 1;
 foreach ($v_usrs as $row) : ?>   
                  <div class="row" style="float:left;border-bottom: 1px solid #DDD; padding-top: 5px;padding-bottom: 5px;">
                        <div class="col-xs-3" style="float:left;"><img height="200px" width="200px" class="profile-pic img-responsive" src="<?php $this->load->model('document/mdoc');
                         echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                        <div class="col-xs-9" style="padding-top: 5px;padding-bottom: 5px;" >  
                            <label>Name  :</label><?php echo $row->name; ?><?php echo $row->surname; ?> <br/>
                            <label>Regid :</label><?php echo $row->regid; ?><br/>
                            <label>Age  :</label><?php echo $this->m->get_Age_difference($row->dob,date("Y-m-d"));?><br/>
                            <label>Email  :</label><?php echo $row->email; ?><br/>
                            <label>City  :</label><?php echo $row->city; ?><br/>
                            <label>Mobile Number :</label><?php echo $row->mobile; ?><br/>
                            <label>Telephone Number :</label><?php echo $row->telephone; ?><br/>
                        </div>
                        <div style="clear:both;"></div>
                       
                    </div>
 <?php
 $i++;
 endforeach; 
}
/*** for diagnosis****/         
     $diagnosiscount=1; 
      foreach ($diagnosis as $entry_index => $entry) :
      if(in_array($entry->feed_type, array('diagnosis',)))
      {
        $this->load->language('pwidgets/diagnosis', $this->m->user_value('language'));
        $this->load->language('global/general_text', $this->m->user_value('language'));
        if($diagnosiscount==1)
        {
      ?>
       <div class="table-responsive overflow">
           <h1><?php echo $entry->feed_type; ?> </h1>
                <table class="table tile table-condensed table-striped">
                   
                  <thead>
                    <tr>
                      <th>
                       <?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_diagnosis_icd_code');  ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?>
                      </th>
                      <th>
                         <?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
        }?>

                   <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->title) ? $entry->title : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->icd_code) ? $entry->icd_code : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><input type="checkbox" value="1" id="allergy<?php echo $entry->id; ?>" name="allergy" <?php echo !empty($entry->allergy) && $entry->allergy == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
          <?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
                            </label>
                          </div>
                        </td>
                        
                      </tr>
           <?php   if($diagnosiscount==count($diagnosis))
           { 
            ?>      
                  </tbody>
                </table>
            </div>
        <?php
          }
        }
        $diagnosiscount++;
        endforeach;  
  /****END HERE****/ 
        $medicationcount=1;
       foreach ($medication as $entry_index => $entry) : 
       if(in_array($entry->feed_type, array('medication',)))
       {
        $this->load->language('global/general_text',$this->m->user_value('language'));
        $this->load->language('pwidgets/medication', $this->m->user_value('language'));
     
        if($medicationcount==1)
        {
        ?>
    <div class="table-responsive overflow">
        <h1><?php echo $entry->feed_type; ?> </h1>
                <table class="table tile table-condensed table-striped">
                  <thead>
                    <tr>
                      <th>
                       <?php echo $this->lang->line('pwidget_medication_name'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_medication_atc_code'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('pwidget_medication_substance'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>
                      </th>
                     
                    </tr>
                  </thead>
                  <tbody>
   <?php } ?>
                   <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->name) ? $entry->name : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->atc_code) ? $entry->atc_code : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->substance) ? form_prep($entry->substance) : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->dose_rate) ? form_prep($entry->dose_rate) : ''; ?>
                            </label>
                          </div>
                        </td>
                        
                      </tr>
                <?php
                if($medicationcount==count($medication))
               {
        ?>    
                  </tbody>
                </table>
</div>
 <?php
               }
  
               $medicationcount++;
       }
endforeach;
/**vaccination**/
$vaccinationcount=1;
          foreach ($vaccination as $entry_index => $entry) : 
            if(in_array($entry->feed_type, array('vaccination', )))
            {
             $this->load->language('global/general_text',$this->m->user_value('language'));
             $this->load->language('patients/vaccination_card', $this->m->user_value('language'));
if($vaccinationcount==1)
{
?>
<div class="table-responsive overflow">
    <h1><?php echo $entry->feed_type; ?> </h1>
                <table class="table tile table-condensed table-striped">
                  <thead>
                    <tr>
                      <th>
                       <?php echo $this->lang->line('patients_vaccination_card_trade_name'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('patients_vaccination_card_batch_no'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('patients_vaccination_card_date'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('patients_vaccination_card_doctor'); ?>
                      </th>
                     
                    </tr>
                  </thead>
                  <tbody>
 <?php } ?>
                   <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->Handelsname) ? form_prep($entry->Handelsname) : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->vaccination) ? form_prep($entry->vaccination) : ''; ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo !empty($entry->Praxis) ? $entry->Praxis : ''; ?>
                            </label>
                          </div>
                        </td>
                        
                      </tr>
   <?php  if($vaccinationcount==count($vaccination))
{
?>               
                  </tbody>
                </table>
</div>
<?php
}
                
                 $vaccinationcount++;
                     
            }
            endforeach;
  /***vaccination**/
            
/**casehistory**/
$casehistorycount=1;

          foreach ($casehistory as $entry_index => $entry) : 
            if(in_array($entry->feed_type, array('casehistory', )))
            {
             $this->load->language('global/general_text',$this->m->user_value('language'));
		$this->load->language('patients/casehistory',$this->m->user_value('language'));
if($casehistorycount==1)
{
?>
<div class="table-responsive overflow">
    <h1><?php echo $this->lang->line('patients_home_case_history'); ?> </h1>
                <table class="table tile table-condensed table-striped">
                  <thead>
                    <tr>
                      <th>
                       <?php echo $this->lang->line('main_symptom_and_actual_case_history'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('general_anamnesis'); ?>
                      </th>
                      <th>
                        <?php echo $this->lang->line('pre_existing_conditions'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('medication'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('allergies_and_incompatibilities'); ?>
                      </th>
                     <th>
                       <?php echo $this->lang->line('stimulants_and_drugs'); ?>
                      </th>
                      <th>
                      <?php echo $this->lang->line('family_case_history'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('social_case_history'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('actual_doctors'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('general_findings'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('head_and_neck'); ?>
                      </th>
                        <th>
                       <?php echo $this->lang->line('thorax_and_lungs'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('heart_circulation_vessels'); ?>
                      </th><th>
                       <?php echo $this->lang->line('abdomen'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('musculosceletal_system'); ?>
                      </th>                      
                      <th>
                       <?php echo $this->lang->line('nervous_system'); ?>
                      </th>
                      
                      <th>
                       <?php echo $this->lang->line('appearance'); ?>
                      </th>
                      <th>
                       <?php echo $this->lang->line('other_findings'); ?>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
 <?php } ?>
                    <tr>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->symptom_current_history ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->vegetative_anamnese ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->pre_existing_conditions ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->drug_history ?>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->allergies ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->related_products ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->family_history ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->social_history ?>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->attending_physicians ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->general_findings ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->head_and_neck ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->thorax_and_lungs ?>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->heart_circulation_blood_vessels ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->abdomen ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->motion_apparatus ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->nervous_system ?>
                            </label>
                          </div>
                        </td>
			 <td>
                          <div class="form-group">
                            <label><?php echo $entry->maintenance_state ?></label>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label><?php echo $entry->other_findings ?>
                            </label>
                          </div>
                        </td>
                      </tr>
   <?php  if($casehistorycount==count($casehistory))
{
?>               
                  </tbody>
                </table>
</div>
<?php
}
                
                 $casehistorycount++;
                     
            }
            endforeach;
  /***casehistory**/

            /***blood sugar**/
           foreach ($blood_sugar as $entry_index => $entry) : 
      
               if(in_array($entry->feed_type, array('blood_sugar', )))
            {
             
              $this->load->view('access/module/'.($entry->feed_type).'_table_view', array(
                'entries' => $entry->entries,
              ));
            }
            else 
            {
              $this->ui->mc->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              echo $this->ui->mc->output();
            }
            endforeach;
  /*** end here***/   
 /***blood pressure**/
          foreach ($blood_pressure as $entry_index => $entry) : 
            if(in_array($entry->feed_type, array('blood_pressure', )))
            {
              $this->load->view('access/module/'.($entry->feed_type).'_table_view', array(
                'entries' => $entry->entries,
              ));
            }
            else 
            {
              $this->ui->mc->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              echo $this->ui->mc->output();
            }
            endforeach;
    /***end here***/
            /***weight bmi***/
            foreach ($weight_bmi as $entry_index => $entry) : 
            if(in_array($entry->feed_type, array('weight_bmi', )))
            {
              $this->load->view('access/module/'.($entry->feed_type).'_table_view', array(
                'entries' => $entry->entries,
              ));
            }
            else 
            {
              $this->ui->mc->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              echo $this->ui->mc->output();
            }
            endforeach;
            /***End HERE***/
            /** for marcumar **/
            foreach ($marcumar as $entry_index => $entry) : 
            if(in_array($entry->feed_type, array('marcumar', )))
            {
              $this->load->view('access/module/'.($entry->feed_type).'_table_view', array(
                'entries' => $entry->entries,
              ));
            }
            else 
            {
              $this->ui->mc->content(
                'content',
                '<ul class="icons-list">'.
                '  <li>'.
                '    <i class="icon-li fa fa-quote-left"></i>'.
                '    #Entry_'.$entry->id.
                '  </li>'.
                '</ul>'
              );
              echo $this->ui->mc->output();
            }
            endforeach;
            /*** end here ***/
            
       ?>



				</td>
			</tr>
		</tbody>
		</table>
	</div>

</div>
<div class="page"></div>
<div class="page"></div>
</body>
</html>
