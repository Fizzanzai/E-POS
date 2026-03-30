<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM petugas WHERE kd_petugas = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width, initial-scale=1">
    <title>Data Petugas</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
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
            <h3>profil</h3>
            <div class="box">
            <form action="" method="POST">
                <input type="text" name="nama" placeholder="nama lengkap" class="input-control" value="<?php echo $d->nama_lengkap ?>" required>
                <input type="text" name="user" placeholder="usename" class="input-control" value="<?php echo $d->username ?>" required>
                <select class="input-control" name="jk" required>
                <option value="">--Pilih Jenis Kelamin--</option>
                <option value="L" <?php echo ($d->jenis_kelamin == 'L')? 'selected':''; ?>>Laki-laki</option>
                <option value="P" <?php echo ($d->jenis_kelamin == 'P')? 'selected':''; ?>>Perempuan</option>
                </select>
                <input type="text" name="alamat" placeholder="alamat" class="input-control" value="<?php echo $d->alamat ?>" required>
                <input type="submit" name="submit" value="ubah profil" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){

                    $nama       = ucwords($_POST['nama']);
                    $user       = $_POST['user'];
                    $alamat     = ucwords($_POST['alamat']);
                    $jk         = $_POST['jk'];

                    $update     = mysqli_query($conn, "UPDATE petugas SET
                                        nama_lengkap = '".$nama."',
                                        username = '".$user."',
                                        alamat = '".$alamat."',
                                        jenis_kelamin = '".$jk."'
                                        WHERE kd_petugas = '".$d->kd_petugas."' ");
                    if($update){
                        echo 'berhasil' ;
                    echo '<script>alert("ubah berhasil")</script>';
                    echo '<script>window.location="data-petugas.php</script>';
                    }else{
                        echo 'gagal' .mysqli_error($conn);
                    }
                }
            ?>  
            </div>  

            <h3>ubah password</h3>
            <div class="box">
                <form action="" method="POST">
                <input type="password" name="pass1" placeholder="password baru" class="input-control" required>
                <input type="password" name="pass2" placeholder="confirm password baru" class="input-control" required>
                <input type="submit" name="ubah_password" value="ubah password" class="btn">
                </form>
                <?php
                if(isset($_POST['ubah_password'])){
                        $pass1  = $_POST['pass1'];
                        $pass2  = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi password baru tidak sesuai")</script>';
                        }else{
                            $u_pass = mysqli_query($conn, "UPDATE petugas SET
                                        password = '".MD5($pass1)."' 
                                        WHERE kd_petugas = '".$d->kd_petugas."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah password berhasil")</script>';
                                echo '<script>window.location="data-petugas.php"</script>';
                            }else{
                                echo 'gagal ' . mysqli_error($conn);
                            }
                        }
                    }
                ?>  
            </div>  
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - givan.</small>
        </div>
    </footer>
</body>
</html>