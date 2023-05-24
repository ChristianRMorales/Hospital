<?php
require_once '../classes/userLoginQ.php';
require_once '../classes/doctorQuery.php';
require_once '../includes/errorHandlers.php';

$err = new err();
$loginSQ = new loginQ('mysql:host=localhost;dbname=hospital','root', '', true);
$loginDoctorSQ = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){


        //signup
        $userN = $_POST['logUser'];
        $pass = $_POST['logPass'];
        $loginValue = $_POST['loginValue'];


        if($err->invalidUId($userN)){
            header("location: ../login.php?error=invalidUser");
            exit();   
        }

        if($loginValue == 0){

        $loginSQ->getUser($userN, $pass);
        }else{
       
        $loginDoctorSQ->getUser($userN, $pass);
        }
  



        header("location: ../Index.php?error=none");
        exit(); 
    



}

?> 