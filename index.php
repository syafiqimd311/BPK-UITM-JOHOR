<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Pengecualian Kuliah UiTM Segamat</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
<header>
        <div class="imgcontainer">
            <img src="https://i.pinimg.com/originals/36/0d/2f/360d2f200c27a814a041ec2652e74601.png" alt="logo" width="150" height="150">
        </div>
        <p>BAHAGIAN HAL EHWAL AKADEMIK UiTM JOHOR</p>
    </header>

    <main>
        <h2>LogIn/SignUp</h2>

        <body> <h3>
            <form name="login" method="post" action="proses.php" >
                No.Staff/No.Pelajar: <input type="text" name="pelajar_id" id="pelajar_id" > <br>
                Password: <input type="text" name="password" id="password" > <br>
                <input type="submit" name="submit" value="Submit">
                <div class="signup-link">
        <a href="signup.php">Signup To Bahagian Hal Ehwal Pelajar</a>
   
            </form> </h3> </div>
                     
            
            
            
            
            </body>
    </main>
<br> <br>
    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
<?php
            $username=$_POST["pelajar_id"];
            $password=$_POST["password"];
           
            
            $con = mysqli_connect ("localhost", "root", "", "borangdb") or die
            (mysqli_connect_errno($con));
            
           
            ?>



