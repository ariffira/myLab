<?php $this->ui->tile->base_init(); ?>


<?php if (Ui::$bs_tname == 'mvpr110') : ?>
        <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
      <?php endif; ?>

    <div class="col-sm-12 col-md-10 col-md-offset-1">

        
            <div class="pricing-header" style="margin: 0px 0px 0px;">
            <h3 class="pricing-plan-title">CYOMED Videochat</h3>  
                <a class="pricing-plan-ribbon-secondary ui-tooltip ajax-nav-link"  href="<?php echo smart_site_url('/akte/videochat'); ?>">
                  &nbsp;<i class="fa fa-group fa-lg"></i>
                </a>                   
            </div>    
        

             

    </div> <!-- /.col -->

    <div class="col-sm-12 col-md-10 col-md-offset-1">

        <div class="embed-responsive embed-responsive-4by3" style="background-color:#333333;">

            <iframe class="embed-responsive-item" id="" style="width:100%; height:540px; margin:0px; border:0px; overflow:hidden; " src="<?php echo site_url('/akte/videochat/callview'); ?>"></iframe>

        </div>
    </div>


    










