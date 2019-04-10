<?php
require_once 'config.php';
//Query for displaying data from table
$sql = "SELECT * FROM anggota";

if (isset($_GET['search']) && isset($_GET['keyword']) && isset($_GET['by'])) {
	$keyword = $_GET['keyword'];
	$by      = $_GET['by'];

	if($keyword != "" && $by != "") {
		$where = "";
		if($by == "name") {
			$where = "nama LIKE '%$keyword%'";
		} else {
			$where = "id_anggota = $keyword";
		}

		$sql = "SELECT * FROM anggota WHERE $where";
	}
}

$query = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library App</title>
</head>
<link rel="stylesheet" href="style.css">
<style>
	.search{
		margin: 0 auto;
		width: 700px;
		margin-bottom:10px;
	}

	.search input, .search select{
		padding:5px;
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
	<?php require_once 'listMenu.php'; ?>
	<h3 class="center">
		List All Members
	</h3>
	<form action="members.php" class="center search">
		<label for="label">Search</label> : 
		<input type="text" name="keyword" class="inp-txt">
		<select name="by" class="inp-txt">
			<option value="name">by Name</option>
			<option value="id">by Member ID</option>
		</select>
		<button type="submit" name="search" class="btn-search">Serch</button>
	</form>
	<table cellpadding="5">
		<thead>
			<tr>
				<th>Member ID</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Phone Number</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(mysqli_num_rows($query) > 0):
					while($member = mysqli_fetch_object($query)): ?>
						<tr>
							<td class="center"><?= $member->id_anggota; ?></td>
							<td><?= $member->nama; ?></td>
							<td><?= ($member->jk == "L") ? "Laki-laki" : "Perempuan"; ?></td>
							<td><?= $member->telpon; ?></td>
							<td><?= $member->alamat; ?></td>
							<td class="center">
								<a href="editMember.php?memberID=<?= $member->id_anggota; ?>" class="btn">Edit</a>
								<a onclick="return askFirst()" href="deleteMember.php?memberID=<?= $member->id_anggota; ?>" class="btn">Delete</a> 
							</td>
						</tr>
			<?php	endwhile;
				else: ?>
					<tr>
						<td class="center" colspan="6" style="color:red;font-style: italic;">
							<b>Member Not Found.</b>
						</td>
					</tr>
			<?php endif; ?>
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