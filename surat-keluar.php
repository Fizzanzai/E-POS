<?php
session_start();
include 'db.php';

if (isset($_POST['update'])) {

    mysqli_query($conn, "UPDATE surat_keluar SET
    no_agenda='" . $_POST['no_agenda'] . "',
    no_surat='" . $_POST['no_surat'] . "',
    prihal='" . $_POST['prihal'] . "',
    jenis_surat='" . $_POST['jenis_surat'] . "',
    tujuan='" . $_POST['tujuan'] . "',
    alamat_tujuan='" . $_POST['alamat_tujuan'] . "',
    tanggal_kirim='" . $_POST['tanggal_kirim'] . "'
WHERE kd_surat_keluar='" . $_POST['id'] . "'
");

    echo "<script>window.location='surat-keluar.php'</script>";
}

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Keluar</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <h1><a href="dashboard.php">E-POS</a></h1>
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
            <h3>Data Surat Keluar</h3>

            <div class="box">

                <div class="action-bar">
                    <a href="tambah-surat-keluar.php" class="btn-tambah">+ Tambah Surat</a>
                </div>

                <table border="1" class="table-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Tujuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM surat_keluar ORDER BY kd_surat_keluar DESC");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_surat'] ?></td>
                                <td><?= $row['prihal'] ?></td>
                                <td><?= $row['tujuan'] ?></td>
                                <td>

                                    <a href="#view<?= $row['kd_surat_keluar'] ?>" class="btn-aksi btn-view">View</a>

                                    <a href="hapus-surat-keluar.php?id=<?= $row['kd_surat_keluar'] ?>"
                                        class="btn-aksi btn-hapus"
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

                    <div id="view<?= $row['kd_surat_keluar'] ?>" class="modal">
                        <div class="modal-content">

                            <a href="#" class="modal-close">&times;</a>

                            <h3>Detail Surat Keluar</h3>

                            <table class="modal-table">
                                <tr>
                                    <td>No Agenda</td>
                                    <td>: <?= $row['no_agenda'] ?></td>
                                </tr>
                                <tr>
                                    <td>No Surat</td>
                                    <td>: <?= $row['no_surat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>: <?= $row['prihal'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Surat</td>
                                    <td>: <?= $row['jenis_surat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tujuan</td>
                                    <td>: <?= $row['tujuan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Tujuan</td>
                                    <td>: <?= $row['alamat_tujuan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tgl Kirim</td>
                                    <td>: <?= $row['tanggal_kirim'] ?></td>
                                </tr>
                            </table>

                            <br>

                            <a href="#edit<?= $row['kd_surat_keluar'] ?>" class="btn-aksi btn-edit">Edit</a>
                            <a href="#" class="btn">Tutup</a>

                        </div>
                    </div>


                    <div id="edit<?= $row['kd_surat_keluar'] ?>" class="modal">
                        <div class="modal-content">

                            <a href="#" class="modal-close">&times;</a>

                            <h3>Edit Surat Keluar</h3>

                            <form method="POST">

                                <input type="hidden" name="id" value="<?= $row['kd_surat_keluar'] ?>">

                                <label>No Agenda</label>
                                <input type="text" name="no_agenda" class="input-control"
                                    value="<?= $row['no_agenda'] ?>" required>

                                <label>No Surat</label>
                                <input type="text" name="no_surat" class="input-control"
                                    value="<?= $row['no_surat'] ?>" required>

                                <label>Perihal</label>
                                <input type="text" name="prihal" class="input-control"
                                    value="<?= $row['prihal'] ?>" required>

                                <label>Jenis Surat</label>
                                <input type="text" name="jenis_surat" class="input-control"
                                    value="<?= $row['jenis_surat'] ?>" required>

                                <label>Tujuan</label>
                                <input type="text" name="tujuan" class="input-control"
                                    value="<?= $row['tujuan'] ?>" required>

                                <label>Alamat Tujuan</label>
                                <input type="text" name="alamat_tujuan" class="input-control"
                                    value="<?= $row['alamat_tujuan'] ?>" required>

                                <label>Tanggal Kirim</label>
                                <input type="date" name="tanggal_kirim" class="input-control"
                                    value="<?= $row['tanggal_kirim'] ?>" required>

                                <br>

                                <input type="submit" name="update" value="Update" class="btn">

                            </form>

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