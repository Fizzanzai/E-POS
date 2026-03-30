<?php
session_start();
include 'db.php';

if (isset($_POST['update'])) {

    mysqli_query($conn, "UPDATE disposisi SET
        kd_surat_masuk='" . $_POST['kd_surat_masuk'] . "',
        penerima='" . $_POST['penerima'] . "',
        keterangan='" . $_POST['keterangan'] . "',
        status_surat='" . $_POST['status_surat'] . "',
        tanggapan='" . $_POST['tanggapan'] . "'
    WHERE kd_disposisi='" . $_POST['id'] . "'");

    echo "<script>window.location='disposisi.php'</script>";
}

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Disposisi</title>
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
            <h3>Data Disposisi</h3>

            <div class="box">
                <div class="action-bar">
                    <a href="tambah-disposisi.php" class="btn-tambah">+ Tambah Disposisi</a>
                </div>

                <table border="1" class="table-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Disposisi</th>
                            <th>Kode Surat</th>
                            <th>Penerima</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM disposisi ORDER BY kd_disposisi DESC");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kd_disposisi'] ?></td>
                                <td><?= $row['kd_surat_masuk'] ?></td>
                                <td><?= $row['penerima'] ?></td>
                                <td><?= $row['status_surat'] ?></td>
                                <td>
                                    <a href="#view<?= $row['kd_disposisi'] ?>" class="btn-aksi btn-view">View</a>
                                    <a href="hapus-disposisi.php?id=<?= $row['kd_disposisi'] ?>" class="btn-aksi btn-hapus"
                                        onclick="return confirm('Yakin hapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php
                mysqli_data_seek($query, 0);
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div id="view<?= $row['kd_disposisi'] ?>" class="modal">
                        <div class="modal-content">
                            <a href="#" class="modal-close">&times;</a>

                            <h3>Detail Disposisi</h3>
                            <table class="modal-table">
                                <tr>
                                    <td>Kode Disposisi</td>
                                    <td>: <?= $row['kd_disposisi'] ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Surat</td>
                                    <td>: <?= $row['kd_surat_masuk'] ?></td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>: <?= $row['penerima'] ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: <?= $row['keterangan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>: <?= $row['status_surat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggapan</td>
                                    <td>: <?= $row['tanggapan'] ?></td>
                                </tr>
                            </table>

                            <br>
                            <a href="#edit<?= $row['kd_disposisi'] ?>" class="btn-aksi btn-edit">Edit</a>
                            <a href="#" class="btn">Tutup</a>
                        </div>
                    </div>
                <?php } ?>

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