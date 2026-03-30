<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

/* ================= AUTO KODE DISPOSISI ================= */
$tanggal = date("Ymd");

$q = mysqli_query($conn, "
    SELECT kd_disposisi 
    FROM disposisi 
    WHERE kd_disposisi LIKE 'DP-$tanggal-%'
    ORDER BY kd_disposisi DESC
    LIMIT 1
");

$data = mysqli_fetch_array($q);

if ($data) {
    $no_urut = (int) substr($data['kd_disposisi'], -3) + 1;
} else {
    $no_urut = 1;
}

$id = "DP-$tanggal-" . sprintf("%03d", $no_urut);

/* ================= INSERT DATA ================= */
if (isset($_POST['submit'])) {

    mysqli_query($conn, "INSERT INTO disposisi VALUES(
        '$id',
        '" . $_POST['kd_surat_masuk'] . "',
        '" . $_POST['penerima'] . "',
        '" . $_POST['keterangan'] . "',
        '" . $_POST['status_surat'] . "',
        '" . $_POST['tanggapan'] . "'
    )");

    echo "<script>window.location='disposisi.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Disposisi</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">  
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
            <form method="POST">

                <!-- KODE DISPOSISI -->
                <label>Kode Disposisi</label>
                <input type="text" class="input-control" value="<?= $id ?>" readonly>

                <!-- DROPDOWN SURAT MASUK -->
                <label>Kode Surat Masuk</label>
                <select name="kd_surat_masuk" class="input-control" required>
                    <option value="">-- Pilih Surat Masuk --</option>
                    <?php
                    $surat = mysqli_query($conn, "SELECT * FROM surat_masuk ORDER BY kd_surat_masuk DESC");
                    while ($s = mysqli_fetch_array($surat)) {
                    ?>
                        <option value="<?= $s['kd_surat_masuk'] ?>">
                            <?= $s['kd_surat_masuk'] ?> | <?= $s['pengirim'] ?> | <?= $s['prihal'] ?>
                        </option>
                    <?php } ?>
                </select>

                <input type="text" name="penerima" placeholder="Penerima" class="input-control" required>

                <textarea name="keterangan" placeholder="Keterangan" class="input-control"></textarea>

                <label>Status Surat</label>
                <select name="status_surat" class="input-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Ditinjau">Ditinjau</option>
                    <option value="Selesai">Selesai</option>
                </select>

                <textarea name="tanggapan" placeholder="Tanggapan" class="input-control"></textarea>

                <input type="submit" name="submit" value="Simpan" class="btn">
            </form>
        </div>
    </div>
</div>

</body>
</html>