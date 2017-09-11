<?php
$embedStr = '';
if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
<?php
          $doctor = $doctor->id;
          $url=  site_url('/termin/doctor/plugin/iframe'); 
          $embedStr .= "<iframe src='$url?shareid=$doctor' style='width:100%;height:1000px;border:0px;background-color:transparent;' frameborder='0' allowtransparency='true' onload='keepInView(this);'></iframe>";
?>
<?php endforeach; endif; ?>

<div class="feature-lg figure-right">

  <div class="row">

    <div class="col-sm-6 col-sm-push-6 ">
      <textarea name="iframeCopyBox" id="iframeCopyBox" class="input-block-level clip_button"  rows="8"><?=(isset($embedStr) ? trim($embedStr) : '');?></textarea>

      <p><button id="iframe-copy-button" class="btn copy-button zeroclipboard-is-hover" data-clipboard-target="iframeCopyBox"><i class="icon-download"></i> copy to clipboard</button></p>

    </div><!-- /.col -->

    <div class="col-sm-6 col-sm-pull-6">
      <div class="feature-content">
        <h3>embed on your website
          <span class="fa fa-lg fa-code "></span>

        </h3>
        <p>Copy the text in this box and paste in the HTML of your webpage.</p>
        <ul class="icons-list">
          <li>
            <i class="icon-li fa fa-check text-primary"></i>
            You may want to adjust the 'height' when you see it on the page.
          </li>
          <li>
            <i class="icon-li fa fa-check text-primary"></i>
            Avoid unwanted empty space below your embed by reducing from the
            "1000px" suggested here.
            But make sure you have enough height so that no scroll bars
            appear alongside.
          </li>

        </ul>
      </div> <!-- /.feature-content -->
    </div><!-- /.col -->

  </div> <!-- /.row -->

</div>


<hr class="spacer-lg">


<div class="feature-lg">

  <div class="row">

    <div class="col-sm-6">
<?php 
$embedStr2='';
if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
        <?php 
        $doctor= $doctor->id;
        $url=  site_url('/termin/doctor/plugin/iframe');
        $embedStr2 .= "<a href='$url?shareid=$doctor' data-ycbm-modal='true'><img src="."'".base_url()."/assets/img/booknow.png"."'  style='border-style:none;'/></a>";
?>
<?php endforeach; endif; ?>        
      <textarea name="buttonCopyBox" id="buttonCopyBox" class="input-block-level clip_button"  rows="8"><?php echo (isset($embedStr2) ? trim($embedStr2) : '');?></textarea>
    <p><button id="copy-button" class="btn copy-button zeroclipboard-is-hover" data-clipboard-target="iframeCopyBox"><i class="icon-download"></i> copy to clipboard</button></p>
</div><!-- /.col -->

  <div class="col-sm-6">
    <div class="feature-content">
      <h3>get a button for your site
        <span class="fa fa-lg fa-share-alt-square"></span>
      </h3>
      <p>To get a button on your site like this, copy the text in this box and paste in the HTML of your webpage..</p>

    </div> <!-- /.feature-content -->
  </div><!-- /.col -->

</div> <!-- /.row -->

</div>



<script type="text/javascript">
    $(document).ready(function () {

        $("#iframe-copy-button").zclip({
            path: $.baseUrl+ "assets/js/ZeroClipboard.swf",
            copy: function () { return $('#iframeCopyBox').val(); },
            beforeCopy: function () { },
            afterCopy: function () {
                //alert('Copy To Clipboard : \n' + $('#iframeCopyBox').val());
                $(this).html("copied!");
                console.log('Copied text to clipboard: ' + $('#iframeCopyBox').val());
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#copy-button").zclip({
            path: $.baseUrl+ "assets/js/ZeroClipboard.swf",
            copy: function () { return $('#buttonCopyBox').val(); },
            beforeCopy: function () { },
            afterCopy: function () {
                //alert('Copy To Clipboard : \n' + $('#iframeCopyBox').val());
                $(this).html("copied!");
                console.log('Copied text to clipboard: ' + $('#buttonCopyBox').val());
            }
        });
    });
</script>


