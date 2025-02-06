<?php
include 'borangdb.php';

$error_message = "";
$success_message = "";

// Query to retrieve categories for the dropdown
$pengecualian = $conn->query("SELECT pengecualian_id, pelajar_id FROM pengecualian");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pengecualian_id = $_POST['pengecualian_id'];
    $ulasan = $_POST['ulasan'];
    $tandatangan_cop = $_POST['tandatangan_cop'];
    $tarikh_ulasan = $_POST['tarikh_ulasan'];
    $status_keputusan = $_POST['status_keputusan'];
    $tindakan = $_POST['tindakan'];
    $tarikh_keputusan = $_POST['tarikh_keputusan'];

    // Validate required fields
    if (
        empty($pengecualian_id) || empty($ulasan) || empty($tandatangan_cop) ||
        empty($tarikh_ulasan) || empty($status_keputusan) || empty($tindakan) || empty($tarikh_keputusan)
    ) {
        $error_message = "Semua medan perlu diisi.";
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare(
            "INSERT INTO keputusan (pengecualian_id, ulasan, tandatangan_cop, tarikh_ulasan, status_keputusan, tindakan, tarikh_keputusan) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issssss", $pengecualian_id, $ulasan, $tandatangan_cop, $tarikh_ulasan, $status_keputusan, $tindakan, $tarikh_keputusan);

        if ($stmt->execute()) {
            $success_message = "Data berjaya disimpan!";
        } else {
            $error_message = "Ralat: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

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
            <center>
                <h3>Masukkan Ulasan dan Keputusan</h3>
            </center>

            <!-- Error and Success Messages -->
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
            <?php elseif (!empty($success_message)) : ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <form action="admin_input.php" method="POST">
                <div>
                    <label for="pengecualian_id">No. Pelajar:</label>
                    <select name="pengecualian_id" id="pengecualian_id" required>
                        <option value="">-- Pilih No. Pelajar --</option>
                        <?php while ($category = $pengecualian->fetch_assoc()) : ?>
                            <option value="<?= $category['pengecualian_id'] ?>">
                                <?= htmlspecialchars($category['pelajar_id']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div><br>

                <div>
                    <label for="ulasan">Ulasan:</label>
                    <textarea name="ulasan" id="ulasan" required></textarea>
                </div><br>

                <div>
                    <label for="tandatangan_cop">Tandatangan & Cop:</label>
                    <input type="text" name="tandatangan_cop" id="tandatangan_cop" required>
                </div><br>

                <div>
                    <label for="tarikh_ulasan">Tarikh Ulasan:</label>
                    <input type="date" name="tarikh_ulasan" id="tarikh_ulasan" required>
                </div><br>

                <div>
                    <label for="status_keputusan">Keputusan:</label>
                    <select name="status_keputusan" id="status_keputusan" required>
                        <option value="LULUS">LULUS</option>
                        <option value="TIDAK LULUS">TIDAK LULUS</option>
                    </select>
                </div><br>

                <div>
                    <label for="tindakan">Tindakan:</label>
                    <textarea name="tindakan" id="tindakan" required></textarea>
                </div><br>

                <div>
                    <label for="tarikh_keputusan">Tarikh Keputusan:</label>
                    <input type="date" name="tarikh_keputusan" id="tarikh_keputusan" required>
                </div><br>

                <button type="submit">Simpan</button>
            </form>
        </main>

        <div style="position: fixed; bottom: 20px; right: 20px;">
    <a href="pelajar.php">
        <img src="seterusnya.png" alt="seterusnya" style="width:100px; height:100px;">
    </a>
</div>
    </section>

    <footer>
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
