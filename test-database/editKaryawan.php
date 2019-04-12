<?php
//Call the init file
require_once 'core/_init.php';

//if in the url have id and value is not 0
if (isset($_GET['id']) && $_GET['id'] != 0) {
	$id = getFrom('id');

	//QUery to select the data with the id
	$karyawan = select("*", "karyawan", "id = $id");

	//Show the result from query
	$ky = result($karyawan);
} else {
	header("Location: index.php");
}

//When user click the submit button
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
	$errNomorInduk = $errNamaLengkap = $errJK = $errTelpon = $errAlamat = "";

	//Store data from input to variable
	$nomor_induk = getPost('nomor_induk');
	$nama_lengkap = getPost('nama_lengkap');
	$jk = getPost('jk');
	$telpon = getPost('telpon');
	$alamat = getPost('alamat');

	//Validasi nomor_induk
	if(empty(trim($nomor_induk))) {
		//Assign error massage
		$errNomorInduk = "Nomor Induk harus diisi!";
	} else {
		$nomor_induk = testInput($nomor_induk);

		//if the pattern is not match
		if(!preg_match("/^[0-9]*$/", $nomor_induk)) {
			$errNomorInduk = "Hanya angka yang diizinikan";
		}
	}

	//Validasi nama
	if(empty(trim($nama_lengkap))) {
		//Assign error massage to variable
		$errNamaLengkap = "Nama Lengkap harus diisi!";
	} else {
		//if the pattern is not match
		$nama_lengkap = testInput($nama_lengkap);
		if(!preg_match("/^[a-zA-Z\s]*$/", $nama_lengkap)) {
			$errNamaLengkap = "Hanya huruf dan spasi yang diizinikan";
		}
	}

	//Validasi jk
	if(empty(trim($jk))) {
		//Assign error massage
		$errJK = "Harap pilih salah satu!";
	} else {
		$jk = testInput($jk);
		//if the pattern is not match
		if(!preg_match("/^[A-Z]*$/", $jk)) {
			$errJK = "Hanya diizinikan memilih pilihan yang tersedia.";
		}
	}

	//Validasi telpon
	if(empty(trim($telpon))) {
		//Assign error massage
		$errTelpon = "Nomor Telpon harus diisi!";
	} else {
		$telpon = testInput($telpon);
		//if the pattern is not match
		if(!preg_match("/^[0-9]*$/", $telpon)) {
			$errTelpon = "Hanya angka yang diizinikan.";
		}
	}

	//Validasi alamat
	if(empty(trim($alamat))) {
		$errAlamat = "Alamat harus diisi!.";
	} else {
		$alamat = testInput($alamat);
		//if the pattern is not match
		if(!preg_match("/^[a-zA-Z0-9\s]*$/", $alamat)) {
			$errAlamat = "Hanya angka, huruf, dan spasi diizinikan.";
		}
	}

	//When the message error is empty
	if (empty(trim($errNomorInduk)) && empty(trim($errNamaLengkap)) && empty(trim($errJK)) && empty(trim($errTelpon)) && empty(trim($errAlamat))) {
		$id = getFrom('id');

		//QUery to update the data
		$update = update("karyawan", "nomor_induk = '$nomor_induk', nama_lengkap = '$nama_lengkap', jk = '$jk', telpon = '$telpon', alamat = '$alamat'", $id);

		//When successfull update data
		if($update) {
			//Show alert and redirect to home
			alert("Data karyawan berhasil diperbarui!", "index.php");
		} else {
			//Show alert and redirect back
			alert("Data karyawan gagal diperbarui!", "back");
		}
	}

}
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
				<h3 class="panel-title">Form Tambah Karyawan</h3>
			</div>
			<div class="panel-body">
				<form action="editKaryawan.php?id=<?= $ky->id ?>" method="POST">

					<div class="row form-group">
						<label class="col-md-2 col-md-offset-1">Nomor Induk</label>
						<div class="col-md-6">
							<input type="text" name="nomor_induk" class="form-control" required value="<?php echo $ky->nomor_induk; ?>">
						</div>
						<div class="col-md-3"><p class="text-danger"><?php echo $errNomorInduk; ?></p></div>
					</div>

					<div class="row form-group">
						<label class="col-md-2 col-md-offset-1">Nama Lengkap</label>
						<div class="col-md-6">
							<input type="text" name="nama_lengkap" class="form-control" required value="<?php echo $ky->nama_lengkap ?>">
						</div>
						<div class="col-md-3"><p class="text-danger"><?php echo $errNamaLengkap; ?></p></div>
					</div>

					<div class="row form-group">
						<label class="col-md-2 col-md-offset-1">Jenis Kelamin</label>
						<div class="col-md-6">
							<select name="jk" class="form-control" required>
								<option value="">-- Pilih Jenis Kelamin --</option>
								<?php if($ky->jk == "L"): ?>
									<option value="L" selected>Laki-Laki</option>
									<option value="P">Perempuan</option>
								<?php else: ?>
									<option value="L">Laki-Laki</option>
									<option value="P" selected>Perempuan</option>
								<?php endif; ?>
							</select>
						</div>
						<div class="col-md-3"><p class="text-danger"><?php echo $errJK; ?></p></div>
					</div>

					<div class="row form-group">
						<label class="col-md-2 col-md-offset-1">Nomor Telpon</label>
						<div class="col-md-6">
							<input type="text" name="telpon" class="form-control" required value="<?php echo $ky->telpon ?>">
						</div>
						<div class="col-md-3"><p class="text-danger"><?php echo $errTelpon; ?></p></div>
					</div>

					<div class="row form-group">
						<label class="col-md-2 col-md-offset-1">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" rows="3" style="resize: none;" class="form-control" required><?php echo $ky->alamat; ?></textarea>
						</div>
						<div class="col-md-3"><p class="text-danger"><?php echo $errAlamat; ?></p></div>
					</div>

					<div class="row form-group">
						<label class="col-md-3"></label>
						<div class="col-md-3">
							<input type="submit" value="Simpan" class="btn btn-primary btn-block" name="submit">
						</div>
						<div class="col-md-3">
							<a href="index.php" class="btn btn-default btn-block">Daftar Karyawan</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
</html>