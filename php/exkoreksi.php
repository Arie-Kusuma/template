<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form method="post">
	<textarea id="jawaban" name="jawaban" style="width: 100%;height: 40vh"></textarea>
	<textarea id="kunci" name="kunci" style="width: 100%;height: 20vh"></textarea>
	<input type="submit" name="cek" value="cek">
</form>

<?php 

require_once('rawkoreksi.php');


if (isset($_POST['cek'])) {
	$jawabane = $_POST['jawaban'];
	$kuncie = $_POST['kunci'];

	print(rawkoreksi($jawabane,$kuncie));



}


?>

</body>
</html>	