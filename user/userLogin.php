<?php
require_once 'userLoginQ.php';
require_once '../errorHandlers.php';

$err = new err();
$loginSQ = new loginQ('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

     if(isset($_POST['input'])){
        //signup
        $userN = $_POST['logUser'];
        $pass = $_POST['logPass'];
       


        if($err->invalidUId($userN)){
            header("location: ../login.php?error=invalidUser");
            exit();   
        }


        $loginSQ->getUser($userN, $pass);





        header("location: ../Index.php?error=none");
        exit(); 
    }



}

?> 