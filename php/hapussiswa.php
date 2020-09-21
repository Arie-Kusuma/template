
<?php
require_once('server.php');
// if (isset($_POST['hapus'])) {
// if(array_key_exists('hapus', $_POST)) {

	$nis 		= 	$_GET['nis'];
	// $sql		=	"DELETE FROM datasiswa WHERE (nis,jurusan,kelas,tahun,nama)
	//  				 VALUES ('". $nis ."','". $jurusan ."','". $kelas ."','". $tahun ."','". $namsis ."')";
	$sql		=	"DELETE FROM datasiswa WHERE nis = '$nis'";

	if (mysqli_query($conn, $sql)) {

		$_SESSION['panduan'] = "berhasil menghapus satu siswa";
 		header('location:../upload/repsis/');

	}else{

		$_SESSION['panduan'] = "gagal menghapus satu siswa";
 		header('location:../upload/repsis/');
	}	

// }

?>