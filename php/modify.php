<?php 
session_start();

function cdb(){

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
}

function recdatabase($kode,$alamat) {

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


	$sql2 = "SELECT * FROM listsoal WHERE code='". $kode ."' LIMIT 1";

	$req2 = mysqli_query($conn, $sql2);

	if (mysqli_num_rows($req2)) {

		while ($atz = mysqli_fetch_array($req2)) {

		  	$_SESSION['code'] = $atz['code'];
		  	$_SESSION['namasoal'] = $atz['namasoal'];
		  	$_SESSION['jumsol'] = $atz['jumsol'];
		  	$_SESSION['durasi'] = $atz['durasi'];
		  	$_SESSION['matauji'] = $atz['matauji'];
		  	$_SESSION['namasoal'] = $atz['namasoal'];

			header('location: ../upload/'.$alamat);	
		}
	}else {
	 	// $_SESSION['alert'] = "kode yang dimasukan salah";
		session_destroy();
	  	header('location:../upload');
	}	

}

if (isset($_POST['ubah'])) {


	$kodesoal_input = $_POST['kodes'];

	recdatabase($kodesoal_input,"ubah");

}
if (isset($_POST['hapus'])) {


	$kodesoal_input = $_POST['kodes'];

	recdatabase($kodesoal_input,"hapus");

}
if (isset($_POST['kemasan'])) {


	$kodesoal_input = $_POST['kodes'];

	recdatabase($kodesoal_input,"kemasan");

}


if (isset($_POST['ubh-kemasan'])) {

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


    $matauji = $_POST['matauji']; 
    $durasi = (int)$_POST['durasi']; 
    $jumsol = $_POST['jumsol'];
    $djumsol = filterd($_SESSION['namasoal']);

	if ($jumsol<=$djumsol) {
	    $_SESSION['code'] = $_SESSION['code'];

	    $sql = "UPDATE listsoal SET matauji = '". $matauji ."', durasi = '". $durasi ."', jumsol = '". $jumsol ."' WHERE code = '". $_SESSION['code'] ."'";

	    $reqkemasan = mysqli_query($conn,$sql);


	    if ($reqkemasan) {
   		    $_SESSION['code'] = $_SESSION['code'];

	    	$sql2 = "SELECT * FROM listsoal WHERE code='". $_SESSION['code'] ."' LIMIT 1";

			$req2 = mysqli_query($conn, $sql2);

			if (mysqli_num_rows($req2)) {

				while ($atz = mysqli_fetch_array($req2)) {
				  	$_SESSION['code'] = $atz['code'];
				  	$_SESSION['jumsol'] = $atz['jumsol'];
				  	$_SESSION['durasi'] = $atz['durasi'];
				  	$_SESSION['matauji'] = $atz['matauji']."validasi";
				  	$_SESSION['namasoal'] = $atz['namasoal'];
					$_SESSION['resultac'] = "berhasil mengubah data";
					header('location:../upload/kemasan');
				}
			}

	    }else{
   		    $_SESSION['code'] = $_SESSION['code'];
			$_SESSION['resultac'] = "gagal mengubah data, masukan data dengan benar";
			header('location:../upload/kemasan');
	    }
	}else{
	    $_SESSION['code'] = $_SESSION['code'];
		$_SESSION['resultac'] = "jumlah soal melebihi kapasitas";
		header('location:../upload/kemasan');
	}

}
function filterd($data) {

	if (empty($data)) {
		return 0;
	}
	// $data = [tmp_name] dari file soal
	$csv = array();
	$lines = file("../soaldir/".$data, FILE_IGNORE_NEW_LINES);
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
	return max($out);

	// return $out;


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
if (isset($_POST['ubh-soal'])) {

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


		$dir_image			= "../imagedir/";
		$dir_soal			= "../soaldir/";

	    $_SESSION['code'] = $_SESSION['code'];

		// $_SESSION['resultac'] = "jumlah soal tidak sesuai standar";
		// header('location:../upload/ubah');


		$ty = $_FILES['files'];
		$ts = $_FILES['soal'];
		$files_name = $ts['name'];
		$jumsol = $_SESSION['jumsol'];
		$authsoal_tmpname = $ts['tmp_name'];

		$re = cekdata($ty,$dir_image);
		$te = ceksoal($ts,$dir_soal);
		if ($re == 1) {
			if ($te == 1) {
			$filter = filterdata($authsoal_tmpname,$jumsol);
			}else{$_SESSION['resultac'] = "soal tidak sesuai standar";header('location:../upload/ubah');}
		}else{$_SESSION['resultac'] = "lampiran tidak sesuai standar";header('location:../upload/ubah');}

		if ($_FILES['soal']['size']>0) {
			if ($_FILES['files']['size']>0) {
				if ($filter == 1) {

					for ($i=0; $i < count($ty['name']) ; $i++) { 
						kirim($ty['tmp_name'][$i],$dir_image.$ty['name'][$i]);
					}
					kirim($ts['tmp_name'],$dir_soal.$ts['name']);
						    
					$sql = "UPDATE listsoal SET namasoal = '". $files_name ."' WHERE code = '". $_SESSION['code'] ."'";

				    $reqkemasan = mysqli_query($conn,$sql);

				    if ($reqkemasan) {
						$_SESSION['resultac'] = "Berhasil ubah soal";
						header('location:../upload/ubah');
				    }
				}
				else{$_SESSION['resultac'] = "proporsi soal tidak match dengan jumlah soal, kurangi jumlah soal atau tambah soal";header('location:../upload/ubah');}
			}
			else{$_SESSION['resultac'] = "file lampiran tidak boleh kosong";header('location:../upload/ubah');}
		}
		else{$_SESSION['resultac'] = "file soal tidak boleh kosong";header('location:../upload/ubah');}

}
if (isset($_POST['ubh-hapus'])) {

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
	
	$sql = "UPDATE listsoal SET code = '". $_SESSION['code'] ."-deleted' WHERE code = '". $_SESSION['code'] ."'";

	$reqkemasan = mysqli_query($conn,$sql);

	if ($reqkemasan) {

		$_SESSION['resultac'] = "Berhasil hapus soal";
		header('location:../upload/hapus');
	}
}
 ?>