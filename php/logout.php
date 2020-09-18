<?php
require_once('../php/auth.php');

$aut = rede();

session_start();
if (isset($_POST['keluar'])) {
	session_destroy();
	header('location:../');
	exit;
} 


	$outjawaban = array();


	if (isset($_POST['fnish'])) {
		$_SESSION['auth'] = 0;

		require_once('getdata.php');
		require_once('getformula.php');
		require_once('tampildata.php');
		$i = 0;
				$nt = 0;
			$nt = count($soal)-1;
		while ($i <= $nt) {
				array_push($outjawaban, $_POST['jawaban'.$i]);
			$i++;
			}
			// print_r($outjawaban);
		require_once('rkoreksi.php');


		  	if ($aut == 1) {

		  		header('location:../result/m/');
		  	}else{

		  		header('location:../result/');
		  	}

	  	// header('location:../result/');

	};

?>