<?php
// Start the session
session_start();


// Connect to the database
$con = mysqli_connect("localhost", "root", "", "borangdb") or die(mysqli_connect_error());

// Check if form is submitted
if (isset($_POST["pelajar_id"]) && isset($_POST["password"])) {
    $pelajar_id = $_POST["pelajar_id"];
    $password = $_POST["password"];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM signup WHERE pelajar_id = ? AND password = ?");
    $stmt->bind_param("ss", $pelajar_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if record exists
    $bilrekod = $result->num_rows;
    if ($bilrekod == 0) {
        echo "WRONG NO.STAFF/NO.PELAJAR & PASSWORD";
    } else {
        $datarekod = $result->fetch_assoc();
        $_SESSION["pelajar_id"] = $pelajar_id;
        
        // Check user status
        if ($datarekod['status'] == "USER") {
            header("Location: borang.php");
            exit();
        } elseif ($datarekod['status'] == "ADMIN") {
            header("Location: admin_input.php");
            exit();
        }
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($con);
?>

<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "borangdb";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


