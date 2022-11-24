<?php
    session_start();
    if(!isset($_SESSION['login']) ){
        header("Location: ../../auth/login.php");
        exit;
    }
    
    if($_SESSION['akun']['level'] == 'user' || $_GET['id'] == '') {
        header("Location: ../../index.php");
        exit;
    } else {
        require("../../php/connection.php");
	
		$id = $_GET["id"];
		$sql = "DELETE FROM user WHERE id = '$id'";
		$query = mysqli_query($conn, $sql);
		if($query) {
			header('location: ../pelanggan.php?pesan=Data berhasil dihapus!');
		} else {
			echo "hapus pelanggan GAGAL";
		}
	}
?>