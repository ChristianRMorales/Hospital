<?php

$visitId = $_POST['visitId'];

?>
<html>
  <head>

    <title>Register | Patient Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
    <link rel="icon" href="1.ico" type="image/x-icon">
  </head>
  <body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">VISIT Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                  <li><a href="../Index.php">HOME</a></li>
                  <li class="active">DELETE VISIT</li>


                </ul>
            </div>

           
        </div> 
    <div class="content">

        <h1><span>Discharge Patient</span> <br>CHOOSE DATE Of DISCHARGE</h1>
        <p class="par"><br>
            <br> </p>

      <div class=" form3 ">
      <form action="../visit/updateVDischarge.php" method="post"  id="updateVisitD" >
      
                   
          <label for="dateOfDischarge">Date of Discharge:</label>
          <input type="date" id="dateOfDischarge" name="dateOfDischargeDate" required>
        
          <input type="hidden" id="visitId" name="visitId" value = "<?= $visitId ?>">
          <input type="hidden" id="completed" name="completed" value = "1">
      </form>
      <button class="btnn" form="updateVisitD" name="submit" value="submit">discharge Patient</button>
    </div>

    </div>
    </div>
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