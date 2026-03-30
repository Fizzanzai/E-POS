<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

/* AUTO AGENDA */
$qAgenda = mysqli_query($conn, "SELECT MAX(no_agenda) as agenda FROM surat_keluar");
$dAgenda = mysqli_fetch_array($qAgenda);
$agenda_baru = intval($dAgenda['agenda']) + 1;

/* AUTO KODE */
$tanggal = date("Ymd");
$qKode = mysqli_query($conn, "SELECT kd_surat_keluar FROM surat_keluar WHERE kd_surat_keluar LIKE 'SK-$tanggal-%' ORDER BY kd_surat_keluar DESC LIMIT 1");
$dKode = mysqli_fetch_array($qKode);

if ($dKode) {
    $no_urut = (int)substr($dKode['kd_surat_keluar'], -3);
    $no_urut++;
} else {
    $no_urut = 1;
}

$kode_baru = "SK-$tanggal-" . sprintf("%03d", $no_urut);


if (isset($_POST['submit'])) {

    $user = $_SESSION['a_global']->kd_petugas;

    mysqli_query($conn, "INSERT INTO surat_keluar(
        kd_surat_keluar,
        kd_petugas,
        no_agenda,
        no_surat,
        prihal,
        jenis_surat,
        tujuan,
        alamat_tujuan,
        tanggal_kirim
    ) VALUES (
        '$kode_baru',
        '$user',
        '$agenda_baru',
        '" . $_POST['no_surat'] . "',
        '" . $_POST['prihal'] . "',
        '" . $_POST['jenis_surat'] . "',
        '" . $_POST['tujuan'] . "',
        '" . $_POST['alamat_tujuan'] . "',
        '" . $_POST['tanggal_kirim'] . "'
)");

    echo "<script>window.location='surat-keluar.php'</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Surat Keluar</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




</head>

<body>

    <header>
        <div class="container">
            <h1><a href="dashboard.php">E-POS</a></h1>
            <ul>
                <li><a href="surat-keluar.php">Kembali</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Tambah Surat Keluar</h3>

            <div class="box">

                <form method="POST">

                    <label>Kode Surat</label>
                    <input type="text" class="input-control" value="<?= $kode_baru ?>" readonly>

                    <label>No Agenda</label>
                    <input type="text" class="input-control" value="<?= $agenda_baru ?>" readonly>

                    <input type="text" name="no_surat" placeholder="No Surat" class="input-control" required>

                    <input type="text" name="prihal" placeholder="Perihal" class="input-control" required>

                    <input type="text" name="jenis_surat" placeholder="Jenis Surat" class="input-control" required>

                    <input type="text" name="tujuan" placeholder="Tujuan" class="input-control" required>

                    <input type="text" name="alamat_tujuan" placeholder="Alamat Tujuan" class="input-control" required>

                    <label>Tanggal Kirim</label>
                    <input type="date" name="tanggal_kirim" class="input-control" required>

                    <input type="submit" name="submit" value="Simpan" class="btn">

                </form>

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