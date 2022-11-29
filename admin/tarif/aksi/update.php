<?php
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../../../auth/login.php");
        exit;
    } 
    
    if ($_SESSION['akun']['level'] == 'user') {
        header("Location: ../../../index.php");
        exit;
    }

    if(!isset($_POST['update'])) {
        header("Location: ../tarif.php");
        exit;
    } else {
		require('../../../php/connection.php');

		$id = $_GET['id'];
		$daya=$_POST['daya'];
		$tarifperkwh=$_POST['tarifperkwh'];
		
		$sql2 = "UPDATE tarif SET daya = '$daya' , tarifperkwh = '$tarifperkwh' WHERE id = '$id'";
		
		$query = mysqli_query($conn, $sql2);
		if($query) {
			header('location: ../../tarif.php?success=Data tarif berhasil diubah');
		} else {
			header('location: ../../tarif.php?danger=Data tarif gagal diubah');
		}
	}
?>