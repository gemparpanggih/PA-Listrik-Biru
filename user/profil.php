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

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title & Web Icon -->
    <title>Listrik Biru</title>
    <link rel="shortcut icon" href="assets/img/logo/logo-listrik.png">
    
    <!-- Link Font -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/213e56f9ea368890b9d2da0577e49dab?family=Zona+Pro" rel="stylesheet" type="text/css"/>

    <!-- CSS --> <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/nonavbar.css">
    <link rel="stylesheet" href="../stylesheet/landingPage.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
    <link rel="stylesheet" href="../stylesheet/component/sidebar.css">
    <link rel="stylesheet" href="../stylesheet/new/main.css">
    
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body id="profil">
    <!-- Sidebar -->
    <aside class="sidebar offcanvas-lg offcanvas-start mode-bg">
        <div class="d-flex  m-4 d-block d-lg-none mode-bg">
            <button data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4" aria-label="Button Close">
            <i class="fas fa-close"></i>
            </button>
        </div>

        <!-- Logo -->
        <div class="logo-brand mt-lg-5">
            <a href="../index.php">
                <img src="../img/logo/logo-listrik.png" alt="Logo" width="45" height="50"/>
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
                <a class="item-menu" href="../index.php">Home</a>
                <a class="item-menu" href="pembelian.php">Pesan</a>
                <a class="item-menu" href="profil.php">Profil</a>
                <a class="item-menu" href="kontak.php">Kontak</a>
            </div>
        </nav>

        <!-- FOOTER -->
        <footer>
            <div class="logout-btn">
                <a href="../auth/logout.php">Logout</a>
            </div>
            <p class="Keterangan" >Projek Akhir Pemrograman Web</p>
        </footer>
        <!-- END FOOTER -->
    </aside>
    
    <!-- PROFIL CONTENT -->
    <main class="content flex-fill mode-bg ">
        <section class="d-flex flex-column gap-4">
            <button aria-controls="sidebar" data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-label="Button Hamburger"
                class="sidebarOffcanvas mb-5 btn p-0 border-0 d-flex d-lg-none">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <!-- Profil User -->
            <section id="profil-user">
                <div class="container mt-5">
                <?php if(isset($_GET['success'])) { ?>
                    <p class="alert alert-success mb-4"><?php echo $_GET['success']; ?></p>
                <?php } ?> 
                <?php if(isset($_GET['danger'])) { ?>
                    <p class="alert alert-danger mb-4"><?php echo $_GET['danger']; ?></p>
                <?php } ?> 
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 d-flex flex-row-reverse">
                            <img src="../img/profil/<?php echo $data['foto'] ?>" class="img-thumbnail" style="height: 160px;" alt="">
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <h3><?php echo $data['nama'] ?></h3>
                            </div>
                            <div class="row">
                                <div class="col profil-data-user">
                                    <p class="m-0"><?php echo $data['id'] ?></p>
                                    <p class="m-0"><?php echo $data['username'] ?></p>
                                    <p class="m-0"><?php echo $data['telepon'] ?></p>
                                    <p class="m-0"><?php echo $data['alamat'] ?></p>
                                </div>
                                <div class="col d-flex flex-column justify-content-between text-end profil-aksi-data">
                                    <a href="profil/edit.php?id=<?php echo $data['id'] ?>"><p class="m-0">Edit Akun</p></a>
                                    <a href="profil/ubah-pwd.php?id=<?php echo $data['id'] ?>"><p class="m-0">Ubah Password</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Profil User -->


        <!-- Riwayat Transaksi -->
        <?php 
            $read = mysqli_query($conn, "SELECT * FROM transaksi WHERE iduser = '$id_user'");

            if(mysqli_num_rows($read) > 0){
        ?>
        <section id="transaksi-user">
            <div class="container mt-5">
                <div class="delete-history mb-3">
                    <a href="aksi/delete_history.php" class="btn btn-danger">Hapus Riwayat Transaksi</a>
                </div>
                <table class="table table-hover">
                    <thead class="table-dark">
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
                    <tbody class="table-group-divider">
                        <?php while($row = mysqli_fetch_array($read)){ ?>
                                <tr class="games-content">
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['tanggal']?></td>
                                    <td><?php echo $row['nominal']?></td>
                                    <td><?php echo $row['nometer']?></td>
                                    <td class="fw-bold"><?php echo $row['token']?></td>
                                    <td><?php echo $row['totalkwh']?></td>
                                    <td><?php echo $row['idtarif']?></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php } ?>
        <!-- End Riwayat Transaksi -->
    </main>
    <!-- END PROFIL CONTENT -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="../js/navbar-mobile.js"></script>
    <script src="../js/dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
</body>
</html>