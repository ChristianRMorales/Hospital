<?php
require_once '../ORM.php';

class bedClass extends MyOrm{

public function filterBed(string $filterValues){
                    
    $sql = $this->select()
                   ->from('bed')
                   ->where('CONCAT(bedId, bedName, ratePerday, bedtype)')
                   ->isLike($filterValues)
                   ->sc()
                   ->showQuery();

   
                   $stmt = $this->connect()->query($sql);
   
                   return $stmt;

   }

   public function insertBed(string $bedName, string $ratePerDay,string $bedType){
       
   
       $sql = $this->insert()
                   ->into('bed')
                   ->values("(0 ,'".$bedName."','".$ratePerDay."','".$bedType."')")
                   ->sc()
                   ->showQuery();

                 $stmt = $this->connect()->query($sql);
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
       
       $stmt = $this->connect()->query($sql);
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

              $stmt = $this->connect()->query($sql);
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

               $stmt = $this->connect()->query($sql);
               return $stmt;;
   }



   
   }
   

?>