<?php

?>

<html lang="en" >
   
<head>
    <title>Home | SIGN UP-PALOOZA</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=2" />
    <link rel="icon" href="css/1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">SIGN UP-PALOOZA</h2>
            </div>

            <div class="menu">
                <ul>
                    <li class="active">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="service.html">SERVICE</a></li>
                    <li><a href="http://localhost:8000/contact/">CONTACT</a></li>
                </ul>
            </div>

    

        </div> 
        <div class="content">
        <h1>Healing, For Everyone<br><span>Hospital System</span> <br>your health is our wealth</h1>
            <p class="par">You health services <br> One life is enough, Live life to the fullest in Palooza
                <br>Carita en scientia</p>


                <div class="form">
                    <h2>Sign UP Here</h2><br>
                   
                    <form action="user/userSignUp.php" method="post"  id="signUp" >

                    <input type="username" name="signUpUser" placeholder="Enter Username Here" required>
                    <input type="password" name="signUpPass" placeholder="Enter Password Here" required>
                    <input type="password" name="repeatSignUpPass" placeholder="Repeat Password Here" required>
                    <input type="Email" name="signUpEmail" placeholder="Enter Email Here" required>
                    <input type="hidden" name="input" value = "2" required>
                  
                    </form>
                    <button class="btnn" form="signUp" name="submit" value="submit">SignUp</button>

               >

                </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>