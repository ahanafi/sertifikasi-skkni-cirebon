<?php
require_once 'core/_init.php';
$karyawan = select('*', "karyawan");

//when user submit search form
if (isset($_GET['search']) && isset($_GET['keyword']) && isset($_GET['search_by'])) {

	//Store data search to variable
	$search_by = getFrom('search_by'); // $_GET[]
	$keyword   = getFrom('keyword');

	//when data in url not empty (have a value or character)
	if(!empty(trim($search_by)) && !empty(trim($keyword))) {
		//make empty variable to store condition
		$where = "";

		//when user want to search by name
		if($search_by == "nama") {
			$where = "nama_lengkap LIKE '%$keyword%'";

		//when user want to search by nomor_induk
		} else {
			$where = "nomor_induk LIKE '%$keyword%'";
		}

		//Query searching
		$karyawan = select("*", "karyawan", $where);
	}
}

$no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test Database Program</title>
</head>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<body>
	<?php
		require_once 'templates/_menu.php';
	?>
	<div id="content" class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				Form Pencarian
			</div>
			<div class="panel-body">
				<form action="index.php" method="GET">
					<div class="row">
						<div class="col-md-5">
							<input type="text" name="keyword" class="form-control" placeholder="Masukan kata kunci">
						</div>
						<div class="col-md-2" style="margin-top: 5px;">
							Cari berdasarkan :
						</div>
						<div class="col-md-3">
							<select name="search_by" class="form-control">
								<option value="nama">Nama Karyawan</option>
								<option value="nomor-induk">Nomor Induk</option>
							</select>
						</div>
						<div class="col-md-2">
							<button type="submit" name="search" class="btn btn-primary btn-block">
								Cari sekarang!
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Daftar Karyawan</h3>
			</div>
			<div class="panel-body">
				<table class="table table-responsive table-border">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nomor Induk</th>
							<th>Nama Karyawan</th>
							<th>Jenis Kelamin</th>
							<th>Telpon</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//Check if data is exists in table
							if(cekRow($karyawan) > 0):
						?>
							<?php
								//Loop the data from table
								while($k = result($karyawan)): ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $k->nomor_induk; ?></td>
									<td><?php echo $k->nama_lengkap; ?></td>
									<td><?php echo ($k->jk == "L") ? "Laki-laki" : "Perempuan"; ?></td>
									<td><?php echo $k->telpon; ?></td>
									<td><?php echo $k->alamat; ?></td>
									<td>
										<a href="editKaryawan.php?id=<?= $k->id; ?>" class="btn btn-success">
											Edit
										</a>
										<a onclick="return askFirst()" href="deleteKaryawan.php?id=<?= $k->id; ?>" class="btn btn-danger">
											Hapus
										</a>
									</td>
								</tr>
							<?php endwhile; ?>
						<?php else: ?>
							<tr>
								<td colspan="7" style="text-align: center;font-weight: bold;font-style: italic;">
									Tidak ada data.
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function askFirst() {
			let ask = confirm("Are you sure want to delete this data ?");
			if(ask == true) {
				return true;
			} else {
				return false;
			}
		}
	</script>
</body>
</html>