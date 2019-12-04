<?php if(!isset($_SESSION['sesi_hasil'])) { ?>
	<script language="JavaScript">history.go(-1); </script>
<?php } else { 
	$konsul=@$_SESSION['sesi_konsultasi'];
	$q_konsultasi="SELECT id_konsultasi, nama, kelamin, alamat, pekerjaan, sesi, tanggal FROM cf_konsultasi WHERE id_konsultasi='".$konsul."'" ;
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
        <p style="font-size:16px; color:#666; font-weight:600;">Berikut adalah hasil konsultasi Anda.</p>
    </header>
    
	<h3 style="margin-bottom:15px;">Konsultasi [<span style="color:#690; font-weight:500;"><?php echo $d_konsultasi['sesi']; ?></span>] <span style="color:#09C;"><?php echo $d_konsultasi['nama']; ?></span></h3>
    
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
 
	<?php
    //MULAI HITUNG CF HASIL NYA
    querydb("UPDATE cf_konsultasi_hasil SET status=0 WHERE id_konsultasi='".$konsul."'");
    $q_penyakit="SELECT id_penyakit FROM cf_penyakit ORDER BY kd_penyakit ASC";
    $h_penyakit=querydb($q_penyakit);
    while($d_penyakit=mysql_fetch_assoc($h_penyakit)) {
        
        $_SESSION['arr_CF']=array();
        
        $q_gejala_p="SELECT id_gejala, cf FROM cf_pengetahuan WHERE id_penyakit='".$d_penyakit['id_penyakit']."' ORDER BY id_pengetahuan ASC";
        $h_gejala_p=querydb($q_gejala_p);
        while($d_gejala_p=mysql_fetch_assoc($h_gejala_p)) {
            
            $CF=0;
            
            $q_gejala_k="SELECT cf_user FROM cf_konsultasi_gejala 
                         WHERE id_konsultasi='".$konsul."' AND status=1 AND id_gejala='".$d_gejala_p['id_gejala']."'" ;
            $h_gejala_k=querydb($q_gejala_k);
            while ($d_gejala_k=mysql_fetch_assoc($h_gejala_k)) {
                $CF=$d_gejala_p['cf']*$d_gejala_k['cf_user'];
                
                array_push($_SESSION['arr_CF'], $CF);
                
            }
        }
        
        //print_r($_SESSION['arr_CF']);
        
        //Mulai hitung CF Kombinasi
        $jml=0; $CF_kombinasi=0;
        $jml=count($_SESSION['arr_CF']);
        if($jml==1) {
            $CF_kombinasi=$_SESSION['arr_CF'][0];
        }
            
        if($jml>0) {
            for($i=0; $i<$jml; $i++) {
                if($i==1) { 
                    if($_SESSION['arr_CF'][0]>0 && $_SESSION['arr_CF'][1]>0) {
                        $CF_kombinasi=$_SESSION['arr_CF'][0]+$_SESSION['arr_CF'][1]*(1-$_SESSION['arr_CF'][0]);
                    }elseif($_SESSION['arr_CF'][0]<0 || $_SESSION['arr_CF'][1]<0) {
                        $CF_kombinasi=$_SESSION['arr_CF'][0]+$_SESSION['arr_CF'][1];
                    }elseif($_SESSION['arr_CF'][0]<0 && $_SESSION['arr_CF'][1]<0) {
                        $CF_kombinasi=$_SESSION['arr_CF'][0]+$_SESSION['arr_CF'][1]*(1+$_SESSION['arr_CF'][0]);
                    }
                } elseif($i>1) {
                    if($CF_kombinasi>0 && $_SESSION['arr_CF'][$i]>0) {
                        $CF_kombinasi=$CF_kombinasi+$_SESSION['arr_CF'][$i]*(1-$CF_kombinasi);
                    }elseif($CF_kombinasi<0 || $_SESSION['arr_CF'][1]<0) {
                        $CF_kombinasi=$CF_kombinasi+$_SESSION['arr_CF'][$i];
                    }elseif($CF_kombinasi<0 && $_SESSION['arr_CF'][1]<0) {
                        $CF_kombinasi=$CF_kombinasi+$_SESSION['arr_CF'][$i]*(1+$CF_kombinasi);
                    }
                }
            }
        }
            
        if($CF_kombinasi>0) {
            $qcek = "SELECT count(*) as jumlah FROM cf_konsultasi_hasil WHERE id_konsultasi='".$konsul."' AND id_penyakit='".$d_penyakit['id_penyakit']."'";
            $hcek = querydb($qcek);
            $dcek = mysql_fetch_array($hcek);
            if($dcek[0]==0) {
                $query= "INSERT INTO cf_konsultasi_hasil (id_konsultasi, id_penyakit, nilai_cf, status) VALUES ('".$konsul."', '".$d_penyakit['id_penyakit']."', '".$CF_kombinasi."', 1)";
                querydb($query);				
            } else {
                $query= "UPDATE cf_konsultasi_hasil SET nilai_cf='".$CF_kombinasi."', status=1 WHERE id_konsultasi='".$konsul."' AND id_penyakit='".$d_penyakit['id_penyakit']."'";
                querydb($query);				
            }
        }
    }
    
    querydb("UPDATE cf_konsultasi SET status=1 WHERE id_konsultasi='".$konsul."'");
    ?> 
 
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
<?php } ?>