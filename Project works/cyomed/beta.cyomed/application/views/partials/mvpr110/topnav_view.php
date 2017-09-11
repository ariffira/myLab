<?php  if ($this->m->user() && $this->m->user_id()) :?>
<style type="text/css">
  #idletimeout a { color:#fff; font-weight:bold }
 #idletimeout span { font-weight:bold }
 .bann{ color:#ED1B24; font-size:14px;}

.msg-block {
    position:relative;
}
.msg-block .msg{
	top:15px;
	left:0px;
	/*position:absolute;*/
	padding:10px 15px;
	text-align:center;
	width:100%;
	border:1px solid transparent;
	font:16px "Avenir Next LT Pro Demi",Arial,Helvetica,sans-serif;
}
.msg-block .msg-success{
	color: #3c763d;
	background-color: #dff0d8;
	border-color: #d6e9c6;
}
.msg-block .msg-error{
	color: #a94442;
	background-color: #f2dede;
	border-color: #ebccd1;
}

.alert1 {
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
}
</style>
<?php 
$status= $this->m->notify_ip_msg();
if($status):
  ?>
<script type="text/javascript">

    setTimeout(function(){
    $('#idletimeout').fadeOut(20000);
}, 20000);       
</script>
<div class="msg-block" id="idletimeout">
	<div class="msg msg-success"> You have logged in using different ipaddress <a id="idletimeout-resume" href="#"></a></div>
<!--	<div id="idletimeout" class="msg msg-error"> You have logged in using different ipaddress <a id="idletimeout-resume" href="#"></a></div>-->
</div>
<?php endif; ?>

<header class="header">
    	<div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <ul class="list-inline top-left-menu">
                        <li>
                          <a href="<?php echo site_url('akte/overview/timeline'); ?>" class="ajax-nav-links">
                          <span class="fa fa-home"></span> 
                          <?php echo $this->lang->line('general_text_menu_overview_top');?>
                          </a>
                        </li>
                        <!--<li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-envelope"></i> 
                          <?php //echo $this->lang->line('general_text_menu_iconsult_top');?>
                          </a>
                    
                </li>-->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                    <i class="fa fa-bell"></i><span class="badge badge-primary" id="not_count"></span>
                      <?php echo $this->lang->line('general_text_menu_iconsult_hints');?>
                   <span class="navbar-visible-collapsed">
                      <?php echo $this->lang->line('general_text_menu_iconsult_hints');?>
                  </span>

                 </a>
                 <ul class="dropdown-menu noticebar-menu noticebar-hoverable econstlt-my" role="menu">                
                 	<li class="nav-header">
						<div class="pull-left">
                          	<?php echo $this->lang->line('general_text_menu_iconsult_top');?>
						</div>
                        <div class="pull-right">
                        	<?php if($this->m->user_role() == M::ROLE_PATIENT) 
                            	echo '<a href="'.site_url("akte/econsult").'">View All</a>'
                            ?>
                            <?php if($this->m->user_role() == M::ROLE_DOCTOR) 
                            	echo '<a href="'.site_url("akte/alleconsult").'">View All</a>'
                            ?>
						</div>
			</li>

                    <?php
						$econsult=$this->miconsult->get_econsult_doctor();
						if($this->m->user_role() == M::ROLE_DOCTOR) 
					    {
					    	if(count($econsult->opened)>0)
					        {
						    	$record=array_splice($econsult->opened,0,1);
					            foreach($record as $key=>$value)
					            {
                                	$replies=$this->miconsult->get_replies($value->id);
                                    if(isset($replies) && empty($replies))  {  
	                                    foreach ($replies as $key1=>$value1){
	                                    	if($value1->reply_by!=1){
                                        		unset($replies[$key1]);
                                            }
                                        }
                                    	$replies=array_splice($replies,0,1);        
                                    }

					?>
									<li>
										<a href="<?php echo site_url("akte/alleconsult/index/".$value->id); ?>" class="ajax-econsult-link noticebar-item">
                                        	<span class="noticebar-item-image">
					                        	<img src="<?php echo ($img_path = $this->mdoc->get_profile_img_path($value->patient->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
											</span>
                                                                                        
											<span class="noticebar-item-body">
                                                <strong class="noticebar-item-title"><?php echo $result->name.' '.$result->surname;?></strong>
												<strong class="noticebar-item-title"><?php echo (strlen($value->keyword)>20)?substr($value->keyword, 0, 20) . '...':$value->keyword;?></strong>
												<span class="noticebar-item-text"><?php echo (strlen($value->keyword)>30)?substr($replies[0]->reply_message, 0, 30) . '...':$replies[0]->reply_message;?></span>
												<span class="noticebar-item-time">
													<i class="fa fa-clock-o"></i>
													<?php echo date('d.m.Y',strtotime($value->document_date));?> 
												</span>
											</span>
										</a>   
									</li>  
					<?php
								}
                                                                
							} 
					        else 
					        { 
					?>
								<li>No messages. </li>
					<?php 
							}
						}
						else 
						{
					    	if(count($econsult->closed)>0)
					        {
                            	$record=array_splice($econsult->closed,0,1);
					            foreach($record as $key=>$value)
								{
                                	$reply_data=array();
                                    $replies=$this->miconsult->get_replies($value->id);
                                    if(isset($replies) && !empty($replies)){
                                    	foreach ($replies as $key1=>$value1){
                                        	if($value1->reply_by!=0){
                                            	unset($replies[$key1]);
                                            }
                                        }
                                        $replies=array_splice($replies,0,1);
					?>
										<li>
											<a href="<?php echo site_url("akte/econsult/index/".$value->id); ?>" class="ajax-econsult-link noticebar-item">
				                            	<span class="noticebar-item-image">
													<img src="<?php echo ($img_path = $this->mdoc->get_profile_image_path($replies[0]->doctor)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
												</span>
												<span class="noticebar-item-body">
                                                                                                            <strong class="noticebar-item-title"><?php echo 'Dr. '.$replies[0]->doctor->name.' '.$replies[0]->doctor->surname ;?></strong>
													<strong class="noticebar-item-title"><?php echo (strlen($value->keyword)>20)?substr($value->keyword, 0, 20) . '...':$value->keyword;?></strong>
													<span class="noticebar-item-text"><?php echo (strlen($replies[0]->reply_message)>30)?substr($replies[0]->reply_message, 0, 30) . '...':$replies[0]->reply_message;?></span>
													<span class="noticebar-item-time">
														<i class="fa fa-clock-o"></i>
														<?php echo date('d.m.Y',strtotime($value->document_date));?> 
													</span>
												</span>
											</a>
										</li>
					<?php 	
                                                            }} 
									
					            }
								else 
								{
					?>
									<li>No messages. </li>
					<?php 
					      		} 
							
						}
					?>
					<li class="nav-header">
						<div class="pull-left">
                          	<?php echo $this->lang->line('general_text_menu_eappoint_top');?>
						</div>
                                            <div class="pull-right">
                                                <?php  
                                                echo '<a href="'.site_url("akte/reservation").'">View All</a>'
                                                 ?>
						</div>

					</li>
					<?php 
						//reservation 
						$this->load->model('akte/reservation/mreservation');
						
				        if($this->m->user_role() == M::ROLE_DOCTOR) 
					    {
                         	$reservation=  array('doctor_id'=>$this->m->user_id(),'date(start)>='=>date('Y-m-d'),'accept'=>'0');
                                 $this->m->port->b->where("( `accept`= '0'");                                
                                $this->m->port->b->or_where("request ='1')");
                            $result=$this->mreservation->getReservation($reservation,1,2);
                            
					    	if(count($result)>0)
					        {
					        	if($result[0]->patient_id>0)
					        	{
					?>
									<li>
					                	<a href="<?php echo site_url('akte/reservation');?>"  class="noticebar-item" >
					                    	<span class="noticebar-item-image">
					                        	<img src="<?php echo ($img_path = $this->mdoc->get_profile_img_path($result[0]->patient->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
											</span>
											<span class="noticebar-item-body">
												<strong class="noticebar-item-title"><?php echo $result[0]->first_name.' '.$result[0]->last_name;?></strong>
												<span class="noticebar-item-text"><?php echo $result[0]->email;?></span>
												<br>
												<span class="noticebar-item-text"><?php echo $result[0]->telephone;?></span>
												<span class="noticebar-item-time">
													<i class="fa fa-clock-o"></i>
													<?php echo date('d.m.Y',strtotime($result[0]->start))?> 
													<?php echo '<br>'.date('H:i',strtotime($result[0]->start)).'-'.date('H:i',strtotime($result[0]->end));?> 
												</span>
											</span>
										</a>   
									</li>  
					<?php 
					        	} 
					        	else 
					        	{
					 ?>
									<li>
                                                              <a href="<?php echo site_url('akte/reservation');?>" class="noticebar-item" >
					                    	<span class="noticebar-item-image">
					                        	<img src="<?php echo base_url()."assets/img/portal/default-user.png"; ?>"/>
											</span>
											<span class="noticebar-item-body">
												<strong class="noticebar-item-title"><?php echo $result[0]->first_name.' '.$result[0]->last_name;?></strong>
												<span class="noticebar-item-text"><?php echo $result[0]->email;?></span>
												<br>
												<span class="noticebar-item-text"><?php echo $result[0]->telephone;?></span>
												<span class="noticebar-item-time">
													<i class="fa fa-clock-o"></i>
													<?php echo date('d.m.Y',strtotime($result[0]->start))?> 
													<?php echo '<br>'.date('H:i',strtotime($result[0]->start)).'-'.date('H:i',strtotime($result[0]->end));?> 
												</span>
											</span>
										</a>   
									</li>  
					<?php
					        	}
							} 
					        else 
					        { 
					?>
								<li>No messages. </li>
					<?php 
							}
						}
						else 
						{
                                                $reservation=  array('patient_id'=>$this->m->user_id(),'accept >='=>1,'date(start)>='=>date('Y-m-d'));   
                                                 $result=$this->mreservation->getReservation($reservation,1,1);
                                              
				        	if(count($result)>0)
					        {
					?>
									<li>
					                	<a href="<?php echo site_url("akte/reservation"); ?>" class="noticebar-item"  >
					                    	<span class="noticebar-item-image">
					                        	<img src="<?php 
													echo ($img_path = $this->mdoc->get_profile_image_path($result[0]->doctor)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
											</span>
											<span class="noticebar-item-body">
												<strong class="noticebar-item-title"><?php echo $result[0]->doctor->name.' '.$result[0]->doctor->surname;?></strong>
												<span class="noticebar-item-text"><?php echo $result[0]->doctor->email;?></span>
												<br>
												<span class="noticebar-item-text"><?php echo $result[0]->doctor->telephone;?></span>
												<span class="noticebar-item-time">
													<i class="fa fa-clock-o"></i>
													<?php echo date('d.m.Y',strtotime($result[0]->start))?> 
													<?php echo '<br>'.date('H:i',strtotime($result[0]->start)).'-'.date('H:i',strtotime($result[0]->end));?> 
												</span>
											</span>
										</a>   
									</li>  
					<?php  
							} 
							else 
							{
					?>
								<li>No messages. </li>
					<?php 
				      		} 
						}

					?>
					
					<li class="nav-header">
						<div class="pull-left">
                          	<?php echo $this->lang->line('general_text_menu_epres_top');?>
						</div>
                                             <div class="pull-right">
                                                <?php if($this->m->user_role() == M::ROLE_PATIENT) 
                                                echo '<a href="'.site_url("rezept/rezept_history").'">View All</a>'
                                                 ?>
                                                <?php if($this->m->user_role() == M::ROLE_DOCTOR) 
                                                echo '<a href="'.site_url("rezept").'">View All</a>'
                                                        ?>
						</div>
					</li>
					<?php 
						//ePrescription
						$rezeptdata = array();
				        $rezeptdata = $this->modoc->list_of_applications();
                                       
                                        $rezeptdata=array_splice($rezeptdata,0,1);
				        if($this->m->user_role() == M::ROLE_DOCTOR) 
					    {
					    	if(count($rezeptdata)>0)
					        {
                                                     $user_detail=$this->m->user_details($rezeptdata[0]->patient_id,'role_patient');
                                                    
					?>
									<li>
					                	<a href="<?php echo site_url('rezept');?>" class="noticebar-item" >
					                    	<span class="noticebar-item-image">
					                        	<img src="<?php echo ($img_path = $this->mdoc->get_profile_img_path($user_detail->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
											</span>
											<span class="noticebar-item-body">
												<strong class="noticebar-item-title"><?php echo $user_detail->name.' '.$user_detail->surname;?></strong>
												<span class="noticebar-item-text"><?php echo $user_detail->email;?></span>
												<br>
												<span class="noticebar-item-text"><?php echo $user_detail->telephone?></span>
											</span>
										</a>   
									</li>  
					<?php  
							} 
					        else 
					        { 
					?>
								<li>No messages. </li>
					<?php 
							}
						}
						else 
						{
					    	if(count($rezeptdata)>0)
					        {
                                                       $user_detail=$this->m->user_details($rezeptdata[0]->patient_id,'role_patient');
					?>
								<li>
				                	<a href="<?php echo site_url('rezept/rezept_history');?>" class="noticebar-item">
				                    	<span class="noticebar-item-image">
				                        	<img src="<?php echo ($img_path = $this->mdoc->get_profile_img_path($user_detail->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
										</span>
										<span class="noticebar-item-body">
											<strong class="noticebar-item-title"><?php echo $user_detail->name.' '.$user_detail->surname;?></strong>
											<span class="noticebar-item-text"><?php echo $user_detail->email;?></span>
											<br>
											<span class="noticebar-item-text"><?php echo $user_detail->telephone;?></span>
										</span>
									</a>   
								</li>
					<?php 	
							}
							else 
							{
					?>
								<li class="ajax-patient-links">No messages. </li>
					<?php 
					      	}
						}
					?>
					
					<li class="nav-header">
						<div class="pull-left">
                          	<?php echo $this->lang->line('general_text_menu_video_top');?>
						</div>
					</li>
                                        <li>
						<ul id="video_notification" class="dropdown-menu noticebar-menu noticebar-hoverable" role="menu">
						</ul>
					</li>
                                         <?php if($this->m->user_role() == M::ROLE_DOCTOR) 
					    {
                                             ?>
                                        <li class="nav-header">
						<div class="pull-left">
                          	<?php echo $this->lang->line('general_text_menu_doctor_top');?>
						</div>
                                <div class="pull-right">
                        	<?php
                            	echo '<a href="'.site_url("akte/profile/index/connect").'" class="ajax-nav-links">View All</a>'
                                ?>                           
				</div>
                                    </li>
					<?php 	
				       
                            $result=$this->mopat->get_doctorsconnet(1); 
//                                    echo "ntehs";print_R($result);die;
					    	if(count($result)>0)
					        {                                                    
                                                    if(!($this->m->user_id() == $result[0]->sender_id && !$result[0]->status)){
					?>
									<li>
                                <a href="<?php echo site_url("akte/profile/index/connect"); ?>" class="noticebar-item ajax-nav-links"  >
                                    <span class="noticebar-item-image">
                                            <img src="<?php 
                                             echo ($img_path = $this->mdoc->get_profile_image_path($result[0])) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/>
                                                            </span>
                                                            <span class="noticebar-item-body">
                                                                    <strong class="noticebar-item-title"><?php echo $result[0]->name.' '.$result[0]->surname;?></strong>
                                                            <span class="noticebar-item-text"><?php echo $result[0]->email;?></span>
                                                                    <br>
                                                                    <span class="noticebar-item-text"><?php echo $result[0]->telephone;?></span>                                                                   
                                                            </span>
                                </a>   					                	  
									</li>  
					<?php 
					        	
                                            }  } }                                     
                                         ?>
					
				</ul>
                  
                </li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <div class="logo">
	                    <a href="<?php echo site_url('akte/overview/timeline'); ?>" class="ajax-nav-links" title="Cyomed">
	                    	<img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/>
						</a>
					</div>
                </div>
                <div class="col-sm-5">
                    <div class="user-nav">
                        <ul class="list-inline">
                            <li class="dropdown">
                            	<a id="dLabel" data-target="#" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" role="button">
                            		<span class="img">
                            			<?php 
	                            			$this->load->model('document/mdoc'); 
	                            			$img_path = $this->mdoc->get_profile_image_path();
	                            			
	                            			if(!empty($img_path))
	                            			{
	                            		?>
	                            				<img src="<?php echo base_url($img_path); ?>" width="30" alt="">
	                            		<?php 
	                            			}
	                            			else if (strtolower($this->session->userdata('user_gender'))=='female' || $this->session->userdata('user_gender')==2)
	                            			{
	                            		?>
	                            				<i style="font-size: 30px;" class="fa fa-female"></i>
	                            		<?php 	
	                            			}
	                            			else
	                            			{
	                            		?>
	                            				<i style="font-size: 30px;" class="fa fa-male"></i>
	                            		<?php 	
	                            			}
	                            		?>
                            		</span> 
                            		<b class="caret"></b>
                            	</a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                           <li data-toggle="dropdown">
                            <a href="<?php echo site_url('akte/profile'); ?>" class="ajax-nav-links">
                             <i class="fa fa-user"></i> 
                                <?php echo $this->lang->line('general_text_menu_profil_top');?>
                            </a>
                          </li>
                          <?php if($this->m->user_role() == M::ROLE_DOCTOR){?>
                           <li data-toggle="dropdown">
                            <a href="<?php echo site_url('akte/myprofile'); ?>" class="ajax-nav-links">
                             <i class="fa fa-user"></i> 
                                <?php echo $this->lang->line('general_text_menu_sys_pat');?>
                            </a>
                          </li>
                         <?php } ?>
                         <!--<li>
                         <a href="./page-pricing.html">
                          <i class="fa fa-dollar"></i> 
                          Plans &amp; Billing
                         </a>
                        </li>-->

<!--                    <li data-toggle="dropdown">
                      <a href="<?php // echo site_url('akte/access'); ?>" class="ajax-nav-links">
                        <i class="fa fa-cogs"></i> 
                          <?php echo $this->lang->line('general_text_menu_setting');?>
                      </a>
                    </li>-->
                    <li class="divider"></li>

                    <li>
                      <a href="<?php echo site_url('portal/both/logout'); ?>">
                        <i class="fa fa-sign-out"></i> 
                          <?php echo $this->lang->line('general_text_menu_logout');?>
                      </a>
                    </li>
                  </ul>
                            </li>
                        </ul>
                    </div>
                    <?php 
						if($this->m->user_role() != M::ROLE_DOCTOR)
						{
					?>
		                    <div class="left-menu visible-xs"><a href="#"><span class="fa fa-bars"> </span></a></div>
		                    <div class="top-search">
		                        <input type="text" value="" id="doctor_id" placeholder="By Doctor Id/Doctor Name" class="form-control">
		                        <a class="btn btn-link ajax-doctorprofiles-links" hrefhome="<?php echo site_url('akte/overview/timeline'); ?>" href="<?php echo site_url('akte/myprofile/'); ?>" ><span class="fa fa-search"></span></a>
		                   </div>  
                    <?php 
						}
						else 
						{
    				?>
        					<div class="left-menu visible-xs"><a href="#"><span class="fa fa-bars"> </span></a></div>
		                    <div class="top-search">
		                        <input type="text" value=""id="patient_id" placeholder="By Patient Id/Patient Name" class="form-control">
		                        <a class="btn btn-link ajax-patientprofiles-links" hrefhome="<?php echo site_url('akte/overview/timeline'); ?>" href="<?php echo site_url('akte/myprofile/'); ?>" ><span class="fa fa-search"></span></a>
		                   </div>             
                    <?php
						}
					?>
         </div>
      </div>
   </div>
</header>
<?php endif; ?>
