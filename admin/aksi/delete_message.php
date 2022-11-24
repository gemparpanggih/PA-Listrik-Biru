<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        header('location: ../../auth/login.php');
        exit;
    }
    
    if($_SESSION['akun']['level'] == 'user' || $_GET['id'] == '') {
        header("Location: ../../index.php");
        exit;
    } else {
        require("../../php/connection.php");
    
        $id = $_GET['id'];
        $sql = "DELETE FROM kontak WHERE id = '$id'";
        $query = mysqli_query($conn,$sql);
        
        if($query){
            ?>
                <script>
                    window.location='../daftar-pesan.php?pesan=Data berhasil dihapus!';
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert("Data gagal dihapus");
                </script>
            <?php
        }
    }