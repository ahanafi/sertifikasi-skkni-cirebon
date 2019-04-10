<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FLowchart</title>
</head>
<style>
	input{
		padding:10px;
	}
</style>
<body>
	<p>
		Diketahui nilai : <br>
		<b>Fact = 1</b>, 
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
	$fact = 1;

	echo "<br>";
	echo "Nilai N = " . $n;
	echo "<h2>HASIL : </h2>";

	//Menggunakann WHILE
	echo "<b>1) Menggunakan WHILE</b>";
	while ($n > 1) {
		$fact *= $n;
		$n -=1 ;
	}
	echo "<br>";
	echo "Hasilnya adalah <b>Fact</b> = " . $fact . "<br>";
	echo "========================================";
	echo "<br><br>";

	//Reseting value
	$fact = 1;
	$n = $_POST['nilai_n'];

	//Menggunakann DO - WHILE
	echo "<b>2) Menggunakan DO - WHILE</b>";
	do {
		$fact *= $n;
		$n -= 1;
	} while ($n > 1);

	echo "<br>";
	echo "Hasilnya adalah <b>Fact</b> = " . $fact . "<br>";
	echo "========================================";
	echo "<br><br>";

	//Reseting value
	$fact = 1;
	$n = $_POST['nilai_n'];

	//Menggunakann FOR
	echo "<b>3) Menggunakan FOR</b>";
	for ($i = $n; $i > 1; $i--) { 
		$fact *= $i;
	}

	echo "<br>";
	echo "Hasilnya adalah <b>Fact</b> = " . $fact . "<br>";
	echo "========================================";
	echo "<br><br>";
}
?>