<?php

declare(strict_types=1);

class MyOrm {
    private $dbString = '';
    private $connection = null;

    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "hospital";

    public function __construct(string $dbDriver, string $userName, string $passWord, bool $verbose = false) {
        try {
            $this->connection = new PDO($dbDriver, $userName, $passWord);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Errors encountered. ' .$e->getMessage();
        }   
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

    public function resetQuery(): string {
        $this->dbString = " ";
        return $this->dbString;
    }




    public function isValidId($id){
        $result = null;

        if(!preg_match("/^[a-zA-Z0-100]*$/", $id)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }























    public function findPatient(string $filterValues){

        $sql = $this->select()
                    ->from('patient')
                    ->where('patientId')
                    ->isEqualTo($filterValues)
                    ->sc()
                    ->showQuery();

        $stmt = $this->connection->query($sql);
     
        return $stmt;
    }


    public function insertPatient(string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){
        
        
        $sql = $this->insert()
                    ->into('patient')
                    ->values("(0 ,'".$patientName."','".$patientAddress."','".$patientBirth."','". $patientPhone ."','". $emergencyContact ."','" . $patientDateRegistered .  "')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

 
        }

    public function deletePatient(string $patientId){

        $sql = $this->delete()
                       ->from('patient')
                       ->where('patientId')
                       ->isEqualTo($patientId)
                       ->sc()
                       ->showQuery();

        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

 
    }
          
    public function updatePatient(string $patientId, string $patientName, string $patientAddress, string $patientBirth, string $patientPhone, string $emergencyContact, string $patientDateRegistered ){

        $sql = $this->update('patient')
                    ->set("patientName = '". $patientName ."', patientAddress = '". $patientAddress ."', patientBirth = '". $patientBirth ."', patientPhone = '". $patientPhone ."', emergencyContact = '". $emergencyContact ."', patientDateRegistered = '". $patientDateRegistered."'")
                    ->where('patientId')
                    ->isEqualTo($patientId)
                    ->sc()
                    ->showQuery();
                    

        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);

        }

    public function filterPatient(string $filterValues){

        $sql = $this->select()
                       ->from('patient')
                       ->where("CONCAT(patientId, patientName, patientDateRegistered)")
                       ->isLike($filterValues)
                       ->sc()
                       ->showQuery();

        $stmt = $this->connection->query($sql);
        

       

        return $stmt;
    }








































    public function filterVisit(string $filterValues){

        $sqlNew = $this->select()
                    ->from('visit')
                    ->where('CONCAT(visitId,dateOfVisit,dateOfDischarge)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
  
        $query_run = $this->connection->query($sqlNew);


        if($query_run->rowCount() <= 0){
            $this->resetQuery();

            $filteredPatient = $this->filterPatient($filterValues);
            $row = $filteredPatient->fetch();
  
            if($filteredPatient->rowCount() <= 0){
                $this->resetQuery();

                $filteredBed = $this->filterBed($filterValues);
                $row1 = $filteredBed->fetch();

                if($filteredBed->rowCount() <= 0){
                    $this->resetQuery();

                    $filteredDoctor = $this->filterDoctor($filterValues);
                    $row2 = $filteredDoctor->fetch();

                    if($filteredDoctor->rowCount() <= 0){
                        return $query_run;
                    }

                    $filterValue3 = (string)$row2['doctorId'];

                    $this->resetQuery();


                    $sql4 = $this->select()
                                 ->from('visit')
                                 ->where('doctorId')
                                 ->isEqualTo($filterValue3)
                                 ->sc()
                                 ->showQuery();

                     $query_run4 = $this->connection->query($sql4);
    
                    return $query_run4;
                }

                $filterValue2 = (string)$row1['bedId'];
           
                $this->resetQuery();


                $sql3 = $this->select()
                                 ->from('visit')
                                 ->where('bedId')
                                 ->isEqualTo($filterValue2)
                                 ->sc()
                                 ->showQuery();

                $query_run3 = $this->connection->query($sql3); 
    
       
    
                return $query_run3;
            }
                
                
            
                $filterValue1 = (string)$row['patientId'];
            
                
                $this->resetQuery();

                $sql2 = $this->select()
                                 ->from('visit')
                                 ->where('patientId')
                                 ->isEqualTo($filterValue1)
                                 ->sc()
                                 ->showQuery();
        
                $query_run2 = $this->connection->query($sql2);                
    
                return $query_run2;
         
        }

        return $query_run;
    }

    public function findVisit(string $filterValues){
        $sql = $this->select()
        ->from('visit')
        ->where('visitId')
        ->isEqualTo($filterValues)
        ->sc()
        ->showQuery();

        $query_run = $this->connection->query($sql);

    return $query_run;
    }
 
    public function insertVisit(string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisitt, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){
        
        $sql = $this->insert()
                    ->into('visit')
                    ->values("(0 ,'".$patientId."','".$patientType."','".$doctorId."','". $bedId ."','". $dateOfVisitt ."','"  . $dateOfDischarge . "','"  .$symptoms."','"  .$disease."','"  .$treatment. "')")
                    ->sc()
                    ->showQuery();
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
    public function deleteVisit(string $visitId){
        $sql = $this->delete()
        ->from('visit')
        ->where('visitId')
        ->isEqualTo($visitId)
        ->sc()
        ->showQuery();

        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function updateVisit(string $visitId, string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisit, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){

         $sql = $this->update('visit')
                    ->set("patientId = '". $patientId ."', patientType = '". $patientType ."', doctorId = '". $doctorId ."', bedId = '". $bedId ."', dateOfVisit = '". $dateOfVisit ."', dateOfDischarge = '". $dateOfDischarge ."', symptoms = '". $symptoms ."', disease = '". $disease ."', treatment = '". $treatment ."'")
                    ->where('visitId')
                    ->isEqualTo($visitId)
                    ->sc()
                    ->showQuery();
                    
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    






























    public function insertDoctor(string $doctorName, string $doctorAddress,string $doctorPhone){
        

        $sql = $this->insert()
                    ->into('doctor')
                    ->values("(0 ,'".$doctorName."','".$doctorAddress."','".$doctorPhone."')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connection->query($sql);
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
                    

        $stmt = $this->connection->query($sql);
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

    $stmt = $this->connection->query($sql);
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

        $stmt = $this->connection->query($sql);

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

    
        $stmt = $this->connection->query($sql);
    
        return $stmt;
    }



































    public function filterBed(string $filterValues){
                    
     $sql = $this->select()
                    ->from('bed')
                    ->where('CONCAT(bedId, bedName, ratePerday, bedtype)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
                    $stmt = $this->connection->query($sql);
    
                    return $stmt;

    }

    public function insertBed(string $bedName, string $ratePerDay,string $bedType){
        
    
        $sql = $this->insert()
                    ->into('bed')
                    ->values("(0 ,'".$bedName."','".$ratePerDay."','".$bedType."')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    // update a doctor's information
    
    public function updateBed(string $bedId, string $bedName, string $ratePerDay,string $bedType){


        $sql = $this->update('bed')
        ->set("bedName = '". $bedName ."', ratePerDay = '". $ratePerDay ."', bedType = '". $bedType ."'")
        ->where('bedId')
        ->isEqualTo($bedId)
        ->sc()
        ->showQuery();
        
        $stmt = $this->connection->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
    // delete a doctor
    public function deleteBed($bedId)
    {   
        $sql = $this->delete()
        ->from('bed')
        ->where('bedId')
        ->isEqualTo($bedId)
        ->sc()
        ->showQuery();

    $stmt = $this->connection->query($sql);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // find a doctor by id
    public function findBed($filterValues)
    {
        $sql = $this->select()
                ->from('bed')
                ->where('bedId')
                ->isEqualTo($filterValues)
                ->sc()
                ->showQuery();

                $stmt = $this->connection->query($sql);
    
                return $stmt;;
    }
    
    }
    
    
    


    


    