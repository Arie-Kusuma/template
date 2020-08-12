<!DOCTYPE html>
<html>
<head>
	<title>coba</title>
</head>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<style type="text/css">
	
	div{
		width: 200px;
		height: 200px;
		background-color: cyan;
		margin: 10px;
	}
</style>
<body>

	<button id="asd">coba</button>
	<?php
	// require_once('update.php');
	$data = array("satu","dua","asd","awe","qwttt","ghj","12fd"); 

	// $rt = $_SESSION['data'];

	// print_r($rt);
	for ($i=0; $i <count($data) ; $i++) { 

	?>

	<div>
		<?php echo $data[$i];?>
		<form method="post">
			<input type="text" value="<?php echo "jawaban".$i; ?>" id=<?php echo "jawaban".$i; ?>  name=<?php echo "jawaban".$i; ?> >
		</form>			
	</div>


<?php } ?>

<script type="text/javascript">
	let datas = [];
	let pnjng = <?php echo count($data); ?>;
	$(document).ready(function(){

		function take(){
			for (var i = 0; i < pnjng; i++) {
				let ket = "#jawaban"+i;
				datas[i] = $(ket).val();
			}
		}

		function update(){

			var jdata = "data ini";
			$.ajax({
				data: { data:jdata },
				url: "update.php",
				type:"post",
				dataType: 'text',
				success: function(aku){
					console.log(aku);

				}

			});


		}

	    setInterval(function(){
	    	take();
			// console.log(datas);
	    }, 1000);

		$('#asd').click(function(){
	    	update();
			// console.log(datas);
		})


	})
</script>
<?php require_once('update.php') ?>
</body>
</html>