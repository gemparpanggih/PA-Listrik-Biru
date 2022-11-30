<?php
session_start();
require '../php/connection.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/213e56f9ea368890b9d2da0577e49dab?family=Zona+Pro" rel="stylesheet"
        type="text/css" />

    <!-- CSS -->
    <link rel="stylesheet" href="../stylesheet/nonavbar.css">
    <link rel="stylesheet" href="../stylesheet/landingPage.css">
    <link rel="stylesheet" href="../stylesheet/style-mobile.css">
    <link rel="stylesheet" href="../stylesheet/component/sidebar.css">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

<body>
    <!-- Sidebar -->
    <aside class="sidebar offcanvas-lg offcanvas-start mode-bg">
        <div class="d-flex  m-4 d-block d-lg-none mode-bg">
            <button data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4"
                aria-label="Button Close">
                <i class="fas fa-close"></i>
            </button>
        </div>

        <!-- Logo -->
        <div class="logo-brand mt-lg-5">
            <a href="../index.php">
                <img src="../img/logo/logo-listrik.png" alt="Logo" width="45" height="50" />
            </a>
            <div>
                <h6 class="title">Listrik Biru</h6>
                <p class="tagline">Nyalakan Rumah Anda</p>
            </div>
        </div>

        <!-- Menu -->
        <hr />
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
        <footer>
            <div class="logout-btn">
                <a href="../auth/logout.php">Logout</a>
            </div>
            <p class="Keterangan">Projek Akhir Pemrograman Web</p>
        </footer>
        <!-- END FOOTER -->
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content flex-fill mode-bg ">
        <section class="d-flex flex-column gap-4">
            <button aria-controls="sidebar" data-bs-toggle="offcanvas" data-bs-target=".sidebar"
                aria-label="Button Hamburger" class="sidebarOffcanvas mb-5 btn p-0 border-0 d-flex d-lg-none">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="container mt-5">

                <div class="row pt-3">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark text-nowrap">
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Pesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider text-nowrap">
                                <?php
                            require('../php/connection.php');
                            $read = mysqli_query($conn, "SELECT * FROM kontak");

                            if (mysqli_num_rows($read) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_array($read)) {
                            ?>
                                <tr class="games-content">
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nohp'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pesan'] ?>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <a class="btn-action del-action"
                                                href="aksi/delete_message.php?id=<?php echo $row['id']; ?>">
                                                <i class="fa-sharp fa-solid fa-circle-xmark"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7" align="center">-- data tidak ditemukan --</td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END MAIN CONTENT -->

        <!-- javascript -->
        <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <script src="../js/navbar-mobile.js"></script>
        <script src="../js/dark-mode.js"></script>
        <script src="https://kit.fontawesome.com/a374d5ed26.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
    </main>
</body>

</html>