<?php
require_once '../classes/userSignUpQ.php';
require_once '../includes/errorHandlers.php';

$err = new err();
$userSQ = new signUpQ('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

     if(isset($_POST['input'])){
        //signup
        $userN = $_POST['signUpUser'];
        $pass = $_POST['signUpPass'];
        $rPass = $_POST['repeatSignUpPass'];
        $email = $_POST['signUpEmail'];


        if($err->invalidUId($userN)){
            header("location: ../signUp.php?error=invalidUser");
            exit();   
        }


        if($err->invalidUId($pass)){
            header("location: ../signUp.php?error=invalidPass");
            exit();   
        }

        if($err->invalidUId($rPass)){
            header("location: ../signUp.php?error=invalidRPass");
            exit();   
        }

        if($err->pwdMatch($pass,$rPass) == false){
            header("location: ../signUp.php?error=passDoesNotMatch");
            exit();  
        }

        if($userSQ->checkUser($userN) == false ){
            header("location: ../signUp.php?error=userNameAlreadyExist");
            exit(); 
        }
        
        if($userSQ->checkEmail($email) == false ){
            header("location: ../signUp.php?error=userEmailAlreadyExist");
            exit(); 
        }


        $userSQ->addUser($userN, $pass, $email);





        header("location: ../login.php?error=none");
        exit(); 
    }



}

?> 