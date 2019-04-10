<?php
require_once 'config.php';
$memberID = $_GET['memberID'];

$sql = "DELETE FROM anggota WHERE id_anggota = '$memberID'";
$query = mysqli_query($connection, $sql);

if($query) {
	echo "<script type='text/javascript'>
			alert('Member was successfully deleted!');
			window.location='members.php';
		</script>";
} else {
	echo "<script type='text/javascript'>
			alert('Failed to delete data!');
			window.location='members.php';
		</script>";
}