		<?php  
			session_start();
			require_once('server.php');


			if (isset($_POST['reedeem'])) {


				$nis_input = mysqli_real_escape_string($conn, $_POST['nis']);
				//echo $nis_input."!"."</br>".$_POST['nis']."6";
				$kodesoal_input = mysqli_real_escape_string($conn, $_POST['kodes']);



						$sql1 = "SELECT * FROM datasiswa WHERE nis='". $nis_input ."' LIMIT 1";

						$sql2 = "SELECT * FROM listsoal WHERE code='". $kodesoal_input ."' LIMIT 1";


				$req1 = mysqli_query($conn, $sql1);
				$req2 = mysqli_query($conn, $sql2);
				

				if (mysqli_num_rows($req1) == 1 && mysqli_num_rows($req2) == 1) {
					while ($at = mysqli_fetch_array($req1)) {
						while ($atz = mysqli_fetch_array($req2)) {
							if ($at['nis'] == $nis_input) {
								if ($atz['code'] == $kodesoal_input) {

								  	$_SESSION['nis'] = $at['nis'];
								  	$_SESSION['nama'] = $at['nama'];
								  	$_SESSION['kelas'] = $at['kelas'];
								  	$_SESSION['tahun'] = $at['tahun'];
								  	$_SESSION['jurusan'] = $at['jurusan'];

								  	$_SESSION['code'] = $atz['code'];
								  	$_SESSION['jumsol'] = $atz['jumsol'];
								  	$_SESSION['durasi'] = $atz['durasi'];
								  	$_SESSION['matauji'] = $atz['matauji'];


								  	if ($_SESSION['auth'] == 1) {

										header('location: ../ujian/m');
								  	}else{

										header('location: ../ujian');
								  	}


								}else {
								  	$_SESSION['alert'] = "kode yang dimasukan salah";
								  	header('location:../');
								}

							}else {
								  	$_SESSION['alert'] = "nis yang dimasukan salah";
								  	header('location:../');
							}
						}
					}
					
				}else {
				  	$_SESSION['alert'] = "nis atau kode yang dimasukan salah";
				  	header('location:../');
				}
			}
					

		?>
