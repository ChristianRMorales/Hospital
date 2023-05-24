<?php
require_once '../classes/visitQuery.php';
require_once '../includes/errorHandlers.php';


$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $visitId = $_POST['visitId'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
   

    if ($errorHand->invalidId($patientId)){
        header("location: updateVisitBed.php?error=invalidPatientId=". $patientId);
        exit();    
    } 
    if ($errorHand->invalidUId($patientType)){
        header("location: updateVisitBed.php?error=invalidPatientType=". $patientType);
        exit();    
    }

    if ($errorHand->invalidId($doctorId)){
        header("location: updateVisitBed.php?error=invalidDoctorId=". $doctortId);
        exit();    
    }

    if ($errorHand->invalidId($bedId)){
        header("location: updateVisitBed.php?error=invalidBedId=". $bedtId);
        exit();    
    }


    if($patientId != null){
    $query1 = $vis->callPat()->findPatient($patientId);
    $row1 = $query1->fetch();
    if(empty($row1)){
        header("location: updateVisitBed.php?error=invalidpatientIdDoesNotExist=". $patienttId);
        exit();
    }

    $vis->resetQuery();
    }

    if($doctorId != null){
    $query2 = $vis->callDoc()->findDoctor($doctorId);
    $row2 = $query2->fetch();

    if(empty($row2)){
        header("location: updateVisitBed.php?error=invalidDoctorIdDoesNotExist=". $doctorId);
        exit();
    }

    $vis->resetQuery();
    }

    if($bedId != null){
    $query3 = $vis->callBed()->findBed($bedId);
    $row3 = $query3->fetch();

    if(empty($row3)){
        header("location: updateVisitBed.php?error=invalidbedIdDoesNotExist=". $bedId);
        exit();
    }

    $vis->resetQuery();
    }


  



    if ($errorHand->invalidUId($symptoms)){
        header("location: updateVisitBed.php?error=invalidSymptoms=".  $symptoms);
        exit();    
    }



    if ($errorHand->invalidUId($disease)){
        header("location: updateVisitBed.php?error=invalidDisease=". $disease);
        exit();    
    }


    if ($errorHand->invalidUId($treatment)){
        header("location: updateVisitBed.php?error=invalidTreatment=". $treatment);
        exit();    
    }







    $query4 = $vis->findVisit($visitId);
    $row = $query4->fetch();


    if(empty($row)){
        header("location: updateVisitBed.php.php?error=IdnotFound=". $visitId);
        exit();
   }else{
        if (empty($patientId)){
            $patientId = $row['patientId'];
        }

        if (empty($patientType)){
            $patientType = $row['patientType'];
        }

        if (empty($doctorId)){
            $doctorId = $row['doctorId'];
        }

        if (empty($bedId)){
            $bedId = $row['bedId'];
        }



        if (empty($_POST['dateOfVisitYear'])){
            $dateOfVisit = $row['dateOfVisit'];

        }else if (empty($_POST['dateOfVisitMonth'])){
            $dateOfVisit = $row['dateOfVisit'];

        }else if (empty($_POST['dateOfVisitDay'])){
            $dateOfVisit = $row['dateOfVisit'];

        }


        if (empty($_POST['dateOfDischargeYear'])){
            $dateOfDischarge = $row['dateOfDischarge'];

        }else if (empty($_POST['dateOfDischargeMonth'])){
            $dateOfDischarge = $row['dateOfDischarge'];

        }else if (empty($_POST['dateOfDischargeDay'])){
            $dateOfDischarge = $row['dateOfDischarge'];

        }

        
        if (empty($symptoms)){
            $symptoms = $row['symptoms'];
        }

        if (empty($disease)){
            $disease = $row['disease'];
        }

        if (empty($treatment)){
            $treatment = $row['treatment'];
        }

        if (empty($completed)){
            $completed = $row['completed'];
        }

        $hasBed = 1;
        
    
        $vis->updateVisit($visitId, $patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment, $completed, $hasBed);


    }
  
    


    header("location: dPatientList.php");
    exit();     
}   
?>