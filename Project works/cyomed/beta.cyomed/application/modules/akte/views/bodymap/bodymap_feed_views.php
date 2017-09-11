<?php

$this->ui->feed_item->base_init();

$this->load->language('global/general_text', $this->m->user_value('language'));
$this->load->language('pwidgets/bodymap', $this->m->user_value('language'));
?>
<script src="http://infinity-stores.co.uk/cyomed/assets/sa103/js/bootstrap-datetimepicker.js"></script>
<link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">

<div class='blog-list'>
    <div class="main_container container">
        <div class="page_head">
            <h2 class="title text-center">Cyomed Body Map</h2>
        </div>
        <div class="col-md-6">
        <div class="body-pointer">
            <center><div class="body-img" style="background:url(../assets/images/frontpage_pics/front_body.png) center top no-repeat;  height:367px; width:246px; min-height:367px; min-width:246px; max-height:367px; max-width:246px; cursor:pointer; position:relative; "></div></center>
            <div class="clr"></div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="bodymap_frm">
        <form class="" id="bodymapFrm" role="form" method="post" onsubmit="bodymapValidation();" action="<?php echo site_url('akte/bodymap/insert') ?>" enctype="multipart/form-data" <?php echo!empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo!empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
            <div class="form-grop">

                <div class="col-sm-9">
                    <div class="col-sm-3">
                        <input type="hidden" class="form-control" required="" value="" readonly id="x_position" name="x_position">                   
                    </div>
                    <div class="col-sm-3">
                        <input type="hidden" value="" class="form-control" required="" id="y_position" readonly name="y_position">
                    </div>
                </div>

            </div>
            <div class='clear'></div>
            <div class="form-group">
                <label for="pain" class="col-md-4 control-label text-white padd-m0">
                    <?php echo $this->lang->line('pain_intensity'); ?>
                </label>
                      <div class="may-slect col-md-8 padd-m0">         
                    <select type="text" class="form-control" required="" name="pain" id="pain">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label for="pain type" class="col-md-4 control-label text-white padd-m0">
                    <?php echo $this->lang->line('pain_type'); ?>
                </label>
                        <div class="col-md-8 con-radio padd-m0"> 
                           
                <label class="radio-inline">    <?php echo $this->lang->line('acute'); ?> <input type="radio" checked class="p_type" name="pain_type" value="acute" /> </label>
                 
                  <label class="radio-inline">  <?php echo $this->lang->line('chronic'); ?> <input type="radio" class="p_type" name="pain_type" value="chronic" /> </label>
                </div>
                 <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <label for="Qualities" class="col-md-4 control-label text-white padd-m0">
                    <?php echo $this->lang->line('qualities'); ?>
                </label>
                <div class="col-md-8 padd-m0">
                    <select name="qualities" class="form-control" required="">
                        <option><?php echo $this->lang->line('select_qualities'); ?></option>

                        <option value="pounding"><?php echo $this->lang->line('pounding') ?></option>
                        <option value="stabbing"><?php echo $this->lang->line('stabbing') ?></option>
                        <option value="dull"><?php echo $this->lang->line('dull') ?></option>
                        <option value="cramplike"><?php echo $this->lang->line('cramplike') ?></option>
                        <option value="aching"><?php echo $this->lang->line('aching') ?></option>
                        <option value="burning"><?php echo $this->lang->line('burning') ?></option>
                    </select>                                      
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-group" >
                <label for="date from" class="col-md-4 control-label text-white padd-m0">
                    <?php echo $this->lang->line('date_from'); ?>
                </label>
                <div class="col-md-8 padd-m0">                                  
                    <div class="input-icon datetime-pick date-only">
                        <input type="text" data-provide="datepicker" class="form-control input-sm" readonly required="" id="date_from" name="date_from" data-format="dd.MM.yyyy" value="<?php echo date('d.m.Y') ?>" placeholder="<?php echo $this->lang->line('enter_date'); ?>" />
                        <span class="add-on">
                            <i class="fa fa-calendar"></i>
                        </span>                    
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button class="btn btn-alt btn-lg condition-submit1" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>          
                </div>
            </div>
        </form>
    </div></div>
    </div>
    
</div>
<?php 
if(isset($entries) && !empty($entries)){
    foreach ($entries as $positions){ ?>
        <script>
            $(document).ready(function(){               
        $(".body-img").append('<span class="pointer" title="pointer" style="left:<?php echo $positions->x_position?>px;top:<?php echo $positions->y_position?>px"></span>');
    });
        </script>
<?php }
}
?>

<script src="<?php echo base_url() ?>assets/js/jquery.imagemapster.js"></script>
<script>
    $('img').mapster({
        fillColor: 'ff0000',
        fillOpacity: 0.3
            });
    $(".body-img").click(function (e) {
        var parentOffset = $(this).parent().offset();
        var relX = e.pageX - parentOffset.left - 20;
        var relY = e.pageY - parentOffset.top - 4;
        $('#x_position').val(relX);
        $('#y_position').val(relY);
        $(".body-img").append('<span class="pointer" title="pointer" style="left:' + relX + 'px;top:' + relY + 'px"></span>')
            });
    
    /***use for condition entry validation***/
    $(".form-group").find('.condition-submit1').click(function (e) {
        if($('#x_position').val() == "" && $('#y_position').val() == ""){
            alert("Please select your pain position in bodymap");
            return false;
        }
        var $forms = $('#bodymapFrm');
        e.preventDefault();
            $forms.length ? $($forms[0]).ajaxSubmit({                     success: function () {
                $('.ajax-feed-link.active').click();
                    }
            }) : '';
        });
    function bodymapValidation(){
        alert("djfksl");       
        
    }
</script>

        
<style>
    .main_container{
        max-width:100%;
        background:#FFF;  
        padding-top:40px;
        padding-bottom:40px;
    }
    .body-img{
        position:relative;
    }
    @-webkit-keyframes shadow{
        0%{
            box-shadow:0 0 2px rgba(0,0,0,.2);
        }
        50%{
            box-shadow:0 0 10px rgba(255,0,0,.9);
        }
        100%{
            box-shadow:0 0 2px rgba(0,0,0,.2);
        }
    }
    .body-img .pointer{
        position:absolute;
        width:8px;
        height:8px;
        border:2px solid #FFF;
        background:red;
        border-radius:50%;
        -webkit-animation:shadow .5s linear infinite;
    }
    .bodymap_frm{margin-top: 30px;}
    input[type="radio"]{opacity: 1 !important;}
    .input-icon .add-on {
        position: absolute;
        top: 1px;
        left: 1px;
        padding: 5px 4px 2px 5px;
        display: block !important;
        font-size: 15px;
        background: rgba(0, 0, 0, 0.15) none repeat scroll 0% 0%;
    }
	.bodymap_frm .form-group{ }
	.padd-m0{ padding-left:0}
	.con-radio label{ padding:0 10px;}
	/*.may-slect{ width:60%}*/
</style>