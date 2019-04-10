<?php
require_once 'config.php';
//Query for displaying data from table
$sql = "SELECT id_pinjam, anggota.nama as nama_anggota, tb_buku.judul as judul_buku, tanggal_pinjam, status FROM peminjaman JOIN anggota ON anggota.id_anggota = peminjaman.id_anggota JOIN tb_buku ON tb_buku.id_buku = peminjaman.id_buku";
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
		List All Data
	</h3>
	<table cellpadding="5">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name of Member</th>
				<th>Title of Book</th>
				<th>Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(mysqli_num_rows($query) > 0):
					while($data = mysqli_fetch_object($query)): ?>
						<tr>
							<td class="center"><?= $data->id_pinjam; ?></td>
							<td><?= $data->nama_anggota; ?></td>
							<td><?= $data->judul_buku ?></td>
							<td><?= $data->tanggal_pinjam; ?></td>
							<td><?= ucwords($data->status); ?></td>
							<td class="center">
								<a onclick="return askFirst()" href="deleteMember.php?memberID=<?= $data->id_peminjaman; ?>" class="btn">Delete</a> 
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