<?php
//Method to show the javascript alert and redirect with JS
function alert($text, $location = NULL){
	$alert = "<script type='text/javascript'>alert('$text');";

	//when the 2nd parameter not NULL
	if($location != NULL) {
		if($location == "back") {
			$alert .= "window.history.back();";
		} else {
			$alert .= "window.location='$location';";
		}
	}
	$alert .= "</script>";
	echo $alert;
}

//Method to escape the string
function testInput($data) {
	$text = htmlspecialchars(stripslashes(trim($data)));
	return $text;
}

//Method get input value
function getPost($key) {
	return $_POST[$key];
}

//Method to get from url
function getFrom($index) {
	$get = isset($_GET[$index]) ? $_GET[$index] : "";
	return $get;
}
