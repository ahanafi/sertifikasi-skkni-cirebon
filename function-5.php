<?php
function Average($x, $y) {
	$x = ($x + $y) / 2;
	return $x;
}

echo "Rata-rata 5 dan 10 adalah " . Average(5, 10) . "<br>";
echo "Rata-rata 7 dan 13 adalah " . Average(7, 13) . "<br>";
echo "Rata-rata 2 dan 4 adalah " . Average(2, 4) . "<br>";