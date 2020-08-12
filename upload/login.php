<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form method="post">
		
		<input type="submit" name="masuk" value="masuk">
	</form>

	<?php 

	if (isset($_POST['masuk'])) {
		header('location:../upload');
	}

	?>
</body>
</html>