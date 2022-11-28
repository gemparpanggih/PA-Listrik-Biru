<?php 
    session_start();
    require '../php/connection.php';

    if(!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    if($_SESSION['akun']['level'] == 'user') {
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
    
    <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/nonavbar.css">
    <link rel="stylesheet" href="../stylesheet/landingPage.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
    <link rel="stylesheet" href="../stylesheet/component/sidebar.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"/>

</head>
<body>
    <!-- sidebar -->
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
                <a class="item-menu" href="../tarif.php">Tarif</a>
                <?php if($_SESSION['akun']['level'] == 'admin') { ?>
                    <a class="item-menu" href="transaksi.php">Transaksi</a>
                    <a class="item-menu" href="pelanggan.php">Pelanggan</a>
                    <a class="item-menu" href="daftar-pesan.php">Kontak</a>

                <?php } if($_SESSION['akun']['level'] == 'user') { ?>
                    <a class="item-menu" href="../user/profil.php">Profil</a>
                    <a class="item-menu" href="../kontak.php">Kontak</a>
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
	

    <!-- MAIN CONTENT -->
    <main class="content flex-fill mode-bg ">
        <section class="d-flex flex-column gap-4">
        <button aria-controls="sidebar" data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-label="Button Hamburger"
            class="sidebarOffcanvas mb-5 btn p-0 border-0 d-flex d-lg-none">
            <i class="fa-solid fa-bars"></i>
        </button>
            
        <div class="minggirin-navbar">
            <div class="feature">
                <form method="GET" class="search-container">
                    <h3 class="mode-text">Cari berdasarkan tanggal</h3>
                    <input type="date" name="date-from">
                    <label class="mode-text">hingga</label>
                    <input type="date" name="date-to">
                    <button type="submit" name="searchByDate" hidden></button>
                </form>
            </div>
            <div class="daftar-data">
                <?php if(isset($_GET['pesan'])) { ?>
                    <p class="success-message" style="margin-top: 5px;"><?php echo $_GET['pesan']; ?></p>
                <?php } ?> 
                <div class="table-user hover-table mode-text">
                    <table>
                        <thead class="mode-border">
                            <tr>
                                <th>ID PEMBELIAN</th>
                                <th>ID PELANGGAN</th>
                                <th>TANGGAL PEMBELIAN</th>
                                <th>JUMLAH BELI</th>
                                <th>NOMOR TOKEN</th>
                                <th>TOTAL KWH</th>
                                <th>ID TARIF</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                require('../php/connection.php');
                                if(isset($_GET['search'])) {
                                    $keyword = $_GET['keyword'];
                                    $read = mysqli_query($conn, "SELECT * FROM transaksi WHERE iduser = '$keyword'");
                                } else if(isset($_GET['searchByDate'])) {
                                    $dateFrom = $_GET['date-from'];
                                    $dateTo = $_GET['date-to'];
                                    $read = mysqli_query($conn, "SELECT * FROM transaksi WHERE `tanggal` BETWEEN '$dateFrom' and '$dateTo'");
                                } else {
                                    $read = mysqli_query($conn, "SELECT * FROM transaksi");
                                }

                                if(mysqli_num_rows($read) > 0){
                                    while($row = mysqli_fetch_array($read)){
                                ?>
                                    <tr class="games-content">
                                        <td><?php echo $row['id']?></td>
                                        <td><?php echo $row['iduser']?></td>
                                        <td><?php echo $row['tanggal']?></td>
                                        <td>Rp.<?php echo $row['nominal']?></td>
                                        <td><?php echo $row['token']?></td>
                                        <td><?php echo $row['totalkwh']?></td>
                                        <td><?php echo $row['idtarif']?></td>
                                        <td>
                                            <div class="action">
                                                <a class="btn-action del-action" href="aksi/delete_history.php?id=<?php echo $row['id']; ?>">
                                                    <i></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php }} else { ?>
                                <tr>
                                    <td colspan="8" align="center">-- data tidak ditemukan --</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <!-- END MAIN CONTENT -->

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="../js/dark-mode.js"></script>
    <script src="../js/navbar-mobile.js"></script>
    <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
</body>
</html>