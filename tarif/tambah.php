<?php 
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user') {
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="Stylesheet" href="../stylesheet/Tarif-new.css">
</head>
<body>
    <div class="mainTarif">
        <p    class="tarif" align="center">Tambah Tarif</p>
        <form class="formTarif" action="aksi/create.php" method="POST" enctype="multipart/form-data">
            <label class="ket">GAMBAR</label>
            <input class="idTarif"    type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png, .gif" align="center" required>

            <label class="ket">DAYA</label>
            <input class="dayaTarif"  type="number" name="daya" id="daya" align="center" required>

            <label class="ket">TARIF/kWH</label>
            <input class="hargaTarif" type="number" name="tarifperkwh" id="tarifperkwh" align="center" required>

            <button align="center" type="submit" name="create">Simpan</button>
            <p      class="kembali" align="center"><a href="../tarif.php">Kembali</p>    
		</form>     
    </div>
</body>
</html>