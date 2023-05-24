<?php
require_once '../classes/patientQuery.php';
require_once '../includes/errorHandlers.php';

$errorHand = new err();
$pat = new patientClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $patientId = $_POST['patientId'];
    
    if ($errorHand->isEmpty($patientId)){
        header("location: deletepatient.html?error=emptyInput". $patientId);
        exit();    
    }

    if ($errorHand->invalidId($patientId)){
        header("location: deletepatient.html?error=invalidId". $patientId);
        exit();    
    }

    $pat->deletePatient($patientId);


    header("location: patientlist.php?success=delete");
    exit(); 
}
?>