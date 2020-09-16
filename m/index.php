<?php 
require_once('../php/auth.php');

if (rede() == 0) {

	header('location:/template/');

}

session_start();


	if (isset($_SESSION['nis']) && isset($_SESSION['tformula'])) {
		header('location:ujian/');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistem Ujian Essai</title>
	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<script type="text/javascript" src="../js/jquery.waves.js"></script>
	<link rel="stylesheet" type="text/css" href="./../style/jquery.waves.min.css">
	<link rel="sortcut icon" type="image/x-icon" href="../faviconn.ico"></head>
<body id="m-index">

	<div id="m-top-title">
					<h2 id="m-title">
						Sistem Ujian Essai <mark id="m-dc">-open beta-</mark>
					</h2>
	</div>

	<div id="mid-title">
		<h1 id="date">{time.now}</h1>
	</div>


<script type="text/javascript">
	 function clockTick()    {
       currentTime = new Date();
       month = currentTime.getMonth() + 1;
       day = currentTime.getDate();
       year = currentTime.getFullYear();
       jam = ('0'+currentTime.getHours()).slice(-2);
       menit = ('0'+currentTime.getMinutes()).slice(-2);
      // alert("hi");
      document.getElementById('date').innerHTML=day + "/" + month + "/" + year + " | "+ jam + ":" + menit ;
    }
    


   setInterval(function(){clockTick();}, 1000);

</script>
</body>
</html>