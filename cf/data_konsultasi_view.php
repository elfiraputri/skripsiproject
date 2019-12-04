<?php
$konsul=antiinjec(@$_GET['id']);
$q_konsultasi="SELECT id_konsultasi, nama, tanggal FROM cf_konsultasi WHERE status=1 AND id_konsultasi='".$konsul."'" ;
$h_konsultasi=querydb($q_konsultasi);
$d_konsultasi=mysql_fetch_assoc($h_konsultasi);
?>
<style>
	.biru_1 {color:#06F; background:#333; padding:4px 5px; border-radius:4px;}
	.biru_2 {color:#09F; background:#333; padding:4px 5px; border-radius:4px;}
	.biru_3 {color:#0CF; background:#333; padding:4px 5px; border-radius:4px;}
	.biru_4 {color:#0FF; background:#333; padding:4px 5px; border-radius:4px;}
	.hijau_1 {color:#9F0; background:#333; padding:4px 5px; border-radius:4px;}
	.kuning_1 {color:#FF0; background:#333; padding:4px 5px; border-radius:4px;}
	.kuning_2 {color:#FC0; background:#333; padding:4px 5px; border-radius:4px;}
	.kuning_3 {color:#F90; background:#333; padding:4px 5px; border-radius:4px;}
	.kuning_4 {color:#F60; background:#333; padding:4px 5px; border-radius:4px;}
</style>
<article class="box post post-excerpt">
    <header>
        <h2>Hasil Konsultasi</h2>
        <p style="font-size:16px; color:#666; font-weight:600;">Berikut adalah hasil <span style="color:#06C;">konsultasi <?php echo $d_konsultasi['nama'].", Tanggal ". $d_konsultasi['tanggal']; ?></span></p>
    </header>
    
    <h3>Data Gejala Dipilih</h3>
    <table width="100%" class="default" border="1">
      <tr>
        <th width="2%">No</th>
        <th width="4%">Kode</th>
        <th width="60%">Gejala</th>
        <th width="34%">[Nilai CF] Pilihan Kondisi</th>
      </tr>
      <?php
      $query="SELECT b.id_konsultasi_gejala, b.cf_user, a.id_gejala, a.kd_gejala, a.gejala 
	  		  FROM cf_gejala as a, cf_konsultasi_gejala as b
              WHERE  a.id_gejala=b.id_gejala AND b.id_konsultasi='".$konsul."' AND b.status=1
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
        <?php 
			if($data_tbl['cf_user']==1) { echo "<span class='biru_1'>[$data_tbl[cf_user]] Pasti ya</span>"; } 
			elseif($data_tbl['cf_user']==0.8) { echo "<span class='biru_2'>[$data_tbl[cf_user]] Hampir pasti ya</span>"; } 
			elseif($data_tbl['cf_user']==0.6) { echo "<span class='biru_3'>[$data_tbl[cf_user]] Kemungkinan besar ya</span>"; } 
			elseif($data_tbl['cf_user']==0.4) { echo "<span class='biru_4'>[$data_tbl[cf_user]] Mungkin ya</span>"; } 
			elseif($data_tbl['cf_user']==-0.2) { echo "<span class='hijau_1'>[$data_tbl[cf_user]] Tidak tahu</span>"; } 
			elseif($data_tbl['cf_user']==-0.4) { echo "<span class='kuning_1'>[$data_tbl[cf_user]] Mungkin tidak</span>"; } 
			elseif($data_tbl['cf_user']==-0.6) { echo "<span class='kuning_2'>[$data_tbl[cf_user]] Kemungkinan besar tidak</span>"; } 
			elseif($data_tbl['cf_user']==-0.8) { echo "<span class='kuning_3'>[$data_tbl[cf_user]] Hampir pasti tidak</span>"; } 
			elseif($data_tbl['cf_user']==-1) { echo "<span class='kuning_4'>[$data_tbl[cf_user]] Pasti tidak</span>"; } 
		?>
        </td>
      </tr>
      <?php } ?>
    </table>
 
    <h3>Data Hasil Konsultasi</h3>
    <table width="100%" class="default" border="1">
      <tr>
        <th width="2%">Rank</th>
        <th width="4%">Kode</th>
        <th width="60%">Penyakit</th>
        <th width="34%">Nilai CF</th>
        <th width="34%">Persen</th>
      </tr>
      <?php
	  $nomor=0;
      $query="SELECT b.id_konsultasi_hasil, b.nilai_cf, a.kd_penyakit, a.penyakit
	  		  FROM cf_penyakit as a, cf_konsultasi_hasil as b
              WHERE a.id_penyakit=b.id_penyakit AND b.id_konsultasi='".$konsul."' AND b.status=1
              ORDER BY b.nilai_cf DESC, a.kd_penyakit ASC" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['kd_penyakit']; ?></td>
        <td><?php echo $data_tbl['penyakit']; ?></td>
        <td><?php echo number_format ( $data_tbl['nilai_cf'] , 4 , "," , "." ); ?></td>
        <td><?php echo number_format ( $data_tbl['nilai_cf']*100 , 2 , "," , "." ); ?>%</td>
      </tr>
      <?php } ?>
    </table>
    
    <h3 style="font-size:18px; margin-top:25px; border-top:1px solid #999; padding-top:15px;">DIAGNOSA</h3>
    Hasil dari diagnosa penyakit yang paling mungkin adalah sebagai berikut:
    <div style="border:1px solid #F60; padding:10px; margin-bottom:20px;">
    	<?php
        $query="SELECT b.id_konsultasi_hasil, b.nilai_cf, a.kd_penyakit, a.penyakit, a.informasi, a.saran
                FROM cf_penyakit as a, cf_konsultasi_hasil as b
                WHERE a.id_penyakit=b.id_penyakit AND b.id_konsultasi='".$konsul."' AND b.status=1
                ORDER BY b.nilai_cf DESC, a.kd_penyakit ASC LIMIT 0, 1" ;
        $hquery=querydb($query);
        $data_tbl=mysql_fetch_assoc($hquery);
		?>
    	<h2 style="color:#F30;"><?php echo $data_tbl['penyakit']; ?></h2>
        <p><?php echo $data_tbl['informasi']; ?></p>
        <p>
        	<h3>Saran:</h3>
			<?php echo $data_tbl['saran']; ?>
        </p>
    </div>
    
<div class="form-style-6">  
	<a href="?hal=konsultasi-gejala"><input type="button" value="Ubah Gejala"></a>
	<a href="?hal=konsultasi-selesai"><input type="button" value="Selesai" class="red"></a>
</div>
</article>