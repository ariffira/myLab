<?php
/*
 * Auth Success :close window
 * 
 */
if (isset($closewindow)):
    ?>
    <h1 style="text-align: center;">Success</h1>
    <script type="text/javascript">
        var data = {api: window.opener.api, 'action': 'init'};
        window.opener.requestAction(data);
        self.close();
    </script>
    <?php
    die();
endif;
/*
 * Auth Success :close window
 * 
 */
?>
<?php
/*
 * Auth Failed :Show Error
 * 
 */
if (isset($showError)):
    ?>
    <h3 align="center"><?php echo $showError; ?></h3>
    <p style="text-align: center"><button onclick="closethisWindow();">Click To Continue</button></p>
    <script>
        function closethisWindow() {
    	self.close();
        }
    </script>
    <?php
    die();
endif;
/*
 * Auth Failed : Show Error
 * 
 */
?>
<div class="panel panel-body row">
    <div class="col-md-12">
	<div class="col-md-6"><div id="syncNotification" style="display: none" class="btn btn-success"></div></div>
	<div class="col-md-6">
	    <span style="margin-left: 5px;margin-right:5px;" id="syncBtnGoogle" onclick="checkForSyncing(this);" data-api="google" class="sync_btn btn btn-small btn-primary pull-right">Sync With Google</span>
	    <span style="margin-left: 5px;margin-right:5px;" id="syncBtnOutlook" onclick="checkForSyncing(this);" data-api="outlook" class="sync_btn btn btn-small btn-warning pull-right">Sync With Outlook</span>
	</div>
    </div>
</div>
<script type="text/javascript">
    popwindow = null;
    api = null;
    function testParent() {
        alert(api);
    }
    function popupwindow(url, title) {
        var h = $(window).height() * 0.7;
        var w = $(window).width() * 0.7;
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        popwindow = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        popwindow.focus();
        return popwindow;
    }
    function requestAction(data) {
        var url = '<?php echo $ajaxurl; ?>';
        $.post(url, data, function (response) {
            parseResponse(response);
        });
    }
    function parseResponse(response) {
        if (response.error && typeof (response.error) !== "undefined" && response.txt != "000") {
            alert(response.txt);
        } else {
            switch (response.process) {
                case 'redirect':
                    windowpopup = popupwindow(response.txt, 'Please Authenticate');
                    $(windowpopup).on("close", function () {
                        alert("yes");
                        var data = {action: 'init', api: api};
                        requestAction(data);
                    });
                    break;
                case 'refresh':
                    window.location.reload();
                    break;
                case 'initNotify':
                    $(response.id).html(response.txt);
                    $(response.id).attr('onlick', '');
                    var data = {action: 'startSync', api: api};
                    requestAction(data);
                    break;
                case 'complete':
                    $("#syncNotification").html(response.txt).fadeIn(0).fadeOut(5000, function () {
                        $(this).html('');
                    });
                    $(response.id).html(response.btntext);
                    $('.sync_btn').attr('onlick', 'checkForSyncing(this);');
                    break;
                case  'undefined':
                    console.log(response);
                    break;
            }
        }
    }
    function checkForSyncing(elm) {
        var api_l = $(elm).data('api');
        api = api_l; //set Global Instance
        var data = {action: 'init', api: api_l};
        requestAction(data);
    }
</script>