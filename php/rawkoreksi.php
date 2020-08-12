

<!-- 	RAW KOREKSI
 -->

<!--
	output -> skor per soal berdasarkan key
 -->

<!--
	1. mencari kata didalam $outjawaban yang mempunyai kemiripan dengan $key 
	2. proses membandingkan $outjawaban(array) dengan $key(array)
 -->

 
<?php 

	// read this
	// 
	// 
	// 
	// 	
	// $jawaban adalah jawaban dari siswa ($outjawaban)
	// $key adalah variabel key atau kunci jawaban dari soal


	// 1. pecah $jawaban menjadi array dan dimasukan kedalam variabel array baru sesuai dengan index array $jawaban
	// ex : $jawaban0[], jawaban1[] , $jawabann[]
	// parsing data menggunakan karakter spasi untuk memecah string mendjadi kumpulan char

	// 2. pecah $key menjadi array dan dimasukan kedalam variabel array baru sesuai dengan index array dari $key
	// ex : $key0[],$key1[],$key2[]
	// parsing untuk variabel key menggunakan pemisah tanda baca koma " , " sesuai dengan format dari file soal untuk input key ("key,key,key,key,key,key")

	// 3. bandingkan satu persatu $keyn[] pada $jawbann[]
	// ex : $key0[sukarno,sorkarno,ir.soekarno] : $jawaban0[bapak, presiden, sukarno]
	// output $skor merupakan kalkulasi dari setiap index soal yang dibandingkan degan key
	
	// output yang diharapkan adalah perhitungan skor per-index adalah rata - rata dari jarak levensthein dari setiap key untuk setiap index soal
	// ex : $skor0[50,20,40,60,80]
	// (50+20+40+60+80)/5 = 66
	// jadi skor untuk jawaban soal pertama adalah 66, dana akan dimasukan kedalam variabel $skor total sesuai dengan index soal
	// >> $skortotal[66, , , , ]

	// jika ada index jawban kosong akan dikenakan value untuk skor adalah 0 atau paling kecil
	//
	// 
	// koreksi soal hanya dilakukan dengan syarat key hanya untuk satu kata 
	// penggunaan syarat satu kata mengacu pada penggunaan algoritma levensthain yang digunakan
	// penggunaan satu kata untuk key juga berkaitan dengan metode parsing data jawaban yang sensitif dengan spasi,  artinya jawban akan di pecah per-kata yang dideteksi oleh spasi, sistem akan memisahkan kata setelah mendeteksi ada spasi
	// ketika satu key mengandung lebih dari 1 kata yang berarti mengandung lebih dari satu spasi akan membuat perhitungan levensthain tidak akurat
	//
 	// 
function rawkoreksi($jawaban, $key){

	$skortotal = array();
	$skorfinal = 0;


		// to think
		// 1. masukan yang ada di variabel $jawaban dan $key ke variabel baru
		// 2. bangingkan satu persatu
		// 3. masukan value baru

		// parsing data, metode regular expression
		// $zjawaban = preg_split( "/(,| |-)/", $jawaban);
		// $zkey = preg_split( "/(,| |-)/", $key);

		// parsing sekut v1

		$zjawaban = preg_split( "/[\s,|-]+/", $jawaban);
		$zkey = preg_split( "/[\s,|-]+/", $key);

		// $coa = explode(" ", $jawaban);

		// echo "<br><br><br>";
		// echo "jawaban <br>";
		// echo "<br><br><br>";
		// print_r($zjawaban);
		// echo "<br><br><br>";
		// echo "jawaban-coba <br>";
		// print_r($coa);
		// echo "<br><br><br>";
		// echo "key <br>";
		// print_r($zkey);
		// echo "<br><br><br>";

		$i = 0;
		$levnilai = 0;
		$d = 0;
		$skors = 0;

		// mulai membandingkan
		// pacah kunci jawaban/ kedalam pecahan karakter
		foreach ($zkey as $dkey) {

			// pacah jawaban pecahan karakter
			foreach ($zjawaban as $keys) {
				if (!empty($keys)) {
					$lev = levenshtein(strtolower($dkey), strtolower($keys));

					$ctarget = count(str_split($dkey));
					$csumber = count(str_split($keys));
					$levnilai = (1-$lev/max($ctarget,$csumber))*100;



					// prinsip skor adalah hasil bandingan yang terbesar adalah yang bertahan
					if ($levnilai > $d ) {

						$d = $levnilai;
					}
					else{
						$d = $d;
					}

					// echo $keys."/".$dkey."/".$d." | ";

				}else{
					$d = $d;
				}
					$skortotal[$i] = $d;
			}
			// echo "<br>";
			$d = 0;
			$i++;
		};

		// print_r($skortotal);
		
		// menghitung skorfinal
		// skorfinal = rata - rata dari skortotal
		foreach ($skortotal as $skor) {
			$skors = $skors + $skor;
			$skorfinal = $skors/count($skortotal);
		}
		return $skorfinal;

}
?>






