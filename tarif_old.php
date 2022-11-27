<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        print_r($_SESSION);
        header('location: auth/login.php');
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
    <link rel="shortcut icon" href="img/logo/logo-listrik.png">
    
    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/213e56f9ea368890b9d2da0577e49dab?family=Zona+Pro" rel="stylesheet" type="text/css"/>

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="stylesheet/tarif.css">
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="stylesheet" href="stylesheet/style-mobile.css">
</head>
<body class="mode-bg">
    <!-- HEADER -->
    <header class="main" id="home">
        <!-- navbar -->
        <nav class="mode-bg">
            <div class="logo">
                <a href="index.php" class="mode-text">
                    <img src="img/logo/logo-listrik.png" alt="">
                    <p>Listrik Biru</p>
                </a>
            </div>

            <ul>
                <li><a class="mode-text" href="tarif.php">Tarif</a></li>
                <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                    <li><a class="mode-text" href="admin/transaksi.php">Transaksi</a></li>
                    <li><a class="mode-text" href="admin/pelanggan.php">Pelanggan</a></li>
                    <li><a class="mode-text" href="admin/daftar-pesan.php">Kontak</a></li>
                <?php } if($_SESSION['akun']['level'] == 'user') { ?>
                    <li><a class="mode-text" href="user/profil.php">Profil</a></li>
                    <li><a class="mode-text" href="user/kontak.php">Kontak</a></li>
                <?php } ?>
                <div class="logout-btn">
                    <a href="auth/logout.php">Logout</a>
                </div>
            </ul>
            <div class="dark-mode-toggle">
                <input type="checkbox" class="checkbox" id="chk"/>
                <label class="label" for="chk">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                    <div class="ball"></div>
                </label>
            </div>

            <div class="menu-toggle">
                <input type="checkbox" id="menTog"/>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <!-- end navbar -->
    </header>
    <!-- END HEADER -->
	
    <!-- TARIF CONTENT -->
    <div class="container minggirin-navbar">
        <div class="grid-container">
            <?php
                require('php/connection.php');
				$sql="SELECT * FROM tarif";
				$query= mysqli_query($conn, $sql);
				while ($data = mysqli_fetch_array($query)) {
			?>
                <div>
                    <img src="img/voltase/<?php echo $data['foto'] ?>" onclick="window.location='tarif/tambah.php'"/>
                    <p>
                        <?php echo "$data[id]"; ?> ||
                        <?php echo "$data[daya]"; ?><br>
                    </p>
                    <p>
                        Rp.<?php echo "$data[tarifperkwh]"; ?>
                    </p>
                    <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                        <p class="aksi">
                            <a class="edit" href="tarif/edit.php?id=<?php echo"$data[id]"; ?>">EDIT</a>
                            <a class="hapus" href="tarif/aksi/delete.php?id=<?php echo"$data[id]"; ?>" onclick="return confirm('YAKINNN !!!')">HAPUS</a>
                        </p>
                    <?php } ?>
                </div>
			<?php } if($_SESSION['akun']['level'] == 'admin') { ?>
                <div class="add-card">
                    <div class="add-img" onclick="window.location='tarif/tambah.php'">
                        <img src="img/voltase/add.jpg"/>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- END TARIF CONTENT -->
    
    <!-- FOOTER -->
    <div style="border: 1px solid white; margin-top: 225px;"></div>
    <footer class="mode-bg" style="position: static">
        <div class="footer-container">
            <div class="footer-title" id="contact">
                <h2>CONTACT US</h2>
            </div>
            <div class="footer-contact-item">
                <div class="footer-item">
                    <h4>Location</h4>
                    <p>28 Jackson Blvd Ste 1020 Chicago<br>IL 60604-2340<br>Phone: +628 135 158 0524</p>
                </div>
                <div class="footer-item">
                    <h4>Find Us On</h4>
                    <div class="circle-container">
                        <!-- salah satu fitur pop up box (confirm) -->
                        <div class="circle ig">
                            <a href="https://www.instagram.com/pixel" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                        <div class="circle fb">
                            <a href="https://www.facebook.com/pixel" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-facebook"></i></a>
                        </div>
                        <div class="circle wa">
                            <a href="https://www.whatsapp.com/pixel" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                        <div class="circle tw">
                            <a href="https://www.twitter.com/pixel" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="js/navbar-mobile.js"></script>
    <script src="js/dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
</body>
</html>