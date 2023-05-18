<?php
require_once 'bedQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$bed = new bedClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){
    
    $bedId = $_POST['bedId'];

    if ($errorHand->isEmpty($bedId)){
        header("location: deletebed.html?error=emptyInput". $bedId);
        exit();    
    }

    if ($errorHand->invalidId($bedId)){
        header("location: deletebed.html?error=invalidId". $bedId);
        exit();    
    }

    $bed->deletebed($bedId);

    header("location: bedlist.php?success=delete");
    exit(); 

}
