<?php
    include('../php/connection.php');
    session_start();

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hasil = mysqli_query($conn, "SELECT id, username, password, level FROM user WHERE username = '$username'");

        if(mysqli_num_rows($hasil) === 1) {
            $row = mysqli_fetch_assoc($hasil);
            
            if(password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['akun'] = $row;
                header('location: ../index.php');
                exit;
            } else {
                $error_pass = true;
            }
        } else {
            $error_username = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title & Web Icon -->
    <title>Listrik Biru - Login</title>
    <link rel="shortcut icon" href="../img/logo/logo-listrik.png">
    
    <!-- CSS -->
    <link rel="Stylesheet" href="../stylesheet/Login.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
</head>

<body>
    <div class="mainLogin">
        <p class="login" align="center">ListrikBiru</p>
        <div class="error-handle">
            <?php if(isset($error_pass)){ echo "<p class='handle-output'>Password anda salah!</p>"; }?>
            <?php if(isset($error_username)){ echo "<p class='handle-output'>Akun tidak ditemukan!</p>"; }?>
            <?php if(isset($_GET['pesan'])) { ?>
                <p class="success-message"><?php echo $_GET['pesan']; ?></p>
            <?php } ?> 
        </div>
        <form method="post" class="formLogin">
            <input  class="userNameLogin" type="text"     align="center" placeholder="Username" name="username">
            <input  class="passLogin"     type="password" align="center" placeholder="Password" name="password">
        
            <button align="center" name="login" type="submit">Masuk</button>
            <p      class="daftarLogin" align="center"><a href="register.php">Daftar</p>         
    </div>
</body>
</html>