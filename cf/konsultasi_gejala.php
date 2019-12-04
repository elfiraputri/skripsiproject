<?php if(!isset($_SESSION['sesi_konsultasi'])) { ?>
	<script language="JavaScript">history.go(-1); </script>
<?php } else { 
	$konsul=@$_SESSION['sesi_konsultasi'];
	$q_konsultasi="SELECT id_konsultasi, nama,kelamin,alamat, pekerjaan, sesi, tanggal FROM cf_konsultasi WHERE id_konsultasi='".$konsul."'" ;
	$h_konsultasi=querydb($q_konsultasi);
	$d_konsultasi=mysql_fetch_assoc($h_konsultasi);
?>

<article class="box post post-excerpt">
    <header>
        <h2>Konsultasi</h2>
        <p style="font-size:16px; color:#666; font-weight:600;">Silahkan pilih kondisi gejala sesuai yang dialami.</p>
    </header>
<div class="form-style-6">

<h3 style="margin-bottom:15px;">Konsultasi [<span style="color:#690; font-weight:500;"><?php echo $d_konsultasi['sesi']; ?></span>] <span style="color:#09C;"><?php echo $d_konsultasi['nama']; ?></span></h3>

<form action="konsultasi_gejala_aksi.php" method="post" enctype="multipart/form-data" id="form1">
    <table width="100%" class="default" border="1">
      <tr>
        <th width="3%">No</th>
        <th width="4%">Kode</th>
        <th width="44%">Gejala</th>
        <th width="6%">Pilih Kondisi</th>
      </tr>
      <?php
      $query="SELECT id_gejala, kd_gejala, gejala, substring(informasi, 1, 45) as informasi_min, informasi FROM cf_gejala
              WHERE (gejala LIKE '%$txtcari%') 
              ORDER BY kd_gejala" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['kd_gejala']; ?></td>
        <td><?php echo $data_tbl['gejala']; ?></td>
        <td>
        <style>
			#select<?php echo $data_tbl['id_gejala']; ?> {width:150px;}
			#select<?php echo $data_tbl['id_gejala']; ?>:focus, #select<?php echo $data_tbl['id_gejala']; ?>:focus {
				color:black;
			}
			.putih {background:#FFF;}
			.biru_1 {background:#06F;}
			.biru_2 {background:#09F;}
			.biru_3 {background:#0CF;}
			.biru_4 {background:#0FF;}
			.hijau_1 {background:#9F0;}
			.kuning_1 {background:#FF0;}
			.kuning_2 {background:#FC0;}
			.kuning_3 {background:#F90;}
			.kuning_4 {background:#F60;}
		</style>
        
        <script type="text/javascript">
		function colourFunction<?php echo $data_tbl['id_gejala']; ?>() {
			var myselect = document.getElementById("select<?php echo $data_tbl['id_gejala']; ?>"),
			colour = myselect.options[myselect.selectedIndex].className;
			myselect.className = colour;
			myselect.blur(); //This just unselects the select list without having to click somewhere else on the page
		}
		</script>
        
        <?php
		if(isset($_SESSION['sesi_hasil'])) {
			$konsul=@$_SESSION['sesi_konsultasi'];
			$q_gejala="SELECT cf_user FROM cf_konsultasi_gejala WHERE id_konsultasi='".$konsul."' AND id_gejala='".$data_tbl['id_gejala']."' AND status=1";
			$h_gejala=querydb($q_gejala);
			$kd_gejala=mysql_fetch_row($h_gejala);	
		} 
		
		$class="";
		switch ($kd_gejala[0]) {
			case 0:
				$class="putih"; break;
			case 1;
				$class="biru_1"; break;
			case 0.8;
				$class="biru_2"; break;
			case 0.6;
				$class="biru_3"; break;
			case 0.4;
				$class="biru_4"; break;
			case -0.2;
				$class="hijau_1"; break;
			case -0.4;
				$class="kuning_1"; break;
			case -0.6;
				$class="kuning_2"; break;
			case -0.8;
				$class="kuning_3"; break;
			case -1;
				$class="kuning_4"; break;
		}
		?>
        
        <input type="hidden" name="gejala[]" value="<?php echo $data_tbl['id_gejala']; ?>" />
        <select id="select<?php echo $data_tbl['id_gejala']; ?>" onchange="colourFunction<?php echo $data_tbl['id_gejala']; ?>()" name="cf_user[]" class="input-field <?php echo $class; ?>" style="width:200px;">
        	<option class="putih" value="" <?php if($kd_gejala[0]=="") { echo "selected"; } ?>>Pilih jika sesuai</option>
        	<option class="biru_1" value="1" <?php if($kd_gejala[0]==1) { echo "selected"; } ?>>Pasti ya</option>
        	
        	<option class="biru_3" value="0.6" <?php if($kd_gejala[0]==0.6) { echo "selected"; } ?>>Mungkin ya</option>
        	
        	<option class="kuning_4" value="-1" <?php if($kd_gejala[0]==-1) { echo "selected"; } ?>>Tidak</option>
        </select>
        </td>
      </tr>
      <?php } ?>
    </table>
<input name="simpan" type="submit" value="Simpan &amp; Lanjutkan">
</form>    
</div>
</article>
<?php } ?>