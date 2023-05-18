<?php
require_once 'visitQuery.php';
require_once '../errorHandlers.php';


$errorHand = new err();
$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

if(isset($_POST['submit'])){

    $visitId = $_POST['visitId'];
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


    if ($errorHand->isInt($_POST['dateOfVisitYear'] . $_POST['dateOfVisitMonth'] .$_POST['dateOfVisitDay'])){
        header("location: updateVisit.html?error=invalidDateOfVisit=".  $dateOfVisit);
        exit();    
    }


    if ($errorHand->isInt($_POST['dateOfDischargeYear'] . $_POST['dateOfDischargeMonth'] .$_POST['dateOfDischargeDay'])){
        header("location: updateVisit.html?error=invalidDateOfDischarge=". $dateOfDischarge);
        exit();    
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

        if(strtoupper($patientType) == "IN"){

        }else {
            $queryBed = $vis->callBed()->filterBed("NOBED");
            $bed = $queryBed->fetch();
    
            $bedId = $bed['bedId'];
        }
        $vis->resetQuery();
    
        $vis->updateVisit( $visitId ,$patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment);


    }
  
    


header("location: visitList.php");
exit();    
}   
?>