<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);


if(isset($_POST['submit'])){

if($_POST["input"] == "1"){
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


    $db->insertPatient($name,$addr,($birthYear ."-". $birthMonth ."-". $birthDay),$phone,$eContact,($pRegisteredYear ."-".  $pRegisteredMonth ."-". $pRegisteredDay));
    
    

}else if($_POST["input"] == "2"){
    
    $patientId = $_POST['patientId'];
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

    $birthDate = ($birthYear ."-". $birthMonth ."-". $birthDay);
    $pRegisteredDate = ($pRegisteredYear ."-".  $pRegisteredMonth ."-". $pRegisteredDay) ;



    $query1 = $db->findPatient($patientId);
    $row = $query1->fetch();
    

        if (empty($name)){
            $name =  $row['patientName'];
        }

        if (empty($addr)){
            $addr =  $row['patientAddress'];
        }



        if (empty($birthYear)){
            $birthDate = $row['patientBirth'];

        }else if (empty($birthMonth)){
            $birthDate = $row['patientBirth'];

        }else if (empty($birthDay)){
            $birthDate = $row['patientBirth'];

        }



        if (empty($phone)){
            $phone = $row['patientPhone'];
        }

        if (empty($eContact)){
            $eContact = $row['emergencyContact'];
        }



        if (empty($pRegisteredYear)){
            $pRegisteredDate = $row['patientDateRegistered'];
        }else if (empty($pRegisteredMonth)){
            $pRegisteredDate = $row['patientDateRegistered'];
        }else if (empty($pRegisteredDay)){
            $pRegisteredDate = $row['patientDateRegistered'];
        }
        $db->resetQuery();
    
    $db->updatePatient($patientId, $name,$addr,$birthDate,$phone,$eContact,$pRegisteredDate);


}else if($_POST["input"] == "0"){
    $patientId = $_POST['patientId'];


    $db->deletePatient($patientId);


}
}
header("location: patientList.php");
exit();
?>