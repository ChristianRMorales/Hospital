<?php
require_once '../ORM.php';

$db = new MyOrm();
?>
<html lang="en">
<head>
    <title>Patient | Patient Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
    <link rel="icon" href="1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Patient Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                <li><a href="../Index.html">HOME</a></li>
                    <li class="active">SEARCH PATIENT</a></li>
                    <li><a href="deletePatient.html">DELETE</a></li>
                    <li><a href="addPatient.html">ADD</a></li>
                    <li><a href="updatePatient.html">UPDATE</a></li>
                </ul>
            </div>
            
           
            
        </div> 
        <center>
        <div class="content1">
       
                <div>
                <h1><span>Patient List</span></h1><br>
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
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>address</th>
                            <th>birthdate</th>
                            <th>date registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST['search']))
                                {
                                    $filterValues = $_POST['search'];
                                    $query = $db->filterPatient($filterValues);
                                    if(mysqli_num_rows($query) > 0)
                                        {
                                            foreach($query as $items){
                                                 ?>
                                                <tr>
                                                    <td><?= $items['patientId'] ?></td>
                                                    <td><?=  $items['patientName']?></td>
                                                    <td><?=  $items['patientAddress']?></td>
                                                    <td><?=  $items['patientBirth']?></td>
                                                    <td><?=  $items['patientDateRegistered']?></td>
                            
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