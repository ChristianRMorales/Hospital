<?php

session_start();
if($_SESSION['isDoctor?'] == true){
    $name = "DR.";
}else{
    $name = "Administrator ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Patient Palooza</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=2" />
    <link rel="icon" href="css/1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Home Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                    <li class="active">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="service.html">SERVICE</a></li>
                    <?php 
                    if (isset($_SESSION['userId'])){?>
                    <li><a href="user/logout.php">LOGOUT</a></li>
                    <?php }else{?>
                    <li><a href="login.php">LOGIN</a></li>
                        <?php }?>
                </ul>
            </div>

           

        </div> 
        <div class="content">
            <?php 
            if (isset($_SESSION['userId'])){
                echo "<h1> WELCOME ".$name . $_SESSION['userN'] . "</h1><br>";
            }else{
                echo "<h1>You are not logged in<h1>";
            }
            ?>
            <h1>Healing, For Everyone<br><span>Hospital System</span> <br>your health is our wealth</h1>
            <p class="par">You health services <br> One life is enough, Live life to the fullest in Palooza
                <br>Carita en scientia</p>
                <?php 
                    if (isset($_SESSION['userId']) & $_SESSION['isDoctor?'] == false){?>
                    <button class="btnn" onclick="window.location.href = 'patient/patientList.php';">Patient list</button>
                    <button class="btnn" onclick="window.location.href = 'visit/visitList.php';">Visit list</button>
                    <button class="btnn" onclick="window.location.href = 'doctor/doctorlist.php';">Doctor</button>
                    <button class="btnn" onclick="window.location.href = 'bed/bedlist.php';">Bed list</button>
                    <button class="btnn" onclick="window.location.href = 'visit/pendingVisit.php';">Pending Bed list</button>

                    <?php }elseif (isset($_SESSION['userId']) & $_SESSION['isDoctor?'] == true){?>
                    <button class="btnn" onclick="window.location.href = 'visitDoctor/dPatientList.php';">Patient list</button>
                    <?php } ?>
    
                </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>