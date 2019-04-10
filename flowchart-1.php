<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FLowchart</title>
</head>
<body>
	<p>
		DIketahui nilai : <br>
		<b>m = 1</b>, 
		<b>f = 1</b>
	</p>
	<form action="" method="POST">
		<label>N = </label>
		<input type="number" name="nilai_n" placeholder="Masukkan nilai N">	
		<input type="submit" name="calc" value="Hitung">
	</form>
</body>
</html>
<?php
if (isset($_POST['calc'])) {
	$n = $_POST['nilai_n'];

	$m = 1;
	$f = 1;

	$f = $f * $m;

	$index = 1;
	while ($m != $n) {
		$m += 1; 	// m = m + 1
		$f *= $m; 	// f = f * m

		$index++;
	}

	echo $f;

	/*if($m == $n) {
		echo $f;
	} else {
		$m = $m + 1;
		$f = $f * $m;
		echo $f;
	}*/
	echo "<br>";
	echo "Hasilnya adalah " . $f;
}
?>