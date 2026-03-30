<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM disposisi WHERE kd_disposisi = '$id'");

    echo '<script>alert("Data berhasil dihapus"); window.location="disposisi.php"</script>';
}

?>
