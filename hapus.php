<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// 🔍 CEK DISPOSISI
$cek = mysqli_query($conn, "
    SELECT 1 FROM disposisi 
    WHERE kd_surat_masuk = '$id'
");

if (mysqli_num_rows($cek) > 0) {

    // ❌ MASIH DIPAKAI DISPOSISI
    header("Location: surat-masuk.php?status=gagal-disposisi");
    exit;

} else {

    // ✅ AMAN HAPUS
    mysqli_query($conn, "DELETE FROM surat_masuk WHERE kd_surat_masuk='$id'");
    header("Location: surat-masuk.php?status=hapus-sukses");
    exit;
}
