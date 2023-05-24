<?php
require_once '../classes/visitQuery.php';
require_once '../includes/errorHandlers.php';


$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
    $dateOfVisit = ($_POST['dateOfVisitDate']);
    $dateOfDischarge = ($_POST['dateOfDischargeDate']);
    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];  
    $treatment = $_POST['treatment'];


    if ($errorHand->invalidId($patientId)){
        header("location: vdAddVisit.php?error=invalidPatientId=". $patientId);
        exit();    
    }


    if ($errorHand->invalidUId($patientType)){
        header("location: vdAddVisit.php?error=invalidPatientType=". $patientType);
        exit();    
    }


    if ($errorHand->invalidId($doctorId)){
        header("location: vdAddVisit.php?error=invalidDoctorId=". $doctortId);
        exit();    
    }


    if ($errorHand->invalidId($bedId)){
        header("location: vdAddVisit.php?error=invalidBedId=". $bedtId);
        exit();    
    }


    $query1 = $vis->callPat()->findPatient($patientId);
    $row1 = $query1->fetch();


    if(empty($row1)){
        header("location: vdAddVisit.php?error=invalidpatientIdDoesNotExist=". $patienttId);
        exit();
    }

    if(empty($dateOfDischarge )){
        $dateOfDischarge = 0;
    }
    $vis->resetQuery();


    $query2 = $vis->callDoc()->findDoctor($doctorId);
    $row2 = $query2->fetch();


    if(empty($row2)){
        header("location: vdAddVisit.php?error=invalidDoctorIdDoesNotExist=". $doctorId);
        exit();
    }


    $vis->resetQuery();


    $query3 = $vis->callBed()->findBed($bedId);
    $row3 = $query3->fetch();


    if(empty($row3)){
        header("location: vdAddVisit.php?error=invalidbedIdDoesNotExist=". $bedId);
        exit();
    }

    $vis->resetQuery();







    if ($errorHand->invalidUId($symptoms)){
        header("location: vdAddVisit.php?error=invalidSymptoms=".  $symptoms);
        exit();    
    }



    if ($errorHand->invalidUId($disease)){
        header("location: vdAddVisit.php?error=invalidDisease=". $disease);
        exit();    
    }




    if ($errorHand->invalidUId($treatment)){
        header("location: vdAddVisit.php?error=invalidTreatment=". $treatment);
        exit();    
    }



    if($patientType == 1){
        $completed = 0;
        $hasBed = 0;
    }else {
        $dateOfDischarge = $dateOfVisit;
        $query3 = $vis->callBed()->filterBed("NOBED");
        $bed = $query3->fetch();

        $bedId = $bed['bedId'];
        $vis->resetQuery();

        $completed = 1;
        $hasBed = 2;
    }

    $vis->insertVisit( $patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment, $completed, $hasBed);




    header("location: dPatientList.php?success=insert");
    exit(); 

}