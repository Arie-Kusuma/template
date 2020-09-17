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
	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<!-- <script type="text/javascript" src="../js/jquery.waves.js"></script> -->
	<!-- <link rel="stylesheet" type="text/css" href="./../style/jquery.waves.min.css"> -->
	<link rel="sortcut icon" type="image/x-icon" href="../faviconn.ico"></head>
</head>
<body>
	<?php echo $soal[0]; ?>
</body>
</html>