<style>

 input[type=checkbox],
  input[type=radio]{
    opacity:1;
}
.pagination > li{ margin:0}
</style>
<script>
$(document).ready(function () {
    var $pagination = $('.pagination');
    var $lis = $pagination.find('li:not(#prev, #next)');
    $lis.filter(':gt(4)').hide();
    $lis.filter(':lt(5)').addClass('active1');
    
    var $next = $("#next").click(function () {
        var idx = $lis.index($lis.filter('.active1:last')) || 0;
        
        var $toHighlight = $lis.slice(idx + 1, idx + 6);
        if ($toHighlight.length === 0) {
            $prev.show();
            return;
        }
        
        $next.show();        
        $lis.filter('.active1').removeClass('active1').hide();
        $toHighlight.show().addClass('active1');
    });
    
    var $prev = $("#prev").click(function () {
        var idx = $lis.index($lis.filter('.active1:first')) || 0;
        
        var start = idx < 5 ? 0 : idx - 5;
        var $toHighlight = $lis.slice(start, start + 5);
        if ($toHighlight.length === 0) {
            $prev.hide();
            return;
        }      
        
        $next.show();
        $lis.filter('.active1').removeClass('active1').hide();
        $toHighlight.show().addClass('active1');
    });
    
}); // close jquery
</script>
<?php
  function week_start_date($wk_num, $yr, $first = 1, $format = 'Y-m-d')
  {
      $wk_ts  = strtotime('+' . $wk_num . ' weeks', strtotime($yr . '0101'));
      $mon_ts = strtotime('-' . date('w', $wk_ts) + $first . ' days', $wk_ts);
      return date($format, $mon_ts);
  }
  $day_label = array( 'Sonntag','Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', );
  //$sStartDate = week_start_date(date("W"), date("Y"));
  //$data[] = date("d.m",strtotime($sStartDate));

  for($i=0;$i<28;$i++){
    if(date('w', strtotime("+$i days")) != 0 && date('w', strtotime("+$i days")) != 6 ){
      $data[] = date('d-m-Y', strtotime("+$i days"));
      $date_day[] = date('w', strtotime("+$i days"));
    }
}

?>

