<?php
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../../../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user') {
        header("Location: ../../../index.php");
        exit;
    } 

	if(!isset($_GET['id'])) {
        header("Location: ../../tarif.php");
        exit;
    } else {
		require('../../../php/connection.php');

		$id = $_GET["id"];
		$sql = "DELETE FROM tarif WHERE id = '$id'";
		$query = mysqli_query($conn, $sql);
		
		if($query) {
			header('location: ../../tarif.php?danger=Data tarif berhasil dihapus');
		} else {
			header('location: ../../tarif.php?danger=Data tarif gagal dihapus');
		}
	}
?>