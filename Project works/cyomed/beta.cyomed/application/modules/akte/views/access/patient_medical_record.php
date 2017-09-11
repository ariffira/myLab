<?php $this->ui->feed_item->base_init(); ?>
<?php 
	/*** for diagnosis****/         
    $diagnosiscount=1; 
    foreach ($diagnosis as $entry_index => $entry) :
		if(in_array($entry->feed_type, array('diagnosis',)))
      	{
	        $this->load->language('pwidgets/diagnosis', $this->m->user_value('language'));
	        $this->load->language('global/general_text', $this->m->user_value('language'));
	        
	        switch ($entry->status) {
	        	case 0:	$entry->status='Not Confirmed';
	        			break;
	        			
	        	case 1:	$entry->status='Confirmed';
	        			break;
	        			
                case 2:	$entry->status='Emergency';
        				break;
        
	        	default:$entry->status='';
	        			break;
	        }
	        
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
									<?php echo $this->lang->line('pwidget_diagnosis_diagnosis_status'); ?>
								</th>
								<th>
									<?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
								</th>
							</tr>
						</thead>
						<tbody>
	<?php	}	?>
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
                        			<div class="form-group" style="width: 95px;">
                        				<label><?php echo !empty($entry->status) ? $entry->status : ''; ?></label>
                        			</div>
                        		</td>
                        		<td>
                        			<div class="form-group">
                        				<label>
                        					<input type="checkbox" value="1" id="allergy<?php echo $entry->id; ?>" name="allergy" <?php echo !empty($entry->allergy) && $entry->allergy == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
                        					<?php //echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
                        				</label>
                        			</div>
                        		</td>
                        	</tr>
				<?php   
					if($diagnosiscount==count($diagnosis))
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


