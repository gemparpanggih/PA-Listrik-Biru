<?php
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user' || !isset($_POST['update'])) {
        header("Location: ../../tarif.php");
        exit;
    } else {
		require('../../php/connection.php');

		$id = $_GET['id'];
		$daya=$_POST['daya'];
		$tarifperkwh=$_POST['tarifperkwh'];
		
		if($_FILES['foto']['size'] != 0) {
			$ft=$_FILES['foto']['name'];
			$file=$_FILES['foto']['tmp_name'];
			move_uploaded_file($file, '../../img/voltase/' . $ft);
			$sql2 = "UPDATE tarif SET foto = '$ft' , daya = '$daya' , tarifperkwh = '$tarifperkwh' WHERE id = '$id'";
		} else {
			$sql2 = "UPDATE tarif SET daya = '$daya' , tarifperkwh = '$tarifperkwh' WHERE id = '$id'";
		}
		
		$query = mysqli_query($conn, $sql2);
		if($query) {
			header('location: ../../tarif.php');
		} else {
			echo "Edit Tarif Gagal";
		}
	}
?>