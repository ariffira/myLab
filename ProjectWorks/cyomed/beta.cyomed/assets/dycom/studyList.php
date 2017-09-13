<?php 
$json = array(
     'studyList' => array(
       array(  "patientName"=>"",
         "patientId" => "832040",
         "studyDate" => "",
         "modality" => "MR",
         "studyDescription" => "",
         "numImages" => 16,
         "studyId" => "mrstudy"
         )
         ) 
     );
echo json_encode($json);
exit();

?>