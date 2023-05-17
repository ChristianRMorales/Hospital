<?php
require_once '../ORM.php';
$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);


if(isset($_POST["input"]) && $_POST["input"] == "1"){
    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];

    $db->insertDoctor($name, $addr, $phone);



} else if(isset($_POST["input"]) && $_POST["input"] == "2"){
    $doctorId = $_POST['doctorId'];
    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];

    $query1 = $db->findDoctor($doctorId);
    $row = $query1->fetch();

    if (empty($name)){
        $name = $row['doctorName'];
    }

    if (empty($addr)){
        $addr = $row['doctorAddress'];
    }

    if (empty($phone)){
        $phone = $row['doctorPhone'];
    }
    $db->resetQuery();
    $db->updateDoctor($doctorId, $name, $addr, $phone);



} else if(isset($_POST["input"]) && $_POST["input"] == "0"){
    $doctorId = $_POST['doctorId'];

    $db->deleteDoctor($doctorId);


}
header("location: doctorList.php");
exit();    
?>
