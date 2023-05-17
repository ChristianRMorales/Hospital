<?php

require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){
if(isset($_POST["input"]) && $_POST["input"] == "1"){
    $name = $_POST["bedName"];
    $rate = $_POST["ratePerDay"];
    $bedType = $_POST["bedType"];

    $db->insertBed($name, $rate, $bedType);



} else if(isset($_POST["input"]) && $_POST["input"] == "2"){
    $bedId = $_POST['bedId'];
    $name = $_POST["bedName"];
    $rate = $_POST["ratePerDay"];
    $bedType = $_POST["bedType"];

    $query1 = $db->findBed($bedId);
    $row = $query1->fetch();

    if (empty($name)){
        $name = $row['bedName'];
    }

    if (empty($rate)){
        $rate = $row['ratePerDay'];
    }

    if (empty($bedType)){
        $bedType = $row['bedType'];
    }
    $db->resetQuery();
    $success = $db->updateBed($bedId, $name, $rate, $bedType);

    if($success == 1)
        echo 'SUCCESS update';
    else
        echo 'wrong update';

} else if(isset($_POST["input"]) && $_POST["input"] == "0"){
    $bedId = $_POST['bedId'];

    $db->deleteBed($bedId);


}
}
header("location: bedList.php");
exit();    
?>