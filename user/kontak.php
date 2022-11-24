<?php
    session_start();
    if(!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    if(isset($_POST['kontak'])){
        require('../php/connection.php');
        
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $pesan = $_POST['pesan'];
        $iduser = $_SESSION['akun']['id'];

        $sql = "INSERT INTO kontak (nama, email, nohp, pesan, iduser) VALUES ('$nama', '$email', '$nohp', '$pesan', '$iduser')";
        $push_data = mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn) > 0) {
            $sukses = 'Pesan berhasil dikirim!';
        } else {
            $sukses = 'Pesan gagal dikirim.';
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
    <title>Listrik Biru</title>
    <link rel="shortcut icon" href="../img/logo/logo-listrik.png">
    
    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="Stylesheet" href="../stylesheet/HubungiKami.css">
</head>

<body>
    <div class="mainHK">
        <div class="bungkus1">
            <form class="formHubungiKami" method="POST">
                <h3>Pesan Untuk Kami</h3>
                <?php if(isset($sukses)) { ?>
                    <p><?php echo $sukses ?></p>
                <?php } ?>
                <input    type="text"        class="inputHK" name="nama"  id="namaHK"  placeholder="Nama Lengkap"           required>
                <input    type="email"       class="inputHK" name="email" id="emailHK" placeholder="Email"                  required>
                <input    type="number"      class="inputHK" name="nohp"  id="NoHpHK"  placeholder="No.HP : XXXX XXXX XXXX" required>
                <textarea cols="30"rows="10" class="inputHK" name="pesan"   id="pesanHK" placeholder="Pesan..."></textarea>

                <div class="btn-pesan">
                    <button type="submit"       class="submitHK" name="kontak">Kirim</button>
                    <a      href="../index.php" class="submitHK">Kembali</a>
                </div>
            </form>

            <div class="bungkus2">
                <h3>Hubungi Kami</h3>
                
                <div class="infoHK">
                    <div class="kontak">
                        <span class="material-icons">location_on</span>
                        <p>777 Kec. Wales <br>Gunung Camlat, Britania raya</p>
                    </div>

                    <div class="kontak">
                        <span class="material-icons">local_phone</span>
                        <p>+628 2252 9400 03</p>
                    </div>

                    <div class="kontak">
                        <span class="material-icons">alternate_email</span>
                        <p><a href="gempar@listrikbiru.com">gempar@listrikbiru.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>