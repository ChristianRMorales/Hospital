<?php
require_once '../classes/visitQuery.php';
require_once '../includes/errorHandlers.php';
session_start();

$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $visitId = $_POST['visitId'];
    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
    $dateOfVisit = ($_POST['dateOfVisitDate']);
    $dateOfDischarge = ($_POST['dateOfDischargeDate']);
    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $treatment = $_POST['treatment'];
    $completed = $_POST['completed'];
    $hasBed = $_POST['hasBed'];


    if ($errorHand->invalidId($patientId)){
        header("location: updateVisit.html?error=invalidPatientId=". $patientId);
        exit();    
    }

    if ($errorHand->invalidUId($patientType)){
        header("location: updateVisit.html?error=invalidPatientType=". $patientType);
        exit();    
    }

    if ($errorHand->invalidId($doctorId)){
        header("location: updateVisit.html?error=invalidDoctorId=". $doctortId);
        exit();    
    }

    if ($errorHand->invalidId($bedId)){
        header("location: updateVisit.html?error=invalidBedId=". $bedtId);
        exit();    
    }


    if($patientId != null){
    $query1 = $vis->callPat()->findPatient($patientId);
    $row1 = $query1->fetch();
    if(empty($row1)){
        header("location: updateVisit.html?error=invalidpatientIdDoesNotExist=". $patienttId);
        exit();
    }

    $vis->resetQuery();
    }

    if($doctorId != null){
    $query2 = $vis->callDoc()->findDoctor($doctorId);
    $row2 = $query2->fetch();

    if(empty($row2)){
        header("location: updateVisit.html?error=invalidDoctorIdDoesNotExist=". $doctorId);
        exit();
    }

    $vis->resetQuery();
    }

    if($bedId != null){
    $query3 = $vis->callBed()->findBed($bedId);
    $row3 = $query3->fetch();

    if(empty($row3)){
        header("location: updateVisit.html?error=invalidbedIdDoesNotExist=". $bedId);
        exit();
    }

    $vis->resetQuery();
    }







    if ($errorHand->invalidUId($symptoms)){
        header("location: updateVisit.html?error=invalidSymptoms=".  $symptoms);
        exit();    
    }



    if ($errorHand->invalidUId($disease)){
        header("location: updateVisit.html?error=invalidDisease=". $disease);
        exit();    
    }


    if ($errorHand->invalidUId($treatment)){
        header("location: updateVisit.html?error=invalidTreatment=". $treatment);
        exit();    
    }







    $query4 = $vis->findVisit($visitId);
    $row = $query4->fetch();


    if(empty($row)){
        header("location: updateVisit.html?error=IdnotFound=". $visitId);
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



        if (empty($_POST['dateOfVisitDate'])){
            $dateOfVisit = $row['dateOfVisit'];

        }


        if (empty($_POST['dateOfDischargeDate'])){
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


        if($patientType == 1){

        }else {
            $dateOfDischarge = $dateOfVisit;
            $query3 = $vis->callBed()->filterBed("NOBED");
            $bed = $query3->fetch();
    
            $bedId = $bed['bedId'];
            $vis->resetQuery();
    
            $completed = 1;
            $hasBed = 2;
        }
        $vis->resetQuery();
    
        $vis->updateVisit( $visitId ,$patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment, $completed, $hasBed);


    }
  
    

if($_SESSION['isDoctor?'] == true){
    header("location: ../visitDoctor/dPatientList.php");
    exit();  
}
header("location: visitList.php");
exit();    
}   
?>