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
        <h2>Signup To Bahagian Hal Ehwal Pelajar</h2>
        <form name="signup" method="post" >
                Nama: <input type="text" name="name" id="name" > <br>
                No.Staff/No.Pelajar: <input type="text" name="pelajar_id" id="pelajar_id" > <br>
                Email: <input type="text" name="email" id="email" > <br>
                Password: <input type="text" name="password" id="password" > <br>
            
            <input type="submit" value="Signup">
        </form>
        <div class="signup-link">
            <a href="index.php">Back To Login Menu</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
<?php
// Ambil data dari form
if (isset($_POST["name"], $_POST["pelajar_id"], $_POST["email"], $_POST["password"])) {
    $name = $_POST["name"];
    $pelajar_id = $_POST["pelajar_id"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hubungkan ke database
    $con = mysqli_connect("localhost", "root", "", "borangdb");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the data into the database
    $sql = "INSERT INTO signup (name, pelajar_id, email, password, status) 
    VALUES ('$name', '$pelajar_id', '$email', '$password', 'USER')";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Registration Successful!');</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
}
} else {
echo "<script>alert('Please fill out all required fields.');</script>";
}

?>

