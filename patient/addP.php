<?php
require_once 'patientQuery.php';
require_once '../errorHandlers.php';

$errorHand = new err();
$pat = new patientClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $name = $_POST["patientName"];
    $addr = $_POST["patientAddr"];
    $birthYear = $_POST["patientBirthYear"];
    $birthMonth = $_POST["patientBirthMonth"];
    $birthDay = $_POST["patientBirthDay"];
    $phone = $_POST["patientPhone"];
    $eContact = $_POST["patientEmergencyContact"];
    $pRegisteredYear = $_POST["patientRegisteredYear"];
    $pRegisteredMonth = $_POST["patientRegisteredMonth"];
    $pRegisteredDay = $_POST["patientRegisteredDay"];

 
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
    if($errorHand->isInt(($birthYear . $birthMonth . $birthDay))){
        header("location: addpatient.html?error=dateIsNotNumber=". ($birthYear . $birthMonth . $birthDay));
        exit();
    }

    if($errorHand->isInt(($$pRegisteredYear . $$pRegisteredMonth . $$pRegisteredDay))){
        header("location: addpatient.html?error=dateIsNotNumber=". ($$pRegisteredYear . $$pRegisteredMonth . $$pRegisteredDay));
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
    

    $pat->insertPatient($name,$addr,($birthYear ."-". $birthMonth ."-". $birthDay),$phone,$eContact,($pRegisteredYear ."-".  $pRegisteredMonth ."-". $pRegisteredDay));
    


    header("location: patientlist.php?success=insert");
    exit(); 
}
?>