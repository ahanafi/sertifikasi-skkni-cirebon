<?php
$t = date("H");

if ($t < "11") {
	echo "Good Morning!";
} elseif($t < "18") {
	echo "Good Evening";
} else {
	echo "Good Night";
}