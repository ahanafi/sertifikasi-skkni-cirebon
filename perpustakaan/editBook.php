<?php
require_once 'config.php';

$bookID = $_GET['bookID'];
if (empty($bookID) || $bookID == 0) {
	header("Location: index.php");
}

$sql = "SELECT * FROM tb_buku WHERE id_buku = '$bookID'";
$query = mysqli_query($connection, $sql);
$book = mysqli_fetch_object($query);
if(!$book) {
	header("Location: index.php");
}

$errTitle = $errAuthor = $errPublisher = $errCategory = $errYear = "";

if (isset($_POST['update'])) {
	$title 		= $_POST['title'];
	$author		= $_POST['author'];
	$publisher	= $_POST['publisher'];
	$category	= $_POST['category'];
	$year		= $_POST['year'];

	//Validate title
	if(empty(trim($title))) {
		$errTitle = "Title is required!";
	} else {
		$title = testInput($title);
		if(!preg_match("/^[a-zA-Z0-9]*$/", $title)) {
			$errTitle = "Only letters and space allowed";
		}
	}

	//Validate author
	if(empty(trim($author))) {
		$errAuthor = "Author is required!";
	} else {
		$author = testInput($author);
		if(!preg_match("/^[a-zA-Z]*$/", $author)) {
			$errAuthor = "Only letters and space allowed";
		}
	}

	//Validate publisher
	if(empty(trim($publisher))) {
		$errPublisher = "Publisher is required!";
	} else {
		$publisher = testInput($publisher);
		if(!preg_match("/^[a-zA-Z]*$/", $publisher)) {
			$errPublisher = "Only letters and space allowed";
		}
	}

	//Validate year
	if(empty(trim($year))) {
		$erryear = "Year is required!";
	} else {
		$year = testInput($year);
		if(!preg_match("/^[0-9]*$/", $year)) {
			$erryear = "Only numbers allowed";
		}
	}

	//Validate category
	if(empty(trim($category))) {
		$errCategory = "Category is required!";
	} else {
		$category = testInput($category);
		if(!preg_match("/^[a-zA-Z]*$/", $category)) {
			$errCategory = "Only letters and space allowed";
		}
	}

	if(!empty(trim($title)) && !empty(trim($author)) && !empty(trim($publisher)) && !empty(trim($category)) && !empty(trim($year))) {
		$sql = "UPDATE tb_buku SET judul = '$title', pengarang = '$author', penerbit = '$publisher', kategori = '$category', tahun = '$year' WHERE id_buku = '$bookID'";
		$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));

		if($query) {
			echo "<script type='text/javascript'>
					alert('The book data was successfully updated!');
					window.location='index.php';
				</script>";
		} else {
			echo "<script type='text/javascript'>alert('Failed to update the book data!')</script>";
		}
	}/* else {
		echo "<script type='text/javascript'>alert('Form tidak boleh ada yang kosong!')</script>";
	}*/
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library App</title>
</head>
<link rel="stylesheet" href="style.css">
<style>
	table, tr, td, th{
		
	}
	.inp-txt{
		padding: 5px 10px;
		width: 320px;
	}
	.inp-btn{
		padding: 5px 10px !important;
		background: #23556B;
		color: #fff !important;
		font-size: 12px;
		border:1px solid #23556b;
		text-transform: uppercase;
	}
	.inp-btn:hover{
		cursor: pointer;
	}
	.txt-err{
		color: red;
		font-size: 11px;
		font-style: italic;
	}
</style>
<body>
	<h1>- Library App -</h1>
	<p class="center">
		Add New Books
		<hr>
	</p>
	<form action="editBook.php?bookID=<?= $bookID; ?>" method="POST">
		<table style="width: 600px !important;margin:0 auto;" cellpadding="5">
			<tr>
				<td>Title</td>
				<td>:</td>
				<td><input type="text" name="title" class="inp-txt" required value="<?= $book->judul; ?>"></td>
				<td class="txt-err"><?= $errTitle; ?></td>
			</tr>
			<tr>
				<td>Author</td>
				<td>:</td>
				<td><input type="text" name="author" class="inp-txt" required value="<?= $book->pengarang ?>"></td>
				<td class="txt-err"><?= $errAuthor; ?></td>
			</tr>
			<tr>
				<td>Publisher</td>
				<td>:</td>
				<td><input type="text" name="publisher" class="inp-txt" required value="<?= $book->penerbit ?>"></td>
				<td class="txt-err"><?= $errPublisher; ?></td>
			</tr>
			<tr>
				<td>Category</td>
				<td>:</td>
				<td><input type="text" name="category" class="inp-txt" required value="<?= $book->kategori ?>"></td>
				<td class="txt-err"><?= $errCategory; ?></td>
			</tr>
			<tr>
				<td>Year</td>
				<td>:</td>
				<td><input type="number" maxlength="4" minlength="4" name="year" class="inp-txt" required value="<?= $book->tahun ?>"></td>
				<td class="txt-err"><?= $errYear; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button type="submit" name="update" class="inp-btn">Update</button>
					<button type="button" onclick="window.location='index.php';" name="back" class="inp-btn">List Book</button>
				</td>
				<td></td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
		let input = document.getElementsByTagName('input');
		for (var i = 0; i < input.length; i++) {
			input[i].setAttribute('autocomplete', 'off');
		}
	</script>
</body>
</html>