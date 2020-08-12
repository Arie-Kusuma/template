<form method="post" enctype="multipart/form-data">
	<input type="file" name="pick">
	<input type="nummber" name="jumsol">
	<input type="submit" name="kirim" value="kirim">

</form>
<?php 

function filterdata($data,$num) {
	$csv = array();
	$lines = file($data, FILE_IGNORE_NEW_LINES);
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

	$nums = ceil(60*((int)$num/100));
	// echo $nums;


	foreach ($lines as $key => $value)
	{
	    $csv[$key] = str_getcsv($value);
	}
		// print_r($csv);
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
	};
	$out = array(count($M),count($S),count($B));
	// print_r($out);
	$auth = array();
	$i = 0;
	foreach ($out as $key) {
		if ($key < $nums) {
			$auth[$i] = 1;
		}
		$i++;
	}

	if (in_array(1, $auth)) {
		return 0;
	}else{
		return 1;
	};

	// return $out;


}
if (isset($_POST['kirim'])) {

	echo "<pre>";
	$tmp_data = $_FILES['pick']['tmp_name'];

	$jumsol = $_POST['jumsol'];
	print_r(filterdata($tmp_data,$jumsol));

}

?>