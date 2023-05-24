<?php
require_once 'patientQuery.php';
require_once '../errorHandlers.php';

$errorHand = new err();
$pat = new patientClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $name = $_POST["patientName"];
    $addr = $_POST["patientAddr"];
    $birthDate = $_POST["patientBirthDate"];
    $phone = $_POST["patientPhone"];
    $eContact = $_POST["patientEmergencyContact"];
    $pRegisteredDate = $_POST["patientRegisteredDate"];

 
    $patientSqlN = $pat->filterpatient($name);
    $patient = $patientSqlN->fetch();
    $patientName = $patient['patientName'];

    if($errorHand->invalidUId($name)){
        header("location: addpatient.html?error=invalidName=". $name);
        exit();
    }


    if($errorHand->isInt($phone)){
        header("location: addpatient.html?error=PhoneIsNotNumber=". $phone);
        exit();
    }
    if($errorHand->isInt($eContact)){
        header("location: addpatient.html?error=EContactNotNumber=". $eContact);
        exit();
    }
   


    if($errorHand->pwdMatch(strtoupper($name), strtoupper($patientName))){
        header("location: addpatient.html?error=nameAlreadyExist". $name);
        exit(); 
    }
    $pat->resetQuery();

    $patientSqlP = $pat->filterpatient($name);
    $patientP = $patientSqlP->fetch();
    $patientPhone = $patient['patientPhone'];

    if($errorHand->pwdMatch($phone, $patientPhone)){
        header("location: addpatient.html?error=phoneAlreadyExist". $phone);
        exit(); 
    }

    $pat->resetQuery();
    

    $pat->insertPatient($name,$addr,$birthDate,$phone,$eContact,$pRegisteredDate);
    


    header("location: patientlist.php?success=insert");
    exit(); 
}
?>