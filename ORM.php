<?php

declare(strict_types=1);

class MyOrm {
    private $dbString = '';
    private $connection = null;

    public function __construct(string $dbDriver, string $userName, string $passWord, bool $verbose = false) {
        try {
            $this->connection = new PDO($dbDriver, $userName, $passWord);
            if($verbose)
                echo "";
        } catch(PDOException $e) {
            echo 'Errors encountered. ' .$e->getMessage();
        }   
    }

    public function findPatient(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM patient WHERE patientId = '". $filterValues ."' ";
        $query_run = mysqli_query($connection, $sql);

        return $query_run;
    }


    public function insertPatient(string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){
        
        $sql = "INSERT INTO patient VALUES (0 ,'".$patientName."','".$patientAddress."','".$patientBirth."','". $patientPhone ."','". $emergencyContact ."','" . $patientDateRegistered .  "');";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    public function deletePatient(string $patientId){
        $sql = "DELETE FROM patient WHERE patientId=".$patientId.";";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
    }
          
    public function updatePatient(string $patientId, string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){
        $sql = "UPDATE patient SET patientName = '". $patientName ."', patientAddress = '". $patientAddress ."', patientBirth = '". $patientBirth ."', patientPhone = '". $patientPhone ."', emergencyContact = '". $emergencyContact ."', patientDateRegistered = '". $patientDateRegistered ."' WHERE (patientId = '".$patientId."');'";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    public function filterPatient(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM patient WHERE CONCAT(patientId,patientName,patientDateRegistered) LIKE '%$filterValues%' ";
        $query_run = mysqli_query($connection, $sql);

        return $query_run;
    }


    public function filterVisit(string $filterValues){
        $filterValue1 = null;
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM visit WHERE CONCAT(visitId,dateOfVisit,dateOfDischarge) LIKE '%$filterValues%' ";
        $query_run = mysqli_query($connection, $sql);

        if(mysqli_num_rows($query_run) == 0){
            $connection1 = mysqli_connect("localhost", "root", "", "hospital");
            $sql1 = "SELECT * FROM patient WHERE CONCAT(patientId,patientName,patientDateRegistered) LIKE '%$filterValues%' ";
            $query_run1 = mysqli_query($connection1, $sql1); 
            $row = mysqli_fetch_assoc($query_run1);

            $filterValue1 = $row['patientId'];

            $connection2 = mysqli_connect("localhost", "root", "", "hospital");
            $sql2 = "SELECT * FROM visit WHERE CONCAT(visitId,dateOfVisit,dateOfDischarge) LIKE '%$filterValue1%' ";
            $query_run2 = mysqli_query($connection2, $sql2);

            return $query_run2;
        }

        return $query_run;
    }

    public function findVisit(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM visit WHERE visitId = '". $filterValues ."' ";
        $query_run = mysqli_query($connection, $sql);

        return $query_run;
    }

    public function insertVisit(string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisitt, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){
        
        $sql = "INSERT INTO visit VALUES (0 ,'".$patientId."','".$patientType."','".$doctorId."','". $bedId ."','". $dateOfVisitt ."','" . $dateOfDischarge ."','".$symptoms."','".$disease."','".$treatment.  "');";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    
    public function deleteVisit(string $visitId){
        $sql = "DELETE FROM visit WHERE visitId=".$visitId.";";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
    }
    
    
    public function updateVisit(string $visitId, string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisit, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){
        
        $sql = "UPDATE visit SET patientId = '". $patientId ."', patientType = '". $patientType ."', doctorId = '". $doctorId ."', bedId = '". $bedId ."', dateOfVisit = '". $dateOfVisit ."', dateOfDischarge = '". $dateOfDischarge ."', symptoms = '". $symptoms ."', disease = '". $disease ."', treatment = '". $treatment ."' WHERE (patientId = '".$patientId."');'";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }
    


    public function insertDoctor(string $doctorName, string $doctorAddress,string $doctorPhone){
        
        $sql = "INSERT INTO doctor VALUES (0 ,'".$doctorName."','".$doctorAddress."','".$doctorPhone."');";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    // update a doctor's information
    
    public function updateDoctor(string $doctorId, string $doctorName, string $doctorAddress, string $doctorPhone){
        $sql = "UPDATE doctor SET doctorName = '". $doctorName ."', doctorAddress = '". $doctorAddress ."', doctorPhone = '". $doctorPhone ."' WHERE (doctorId = '".$doctorId."');'";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    
    // delete a doctor
    public function deleteDoctor($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM doctor WHERE doctorId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            if ($this->debug) {
                die("Delete failed: " . $e->getMessage());
            }
            return 0;
        }
    }
    
    // find a doctor by id
    public function findDoctor($filterValues)
    {
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM doctor WHERE doctorId = '". $filterValues ."' ";
        $query_run = mysqli_query($connection, $sql);

        return $query_run;
    }

    //goods
    public function filterDoctor(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM doctor WHERE CONCAT(doctorId, doctorName, doctorAddress, doctorPhone) LIKE '%$filterValues%' ";
        $query_run = mysqli_query($connection, $sql);
    
        return $query_run;
    }

    public function filterBed(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM bed WHERE CONCAT(bedId, bedName, ratePerday, bedtype) LIKE '%$filterValues%' ";
        $query_run = mysqli_query($connection, $sql);
    
        return $query_run;
    }


    
    }
    
    
    


    


    