<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

/* ===== HITUNG DATA ===== */
$surat_masuk   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM surat_masuk"))['total'];
$surat_keluar  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM surat_keluar"))['total'];
$disposisi     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM disposisi"))['total'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>

<header>
    <div class="container">
        <h1>E-POS</h1>
        <ul>
            <li><a href="dashboard.php">Beranda</a></li>
            <li><a href="data-petugas.php">Data Petugas</a></li>
            <li><a href="surat-masuk.php">Surat Masuk</a></li>
            <li><a href="surat-keluar.php">Surat Keluar</a></li>
            <li><a href="disposisi.php">Disposisi</a></li>
            <li><a href="logout.php">Keluar</a></li>
        </ul>
    </div>
</header>

<div class="section">
    <div class="container">

        <h3>Dashboard</h3>

        <div class="box">
            <h4>Selamat Datang, <b><?= $_SESSION['a_global']->nama_lengkap ?></b></h4>
            <p>Ringkasan data surat</p>
        </div>

        <!-- ===== STATISTIK ===== -->
        <div class="box">
            <table class="table-center" border="1">
                <tr>
                    <th>Jenis Data</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>Surat Masuk</td>
                    <td><b><?= $surat_masuk ?></b></td>
                </tr>
                <tr>
                    <td>Surat Keluar</td>
                    <td><b><?= $surat_keluar ?></b></td>
                </tr>
                <tr>
                    <td>Disposisi</td>
                    <td><b><?= $disposisi ?></b></td>
                </tr>
            </table>
        </div>

    </div>
</div>

<footer>
    <div class="container">
        <small>Copyright © 2026</small>
    </div>
</footer>

</body>
</html>
