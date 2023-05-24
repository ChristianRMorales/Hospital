<?php
require_once '../classes/doctorQuery.php';
require_once '../includes/errorHandlers.php';

$errorHand = new err();
$doc = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){
    
    $doctorId = $_POST['doctorId'];

    if ($errorHand->isEmpty($doctorId)){
        header("location: deleteDoctor.html?error=emptyInput". $doctorId);
        exit();    
    }

    if ($errorHand->invalidId($doctorId)){
        header("location: deleteDoctor.html?error=invalidId". $doctorId);
        exit();    
    }

    $doc->deleteDoctor($doctorId);

    header("location: doctorlist.php?success=delete");
    exit(); 

}
