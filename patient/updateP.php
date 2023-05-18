<?php
require_once 'patientQuery.php';
require_once '../errorHandlers.php';
    
$errorHand = new err();
$pat = new patientClass('mysql:host=localhost;dbname=hospital','root', '', true);
    

if(isset($_POST['submit'])){
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



    if ($errorHand->invalidId($patientId)){
        header("location: updatepatient.html?error=invalidId=". $patientId);
        exit();    
    }

    $query1 = $pat->findpatient($patientId);
    $row = $query1->fetch();
 

    if ($errorHand->invalidUId($name)){
        header("location: updatepatient.html?error=invalidUserName=". $name);
        exit();    
    }

    if ($errorHand->invalidUId($addr)){
        header("location: updatepatient.html?error=invalidAddress=". $addr);
        exit();    
    }

    if ($errorHand->isInt($phone)){
        header("location: updatepatient.html?error=invalidPhone=". $phone);
        exit();    
    }

    if ($errorHand->isInt($eContact)){
        header("location: updatepatient.html?error=invalideContact=". $eContact);
        exit();    
    }

    if ($errorHand->isInt($birthYear . $birthMonth . $birthDay)){
        header("location: updatepatient.html?error=invalidbirthDate=". $birthDate);
        exit();    
    }

    if ($errorHand->isInt($pRegisteredYear . $pRegisteredMonth . $pRegisteredDay)){
        header("location: updatepatient.html?error=invalidRegisteredDate=". $pRegisteredDate);
        exit();    
    }
    
    if(empty($row)){
        header("location: updatePatient.html?error=IdnotFound=". $patientId);
        exit();
   }else{

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
        $pat->resetQuery();
    
        $pat->updatePatient($patientId, $name,$addr,$birthDate,$phone,$eContact,$pRegisteredDate);


        header("location: patientlist.php?success=update");
        exit(); 
    
    }
    }

    header("location: patientlist.php?error=");
    exit(); 
?>