<!-- harus ada pengembangan dibagaian koreksi, kususnya pengenalan kalimat khusus seperti " rumah sakit, jatuh cinta " kata baru dari gabungan beberapa kata yang berarti satu kata -->



<!-- solusi

	kaliwaru, 4 februari 2020


	-- keyword --
	- parsing string menggunakan regualar expresion

	untuk metode tersebut hanya berlaku untuk koreksi jawaban dengan kata kunci
		-- kata kunci dubuat lebih advance jika ada kalimat khusus didalamnya
 -->

 <!-- to think


	format kata kunci lama
		|->	 kata1,kata2,kata3
		
			$$ kata kunci diparsing dengan karakter koma sebagai pemisah sebelum masuk ke fungsi
		
	format kata kunci baru
		|-> kata kunci1, kata kunci dua, kata ketiga

			$$ kata kunci akan diparsing dengan metode yang sama
			$$ jadi kata kunci yang masuk ke fungsi rawkoreksi adalah string dengan spasi
				|-> sumah sakit
				|-> sakit hati
				|-> bunuh diri

	algoritmanya adalah mendeteksi jumlah string didalama satu kata kunci sebagai key untuk parsing jawaban
		|->Jawban panjang akan diparsing dengan panjang sesuai dengan panjang kata kunci
			$$kata kunci
				|-> rumah sakit = 2 string
			$$jawaban panjang
				|-> teman saya kemaren jualan sempak di rumah sakit samping rumah sakit jiwa
			$$ program akan mendeteksi jumlah string di key dengan spasi sebagai separator
			$$ program akan memecah jawaban kedalam kumpulan string dengan jumlah kata yang sama dengan key
				|-> array ("teman saya","kemaren jualan","sempak di","rumah sakit",...)

			$$ dengan demikian program akan membanding kan kata dengan lebih advance

  -->
  <!-- 
	
	--downside--

			kaliwaru, 10 februari 2020

	- solusi diatas hanya berlaku serial satu komposisi

	- contoh kasus komposisi
		|-> komposisi jawban 1
		|	$$ saya jatuh cinta 
		|-> komposisi jawaban 2
		|	$$ saya kemarin jatuh cinta
	- ketika key yang diberikan adalah
		|-> $$ jatuh cinta

	- artinya solusi diatas hanya bekerja untuk contoh komposisi jawaban 2
	- karena jumlah kata dalam key diatas adalah 2
	- yang akan langsung memisahkan kata dari kalimat setiap 2 kata dimulai dari kata ke 1


	uteke mubal, bunek, ngaso sek, pikir ssk neh





	kebumen 10 juni 2020

			iseh mubal, malah tambah mubal durung nemu solusine jancuk
				
				masih dengan key = satu kata

			adol pancing wae cetho gampang cokk

	kebumen 18 juni 2020

			akhirnya ketemu solusi, sekut....

			solusi untuk lack parsing karakter dapat diatasi dengan melakukan multiple loop sesuai jumlah karakter yang ada pada key

			$$seeitworks
				|->tambahkan ofset kelipatan satu sebanyak karakter key

			//contoh kasus

			$$key
				|-> rumah sakit

			- loop akan dilakukan sebanyak 2 kali dengan 2 versi berbeda

			- parsing dilakukan dengan batasan 2 kata (sesuai dengan jumlah karakter key) namun loop parsing ditambahkan offset setiap kali loop

			$$ex:
			|__
				|$$jawaban1
					|-> kakak saya masuk ke rumah sakit kemaren abis magrib

				$$loop 1 untuk jawaban 1
					|-> ("kakak saya","masuk ke","rumah sakit","kemaren abis","magrib")
				$$loop 2 untuk jawaban 1
					|-> ("kakak","saya masuk","ke rumah"," sakit kemaren","abis magrib")

				melakukan variasi sebanyak jumlah karakter pada key dapat membuat akurasi koreksi semakin baik

				$$key
					|->offset split
					|->regular expression



			--downside
				
			konstruksi regex yang susah untuk dibuat
   -->
