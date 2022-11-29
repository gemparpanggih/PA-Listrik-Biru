<?php
    session_start();

    if(!isset($_SESSION['login'])) {
        header('location: ../../auth/login.php');
        exit;
    } else if($_SESSION['akun']['level'] == 'admin') {
        header("Location: ../../index.php");
        exit;
    } else {
        require("../../php/connection.php");
    
        $id = $_SESSION['akun']['id'];
        $sql = "DELETE FROM transaksi WHERE iduser = '$id'";
        $query = mysqli_query($conn,$sql);
        
        if($query){
            header('location: ../profil.php?success=Berhasil menghapus riwayat!');
        }else {
            header('location: ../profil.php?danger=Gagal menghapus riwayat!');
        }
    }