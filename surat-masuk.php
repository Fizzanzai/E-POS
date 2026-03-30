<?php
session_start();

if (isset($_GET['status'])) {

    if ($_GET['status'] == 'gagal-disposisi') {
        echo "<script>
            alert('❌ Surat tidak bisa dihapus!\nMasih ada data disposisi.\nHapus disposisi terlebih dahulu.');
        </script>";
    }

    if ($_GET['status'] == 'hapus-sukses') {
        echo "<script>
            alert('✅ Surat masuk berhasil dihapus');
        </script>";
    }
}


include 'db.php';

if (isset($_POST['update'])) {

    mysqli_query($conn, "UPDATE surat_masuk SET
    no_agenda='" . $_POST['no_agenda'] . "',
    no_surat='" . $_POST['no_surat'] . "',
    pengirim='" . $_POST['pengirim'] . "',
    prihal='" . $_POST['prihal'] . "',
    jenis_surat='" . $_POST['jenis_surat'] . "',
    tanggal_surat='" . $_POST['tanggal_surat'] . "',
    tanggal_terima='" . $_POST['tanggal_terima'] . "'
WHERE kd_surat_masuk='" . $_POST['id'] . "'
");


    echo "<script>window.location='surat-masuk.php'</script>";
}

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Surat Masuk</title>
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
            <h3>Data Surat Masuk</h3>

            <div class="box">

                <div class="action-bar">
                    <a href="tambah-surat-masuk.php" class="btn-tambah">+ Tambah Surat</a>
                </div>

                <table border="1" class="table-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Jenis Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM surat_masuk ORDER BY kd_surat_masuk DESC");

                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['pengirim'] ?></td>
                                <td><?= $row['prihal'] ?></td>
                                <td><?= $row['jenis_surat'] ?></td>
                                <td>

                                    <a href="#view<?= $row['kd_surat_masuk'] ?>"
                                        class="btn-aksi btn-view">View</a>

                                    <?php
                                    $cekDispo = mysqli_query($conn, "
                                        SELECT kd_disposisi 
                                        FROM disposisi 
                                        WHERE kd_surat_masuk = '" . $row['kd_surat_masuk'] . "'
                                    ");
                                    ?>

                                    <?php if (mysqli_num_rows($cekDispo) > 0) { ?>

                                        <!-- DISABLE HAPUS -->
                                        <button class="btn-aksi btn-hapus"
                                            style="background:#aaa; cursor:not-allowed;"
                                            disabled
                                            title="Masih ada disposisi">
                                            Hapus
                                        </button>

                                    <?php } else { ?>

                                        <!-- BOLEH HAPUS -->
                                        <a href="hapus.php?id=<?= $row['kd_surat_masuk'] ?>"
                                            class="btn-aksi btn-hapus"
                                            onclick="return confirm('Yakin hapus surat ini?')">
                                            Hapus
                                        </a>

                                    <?php } ?>

                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <!-- View -->


                <?php
                mysqli_data_seek($query, 0);
                while ($row = mysqli_fetch_array($query)) {
                ?>

                    <div id="view<?= $row['kd_surat_masuk'] ?>" class="modal">
                        <div class="modal-content">

                            <a href="#" class="modal-close">&times;</a>

                            <h3>Detail Surat Masuk</h3>

                            <table class="modal-table">
                                <tr>
                                    <td width="150">Kode Surat Masuk</td>
                                    <td>: <?= $row['kd_surat_masuk'] ?></td>
                                </tr>
                                <tr>
                                    <td width="150">No Agenda</td>
                                    <td>: <?= $row['no_agenda'] ?></td>
                                </tr>
                                <tr>
                                    <td>No Surat</td>
                                    <td>: <?= $row['no_surat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>: <?= $row['pengirim'] ?></td>
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
                                    <td>Tgl Surat</td>
                                    <td>: <?= $row['tanggal_surat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tgl Terima</td>
                                    <td>: <?= $row['tanggal_terima'] ?></td>
                                </tr>
                            </table>

                            <br>

                            <a href="#edit<?= $row['kd_surat_masuk'] ?>" class="btn-aksi btn-edit">Edit</a>
                            <a href="#" class="btn">Tutup</a>

                        </div>
                    </div>


                    <!-- Edit -->


                    <div id="edit<?= $row['kd_surat_masuk'] ?>" class="modal">
                        <div class="modal-content">

                            <a href="#" class="modal-close">&times;</a>

                            <h3>Edit Surat Masuk</h3>

                            <form method="POST">

                                <input type="hidden" name="id"
                                    value="<?= $row['kd_surat_masuk'] ?>">

                                <label>kd surat</label>
                                <input type="text" name="kd_surat_masuk"
                                    class="input-control"
                                    value="<?= $row['kd_surat_masuk'] ?>" readonly>

                                <label>No Agenda</label>
                                <input type="text" name="no_agenda"
                                    class="input-control"
                                    value="<?= $row['no_agenda'] ?>" required>

                                <label>No Surat</label>
                                <input type="text" name="no_surat"
                                    class="input-control"
                                    value="<?= $row['no_surat'] ?>" required>

                                <label>Pengirim</label>
                                <input type="text" name="pengirim"
                                    class="input-control"
                                    value="<?= $row['pengirim'] ?>" required>

                                <label>Perihal</label>
                                <input type="text" name="prihal"
                                    class="input-control"
                                    value="<?= $row['prihal'] ?>" required>

                                <label>Jenis Surat</label>
                                <input type="text" name="jenis_surat"
                                    class="input-control"
                                    value="<?= $row['jenis_surat'] ?>" required>

                                <label>Tanggal Surat</label>
                                <input type="date" name="tanggal_surat"
                                    class="input-control"
                                    value="<?= $row['tanggal_surat'] ?>" required>

                                <label>Tanggal Terima</label>
                                <input type="date" name="tanggal_terima"
                                    class="input-control"
                                    value="<?= $row['tanggal_terima'] ?>" required>

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