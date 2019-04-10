<?php
require_once 'config.php';

$errName = $errGender = $errPhoneNumber = $errAddress = "";

if (isset($_POST['insert'])) {
	$name 		= $_POST['name'];
	$gender		= $_POST['gender'];
	$phone	= $_POST['phone'];
	$address	= $_POST['address'];

	//Validate name
	if(empty(trim($name))) {
		$errName = "Name is required!";
	} else {
		$name = testInput($name);
		if(!preg_match("/^[a-zA-Z]*$/", $name)) {
			$errName = "Only letters and space allowed";
		}
	}

	//Validate gender
	if(empty(trim($gender))) {
		$errgender = "Gender is required!";
	} else {
		$gender = testInput($gender);
		if(!preg_match("/^[a-zA-Z]*$/", $gender)) {
			$errGender = "Please choose one option";
		}
	}

	//Validate phone
	if(empty(trim($phone))) {
		$errPhoneNumber = "Phone is required!";
	} else {
		$phone = testInput($phone);
		if(!preg_match("/^[0-9]*$/", $phone)) {
			$errPhoneNumber = "Only numbers allowed";
		}
	}

	//Validate address
	if(empty(trim($address))) {
		$errAddress = "Address is required!";
	} else {
		$address = testInput($address);
		if(!preg_match("/^[a-zA-Z0-9]*$/", $address)) {
			$errAddress = "Only letters and space allowed";
		}
	}

	if(!empty(trim($name)) && !empty(trim($gender)) && !empty(trim($phone)) && !empty(trim($address))) {
		$sql = "INSERT INTO anggota (nama, jk, telpon, alamat) VALUES ('$name', '$gender', '$phone', '$address')";
		$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));

		if($query) {
			echo "<script type='text/javascript'>
					alert('New member was successfully inserted!');
					window.location='members.php';
				</script>";
		} else {
			echo "<script type='text/javascript'>alert('Failed to add new member data!')</script>";
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
		border:0px !important;
	}
	.inp-txt{
		padding: 5px 10px;
		width: 320px;
	}
	select{
		width: 343px !important;
		background: #fff;
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
	<form action="addMember.php" method="POST">
		<table style="width: 600px !important;margin:0 auto;" cellpadding="5">
			<tr>
				<td>Name</td>
				<td>:</td>
				<td><input type="text" name="name" class="inp-txt" required></td>
				<td class="txt-err"><?= $errName; ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td>:</td>
				<td>
					<select name="gender" required class="inp-txt">
						<option>-- Choose one option --</option>
						<option value="L">Male</option>
						<option value="P">Female</option>
					</select>
				</td>
				<td class="txt-err"><?= $errGender; ?></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td>:</td>
				<td><input type="text" name="phone" class="inp-txt" required></td>
				<td class="txt-err"><?= $errPhoneNumber; ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td>:</td>
				<td>
					<textarea name="address" rows="3" style="width: 340px;resize: none;"></textarea>
				</td>
				<td class="txt-err"><?= $errAddress; ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button type="submit" name="insert" class="inp-btn">Insert</button>
					<button type="button" onclick="window.location='members.php';" name="back" class="inp-btn">List Member</button>
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