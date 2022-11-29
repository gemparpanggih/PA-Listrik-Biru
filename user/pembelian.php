<?php 
    session_start();
    require '../php/connection.php';

    if(!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    } else {
        $id_user = $_SESSION['akun']['id'];
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
    <link rel="Stylesheet" href="../stylesheet/PembelianCustomer.css">
</head>

<body>
    <div class="mainPembelian">
        <div class="bungkus1">
            <form class="" action="pembelian/struk.php" method="POST">
                <h3    class="judul">Pembelian</h3>
                <label class="ket">TANGGAL PEMBELIAN</label>
                <input class="tglPembelian"    type="text"  name="tanggal" id="tanggal" value="<?php date_default_timezone_set("Asia/Makassar"); echo date("D, d M Y"); ?>" readonly>
    
                <label class="ket">JUMLAH PEMBELIAN</label>
                <input class="jumlahPembelian" name="jumlahbeli" id="jumlahbeli" type="number"  required>
    
                <label class="ket">NOMOR METER</label>
                <input class="nomorMeter"      name="nometer" id="nometer" type="number"  required>
    
                <label  class ="ket">PILIH ID TARIF</label>
                <select class = "idTarif" name="idtarif" id="idtarif">
                    <?php
                    	require('../php/connection.php');

                        $kodetarif = mysqli_query($conn, "SELECT * FROM tarif");
                        while ($p = mysqli_fetch_array($kodetarif)){
                            echo "<option value='$p[id]'>($p[id])</option>";
                        }
                    ?>
                </select>

                <input type="text" name="iduser" value="<?php echo $id_user ?>" hidden>
    
                <button align="center" type="submit" name="create">Simpan</button>
                <p class="kembali" align="center" ><a href="../index.php">Kembali</a></p>
            </form>

            <div class="bungkus2">
                <h3 class="judul" \>Informasi Tarif</h3>
                <div class="infoTarif">
                    <div class="boxTarif">
                    <?php
                        $sql = mysqli_query($conn, "SELECT * FROM tarif");
                        while ($data = mysqli_fetch_array($sql)){ ?>
                            <div class="isiBoxTarif">
                                <h5><?php echo $data['id'] ?></h5>
                                <span class="material-icons">bolt</span>
                                <ul class="isi">
                                    <li>Daya <strong><?php echo $data['daya'] ?></strong></li>
                                    <li>Tarif/Kwh <strong><?php echo $data['tarifperkwh'] ?></strong></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>