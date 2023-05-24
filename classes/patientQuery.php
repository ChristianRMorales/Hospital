<?php

require_once '../includes/ORM.php';

class patientClass extends MyOrm{



public function findPatient(string $filterValues){

    $sql = $this->select()
                ->from('patient')
                ->where('patientId')
                ->isEqualTo($filterValues)
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);
 
    return $stmt;
}


public function insertPatient(string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){
    
    
    $sql = $this->insert()
                ->into('patient')
                ->values("(0 ,'".$patientName."','".$patientAddress."','".$patientBirth."','". $patientPhone ."','". $emergencyContact ."','" . $patientDateRegistered .  "')")
                ->sc()
                ->showQuery();

    $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

public function deletePatient(string $patientId){

    $sql = $this->delete()
                   ->from('patient')
                   ->where('patientId')
                   ->isEqualTo($patientId)
                   ->sc()
                   ->showQuery();

       $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);


}
      
public function updatePatient(string $patientId, string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){

    $sql = $this->update('patient')
                ->set("patientName = '". $patientName ."', patientAddress = '". $patientAddress ."', patientBirth = '". $patientBirth ."', patientPhone = '". $patientPhone ."', emergencyContact = '". $emergencyContact ."', patientDateRegistered = '". $patientDateRegistered."'")
                ->where('patientId')
                ->isEqualTo($patientId)
                ->sc()
                ->showQuery();
                

       $stmt = $this->connect()->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

public function filterPatient(string $filterValues){

    $sql = $this->select()
                   ->from('patient')
                   ->where("CONCAT(patientId, patientName, patientDateRegistered)")
                   ->isLike($filterValues)
                   ->sc()
                   ->showQuery();

      $stmt = $this->connect()->query($sql);
    

   

    return $stmt;
}



}
?>