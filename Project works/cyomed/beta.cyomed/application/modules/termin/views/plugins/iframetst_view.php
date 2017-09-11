


<div class="doc-lists well">

    <?php if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
      <?php $this->load->view('plugins/entry_record_view', array('doctor' => $doctor, )); ?>
      <?php endforeach; endif; ?>
  </div>


<style>
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
  background-image:url(<?php echo base_url("assets/img/left-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-next:hover{
  background-image:url(<?php echo base_url("assets/img/left-white.gif"); ?>);
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev{
  background-image:url(<?php echo base_url("assets/img/right-black.gif"); ?>);
  background-position:50%;
  background-repeat:no-repeat;
}
.owl-calendar .owl-controls .owl-buttons div.owl-prev:hover{
  background-image:url(<?php echo base_url("assets/img/right-white.gif"); ?>);
}
</style>