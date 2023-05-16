<?php

declare(strict_types=1);

class MyOrm {
    private $dbString = '';
    private $connection = null;

    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "hospital";

    protected function connectSQLI(){
        $mysqli = new mysqli($this->host,$this->user,$this->pwd,$this->dbName);

        return $mysqli;
    }

    public function establishDatabaseConnection() {
        return $this->connectSQLI();
    }
    
 

    public function select(array $fields = null): MyOrm {
        $this->dbString .= ' SELECT ';
            if($fields === null) {
             $fields = ' * ';
             $this->dbString .= $fields;
            } else {
             $arrayCount = count($fields)-1;
             $counter=0;
             foreach($fields as $field) {
                    $this->dbString .= $field;
                    if($counter < $arrayCount) 
                        $this->dbString .= ', ';
                 $counter++;
                }
            //$this->dbString .= ';';
            return $this;
        }
        return $this;
    }

    public function from(string $tableName): MyOrm {
        $this->dbString .= ' FROM ' .$tableName;
        return $this;
    }

    public function insert(): MyOrm {
        $this->dbString .= ' INSERT ';
        return $this;
    }

    public function update(string $tableName): MyOrm {
        $this->dbString .= ' UPDATE ' .$tableName;
        return $this;
    }

    public function set(string $variable): MyOrm {
        $this->dbString .= ' SET '. $variable;
        return $this;
    }

    

    public function into(string $tableName): MyOrm {
        $this->dbString .= ' INTO ' .$tableName;
        return $this;
    }

    
    public function where(string $colName): MyOrm {
        $this->dbString .= ' WHERE ' .$colName;
        return $this;
    }


    
    public function isEqualTo(string $variable): MyOrm {
        $this->dbString .= ' = ' . $variable;
        return $this;
    }

    public function isLike(string $variable): MyOrm {
        $this->dbString .= " LIKE '%$variable%' ";
        return $this;
    }

    public function delete(): MyOrm {
        $this->dbString .= ' DELETE ';
        return $this;
    }


    public function sc():MyOrm{
        $this->dbString .= ';';
        return $this;
    }

    public function showQuery(): string {
        return $this->dbString;
    }

    public function values(string $variable): MyOrm {
        $this->dbString .= " VALUES " . $variable;

        return $this;
    }




























    public function findPatient(string $filterValues){

        $sql = $this->select()
                    ->from('patient')
                    ->where('patientId')
                    ->isEqualTo($filterValues)
                    ->sc()
                    ->showQuery();

        $query_run = $this->connectSQLI()->query($sql);

        return $query_run;
    }


    public function insertPatient(string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){
        
        
        $sql = $this->insert()
                    ->into('patient')
                    ->values("(0 ,'".$patientName."','".$patientAddress."','".$patientBirth."','". $patientPhone ."','". $emergencyContact ."','" . $patientDateRegistered .  "')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }

    public function deletePatient(string $patientId){

        $sql = $this->delete()
                       ->from('patient')
                       ->where('patientId')
                       ->isEqualTo($patientId)
                       ->sc()
                       ->showQuery();

        $stmt = $this->connectSQLI()->query($sql);

        return 1;
    }
          
    public function updatePatient(string $patientId, string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){

        $sql = $this->update('patient')
                    ->set("patientName = '". $patientName ."', patientAddress = '". $patientAddress ."', patientBirth = '". $patientBirth ."', patientPhone = '". $patientPhone ."', emergencyContact = '". $emergencyContact ."', patientDateRegistered = '". $patientDateRegistered."'")
                    ->where('patientId')
                    ->isEqualTo($patientId)
                    ->sc()
                    ->showQuery();
                    
        print($sql);
        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }

    public function filterPatient(string $filterValues){

        $sqlNew = $this->select()
                       ->from('patient')
                       ->where("CONCAT(patientId, patientName, patientDateRegistered)")
                       ->isLike($filterValues)
                       ->sc()
                       ->showQuery();

       
        $query_run = $this->connectSQLI()->query($sqlNew);

        return $query_run;
    }








































    public function filterVisit(string $filterValues){
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM visit WHERE CONCAT(visitId,dateOfVisit,dateOfDischarge) LIKE '%$filterValues%' ";
        $query_run = mysqli_query($connection, $sql);

        if(mysqli_num_rows($query_run) <= 0){
            $filteredPatient = $this->filterPatient($filterValues);
            $row = mysqli_fetch_assoc($filteredPatient);

            if(mysqli_num_rows($filteredPatient) <= 0){
                $filteredBed = $this->filterBed($filterValues);
                $row1 = mysqli_fetch_assoc($filteredBed);

                if(mysqli_num_rows($filteredBed) <= 0){
                    $filteredDoctor = $this->filterDoctor($filterValues);
                    $row2 = mysqli_fetch_assoc($filteredDoctor);

                    if(mysqli_num_rows($filteredDoctor) <= 0){
                        return $query_run;
                    }

                    $filterValue3 = $row2['doctorId'];
    

                    $sql4 = "SELECT * FROM visit WHERE doctorId = '".$filterValue3."' ";
                    $query_run4 = mysqli_query( $connection, $sql4);
    
                    return $query_run4;
                }

                $filterValue2 = $row1['bedId'];
    

                $sql3 = "SELECT * FROM visit WHERE bedId = '".$filterValue2."' ";
                $query_run3 = mysqli_query( $connection, $sql3);
    
       
    
                return $query_run3;
            }
                
                
            
                $filterValue1 = $row['patientId'];

                $sql2 = "SELECT * FROM visit WHERE patientId = '".$filterValue1."' ";
                $query_run2 = mysqli_query( $connection, $sql2);
    
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

    public function insertBed(string $bedName, string $ratePerDay,string $bedType){
        
        $sql = "INSERT INTO bed VALUES (0 ,'".$bedName."','".$ratePerDay."','".$bedType."');";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    // update a doctor's information
    
    public function updateBed(string $bedId, string $bedName, string $ratePerDay,string $bedType){
        $sql = "UPDATE bed SET bedName = '". $bedName ."', ratePerDay = '". $ratePerDay ."', bedType = '". $bedType ."' WHERE (bedId= '".$bedId."');'";
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        return 1;
        }

    
    // delete a doctor
    public function deleteBed($id)
    {   
        if($id != 1){
        try {
            $stmt = $this->connection->prepare("DELETE FROM bed WHERE bedId = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            if ($this->debug) {
                die("Delete failed: " . $e->getMessage());
            }
            return 0;
        }
    }else{

    }
    }
    
    // find a doctor by id
    public function findBed($filterValues)
    {
        $connection = mysqli_connect("localhost", "root", "", "hospital");
        $sql = "SELECT * FROM bed WHERE bedId = '". $filterValues ."' ";
        $query_run = mysqli_query($connection, $sql);

        return $query_run;
    }
    
    }
    
    
    


    


    