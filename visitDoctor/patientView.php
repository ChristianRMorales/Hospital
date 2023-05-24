<?php

require_once '../visit/visitQuery.php';

$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

$sql = $vis->callPat()->findPatient($_POST['patientId']);
$patient = $sql->fetch();
$vis->resetQuery();
$pending = null;
?>
<html lang="en">
<head>
    <title>VISIT | visit Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Visit Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                <li><a href="../Index.php">HOME</a></li>

                    <li class="active">Patient Visit</a></li>
                    <li><a href="dPatientList.php">RETURN</a></li>
                   
                </ul>
            </div>
            
           
            
        </div> 
        <center>
        <div class="content1">
       
                <div>
                <h1><span>Visits List</span></h1><br>
                </div>

                <div class="search">
                
                <form action="" method="POST">
            
                                         
                <h1><?php echo "Patient Name:". $patient['patientName']?>
                </form>
                </div>
         
            
        
        </div>
        
        <div>
        <div>
                <table class="tablestyle">
                    <thead>
                        <tr>
                            <th>visitID</th>
                            <th>bed</th>
                            <th>doctorName</th>
                            <th>Patient Name</th>
                            <th>patient Type</th>
                            <th>dateOfVisit</th>
                            <th>dateOfDischarge</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         

                                    $query = $vis->findVisitPatient($patient['patientId']);
                                    
                                    $count = $query->rowCount();
                                    if($count > 0)
                                        {   
                                           
        
                                            foreach($query as $items){
                                                $patientN = $_POST["patientId"];
                                                $doctor = (string)$items['doctorId'];
                                                $bedId = (string)$items['bedId'];
                                                
                                                $query1 = $vis->callPat()->findPatient($patientN);
                                                $patientName = $query1->fetch();
                                                $vis->resetQuery();

                                                $query2 = $vis->callDoc()->findDoctor($doctor);
                                                $doctorName = $query2->fetch();
                                                $vis->resetQuery();

                                                $query3 = $vis->callBed()->findBed($bedId);
                                                $bedName = $query3->fetch();

                                                
                                                 ?>
                                                <tr>
                                                    <td><?= $items['visitId'] ?></td>
                                                    <td><?= $bedName['bedType'] ?></td>
                                                    <td><?=  $doctorName['doctorName'] ?></td>
                                                    <td><?=  $patientName['patientName']?></td>
                                                    <td><?php  if($items['patientType'] == 1){
                                                        echo "IN";
                                                    }else{
                                                        echo "OUT";
                                                    }?></td>
                                                    <td><?=  $items['dateOfVisit']?></td>
                                                    <td><?php if($items['completed'] == 1){
                                                        echo  $items['dateOfDischarge'];
                                                    }else{
                                                        echo " TBD ";
                                                    }?></td>
                                                    <td><?php if($items['completed'] == 1){
                                                        echo " COMPLETED ";
                                                    }else{
                                                        echo " PENDING ";
                                                        $pending = 1;
                                                    }?></td>
                            
                                                </tr>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                    <td colspan="6">No Record Found</td>
                            
                                                </tr>
                                            <?php

                                        }
                                
                         
                        ?>
                        
                    </tbody>

                </table>
                <?php
                if($pending == null)  {    
                   ?>
                    <form action="vdAddVisit.php" method="post"  id="addVisit" >
                    <input type="hidden" name="patientId" value="<?= $patient['patientId'] ?>">  
                    </form>
                    <button class="btnn" form="addVisit" name="submit" value="submit">Add Visit</button>

                    <?php  
                }else{}

   
                    ?>
            </div>
        </div>   
        </center>  
                                
    </div>

    
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>



<style>
  .main{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(2.jpg);
    background-position: center;
    background-size: cover;
    height: 120vh;
    background-image: url("../css/visit.jpg");
    position: relative;
}
</style>