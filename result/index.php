<html>
<head>
	<title>result</title>
	<link rel="sortcut icon" type="image/x-icon" href="../faviconn.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/blowup.js"></script>
	<script type="text/javascript" src="../js/ResizeSensor.js"></script>
	<script src="../js/easytimer.min.js"></script>

</head>

<style type="text/css">
	table, th, td {
	  border: 1px solid red;
	  border-collapse: collapse;
	}
</style>
<body id="result">
<?php
	ob_start();
	require_once('../php/TCPDF/tcpdf.php');
	require_once('../php/server.php');
	session_start();

	$filename= "{$_SESSION['payload'][2]}-{$_SESSION['payload'][1]}-{$_SESSION['payload'][0]}-{$_SESSION['identitas'][1]}-{$_SESSION['identitas'][3]}-{$_SESSION['identitas'][4]}"; 
	$tdb = $_SESSION['payload'];
	$vdb = $_SESSION['identitas'];
	$date_db = date('d-m-Y');
	$sql = "INSERT INTO ". $tdb[2] ." (nis,formula,nilai,date,time,file)
						VALUES ('". $vdb[1] ."','". $tdb[0] ."','". $tdb[1] ."', DATE_FORMAT(NOW(),'%d-%m-%Y'), CURTIME(),'". $filename.".pdf')";

	if (isset($_SESSION['payload'])) {
		// print_r($_SESSION['payload']);
		// print_r($_SESSION['psoal']);
		// print_r($_SESSION['outjawaban']);
		// print_r($_SESSION['identitas']);
		// print_r($_SESSION['plampiran']);
		// print_r($_SESSION['rawskor']);


		mysqli_query($conns, $sql);

		function gg(){


				$f = count($_SESSION['psoal']);
				$i = 0;

				$f = $f-1;

				$output = '';
			while ($i <= $f) {

				if ($i == 0) {
				$output .=  '<table style="page-break-after:always;" width = "600" cellpadding="10" cellspacing = "3" >
								<tr nobr="false">
								<tr>
									Nama : '.$_SESSION['identitas'][0].'<br>
									NIS : '.$_SESSION['identitas'][1].'<br>
									Kode Soal : '.$_SESSION['payload'][2].'<br>
									Matauji : '.$_SESSION['identitas'][2].'<br>		
									Total Nilai : '.$_SESSION['payload'][1].'<br><br>
									<u>soal '.($i+1).'</u><br><br>
									catatan soal : '.$_SESSION['cctnout'][$i].'<br>
									'.$_SESSION['identitas'][4].'/'.$_SESSION['identitas'][3].'<br><br>



								</tr>
									<tr>
										<td colspan="2" style="padding: 10px">'.$_SESSION['psoal'][$i].'</td>	
										<td colspan="2" align = "right"> 
										 <img src="../imagedir/'.$_SESSION['plampiran'][$i].'" height="200px"> 
										</td>
									</tr>
									<br>
									<br>
									<br>
									<tr>
										<td width = "45%" align = "center">jawaban</td>	
										<td width = "35%" align = "center">kunci jawaban</td>
										<td width = "10%" align = "center">skor</td>
										<td width = "10%" align = "center">skor (guru)</td>
									</tr>
									<td width = "45%">'.$_SESSION['outjawaban'][$i].'</td>
									<td width = "35%">'.$_SESSION['pjawaban'][$i].'<br><br>kata kunci<br>'.$_SESSION['pkey'][$i].'</td>
									<td width = "10%">'.$_SESSION['rawskor'][$i+1].'</td>
									<td width = "10%">&nbsp;</td>

								</tr>
							</table>
					';					
				}else{
				$output .=  '<table style="page-break-after:always;" width = "600" cellpadding="10" cellspacing = "3" >
								<tr nobr="false">
									<tr>
									<u>soal '.($i+1).'</u><br><br>
										catatan soal : '.$_SESSION['cctnout'][$i].'<br>
									'.$_SESSION['identitas'][4].'/'.$_SESSION['identitas'][3].'<br><br>



									</tr>
									<tr>
										<td colspan="2" style="padding: 10px">'.$_SESSION['psoal'][$i].'</td>	
										<td colspan="2" align = "right"> 
										 <img src="../imagedir/'.$_SESSION['plampiran'][$i].'" height="200px"> 
										</td>
									</tr>
									<br>
									<br>
									<br>
									<tr>
										<td width = "45%" align = "center">jawaban</td>	
										<td width = "35%" align = "center">kunci jawaban</td>
										<td width = "10%" align = "center">skor</td>
										<td width = "10%" align = "center">skor (guru)</td>
									</tr>
									<td width = "45%">'.$_SESSION['outjawaban'][$i].'</td>
									<td width = "35%">'.$_SESSION['pjawaban'][$i].'<br><br>kata kunci<br>'.$_SESSION['pkey'][$i].'</td>
									<td width = "10%">'.$_SESSION['rawskor'][$i+1].'</td>
									<td width = "10%">&nbsp;</td>

								</tr>
							</table>
					';
				}



					$i++;
			}
			return $output;
		}
		// session_destroy();
	}else{
		// session_destroy();
		// header('location:../');
	}
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($_SESSION['identitas']['0']);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 049', PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->setJPEGQuality(75);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetFont('helvetica', '', 10);
		$pdf->AddPage();
		$sek = gg();
		$pdf ->WriteHTML($sek, false, false, false, false, '');
			$pdf ->WriteHTML('<br>&nbsp;</br>', false, false, false, false, '');

		
		ob_end_clean();
		// ob_clean();
		$pdf->Output(__DIR__ . '/outdir/'.$filename.'.pdf', 'F');
 ?>
 	<div id="result-c-container">
 		<h2 id="top-c" style="padding: 15vh 3% 3% 0%;font-weight: 100;font-size: 3vh;width: 60%;">
 		Selamat!<br><u>Kamu telah menyelesaikan tes.</u></h2>

 		<h2 id="top-c" style=";font-weight: 800;font-size: 4.5vh;width: 60%;"><u>
 		Nilai yang kamu dapatkan adalah:</u></h2>
 		<h1 id="r-nilai" style="margin: auto; font-weight: 100; padding: 2% 0 5% 0;">
	 		<?php echo $_SESSION['payload'][1]; ?>

 		</h1>
 		<h2 id="top-c" style="font-size: 1vw;line-height: 3vh;">
		<?php $pesan = array("Berapapun hasil yang kamu dapat, itu adalah acuanmu untuk kedepan. Sekarang keputusanmu untuk berjuang demi hasil yang lebih baik atau kamu sudah cukup dengan hasil ini. selamat berjuang dengan pilihanmu, semua hal butuh perjuangan untuk didapatkan, tidak ada hal baik yang datang secara instan.",
			"Usaha tidak pernah menghianati hasil. Jangan menyerah dengan keadaan, semuanya bisa diubah menjadi lebih baik. tetaplah berusaha, jangan melihat sebuah kelemahan menjadi sebuah akhir dari usahamu.",
			"Rasa puas dapat menghambat perkembangan. Jangan cepat puas dengan pencapaian yang kamu dapatkan sekarang. Buktikan kamu bisa lebih dari ini, dan pasti kamu bisa menjadi lebih daripada kamu yang sekarang. Tingkatkan usaha dan doa.",
			"Juara yang benar - benar juara adalah mereka yang bisa mempertahankan gelar juaranya. Mempertahankan posisi lebih terasa berat jika dibandingkan dengan perjuangan mendapatkan sebuah posisi. Teruslah semangat teruslah berusaha. Selamat atas pencapaianmu.");
			$nss = $_SESSION['payload'][1]; 

			if ($nss >= 75) {
				echo $pesan[3];
			}elseif($nss >= 50){
				echo $pesan[2];
			}elseif($nss >= 25){
				echo $pesan[1];
			}else{
				echo $pesan[0];
			}

		?>
 		</h2>
 		<h2 id="but-c" style="padding-top: 7%;padding-left: 0;">*)<u>Nilai yang ditampilkan merupakan nilai dengan skala 0 - 100.</u></h2>

 		<h2 id="but-c" style="padding-left: 0;">*)<u>Halaman ini hanya menampilkan nilaimu.</u></h2>
 		
 	</div>
 	<div id="img-container-r">
		<div id="cacatan-container">
			
 		<h1 id="m-catatan" style="color: #264653;font-size: 1.7vw;font-weight: 100;padding: 1vw 5vw;">Catatan:</h1>
			<?php 
				$u = count($_SESSION['cctnout'])-1;
				for ($i=0; $i <= $u ; $i++) { 
			?>

			<div id="s-cctn-con">
				<?php echo "<b>Soal#".($i+1)."</b><br>"; echo " &#9210; ".$_SESSION['cctnout'][$i]; ?>
			</div>


			<?php
				}
			?>

		</div>
	</div>
 <script type="text/javascript">
 	new ResizeSensor(jQuery('body'),function(){
		console.log($('body').width());	
		if ($('body').width() <= 730) {
			responsive($('body').width());
		}
	});

 	function responsive(width){

 		$('#result-c-container').width(width);
 		$('#img-container-r').width(width);
 		$('#result').css("overflow","auto");
 		$("#m-catatan").css("font-size","2pc");
 		$("div[id^='s-cctn-con']").css("padding",width/20+ "0");
 		$("div[id^='s-cctn-con']").css("background","#cacaca");
 		$("div[id^='s-cctn-con']").css("max-height","unset");
 		// $("div[id^='s-cctn-con']").css("line-height",width/50);

 	}







 	function mapps(num,in_min,in_max,out_min,out_max){
 		return (num - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
 	}

	let h = <?php echo $_SESSION['payload'][1]; ?>;

	let hue = mapps(h,0,100,0,360);
	$("#r-nilai").css("background-image","linear-gradient(to bottom left, hsla("+hue+",60%,80%,1) , hsla("+hue+",50%,40%,1))");
	// $("#img-container-r").css("background","hsla("+hue+",50%,40%,.5)")
	$("#result").css("background","hsla("+hue+",60%,70%,.05)");
	$(document).ready(function(){
		console.log(hue);
	})
 </script>
</body>
</html>
