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
    <!-- <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/213e56f9ea368890b9d2da0577e49dab?family=Zona+Pro" rel="stylesheet" type="text/css"/> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="stylesheet/new/main.css">
    <link rel="stylesheet" href="stylesheet/component/sidebar.css">
    <link rel="stylesheet" href="stylesheet/nonavbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylesheet/tarif.css">
    <link rel="stylesheet" href="stylesheet/landingpage.css">
    <link rel="stylesheet" href="stylesheet/style-mobile.css">
    <link rel="stylesheet" href="stylesheet/component/sidebar.css">
    <link rel="stylesheet" href="stylesheet/nonavbar.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"/>
</head>
<body id="taif">
    <!-- HEADER -->
    <!-- Sidebar -->
    <aside class="sidebar offcanvas-lg offcanvas-start mode-bg">
        <div class="d-flex  m-4 d-block d-lg-none mode-bg">
            <button data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4" aria-label="Button Close">
            <i class="fas fa-close"></i>
            </button>
        </div>

        <!-- Logo -->
        <div class="logo-brand mt-lg-5">
            <a href="index.php">
                <img src="img/logo/logo-listrik.png" alt="Logo" width="45" height="50"/>
            </a>
            <div>
                <h6 class="title">Listrik Biru</h6>
                <p class="tagline">Nyalakan Rumah Anda</p>
            </div>
        </div>

        <!-- Menu -->
        <hr/>
        <nav class="menu flex-fill">
            <div class="section-menu">
                <a class="item-menu" href="tarif.php">Tarif</a>
                <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                    <a class="item-menu" href="admin/transaksi.php">Transaksi</a>
                    <a class="item-menu" href="admin/pelanggan.php">Pelanggan</a>
                    <a class="item-menu" href="admin/daftar-pesan.php">Kontak</a>

                <?php } if($_SESSION['akun']['level'] == 'user') { ?>
                    <a class="item-menu" href="user/profil.php">Profil</a>
                    <a class="item-menu" href="user/kontak.php">Kontak</a>
                <?php } ?>
            </div>
        </nav>

        <!-- FOOTER -->
        <footer>
            <div class="logout-btn">
                <a href="auth/logout.php">Logout</a>
            </div>
            <p class="Keterangan" >Projek Akhir Pemrograman Web</p>
        </footer>
        <!-- END FOOTER -->
    </aside>
    <!-- End Sidebar -->
    <!-- END HEADER -->
	
    <!-- TARIF CONTENT -->
    <section id="tarif-admin">
        <div class="container mt-4 d-flex justify-content-center">
            <div class="row w-75">
            <?php
                require('php/connection.php');

                $sql = mysqli_query($conn, "SELECT * FROM tarif");
                while ($data = mysqli_fetch_array($sql)){ 
            ?>
                <div class="col-3 mb-4">
                    <div class="card shadow" style="width: 11.30rem; height: 13rem; border: 0;">
                        <div class="card-tarif card-body text-center">
                            <h5 class="card-title text-primary"><b><?php echo $data['id'] ?></b></h5>
                            <span class="material-icons text-primary mt-4 mb-4">bolt</span>
                            <ul class="list-inline text-primary">
                                <li>Daya <strong><?php echo $data['daya'] ?></strong></li>
                                <li>Tarif/Kwh <strong><?php echo $data['tarifperkwh'] ?></strong></li>
                            </ul>
                            <div class="d-flex flex-row">
                                <a href="#" class="admin-aksi-tarif btn btn-primary w-50">Edit</a>
                                <a href="#" class="admin-aksi-tarif btn btn-danger w-50">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                <div class="col-3 mb-4">
                    <div class="card shadow" style="width: 11.30rem; height: 13rem; border: 0;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="btn fa-solid fa-plus text-primary fs-1 mb-3"></i>
                            <a href="#" class="btn stretched-link text-primary"><b>Tambah Tarif</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TARIF CONTENT -->
    
    <!-- FOOTER -->
    <!-- <div style="border: 1px solid white; margin-top: 225px;"></div>
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
                        salah satu fitur pop up box (confirm)
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
    </footer> -->
    <!-- END FOOTER -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="js/navbar-mobile.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
</body>
</html>