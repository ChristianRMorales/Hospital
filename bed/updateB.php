<?php
require_once 'bedQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$bed = new bedClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){
    
    $bedId = $_POST['bedId'];
    $name = $_POST["bedName"];
    $bedRate = $_POST["ratePerDay"];
    $bedType = $_POST["bedType"];

    

    if ($errorHand->invalidId($bedId)){
        header("location: updatebed.html?error=invalidId=". $bedId);
        exit();    
    }

    $query1 = $bed->findbed($bedId);
    $row = $query1->fetch();
 
    
    if ($errorHand->invalidUId($name)){
        header("location: updatebed.html?error=invalidUserName=". $name);
        exit();    
    }


    if ($errorHand->isInt($bedRate)){
        header("location: updatebed.html?error=invalidRate=". $bedRate);
        exit();    
    }


    if ($errorHand->invalidUId($bedType)){
        header("location: updatebed.html?error=invalidTYPE=". $bedType);
        exit();    
    }

   

    
    if(empty($row)){
        header("location: updatebed.html?error=IdnotFound=". $bedId);
        exit();
   }else{
    


    if (empty($name)){
        $name = $row['bedName'];
    }

    if (empty($bedRate)){
        $bedRate = $row["ratePerDay"];
    }

    if (empty($bedType)){
        $bedType = $row['bedType'];
    }
    $bed->resetQuery();
    $bed->updatebed($bedId, $name, $bedRate, $bedType);

    }

    header("location: bedlist.php?success=delete");
    exit(); 

}
