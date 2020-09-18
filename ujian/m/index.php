<!DOCTYPE html>
<?php 
require_once('../../php/server.php');
session_start();
	if (!isset($_SESSION['nis'])) {
		header('location:../');
		session_destroy();
	}else {

	require_once('../../php/getdata.php');
	require_once('../../php/getformula.php');
	require_once('../../php/tampildata.php');

	}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ujian</title>
	<script type="text/javascript" src="../../js/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/style.css">
	<script src="../../js/easytimer.min.js"></script>
	<script type="text/javascript" src="../../js/blowup.js"></script>
	<script type="text/javascript" src="../../js/ResizeSensor.js"></script>

	<!-- <script type="text/javascript" src="../js/jquery.waves.js"></script> -->
	<!-- <link rel="stylesheet" type="text/css" href="./../style/jquery.waves.min.css"> -->

	<link rel="sortcut icon" type="image/x-icon" href="../../faviconn.ico"></head>
</head>
<body id="m-ujian">

	<!--welcome screen-->
	<div id="m-fpage" style="display: block;">
		<div id="m-container-main">
			<h1><?php echo "Waktu ".$_SESSION['durasi']." menit"; ?></h1>
			<h3><?php echo $_SESSION['matauji']; ?></h3>
			<div id="m-flag-identitas">
				<h5><?php echo "Nama 		: ".$_SESSION['nama']; ?></h5>
				<h5><?php echo "Nis 		: ".$_SESSION['nis']; ?></h5>
				<h5><?php echo "Kelas 		: ".$_SESSION['jurusan'].$_SESSION['kelas']." ".$_SESSION['tahun']; ?></h5>
				<h5><?php echo "Kodesoal 	: ".$_SESSION['code']; ?></h5>		
				<h5><?php echo "Jumlah Soal : ".$_SESSION['jumsol']; ?></h5>
			</div>
		</div>
		<div id="m-caution">
			<h3 id="m-coundowns">
				program tidak dilengkapi dengan auto-save, jangan me-reload halaman ketika dalam skenario ujian, karena akan me-reset waktu dan jawaban.
			</h3>
		</div>

		<div id="m-f-action">		
			<button onclick="h('#m-fpage')">Mulai</button>
			<form method="post" action="../../php/logout.php">
				<input id="m-finish-1" type="submit" name="keluar" value="Keluar">
			</form>
		</div>
		


	</div>

	<!-- soal -->

	<div id="m-mainsoal-container">
		<div id="m-action-atas">
			<h5 id="m-maincoundown">00:00:00</h5>
			<form method="post" action="../../php/logout.php">
				<input id="m-finish-1" type="submit" name="keluar" value="Selesai">
			</form>		
		</div>
		<div id="m-main-control">
			<mark id="aguspancing">1.</mark>

			<div style="background: transparent;width: 100%;margin: auto;margin-left: 0;">
				<mark style="font-family: icon;font-size: 3pc;padding: .5vh 1vh;margin: 0 0 0 3%;" id=pref-btn>5</mark>
				<mark style="font-family: icon;font-size: 3pc;padding: .5vh 1vh;margin: 0 0 0 4%;" id=nxt-btn>6</mark>
			</div>

		</div>		

<?php for ($i=0; $i <count($soal); $i++) {?>

		<div id=<?php echo "m-container-conten-ujian".$i; ?>>
			<div id="m-container-contens-soal">	<?php echo $soal[$i]; ?></div>
			<div id="m-container-contens-lampiran">	
				<img  id=<?php echo "lampiran".$i; ?> src=<?php echo "../../imagedir/".$lampiran[$i];?>>
			</div>			
			<div id="m-container-contens-textarea">
				<textarea placeholder="jawab disini" name=<?php echo "jawaban".$i; ?> id=<?php echo "ta".$i; ?> ></textarea>

			</div>			
		</div>

<?php } ?>

	</div>
	<script type="text/javascript">
	    
	    var timer = new easytimer.Timer();
		let jumsol = <?php echo $_SESSION['jumsol'] ?>;
		let durasi = 60*<?php echo (int)$_SESSION['durasi'] ?>;
		let finishbut = "#m-finish-1";
		let frt = 0;


		function h(h){
			$(h).hide();

				timer.start({countdown: true, startValues: {seconds: durasi}});
					$('#m-maincoundown').html(timer.getTimeValues().toString());
				timer.addEventListener('secondsUpdated', function (e) {
				    $('#m-maincoundown').html(timer.getTimeValues().toString());
				});
				timer.addEventListener('targetAchieved', function (e) {
				    $('#m-maincoundown').html('WAKTU HABIS');
				    $(finishbut).trigger("click");
				});

			$("#m-container-conten-ujian0").show();


		};
		function hide(aa){
			for (var i = 0; i < aa; i++) {
				let bg = "#m-container-conten-ujian"+i;
				$(bg).hide();
			};
			// $("#gofar-hilman").hide();
		};

		hide(jumsol);



		$("#nxt-btn").click(function(){


			// console.log(frt);
			frt = frt+1;
				if (frt>=jumsol) {frt=0;};
	
				let yu = "#m-container-conten-ujian"+frt;
				// console.log(yu);
				$("#aguspancing").html(frt+1+'.');
				$("#m-container-conten-ujian"+frt).show();
				$("div[id^='m-container-conten-ujian']:not("+yu+")").hide();
				// $("#ta"+frt).focus();




		})

		$("#pref-btn").click(function(){


			// console.log(frt);
			if (frt<=0) {frt=jumsol;};
				$("#aguspancing").html(frt+'.');
				frt = frt-1;
	
				let yu = "#m-container-conten-ujian"+frt;
				$("div[id^='m-container-conten-ujian']:not("+yu+")").hide();
				$("#m-container-conten-ujian"+frt).show();
				// $("#ta"+frt).focus();
				// console.log(yu);

		})


	</script>
</body>
</html>