<?php
session_start();
if(isset($_POST['submit'])){


?>
<html>
  <head>

    <title>Register | VISIT Palooza</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=2" />
  <body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">VISIT Palooza</h2>
            </div>

            <div class="menu">
                <ul>
                  <li><a href="../Index.php">HOME</a></li>

                  <li><a href="patientView.php"><form action="patientView.php" method="POST" id="patientView"><input type="hidden" name="patientId" value="<?= $_POST['patientId'] ?>"></form><button class="btn-link" form="patientView" name="submit">PatientVisit</button></a></li>
                  <li class="active">ADD</a></li>


                </ul>
            </div>

           
        </div> 
    <div class="content">

        <h1><span>Add Visit </span> <br>Create Your record!</h1>
        <p class="par">Input Patient's ID <br>Input Doctor's ID
            <br> Choose Date to Visit</p>

      <div class=" formVisitAdd ">
      <form action="addV.php" method="post"  id="addVisit">


          <label for="symptoms">Symptoms:</label>
          <input type="text" id="symptoms" name="symptoms">

          <label for="disease">Disease:</label>
          <input type="text" id="disease" name="disease">

          <label for="treatment">Treatment:</label>
          <input type="text" id="treatment" name="treatment">
       
          <input type="hidden" id="patientId" name="patientId" value = "<?= $_POST['patientId']?>" required>
      
   
          <label for="patientType">Patient Type:</label>
          <select id="patientType" name="patientType"required>
          <option value=1>IN</option>
          <option value=0>OUT</option>
          <br>

          <input type="hidden" id="doctorId" name="doctorId" value =<?= $_SESSION['userId'] ?> required>

          <input type="hidden" id="bedId" name="bedId" value = 1 required>
    
          
          <label for="dateOfVisit"><br><br>Date OF Visit:</label>
          
          <label for="dateOfVisit">Date OF Visit:</label>
          <input type="date" id="dateToday" name="dateOfVisitDate" required>



      </form>
      <button class="btnn" form="addVisit" name="submit" value="submit">ADD VISIT</button>
    </div>

    </div>
    </div>
  </body>
  <?php }?>
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