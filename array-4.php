<?php
$cars = array("Honda", "Toyota", "Tamiya");
$numbers = array(4, 6, 2, 22, 11);

sort($cars);
sort($numbers);

echo "1) Menggunakan <b>SORT</b> <br>";
print_r($cars); 
echo "<br>";
print_r($numbers);
echo "<br><br>";

rsort($cars);
rsort($numbers);

echo "2) Menggunakan <b>RSORT</b> <br>";
print_r($cars);
echo "<br>";
print_r($numbers);
echo "<br><br>";


$ages = array(
	"Petruk" => 35,
	"Bagong" => 37,
	"Jiwo"	 => 43
);