<?php
session_start();
include "config/library.php";
include "config/koneksi.php";
opendb();

$nama=antiinjec(@$_POST['nama']);
$alamat=antiinjec(@$_POST['alamat']);
$pekerjaan=antiinjec(@$_POST['pekerjaan']);


if(@$_POST['simpan'] ) {
	$sesi=rand(100, 999).date('YmdHi');
	$tgl=date('Y-m-d H:i:s');
	
	$qcek = "SELECT count(*) as jumlah FROM cf_konsultasi WHERE sesi='$sesi'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO cf_konsultasi
			(nama,alamat,pekerjaan, sesi, status, tanggal)
			 VALUES ('$nama','$alamat', '$pekerjaan', '$sesi', 0, '$tgl')";
		querydb($query);
		
		$q_id = "SELECT id_konsultasi FROM cf_konsultasi WHERE sesi='$sesi'";
		$h_id = querydb($q_id);
		$d_id = mysql_fetch_array($h_id);
		
		$_SESSION['sesi_konsultasi']=$d_id['id_konsultasi'];
		
		header("location:./?hal=konsultasi-gejala");
	}	
}
closedb();
?>