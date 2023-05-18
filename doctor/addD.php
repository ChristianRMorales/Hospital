<?php
require_once 'doctorQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$doc = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];
    
    if ($errorHand->isEmpty($name)){
        header("location: addDoctor.html?error=emptyInput". $name);
        exit();    
    }



    $doc->insertDoctor($name, $addr, $phone);

    header("location: doctorlist.php?success=insert");
    exit(); 

}