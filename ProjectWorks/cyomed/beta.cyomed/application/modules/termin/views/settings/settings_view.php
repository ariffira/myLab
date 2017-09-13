<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>

<?php $this->ui->tile->base_init(); ?>    

<div class="container">

  <div class="layout layout-main-right layout-stack-sm">

    <div class="col-md-3 col-sm-4 layout-sidebar">

      <div class="nav-layout-sidebar-skip">
        <strong>Tab Navigation</strong> / <a href="#settings-content">Skip to Content</a> 
      </div>

      <ul id="myTab" class="nav nav-layout-sidebar nav-stacked">
        <!-- <li class="active">
          <a href="#profile-tab" data-toggle="tab">
            <i class="fa fa-user"></i> 
            &nbsp;&nbsp;
              <?php echo $this->lang->line('setting_tab_basic');?>
          </a>
        </li> -->

        <li class="active">
          <a href="#times-tab" data-toggle="tab">
            <i class="fa fa-clock-o"></i> 
            &nbsp;&nbsp;
              <?php echo $this->lang->line('setting_tab_time');?>
          </a>
        </li>

        <!--<li>
          <a href="#messaging" data-toggle="tab">
            <i class="fa fa-list-alt"></i>
            &nbsp;&nbsp;Booking Form
          </a>
        </li>-->

        <li>
          <a href="#afterwards-tab" data-toggle="tab">
            <i class="fa fa-mail-forward"></i>
            &nbsp;&nbsp;
          <?php echo $this->lang->line('setting_tab_afterward');?>
          </a>
        </li>

        <!--<li>
          <a href="#cancellation-tab" data-toggle="tab">
            <i class="fa fa-close"></i>
            &nbsp;&nbsp;Cancellation
          </a>
        </li>-->

        <li>
          <a href="#remainders-tab" data-toggle="tab">
            <i class="fa fa-bell"></i>
            &nbsp;&nbsp;
          <?php echo $this->lang->line('setting_tab_reminder');?>
          </a>
        </li>

        <li>
          <a href="#followup-tab" data-toggle="tab">
            <i class="fa fa-calendar"></i>
            &nbsp;&nbsp;
          <?php echo $this->lang->line('setting_tab_followup');?>
          </a>
        </li>

      </ul>

    </div> <!-- /.col -->



    <div class="col-md-9 col-sm-8 layout-main">

      <div id="settings-content" class="tab-content stacked-content">

        <!-- Profile tab Started -->
        <!-- <div class="tab-pane fade in active" id="profile-tab">
          <h3 class="content-title">
            <u>
              <?php echo $this->lang->line('basic_all_info_title');?>
            </u>
          </h3>
          
          <?php // $this->load->view('settings/basics_view'); ?>

        </div> -->
        <!-- Profile tab End -->


        <!-- Times tab Started -->
        <div class="tab-pane fade in active" id="times-tab">

          <h3 class="content-title">
            <u>
              <?php echo $this->lang->line('times_slot_title');?>
            </u>
          </h3>

          <p class="help-block text-muted">
            <?php echo $this->lang->line('times_slot_details');?>
          </p>

          <?php 
            $events = $this->m->user()->all_termins;
            $this->load->view('settings/times_view'); 
          ?>

        </div>
        <!-- Times tab End -->

        <!-- Afterwards tab Started -->
          <div class="tab-pane fade" id="afterwards-tab">

            <h3 class="content-title">
              <u>
                <?php echo $this->lang->line('afterward_title');?>
              </u>
            </h3>
            
            <?php 
              $this->load->view('settings/afterwards_view',$termin_settings); 
            ?>
        </div>
        <!-- Afterwards tab End -->

        <!-- Cancellation tab Started -->
        <!-- <div class="tab-pane fade" id="cancellation-tab">

          <h3 class="content-title"><u>Cancellation settings</u></h3>
          <ul id="myTab1" class="nav nav-tabs">
            <li class="active">
              <a href="#messages" data-toggle="tab" aria-expanded="true">Messages</a>
            </li>

            <li class="">
              <a href="#limits" data-toggle="tab" aria-expanded="false">Limits</a>
            </li>

          </ul>

          <div id="myTab1Content" class="tab-content">

            <div class="tab-pane fade active in" id="messages">
              <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>

              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
            </div> 

            <div class="tab-pane fade" id="limits">
              <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>

              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
            </div> 

          </div>        

        </div> -->
        <!-- Cancellation tab End -->

        <!-- Remainders tab Started -->
        <div class="tab-pane fade" id="remainders-tab">

          <h3 class="content-title">
            <u>
              <?php echo $this->lang->line('reminder_title');?>
            </u>
          </h3>
          <p class="help-block text-muted">
              <?php echo $this->lang->line('reminder_info');?>
          </p>

          <?php 
            $this->load->view('settings/reminders_view',$termin_settings); 
          ?>

        </div>
        <!-- Remainders tab End -->

        <!--followup tab Started -->
        <div class="tab-pane fade" id="followup-tab">

            <h3 class="content-title">
              <u>
                <?php echo $this->lang->line('followup_title');?>
              </u>
            </h3>
            <p class="help-block text-muted">
                <?php echo $this->lang->line('followup_info');?>
            </p>    
            <?php 
              $this->load->view('settings/followup_view',$termin_settings); 
            ?> 

        </div>
        <!--followup tab End -->


      </div> <!-- /.tab-content -->

    </div> <!-- /.col -->

  </div> <!-- /.row -->


</div> <!-- /.container -->

