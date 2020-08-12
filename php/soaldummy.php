<link rel="stylesheet" type="text/css" href="../style/style.css">
<?php 
session_start();

require_once('getdata.php');
require_once('tampildata.php');
$a = 0;
while ($a <= count($soal)-1) {

?>
<style type="text/css">body{overflow: auto;}</style>
<div class="coba">
	<?php 
	echo $soal[$a];
	echo "<br>";
	echo "<br>";
	echo $jawaban[$a];
	echo "<br>";
	echo "<br>";
	echo $key[$a];
	echo "<br>";
	echo "<br>";

	?>
	<form method="post">

		<textarea name=<?php echo 'jawban'.$a ?>>sukarno,soekamto,ir.sukarno</textarea>

</div>

<?php $a++;} ?>
	<input type="submit" name="masuk" value="masuk">
	</form>

<?php 

	$outjawaban = array();


	if (isset($_POST['masuk'])) {

		$i = 0;

			$nt = 0;
			$nt = count($soal)-1;
		while ($i <= $nt) {

			array_push($outjawaban, $_POST['jawban'.$i]);
			$i++;

		}

}




		// koreksi soal

		echo "<pre>";
		require_once('rkoreksi.php');

?>
