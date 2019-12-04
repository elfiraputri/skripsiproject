<?php
include "config/library.php";
include "config/koneksi.php";

opendb();
$id			=antiinjec(@$_REQUEST['id']);
$status		=antiinjec(@$_GET['act']);

$penyakit	=antiinjec(@$_POST['penyakit']);
$gejala		=antiinjec(@$_POST['gejala']);
$mb			=antiinjec(@$_POST['mb']);
$md			=antiinjec(@$_POST['md']);
$cf			=$mb-$md;

if($mb<0 || $mb>1 || $md<0 || $md>1) {
	?>
	<script language="JavaScript">alert('Nilai MB dan MD antara 0 dan 1 <?php echo $mb.$md; ?>.'); history.go(-1); </script>
	<?php
	exit();	
}

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_pengetahuan WHERE id_penyakit='$penyakit' AND id_gejala='$gejala'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO cf_pengetahuan (id_penyakit, id_gejala, mb, md, cf)
			 	 VALUES ('$penyakit','$gejala', '$mb', '$md', '$cf')";
		querydb($query);
		header("location:./?hal=basis");
	} else {
		?>
		<script language="JavaScript">alert('Data basis pengetahuan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="ubah" ) {
	$qcek = "SELECT count(*) as jumlah FROM cf_pengetahuan WHERE id_penyakit='$penyakit' AND id_gejala='$gejala' AND id_pengetahuan<>'$id'";
	$hcek = querydb($qcek);
	$dcek = mysql_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE cf_pengetahuan SET 
				 id_penyakit='$penyakit', id_gejala='$gejala', mb='$mb', md='$md', cf='$cf'
				 where id_pengetahuan='$id' ";
		querydb($query);
		header("location:./?hal=basis");
	} else {
		?>
		<script language="JavaScript">alert('Data basis pengetahuan sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from cf_pengetahuan where id_pengetahuan='$id' ";
	querydb($query);
	header("location:./?hal=basis");
}
closedb();
?>