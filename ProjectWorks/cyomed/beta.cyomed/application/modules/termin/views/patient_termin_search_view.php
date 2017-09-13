<div class="box-shadow">
	<div class="">
		<div class="con-maping">
			<section class="content-area">
				<div class="block block-doc-info">
					<div class="head btn-primary">
						<a href="<?php echo site_url('akte/overview/timeline');?>" class="ajax-home-link pull-right"><img src="<?php echo base_url('assets/img/back.png');?>"></a>
						<h2>Arzt</h2>
					</div>

					<div class="block-body" style="padding-top:28px; padding-bottom:28px;">
						Welcome to the online appointment module.Here you can find and chose a specialist near to you and make a quick appointment.
						The available appointments are shown in the calendar next to the doctor information.
						<form action="<?php echo base_url('index.php/termin/search');?>" method="post" name="search_termin" id="search_termin" onsubmit="return false;" role="form" class="col-sm-12">
							<div class="form form-horizontal">
								<div class="form-group">
									<div class="col-md-3" style="padding:0 5px;">
										<select id="medical-speciality" name="specialty" class="form-control">
											<option value="">Bitte wahlen</option>
											<?php foreach($speciality as $row) : ?>
												<option <?php echo ($specialty==$row->code)?'selected':''; ?> value="<?php echo $row->code; ?>"><?php echo $row->name; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-md-3" style="padding:0 5px;">
										<input id="filter-location" type="text" class="form-control" name="location" placeholder="ort" value="<?php echo (isset($location)&& $location!='')?$location:''; ?>">
									</div>
									<div class="col-md-3" style="padding:0 5px;">
										<select id="input-distance-select" name="distance" class="form-control">
											<?php for ($i = 0; $i < 10; $i++) : ?>
												<option <?php echo ($distance==$i)?'selected':''; ?> value="<?php echo $i; ?>"><?php echo ($i + 1) * 5 ?>km</option>
											<?php endfor; ?>
										</select>
									</div>

									<div class="col-md-3" style="padding:0 5px;">
										<select name="insurance-type" id="insurance-type" class="form-control">
											<option value="public" <?php echo isset($insurance) && $insurance == 'public'?'selected':''; ?>>gesetzlich</option>
											<option value="private" <?php echo isset($insurance) && $insurance == 'private'?'selected':''; ?>>private</option>
										</select>
									</div>

									<div class="col-md-12" style="padding:0 5px;margin-top:10px" align="center">
										<button class="btn btn-primary font-bold uprCase" onclick="serachTerminDoctor();">TERMIN FINDEN <i class="fa fa-spinner fa-pulse" id="termin_doc_termin_search_div" style="display:none;"></i></button>
									</div>
								</div>
							</div>    
						</form>
                        <div class="doc-lists">
                        	<?php 
                        	if(isset($doctors) && is_array($doctors) && count($doctors) > 0) :
                        		foreach ($doctors as $doctor) : 
                        			$this->load->view('search/entry_record_view', array('doctor' => $doctor,));                     			
                        		endforeach; 
                        		elseif((isset($location)&& $location!='') || (isset($specialty)&& $specialty!='') || (isset($distance)&& $distance!='')):
                        			echo "<center><span id='loading_doctor_search_div'><b>There is not any doctor with search criteria</b></span></center>"; 
                        		else: 
                        			echo "<center><span id='loading_doctor_search_div'><b>You can search doctor using their speciality, location and distance from you.</b></span></center>"; 
                        		endif; 
                        	?>
                        </div>                            
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

        <div  class="hide">
        	<h2>Google maps</h2>
        	<!--<div id="search-map" style="width:100%;height:380px;"></div>
        	<!-- google maps load end here-->
        	<form id="filters" action = "<?php echo base_url('index.php/termin/search');?>" method="post" class="well" role="form">
        		<h2>Suche Hier</h2> 
        		<div class="form form-horizontal">
        			<div class="row">
        				<div class="col-md-3">
        					<label class="" for="filter-location">ORT</label>
        					<div><input id="filter-location" type="text" class="form-control" name="location" placeholder="ort"></div>
        				</div>
        				<div class="col-md-3">
        					<label class="" for="filter-distance">Max. Entfernung vom Suchort</label>
        					<div>
        						<select id="input-distance-select" name="distance" class="form-control">
        							<?php for ($i = 0; $i < 10; $i++) : ?>
        								<option value="<?php echo $i; ?>"><?php echo ($i + 1) * 5 ?>km</option>
        							<?php endfor; ?>
        						</select>
        					</div>
        				</div>
        				<div class="col-md-3">
        					<label class="" for="filter-specialty">Fachrichtung</label>
        					<div>
        						<select id="medical-speciality" name="specialty" class="form-control">
        							<option value="">Bitte wählen</option>
        							<?php foreach($speciality as $row) : ?>
        								<option value="<?php echo $row->code; ?>"><?php echo $row->name; ?>
        								</option>
        							<?php endforeach; ?>
        						</select>
        					</div>
        				</div>
        				<div class="col-md-3">
        					<label class="" for="filter-specialty">&nbsp;</label>
        					<div>
        						<button type="submit" class="btn btn-primary"><span class="icomoon  i-search-5"></span> Suche</button>
        					</div>
        				</div>
        			</div>
        		</div>    
        	</form>
        	<br>
        	<div class="alert alert-info">
        		<a href="#" class="close" data-dismiss="alert">×</a>
        		<strong>Notiz:</strong> drei-Eintrag bestimmten Ärzten für Sie zu suchen, klicken Sie auf Karten, um es in der Karte sehen.
        	</div>

        	<div class="headline">
        		<h1 data-item-prop="headline">
        			<span class="docs-count" data-item-prop="headline"></span> 
        			<span class="specialty" data-item-prop="keywords" role="button"></span>
        			in 
        			<span class="location" data-item-prop="keywords"></span>
        			haben Termine für Sie.
        		</h1>
        		<div class="pagination">
        			<?php echo isset($pagination) ? $pagination : ''; ?>
        		</div>
        	</div>

        	<div id="search-location" data-lat="52.519171" data-lng="13.4060912" data-name="Suchstandort"></div>

        	<div id="providers" data-date-start="2014-06-26" data-date-end="2014-07-15" data-date-days="14" data-date-calendar-days="20">
        		<div id="providers-wrapper">        
        			<?php if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
        				<?php $this->load->view('search/entry_view', array('doctor' => $doctor, )); ?>
        			<?php endforeach; endif; ?>
        		</div>
        	</div>

        	<div class="pagination justified-blocks">
        		<?php echo isset($pagination) ? $pagination : ''; ?>  
        	</div>
        </div>


