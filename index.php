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
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="stylesheet" href="stylesheet/style-mobile.css">
</head>
<body>
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

        <div class="header-container">
            <div class="header-item-left">
                <div class="pesan-container">
                    <?php if(isset($_GET['pesan'])) {?>
                        <div class="pesan-sukses"> <?php echo $_GET['pesan']; ?> </div>
                    <?php } ?>
                </div>
                <h1>LISTRIK BIRU</h1>
                <p><b>Listrik Biru</b> Pulsa listrik di rumah mau habis tapi belum beli token listrik karena males keluar? Tenang, kini Anda bisa beli token listrik prabayar dan tagihan listrik pascabayar dengan cepat dan mudah bisa di mana saja dan kapan saja hanya dengan satu aplikasi.
                <br>
                Pulsa listrik di rumah sudah mau habis tapi malas keluar untuk beli token listrik prabayar? Mau beli token listrik prabayar dengan cepat dan mudah? Yuk beli token listrik prabayar murah dengan proses yang aman dan cepat hanya di <b>Listrik Biru</b>!</p>
                <a href="user/pembelian.php">
                    <button class="rent-btn">Pesan!</button>
                </a>
                <a href="tarif.php">
                    <button class="play-btn">Tarif</button>
                </a>
            </div>
            <div class="header-item-right">
            </div>
        </div>
    </header>
    <!-- END HEADER -->


    <!-- MAIN CONTENT -->
    <section>
        <div class="about-container mode-bg mode-text" id="about">
            <div class="about-title">
                <h2>ABOUT US</h2>
            </div>
            <div class="about-content">
                <p class="about-item-left"><b>Listrik Biru</b> adalah layanan prabayar listrik online Samarinda milik swasta yang berspesialisasi dalam transaksi listrik untuk sistem, mulai dari generasi keenam dan seterusnya. Model bisnis <b>Listrik Biru</b> mirip dengan layanan dalam membeli pulsa secara online dan langganan secara online. <b>Listrik Biru</b> mengirimkan token listrik ke pelanggan dengan biaya yang ditetapkan.</p>
                <p class="about-item-right">Lebih dari 1 tarif tersedia. Pada Mei 2018, Electronic Arts mengumumkan bahwa mereka mengakuisisi aset dan personel teknologi cloud dari <b>Listrik Biru</b> (termasuk pos terdepan Chicago). <b>Listrik Biru</b> saat ini dimiliki oleh grup kepemilikan yang sama dengan Alliance Entertainment dan dioperasikan sebagai perusahaan yang berdiri sendiri.</p>
            </div>
        </div>

        <div class="service-container">
            <h3>Daftar Tarif</h3>
            <div class="service-cards">
                <?php
                    require('php/connection.php');
                    $sql="SELECT * FROM tarif";
                    $query= mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($query)) { 
                ?>
                    <div class="card-panel mode-bg mode-text" onclick="window.location='tarif.php'">
                        <div class="grid-container">
                            <div>
                                <img src="img/voltase/<?php echo $data['foto'] ?>"/>
                                <p>
                                    <?php echo "$data[id]"; ?> ||
                                    <?php echo "$data[daya]"; ?><br>
                                </p>
                                <p>
                                    Rp.<?php echo "$data[tarifperkwh]"; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->


    <!-- FOOTER -->
    <footer class="mode-bg" style="position: static;">
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
                            <a href="https://www.instagram.com/listrik-biru" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                        <div class="circle fb">
                            <a href="https://www.facebook.com/listrik-biru" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-facebook"></i></a>
                        </div>
                        <div class="circle wa">
                            <a href="https://www.whatsapp.com/listrik-biru" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                        <div class="circle tw">
                            <a href="https://www.twitter.com/listrik-biru" onclick="return confirm('You will be redirected to other website.');"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="js/dark-mode.js"></script>
    <script src="js/navbar-mobile.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
</body>
</html>