<form role="form" id="formTerminSettings" method="post" action="<?php echo site_url('termin/doctor/settings/update_times'); ?>">
  <fieldset class="form-horizontal">
    <div class="row">
      <div class="form-group">
        <label class="col-sm-5 control-label">Öffentlich Sichtbarkeit temporär deaktivieren</label>
        <div class="col-sm-7">
          <label class="radio-inline">
            <input type="radio"  style="opacity:1;" name="regular_termin_on" id="inputActivated1" value="1" <?php echo $this->m->user_radio('regular_termin_on', '1'); ?> > Nein
          </label>
          &nbsp;&nbsp;
          <label class="radio-inline">
            <input type="radio" style="opacity:1;" name="regular_termin_on" id="inputActivated0" value="0" <?php echo $this->m->user_radio('regular_termin_on', '0'); ?> > Ja
          </label>
        </div>
      </div>
    </div>
  </fieldset>

  <hr/>

  <fieldset class="form-horizontal">
      <!-- Nav pills -->
    <ul class="nav nav-tabs pagination" role="tablist">
       <li id='prev'><a href='javascript:void(0);' class='prev'><<</a></li>   
      <?php for ($index = 0; $index < count($data); $index++) : ?>
        <li class="<?php echo $index == 0 ? 'active' : ''; ?>">
            <a href="#tabDay<?php echo $index + 1; ?>" role="tab" data-toggle="tab"><?php echo $day_label[$date_day[$index]]; ?><br /><small><?php echo $data[$index]; ?></small></a>
        </li>
      <?php endfor; ?>
       <li id='next'><a href='javascript:void(0);' class='next'>>></a></li>
    </ul>
      
      
      <span class="pull-right">
        <button type="submit" class="btn btn-primary">Speichern</button>
      </span>
    <!-- Tab panes -->
    <div class="tab-content">
      <?php for ($index = 0;$index <count($data); $index++) : ?>
        <div class="tab-pane fade <?php echo $index == 0 ? 'in active' : ''; ?>" id="tabDay<?php echo $index + 1; ?>" data-day="<?php echo $index + 1; ?>">
          <div class="portlet">
            <h4 class="portlet-title"><u>Zeiträume für <strong><?php echo $day_label[$date_day[$index]].'&nbsp;'.$data[$index]; ?></strong></u></h4>
            <div class="portlet-body">
              <?php
              $output_termins = array();
               
              //only for checking the code need to be deleted later
              $start_time = strtotime(date_format(date_time_set(date_create($data[$index]), 9, 00),'Y-m-d H:i:s'));
              
              $end_time = strtotime(date_format(date_time_set(date_create($data[$index]), 17, 00),'Y-m-d H:i:s'));
              
              $break_start = strtotime(date_format(date_time_set(date_create($data[$index]), 12, 00),'Y-m-d H:i:s'));
              $break_end = strtotime(date_format(date_time_set(date_create($data[$index]), 14, 00),'Y-m-d H:i:s'));
              $break_length = '+30 minutes';
             
              //till here

              $today = strtotime($data[$index]);
              foreach ($this->m->user()->regular_termins as $row) {
                    $start_day = strtotime(date("d-m-Y",strtotime($row->start)));
                    $end_day = strtotime(date("d-m-Y",strtotime($row->end)));
                if ($today>=$start_day && $today<=$end_day) {
                  $output_termins[] = $row;
                } else {
                  continue;
                }
              }
              ?>
              <input type="hidden" class="regular-termins-count" name="regular_termins_count[<?php echo $index + 1; ?>]" value="<?php echo count($output_termins); ?>" />
              <?php $em = FALSE; ?>
              
              <?php foreach ($output_termins as $row) : ?>
                <?php while ($start_time < $end_time): ?>
                  
                <div class="form-group" style="margin-left: 0px; margin-right: 0px;"  data-regular-termin-id="<?php echo $row->id; ?>">
                  <div class="col-sm-3 form-inline">
                    <label class="checkbox-inline">
                      <input type="checkbox" style="opacity:1;" class="input-termin-ready" name="ready[<?php echo $row->id; ?>]" value="1" <?php echo $row->ready ? ' checked="checked" ' : ''; ?> > Öffentlich sichtbar
                    </label>
                  </div>
                  <div class="col-sm-4 form-inline">
                      <input type="tex  t" name="termin_start[<?php echo $row->id; ?>]" id="termin_start[<?php echo $row->id; ?>]" class="form-control time-picker" value="<?php echo date('H:i', date($start_time)); ?>" style="width:90px;float:left;" />
                      &nbsp;-&nbsp;
                      <?php
                        $time = strtotime($break_length,$start_time);
                        $start_time=(strtotime($break_length,$start_time)==$break_start)?$break_end:strtotime($break_length,$start_time);
                      ?>
                      <input type="text" name="termin_end[<?php echo $row->id; ?>]" id="termin_end[<?php echo $row->id; ?>]" class="form-control time-picker" value="<?php echo date('H:i', date($time)); ?>" style="width:90px;" />
                  </div>
                  <div class="col-sm-4 form-inline">
                      <table>
                         <tr><td><label class="checkbox-inline"><input type="checkbox" style="opacity:1;" class="input-termin-insurance" name="insurance[<?php echo $row->id; ?>][]" value="1" <?php echo $row->insurance_private ? ' checked="checked" ' : ''; ?> > Privat versichert / Selbstzahler</label></td></tr> 
                         <tr><td><label class="checkbox-inline"><input type="checkbox" style="opacity:1;" class="input-termin-insurance" name="insurance[<?php echo $row->id; ?>][]" value="2" <?php echo $row->insurance_public ? ' checked="checked" ' : ''; ?> > Gesetzlich versichert</label></td></tr>
                         <tr><td><label class="checkbox-inline"><input type="checkbox" style="opacity:1;" class="input-termin-single" name="single[<?php echo $row->id; ?>]" value="0" <?php echo $row->insurance_public || $row->insurance_private ? '' : ' checked="checked" '; ?> > Eingene Belegung</label></td></tr>
                         <tr><td><label class="checkbox-inline"><input type="checkbox" style="opacity:1;" class="input-termin-mask" name="mask[<?php echo $row->id; ?>]" value="1" <?php echo $row->mask ? ' checked="checked" ' : ''; ?> > Schließzeiten</label></td></tr>
                      </table>
                  </div>
                  <div class="col-sm-1 text-center">
                    <button type="button" class="btn btn-danger btn-sm button-regular-termin-remove"><span class="icomoon i-close-3"></span> </button>
                  </div>
                </div>
                
              <?php endwhile; ?>
              <?php endforeach; ?>
              <input type="hidden" class="regular-termins-added" name="regular_termins_added[<?php echo $index + 1; ?>]" value="0" data-day="<?php echo $index + 1; ?>" />
              <!-- <div class="form-group hidden form-group-termin-wrapper">                  
                  <div class="col-sm-12">
                <div class="col-sm-3 form-inline">
                  <label class="checkbox-inline">
                    <input type="checkbox" class="input-termin-ready" value="1" >Öffentlich sichtbar
                  </label>
                </div>
                <div class="col-sm-4 form-inline">
                  <input type="text" style="width:90px;float:left;" class="form-control select-termin-start time-picker" value="9:00" />
                  &nbsp;-&nbsp;
                  <input type="text" style="width:90px;"  class="form-control select-termin-end time-picker" value="9:30"  />
                </div>
                <div class="col-sm-4 form-inline">
                      <table>
                          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-insurance" value="1" > Privat versichert / Selbstzahler</label></td></tr>
                          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-insurance" value="2" > Gesetzlich versichert</label></td></tr>
                          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-single" value="0" > Eingene Belegung</label></td></tr>
                          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-mask" value="1" > Schließzeiten</label></td></tr>
                      </table>
                </div>
                <div class="col-sm-1 text-center">
                  <button type="button" class="btn btn-danger btn-sm button-regular-termin-remove"><span class="icomoon i-close-3"></span></button>
                </div>
                  </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-9 form-inline">
                  <button type="button" class="btn btn-success button-regular-termin-add"><span class="icomoon i-plus-circle-2"></span> Hinzufügen</button>
                </div>
              </div>
            </div>
            <!-- <div class="panel-footer">Panel footer</div> -->
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </fieldset>

