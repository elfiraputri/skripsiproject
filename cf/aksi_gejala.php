<?php
include "config/library.php";
include "config/koneksi.php";

opendb();
$id			=antiinjec(@$_REQUEST['id']);
$status		=antiinjec(@$_GET['act']);

$kode		=antiinjec(@$_POST['kode']);
$gejala		=antiinjec(@$_POST['gejala']);
$informasi	=antiinjec(@$_POST['informasi']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_gejala WHERE kd_gejala='$kode'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO cf_gejala (kd_gejala, gejala, informasi)
			 	 VALUES ('$kode','$gejala', '$informasi')";
		querydb($query);
		header("location:./?hal=gejala");
	} else {
		?>
		<script language="JavaScript">alert('Kode gejala sudah digunakan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="ubah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_gejala WHERE kd_gejala='$kode' AND id_gejala<>'$id'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE cf_gejala SET 
				 kd_gejala='$kode',gejala='$gejala', informasi='$informasi'
				 where id_gejala='$id' ";
		querydb($query);
		header("location:./?hal=gejala");
	} else {
		?>
		<script language="JavaScript">alert('Kode gejala sudah digunakan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from cf_gejala where id_gejala='$id' ";
	querydb($query);
	header("location:./?hal=gejala");
}
closedb();
?>