<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library App</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
	<h1>- Library App -</h1>
	<?php
		require_once 'listMenu.php';
		require_once 'config.php';
		//Query for displaying data from table
		$sql = "SELECT * FROM tb_buku";
		$query = mysqli_query($connection, $sql);
	?>
	<h3 class="center">
		List All Books
	</h3>
	<table cellpadding="5">
		<thead>
			<tr>
				<th>Book ID</th>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Category</th>
				<th>Year</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while($book = mysqli_fetch_object($query)): ?>
				<tr>
					<td class="center"><?= $book->id_buku; ?></td>
					<td><?= $book->judul; ?></td>
					<td><?= $book->pengarang; ?></td>
					<td><?= $book->penerbit; ?></td>
					<td><?= $book->kategori; ?></td>
					<td class="center"><?= $book->tahun; ?></td>
					<td class="center">
						<a href="editBook.php?bookID=<?= $book->id_buku; ?>" class="btn">Edit</a>
						<a onclick="return askFirst()" href="deleteBook.php?bookID=<?= $book->id_buku; ?>" class="btn">Delete</a> 
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
	<script type="text/javascript">
		function askFirst() {
			let ask = confirm("Are you sure want to delete this ?");
			if(ask == true) {
				return true;
			} else {
				return false;
			}
		}
	</script>
</body>
</html>