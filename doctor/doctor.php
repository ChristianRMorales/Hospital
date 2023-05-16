<?php
require_once '../ORM.php';

$db = new MyOrm();

if(isset($_POST["input"]) && $_POST["input"] == "1"){
    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];

    $success = $db->insertDoctor($name, $addr, $phone);

    if($success == 1)
        echo 'SUCCESS INSERT';
    else
        echo 'wrong INSERT';

} else if(isset($_POST["input"]) && $_POST["input"] == "2"){
    $doctorId = $_POST['doctorId'];
    $name = $_POST["doctorName"];
    $addr = $_POST["doctorAddress"];
    $phone = $_POST["doctorPhone"];

    $query1 = $db->findDoctor($doctorId);
    $row = mysqli_fetch_assoc($query1);

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
    $success = $db->updateDoctor($doctorId, $name, $addr, $phone);

    if($success == 1)
        echo 'SUCCESS update';
    else
        echo 'wrong update';

} else if(isset($_POST["input"]) && $_POST["input"] == "0"){
    $doctorId = $_POST['doctorId'];

    $success = $db->deleteDoctor($doctorId);

    if($success == 1)
        echo 'SUCCESS Delete';
    else
        echo 'wrong Delete';
}
header("location: doctorList.php");
exit();    
?>
