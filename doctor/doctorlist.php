<?php
require_once '../ORM.php';

$db = new MyOrm('mysql:host=localhost;dbname=hospital','root', '', true);
?>
<html lang="en">
<head>
    <title>Doctor | Patient Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
    <link rel="icon" href="../css/1.ico" type="image/x-icon">
</head>
<body>

    <div class="main4">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Doctor Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                <li><a href="../Index.php">HOME</a></li>

                    <li class="active">SEARCH DOCTOR</li>
                    <li><a href="deleteDoctor.html">DELETE</a></li>
                    <li><a href="addDoctor.html">ADD</a></li>
                    <li><a href="updateDoctor.html">UPDATE</a></li>
                </ul>
            </div>
            
           
            
        </div> 
        <center>
        <div class="content1">
       
                <div>
                <h1><span>Doctor List</span></h1><br>
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
                            <th>Doctor Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST['search']))
                            {
                                $filterValues = $_POST['search'];
                                $query = $db->filterDoctor($filterValues);
                                $count = $query->rowCount();
                                if($count > 0)
                                {
                                    foreach($query as $items){
                        ?>
                        <tr>
                            <td><?= $items['doctorId'] ?></td>
                            <td><?=  $items['doctorName']?></td>
                            <td><?=  $items['doctorAddress']?></td>
                            <td><?=  $items['doctorPhone']?></td>
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
  .main4{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(2.jpg);
    background-position: center;
    background-size: cover;
    height: 120vh;
    background-image: url("../css/doc.jpg");
    position: relative;
}
</style>