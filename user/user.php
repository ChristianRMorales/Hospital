<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    if($_POST['input'] == 1){
        //Login


    }else if($_POST['input'] == 2){
        //signup
        $user = $_POST['signUpUser'];
        $pass = $_POST['signUpPass'];
        $rPass = $_POST['repeatSignUpPass'];
        $email = $_POST['signUpEmail'];

    }
}

?> 