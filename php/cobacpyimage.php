<form method="post" enctype="multipart/form-data">
	<input type="file" name="da[]" multiple>
	<input type="submit" name="kirim" value="kirim">
</form>

<?php 

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
	$max_size = 200000;

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



if (isset($_POST['kirim'])) {

	echo "<pre>";
	$ty = $_FILES['da'];

	$re = cekdata($ty,$dir_image);


	if ($re == 1) {

		for ($i=0; $i < count($ty['name']) ; $i++) { 

			kirim($ty['tmp_name'][$i],$dir_image.$ty['name'][$i]);
		}
		echo "berhasil upload";

	}else{echo $re;}

	echo "</pre>";




					// foreach ($_FILES['da']['tmp_name'] as $key => $value) { 

			  //           $file_tmpname = $_FILES['da']['tmp_name'][$key]; 
			  //           $file_name = $_FILES['da']['name'][$key]; 
			  //           $file_size = $_FILES['da']['size'][$key];
			  //           $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 
			  //           $filepath = "../js/".$file_name;

			  //           if (file_exists("../js/".$file_name == true)) {

			  //           	echo $d;
			  //           	echo "asd";

			  //           }

			  //           $d++;



			  //       }

}

?>