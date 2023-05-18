<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);
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

                    <li class="active">SEARCH VISIT</a></li>
                    <li><a href="deleteVisit.html">DELETE VISIT</a></li>
                    <li><a href="addVisit.html">ADD VISIT</a></li>
                    <li><a href="updateVisit.html">UPDATE VISIT</a></li>
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
            
         
                <input class="srch" type="text" name="search" placeholder="Type To text">
                <button class="btn" type="submit">Search</button>
      
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         
                            if(isset($_POST['search']))
                                {
                                    $filterValues = $_POST['search'];
                                    $query = $db->filterVisit($filterValues);
                                    $count = $query->rowCount();
                                    if($count > 0)
                                        {   
                                           
        
                                            foreach($query as $items){
                                                $patient = (string)$items['patientId'];
                                                $doctor = (string)$items['doctorId'];
                                                $bedId = (string)$items['bedId'];
                                                
                                                $db->resetQuery();

                                                $query1 = $db->findPatient($patient);
                                                $patientName = $query1->fetch();
                                                $db->resetQuery();

                                                $query2 = $db->findDoctor($doctor);
                                                $doctorName = $query2->fetch();;
                                                $db->resetQuery();

                                                $query3 = $db->findBed($bedId);
                                                $bedName = $query3->fetch();

                                                
                                                 ?>
                                                <tr>
                                                    <td><?= $items['visitId'] ?></td>
                                                    <td><?= $bedName['bedType'] ?></td>
                                                    <td><?=  $doctorName['doctorName'] ?></td>
                                                    <td><?=  $patientName['patientName']?></td>
                                                    <td><?=  strtoupper($items['patientType'])?></td>
                                                    <td><?=  $items['dateOfVisit']?></td>
                                                    <td><?=  $items['dateOfDischarge']?></td>
                            
                                                </tr>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                    <td colspan="5">No Record Found</td>
                            
                                                </tr>
                                            <?php

                                        }
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