</form>


<!--<h4 class="content-title"><u>Live View</u><i class="fa fa-eye"></i> </h4>-->

<div>

<div>
    <?php //if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
      <?php //$this->load->view('settings/times_entry_view', array('doctor' => $doctor, )); ?>
    <?php //endforeach; endif; ?>
  </div>

</div>

<script id="termin-to-add" type="text/x-custom-template">
  <div class="form-group hidden form-group-termin-wrapper">                  
    <div class="col-sm-12">
      <div class="col-sm-3 form-inline">
        <label class="checkbox-inline">
          <input type="checkbox" class="input-termin-ready" value="1" >Öffentlich sichtbar
        </label>
      </div>
      <div class="col-sm-4 form-inline">
        <input type="text" style="width:90px;float:left;" class="form-control select-termin-start time-picker" value="9:00" />
        &nbsp;-&nbsp;
        <input type="text" style="width:90px;"  class="form-control select-termin-end time-picker" value="9:30"  />
      </div>
      <div class="col-sm-4 form-inline">
        <table>
          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-insurance" value="1" > Privat versichert / Selbstzahler</label></td></tr>
          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-insurance" value="2" > Gesetzlich versichert</label></td></tr>
          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-single" value="0" > Eingene Belegung</label></td></tr>
          <tr><td><label class="checkbox-inline"><input type="checkbox" class="input-termin-mask" value="1" > Schließzeiten</label></td></tr>
        </table>
      </div>
      <div class="col-sm-1 text-center">
        <button type="button" class="btn btn-danger btn-sm button-regular-termin-remove"><span class="icomoon i-close-3"></span></button>
      </div>
    </div>
  </div>
</script>
