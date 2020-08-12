<form method="post" action="#">
	<input type="text" name="code" value="txv3T">
	<input type="submit" name="kirim" value="kirim">
</form>

<?php 

require_once('server.php');
session_start();

$codesoal = '';

	$code = '';
	if (isset($_POST['kirim'])) {
		$code = $_POST['code'];
		$_SESSION['code'] = $code;

	}


	$q = "SELECT * from listsoal WHERE code='". $code ."'";

	$querry = mysqli_query($conn,$q);

	while ($row = mysqli_fetch_array($querry)) {

		echo $row['namasoal'];
		$codesoal = $row['namasoal'];
	}





		$csv = array();
		$lines = file("../soaldir/".$codesoal, FILE_IGNORE_NEW_LINES);

		foreach ($lines as $key => $value)
		{
		    $csv[$key] = str_getcsv($value);
		}
		echo $csv[1][1];



	session_destroy();





?>