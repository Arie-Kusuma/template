<?php 
require_once(__DIR__ . '/server.php');
require_once(__DIR__ . '/auth.php');
$code = $_SESSION['code'];
$q = "SELECT * from listsoal WHERE code='". $code ."' LIMIT 1";	
$namasoal = '';
$tsoal = array(); //index all soal
$tratting = array(); //index all rating
$tlampiran = array(); //index all lampiran
$tjawaban = array(); //index all jawaban panjang
$tkey = array(); //index all key (kunci jawaban)
$M = array(); //index soal mudah
$S = array(); //index soal sedang
$B = array(); //index soal berat
$u = 0;
$m = 0;
$sm = 0;
$ss = 0;
$sb = 0;




	$querry = mysqli_query($conn,$q);

	while ($row = mysqli_fetch_array($querry)) {

		//echo $row['namasoal'];
		$namasoal = $row['namasoal'];
	}



$csv = array();


$au = rede();

if ($au == 1) {

			$lines = file("../../soaldir/".$namasoal, FILE_IGNORE_NEW_LINES);

} else{
			$lines = file("../soaldir/".$namasoal, FILE_IGNORE_NEW_LINES);
}

	foreach ($lines as $key => $value)
	{
	    $csv[$key] = str_getcsv($value);
	}
$hj = count($lines)-1;
	while ( $u <= $hj) {
		array_splice($tsoal,$m,0,$csv[$u][0]);
		array_splice($tratting,$m,0,$csv[$u][1]);
		array_splice($tlampiran,$m,0,$csv[$u][2]);
		array_splice($tjawaban,$m,0,$csv[$u][3]);
		array_splice($tkey,$m,0,$csv[$u][4]);

		if ($csv[$u][1] == 1) {

			array_splice($M,$sm,0,$u);
			$sm++;

		}elseif ($csv[$u][1] == 2) {

			array_splice($S,$ss,0,$u);
			$ss++;

		}elseif ($csv[$u][1] == 3) {

			array_splice($B,$sb,0,$u);
			$sb++;

		}
		$m++;
		$u++;
	}

//kirim data
	
$_SESSION['tsoal'] = $tsoal;
$_SESSION['tratting'] = $tratting;
$_SESSION['tlampiran'] = $tlampiran;
$_SESSION['tjawaban'] = $tjawaban;
$_SESSION['tkey'] = $tkey;
$_SESSION['M'] = $M;
$_SESSION['S'] = $S;
$_SESSION['B'] = $B;

?>