<script id="essenScript">
    var postData = <?php echo json_encode($post_data); ?>;

  	//var doctors = <?php echo json_encode($doctors); ?>;
</script> 

<script>
	$('.ajax-home-link').click(function(e) 
	{
		e.preventDefault();
		if ($(this).attr('href').indexOf('javascript:') < 0)
			$.loadUrl($(this).attr('href'), $('#content'));
	});
    $(function(){
        var place_input = document.getElementById("filter-location");
        var options = {
            types: ['(cities)'],
        };
        if(place_input !== undefined){
            var autocomplete = new google.maps.places.Autocomplete(place_input,options);
        }
    });
    
</script>
<style>
	.fc-basic-view td.fc-week-number span, .fc-basic-view td.fc-day-number{padding: 5px 4px 4px;}
	.doc-cal-block td.fc-today {
/*    background: #093a80!important;
    border-radius: 50%;
    height: auto;
    line-height: auto;
    color: #fff!important;
    padding:4px;
    width: 26px !important;*/

    background: #093a80 none repeat scroll 0 0;
    border-radius: 50%;
    color: #fff !important; 
}
.doc-appointment {
	background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
	border-radius: 50%;
}
.commanblock-text h1{    font-size: 14px;
	padding:5px 0;
	font-family: 'Avenir Next LT Pro Demi', Arial, Helvetica, sans-serif;
	text-transform: uppercase;}
	.commancol{ padding-bottom: 15px;}
	.commanblock{ border:1px solid #d1d1d1!important;padding: 0 0 15px;}
	.commanblock-img{  padding: 15px 0 0px; border-bottom: 1px solid #d1d1d1; margin-bottom: 10px;}
	.doc-appointmentForText {
		color:#ffffff !important;
	}


	.fc-highlight{ background:none}
	.fc-content-skeleton .fc-past.fc-day-number{
		opacity: .3;
	}

    .doc-cal-block .fc-toolbar h2{
        font-size: 12px;
    }

    .doc-cal-block .fc-button{
        font-size: 0.5em;
    }
    
	.doc-my .fc-view td {
		//width:27px;
		//min-width: 14.28%;
	}
</style>
<!--<style>
    .doc-cal-block td.fc-today {
        line-height: 25px;
        height: 25px;
        width: 27px;
        border-radius:50%;
        background: #093a80 none repeat scroll 0 0;
        color: #fff !important;
    }
    .doc-cal-block td.fc-Newtoday {
        line-height: 25px;
        height: 25px;
        width: 27px;
        border-radius:50%;
        background: #093a80 none repeat scroll 0 0;
        color: #fff !important;
    }
    .fc-highlight-skeleton td {
        height: 25px;
    }
    .doc-my .fc td {
        line-height: 25px;
    }
    .fc-highlight {
    background:none!important;
    height: 30px;
    opacity: 0.3;
    width: 30px;
    border-radius:50%;
    line-height: 25px;
}
.fc-highlight-skeleton{ position:static!important}

.fc-current {
    background: #093a80!important;
    border-radius: 50%;
    height: 25px;
    line-height: 25px; color: #fff!important;
    
    width: 27px;
}
.fc-highlight{ }

</style>-->
<!-- <style>
    .doc-cal-block td.fc-today{
        background: #0000FF;
        color:#ffffff!important;
       color: rgb(256, 256, 256)!important;
    }

    .fc-day-number
    {
        cursor:pointer;
    }    
    .fc th
    {font-family:arial;
     text-transform: lowercase;        
    }
    .fc-day-number:focus
    {
        background:black;
    }
    .fc-basic-view td.fc-week-number span, .fc-basic-view td.fc-day-number
    {
        padding: 3px;        
    }
    .fc-highlight
    {
    background: #87d1d7 none repeat scroll 0 0;
    border: 1px solid #333 !important;
    border-radius: 50%;
    height: 20px;
    padding: 3px !important;
    width: 20px;
    }
    .fc-highlight-skeleton{ position: static!important}
    #reservationtime_box .appointment
    {
        margin-top:0px;
        padding:0px;
        color: #7ec6d2;
    }
    .appointment:hover
    {
        color:#37C7F9 !important;
        text-decoration:none;
    }
    #reservationtime_box
    {
        margin-top:10px;
    }
    .appointment
    {
        background:none;
    }
    

    
/*
.owl-calendar{
	padding:0 15px;
}
.owl-calendar-list li{
	min-width:60px;
}
.owl-calendar .col-header,
.owl-calendar .appointment-link,
.owl-calendar .appointment.more{
	background:#7ac5d2;
	padding:5px 7px;	
	font-size:10px;
	text-align:center;
	color:#FFF;
	margin:0 1px 1px;
        display: block;
}
.owl-calendar .appointment-link,
.owl-calendar .appointment.more{
	background:#EEE;
	color:#333;
	font-size:12px;
}
.owl-calendar .appointment.more > .appointments{
	display:none;
	position:absolute;
}
.owl-calendar-list .appointment.more:hover > .appointments{
	display:block;
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev,
.owl-calendar .owl-controls .owl-buttons div.owl-next{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 14px;
  height: 100%;
  border-radius: 0px;
  margin: 0px;
  padding: 0px;
  text-indent:-9999px;
}
.owl-calendar .owl-controls .owl-buttons div.owl-next{
  left: auto;
  right: 0px;
  background-image:url(<?php // echo base_url("assets/img/left-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-next:hover{
  background-image:url(<?php // echo base_url("assets/img/left-white.gif"); ?>);
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev{
  background-image:url(<?php // echo base_url("assets/img/right-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev:hover{
  background-image:url(<?php // echo base_url("assets/img/right-white.gif"); ?>);*/
/*}*/
</style>-->
