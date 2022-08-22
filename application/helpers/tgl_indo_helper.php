<?php

function bulan_tahun($date)
{

	$Bulan = array(
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	);

	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$result = $Bulan[(int)$bulan - 1] . " " . $tahun;
	return $result;
}

function tgl_default($date)
{
	$Bulan = array(
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	);

	// pemisahan tahun, bulan, hari, dan waktu
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl = substr($date, 8, 2);

	$result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;
	return $result;
}

function nama_hari($date)
{
	$Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$hari = date("w", strtotime($date));
	$result = $Hari[$hari];
	return $result;
}

function tgl_indo($date)
{

	// array hari dan bulan
	$Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$Bulan = array(
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	);

	// pemisahan tahun, bulan, hari, dan waktu
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl = substr($date, 8, 2);
	$waktu = substr($date, 11, 5);
	$hari = date("w", strtotime($date));
	$result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;
	return $result;
}

function waktu_indo($date)
{
	$waktu = substr($date, 11, 5);
	return $waktu . " WIB";
}

function nama_bulan()
{
	$bulan = [
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	];
	return $bulan;
}
