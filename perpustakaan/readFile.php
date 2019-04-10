<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library App</title>
</head>
<link rel="stylesheet" href="style.css">
<style>
	table, tr, td, th{
		border:0px !important;
	}
	.inp-txt{
		padding: 5px 10px;
		width: 320px;
	}
	.inp-btn{
		padding: 5px 10px !important;
		background: #23556B;
		color: #fff !important;
		font-size: 12px;
		border:1px solid #23556b;
		text-transform: uppercase;
	}
	.inp-btn:hover{
		cursor: pointer;
	}
	.txt-err{
		color: red;
		font-size: 11px;
		font-style: italic;
	}
	.target-text{
		width: 700px;
		border:1px solid #000;
		margin:0 auto;
		padding: 10px;
	}
</style>
<body>
	<h1>- Library App -</h1>
	<p class="center">
		<a href="addBookToFile.php" class="inp-btn">
			Add Book Data
		</a>
		<hr>
	</p>
	<p class="target-text">
		<?php
			$bookFile = fopen("books.txt", "r") or die("Unable to read file");
			while (!feof($bookFile)) {
				echo fgets($bookFile) . "<br>";	
			}
			fclose($bookFile);
		?>
	</p>
</body>
</html>