<?php
require_once '../includes/ORM.php';

class doctorClass extends MyOrm{
public function insertDoctor(string $doctorName, string $doctorAddress,string $doctorPhone, string $doctorPassword){
        

    $sql = $this->insert()
                ->into('doctor')
                ->values("(0 ,'".$doctorName."','".$doctorAddress."','".$doctorPhone."','".$doctorPassword."')")
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// update a doctor's information

public function updateDoctor(string $doctorId, string $doctorName, string $doctorAddress, string $doctorPhone, string $doctorPassword){
   

        try{
   
             $sql = $this->update('doctor')
                         ->set("doctorName = '". $doctorName ."', doctorAddress = '". $doctorAddress ."', doctorPhone = '". $doctorPhone ."', doctorPassword = '". $doctorPassword ."'")
                         ->where('doctorId')
                         ->isEqualTo($doctorId)
                         ->sc()
                         ->showQuery();
                

            $stmt = $this->connect()->query($sql);
             $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
             echo 'Errors encountered. ' .$e->getMessage();
            die();
    }

}


// delete a doctor
public function deleteDoctor($doctorId)
{   
    try{
    $sql = $this->delete()
                ->from('doctor')
                ->where('doctorId')
                ->isEqualTo($doctorId)
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e) {
        header("location: updateDoctor.html?error=invalidId=". $doctorId);
        exit();    
    }   
}

// find a doctor by id
public function findDoctor($filterValues)
{
    $sql = $this->select()
                ->from('doctor')
                ->where('doctorId')
                ->isEqualTo($filterValues)
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);

    return $stmt;
}

//goods
public function filterDoctor(string $filterValues){

    $sql = $this->select()
                ->from('doctor')
                ->where('CONCAT(doctorId, doctorName, doctorAddress, doctorPhone)')
                ->isLike($filterValues)
                ->sc()
                ->showQuery();


     $stmt = $this->connect()->query($sql);

    return $stmt;
}




public function getUser($variableUser, $variablePass){


    $names = $this->select()
                  ->from('doctor')
                  ->where('doctorName')
                  ->isEqualTo('"'.$variableUser.'"')
                  ->sc()
                  ->showQuery();

    $stmt = $this->connect()->query($names);
    $count = $stmt->rowCount();

         if($count == 0){ //check if user exist
              header("location: ../login.php?error=NoDoctorName" . $count);
              exit();
         }

    $user = $stmt->fetchAll();
    $password = $user[0]['doctorPassword'];


  

        if($password != $variablePass){
            header("location: ../login.php?eror=WrongPassword" . $variablePass . $password .  " 1 ");
            exit();
        }elseif($password == $variablePass){

            session_start();
            $_SESSION["userId"] = $user[0]["doctorId"];
            $_SESSION["userN"] = $user[0]["doctorName"];
            $_SESSION["isDoctor?"] = true;
            header("location: ../index.php?eror=none");
            exit();
        }
    

    $stmt = null;

    return false;
    }



}

?>
