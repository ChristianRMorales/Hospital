<?php
require_once '../ORM.php';


class signUpQ extends MyOrm{

    


    public function checkUser($variable){

    $names = $this->select()
                  ->from('user')
                  ->where('userName')
                  ->isEqualTo('"'.$variable.'"')
                  ->sc()
                  ->showQuery();

    $stmt = $this->connect()->query($names);
    
    $count = $stmt->rowCount();

    $this->resetQuery();
        if($count > 0){
           
            return false;
        }else{
            return true;
        }
 
    }

    public function checkEmail($variable){

        $email = $this->select()
                      ->from("user")
                      ->where("email")
                      ->isEqualTo('"'.$variable.'"')
                      ->sc()
                      ->showQuery();
                      print($email);
        $stmt = $this->connect()->query($email);
        var_dump($stmt);
        $this->resetQuery();
            if($stmt->rowCount() > 0){
                return false;
            }else{
                return true;
            }
    
        }



    public function addUser($userName, $pass, $email){

        $sql = $this->insert()
                    ->into("user")
                    ->values("(0 ,'".$userName."','".$pass."','". $email .  "')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connect()->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->resetQuery();
            
    }


    }

?>