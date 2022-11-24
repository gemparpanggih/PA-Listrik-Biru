<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        header("Location: ../../auth/login.php");
        exit;
    }
	
	if(isset($_POST['create'])) {
		require('../../php/connection.php');
		require('../../php/randomstr.php');
	
		$idUser = $_POST['iduser'];
		$rand4 = RandomString(4);
		$id = $idUser.'-'.$rand4;
        $token = RandomString(4, $num).'-'.RandomString(4, $num).'-'.RandomString(4, $num).'-'.RandomString(4, $num);
	
		$tanggal=$_POST['tanggal'];
		$nometer=$_POST['nometer'];
		
		$idtarif=$_POST['idtarif'];
		$jumlahbeli=$_POST['jumlahbeli'];
	
		$result = mysqli_query($conn, "SELECT tarifperkwh FROM tarif WHERE id = '$idtarif'");
		$hasil = mysqli_fetch_assoc($result);
		$totalkwh = round($jumlahbeli / $hasil['tarifperkwh'], 2);
	
		$sql = "INSERT INTO transaksi (id, iduser, tanggal, nominal, nometer, token, totalkwh, idtarif) VALUES('$id', '$idUser', '$tanggal','$jumlahbeli','$nometer', '$token', '$totalkwh','$idtarif')";
		$query = mysqli_query($conn,$sql);

		if ($query)  {
			$randcode = RandomString(14);
		} else {
			echo "Gagal Disimpan";
		}
	} else {
		header('location: ../../index.php');
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
    <link rel="Stylesheet" href="../../stylesheet/Tarif-new.css">
    <style>
        .container {
            background-color: #ffffff;
            padding: 30px;
            padding-top: 0;
            border-radius: 10px;
            margin: 30px 0;
        }
        .container input {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000000;
        }
        .container button {
            font-size: 18px;
            padding: 10px 20px;
            background-color: #577eff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
        }
        .copy-status{
            border-radius: 5px;
            padding: 5px;
            background-color: #577eff;
            display: block;
            color: white;
            width: 16%;
        }
        .btn-lanjutkan:hover {
            cursor: pointer;
        }
        
        .hide {
            display: none;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body style="margin-top: 170px; height: auto;">
    <div class="mainTarif" style="height: auto;">
        <p    class="tarif" align="center">Struk</p>
        <h3 class="ket">Berikut adalah kode pembayaran anda</h3>
        <div class="container">
            <p id="status" class="hide copy-status">Copied!</p>
            <input type="text" id="text-1" value="<?php echo $randcode ?>" style="width: 50%;" readonly/>
            <button onclick="copy('text-1')">Copy Text</button>
            <p style="font-size: 10px;"><em style='color: red;'>&#x2a;</em> Token listrik dapat anda cek pada halaman profil secara berkala.</p>
        </div>
        <a align="center" class="btn-lanjutkan" href="../../index.php">Lanjutkan</a>
    </div>

    <script>
        let copy = (textId) => {
            document.getElementById(textId).select();
            document.execCommand("copy");

            var group = document.getElementById('status');
            group.classList.remove('hide');
            group.classList.add('show');
        };
    </script>
</body>
</html>