<?php 
  $this->load->language('global/general_text', $this->m->user_value('language')); 
  $this->load->language('global/overview',$this->m->user_value('language'));
?>

<!--<aside class="col-md-2 col-sm-3 sidebar sidebar0" >
    <div class="block block-user">
      <div class="profile-avatar">
      <img src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>" class="profile-avatar-img thumbnail" alt="Profile Image">
      </div>
      <button class="btn btn-link"><a href="<?php echo site_url('akte/profile'); ?>" class="ajax-load-link"><span class="fa fa-pencil"></span></a></button>
      <h2><?php echo strtoupper($this->m->user_value('academic_grade')); ?> <?php echo strtoupper($this->m->user_value('name')); ?> <?php echo strtoupper($this->m->user_value('surname')); ?></h2>
</div>            
</aside>-->
 <section class="col-md-9 col-sm-12 content-area">
 <div class="block block-panel1">
  <h2 class="head font-bold">
    <?php echo $this->lang->line('cyomed_patient_recent');?>
  </h2>
  <form class="form" action="<?php echo site_url('doctors/my_patients/select'); ?>" method="post">
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
 <ul class="zuletzt-list">
 <?php $i = 1; if (!empty($patients) && is_array($patients) && count($patients) > 0) : foreach ($patients as $row ) : ?>
      <li>
         
          <a class="ajax-patient-links" regid="<?php echo $row->regid; ?>" hrefhome="<?php echo site_url('akte/overview/timeline'); ?>" href="<?php echo site_url('akte/myprofile/'); ?>" >
         
          <div class="row">
          
           <div class="col-md-1 img-block">
            <img src="<?php $this->load->model('document/mdoc');
             echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/> 
               <!--<img src="images/img.jpg" alt="" width="100%">-->
           </div>
           <div class="col-md-5">
               <div class="font16 font-bold"><?php echo $row->name; ?>&nbsp;<?php echo $row->surname; ?></div>
               <div class="font13"><?php 
               echo $this->m->get_Age_difference($row->dob,date("Y-m-d"));?></div>
           </div>
           <div class="col-md-5"></div>
           <div class="col-md-1"><span class="fa fa-chevron-right"></span></div>
        </div>
           </a>
     </li>
 <?php $i++; endforeach;
  else:
      echo "<li>No record found..</li>";
  endif; ?>
 </ul>
 </form>
</div>
 <!-- this div is used for patient details-->
 <div class="patientprofile">                 	
