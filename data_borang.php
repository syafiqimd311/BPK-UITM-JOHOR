<?php
include 'proses.php'; // Sambung ke pangkalan data

// Query untuk mendapatkan data dari jadual pengecualian
$sqlPengecualian = "SELECT * FROM pengecualian";
$resultPengecualian = $conn->query($sqlPengecualian);

// Query untuk mendapatkan data dari jadual borang_kuliah
$sqlButiranKuliah = "SELECT * FROM butiran_kuliah";
$resultButiranKuliah = $conn->query($sqlButiranKuliah);
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
        <div class="imgcontainer" style="text-align: center;">
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
        <!-- Jadual Data Pengecualian -->
        <h2>Data Pengecualian</h2>
        <table>
            <tr>
                <th>No. Pelajar</th>
                <th>Mula</th>
                <th>Tamat</th>
                <th>Bilangan Hari</th>
                <th>Sebab</th>
                <th>Tindakan</th>
            </tr>
            <?php
            if ($resultPengecualian->num_rows > 0) {
                while ($row = $resultPengecualian->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['pelajar_id']}</td>
                            <td>{$row['mula']}</td>
                            <td>{$row['tamat']}</td>
                            <td>{$row['bil_hari']}</td>
                            <td>{$row['sebab']}</td>
                            <td>
                                <form method='post' action='delete_data.php' onsubmit='return confirm(\"Adakah anda pasti ingin memadamkan rekod ini?\");'>
                                    <input type='hidden' name='id' value='{$row['pengecualian_id']}'>
                                    <button type='submit'>Padam</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align: center;'>Tiada data dijumpai</td></tr>";
            }
            ?>
        </table>

        <!-- Jadual Data Borang Kuliah -->
        <h3>Butiran Kuliah</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Tarikh</th>
                <th>Hari</th>
                <th>Masa</th>
                <th>Kod Kursus</th>
                <th>Nama Pensyarah</th>
                <th>Tanda Tangan Pensyarah</th>
                <th>Nota</th>
            </tr>
            <?php
            if ($resultButiranKuliah->num_rows > 0) {
                while ($row = $resultButiranKuliah->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['pengecualian_id']}</td>
                            <td>{$row['tarikh']}</td>
                            <td>{$row['hari']}</td>
                            <td>{$row['masa']}</td>
                            <td>{$row['kod_kursus']}</td>
                            <td>{$row['nama_pensyarah']}</td>
                            <td>{$row['tandatangan']}</td>
                            <td>{$row['nota']}</td>
                            <td>
                                <form method='post' action='delete_data.php' onsubmit='return confirm(\"Adakah anda pasti ingin memadamkan rekod ini?\");'>
                                    <input type='hidden' name='id' value='{$row['butiran_id']}'>
                                    <button type='submit'>Padam</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align: center;'>Tiada data dijumpai</td></tr>";
            }
            ?>
                          </tr>
        
        </table>
    </main>
    </section>

    <footer>
        <p style="text-align: center;">&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
