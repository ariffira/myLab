<?php
if($status){    
?>
<script type="text/javascript">
    
    
    
    window.opener.document.getElementById("jawbone_link").click();
    window.close();

</script>

<?php
}
else{
    ?>
    <script type="text/javascript">
    window.opener.document.getElementById("jawbone_errormsg").innerHTML ='gibt es Synchronisationsfehler Daten Jawbone';
    window.close();
    </script>
<?php
}
?>