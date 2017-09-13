<?php
require_once '../constant.php';
 if($_SERVER['HTTP_HOST']   == 'localhost'){    
     $url = LOCAL_PATH."index.php/akte/dycom/mrstudy?imgId=".$_REQUEST['imgId'];
}
else{
    $url = LIVE_PATH."index.php/akte/dycom/mrstudy?imgId=".$_REQUEST['imgId'];
}
header("Location:".$url);
exit;
?>

