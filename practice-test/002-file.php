<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Read File</title>
</head>
<style>
	a{
		text-decoration: none;
	}
	.btn{
		padding: 6px 10px;
		background: #A8A8A8;
		border:1px solid #333;
		color: #000;
	}
</style>
<body>
	<h1>Read File</h1>
	<hr>
	<p class="target-text">
		<?php
			$myFile = fopen("file_new.txt", "r") or die("Unable to read file");
			while (!feof($myFile)) {
				echo fgets($myFile) . "<br>";	
			}
			fclose($myFile);
		?>
	</p>
	<a href="001-buble-sort.php" class="btn">Input number</a>
</body>
</html>