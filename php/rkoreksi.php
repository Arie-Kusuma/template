<?php
require_once('rawkoreksi.php');
require_once('server.php');
// $outjawaban = output array dari jawbaan

	$nilai = 0;
	$rawskor = array();
	$cctnout = array();
	$ttlskor = 0;
	$cctn = array(	"Pengetahuan dasar tentang materi masih kurang.",
					"Kemampuan mengolah informasi masih kurang.",
					"Perlu adanya peningkatan penguasaan materi.",
					"Penguasaan materi sudah baik.");
	$i = 0;
	while ($i <= count($outjawaban)-1) {
	
		$data_k = rawkoreksi($outjawaban[$i], $key[$i]);
		$data_j = rawkoreksi($outjawaban[$i], $jawaban[$i]);

		$i++;

		// print_r($data);
		// echo "<br>";
		// (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;

		$data_k = ($data_k - 0) * (90 - 0) / (100 - 0) + 0;
		$data_j = ($data_j - 0) * (10 - 0) / (100 - 0) + 0;


		$rawskor[$i] = (double)$data_k+(double)$data_j;


	}

	$i = 0;
	foreach ($rawskor as $dd) {

		if ($dd >= 75) {
			$cctnout[$i] = $cctn[3];
		}elseif($dd >= 50){
			$cctnout[$i] = $cctn[2];			
		}elseif($dd >= 25){
			$cctnout[$i] = $cctn[1];			
		}else{
			$cctnout[$i] = $cctn[0];						
		}
		$i++;

	}

	// echo "<pre>";
	// print_r($rawskor);
	if (!empty($rawskor)) {
		$ttlskor =  array_sum($rawskor)/10;
	}else {
		$ttlskor = 0;
	}
	// echo $ttlskor;
	$nilai = ($ttlskor-0)*(100-0)/(((int)count($outjawaban)*10)-0)+0;
	$nilai = ceil($nilai);
	// echo "<br>".$nilai;

	$codesoal = $_SESSION['code'];
	$nisout = $_SESSION['nis'];
	$pformula = implode("-",$_SESSION['tformula']);
	$psoal = $soal;
	$pkey = $key;
	$pjawaban = $jawaban;
	$plampiran = $lampiran;

		date_default_timezone_set("Asia/Jakarta");

	$identitas = array($_SESSION['nama'],$nisout,$_SESSION['matauji'],date("Y-m-d"), date("H-i-s"));

	// echo $codesoal;
	// echo $nisout;
	// echo $pformula;

	$payload = array($pformula,$nilai,$codesoal);

	// print_r($psoal);


	// session_start();
	$_SESSION['payload'] = $payload;
	$_SESSION['psoal'] = $psoal;
	$_SESSION['pkey'] = $pkey;
	$_SESSION['pjawaban'] = $pjawaban;
	$_SESSION['plampiran'] = $plampiran;
	$_SESSION['outjawaban'] = $outjawaban;
	$_SESSION['identitas'] = $identitas;
	$_SESSION['rawskor'] = $rawskor;
	$_SESSION['cctnout'] = $cctnout;

  	header('location:../result/');

	// print_r($payload);



?>