<?php




?>

<html lang="en" >
   
<head>
    <title>Home | LOGIN-PALOOZA</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=2" />
    <link rel="icon" href="css/1.ico" type="image/x-icon">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">LOGIN-PALOOZA</h2>
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