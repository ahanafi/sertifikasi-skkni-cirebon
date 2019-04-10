<?php
require_once 'config.php';
$bookID = $_GET['bookID'];

$sql = "DELETE FROM tb_buku WHERE id_buku = '$bookID'";
$query = mysqli_query($connection, $sql);

if($query) {
	echo "<script type='text/javascript'>
			alert('Book was successfully deleted!');
			window.location='index.php';
		</script>";
} else {
	echo "<script type='text/javascript'>
			alert('Failed to delete data!');
			window.location='index.php';
		</script>";
}