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

        <!-- CSS -->
        <link rel="stylesheet" href="../stylesheet/new/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body id="profil">
        <!-- Profil User -->
        <section id="profil-user">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-2 d-flex flex-row-reverse">
                        <img src="../img/profil/<?php echo $data['foto'] ?>" class="img-thumbnail h-auto" alt="">
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
                                <a href="profil/ubah-pwd.php?id=<?php echo $data['id'] ?>"><p class="m-0">Edit Akun</p></a>
                                <a href="profil/edit.php?id=<?php echo $data['id'] ?>"><p class="m-0">Ubah Password</p></a>
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
                                    <td><?php echo $row['token']?></td>
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

        <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; Your Website</small>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>