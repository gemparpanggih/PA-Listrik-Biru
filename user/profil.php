<?php 
    session_start();
    require '../php/connection.php';

    if(!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'admin') {
        header("Location: ../index.php");
        exit;
    } else {
        $id_user = $_SESSION['akun']['id'];
        $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id_user'");
        $data = mysqli_fetch_array($sql);
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
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/213e56f9ea368890b9d2da0577e49dab?family=Zona+Pro" rel="stylesheet" type="text/css"/>

    <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/style.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
</head>
<body class="mode-bg">
    <!-- HEADER -->
    <header class="main" id="home">
        <!-- navbar -->
        <nav class="mode-bg">
            <div class="logo">
                <a href="../index.php" class="mode-text">
                    <img src="../img/logo/logo-listrik.png" alt="">
                    <p>Listrik Biru</p>
                </a>
            </div>

            <ul>
                <li><a class="mode-text" href="../tarif.php">Tarif</a></li>
                <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                    <li><a class="mode-text" href="#">Transaksi</a></li>
                    <li><a class="mode-text" href="../pelanggan.php">Pelanggan</a></li>
                <?php } if($_SESSION['akun']['level'] == 'user') { ?>
                    <li><a class="mode-text" href="profil.php">Profil</a></li>
                    <li><a class="mode-text" href="kontak.php">Kontak</a></li>
                <?php } ?>
                <div class="logout-btn">
                    <a href="../auth/logout.php">Logout</a>
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
    
    <!-- PROFIL CONTENT -->
    <section id="profil">
        <!-- Data User -->
        <div class="container-udata">
            <div class="udata-right">
                <img src="../img/profil/<?php echo $data['foto'] ?>" alt="">
            </div>
            <div class="udata-left">
                <h2 class="mode-text"><?php echo $data['nama'] ?></h2>
                <div class="uleft-content">
                    <div class="baca-data">
                        <p><?php echo $data['id'] ?></p>
                        <p><?php echo $data['username'] ?></p>
                        <p><?php echo $data['telepon'] ?></p>
                        <p><?php echo $data['alamat'] ?></p>
                    </div>
                    <div class="aksi-data">
                        <div class="ubah-pwd"><a href="profil/ubah-pwd.php?id=<?php echo $data['id'] ?>" class="mode-text">Ubah password</a></div>
                        <div class="ubah-data"><a href="profil/edit.php?id=<?php echo $data['id'] ?>" class="mode-text">Ubah data</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Data User -->

        <!-- Riwayat Transaksi -->
        <?php 
            $read = mysqli_query($conn, "SELECT * FROM transaksi WHERE iduser = '$id_user'");

            if(mysqli_num_rows($read) > 0){
        ?>
        <div class="daftar-data">
            <div class="feature-del-transaksi">
                <a href="aksi/delete_history.php" class="btn-action erase-btn">Hapus Riwayat Transaksi</a>
            </div>
            <div class="table-user hover-table mode-text">
                <table>                 
                    <thead class="mode-border">
                        <tr>
                            <th>ID TRANSAKSI</th>
                            <th>TANGGAL</th>
                            <th>NOMINAL</th>
                            <th>NO METER</th>
                            <th>NO TOKEN</th>
                            <th>TOTAL KWH</th>
                            <th>TARIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($read)){ ?>
                                <tr class="games-content">
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['tanggal']?></td>
                                    <td><?php echo $row['nominal']?></td>
                                    <td><?php echo $row['nometer']?></td>
                                    <td><?php echo $row['token']?></td>
                                    <td><?php echo $row['totalkwh']?></td>
                                    <td><?php echo $row['idtarif']?></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
        <!-- End Riwayat Transaksi -->
    </section>
    <!-- END PROFIL CONTENT -->
    
    <!-- FOOTER -->
    <footer class="mode-bg" style="border-top: 1px solid white; margin-top: 25px; position: static;" id="profil">
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
    <script src="../js/navbar-mobile.js"></script>
    <script src="../js/dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
</body>
</html>