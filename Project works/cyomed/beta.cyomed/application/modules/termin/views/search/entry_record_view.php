<?php
$doctor = isset($doctor) && $doctor ? $doctor : (new stdClass());
$this->load->model('document/mdoc');
$img_path = $this->mdoc->get_doctor_img_path($doctor->id);
$add = urlencode($doctor->address);
$city = urlencode($doctor->city);
$zip = $doctor->zip;
$geocode=@file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add.',+'.$city.',+'.$zip.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;
if(empty($doctor->native->coordinate_lng))
{
	$doctor->native->coordinate_lng=$longitude;
}
if(empty($doctor->native->coordinate_lat))
{
	$doctor->native->coordinate_lat=$latitude;   
}
$address = '';
if(isset($doctor->distance) && $doctor->distance > 0 )
{
	$address .= $doctor->distance. "Km , ";
}if(isset($doctor->address) && strlen($doctor->address) > 0 )
{
	$address .= $doctor->address. ' , ';
}if(isset($doctor->zip) && strlen($doctor->zip) > 0 )
{
	$address .= $doctor->zip.' , ';
}if(isset($doctor->city) && strlen($doctor->city) > 0 )
{
	$address .= $doctor->city.' ';
}
?>
<div class="doc-block" onload="">
	<h2 class="title">
		<?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?>
	</h2>
	<?php 
	$doctor_speciality="";
	foreach($speciality as $spec){
		if(in_array($spec->code,$doctor->specialization1)){
			$doctor_speciality.= $spec->name.', ';
		}

	}
	if($doctor_speciality!=""){
		$doctor_speciality=rtrim($doctor_speciality,', ');
		echo "<b><i>".$doctor_speciality."</i></b>";
	}
	?>
	<div class="doc-address">  
		<?php echo $address;  ?>
		&nbsp;&nbsp;
		<span>
			<button class="btn btn-primary btn-xs gmap-relocate" id="gmap-relocate<?php echo $doctor->id;?>"  aria-expanded="false" aria-controls="collapseExample<?php echo $doctor->id;?>">&nbsp;&nbsp;&nbsp; 
				<span class="icomoon i-location-4"></span> &nbsp;&nbsp;&nbsp;
			</button>

		</span>
		<span>
			<button class="btn btn-primary btn-xs"  data-toggle="collapse" aria-expanded="false" data-target="#practise<?php echo $doctor->regid; ?>"  >
				&nbsp;&nbsp;&nbsp; 
				<span class="fa fa-arrows"></span>
				&nbsp;&nbsp;&nbsp;
			</button>
		</span>
	</div>

	<div class="row">
		<div class=" col-md-12 map-tog " >
			<div id="map<?php echo $doctor->id;?>" style="width:100%;height:300px;margin-top:10px;display:none;" ></div> 
		</div>
	</div>

	<div class="row collapse commanblock" style="width:100%;height:300px;margin-top:10px;"  id="practise<?php echo $doctor->regid; ?>" >
		<?php // echo $this->mdoc->get_doc_associate_image($doctor->regid,$doctor->doctorassoc1); ?>
		<div class="commanblock-img" >
			<?php if($doctorassoc1=$this->mdoc->get_doc_associate_image($doctor->regid,$doctor->doctorassoc1)){ ?>
			<div class="col-md-4" >
				<div class="commancol"><img class="profile-pic img-responsive" src="<?php echo base_url($doctorassoc1) ?>" alt="Profile Avatar" />

				</div> 
			</div>	
			<?php }
			if($doctorassoc2=$this->mdoc->get_doc_associate_image($doctor->regid,$doctor->doctorassoc2)){ ?>

			<div class="col-md-4" >
				<div class="commancol"><img class="profile-pic img-responsive" src="<?php echo base_url($doctorassoc2) ?>" alt="Profile Avatar" />
				</div> 
			</div>   
			<?php }
			if($doctorassoc3=$this->mdoc->get_doc_associate_image($doctor->regid,$doctor->doctorassoc3)){ ?>
				<div class="col-md-4" >
					<div class="commancol"> <img class="profile-pic img-responsive" src="<?php echo base_url($doctorassoc3) ?>" alt="Profile Avatar" />
					</div>
				</div>
			<?php }?>
				
			<div class="clear"></div>
		</div>

		<div class="commanblock-text" >
			<?php if($doctor->doctorassoctext1){ ?>
				<div class="col-md-4" >
					<h1>Wir bieten:</h1>
					<?php echo $doctor->doctorassoctext1 ;?>
				</div>
			<?php }
			if($doctor->doctorassoctext2) {?>
				<div class="col-md-4" >
					<h1>Aktuell:</h1>
					<?php echo $doctor->doctorassoctext2 ;?>
				</div>    
			<?php }
			if($doctor->doctorassoctext3) {?>
				<div class="col-md-4" >
					<h1>Practices:</h1>
					<?php echo $doctor->doctorassoctext3 ;?>
				</div>
			<?php }?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2">
			<div class="doc-img">
				<img src="<?php echo isset($img_path) && $img_path && file_exists($img_path) ? base_url($img_path) : (isset($doctor->native->gender) ? ($doctor->native->gender == '1' ? base_url('assets/images/avatars/female_doctor.jpg') : ($doctor->native->gender == '2' ? base_url('assets/images/avatars/male_doctor.jpg') : base_url('assets/images/avatars/doctors.png')) ) : base_url('assets/images/avatars/doctors.png')); ?>" alt="<?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?>" width="100%" alt="">
			</div>
	             <!--<div class="video-call">
	             <button class="btn btn-full btn-primary"><span class="fa fa-video-camera"></span> Arzt</button>
	         </div>-->
	    </div>

	    <div class="col-md-5 ">
	     	<div class="doc-cal-block" id="doc-cal-<?php echo $doctor->id;?>">
	     	<!-- Here comes the callendar -->
	     	</div>
	    </div>
	    <div class="col-md-5">
	     	<div id="reservationtime_box_<?php echo $doctor->id;?>" align="center">
	     		<!--Here comes the availabalie appointments time-->
	     		<?php ?>
	     	</div>
	     </div>
	 </div>
	 <a class="btn btn-primary pull-right inlined" id="fulltermin-view-load<?php echo $doctor->id;?>" href="javascript:void(0)<?php // echo site_url('/termin/profile/doctor/'.(isset($doctor->id) ? 'member' : 'google').'/'.(isset($doctor->id) ? $doctor->id : '')); ?>" class="ajax-condition-link82">Details&nbsp;</a>
	 <div id="reservation_doc_<?php echo $doctor->id;?>"></div>
	</div>
	<hr/>
    <?php
    // $doc_appointment =array();
    // foreach($doctor->doc_appointment as $all){
    // 	$doc_appointment[] = date('Y-m-d',strtotime($all));
    // }
    ?>
    

    <script>

    	$('#fulltermin-view-load<?php echo $doctor->id;?>').click(function(e) 
    	{
    		e.preventDefault();
    		if ($(this).attr('href').indexOf('javascript:') < 0)
    			$.loadUrl($(this).attr('href'), $('#content'));
    	});

    	$('#doctor-profile<?php echo $doctor->id;?>').click(function(e) 
    	{
    		e.preventDefault();
    		if ($(this).attr('href').indexOf('javascript:') < 0)
    			$.loadUrl($(this).attr('href'), $('#content'));
    	});

    	(function($){ 
    		$.fn.getmap = function(longitude,latitude,address,mapid){
                latitude = parseFloat(latitude); // Latitude get from above variable
           		longitude = parseFloat(logitude); // Longitude from same
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

   var doc_appointment =  [<?php echo '"'.implode('","', $doc_appointment).'"' ?>];
   var calender_id='#doc-cal-'+'<?php echo $doctor->id;?>';
   var mindate = new Date('<?php echo date('Y/m/d');?>');
   $(calender_id).fullCalendar({
   	header: {
          left: 'title',
          center: 'today',
          right: 'prev,next',
        },        
   	axisFormat: 'HH:mm',
   	timeFormat: {
                    agenda: 'H(:mm)' //h:mm{ - h:mm}'
                },
                defaultDate: '<?php echo date('Y-m-d');?>',			                                       
                selectable:true,
                editable: false,
                eventLimit: true ,
                weekends: false,

                dayClick: function(date, jsEvent, view,resourceObj) {
                	
                	var myDate = new Date();
                	var renderDate=new Date(date);
                	var myDate = new Date(myDate.toDateString());
                	var renderDate=new Date(renderDate.toDateString());

                	if (renderDate.valueOf()>=myDate.valueOf()  && !($(this).hasClass("fc-other-month"))) {

                		var startDate = date.toString(); 
                		$.ajax({  
                			url:$.siteUrl+'/termin/portal/reservation/ajaxterminappointments',
                			type:'POST',
                			data: {
                				start: startDate, 
                				did: <?php echo $doctor->id;?>,
                				specification:<?php echo $_REQUEST['specialty']; ?>,
                				patient_id:<?php echo $this->m->user_id();?>,
                				user_role:'<?php echo $this->m->user_role();?>',
                				insurance: $("#insurance-type option:selected").val(),
                			},
                			success: function(result) {
                				$("#reservationtime_box_<?php echo $doctor->id;?>").html(result);                       
                			}
                		});

                		var cdate = new Date(date);
                		var c_date = cdate.getDate();
                		if(c_date < 10){
                			var c_date = '0'+c_date;
                		}
                		var c_month = cdate.getMonth()+1;
                		if(c_month < 10){
                			var c_month = '0'+c_month;
                		}
                		var c_year = cdate.getFullYear();
                		var full_date = c_year+'-'+c_month+'-'+c_date;
                		var today = new Date();
                		var todat_date = '0'+today.getDate();



                // 		if((jQuery.inArray(full_date, doc_appointment) != -1)  ){ 

                //     //$(calender_id).find('.fc-day[data-date="' + full_date + '"]').css('background-color',"#093a80 !important");
                //     $(calender_id).find(".fc-state-highlight").removeClass("fc-state-highlight");
                //     $(calender_id).find(".fc-today").removeClass("fc-today");
                    
                //     jQuery.each(doc_appointment, function( i, val ) {
                //     	$(calender_id).find('.fc-day-number[data-date="' + val + '"]').addClass("fc-state-highlight"); 
                //     	$(calender_id).find('.fc-day-number[data-date="' + val + '"]').addClass("fc-today"); 
                //     	$(calender_id).find('.fc-day-number[data-date="' + val + '"]').css('background-color',"rgba(0, 0, 0, 0.4)");
                //     });

                //     $(jsEvent.target).addClass("fc-today").css('background-color',"#093a80 !important");

                // }else{

                	$(calender_id).find(".fc-state-highlight").removeClass("fc-state-highlight");
                	$(calender_id).find(".fc-today").removeClass("fc-today");
                	$(jsEvent.target).addClass("fc-state-highlight"); 
                	$(jsEvent.target).addClass("fc-today"); 

                // 	jQuery.each(doc_appointment, function( i, val ) {

                //          //$('#doc-cal-1 .fc-day-number[data-date="' + full_date + '"]').addClass('fc-today').css({"background-color":"rgba(0, 0, 0, 0.4)"});
                //          $(calender_id).find('.fc-day-number[data-date="' + val + '"]').addClass("fc-state-highlight"); 
                //          $(calender_id).find('.fc-day-number[data-date="' + val + '"]').addClass("fc-today"); 
                //          $(calender_id).find('.fc-day-number[data-date="' + val + '"]').css('background-color',"rgba(0, 0, 0, 0.4)");
                //      });



                // }

            }            
            else{
            	return false;
            }
        },
        dayRender: function(date, cell)
        {
        	var cdate = new Date(date);
        	var c_date = cdate.getDate();
        	if(c_date < 10){
        		var c_date = '0'+c_date;
        	}
        	var c_month = cdate.getMonth()+1;
        	if(c_month < 10){
        		var c_month = '0'+c_month;
        	}
        	var c_year = cdate.getFullYear();
        	var full_date = c_year+'-'+c_month+'-'+c_date;
        	var today = new Date();
        	var todat_date = '0'+today.getDate();
        	if ((c_date == todat_date) && (jQuery.inArray(full_date, doc_appointment) != -1) ) {
                //cell.css("padding", "0");
                //$(calender_id).find('.fc-today[data-date="' + full_date + '"]').removeClass('fc-today');
                //$(calender_id).find('.fc-day[data-date="' + full_date + '"]').css('background-color',"#093a80 !important");
                //$(calender_id).find(".fc-today").removeClass("fc-today");
            }

            if((jQuery.inArray(full_date, doc_appointment) != -1) && c_month && (c_date != todat_date) ){
            	$('#doc-cal-1 .fc-day-number[data-date="' + full_date + '"]').addClass('fc-today').css({"background-color":"rgba(0, 0, 0, 0.4) !important"});
            }

        }
//        viewRender: function(currentView){
//
////		var minDate = moment(),
////		maxDate = moment().add(2,'weeks');
////                alert(minDate);
////                alert(maxDate);
//		// Past
////		if (minDate >= currentView.start && minDate <= currentView.end) {
////			$(".fc-prev-button").prop('disabled', true); 
////			$(".fc-prev-button").addClass('fc-state-disabled'); 
////		}
////		else {
////			$(".fc-prev-button").removeClass('fc-state-disabled'); 
////			$(".fc-prev-button").prop('disabled', false); 
////		}
////		// Future
////		if (maxDate >= currentView.start && maxDate <= currentView.end) {
////			$(".fc-next-button").prop('disabled', true); 
////			$(".fc-next-button").addClass('fc-state-disabled'); 
////		} else {
////			$(".fc-next-button").removeClass('fc-state-disabled'); 
////			$(".fc-next-button").prop('disabled', false); 
////		}
//	}
});
          // Define the latitude and longitude positions
          $('#gmap-relocate<?php echo $doctor->id;?>').click(function(e)
          {
          	$("#map<?php echo $doctor->id;?>").toggle();  
          	$("#map<?php echo $doctor->id;?>").getmap('<?php echo $doctor->native->coordinate_lng; ?>','<?php echo $doctor->native->coordinate_lat; ?>','<?php echo $address;?>','map<?php echo $doctor->id;?>');
          });
      })(jQuery);

      function todayappointments(todaytime,id)
      {
      	$.ajax({
      		url:$.siteUrl+'/termin/portal/reservation/ajaxterminappointments',
      		type:'POST',
      		data: {
      			start: todaytime ,
      			did: <?php echo $doctor->id;?>,  
            specification: $('#medical-speciality option:selected').val(),
            patient_id:<?php echo $this->m->user_id();?>,
            user_role:'<?php echo $this->m->user_role();?>',
            insurance: $("#insurance-type option:selected").val(),               
      		}, 
      		success: function(result) {
      			$("#reservationtime_box_"+id).html(result);                      
      		}
      	});
      }
      function bookappointment(did,terminid,sdate,edate,specification,patient_id,user_role)
      {
      	var postData = {
              terminid: terminid,
              start: sdate,
              endDate:edate,
              specification:specification,
              patient_id:patient_id,
              user_role:user_role
          };
          var url = $.siteUrl + '/termin/portal/reservation/logout_patient/' + did + '/?' + $.param(postData);
          var docpos = $('.block-body'); 
          $.loadUrl(url,docpos);
            // $('html,body').animate({scrollTop: docpos.offset().top},'slow');
        }
        todayappointments('<?php echo date('Y-m-d');?>',<?php echo $doctor->id;?>);

      //method for waiting list
      function gotowaitinglist(doc_id,waitDate)
      {
        $.ajax({
          url:$.siteUrl+'/akte/reservation/waiting_list_insert',
          type:'POST',
          data: {
            doc_id: doc_id,
            waitDate: waitDate,
            patient_id:<?php echo $this->m->user_id();?>           
          }, 
          });

        document.getElementById("wlist").innerHTML = "You are now in waiting list";
        document.getElementById("wlist").style.color = "red";

       }



    </script>
