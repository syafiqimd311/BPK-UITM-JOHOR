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
    
    <section>
        <nav>
            <ul>
                <li><a href="borang.php">MAKLUMAT AM PELAJAR</a></li> <br>
                <li><a href="permohonan.php">BORANG PERMOHONAN</a></li> <br>
                <li><a href="user_view.php">STATUS PERMOHONAN</a></li> <br>
                <li><a href="logout.php">LOG KELUAR</a></li>
            </ul>
        </nav>

        <main>
            <h3>BORANG PERMOHONAN PENGECUALIAN KULIAH/ TUTORIAL/ 
                MAKMAL/ LAWATAN AKADEMIK (TAPA)/ KONVOKESYEN/UMRAH</h3> <br>

            <h4>1. MAKLUMAT AM PELAJAR</h4>
            
<br>

            <form name="maklumat_pelajar" method="post" action="" enctype="multipart/form-data">
                
                Nama: <input type="text" name="name" required> <br>
                No. Pelajar: <input type="text" name="pelajar_id" required> <br>
                No. K/P: <input type="text" name="nokp" required> <br>
                Kod Program: <input type="text" name="kodprogram" required> <br>
                Bhg: <input type="text" name="bhg" required> <br>
                Telefon H/P: <input type="text" name="nohp" required> <br>
                Telefon Rumah: <input type="text" name="norumah" required> <br>
                
                <!-- Input untuk unggah gambar -->
                Gambar (JPG/PNG): <input type="file" name="gambar" accept=".jpg,.jpeg,.png" required> <br><br>
                
                <input type="submit" value="Submit">
            </form>
        
        <div style="position: fixed; bottom: 20px; right: 20px;">
            <a href="permohonan.php">
                <img src="seterusnya.png" alt="seterusnya" style="width:100px; height:100px;">
            </a>
        </div>

<div>
        <h4>Semak & Kemaskini Maklumat Anda</h4>
<form method="GET" action="">
    <input type="text" name="search_pelajar_id" placeholder="Masukkan No. Pelajar" required>
    <input type="submit" value="Cari">
</form>
</div>
<?php
// Sambung ke database
$con = new mysqli("localhost", "root", "", "borangdb");

// Semak sambungan
if ($con->connect_error) {
    die("Sambungan gagal: " . $con->connect_error);
}

// Jika pelajar masukkan No. Pelajar untuk carian
if (isset($_GET['search_pelajar_id'])) {
    $pelajar_id = $con->real_escape_string($_GET['search_pelajar_id']);

    // Cari data pelajar berdasarkan `pelajar_id`
    $sql = "SELECT * FROM maklumat_pelajar WHERE pelajar_id = '$pelajar_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <h4>Maklumat Pelajar</h4>
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
            <p>Kemas Kini Gambar (Optional)</p>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

            <input type="submit" name="update" value="Kemaskini">
        </form>
<?php
    } else {
        echo "No. Pelajar tidak ditemui.";
    }
}

// Jika pelajar menekan butang "Kemaskini"
if (isset($_POST['update'])) {
    $pelajar_id = $con->real_escape_string($_POST['pelajar_id']);
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

        if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            $sql = "UPDATE maklumat_pelajar SET name='$name', nokp='$nokp', kodprogram='$kodprogram', bhg='$bhg', nohp='$nohp', norumah='$norumah', gambar='$file_name' WHERE pelajar_id='$pelajar_id'";
        } else {
            echo "Hanya fail JPG, JPEG, PNG dibenarkan.";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, kemaskini maklumat sahaja
        $sql = "UPDATE maklumat_pelajar SET name='$name', nokp='$nokp', kodprogram='$kodprogram', bhg='$bhg', nohp='$nohp', norumah='$norumah' WHERE pelajar_id='$pelajar_id'";
    }

    if ($con->query($sql) === TRUE) {
        echo "Maklumat berjaya dikemaskini!";
    } else {
        echo "Ralat: " . $con->error;
    }
}

$con->close();
?>

</main>



    </section>

    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>


<?php
// Sambung ke pangkalan data
$con = new mysqli("localhost", "root", "", "borangdb");

// Semak sambungan
if ($con->connect_error) {
    die("Sambungan gagal: " . $con->connect_error);
}

// Semak apakah formulir dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["name"]) && !empty($_POST["pelajar_id"]) && !empty($_POST["nokp"]) &&
        !empty($_POST["kodprogram"]) && !empty($_POST["bhg"]) && !empty($_POST["nohp"]) && 
        !empty($_POST["norumah"]) && !empty($_FILES["gambar"]["name"])) {
        
        // Ambil data & sanitasi
        $name = $con->real_escape_string($_POST['name']);
        $pelajar_id = $con->real_escape_string($_POST['pelajar_id']);
        $nokp = $con->real_escape_string($_POST['nokp']);
        $kodprogram = $con->real_escape_string($_POST['kodprogram']);
        $bhg = $con->real_escape_string($_POST['bhg']);
        $nohp = $con->real_escape_string($_POST['nohp']);
        $norumah = $con->real_escape_string($_POST['norumah']);

        // **PERBAIKAN**: Pastikan folder `uploads/` ada
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Proses unggah gambar
        $file_name = time() . "_" . basename($_FILES["gambar"]["name"]); // Rename dengan timestamp
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Validasi jenis file
        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            echo "Hanya fail JPG, JPEG dan PNG dibenarkan..";
            $uploadOk = 0;
        }

        // Simpan file jika lolos validasi
        if ($uploadOk == 1 && move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO maklumat_pelajar (name, pelajar_id, nokp, kodprogram, bhg, nohp, norumah, gambar)
                    VALUES ('$name', '$pelajar_id', '$nokp', '$kodprogram', '$bhg', '$nohp', '$norumah', '$file_name')";

            if ($con->query($sql) === TRUE) {
                echo "Data berjaya dimasukkan!";
                echo "<br><a href='borang.php'>Kembali ke borang</a>";
            } else {
                echo "Ralat: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Gagal memuat naik imej.";
        }
    } else {
        echo "Sila lengkapkan semua medan!";
    }
}

// Tutup sambungan database
$con->close();
?>
