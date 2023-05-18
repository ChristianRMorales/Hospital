<?php
require_once 'visitQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
    $dateOfVisit = ($_POST['dateOfVisitYear'] . "-" . $_POST['dateOfVisitMonth'] . "-" .$_POST['dateOfVisitDay']);
    $dateOfDischarge = ($_POST['dateOfDischargeYear'] . "-" . $_POST['dateOfDischargeMonth'] . "-" .$_POST['dateOfDischargeDay']);
    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $treatment = $_POST['treatment'];

    if ($errorHand->invalidId($patientId)){
        header("location: addVisit.html?error=invalidPatientId=". $patientId);
        exit();    
    }

    if ($errorHand->invalidUId($patientType)){
        header("location: addVisit.html?error=invalidPatientType=". $patientType);
        exit();    
    }

    if ($errorHand->invalidId($doctorId)){
        header("location: addVisit.html?error=invalidDoctorId=". $doctortId);
        exit();    
    }

    if ($errorHand->invalidId($bedId)){
        header("location: addVisit.html?error=invalidBedId=". $bedtId);
        exit();    
    }

    $query1 = $vis->callPat()->findPatient($patientId);
    $row1 = $query1->fetch();

    if(empty($row1)){
        header("location: addVisit.html?error=invalidpatientIdDoesNotExist=". $patienttId);
        exit();
    }

    $vis->resetQuery();


    $query2 = $vis->callDoc()->findDoctor($doctorId);
    $row2 = $query2->fetch();

    if(empty($row2)){
        header("location: addVisit.html?error=invalidDoctorIdDoesNotExist=". $doctorId);
        exit();
    }

    $vis->resetQuery();


    $query3 = $vis->callBed()->findBed($bedId);
    $row3 = $query3->fetch();

    if(empty($row3)){
        header("location: addVisit.html?error=invalidbedIdDoesNotExist=". $bedId);
        exit();
    }

    $vis->resetQuery();



    if ($errorHand->isInt($_POST['dateOfVisitYear'] . $_POST['dateOfVisitMonth'] .$_POST['dateOfVisitDay'])){
        header("location: addVisit.html?error=invalidDateOfVisit=".  $dateOfVisit);
        exit();    
    }


    if ($errorHand->isInt($_POST['dateOfDischargeYear'] . $_POST['dateOfDischargeMonth'] .$_POST['dateOfDischargeDay'])){
        header("location: addVisit.html?error=invalidDateOfDischarge=". $dateOfDischarge);
        exit();    
    }



    if ($errorHand->invalidUId($symptoms)){
        header("location: addVisit.html?error=invalidSymptoms=".  $symptoms);
        exit();    
    }



    if ($errorHand->invalidUId($disease)){
        header("location: addVisit.html?error=invalidDisease=". $disease);
        exit();    
    }


    if ($errorHand->invalidUId($treatment)){
        header("location: addVisit.html?error=invalidTreatment=". $treatment);
        exit();    
    }







    if(strtoupper($patientType) == "IN"){

    }else {
        $query3 = $vis->callBed()->filterBed("NOBED");
        $bed = $query3->fetch();

        $bedId = $bed['bedId'];
        $vis->resetQuery();
    }

    $vis->insertVisit( $patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment);




    header("location: visitlist.php?success=insert");
    exit(); 

}