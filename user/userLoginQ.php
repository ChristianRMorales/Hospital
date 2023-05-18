<?php
require_once '../ORM.php';


class loginQ extends MyOrm{

    


    public function getUser($variableUser, $variablePass){


    $names = $this->select()
                  ->from('user')
                  ->where('userName')
                  ->isEqualTo('"'.$variableUser.'"')
                  ->sc()
                  ->showQuery();

    $stmt = $this->connect()->query($names);
    $count = $stmt->rowCount();

         if($count == 0){ //check if user exist
              header("location: ../login.php?error=NoUserName" . $count);
              exit();
         }

    $user = $stmt->fetchAll();
    $password = $user[0]['pass'];


  

        if($password != $variablePass){
            header("location: ../login.php?eror=WrongPassword" . $variablePass . $password .  " 1 ");
            exit();
        }elseif($password == $variablePass){

            session_start();
            $_SESSION["userId"] = $user[0]["userId"];
            $_SESSION["userN"] = $user[0]["userName"];
            header("location: ../index.php?eror=none");
            exit();
        }
    

    $stmt = null;

    return false;
    }







    }

?>