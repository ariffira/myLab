<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>

<aside class="col-md-2 col-sm-3 sidebar sidebar0" >
    <div class="block block-user">
      <div class="profile-avatar">
      <img src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/120x120'; ?>" class="profile-avatar-img thumbnail" alt="Profile Image">
      </div>
      <button class="btn btn-link"><a href="<?php echo site_url('akte/profile'); ?>" class="ajax-load-link"><span class="fa fa-pencil"></span></a></button>
      <h2><?php echo strtoupper($this->m->user_value('academic_grade')); ?> <?php echo strtoupper($this->m->user_value('name')); ?> <?php echo strtoupper($this->m->user_value('surname')); ?></h2>
</div>            
</aside>
 <section class="col-md-7 col-sm-9 content-area">
 <div class="block block-panel1">
  <h2 class="head font-bold">ZULETZT ANGESEHENE PATIENTEN</h2>
  <form class="form" action="<?php echo site_url('doctors/my_patients/select'); ?>" method="post">
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
 <ul class="zuletzt-list">
 <?php $i = 1; if (!empty($patients) && is_array($patients) && count($patients) > 0) : foreach ($patients as $row ) : ?>
      <li>
         
          <a class="ajax-patient-links" regid="<?php echo $row->regid; ?>" hrefhome="<?php echo site_url('akte/overview/timeline'); ?>" href="<?php echo site_url('akte/myprofile/'); ?>" >
         
          <div class="row">
          
           <div class="col-md-1 img-block">
            <img src="<?php $this->load->model('document/mdoc');
             echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/> 
               <!--<img src="images/img.jpg" alt="" width="100%">-->
           </div>
           <div class="col-md-5">
               <div class="font16 font-bold"><?php echo $row->name; ?>&nbsp;<?php echo $row->surname; ?></div>
               <div class="font13"><?php 
               echo $this->m->get_Age_difference($row->dob,date("Y-m-d"));?></div>
           </div>
           <div class="col-md-5">Blinddarm, Magen, ...</div>
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
        <div class="">
                            <div class="block block-s1">
                                <h2>ARZTKONTAKT</h2>
                                <p>Sie brauchen medizinischen Rat oder Hilfe? Sprechen Sie jetzt mit einem unserer Ã„rzte oder vereinbaren Sie einen Termin!</p>
                                <div class="text-center"><button class="btn btn-default"><span class="fa-comment1"><img src="<?php echo base_url('assets/img/logo/comment-icon.png');?>" alt=""></span> JETZT KONTAKT<br>AUFNEHMEN</button></div>
                            </div>
                           
          </div>   
 <?php if ($this->m->us_id()) : ?>
          <div class="block block-aktuell">
            <!--<h5 class="content-title"><u>Gewählt Patient</u></h5>-->
            <div class="block-foot">Gewählt Patient</div>
            <div class="list-group">  

              <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right"><img class="img-responsive" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" /></h3>
                <h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
                <p class="list-group-item-text"><?php echo $this->m->us_value('academic_grade'); ?> <?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
              </a>

            </div> <!-- /.list-group -->
          </div>
          <?php endif; ?>
         <div class="block block-link"><a href="<?php echo site_url('rezept'); ?>" class="btn btn-primary ajax-load-link">REZEPTE</a><span class="fa fa-angle-right"></span> </div>
          <div class="block block-aktuell">
          <div class="block-foot"> Arzttermine &amp; Medikamente</div>
          <!--<h5 class="content-title"><u>Arzttermine &amp; Medikamente</u></h5>-->
         <div class="well">
            <div id="sidebar-calendar"></div>
            <!-- fullcalendar starts-->
            <a class="btn btn-primary m-t-10" href="https://ihrarzt24.de/apps/ia24at">Termine</a>
            <!-- fullcalendar ends-->
          </div>
          </div>
         <div class="">
                            <div class="block block-chart">
                                <ul class="chart-list font12">
                                    <li>
                                        <div class="head">
                                            <div class="pull-left title">PULS</div>
                                            <div class="pull-right">
                                                <ul class="list-inline">
                                                    <li><a href=""><span class="fa fa-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-search-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-times"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="clr"></div>
                                        </div>
                                        <div class="chart-block"><img src="<?php echo base_url('assets/img/portal/chart1.png'); ?>" alt=""></div>
                                    </li>
                                    <li>
                                        <div class="head">
                                            <div class="pull-left title">BLUTZUCKER</div>
                                            <div class="pull-right">
                                                <ul class="list-inline">
                                                    <li><a href=""><span class="fa fa-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-search-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-times"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="clr"></div>
                                        </div>
                                        <div class="chart-block"><img src="<?php echo base_url('assets/img/portal/chart1.png'); ?>" alt=""></div>
                                    </li>
                                    <li>
                                        <div class="head">
                                            <div class="pull-left title">GEWICHT &amp; BMI</div>
                                            <div class="pull-right">
                                                <ul class="list-inline">
                                                    <li><a href=""><span class="fa fa-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-search-plus"></span></a></li>
                                                    <li><a href=""><span class="fa fa-times"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="clr"></div>
                                        </div>
                                        <div class="chart-block"><img src="<?php echo base_url('assets/img/portal/chart2.png'); ?>" alt=""></div>
                                    </li>
                                </ul>
                                <div class="block-foot"><span class="fa fa-plus"></span>KATEGORIE HINZUF�GEN</div>
                            </div>
</div>
   <div class="block block-aktuell">
          <h2 class="head font-bold"><strong>NACHRICHTEN</strong></h2>
          <div class="well">
           <ul class="icons-list text-md">

              <li>
                <i class="icon-li fa fa-location-arrow"></i>

                <strong>Rod</strong> uploaded 6 files. 
                <br />
                <small>about 4 hours later</small>
              </li>

              <li>
                <i class="icon-li fa fa-location-arrow"></i>

                <strong>Rod</strong> followed the research interest: <a href="javascript:;">Open Access Books in Linguistics</a>. 
                <br />
                <small>about 23 hours later</small>
              </li>

              <li>
                <i class="icon-li fa fa-location-arrow"></i>

                <strong>Rod</strong> added 51 papers. 
                <br />
                <small>2 days later</small>
              </li>
            </ul>

          </div> <!-- /.well -->
           </div>
          <div class="block block-aktuell">
      
            <div class="block-foot"> Health-Score</div>
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