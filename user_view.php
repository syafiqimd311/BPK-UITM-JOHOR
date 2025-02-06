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
            <h3>Maklumat Feedback</h3>
            <div class="feedback">
                <?php
                // Sambungan ke database
                $host = "localhost";
                $user = "root";
                $pass = "";
                $borangdb = "borangdb";

                $conn = new mysqli($host, $user, $pass, $borangdb);

                // Periksa sambungan
                if ($conn->connect_error) {
                    die("Sambungan gagal: " . $conn->connect_error);
                }

                // Ambil data terkini dari jadual 'keputusan'
                $sql = "SELECT * FROM keputusan ORDER BY keputusan_id DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Ulasan:</strong> " . htmlspecialchars($row['ulasan']) . "</p>";
                    echo "<p><strong>Tarikh Ulasan:</strong> " . htmlspecialchars($row['tarikh_ulasan']) . "</p>";
                    echo "<p><strong>Keputusan:</strong> " . htmlspecialchars($row['status_keputusan']) . "</p>";
                    echo "<p><strong>Tindakan:</strong> " . htmlspecialchars($row['tindakan']) . "</p>";
                    echo "<p><strong>Tarikh Keputusan:</strong> " . htmlspecialchars($row['tarikh_keputusan']) . "</p>";
                } else {
                    echo "<p>Tiada data untuk dipaparkan.</p>";
                }

                // Tutup sambungan
                $conn->close();
                ?>
            </div>
        </main>
        <div style="position: fixed; bottom: 20px; left: 20px;">
    <a href="permohonan.php">
        <img src="kembali.png" alt="seterusnya" style="width:100px; height:100px;">
    </a>
</div>
    </section> 

    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
