<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);



if($_POST["input"] == "1"){
    $patientId = $_POST['patientId'];
    $patientType = $_POST['patientType'];
    $doctorId = $_POST['doctorId'];
    $bedId = $_POST['bedId'];
    $dateOfVisit = ($_POST['dateOfVisitYear'] . "-" . $_POST['dateOfVisitMonth'] . "-" .$_POST['dateOfVisitDay']);
    $dateOfDischarge = ($_POST['dateOfDischargeYear'] . "-" . $_POST['dateOfDischargeMonth'] . "-" .$_POST['dateOfDischargeDay']);
    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $treatment = $_POST['treatment'];



    if(strtoupper($patientType) == "IN"){

    }else {
        $query3 = $db->filterBed("NOBED");
        $bed = mysqli_fetch_assoc($query3);

        $bedId = $bed['bedId'];
        $db->resetQuery();
    }

    $db->insertVisit( $patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment);




}else if($_POST["input"] == "0"){
    $visitId = $_POST['visitId'];


    $db->deleteVisit($visitId);







}else if($_POST["input"] == "2"){

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

    $query1 = $db->findVisit($visitId);
    $row = $query1->fetch();

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
            $query3 = $db->filterBed("NOBED");
            $bed = $query3->fetch();
    
            $bedId = $bed['bedId'];
        }
        $db->resetQuery();
    
        $db->updateVisit( $visitId ,$patientId, $patientType, $doctorId, $bedId, $dateOfVisit, $dateOfDischarge,  $symptoms, $disease, $treatment);



  
    }


header("location: visitList.php");
exit();       
?>