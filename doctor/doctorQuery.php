<?php
require_once '../ORM.php';

class doctorClass extends MyOrm{
public function insertDoctor(string $doctorName, string $doctorAddress,string $doctorPhone){
        

    $sql = $this->insert()
                ->into('doctor')
                ->values("(0 ,'".$doctorName."','".$doctorAddress."','".$doctorPhone."')")
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// update a doctor's information

public function updateDoctor(string $doctorId, string $doctorName, string $doctorAddress, string $doctorPhone){
    $sql = $this->update('doctor')
                ->set("doctorName = '". $doctorName ."', doctorAddress = '". $doctorAddress ."', doctorPhone = '". $doctorPhone ."'")
                ->where('doctorId')
                ->isEqualTo($doctorId)
                ->sc()
                ->showQuery();
                

    $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


// delete a doctor
public function deleteDoctor($doctorId)
{
    $sql = $this->delete()
    ->from('doctor')
    ->where('doctorId')
    ->isEqualTo($doctorId)
    ->sc()
    ->showQuery();

 $stmt = $this->connect()->query($sql);
$stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

?>
