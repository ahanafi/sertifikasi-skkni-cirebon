<?php
$nilai_akhir = 100;
$nilai_huruf = "";
$ket = "";

switch ($nilai_akhir) {
	case ($nilai_akhir >= 80):
		$nilai_huruf = "A";
		$ket = "Nilai Anda Luar Biasa";
		break;

	case ($nilai_akhir >= 75 && $nilai_akhir < 80):
		$nilai_huruf = "B+";
		$ket = "Nilai Anda Sangat Baik";
		break;

	case ($nilai_akhir >= 70 && $nilai_akhir < 75):
		$nilai_huruf = "B";
		$ket = "Nilai Anda Baik";
		break;

	case ($nilai_akhir >= 65 && $nilai_akhir < 70):
		$nilai_huruf = "C+";
		$ket = "Nilai Anda Sangat Cukup";
		break;

	case ($nilai_akhir >= 60 && $nilai_akhir < 65):
		$nilai_huruf = "C";
		$ket = "Nilai Anda Cukup";
		break;

	case ($nilai_akhir >= 55 && $nilai_akhir < 60):
		$nilai_huruf = "D";
		$ket = "Nilai Anda Kurang";
		break;
	
	default:
		$nilai_huruf = "E";
		$ket = "Anda harus mengulang";
		break;
}

echo "Nilai Akhir Anda adalah " . $nilai_akhir . "<br>";
echo "Nilai huruf Anda adalah " . $nilai_huruf . "<br>";
echo $ket;