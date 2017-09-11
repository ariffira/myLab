<?php
    $termin_settings = $this->modoc->get_termin_settings();
?>
<ul class="nav nav-tabs">
    <li class="active">
    	<a href="#cal-setting">
    		<h6><?php echo $this->lang->line('setting_tab_time');?></h6>
    	</a>
    </li>
    <li>
        <a href="#general">
            <h6>General</h6>
        </a>
    </li>
    <li>
    	<a href="#afterwards">
            <h6><?php echo $this->lang->line('setting_tab_afterward');?></h6>
        </a>
    </li>
    <li>
    	<a href="#reminder">
    		<h6><?php echo $this->lang->line('setting_tab_reminder');?></h6>
    	</a>
    </li>
    <li>
    	<a href="#follow-up">
    		<h6><?php echo $this->lang->line('setting_tab_followup');?></h6>
    	</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade in active" id="cal-setting">
        <?php 
            $calendar_setting = (object) $this->modoc->get_doctor_settings($this->m->user_id());
            echo $this->load->view('termin/settings/calendar_settings_view',array('calendar_setting' => $calendar_setting,));
        ?>
    </div>

    <div class="tab-pane fade" id="general">
        <?php
            $this->load->view('termin/settings/general_setting_view');
        ?>
    </div>
    
    <div class="tab-pane fade" id="afterwards">
        <?php
            $this->load->view('termin/settings/afterwards_view',$termin_settings);
        ?>
    </div>
    
    <div class="tab-pane fade" id="reminder">
       <?php
            $this->load->view('termin/settings/reminders_view',$termin_settings);
       ?>
    </div>
    
    <div class="tab-pane fade" id="follow-up">
        <?php 
            $this->load->view('termin/settings/followup_view',$termin_settings); 
        ?>
    </div>
</div>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>