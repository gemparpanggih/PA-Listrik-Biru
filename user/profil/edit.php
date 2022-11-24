<?php
    session_start();
    if(!isset($_SESSION['login']) ){
        header("Location: ../../auth/login.php");
        exit;
    }
    
    if($_SESSION['akun']['level'] == 'admin' || $_GET['id'] == '') {
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
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="Stylesheet" href="../../stylesheet/Pengguna.css">
</head>
  
<body>
	<?php
        require('../../php/connection.php');
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

            <label class="ket">NAMA PELANGGAN</label>
            <input class="namaPelanggan" type="text" name="nama" id="nama" value="<?php echo $data['nama'] ?>" align="center">

            <label class="ket">NOMOR TELEPON</label>
            <input class="namaPelanggan" type="number" name="telepon" id="telepon" value="<?php echo $data['telepon'] ?>" align="center">

            <label class="ket">ALAMAT</label>
            <input class="namaPelanggan" type="text" name="alamat" id="alamat" value="<?php echo $data['alamat'] ?>" align="center">

            <button align="center" type="submit" name="update">Simpan</button>
            <p      class="kembali" align="center"><a href="../profil.php">Kembali</p>         
    </div>

    <?php
        if(isset($_POST['update']))  {
            $username=$_POST['username'];
            $nama=$_POST['nama'];
            $telepon=$_POST['telepon'];
            $alamat=$_POST['alamat'];
            
            $sql2 ="UPDATE user SET username = '$username', nama = '$nama', telepon = '$telepon', alamat = '$alamat' WHERE id = '$id'";
            
            $query = mysqli_query($conn,$sql2);
            
            if($query) {
                header('location: ../profil.php');
            } else {
                echo "Edit Pelanggan Gagal";
            }
        }   
    ?>
</body>
</html>