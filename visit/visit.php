<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);



if($_POST["input"] == "1"){
    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];

}










?>