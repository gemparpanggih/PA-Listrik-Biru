<?php
    session_start();

    if(!isset($_SESSION['login']) ){
        header("Location: ../../../auth/login.php");
        exit;
    } 
    
    if($_SESSION['akun']['level'] == 'user' || !isset($_POST['create'])) {
        header("Location: ../../tarif.php");
        exit;
    } else {
		require('../../../php/connection.php');
		require('../../../php/randomstr.php');
		
		$randstr = RandomString(2);
		$randnum = RandomString(1, $num);
	
		$id = 'TR/'.$randstr[0].$randstr[1].'-F'.$randnum;
		$daya=$_POST['daya'] . 'VA';
		$tarifperkwh=$_POST['tarifperkwh'];
	
		$sql = "INSERT INTO tarif (id, daya, tarifperkwh) VALUES('$id', '$daya', '$tarifperkwh')";
		$query = mysqli_query($conn, $sql);
	
		if($query) {
			header('location: ../../tarif.php?success=Data tarif berhasil ditambahkan');
		} else {
			header('location: ../../tarif.php?danger=Data tarif gagal ditambahkan');
		}
	}
?>