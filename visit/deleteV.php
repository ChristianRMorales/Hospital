<?php
require_once '../classes/visitQuery.php';
require_once '../includes/errorHandlers.php';

$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $visitId = $_POST['visitId'];
    
    if ($errorHand->isEmpty($visitId)){
        header("location: deletevisit.html?error=emptyInput". $visitId);
        exit();    
    }

    if ($errorHand->invalidId($visitId)){
        header("location: deletevisit.html?error=invalidId". $visitId);
        exit();    
    }

    $vis->deletevisit($visitId);


    header("location: visitlist.php?success=delete");
    exit(); 
}
?>