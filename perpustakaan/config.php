<?php
$hostname = "localhost";
$username = "root";
$password = "password";
$database = "perpustakaan";

$connection = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_connect_error($connection));

session_start();
function testInput($data) {
	$text = htmlspecialchars(stripslashes(trim($data)));
	return $text;
}

?>