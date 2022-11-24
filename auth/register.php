<?php
    require('../php/connection.php');
    
    if(isset($_POST['register'])) {
        require('../php/randomstr.php');

        $randstring = RandomString(4);
        $id = 'user'.$randstring;
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_pwd = $_POST['confirm-password'];

        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $level = 'user';

        $foto = 'default-pic.jpg';
        if($_FILES['gambar']['size'] != 0) {
            $format_file = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];
    
            $tipe = explode('.', $format_file);
            $foto = $username.'-'.$randstring.'.'.$tipe[1];
            move_uploaded_file($tmp_name, './../img/profil/' . $foto);
        }
        
        if($password === $confirm_pwd) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $hasil = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
            if(mysqli_fetch_assoc($hasil)) {
                echo '<script>
                    alert("Username already registered");
                </script>';
            } else {

                $sql = "INSERT INTO user (id, username, nama, telepon, alamat, foto, level, password) VALUES ('$id', '$username', '$nama', '$telepon', '$alamat', '$foto', '$level', '$password')";
                $push_data = mysqli_query($conn, $sql);
                
                if(mysqli_affected_rows($conn) > 0) {
                    echo '<script>
                        document.location.href = "login.php?pesan=Akun berhasil didaftarkan!";
                    </script>';
                } else {
                    echo '<script>
                        alert("Registrasi gagal");
                    </script>';
                }
            }
        } else {
            echo '<script>
                alert("Password is incorrect");
            </script>';
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
    <title>Listrik Biru - Register</title>
    <link rel="shortcut icon" href="../img/logo/logo-listrik.png">
    
    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/Daftar.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
</head>
<body>
    <div class="mainDaftar">
        <p class="daftar" align="center">Daftar</p>
        <form class="formDaftar" enctype="multipart/form-data" method="POST">
            <div id="group1" class="show">
                <input  type="text"     name="nama"     id="nama"   class="namaDaftar"  align="center" placeholder="Nama" required>
                <input  type="number"   name="telepon"  id="telepon"class="namaDaftar"  align="center" placeholder="Telepon" required>
                <input  type="text"     name="alamat"   id="alamat" class="namaDaftar"  align="center" placeholder="Alamat" required>
                <input  type="file"     name="gambar"   id="alamat" class="namaDaftar"  align="center" accept=".jpg,.jpeg,.png">
                <button align="center" onclick="onLoad('group2', 'group1')">Berikutnya</button>
            </div>
            <div id="group2" class="hide">
                <input type="text" name="username" id="username" class="namaDaftar"  align="center" placeholder="Username" required>
                <input type="password" name="password" id="password" class="passDaftar"  align="center" placeholder="Password" required>
                <input type="password" name="confirm-password" id="confirm-password" class="passDaftar" align="center" placeholder="Konfirmasi Password" required>
                <button align="center" type="submit" style="margin-top: 10px; margin-left: 35%;" name="register">Daftar !!</button>
                <p class="kembali" align="center" ><a href="#" onclick="onLoad('group1', 'group2')">Kembali</a></p>
            </div>
            <p      class="loginDaftar" align="center"><a href="login.php">Login?</p>
        </form>
    </div>

    <script src="../js/dropdown-option.js"></script>
</body>
</html>