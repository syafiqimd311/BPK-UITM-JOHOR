<?php
include 'proses.php'; // Sambung ke pangkalan data

// Query untuk mendapatkan data dari jadual pelajar
$sql = "SELECT * FROM maklumat_pelajar";
$result = $conn->query($sql);

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
        <h2>Data Pelajar</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>No.Pelajar</th>
                <th>No.Kad Pengenalan</th>
                <th>Kod Program</th>
                <th>Bahagian</th>
                <th>No.Telefon</th>
                <th>No.Telefon Rumah</th>

            </tr>
            <?php
            // Semak jika terdapat data
            if ($result->num_rows > 0) {
                // Paparkan setiap baris data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['pelajar_id']}</td>
                            <td>{$row['nokp']}</td>
                            <td>{$row['kodprogram']}</td>
                            <td>{$row['bhg']}</td>
                            <td>{$row['nohp']}</td>
                            <td>{$row['norumah']}</td>
                            <td>
                            <form method='post' action='delete_data.php' onsubmit='return confirm(\"Adakah anda pasti ingin memadamkan rekod ini?\");'>
                                <input type='hidden' name='id' value='{$row['maklumat_id']}'>
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
        <p>&copy; 2025 UiTM Bhg HEA. All Rights Reserved.</p>
    </footer>
</body>
</html>
