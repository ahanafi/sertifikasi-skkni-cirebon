<?php
//Insertion Sort Algoritm
$arr = [70, 80, 30, 10, 20];

$total_arr = count($arr);
$x = 0;
$j = 0;
echo "<b>ASCENDING</b><br>";
for ($i=1; $i < $total_arr; $i++) { 
	$x = $arr[$i];
	$j = $i - 1;

	while ($x < $arr[$j]) {
		$arr[$j+1] = $arr[$j];
		$j--;
	}
	$arr[$j+1] = $x;
}

print_r($arr);

echo "<br><br>";

echo "<b>DESCENDING</b><br>";
$arr = [3,7,1,26,43,12,6,21,23,73];
$total_arr = count($arr);
$val = 0;
$j = 0;
for ($i=0; $i < $total_arr; $i++) { 
	$val = $arr[$i];
	$j = $i-1;

	while ($arr[$j] > $val) {
		$arr[$j+1] = $arr[$j];
		$j--;
	}
	$arr[$j+1] = $val;
}

print_r($arr);
