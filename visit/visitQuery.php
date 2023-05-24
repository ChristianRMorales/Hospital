<?php
require_once '../ORM.php';
require_once '../doctor/doctorQuery.php';
require_once '../bed/bedQuery.php';
require_once '../patient/patientQuery.php';


class visitClass extends MyOrm{

    public function callDoc(){
        $doc = new doctorClass('mysql:host=localhost;dbname=hospital','root', '', true);

        return $doc;
    }

    public function callBed(){
        $bed = new bedClass('mysql:host=localhost;dbname=hospital','root', '', true);

        return $bed;
    }

    public function callPat(){
        $pat = new patientClass('mysql:host=localhost;dbname=hospital','root', '', true);

        return $pat;
    }




    public function filterVisit(string $filterValues){

        $sqlNew = $this->select()
                    ->from('visit')
                    ->where('CONCAT(visitId,dateOfVisit,dateOfDischarge)')
                    ->isLike($filterValues)
                    ->sc()
                    ->showQuery();

    
  
        $query_run = $this->connect()->query($sqlNew);


        if($query_run->rowCount() <= 0){
            $this->resetQuery();

            $filteredPatient = $this->callPat()->filterPatient($filterValues);
            $row = $filteredPatient->fetch();
  
            if($filteredPatient->rowCount() <= 0){
                $this->resetQuery();

                $filteredBed = $this->callBed()->filterBed($filterValues);
                $row1 = $filteredBed->fetch();

                if($filteredBed->rowCount() <= 0){
                    $this->resetQuery();

                    $filteredDoctor = $this->callDoc()->filterDoctor($filterValues);
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

                     $query_run4 = $this->connect()->query($sql4);
    
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

                $query_run3 = $this->connect()->query($sql3); 
    
       
    
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
        
                $query_run2 = $this->connect()->query($sql2);               
    
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

        $query_run = $this->connect()->query($sql);

    return $query_run;
    }
 
    public function insertVisit(string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisitt, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment, string $completed, string $hasBed ){
        
        $sql = $this->insert()
                    ->into('visit')
                    ->values("(0 ,'".$patientId."','".$patientType."','".$doctorId."','". $bedId ."','". $dateOfVisitt ."','"  . $dateOfDischarge . "','"  .$symptoms."','"  .$disease."','"  .$treatment. "','"  .$completed. "','"  .$hasBed. "')")
                    ->sc()
                    ->showQuery();
        $stmt = $this->connect()->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
    public function deleteVisit(string $visitId){
        $sql = $this->delete()
        ->from('visit')
        ->where('visitId')
        ->isEqualTo($visitId)
        ->sc()
        ->showQuery();

        $stmt = $this->connect()->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function updateVisit(string $visitId, string $patientId, string $patientType, string $doctorId, string $bedId, string $dateOfVisit, string $dateOfDischarge,  string $symptoms, string $disease, string $treatment, string $completed, string $hasBed  ){

         $sql = $this->update('visit')
                    ->set("patientId = '". $patientId ."', patientType = '". $patientType ."', doctorId = '". $doctorId ."', bedId = '". $bedId ."', dateOfVisit = '". $dateOfVisit ."', dateOfDischarge = '". $dateOfDischarge ."', symptoms = '". $symptoms ."', disease = '". $disease ."', treatment = '". $treatment ."', completed = '". $completed ."', hasBed = '". $hasBed ."'")
                    ->where('visitId')
                    ->isEqualTo($visitId)
                    ->sc()
                    ->showQuery();
                    
         $stmt = $this->connect()->query($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    

        public function findVisitPatient(string $filterValues){
            $sql = $this->select()
            ->from('visit')
            ->where('patientId')
            ->isEqualTo($filterValues)
            ->sc()
            ->showQuery();

            $query_run = $this->connect()->query($sql);
    
        return $query_run;
        }

        public function findVisitHasBed(string $filterValues){
            $sql = $this->select()
            ->from('visit')
            ->where('hasBed')
            ->isEqualTo($filterValues)
            ->sc()
            ->showQuery();

            $query_run = $this->connect()->query($sql);
    
        return $query_run;
        }






}

?>
