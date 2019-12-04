<?php
include "config/library.php";
include "config/koneksi.php";
opendb();
//ambil data yang didapat dari form
$id=antiinjec(@$_REQUEST['id']);
$status=antiinjec(@$_GET['act']);

if($status=="hapus" ) {
	querydb("DELETE a.*, b.*, c.* FROM cf_konsultasi as a, cf_konsultasi_gejala as b, cf_konsultasi_hasil as c 
			 WHERE a.id_konsultasi=b.id_konsultasi AND a.id_konsultasi=c.id_konsultasi AND a.id_konsultasi='".$id."'");
	header("location:./?hal=konsultasi-list");
}
closedb();
?>