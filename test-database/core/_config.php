<?php
//make variable to store credential connection in database
$hostname = "localhost";
$username = "root";
$password = "password";
$database = "skkni_test";

//Connecting to database
// if not connected, will die and show the error
$link = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_connect_error($link));
?>