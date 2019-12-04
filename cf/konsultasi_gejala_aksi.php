<?php
include "config/library.php";
include "config/koneksi.php";
opendb();

if(@$_POST['simpan'] ) {
	$konsul=@$_SESSION['sesi_konsultasi'];
	$gejala=@$_POST['gejala'];
	$cf_user=@$_POST['cf_user'];
	
	$jml=count($gejala);
	$dipilih=0;
	
	querydb("UPDATE cf_konsultasi_gejala SET status=0 WHERE id_konsultasi='".$konsul."'");
	
	for($i=0; $i<$jml; $i++) {
		if($cf_user[$i]!="") {
			$dipilih++;
			$qcek = "SELECT count(*) as jumlah FROM cf_konsultasi_gejala WHERE id_konsultasi='".$konsul."' AND id_gejala='".$gejala[$i]."'";
			$hcek = querydb($qcek);
			$dcek = mysql_fetch_array($hcek);
			if($dcek[0]==0) {
				$query= "INSERT INTO cf_konsultasi_gejala (id_konsultasi, id_gejala, cf_user, status) VALUES ('$konsul', '$gejala[$i]', '$cf_user[$i]', 1)";
				querydb($query);				
			} else {
				$query= "UPDATE cf_konsultasi_gejala SET cf_user='$cf_user[$i]', status=1 WHERE id_konsultasi='".$konsul."' AND id_gejala='".$gejala[$i]."'";
				querydb($query);				
			}
		}	
	}
	if($dipilih>0) {
		$_SESSION['sesi_hasil']="oke";
		header("location:./?hal=konsultasi-hasil");
	} else {
		?>
		<script language="JavaScript">alert("Anda harus memilih gejala dan kondisinya"); history.go(-1); </script>
        <?php
	}
}
closedb();
?>