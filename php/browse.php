<?php
session_start();
require_once('server.php');
		if (isset($_POST['cari'])) {
			// $kodesoal_input = mysqli_real_escape_string($conn, $_POST['kode']);
			$kodesoal_input = $_POST['kode'];			
			$sql ="SELECT * FROM ". $kodesoal_input ."";
			$req1 = mysqli_query($conns, $sql);
			if ($req1) {
				if (mysqli_num_rows($req1) > 0){
					while ($at = mysqli_fetch_array($req1)) {

						$_SESSION['alert'] = $at['nilai'];
						header('location:../browse/');

					}
				}else {
					$_SESSION['alert'] = "kode yang dimasukan salah";
					header('location:../browse/');
				}
			}else {
					$_SESSION['alert'] = "kode yang dimasukan salah";
					header('location:../browse/');
			}

		}
?>