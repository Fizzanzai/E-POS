<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

// agenda

$queryAgenda = mysqli_query($conn,"SELECT MAX(no_agenda) as agenda FROM surat_masuk");
$dataAgenda = mysqli_fetch_array($queryAgenda);

$agenda_baru = intval($dataAgenda['agenda']) + 1;



// auto no surat

$tanggal = date("Ymd");

$q = mysqli_query($conn,"
SELECT kd_surat_masuk 
FROM surat_masuk 
WHERE kd_surat_masuk LIKE 'SM-$tanggal-%'
ORDER BY kd_surat_masuk DESC
LIMIT 1
");

$data = mysqli_fetch_array($q);

if($data){
    $no_urut = (int) substr($data['kd_surat_masuk'], -3);
    $no_urut++;
}else{
    $no_urut = 1;
}

$kode_baru = "SM-$tanggal-" . sprintf("%03d",$no_urut);


if (isset($_POST['submit'])) {

    $user = $_SESSION['a_global']->kd_petugas;

    $insert = mysqli_query($conn, "INSERT INTO surat_masuk (
        kd_surat_masuk,
        kd_petugas,
        no_agenda,
        no_surat,
        prihal,
        jenis_surat,
        pengirim,
        tanggal_surat,
        tanggal_terima
    ) VALUES (
        '$kode_baru',
        '$user',
        '$agenda_baru',
        '" . $_POST['no_surat'] . "',
        '" . $_POST['prihal'] . "',
        '" . $_POST['jenis_surat'] . "',
        '" . $_POST['pengirim'] . "',
        '" . $_POST['tanggal_surat'] . "',
        '" . $_POST['tanggal_terima'] . "'
    )");

    if ($insert) {
        echo '<script>alert("Surat berhasil ditambahkan"); window.location="surat-masuk.php"</script>';
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Surat Masuk</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <h1><a href="dashboard.php">E-POS</a></h1>
            <ul>
                <li><a href="surat-masuk.php">Kembali</a></li>
            </ul>
        </div>
    </header>


    <div class="section">
        <div class="container">
            <h3>Tambah Surat Masuk</h3>

            <div class="box">

                <form method="POST">

                    <label>Kode Surat Masuk</label>
                    <input type="text" class="input-control" value="<?= $kode_baru ?>" readonly>

                    <label>No Agenda</label>
                    <input type="text" class="input-control" value="<?= $agenda_baru ?>" readonly>

                    <input type="text" name="no_surat" placeholder="No Surat" class="input-control" required>

                    <input type="text" name="pengirim" placeholder="Pengirim" class="input-control" required>

                    <input type="text" name="prihal" placeholder="Perihal" class="input-control" required>

                    <input type="text" name="jenis_surat" placeholder="Jenis Surat" class="input-control" required>

                    <label>Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="input-control" required>

                    <label>Tanggal Terima</label>
                    <input type="date" name="tanggal_terima" class="input-control" required>

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