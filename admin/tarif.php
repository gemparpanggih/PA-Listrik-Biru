<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        print_r($_SESSION);
        header('location: ../auth/login.php');
        exit;
    }
    if ($_SESSION['akun']['level'] == 'user') {
        header("Location: ../index.php");
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/component/sidebar.css">
    <link rel="stylesheet" href="../stylesheet/new/main.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body id="taif">
    <!-- Sidebar -->
    <aside class="sidebar offcanvas-lg offcanvas-start mode-bg">
        <div class="d-flex m-4 d-block d-lg-none mode-bg">
            <button data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4" aria-label="Button Close">
                <i class="fas fa-close"></i>
            </button>
        </div>

        <!-- Logo -->
        <div class="logo-brand mt-lg-5 d-flex justify-content-center align-center">
            <a href="../index.php">
                <img src="../img/logo/logo-listrik.png" alt="Logo" width="45" height="50"/>
            </a>
            <div>
                <h6 class="title fw-bold">Listrik Biru</h6>
                <p class="tagline">Nyalakan Rumah Anda</p>
            </div>
        </div>

        <!-- Menu -->
        <hr/>
        <nav class="menu flex-fill">
            <div class="section-menu">
                <a class="item-menu m-0" href="../index.php">Home</a>
                <a class="item-menu m-0" href="tarif.php">Tarif</a>
                <a class="item-menu m-0" href="transaksi.php">Transaksi</a>
                <a class="item-menu m-0" href="pelanggan.php">Pelanggan</a>
                <a class="item-menu m-0" href="daftar-pesan.php">Kontak</a>
            </div>
        </nav>

        <!-- FOOTER -->
        <footer class="d-flex flex-column" style="position: absolute; bottom: 0;">
            <div class="logout-btn">
                <a href="../auth/logout.php">Logout</a>
            </div>
            <p class="Keterangan" >Projek Akhir Pemrograman Web</p>
        </footer>
        <!-- END FOOTER -->
    </aside>
    <!-- End Sidebar -->
	
    <!-- TARIF CONTENT -->
    <main class="content flex-fill mode-bg">
        <section class="d-flex flex-column gap-4">
            <button aria-controls="sidebar" data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-label="Button Hamburger"
                class="sidebarOffcanvas mb-5 btn p-0 border-0 d-flex d-lg-none">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <div class="container mb-4 d-flex justify-content-end">
                <?php if(isset($_GET['success'])) { ?>
                    <div class="row w-75 mt-3">
                        <div class="col">
                            <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
                        </div>
                    </div>
                <?php } if(isset($_GET['danger'])) { ?>
                    <div class="row w-75 mt-3">
                        <div class="col">
                            <p class="alert alert-danger"><?php echo $_GET['danger']; ?></p>
                        </div>
                    </div>
                <?php } ?> 
            </div>
            <div class="tarif-admin">
                <div class="container d-flex justify-content-end">
                    <div class="row w-75">
                    <?php
                        require('../php/connection.php');

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
                                        <a href="tarif/edit.php?id=<?php echo"$data[id]"; ?>" class="admin-aksi-tarif btn btn-primary w-50">Edit</a>
                                        <a href="tarif/aksi/delete.php?id=<?php echo"$data[id]"; ?>" class="admin-aksi-tarif btn btn-danger w-50">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="col-3 mb-4">
                            <div class="card shadow" style="width: 11.30rem; height: 13rem; border: 0;">
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <i class="btn fa-solid fa-plus text-primary fs-1 mb-3"></i>
                                    <a href="tarif/tambah.php" class="btn stretched-link text-primary"><b>Tambah Tarif</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- END TARIF CONTENT -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="../js/navbar-mobile.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
</body>
</html>