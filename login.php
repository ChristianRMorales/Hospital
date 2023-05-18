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

                <button class="cn"><a href="signUp.php">JOIN US</a></button>

                <div class="form">
                    <h2>Login Here</h2><br>
                   
                    <form action="user/userLogin.php" method="post"  id="login" >

                    <input type="username" name="logUser" placeholder="Enter Username Here" required>
                    <input type="password" name="logPass" placeholder="Enter Password Here" required>
                    <input type="hidden" name="input" value = "1" required>
                    </form>
                    <button class="btnn" form="login" name="submit" value="submit">Login</button>

                    <p class="link">Don't have an account<br>
                    <a href="signUp.php">Sign up </a> here</a></p>
                    <p class="liw">Log in with</p>

                    <center>
                    <div class="icons">
                        <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="#"><ion-icon name="logo-google"></ion-icon></a>
                    </div>
                    </center>
                </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>