<?php 
	
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "cobadata-skripsi";
			$dbnames = "soal";


			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$conns = mysqli_connect($servername, $username, $password, $dbnames);

			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
			if (!$conns) {
			    die("Connection failed: " . mysqli_connect_error());
			}


?>