<article class="box post post-excerpt">
    <header>
        <h2><a href="#">Data Penyakit </a></h2>

    </header>
        
    <table width="100%" class="default" border="1">
      <tr>
        <th width="2%">No</th>
        <th width="15%">Tanggal</th>
        <th width="20%">Nama Lengkap</th>
        <th width="30%">alamat</th>
        <th width="33%">Penyakit </th>
        <th width="40%">Nilai CF</th>
        <th width="15%"><div style="width:134px; border:1px solid #FFF;"></div></th>
      </tr>
      <?php
      $halaman=@$_GET['halaman'];
      $perhalaman=150;
      $query_part ="SELECT id_konsultasi, nama, alamat, tanggal FROM cf_konsultasi
                    WHERE status=1";
      $hasil_part = querydb($query_part);
      $jmlhalaman_part = ceil(mysql_num_rows($hasil_part)/$perhalaman);
      
      if (!isset($halaman) || intval($halaman)==0)
      {
      $halaman=0;
      }
      else
      {
      $halaman=$halaman-1;
      }
      $halamannya = $halaman * $perhalaman;
      
      $nomor=$halamannya;
      $query="SELECT id_konsultasi, nama, alamat, tanggal FROM cf_konsultasi
              WHERE status=1 
              ORDER BY tanggal DESC LIMIT $halamannya, $perhalaman" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['tanggal']; ?></td>
        <td><?php echo $data_tbl['nama']; ?></td>
        <td><?php echo $data_tbl['alamat']; ?></td>
        <td>
        	<?php
			$q_penya="SELECT b.id_konsultasi_hasil, b.nilai_cf, a.kd_penyakit, a.penyakit, a.informasi, a.saran
					  FROM cf_penyakit as a, cf_konsultasi_hasil as b
					  WHERE a.id_penyakit=b.id_penyakit AND b.id_konsultasi='".$data_tbl['id_konsultasi']."' AND b.status=1
					  ORDER BY b.nilai_cf DESC, a.kd_penyakit ASC LIMIT 0, 1" ;
			$d_penya=mysql_fetch_assoc(querydb($q_penya));
			echo $d_penya['penyakit'];
			?>
        </td>
        <td><?php echo number_format ( $d_penya['nilai_cf']*100 , 2 , "," , "." ); ?>%</td>
        <td>
		<script type="text/javascript">
        function konfirmasi<?php echo $data_tbl['id_konsultasi']; ?>() {
            var answer = confirm("Anda yakin akan menghapus data <?php echo $data_tbl['tanggal']." - ".$data_tbl['nama']; ?>, setelah dihapus tidak dapat di Undo?")
            if (answer){
                window.location = "aksi_konsultasi.php?act=hapus&id=<?php echo"$data_tbl[id_konsultasi]"; ?>";
            }
        }
        </script>
        <a href="?hal=konsultasi-view&id=<?php echo $data_tbl['id_konsultasi']; ?>" class="btn_hijau">Lihat Detail</a>
        <a href="#" class="btn_merah" onclick="konfirmasi<?php echo $data_tbl['id_konsultasi']; ?>()">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>

</article>



<div class="pagination">
    <a href="print.php" class="button">Print </a>
    <body onload="window.print();" Layout="Portrait">

    <a href="#" class="button previous">Halaman</a>
    <div class="pages">
    <?php
        for($j=1;$j<($jmlhalaman_part+1);$j++)
        {
        ?>
        
        <a href="?hal=penyakit&halaman=<?php echo"$j"; ?>" title="Halaman : <?php echo"$j"; ?>" class="<?php if (($halaman+1)==$j) { echo"active"; } ?>"><?php echo"$j"; ?></a>
        <?php }
    ?>


    
    </div>
</div>
