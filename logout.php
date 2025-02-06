<?php
// Mulakan sesi
session_start();

// Reset semua data sesi
session_unset();
session_destroy();

// Arahkan pengguna ke halaman login
header("Location: index.php");
exit();
?>
