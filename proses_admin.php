<?php
// Sambungan ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "pengecualian_sistem";

$conn = new mysqli($host, $user, $pass, $db);

// Periksa sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Ambil data dari borang
$ulasan = $_POST['ulasan'];
$tandatangan_cop = $_POST['tandatangan_cop'];
$tarikh_ulasan = $_POST['tarikh_ulasan'];
$status_keputusan = $_POST['status_keputusan'];
$tindakan = $_POST['tindakan'];
$tarikh_keputusan = $_POST['tarikh_keputusan'];

// Masukkan data ke database
$sql = "INSERT INTO keputusan_pengecualian (ulasan, tandatangan_cop, tarikh_ulasan, status_keputusan, tindakan, tarikh_keputusan)
        VALUES ('$ulasan', '$tandatangan_cop', '$tarikh_ulasan', '$status_keputusan', '$tindakan', '$tarikh_keputusan')";

if ($conn->query($sql) === TRUE) {
    echo "Keputusan berjaya disimpan!";
} else {
    echo "Ralat: " . $conn->error;
}

// Tutup sambungan
$conn->close();
?>
