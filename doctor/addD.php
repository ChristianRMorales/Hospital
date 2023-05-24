<?php
require_once 'doctorQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$doc = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];
    $password = $_POST["doctorPass"];

    if ($errorHand->invalidUId($name)){
        header("location: addDoctor.html?error=invalidName=". $name);
        exit();    
    }

    if ($errorHand->invalidUId($password)){
        header("location: addDoctor.html?error=invalidpassword=". $password);
        exit();    
    }

    $doctorSqlN = $doc->filterDoctor($name);
    $doctor = $doctorSqlN->fetch();
    $doctorName = $doctor['doctorName'];

 

    if($errorHand->pwdMatch(strtoupper($name), strtoupper($doctorName))){
        header("location: addDoctor.html?error=nameAlreadyExist". $name);
        exit(); 
    }
    $doc->resetQuery();

    $doctorSqlP = $doc->filterDoctor($name);
    $doctorP = $doctorSqlP->fetch();
    $doctorPhone = $doctor['doctorPhone'];

    if($errorHand->pwdMatch($phone, $doctorPhone)){
        header("location: addDoctor.html?error=phoneAlreadyExist". $phone);
        exit(); 
    }

    $doc->resetQuery();

    $doc->insertDoctor($name, $addr, $phone, $password);

    header("location: doctorlist.php?success=insert");
    exit(); 

}