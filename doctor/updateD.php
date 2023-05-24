<?php
require_once '../clases/doctorQuery.php';
require_once '../includes/errorHandlers.php';


$errorHand = new err();
$doc = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){
    
    $doctorId = $_POST['doctorId'];
    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];
    $password = $_POST["doctorPass"];
    

    if ($errorHand->invalidId($doctorId)){
        header("location: updateDoctor.html?error=invalidId=". $doctorId);
        exit();    
    }
    if ($errorHand->invalidUId($password)){
        header("location: updateDoctor.html?error=invalidpassword=". $password);
        exit();    
    }

    $query1 = $doc->findDoctor($doctorId);
    $row = $query1->fetch();
 

    if ($errorHand->invalidUId($name)){
        header("location: updateDoctor.html?error=invalidUserName=". $name);
        exit();    
    }

    if ($errorHand->invalidUId($addr)){
        header("location: updateDoctor.html?error=invalidAddress=". $addr);
        exit();    
    }

    if ($errorHand->isInt($phone)){
        header("location: updateDoctor.html?error=invalidPhone=". $phone);
        exit();    
    }

    if(empty($row)){
        header("location: updateDoctor.html?error=IdnotFound=". $doctorId);
        exit();
   }else{
    


    if (empty($name)){
        $name = $row['doctorName'];
    }

    if (empty($addr)){
        $addr = $row['doctorAddress'];
    }

    if (empty($phone)){
        $phone = $row['doctorPhone'];
    }
    $doc->resetQuery();
    $doc->updateDoctor($doctorId, $name, $addr, $phone, $password);

}

    header("location: doctorlist.php?success=delete");
    exit(); 

}
