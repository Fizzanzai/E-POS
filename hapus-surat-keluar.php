<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM surat_keluar WHERE kd_surat_keluar = '$id'");

    echo '<script>alert("Data berhasil dihapus"); window.location="surat-keluar.php"</script>';
}

?>