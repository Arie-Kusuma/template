<?php 

// semua upload policy udah migrasi disini semua,
// programnya konyol, tolong jangan dipake untuk hal serius
// program dibuat tidak mempertimbangkan aspek keamanan
// karena program dibuat hanya untuk menguji algoritma string similarity buat skripsi saya
// sekali lagi, tolong jangan gunakan program ini untuk skala besar dan keperluan serius
// reach me twitter@ArieDwiKusuma1

require_once('server.php');

		$panduan = "";
		$realcode  = "";
		$status = array();
		$dir_image			= "../imagedir/";
		$dir_soal			= "../soaldir/";



function kirim($filee,$des){

	// $filee = ['tmp_name'] dari origin
	// $des = direktori destinasi + namafile

	$stat = move_uploaded_file($filee, $des);
	return $stat;

}

function cekdata($origin,$des){

	// $origin = kiriman data file
	// $des = direktori tempat membandingkan
	$allowed_types_img	= array('jpg', 'png', 'jpeg');
	$max_size = 2000000;

	$data = array();

	for ($i=0; $i < count($origin['name']); $i++) { 
		
		$extdata = pathinfo($origin['name'][$i], PATHINFO_EXTENSION);
		$size_oa = $origin['size'][$i];

		if (file_exists($des.$origin['name'][$i]) == true ) {
			$data[$i] = 1;
			return $origin['name'][$i]." sudah ada, ganti nama file secara unik";
		}elseif (in_array($extdata, $allowed_types_img) == false) {
			$data[$i] = 1;
			return "format ".$origin['name'][$i]." tidak support, pastikan file gambar menggunakan format .jpg, .png atau .jpeg";

		}elseif ($size_oa > $max_size) {
			$data[$i] = 1;
			return $origin['name'][$i]." terlalu bersar, coba kecilkan ukuran file";

		}
		else{
			$data[$i] = 0;
		}
	}

	// print_r($data);
	if (!in_array(1, $data)) {

		return 1;

	}else{return 0;}



}
function ceksoal($origin,$des){

	// $origin = kiriman data file
	// $des = direktori tempat membandingkan
	$extdata = pathinfo($origin['name'], PATHINFO_EXTENSION);
	if (file_exists($des.$origin['name']) == true) {
		return $origin['name']." sudah ada, ganti nama file secara unik";
	}elseif ($extdata != 'csv') {
		return "format ".$origin['name']." tidak support, pastikan file soal menggunakan format .csv";
	}else{
		return 1;
	}


}

function getCode($n) { 

	// $n = jumlah digit code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function filterdata($data,$num) {

	if (empty($data)) {
		return 0;
	}
	// $data = [tmp_name] dari file soal
	// $num = inputan jumlah soal
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

	$nums = ceil(100*((int)$num/100));
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


if (isset($_POST['submit'])) {

	// echo "<pre>";
	$ty = $_FILES['files'];
	$ts = $_FILES['soal'];

    $matauji = $_POST['matauji']; 
    $durasi = (int)$_POST['durasi']; 
    $jumsol = $_POST['jumsol']; 
	$code = getCode(5);
	$files_name = $ts['name'];

	$authsoal_tmpname = $ts['tmp_name'];

		$re = 0;
		$te = 0;

		$re = cekdata($ty,$dir_image);
		$te = ceksoal($ts,$dir_soal);
		if ($re == 1) {
			if ($te == 1) {
			$filter = filterdata($authsoal_tmpname,$jumsol);
			}else{$status[0] = $te;}
		}else{$status[1] = $re;}



		//query disini

				$sql = "INSERT INTO listsoal (code,namasoal,matauji,jumsol,durasi,date,time)
						VALUES ('". $code ."','". $files_name ."','". $matauji ."','". $jumsol ."','". $durasi ."', NOW(), CURTIME())";

				$sqls = "CREATE TABLE `".$code."` (
						id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						nis int(20) NOT NULL,
						formula VARCHAR(70) NOT NULL,
						nilai int(20) NOT NULL,
						date VARCHAR(500) NOT NULL,
						time time,
						file VARCHAR(500) NOT NULL
						)";

		//stop


		if (is_int($durasi)) {
			if ($_FILES['soal']['size']>0) {
				if ($_FILES['files']['size']>0) {
					if ($filter == 1) {

						for ($i=0; $i < count($ty['name']) ; $i++) { 
							kirim($ty['tmp_name'][$i],$dir_image.$ty['name'][$i]);
						}
						kirim($ts['tmp_name'],$dir_soal.$ts['name']);
						mysqli_query($conn, $sql);
						mysqli_query($conns, $sqls);

						$status[0]= "berhasil upload file";
						$realcode = "kode soal : ".$code;
						$panduan = "simpan kode soal untuk mengakses soal";						
					}
					else{$status[0]= "proporsi soal tidak match dengan jumlah soal, kurangi jumlah soal atau tambah soal";}
				}
				else{$status[0]= "file lampiran tidak boleh kosong";}
			}
			else{$status[0]= "file soal tidak boleh kosong";}
		}
		else{$status[0]= "masukan durasi dengan benar";}


	echo "</pre>";
}

	



?>