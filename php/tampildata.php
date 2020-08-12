<?php 

$indexsoal = $tsoal;
$indexjawaban = $tjawaban;
$indexkey = $tkey;
$indexlam = $tlampiran;

$formula = $_SESSION['tformula'];
$soal = array();
$jawaban = array();
$key = array();
$lampiran = array();

$m = 0;

while ($m<=count($formula)-1) {

	array_push($soal, $indexsoal[$formula[$m]]);
	array_push($jawaban, $indexjawaban[$formula[$m]]);
	array_push($key, $indexkey[$formula[$m]]);
	array_push($lampiran, $indexlam[$formula[$m]]);

	$m++;

}


?>