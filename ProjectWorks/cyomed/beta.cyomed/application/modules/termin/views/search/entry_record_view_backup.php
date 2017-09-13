<?php
  $doctor = isset($doctor) && $doctor ? $doctor : (new stdClass());
  $this->load->model('document/mdoc');
 $img_path = $this->mdoc->get_doctor_img_path($doctor->id);
  
?>
<?php
$add = urlencode($doctor->address);
$city = urlencode($doctor->city);
$zip = $doctor->zip;
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add.',+'.$city.',+'.$zip.'&sensor=false');
$output= json_decode($geocode);
$address=$doctor->distance. "km".",".$doctor->address.",".$doctor->zip;
?>
<div class="doc-block">
      <h2 class="title"><a data-item-prop="url" href="<?php echo site_url('/termin/profile/doctor/'.(isset($doctor->id) ? 'member' : 'google').'/'.(isset($doctor->id) ? $doctor->id : '')); ?>" data-fill="doctor-name"><?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?></a></h2>
       <div class="doc-address">   <?php echo $doctor->distance. "km"; ?>,<?php echo isset($doctor->address) ? $doctor->address : ''; ?>,<?php echo isset($doctor->zip) ? $doctor->zip : ''; ?> <?php echo isset($doctor->city) ? $doctor->city : ''; ?>  <span ><button class="btn btn-primary btn-xs gmap-relocate" id="gmap-relocate<?php echo $doctor->id;?>" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseExample<?php echo $doctor->id;?>">&nbsp;&nbsp;&nbsp; <span class="icomoon i-location-4"></span> &nbsp;&nbsp;&nbsp;</button></span></div>
       <div class=" col-md-12 map-tog " >
        <div id="map<?php echo $doctor->id;?>" style="width:100%;height:300px;margin-top:10px;display:none;" ></div> 
       </div>
      <div class="row">
          <div class="col-md-2">
             <div class="doc-img">
               <img src="<?php echo isset($img_path) && $img_path ? base_url($img_path) : (isset($doctor->native->gender) ? ($doctor->native->gender == '1' ? base_url('assets/images/avatars/female_doctor.jpg') : ($doctor->native->gender == '2' ? base_url('assets/images/avatars/male_doctor.jpg') : base_url('assets/images/avatars/doctors.png')) ) : base_url('assets/images/avatars/doctors.png')); ?>" alt="<?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?>" width="100%" alt=""></div>
             <div class="video-call">
             <button class="btn btn-full btn-primary"><span class="fa fa-video-camera"></span> Arzt</button>
          </div>
          </div>
        <div class="col-md-5 doc-my">
           <div class="doc-cal-block" id="doc-cal-<?php echo $doctor->id;?>">
              <!--<img src="<?php echo base_url('assets/img/cal-img.jpg');?>" width="100%" alt="">-->
           </div>
       </div>
          <div class="col-md-5">
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

<script>
    
         (function($){ 
              $.fn.getmap = function(logitude,latitude,address,mapid){
                     var latitude = parseFloat(latitude); // Latitude get from above variable
           var longitude = parseFloat(logitude); // Longitude from same
           var latlngPos = new google.maps.LatLng(latitude, longitude);
           //Set up options for the Google map
           var myOptions = {
           zoom: 10,
           center: latlngPos,
           mapTypeId: google.maps.MapTypeId.ROADMAP,
           zoomControlOptions: true,
           zoomControlOptions: {
           style: google.maps.ZoomControlStyle.LARGE
           }
        };
     // Define the map
         map = new google.maps.Map(document.getElementById(mapid), myOptions);
       // Add the marker
        var marker = new google.maps.Marker({
        position: latlngPos,
        map: map,
        title: address
        });
          var contentString = address;
        var infowindow = new google.maps.InfoWindow({
      content: contentString
         });
     google.maps.event.addListener(marker,'click', function() {
     infowindow.open(map,marker);
  });
      };
              
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