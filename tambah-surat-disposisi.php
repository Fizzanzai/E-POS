<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Tambah Surat Disposisi</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="container">
        <h1><a href="dashboard.php">E-POS</a></h1>
        <ul>
            <li><a href="disposisi.php">Kembali</a></li>
        </ul>
    </div>
</header>

<div class="section">
    <div class="container">
        <h3>Tambah Disposisi</h3>

        <div class="box">
            <form action="" method="POST">

                <input type="text" name="no_agenda" placeholder="No Agenda" class="input-control" required>
                <input type="text" name="no_surat" placeholder="No Surat" class="input-control" required>
                <input type="text" name="penerima" placeholder="Penerima" class="input-control" required>
                <input type="text" name="keterangan" placeholder="keterangan" class="input-control" required>
                <input type="text" name="status_surat" placeholder="Status Surat" class="input-control" required>
                <input type="text" name="tanggapan" placeholder="Tanggapan" class="input-control" required>
                <input type="submit" name="submit" value="Simpan" class="btn">

            </form>

            <?php
            if (isset($_POST['submit'])) {

                $id   = 'SM'.date('ymdHis');
                $user = $_SESSION['id_petugas'];

                $insert = mysqli_query($conn, "INSERT INTO surat_masuk VALUES (
                    '$id',
                    '$user',
                    '".$_POST['no_agenda']."',
                    '".$_POST['no_surat']."',
                    '".$_POST['penerima']."',
                    '".$_POST['keterangan']."',
                    '".$_POST['status_surat']."',
                    '".$_POST['tanggapan']."'
                )");

                if ($insert) {
                    echo '<script>alert("Data berhasil disimpan"); window.location="disposisi.php"</script>';
                } else {
                    echo 'Gagal simpan '.mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <small>Copyright &copy; 2026</small>
    </div>
</footer>

</body>
</html>

