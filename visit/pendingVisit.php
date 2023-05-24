<?php
require_once '../classes/visitQuery.php';


$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);
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

                    <li class="active">Pending Visit Beds</a></li>

                </ul>
            </div>
            
           
            
        </div> 
        <center>
        <div class="content1">
       
                <div>
                <h1><span>Visits List</span></h1><br>
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
                            <th>visit Status</th>
                            <th>Bed Status</th>
                            <th>Change Bed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $query = $vis->findVisitHasBed(0);
                                    $count = $query->rowCount();
                                    if($count > 0)
                                        {   
                                           
        
                                            foreach($query as $items){
                                                $patient = (string)$items['patientId'];
                                                $doctor = (string)$items['doctorId'];
                                                $bedId = (string)$items['bedId'];
                                                
                                                $vis->resetQuery();

                                                $query1 = $vis->callPat()->findPatient($patient);
                                                $patientName = $query1->fetch();
                                                $vis->resetQuery();

                                                $query2 = $vis->callDoc()->findDoctor($doctor);
                                                $doctorName = $query2->fetch();;
                                                $vis->resetQuery();

                                                $query3 = $vis->callBed()->findBed($bedId);
                                                $bedName = $query3->fetch();

                                                
                                                 ?>
                                                <tr>
                                                    <td><?= $items['visitId'] ?></td>
                                                    <td><?= $bedName['bedType'] ?></td>
                                                    <td><?=  $doctorName['doctorName'] ?></td>
                                                    <td><?=  $patientName['patientName']?></td>
                                                    <td><?php  if($items['patientType'] == 1){echo "IN";}else{echo "OUT";}?></td>
                                                    <td><?=  $items['dateOfVisit']?></td>
                                                    <td><?php  if($items['completed'] == 0){echo "PEDNING";}else{echo "COMPLETED";}?></td>
                                                    <td><?php  if($items['hasBed'] == 0){echo "No Bed";}else{echo "With Bed";}?></td>
                                                    <td><form action="updateVisitBed.php" method="POST" enctype="multipart/form-data"><input type="hidden" name="visitId" value=<?= $items['visitId']; ?>><button class="btnn" name="submit">Add Bed</button></form></td>
                            
                                                </tr>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                    <td colspan="9">No Record Found</td>
                            
                                                </tr>
                                            <?php

                                        }
                                
                        ?>
                        
                    </tbody>

                </table>

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