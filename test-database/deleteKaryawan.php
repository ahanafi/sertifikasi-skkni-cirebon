<?php
//Call the init file
require_once 'core/_init.php';

//Get id from URL
$id = getFrom('id');

//When id in url is not empty and not 0
if (!empty(trim($id)) && $id != 0) {
	//Query to delete the data with id
	$delete = delete("karyawan", $id);
	
	//When data was deleted
	if($delete) {
		//Show alert and redirect to home
		alert("Data karyawan berhasil dihapus!", "index.php");
	} else {
		//Show alert and redirect back
		alert("Data karyawan gagal dihapus!", "back");
	}
} else {
	//Redirect to home when id is empty or id is equals to 0
	header("Location: index.php");
}