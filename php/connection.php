<?php
	$host = "localhost";
	$user_name = "root";
	$pass="";
	$database_name ="db_paweb";

	$conn = mysqli_connect($host,$user_name,$pass,$database_name);
	if(!$conn){
		echo "Gagal Terhubung";
	}
?> 