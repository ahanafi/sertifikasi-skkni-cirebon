<?php
//Automatically indexing
$cars = array("Honda", "Toyota", "Tamiya");
$total_cars = count($cars); //To count elments of array

for ($i=0; $i < $total_cars; $i++) { 
	echo "Cars $i is " . $cars[$i] . "<br>";
}