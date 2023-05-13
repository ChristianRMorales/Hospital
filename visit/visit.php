<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);



if($_POST["input"] == "1"){
    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
    $dateOfVisit = ($_POST['dateOfVisitYear'] . "-" . $_POST['dateOfVisitMonth'] . "-" .$_POST['dateOfVisitDay']);
    $dateOfDischarge = ($_POST['dateOfDischargeYear'] . "-" . $_POST['dateOfDischargeMonth'] . "-" .$_POST['dateOfDischargeDay']);
    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $treatment = $_POST['treatment'];

    $success = $db->insertVisit( $patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment);

     
    if($success == 1)
        echo 'SUCCESS INSERT';
    else
        echo 'wrong INSERT';

}   

  

header("location: visitList.php");
exit();       
?>