<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Login | E-POS</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bd-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
        if(isset($_POST['submit'])){
            session_start();
            include 'db.php';
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            $cek = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '".$user."' AND password = '".MD5($pass)."'");
            if(mysqli_num_rows($cek) > 0){
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->kd_petugas;
                echo '<script>window.location="dashboard.php"</script>';
            }else{
                echo '<script>alert("Username atau password salah!")</script>';
            }
            
        }
        ?>
    </div>
    
</body>
</html>