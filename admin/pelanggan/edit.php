<?php
    session_start();
    if(!isset($_SESSION['login']) ){
        header("Location: ../../auth/login.php");
        exit;
    }
    
    if($_SESSION['akun']['level'] == 'user' || $_GET['id'] == '') {
        header("Location: ../../index.php");
        exit;
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
    <link rel="shortcut icon" href="../../img/logo/logo-listrik.png">

    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="Stylesheet" href="../../stylesheet/Pengguna.css">
</head>
  
<body>
	<?php
        include '../../php/connection.php';

		$id=$_GET['id'];
		$sql = "SELECT * FROM user WHERE id ='$id'";
		$query = mysqli_query($conn,$sql);
		$data = mysqli_fetch_array($query);
	?>
    <div class="mainPenggunaEdit">
        <p    class="pengguna" align="center">Ubah Data Pelanggan</p>
        <form class="formPengguna" method='POST'>

            <label class="ket">USERNAME</label>
            <input class="usernamePengguna"  type="text" name="username" id="username" value="<?php echo $data['username'] ?>" align="center">

            <label class="ket">PASSWORD</label>
            <input class="passPengguna" name="password" id="password" value="<?php echo $data['password'] ?>" align="center">

            <label class="ket">NAMA PELANGGAN</label>
            <input class="namaPelanggan" type="text" name="nama" id="nama" value="<?php echo $data['nama'] ?>" align="center">

            <label class="ket">NOMOR TELEPON</label>
            <input class="namaPelanggan" type="number" name="telepon" id="telepon" value="<?php echo $data['telepon'] ?>" align="center">

            <label class="ket">ALAMAT</label>
            <input class="namaPelanggan" type="text" name="alamat" id="alamat" value="<?php echo $data['alamat'] ?>" align="center">

            <button align="center" type="submit" name="update">Simpan</button>
            <p      class="kembali" align="center"><a href="../pelanggan.php">Kembali</p>         
    </div>

    <?php
        if(isset($_POST['update']))  {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $nama=$_POST['nama'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql2 ="UPDATE user SET username = '$username' , password = '$password' , nama = '$nama' WHERE id = '$id'";
            
            $query = mysqli_query($conn,$sql2);
            
            if($query) {
                header('location: ../pelanggan.php?pesan=Data berhasil diubah!');
            } else {
                echo"Edit Pelanggan Gagal";
            }
        }   
    ?>
</body>
</html>