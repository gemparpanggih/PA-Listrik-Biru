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
    <script src="https://kit.fontawesome.com/32f82e1dca.js" crossorigin="anonymous"></script>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"/>
    
    <!-- CSS -->
    <link rel="stylesheet" href="stylesheet/nonavbar.css">
    <link rel="stylesheet" href="stylesheet/landingPage.css">
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="sidebar offcanvas-lg offcanvas-start">
        <div class="d-flex justify-content-end m-4 d-block d-md-none">
            <button data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4" aria-label="Button Close">
                <i class="fas fa-close"></i>
            </button>
        </div>

        <div class="logo-brand mt-lg-5">
            <img src="img/logo/logo-listrik.png" alt="" width="48" height="50"/>
            <div>
                <h6 class="title">Listrik Biru</h6>
                <p class="tagline">To Brigthen Your Home</p>
            </div>
        </div>

        <hr/>
        <nav class="menu flex-fill">
            <div class="section-menu">
                <a href="tarif.php" class="item-menu active" onclick="handleClickMenu(this)">
                    <p>Tarif</p>
                </a>
                <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                    <a href="admin/transaksi.php" class="item-menu" onclick="handleClickMenu(this)">
                        <p>Transaksi</p>
                    </a>

                    <a href="admin/pelanggan.php" class="item-menu" onclick="handleClickMenu(this)">
                        <p>Pelanggan</p>
                    </a>

                    <a href="admin/daftar-pesan.php" class="item-menu" onclick="handleClickMenu(this)">
                        <p>Kontak</p>
                    </a>


                <?php } if($_SESSION['akun']['level'] == 'user') { ?>
                    <a href="user/profil.php" class="item-menu" onclick="handleClickMenu(this)">
                        <p>Profil</p>
                    </a>

                    <a href="user/kontak.ph" class="item-menu" onclick="handleClickMenu(this)">
                        <p>Kontak</p>
                    </a>
                <?php } ?>
            </div>
        </nav>

        <footer>
            <div class="d-flex align-items-center mb-4">
                <img src="./assets/icons/ic_mode.svg" alt="Mode Display" />
                <p id="label-mode" class="flex-fill label-mode">Light Mode</p>

                <div>
                    <input id="checkbox" type="checkbox" class="toggle-theme" aria-label="Toggle Theme"/>
                    <label for="checkbox" class="label-toggle">
                        <img src="./assets/icons/ic_moon.svg" width="50%" class="ic-theme" id="ic-dark" alt="Icon Dark"/>
                        <img src="./assets/icons/ic_sun.svg"  width="50%" class="ic-theme" id="ic-light" alt="Icon Light"/>
                    </label>
                </div>
            </div>

            <div class="logout-btn">
                <a href="auth/logout.php">Logout</a>
            </div>
        </footer>
    </aside>

    <main class="content flex-fill">
        <section>
            <button aria-controls="sidebar" data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-label="Button Hamburger" class="sidebarOffcanvas mb-5 btn p-0 border-0 d-flex d-lg-none">
            <i class="fa-solid fa-bars"></i>
            </button>
        </section>

        <section class="d-flex flex-column">
            <div class="header-container">
                <div class="header-item-left">
                    <div class="pesan-container">
                        <?php if(isset($_GET['pesan'])) {?>
                            <div class="pesan-sukses"> <?php echo $_GET['pesan']; ?> </div>
                        <?php } ?>
                    </div>
                    <h1>LISTRIK BIRU</h1>
                    <p><b>Listrik Biru</b> 
                    Pulsa listrik di rumah mau habis tapi belum beli token listrik karena males keluar? Tenang, kini Anda bisa beli token listrik prabayar dan tagihan listrik pascabayar dengan cepat dan mudah bisa di mana saja dan kapan saja hanya dengan satu aplikasi.
                    <br>
                    Pulsa listrik di rumah sudah mau habis tapi malas keluar untuk beli token listrik prabayar? Mau beli token listrik prabayar dengan cepat dan mudah? Yuk beli token listrik prabayar murah dengan proses yang aman dan cepat hanya di <b>Listrik Biru</b>!</p>
                    
                    <a href="user/pembelian.php">
                        <button class="rent-btn">Pesan!</button>
                    </a>

                    <a href="tarif.php">
                        <button class="play-btn">Tarif</button>
                    </a>
                </div>
                <div class="header-item-right"></div>
            </div>

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
            </section>

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

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"
    ></script>

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <script src="js/dark-mode.js"></script>

</body>
</html>