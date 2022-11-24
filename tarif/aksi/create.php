<?php
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user' || !isset($_POST['create'])) {
        header("Location: ../../tarif.php");
        exit;
    } else {
		require('../../php/connection.php');
		require('../../php/randomstr.php');
	
		$randstr = RandomString(2);
		$randnum = RandomString(1, $num);
	
		$id = 'TR/'.$randstr[0].$randstr[1].'-F'.$randnum;
		$ft=$_FILES['foto']['name'];
		$file=$_FILES['foto']['tmp_name'];
		$daya=$_POST['daya'] . 'VA';
		$tarifperkwh=$_POST['tarifperkwh'];
	
		move_uploaded_file($file, '../../img/voltase/' . $ft);
		$sql = "INSERT INTO tarif (id, foto, daya, tarifperkwh) VALUES('$id', '$ft', '$daya', '$tarifperkwh')";
		$query = mysqli_query($conn, $sql);
	
		if($query) {
			header('location: ../../tarif.php');
		} else {
			echo "Gagal Disimpan";
		}
	}
?>