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

    public function resetQuery(): string {
        $this->dbString = " ";
        return $this->dbString;
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

        print($sqlNew); 
        $query_run = $this->connectSQLI()->query($sqlNew);

        return $query_run;
    }








































    public function filterVisit(string $filterValues){

        $sqlNew = $this->select()
                    ->from('visit')
                    ->where('CONCAT(visitId,dateOfVisit,dateOfDischarge)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
        $query_run = $this->connectSQLI()->query($sqlNew);



        if(mysqli_num_rows($query_run) <= 0){
            $this->resetQuery();

            $filteredPatient = $this->filterPatient($filterValues);
            $row = mysqli_fetch_assoc($filteredPatient);

            if(mysqli_num_rows($filteredPatient) <= 0){
                $this->resetQuery();

                $filteredBed = $this->filterBed($filterValues);
                $row1 = mysqli_fetch_assoc($filteredBed);

                if(mysqli_num_rows($filteredBed) <= 0){
                    $this->resetQuery();

                    $filteredDoctor = $this->filterDoctor($filterValues);
                    $row2 = mysqli_fetch_assoc($filteredDoctor);

                    if(mysqli_num_rows($filteredDoctor) <= 0){
                        return $query_run;
                    }

                    $filterValue3 = $row2['doctorId'];
                    $this->resetQuery();

                    $sql4 = "SELECT * FROM visit WHERE doctorId = '".$filterValue3."' ";

                    $sql4 = $this->select()
                                 ->from('visit')
                                 ->where('doctorId')
                                 ->isEqualTo($filterValue3)
                                 ->sc()
                                 ->showQuery();

                     $query_run4 = $this->connectSQLI()->query($sql4);
    
                    return $query_run4;
                }

                $filterValue2 = $row1['bedId'];
                $this->resetQuery();

                $sql3 = "SELECT * FROM visit WHERE bedId = '".$filterValue2."' ";

                $sql3 = $this->select()
                                 ->from('visit')
                                 ->where('bedId')
                                 ->isEqualTo($filterValue2)
                                 ->sc()
                                 ->showQuery();

                $query_run3 = $this->connectSQLI()->query($sql3);
    
       
    
                return $query_run3;
            }
                
                
            
                $filterValue1 = $row['patientId'];
                $this->resetQuery();

                $sql2 = "SELECT * FROM visit WHERE patientId = '".$filterValue1."' ";

                $sql2 = $this->select()
                                 ->from('visit')
                                 ->where('patientId')
                                 ->isEqualTo($filterValue1)
                                 ->sc()
                                 ->showQuery();
             
                $query_run2 = $this->connectSQLI()->query($sql2);                
    
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

$query_run = $this->connectSQLI()->query($sql);

return $query_run;
    }
 
    public function insertVisit(string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisitt, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){
        
        $sql = $this->insert()
                    ->into('visit')
                    ->values("(0 ,'".$patientId."','".$patientType."','".$doctorId."','". $bedId ."','". $dateOfVisitt ."','"  . $dateOfDischarge . "','"  .$symptoms."','"  .$disease."','"  .$treatment. "')")
                    ->sc()
                    ->showQuery();
        print($sql);
        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }

    
    public function deleteVisit(string $visitId){
        $sql = $this->delete()
        ->from('visit')
        ->where('visitId')
        ->isEqualTo($visitId)
        ->sc()
        ->showQuery();

$stmt = $this->connectSQLI()->query($sql);
        return 1;
    }
    
    
    public function updateVisit(string $visitId, string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisit, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment ){

         $sql = $this->update('visit')
                    ->set("patientId = '". $patientId ."', patientType = '". $patientType ."', doctorId = '". $doctorId ."', bedId = '". $bedId ."', dateOfVisit = '". $dateOfVisit ."', dateOfDischarge = '". $dateOfDischarge ."', symptoms = '". $symptoms ."', disease = '". $disease ."', treatment = '". $treatment ."'")
                    ->where('visitId')
                    ->isEqualTo($visitId)
                    ->sc()
                    ->showQuery();
                    
        print($sql);
        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }
    






























    public function insertDoctor(string $doctorName, string $doctorAddress,string $doctorPhone){
        

        $sql = $this->insert()
                    ->into('doctor')
                    ->values("(0 ,'".$doctorName."','".$doctorAddress."','".$doctorPhone."')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }

    // update a doctor's information
    
    public function updateDoctor(string $doctorId, string $doctorName, string $doctorAddress, string $doctorPhone){
        $sql = $this->update('doctor')
                    ->set("doctorName = '". $doctorName ."', doctorAddress = '". $doctorAddress ."', doctorPhone = '". $doctorPhone ."'")
                    ->where('doctorId')
                    ->isEqualTo($doctorId)
                    ->sc()
                    ->showQuery();
                    

        $stmt = $this->connectSQLI()->query($sql);
        return 1;
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

$stmt = $this->connectSQLI()->query($sql);
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

            $query_run = $this->connectSQLI()->query($sql);

        return $query_run;
    }

    //goods
    public function filterDoctor(string $filterValues){

        $sqlNew = $this->select()
                    ->from('doctor')
                    ->where('CONCAT(doctorId, doctorName, doctorAddress, doctorPhone)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
     $query_run = $this->connectSQLI()->query($sqlNew);
    
        return $query_run;
    }



































    public function filterBed(string $filterValues){
                    
     $sqlNew = $this->select()
                    ->from('bed')
                    ->where('CONCAT(bedId, bedName, ratePerday, bedtype)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
     $query_run = $this->connectSQLI()->query($sqlNew);

     return $query_run;

    }

    public function insertBed(string $bedName, string $ratePerDay,string $bedType){
        
    
        $sql = $this->insert()
                    ->into('bed')
                    ->values("(0 ,'".$bedName."','".$ratePerDay."','".$bedType."')")
                    ->sc()
                    ->showQuery();

        $stmt = $this->connectSQLI()->query($sql);

        return 1;
        }

    // update a doctor's information
    
    public function updateBed(string $bedId, string $bedName, string $ratePerDay,string $bedType){


        $sql = $this->update('bed')
        ->set("bedName = '". $bedName ."', ratePerDay = '". $ratePerDay ."', bedType = '". $bedType ."'")
        ->where('bedId')
        ->isEqualTo($bedId)
        ->sc()
        ->showQuery();
        
print($sql);
$stmt = $this->connectSQLI()->query($sql);
        return 1;
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

$stmt = $this->connectSQLI()->query($sql);
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

            $query_run = $this->connectSQLI()->query($sql);

        return $query_run;
    }
    
    }
    
    
    


    


    