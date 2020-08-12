<?php $arr = range(0, 2000); ?>
<form method="post">
	<input type="text" name="x">
	<input type="submit" name="cc" value="cari">
</form>

<?php 
print_r($arr);
function bs($fe,$x){

	$hi = count($fe)-1;
	$li = 0;

	while ($li <= $hi) {
		$mi = (int)floor(($li+$hi)/2);

		
		if ($fe[$mi]<$x) {

			$li = $mi+1;
		}elseif ($fe[$mi]>$x) {

			$hi = $mi-1;
		}else{

			return $mi;
		}
	}

	return -1;


}


if (isset($_POST['cc'])) {

	$hint = $_POST['x'];

	$result = bs($arr,$hint);
	if ($result == -1) 
    	print("Element not present"); 
	else
   		print("Element found at index " .  $result); 

}

?>