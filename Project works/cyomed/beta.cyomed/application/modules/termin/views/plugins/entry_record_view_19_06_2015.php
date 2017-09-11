
<div class="doc-block">
  
  <div class="row">

     <div class="col-md-6 doc-my">
       <div class="doc-cal-block" id="doc-cal-<?php echo $doctor->id;?>">
        <!--<img src="<?php echo base_url('assets/img/cal-img.jpg');?>" width="100%" alt="">-->
      </div>
    </div>

    <div class="col-md-6">
      <div class="doc-time-block">
        <div class="row">
          <div class="owl-calendar calendar scrollable large" data-doctor-id="<?php echo isset($doctor->id) ? $doctor->id : ''; ?>">
           <div class="action no-available-appointments">
            <div class="message">keine freien Termine verfAgbar</div>
          </div>
          <div class="action integration_8">
           <div class="message">
            <a href="http://www.ihrarzt24.de/termin?u=8383&amp;l=7239&amp;m=&amp;tt=&amp;i=2" style="float:right;margin-right:.5rem;">Hier registrieren</a>
            <div>Möcheten Sie Ihre Termine hier sehen?</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="row">
      <div class="col-md-12">
      <a href="https://www.ihrarzt24.de/apps/beta.cyomed/" target="_blank">
        <button  class="btn btn-primary">Powered by Cyomed</button>
      </a>
      </div>
    </div>

<script>
    
  (function($){ 

     $('#doc-cal-<?php echo $doctor->id;?>').fullCalendar({
      header: {
        left: '',
        center: '',
        right: ''
      },
      axisFormat: 'HH:mm',
      timeFormat: {
                                 agenda: 'H(:mm)' //h:mm{ - h:mm}'
                               },
                               defaultDate: '<?php echo date('Y-m-d');?>',


                               selectable:true,
                               editable: true,
                               eventLimit: true, 
                               eventSources:'' 
                             });
          // Define the latitude and longitude positions
          $('#gmap-relocate<?php echo $doctor->id;?>').click(function(e)
          {
           $("#map<?php echo $doctor->id;?>").toggle();  
           $("#map<?php echo $doctor->id;?>").getmap('<?php echo $doctor->native->coordinate_lng; ?>','<?php echo $doctor->native->coordinate_lat; ?>','<?php echo $address;?>','map<?php echo $doctor->id;?>');
         });
        })(jQuery);

</script>