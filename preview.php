<?php
include 'borangdb.php';
// Sambungkan ke database
$con = new mysqli("localhost", "root", "", "borangdb");

// Periksa koneksi
if ($con->connect_error) {
    die("Sambungan gagal: " . $con->connect_error);
}

// Ambil semua data dari tabel maklumat_pelajar
$sql = "SELECT * FROM maklumat_pelajar ORDER BY created_at DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #003366;
            color: white;
        }
        img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #003366;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background: #218838;
        }
    </style>
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
                <li><a href="admin_input.php">ULASAN & KEPUTUSAN</a></li>
                <li><a href="pelajar.php">DATA PERMOHONAN</a></li>
                <li><a href="data_borang.php">DATA BORANG</a></li>
                <li><a href="preview.php">DATA PELAJAR</a></li>
                <li><a href="logout.php">LOG KELUAR</a></li>
            </ul>
        </nav>

        <main>

<div class="container">
<h2>Maklumat Lengkap Pelajar</h2>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Nama</th>
            <th>No. Pelajar</th>
            <th>No. K/P</th>
            <th>Kod Program</th>
            <th>Bhg</th>
            <th>No. HP</th>
            <th>No. Rumah</th>
            <th>Gambar</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['pelajar_id']) ?></td>
            <td><?= htmlspecialchars($row['nokp']) ?></td>
            <td><?= htmlspecialchars($row['kodprogram']) ?></td>
            <td><?= htmlspecialchars($row['bhg']) ?></td>
            <td><?= htmlspecialchars($row['nohp']) ?></td>
            <td><?= htmlspecialchars($row['norumah']) ?></td>
            <td><img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Bukti"></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>Tiada data telah dimasukkan lagi.</p>
            <?php endif; ?>

    <a class="back-link" href="borang.php">Kembali ke Borang</a>
</div>
</section>

<footer>
    <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
</footer>
</body>
</html>

<?php
// Tutup koneksi database
$con->close();
?>
