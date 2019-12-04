<article class="box post post-excerpt">
    <header>
        <h2><a href="#">Data Basis Pengetahuan </a></h2>
    </header>
        
    <table width="100%" class="default" border="1">
      <tr>
        <th width="2%">No</th>
        <th width="24%">Penyakit</th>
        <th width="43%">Gejala</th>
        <th width="8%">MB</th>
        <th width="9%">MD</th>
        <th width="8%">CF</th>
        <th width="6%"><a href="?hal=basis-input&act=tambah" class="btn_biru">Tambah</a></th>
      </tr>
      <?php
      $halaman=@$_GET['halaman'];
      $perhalaman=20;
      $query_part ="SELECT a.id_pengetahuan, a.id_penyakit, a.id_gejala, a.mb, a.md, a.cf, b.kd_penyakit, b.penyakit, c.kd_gejala, c.gejala 
	  				FROM cf_pengetahuan as a, cf_penyakit as b, cf_gejala as c
                    WHERE a.id_penyakit=b.id_penyakit AND a.id_gejala=c.id_gejala AND (b.penyakit LIKE '%$txtcari%' OR c.gejala LIKE '%$txtcari%')";
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
      $query="SELECT a.id_pengetahuan, a.id_penyakit, a.id_gejala, a.mb, a.md, a.cf, b.kd_penyakit, b.penyakit, c.kd_gejala, c.gejala 
			  FROM cf_pengetahuan as a, cf_penyakit as b, cf_gejala as c
			  WHERE a.id_penyakit=b.id_penyakit AND a.id_gejala=c.id_gejala AND (b.penyakit LIKE '%$txtcari%' OR c.gejala LIKE '%$txtcari%')
			  ORDER BY b.id_penyakit ASC LIMIT $halamannya, $perhalaman" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['penyakit']; ?></td>
        <td><?php echo $data_tbl['gejala']; ?></td>
        <td><?php echo $data_tbl['mb']; ?></td>
        <td><?php echo $data_tbl['md']; ?></td>
        <td><?php echo $data_tbl['cf']; ?></td>
        <td>
		<script type="text/javascript">
        function konfirmasi<?php echo $data_tbl['id_pengetahuan']; ?>() {
            var answer = confirm("Anda yakin akan menghapus data <?php echo $data_tbl['penyakit']." - ".$data_tbl['gejala']; ?>?")
            if (answer){
                window.location = "aksi_basis.php?act=hapus&id=<?php echo"$data_tbl[id_pengetahuan]"; ?>";
            }
        }
        </script>
        <a href="?hal=basis-input&act=ubah&id=<?php echo $data_tbl['id_pengetahuan']; ?>" class="btn_hijau">Ubah</a>
        <a href="#" class="btn_merah" onclick="konfirmasi<?php echo $data_tbl['id_pengetahuan']; ?>()">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>

</article>


<div class="pagination">
    <a href="#" class="button previous">Halaman</a>
    <div class="pages">
    <?php
        for($j=1;$j<($jmlhalaman_part+1);$j++)
        {
        ?>
        
        <a href="?hal=basis&halaman=<?php echo"$j"; ?>" title="Halaman : <?php echo"$j"; ?>" class="<?php if (($halaman+1)==$j) { echo"active"; } ?>"><?php echo"$j"; ?></a>
        <?php }
    ?>
    </div>
</div>
