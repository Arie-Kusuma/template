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
	<title></title>
</head>
<body>

	coba

</body>
</html>