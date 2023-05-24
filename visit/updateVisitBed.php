<?php
require_once 'visitQuery.php';

$vis = new visitClass('mysql:host=localhost;dbname=hospital','root', '', true);

$visitId = $_POST['visitId'];

$query = $vis->findVisit($visitId);
$visit = $query->fetch();

$query1 = $vis->callPat()->findPatient($visit['patientId']);
$patient = $query1->fetch();

?>
<html lang="en">
<head>
    <title>Beds | Patient Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
    <link rel="icon" href="../css/1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Bed Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                <li><a href="../Index.php">HOME</a></li>

                    <li class="active">SEARCH BED</li>
                    <li><a href="deleteBed.html">DELETE BED</a></li>
                    <li><a href="addBed.html">ADD BED</a></li>
                    <li><a href="updateBed.html">UPDATE BED</a></li>

                </ul>
            </div>
        </div> 

        <div class="content1">
            <div>
             
                <h1><span><?php echo "Add Bed for ".$patient['patientName']?><span></h1><br>
                <h1><span>Bed List<span></h1><br>
            </div>


        </div>
        
        <div class="bedVisit">
            <div>
            <table class="tablestyle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bed Name</th>
                        <th>Rate per Day</th>
                        <th>Bed Type</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                                    $filterValues = "";
                                    $query = $vis->callBed()->filterBed($filterValues);
                                    $count = $query->rowCount();
                                    if($count > 0)
                                        {
                                            foreach($query as $items){
                                                 ?>
                                                <tr>
                                                    <td><?= $items['bedId'] ?></td>
                                                    <td><?=  $items['bedName']?></td>
                                                    <td><?=  $items['ratePerDay']?></td>
                                                    <td><?=  $items['bedType']?></td>
                                               
                            
                                                </tr>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                    <td colspan="4">No Record Found</td>
                            
                                                </tr>
                                            <?php

                                        }
                                
                        ?>
                </tbody>
            </table>
            </div>

            <div class="formVisitBed">
                                            <form action="updateVB.php" method="POST" id="updateVisitBed">

                                                <label for="bedName">Enter Bed ID:</label>
                                                <input type="text" id="bedId" name="bedId" required>
    
                                                <input type="hidden" name="visitId" value="<?= $visitId ?>">
                                            </form>
                                    <button class="btnn" form="updateVisitBed" name="submit" value="submit">Add Bed</button>
            </div>
        </div>   

  
        
                   
    </div>

    
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>


<style>
  .main{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(1.jpg);
    background-position: center;
    background-size: cover;
    height: 100vh;
    background-image: url("../css/BGimage2.jpg");
    position: relative;
  }
  
</style>