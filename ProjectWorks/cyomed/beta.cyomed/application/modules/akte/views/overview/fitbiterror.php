<?php
if($status){    
?>
<script type="text/javascript">
    
    
    
    window.opener.document.getElementById("fitbit_link").click();
    window.close();

</script>

<?php
}
else{
    ?>
    <script type="text/javascript">
    window.opener.document.getElementById("fitbit_errormsg").innerHTML ='gibt es Synchronisationsfehler Daten FitBit';
    window.close();
    </script>
<?php
}
?>