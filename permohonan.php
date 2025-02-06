<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Pengecualian Kuliah UiTM Segamat</title>
    <link rel="stylesheet" href="styles1.css">
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
                <li><a href="borang.php">MAKLUMAT AM PELAJAR</a></li>
                <li><a href="permohonan.php">BORANG PERMOHONAN</a></li>
                <li><a href="user_view.php">STATUS PERMOHONAN</a></li>
                <li><a href="logout.php">LOG KELUAR</a></li>
            </ul>
        </nav>

        <main>
            <h3>BORANG PERMOHONAN PENGECUALIAN KULIAH/ TUTORIAL/ MAKMAL/ LAWATAN AKADEMIK (TAPA)/ KONVOKESYEN/UMRAH</h3>

            <!-- Form untuk masukkan data -->
            <form action="permohonan.php" method="post">
                <h4>2. TARIKH PENGECUALIAN</h4>

                
                <label for="pelajar_id">Pelajar ID:</label>
                <input type="text" name="pelajar_id" id="pelajar_id" required>

                <label for="mula">Mula:</label>
                <input type="date" id="mula" name="mula" required><br><br>

                <label for="tamat">Tamat:</label>
                <input type="date" id="tamat" name="tamat" required><br><br>

                <label for="bil_hari">Bilangan Hari:</label>
                <input type="text" id="bil_hari" name="bil_hari" required><br><br>

                <label for="sebab">Nyatakan Sebab:</label>
                <input type="text" id="sebab" name="sebab" required><br><br>

                <h4>Kuliah/Tutorial/Makmal/ Lawatan Akademik/Konvokesyen/ Umrah</h4>
                <table>
                    <tr>
                        <th>BIL</th>
                        <th>TARIKH</th>
                        <th>HARI</th>
                        <th>MASA</th>
                        <th>KOD KURSUS</th>
                        <th>NAMA PENSYARAH</th>
                        <th>TANDA TANGAN PENSYARAH</th>
                        <th>NOTA</th>
                    </tr>
                    <!-- Baris pertama -->
                    <tr>
                        <td>1.</td>
                        <td><input type="date" name="tarikh[]" required></td>
                        <td><input type="text" name="hari[]" required></td>
                        <td><input type="text" name="masa[]" required></td>
                        <td><input type="text" name="kodkursus[]" required></td>
                        <td><input type="text" name="namapensyarah[]" required></td>
                        <td><input type="text" name="signpensyarah[]" required></td>
                        <td><input type="text" name="nota[]" required></td>
                    </tr>
                    <!-- Anda boleh tambah baris tambahan seperti ini -->
                </table>
                <br>
                <button type="submit">Hantar</button>
            </form>
        </main>
        <div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="user_view.php">
        <img src="seterusnya.png" alt="seterusnya" style="width:100px; height:100px;">
    </a>
</div>

<div style="position: fixed; bottom: 20px; left: 20px;">
    <a href="borang.php">
        <img src="kembali.png" alt="seterusnya" style="width:100px; height:100px;">
    </a>
</div>
    </section>  
            
    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
<?php
// Sambungan ke pangkalan data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "borangdb";

// Buat sambungan
$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Proses data yang dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mula = $_POST['mula'];
    $tamat = $_POST['tamat'];
    $bil_hari = $_POST['bil_hari'];
    $sebab = $_POST['sebab'];
    $tarikh = $_POST['tarikh'];
    $hari = $_POST['hari'];
    $masa = $_POST['masa'];
    $kodkursus = $_POST['kodkursus'];
    $namapensyarah = $_POST['namapensyarah'];
    $signpensyarah = $_POST['signpensyarah'];
    $nota = $_POST['nota'];

    $pelajar_id = $_POST['pelajar_id']; // Pelajar ID dihantar dari borang

// Masukkan data ke dalam jadual 'pengecualian'
$sql_pengecualian = "INSERT INTO pengecualian (pelajar_id, mula, tamat,bil_hari, sebab) 
                     VALUES ('$pelajar_id', '$mula', '$tamat' , '$bil_hari', '$sebab')";
if ($conn->query($sql_pengecualian) === TRUE) {
    $pengecualian_id = $conn->insert_id; // Dapatkan ID pengecualian yang dimasukkan


        // Masukkan data ke dalam jadual 'butiran_kuliah'
        for ($i = 0; $i < count($tarikh); $i++) {
            $sql_butiran = "INSERT INTO butiran_kuliah (pengecualian_id, tarikh, hari, masa, kod_kursus, nama_pensyarah, tandatangan, nota) 
                            VALUES ('$pengecualian_id', '$tarikh[$i]', '$hari[$i]', '$masa[$i]', '$kodkursus[$i]', '$namapensyarah[$i]', '$signpensyarah[$i]', '$nota[$i]')";
            $conn->query($sql_butiran);
        }

        echo "Permohonan berjaya disimpan!";
    } else {
        echo "Ralat: " . $conn->error;
    }
}

$conn->close();
?>
