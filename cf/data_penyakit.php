<article class="box post post-excerpt">
    <header>
        <h2><a href="#">Data Penyakit </a></h2>
    </header>
        
    <table width="100%" class="default" border="1">
      <tr>
        <th width="2%">No</th>
        <th width="5%">Kode</th>
        <th width="18%">Penyakit</th>
        <th width="34%">Informasi</th>
        <th width="32%">Saran</th>
        <th width="9%"><a href="?hal=penyakit-input&act=tambah" class="btn_biru">Tambah</a></th>
      </tr>
      <?php
      $halaman=@$_GET['halaman'];
      $perhalaman=15;
      $query_part ="SELECT id_penyakit, kd_penyakit, penyakit, informasi, saran FROM cf_penyakit
                    WHERE (penyakit LIKE '%$txtcari%')";
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
      $query="SELECT id_penyakit, kd_penyakit, penyakit, substring(informasi, 1, 45) as informasi_min, informasi, substring(saran, 1, 45) as saran_min, saran FROM cf_penyakit
              WHERE (penyakit LIKE '%$txtcari%') 
              ORDER BY kd_penyakit ASC LIMIT $halamannya, $perhalaman" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['kd_penyakit']; ?></td>
        <td><?php echo $data_tbl['penyakit']; ?></td>
        <td><?php echo $data_tbl['informasi_min']; if(strlen($data_tbl['informasi_min'])< strlen($data_tbl['informasi'])) { echo "..."; } ?></td>
        <td><?php echo $data_tbl['saran_min']; if(strlen($data_tbl['saran_min'])< strlen($data_tbl['saran'])) { echo "..."; } ?></td>
        <td>
		<script type="text/javascript">
        function konfirmasi<?php echo $data_tbl['id_penyakit']; ?>() {
            var answer = confirm("Anda yakin akan menghapus data <?php echo $data_tbl['kd_penyakit']." - ".$data_tbl['penyakit']; ?>?")
            if (answer){
                window.location = "aksi_penyakit.php?act=hapus&id=<?php echo"$data_tbl[id_penyakit]"; ?>";
            }
        }
        </script>
        <a href="?hal=penyakit-input&act=ubah&id=<?php echo $data_tbl['id_penyakit']; ?>" class="btn_hijau">Ubah</a>
        <a href="#" class="btn_merah" onclick="konfirmasi<?php echo $data_tbl['id_penyakit']; ?>()">Hapus</a>
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
        
        <a href="?hal=penyakit&halaman=<?php echo"$j"; ?>" title="Halaman : <?php echo"$j"; ?>" class="<?php if (($halaman+1)==$j) { echo"active"; } ?>"><?php echo"$j"; ?></a>
        <?php }
    ?>
    </div>
</div>
