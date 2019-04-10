<?php
require_once 'config.php';
$errMember = $errBook = $errDate = "";

if (isset($_GET['search']) && isset($_GET['keyword']) && isset($_GET['type'])) {
	$keyword = addslashes($_GET['keyword']);
	$type = addslashes($_GET['type']);
		
	if (!empty(trim($keyword)) && !empty(trim($type))) {
		$where = $table = "";
		if($type == "member") {
			$where = "nama LIKE '%$keyword%'";
			$table = "anggota";
		} elseif ($type == "book") {
			$table = "tb_buku";
			$where = "judul LIKE '%$keyword%'";
		}

		$sqlSearch = "SELECT * FROM $table WHERE $where";
		$querySearch = mysqli_query($connection, $sqlSearch);
	}
}

//To proccess choosen data
if (isset($_GET['ID']) && isset($_GET['type'])) {
	$ID = $_GET['ID'];
	$type_data = $_GET['type'];
	if (!empty(trim($ID)) && !empty(trim($type_data))) {
		if($type_data  == "member") {
			$sqlMember = "SELECT * FROM anggota WHERE id_anggota = '$ID'";
			$queryMember = mysqli_query($connection, $sqlMember);
			$dataMember = mysqli_fetch_object($queryMember);
			$_SESSION['MEMBER_ID'] = $dataMember->id_anggota;
			$_SESSION['MEMBER_NAME'] = $dataMember->nama;
		} else {
			$sqlBook = "SELECT * FROM tb_buku WHERE id_buku = '$ID'";
			$queryBook = mysqli_query($connection, $sqlBook);
			$dataBook = mysqli_fetch_object($queryBook);
			$_SESSION['BOOK_ID'] = $dataBook->id_buku;
			$_SESSION['BOOK_TITLE'] = $dataBook->judul;
		}
	}
}

if (isset($_POST['insert'])) {
	$member_id = $_POST['member_id'];
	$book_id = $_POST['book_id'];
	$date    = $_POST['date'];
	$status = "pinjam";

	if (!empty(trim($member_id)) && !empty(trim($book_id)) && !empty(trim($date))) {
		$sql = "INSERT INTO peminjaman (id_buku, id_anggota, tanggal_pinjam, status) VALUES ('$book_id', '$member_id', '$date', '$status')";
		$query = mysqli_query($connection, $sql);

		if($query) {
			echo "<script>
					alert('Data was successfully inserted!');
					window.location='borrowsData.php';
				</script>";
			session_destroy();
		} else {
			echo "<script>
					alert('Failed to add new data!');
				</script>";
			session_destroy();
		}

	} else {
		if(empty(trim($member_id))) {
			$errMember = "Please choose one of the member!";
		}

		if(empty(trim($book_id))) {
			$errBook = "Please choose one of the book!";
		}

		if(empty(trim($date))) {
			$errDate = "Plase select date first!";
		} else {
			if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				$errDate = "Date format doesn't match!";
			}
		}

	}
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
	form table, form > table tr td, form > table  th{
		border:0px !important;
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
	.search{
		margin: 0 auto;
		width: 600px;
		margin-bottom:20px;
		border: 1px solid #333;
		padding:10px;
	}

	.search input{
		padding:5px;
		width: 200px;
	}
	.search select{
		padding: 5px;
		width: 100px;
	}
	.btn-search{
		padding: 5px 15px !important;
		background: #2E4EED !important;
		color: #fff;
		border:1px solid #eee;
	}
	.btn-search:hover{
		background: #627AF0 !important;
		cursor: pointer;
	}
</style>
<body>
	<h1>- Library App -</h1>
	<p class="center">
		Add Data
		<hr>
	</p>
	<form action="addBorrowData.php" class="search">
		<label for="label">Search <b>Member</b> or <b>Book</b></label> : 
		<input type="text" name="keyword" class="inp-txt" placeholder="Type keyword here...">
		<select name="type" class="inp-txt">
			<option value="member">Member</option>
			<option value="book">Book</option>
		</select>
		<button type="submit" name="search" class="btn-search">Serch</button>
		<?php if (isset($_GET['search']) && isset($_GET['keyword']) && isset($_GET['type'])): ?>
			<fieldset>
				<legend>Results :</legend>
				<table border="1" cellpadding="3">
					<thead>
						<tr>
							<th>ID</th>
							<th>Member Name / Book Title</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(mysqli_num_rows($querySearch) > 0):
								while($results = mysqli_fetch_object($querySearch)): ?>
									<tr>
										<td class="center"><?= ($_GET['type'] == "member") ? $results->id_anggota : $results->id_buku;?></td>
										<td><?= ($_GET['type'] == "member") ? $results->nama : $results->judul;?></td>
										<td class="center">
											<a
												href="addBorrowData.php?ID=<?= ($_GET['type'] == "member") ? $results->id_anggota : $results->id_buku;?>&type=<?= $type ?>"
												class="link"
											>Choose</a>
										</td>
									</tr>
						<?php	endwhile;
							else:
						?>
							<tr>
								<td class="center" colspan="3">
									Not Found.
								</td>
							</tr>
						<?php
							endif;
						?>
					</tbody>
				</table>
			</fieldset>
		<?php endif ?>
	</form>

<form action="addBorrowData.php" method="POST">
	<table style="width: 600px !important;margin:0 auto;" cellpadding="5">
		<tr>
			<td>Name of Member</td>
			<td>:</td>
			<td>
				<input type="text" name="member" class="inp-txt" required readonly value="<?php echo (isset($_SESSION['MEMBER_NAME'])) ? $_SESSION['MEMBER_NAME'] : ""; ?>">
				<input type="hidden" name="member_id" value="<?php echo (isset($_SESSION['MEMBER_ID'])) ? $_SESSION['MEMBER_ID'] : ""; ?>">
			</td>
			<td class="txt-err"><?= $errMember; ?></td>
		</tr>
		<tr>
			<td>Title of Book</td>
			<td>:</td>
			<td>
				<input type="text" name="book" class="inp-txt" required readonly value="<?php echo (isset($_SESSION['BOOK_TITLE'])) ? $_SESSION['BOOK_TITLE'] : ""; ?>">
				<input type="hidden" name="book_id" value="<?php echo (isset($_SESSION['BOOK_ID'])) ? $_SESSION['BOOK_ID'] : ""; ?>">
			</td>
			<td class="txt-err"><?= $errBook; ?></td>
		</tr>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td><input type="date" name="date" class="inp-txt" required value="<?php echo date('Y-m-d') ?>"></td>
			<td class="txt-err"><?= $errDate; ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<button type="submit" name="insert" class="inp-btn">Insert</button>
				<button type="button" onclick="window.location='borrowsData.php';" name="back" class="inp-btn">List Data</button>
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