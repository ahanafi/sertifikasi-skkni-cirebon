<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Find Counted Number</title>
</head>
<style>
	input, button{
		padding: 10px;
	}
	input{
		min-width:300px;
	}
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
	<h3>Count Number</h3>
	<form action="001-find-number.php" method="POST">
		<label for="number">Number</label>
		<input type="number" name="number" placeholder="Put number here..." required>
		<button type="submit" name="count">Proccess</button>
		<a href="002-readfile.php" class="btn">Read File</a>
	</form>
	<hr>
	<?php
		//WHen user  clikc submit button
		if (isset($_POST['count']) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$number = $_POST['number'];

			//Count length of the string
			$number_length = strlen($number);

			echo "The number is : <b>" . $number . "</b><br>";
			echo "<h3>Resulst</h3>";
			
			//Variabel array
			$numbers = [];

			//Convert string to array
			for ($i=0; $i < $number_length; $i++) {
				//Put number to variable numbers
				$numbers[$i] = $number[$i];
			}

			//Variable helper
			$x = $j = "";

			//Sort data array ascending
			for ($i=0; $i < $number_length; $i++) { 
				$x = $numbers[$i];
				$j = $i - 1;

				while ($x < $numbers[$j]) {
					$numbers[$j+1] = $numbers[$j];
					$j--;
				}
				$numbers[$j+1] = $x;
			}
			
			$count = 0;

			if (!file_exists("file_numbers.txt")) {
				$fileNumber = fopen("file_numbers.txt", "w") or die("Unable to write file");
			} else {
				$fileNumber = fopen("file_numbers.txt", "a") or die("Unable to read file");
			}

			echo "Number    : Total Number <br>";
			//To count the many of number
			for ($i=0; $i < $number_length; $i++) { 
				$count = 0;
				for ($x=0; $x < $number_length; $x++) { 
					if($numbers[$i] == $numbers[$x]) {
						$count = $count + 1;
					}
				}

				//To catch show duplicate in same number
				if($numbers[$i] != $numbers[$i-1]) {
					echo $numbers[$i] . " : " . $count . "<br>";
					fwrite($fileNumber, $numbers[$i] . " : " . $count."\n");
				}
			}
			fwrite($fileNumber, "===================================\n");
			fclose($fileNumber);
		}


		?>
</body>
</html>
