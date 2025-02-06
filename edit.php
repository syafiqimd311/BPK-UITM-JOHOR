<?php
// Sambung ke database
$con = new mysqli("localhost", "root", "", "borangdb");

// Semak sambungan
if ($con->connect_error) {
    die("Sambungan gagal: " . $con->connect_error);
}

// Pastikan pelajar_id dihantar melalui URL
if (!isset($_GET['pelajar_id'])) {
    die("Sila masukkan No. Pelajar yang sah.");
}

$pelajar_id = $con->real_escape_string($_GET['pelajar_id']);

// Ambil data pelajar berdasarkan pelajar_id
$sql = "SELECT * FROM maklumat_pelajar WHERE pelajar_id = '$pelajar_id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No. Pelajar tidak ditemui.");
}

// Jika butang update ditekan
if (isset($_POST['update'])) {
    $name = $con->real_escape_string($_POST['name']);
    $nokp = $con->real_escape_string($_POST['nokp']);
    $kodprogram = $con->real_escape_string($_POST['kodprogram']);
    $bhg = $con->real_escape_string($_POST['bhg']);
    $nohp = $con->real_escape_string($_POST['nohp']);
    $norumah = $con->real_escape_string($_POST['norumah']);

    // Semak jika gambar dikemaskini
    if (!empty($_FILES["gambar"]["name"])) {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Pastikan hanya format tertentu dibenarkan
        if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            $sql = "UPDATE maklumat_pelajar 
                    SET name='$name', nokp='$nokp', kodprogram='$kodprogram', bhg='$bhg', nohp='$nohp', norumah='$norumah', gambar='$file_name' 
                    WHERE pelajar_id='$pelajar_id'";
        } else {
            echo "Hanya fail JPG, JPEG, PNG dibenarkan.";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, hanya update maklumat lain
        $sql = "UPDATE maklumat_pelajar 
                SET name='$name', nokp='$nokp', kodprogram='$kodprogram', bhg='$bhg', nohp='$nohp', norumah='$norumah' 
                WHERE pelajar_id='$pelajar_id'";
    }

    if ($con->query($sql) === TRUE) {
        echo "Maklumat berjaya dikemaskini!";
        echo "<br><a href='user_view.php'>Kembali</a>";
    } else {
        echo "Ralat: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Maklumat Pelajar</title>
</head>
<body>
    <h3>Kemaskini Maklumat Pelajar</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="pelajar_id" value="<?php echo $row['pelajar_id']; ?>">
        Nama: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        No. K/P: <input type="text" name="nokp" value="<?php echo $row['nokp']; ?>" required><br>
        Kod Program: <input type="text" name="kodprogram" value="<?php echo $row['kodprogram']; ?>" required><br>
        Bhg: <input type="text" name="bhg" value="<?php echo $row['bhg']; ?>" required><br>
        Telefon H/P: <input type="text" name="nohp" value="<?php echo $row['nohp']; ?>" required><br>
        Telefon Rumah: <input type="text" name="norumah" value="<?php echo $row['norumah']; ?>" required><br>

        <p>Gambar Sekarang:</p>
        <img src="uploads/<?php echo $row['gambar']; ?>" width="100"><br>
        <p>Kemas Kini Gambar (Opsional)</p>
        <input type="file" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

        <input type="submit" name="update" value="Kemaskini">
    </form>
</body>
</html>

<?php
$con->close();
?>
