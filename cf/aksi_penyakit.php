<?php
include "config/library.php";
include "config/koneksi.php";

opendb();
$id			=antiinjec(@$_REQUEST['id']);
$status		=antiinjec(@$_GET['act']);

$kode		=antiinjec(@$_POST['kode']);
$penyakit	=antiinjec(@$_POST['penyakit']);
$informasi	=antiinjec(@$_POST['informasi']);
$saran		=antiinjec(@$_POST['saran']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_penyakit WHERE kd_penyakit='$kode'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO cf_penyakit (kd_penyakit, penyakit, informasi, saran)
			 	 VALUES ('$kode','$penyakit', '$informasi', '$saran')";
		querydb($query);
		header("location:./?hal=penyakit");
	} else {
		?>
		<script language="JavaScript">alert('Kode penyakit sudah digunakan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="ubah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_penyakit WHERE kd_penyakit='$kode' AND id_penyakit<>'$id'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE cf_penyakit SET 
				 kd_penyakit='$kode',penyakit='$penyakit', informasi='$informasi', saran='$saran'
				 where id_penyakit='$id' ";
		querydb($query);
		header("location:./?hal=penyakit");
	} else {
		?>
		<script language="JavaScript">alert('Kode penyakit sudah digunakan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from cf_penyakit where id_penyakit='$id' ";
	querydb($query);
	header("location:./?hal=penyakit");
}
closedb();
?>