</div>
</section>
<aside class="col-md-3 col-sm-12 sidebar sidebar1">
    <div class="block block-btns">
             
             <div class="mybtns-head">
          <div class="row">  <div class="col-md-6 paddhead"><a href="<?php echo site_url('akte/chat'); ?>" target="_blank" ><button class="btn btn-primary" >
             <span class="myhead-img"><img src="<?php echo base_url('assets/img/icon/video-chat-icon.png');?>" alt=""></span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_chat_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"><a class="ajax-econsult-link" data-dismiss="modal" href="<?php echo site_url('akte/econsult'); ?>" > <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php echo base_url('assets/img/icon/eConsultant.png');?>" alt="">
             </span><span class="myhead-tital"><?php echo $this->lang->line('overview_lang_blood_econsult_title'); ?></span></button></a></div>
          </div> 
          <div class="row"> 
             <div class="col-md-6 paddhead"> <a class="ajax-calender-link" href="<?php echo site_url('termin/calendar'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/cal-icon.png');?>" alt="">
           </span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_termine_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"><a href=""> <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php echo base_url('assets/img/icon/videoapp.png');?>" alt="">
            </span><span class="myhead-tital">
               <?php echo $this->lang->line('overview_lang_get_video');?>
          </span></button></a></div>
             </div>
             </div>
             <div class="row"> 
             <div class="col-md-6 paddhead"> <a  href="<?php echo site_url('rezept'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/epre.png');?>" alt="">
           </span>
             <span class="myhead-tital">
                <?php echo $this->lang->line('overview_lang_rezeptonline_title');?>
            </span></button></a></div>
             <div class="col-md-6 paddhead1"><a href=""> <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php echo base_url('assets/img/icon/esicknes.png');?>" alt="">
            </span><span class="myhead-tital">
                <?php echo $this->lang->line('overview_lang_e_sick_cert');?>
          </span></button></a></div>
             </div>
             </div>
        <div class="">
                            <div class="block block-s1 hide">
                                <h2>ARZTKONTAKT</h2>
                                <p>Sie brauchen medizinischen Rat oder Hilfe? Sprechen Sie jetzt mit einem unserer Ã„rzte oder vereinbaren Sie einen Termin!</p>
                                <div class="text-center"><button class="btn btn-default"><span class="fa-comment1"><img src="<?php echo base_url('assets/img/logo/comment-icon.png');?>" alt=""></span> JETZT KONTAKT<br>AUFNEHMEN</button></div>
                            </div>
                           
          </div>   
 <?php if ($this->m->us_id()) : ?>
          <div class="block block-aktuell">
            <!--<h5 class="content-title"><u>Gewählt Patient</u></h5>-->
            <div class="block-foot">
                <?php echo $this->lang->line('overview_doctor_selected_pat');?>
            </div>
            <div class="list-group">  

              <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right"><img class="img-responsive" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" /></h3>
                <h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
                <p class="list-group-item-text"><?php echo $this->m->us_value('academic_grade'); ?> <?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
              </a>

            </div> <!-- /.list-group -->
          </div>
          <?php endif; ?>
         <div class="block block-link hide"><a href="<?php echo site_url('rezept'); ?>" class="btn btn-primary ajax-load-link">REZEPTE</a><span class="fa fa-angle-right"></span> </div>
          <div class="block block-aktuell">
          <div class="block-foot"> Arzttermine &amp; Medikamente</div>
          <!--<h5 class="content-title"><u>Arzttermine &amp; Medikamente</u></h5>-->
         <div class="well" style="padding:10px 15px">
            <div class="">
                    <div class="pull-right"><span class="btn fa fa-calendar-o gray"></span></div>
                    <div class="pull-left font-bold gray">KALENDER ANZEIGEN</div>
                    <div class="clear"></div>
                    <div class="sidebar-calendar-block">
                        <div id="sidebar-calendar"></div>
                    </div>
                    <div class="clr"></div>
                </div>
            <!-- fullcalendar starts-->
            <a class="btn btn-primary m-t-10" href="https://ihrarzt24.de/apps/ia24at">Termine</a>
            <!-- fullcalendar ends-->
          </div>
          </div>
         <div class="">
                            <div class="block block-chart">
                                <ul class="chart-list font12">
                                     <?php
                        $this->load->model('graph/mgraph');
                        $graph_category = $this->mgraph->get_all();
                        if(!empty($graph_category->heart_frequency) && isset($graph_category->heart_frequency) && is_array($graph_category->heart_frequency)){ ?>
                        <li>
                            <div class="head">
                                <div class="pull-left title">PULS</div>
                                <div class="pull-left clear"  >
                                    <h2 style="color:#84c4c6;" id="puls">
                                     <?php
                                    echo $graph_category->heart_frequency[0]->puls;
                                   ?>
                                   </h2>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">

                                 <?php
                        
                         $this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Puls','unit'=>'',  'entries' => $graph_category->heart_frequency, 'field' => 'puls', 'disable_borders' => TRUE,
                       ));
                       
                         ?>
                            </div>
                        </li>
                        <?php }
                          if(!empty($graph_category->blood_sugar) && isset($graph_category->blood_sugar) && is_array($graph_category->blood_sugar)){
                              
                         ?>
                        <li>
                            <div class="head">
                                <div class="pull-left title">BLUTZUCKER</div>
                                <div class="pull-left clear"  >
                                    <h2 style="color:#9fd1dc;" id="bloodsugar">
                                    <?php
                                   
                                   echo $graph_category->blood_sugar[0]->bloodsugar;
                                   ?>
                                </h2>
                                  </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">
                                 <?php
                         $this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Blutzucker', 'unit'=>'mg/dl', 'entries' => $graph_category->blood_sugar, 'field' => 'bloodsugar', 'disable_borders' => TRUE,
                      ));
                        
                                ?>
                            </div>
                        </li>
                        <?php }
                        if(!empty($graph_category->weight_bmi) && isset($graph_category->weight_bmi) && is_array($graph_category->weight_bmi)){
                        ?>
                        
                        <li>
                            <div class="head">
                                <div class="pull-left title">GEWICHT &amp; BMI</div>
                                <div class="pull-left clear"  id="bmis">
                                     <h2 style="color:#ff2c58;">
                              <?php 
                                  
                                   echo $graph_category->weight_bmi[0]->bmi;
                              ?>
                                </h2>
                                  
                             </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">

                                <?php
                       
                        $this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Gewicht &amp; BMI', 'unit'=>'kg/m<sup>2</sup>', 'entries' => $graph_category->weight_bmi, 'field' => 'bmi', 'disable_borders' => TRUE,
                         ));
                        
                                ?>  
                            </div>
                        </li>
                        <?php } ?>
                                </ul>
                                <div class="block-foot"><span class="fa fa-plus"></span>
               <?php echo $this->lang->line('overview_lang_category_add');?>
                                </div>
                            </div>
</div>
   <div class="block block-aktuell">
          <h2 class="head font-bold"><strong>
               <?php echo $this->lang->line('overview_lang_news');?>

          </strong></h2>
          <div class="well">
           <ul class="icons-list text-md">
              <?php
              if(count($econsult->opened)>0)
              {
               $record=array_splice($econsult->opened,0,3);
               foreach($record as $key=>$value){
               ?>
               <li> <i class="icon-li fa fa-location-arrow"></i> <strong><?php echo $value->keyword;?></strong><br/> <?php echo $value->message;?> <br />
               <small>eConsult Date :<?php echo date('d.m.Y',strtotime($value->document_date));?> </small> </li>
               <?php 
               }
               } else { ?>
               <li>No messages. </li>
               <?php } ?>    
            </ul>

          </div> <!-- /.well -->
           </div>
          <div class="block block-aktuell">
      
            <div class="block-foot"> 
               <?php echo $this->lang->line('overview_lang_health_score');?>
            </div>
            <div class="text-center well">
             <?php
              $this->load->view('graph/pie_chart_view', array(
                'pie_charts' => array(
                  (object) array('value' => $this->mopat->health_score(), 'range' => 1100, 'title' => 'Health-Score', 'no_percent' => TRUE, ),
                           ),
              ));
             ?>
           </div>
          </div>
        
