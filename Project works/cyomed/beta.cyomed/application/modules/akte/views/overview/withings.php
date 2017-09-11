<?php
if($status){    
?>
<script type="text/javascript">
    
    
    
    window.opener.document.getElementById("withings_link").click();
    window.close();

</script>

<?php
}
else{
    ?>
    <script type="text/javascript">
    window.opener.document.getElementById("withingdata_errormsg").innerHTML ='gibt es Synchronisationsfehler Daten withings';
    window.close();
    </script>
<?php
}
?>