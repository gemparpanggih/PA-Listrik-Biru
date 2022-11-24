<?php 
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user' || $_GET['id'] == '') {
        header("Location: ../tarif.php");
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
    <link rel="shortcut icon" href="../img/logo/logo-listrik.png">

    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="Stylesheet" href="../stylesheet/Tarif-new.css">
</head>
  
<body>
	<?php
	    require('../php/connection.php');
		$id=$_GET['id'];
		$sql = "SELECT * FROM tarif WHERE id ='$id'";
		$query = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($query);
	?>
    <div class="mainTarif">
        <p    class="tarif" align="center">Ubah Tarif</p>
        <form class="formTarif" action='aksi/update.php?id=<?php echo "$id"; ?>' method='POST' enctype="multipart/form-data">
            <label class="ket">GAMBAR</label>
            <p class="ket" style="margin: 0; font-size: 10px;">gambar default: <?php echo $data['foto'] ?></p>
            <input class="idTarif"    type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png, .gif" value="<?php echo $data['foto'] ?>" align="center">

            <label class="ket">DAYA</label>
            <input class="dayaTarif"  type="text" name="daya" value="<?php echo $data['daya'] ?>" align="center">

            <label class="ket">TARIF/kWH</label>
            <input class="hargaTarif" type="text" name="tarifperkwh" value="<?php echo $data['tarifperkwh'] ?>" align="center">

            <button align="center" type="submit" name="update">Simpan</button>
            <p      class="kembali" align="center"><a href="../tarif.php">Kembali</p>         
        </form>
    </div>
</body>
</html>