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



    <div class="owl-calendar calendar scrollable large" data-doctor-id="<?php echo isset($doctor->id) ? $doctor->id : ''; ?>">

      <div class="action no-available-appointments">
        <div class="message">keine freien Termine verfügbar</div>
      </div>

      <div class="action integration_8">
        <div class="message">
          <a href="http://www.ihrarzt24.de/termin?u=8383&amp;l=7239&amp;m=&amp;tt=&amp;i=2" style="float:right;margin-right:.5rem;">Hier registrieren</a>
          <div>Möcheten Sie Ihre Termine hier sehen?</div>
        </div>
      </div>

    </div>