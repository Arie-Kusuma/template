<?php
//////////////////////
$N = $_SESSION['jumsol']; //jumlah soal// jumlah soal didapat dari inputan database
//////////////////////

// fungsi ngecek existing formula based on nis
function cekifexist($nis,$kode){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbnames = "soal";


			$conns = mysqli_connect($servername, $username, $password, $dbnames);

			if (!$conns) {
			    die("Connection failed: " . mysqli_connect_error());
			}




					$sql ="SELECT formula FROM ". $kode ." WHERE nis = ". $nis ." order by date desc, time desc limit 1";
					$req1 = mysqli_query($conns, $sql);


					if ($ats = mysqli_fetch_array($req1)) {

						return $ats['formula'];
					}else{
						return 0;

					}

}
// fungsi ngecek existing formula based on nis stop here





	$soalM = (ceil(($N*30)/100));
	$soalB = (ceil(($N*30)/100));
	$soalS = $N-($soalB+$soalM);


	$auth = 0;
	// $auth = cekifexist((int)$_SESSION['nis'],$_SESSION['code']);

	if ($auth != 0) {

	$_SESSION['tformula'] = explode("-", $auth);



	}
	elseif (empty($_SESSION['tformula'])) {

		$indexM = get_true_index(rnds(count($M),$soalM),$M);
		$indexS = get_true_index(rnds(count($S),$soalS),$S);
		$indexB = get_true_index(rnds(count($B),$soalB),$B);


		$tformula = array_merge($indexM,$indexS,$indexB);

		$_SESSION['indexM'] = $indexM;
		$_SESSION['indexS'] = $indexS;
		$_SESSION['indexB'] = $indexB ;

		$_SESSION['tformula'] = $tformula;
	}
	function rnds($btsup,$sloop){ 

	// mendapatkan random index soal based on ratting
	// inputan //
	// $btsup = batas maksimal index
		//		|_> jumlah index masukan soal per-ratting ($M, $S, $B)
	// $btsloop = batasan perulangan
		//		|_> jumlah perhitungan jumlah soal per ratting ($soalM, $soalS, $soalB)

		$g = 1;
		$output = array();
		$inp = range(0, $btsup-1);
		shuffle($inp);
		while ($g <= $sloop) {
			array_push($output, $inp[$g]);
			$g++;
		}
	
		return $output;
	};

	function get_true_index($d1,$d2){
		
	// mendapatkan true index soal per-ratting
	// inputan //
	// $d1 = variable outputan dari fungsi rnds
	// $d2 = true index per-ratting($M, $S, $B)


		$i = 0;
		$f = array();
		while ($i+1 <= count($d1)) {

			$j = $d2[$d1[$i]];

			array_push($f, $j);

			$i++;
		}
		return $f;
	}



 ?>