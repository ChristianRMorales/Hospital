<?php
require_once 'bedQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$bed = new bedClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $name = $_POST["bedName"];
    $bedRate = $_POST["ratePerDay"];
    $bedType = $_POST["bedType"];
    
    if ($errorHand->invalidUId($name)){
        header("location: addbed.html?error=invalidName=". $name);
        exit();    
    }

    if ($errorHand->invalidUId($bedType)){
        header("location: addbed.html?error=invalidType=". $bedType);
        exit();    
    }


    if ($errorHand->isInt($bedRate)){
        header("location: addbed.html?error=invalidRate=". $bedRate);
        exit();    
    }


    $bedSqlN = $bed->filterbed($name);
    $bedN = $bedSqlN->fetch();
    $bedName = $bedN['bedName'];

 

    if($errorHand->pwdMatch(strtoupper($name), strtoupper($bedName))){
        header("location: addbed.html?error=nameAlreadyExist". $name);
        exit(); 
    }

    $bed->resetQuery();

    $bedSqlType = $bed->filterbed($name);
    $bedTypeCatch = $bedSqlType->fetch();
    $bedT = $bedTypeCatch['bedType'];

    if($errorHand->pwdMatch($bedType, $bedT)){
        header("location: addbed.html?error=TypeAlreadyExist=". $bedType);
        exit(); 
    }


    $bed->resetQuery();

    $bed->insertbed($name, $bedRate, $bedType);

    header("location: bedlist.php?success=insert");
    exit(); 

}