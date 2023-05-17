<?php

?>

<html lang="en" >
   
<head>
    <title>Home | Patient-PALOOZA</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=2" />
    <link rel="icon" href="1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Patient-PALOOZA</h2>
            </div>

            <div class="menu">
                <ul>
                    <li class="active">HOME</a></li>
                    <li><a href="http://localhost:8000/about/">ABOUT</a></li>
                    <li><a href="http://localhost:8000/service/">SERVICE</a></li>
                    <li><a href="http://localhost:8000/contact/">CONTACT</a></li>
                </ul>
            </div>

    

        </div> 
        <div class="content">
            <h1>Click, Rent, Save<br><span>Textbook Rentals</span> <br>Delivered to your door</h1>
            <p class="par">The ultimate destination for book lovers <br>Enter a world of wonder with Read-iculous, where you'll find a vast collection of enthralling stories
                <br> a quae totam ipsa illum minus laudantium?</p>


                <div class="form">
                    <h2>Sign UP Here</h2><br>
                   
                    <form action="user.php" method="post"  id="signUp" >

                    <input type="username" name="signUpUser" placeholder="Enter Username Here" required>
                    <input type="password" name="signUpPass" placeholder="Enter Password Here" required>
                    <input type="password" name="repeatSignUpPass" placeholder="Repeat Password Here" required>
                    <input type="Email" name="signUpEmail" placeholder="Enter Email Here" required>
                    <input type="hidden" name="input" value = "2" required>
                  
                    </form>
                    <button class="btnn" form="signUp" value="submit">SignUp</button>

               >

                </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>