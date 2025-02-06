<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Database connection
    $con = mysqli_connect("localhost", "root", "", "borangdb") or die(mysqli_connect_error());

    // Delete record
    $deleteQuery = "DELETE FROM pengecualian WHERE pengecualian_id=$id";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Record deleted successfully!'); window.location='data_borang.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Invalid request!";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Database connection
    $con = mysqli_connect("localhost", "root", "", "borangdb") or die(mysqli_connect_error());

    // Delete record
    $deleteQuery = "DELETE FROM butiran_kuliah WHERE butiran_id=$id";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Record deleted successfully!'); window.location='data_borang.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Invalid request!";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Database connection
    $con = mysqli_connect("localhost", "root", "", "borangdb") or die(mysqli_connect_error());

    // Delete record
    $deleteQuery = "DELETE FROM maklumat_pelajar WHERE maklumat_id=$id";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Record deleted successfully!'); window.location='pelajar.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Invalid request!";
}


?>