</aside>
                  <aside class="col-md-3 col-sm-12 sidebar sidebar1" style="display:none">
                	<div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="block block-s1">
                                <h2>ARZTKONTAKT</h2>
                                <p>Sie brauchen medizinischen Rat oder Hilfe? Sprechen Sie jetzt mit einem unserer Ã„rzte oder vereinbaren Sie einen Termin!</p>
                                <div class="text-center"><button class="btn btn-default"><span class="fa-comment1"><img src="<?php echo base_url('assets/img/logo/comment-icon.png');?>" alt=""></span> JETZT KONTAKT<br>AUFNEHMEN</button>
                              </div>
                            </div>                            
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="block block-aktuell block-news">
                                <h2 class="head font-bold">PATIENTEN HEUTE</h2>
                                <ul class="aktuell-list font12">
                                    <li>
                                    	<div class="font16 font-bold">11.00 Uhr</div>
                                        <p class="font12"><span class="font-bold">PATIENT</span>: MAX MUSTERMANN</p>
                                        <div class="blue font14 font-bold">Videochat</div>
                                        <div>NierenentzÃ¼ndung</div>
                                        <div>Endstadium</div>
                                    </li>
                                    <li>
                                    	<div class="font16 font-bold">11.00 Uhr</div>
                                        <p class="font12"><span class="font-bold">PATIENT</span>: MAX MUSTERMANN</p>
                                        <div class="blue font14 font-bold">Videochat</div>
                                        <div>NierenentzÃ¼ndung</div>
                                        <div>Endstadium</div>
                                    </li>
                                </ul>
                                <div class="block-foot"><span class="fa fa-plus"></span> TERMIN EINTRAGEN</div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="block block-aktuell block-news">
                                <h2 class="head font-bold">NEWS</h2>
                                <ul class="aktuell-list font12">
                                    <li>
                                        <div class="font12 cyan meta-date">20. APRIL, 16.00 UHR</div>
                                        <p class="title">POLLENFLUG ERNEUT STARK</p>
                                        <p>Lorem ipsum News lorem ipsum
        News lorem ipsumorem ipsum News lorem ipsum...  <a class="cyan" href="">MEHR ></a></p>
                                    </li>
                                    <li>
                                        <div class="font12 cyan meta-date">20. APRIL, 16.00 UHR</div>
                                        <p class="title">POLLENFLUG ERNEUT STARK</p>
                                        <p>Lorem ipsum News lorem ipsum
        News lorem ipsumorem ipsum News lorem ipsum...  <a class="cyan" href="">MEHR ></a></p>
                                    </li>
                                    <li>
                        <a class="cyan" href="">...</a>
                  </li>
             </ul>
       </div>
  </div>
</div>
</aside>
<script>
    $('.ajax-calender-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
     $('.ajax-patient-links').click(function(e) {
         
        if($(this).attr('regid'))
         {
           e.preventDefault();
           var URL=$(this).attr('href')+'/view/'+$(this).attr('regid');
           if ($(this).attr('href').indexOf('javascript:') < 0)
           $.loadUrl(URL, $('#content'));
           }
           else
           {
           alert("Please Enter Patient Id");
           e.preventDefault();
           var URL=$(this).attr('hrefhome');
           if ($(this).attr('hrefhome').indexOf('javascript:') < 0)
           $.loadUrl(URL, $('#content'));   
           }
  });
    </script>
       <script>
    
    $('.fa-calendar-o').on('click', function()
    {
        $(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
        
    });
    
    </script>
<script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/timelinetermin.js'); ?>"></script>
 <style>
   #sidebar-calendar{clear:both;padding:15px 0; font-size:12px;}
   #sidebar-calendar .fc-border-separate{background: transparent;box-shadow:0 0 0px;}
   #sidebar-calendar  .fc-border-separate th{background: rgba(0,0,0,0.1);}
   .sidebar-calendar-block{height: 1px;overflow:hidden;width: 100%;}
   .sidebar-calendar1{height: auto;}
   #content.container > h2.page-title{display:none;}
   #content.container > h2.page-title{display:none;}
   #content.container .main_container{padding-top:20px;}
   #content.container .main_container > .container{padding-right:30px;padding-left:0px;}
   #footer .container > p{margin:0px;}
   .block > h2.title{font-family: 'Open Sans', 'Trebuchet MS', arial, sans-serif;font-size:22px;}
   .poll-block{min-height:67px;}
</style>