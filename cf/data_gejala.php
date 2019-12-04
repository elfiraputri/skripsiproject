<article class="box post post-excerpt">
    <header>
        <h2><a href="#">Data Gejala </a></h2>
    </header>
        
    <table width="100%" class="default" border="1">
      <tr>
        <th width="3%">No</th>
        <th width="4%">Kode</th>
        <th width="44%">Gejala</th>
        <th width="43%">Informasi</th>
        <th width="6%"><a href="?hal=gejala-input&act=tambah" class="btn_biru">Tambah</a></th>
      </tr>
      <?php
      $halaman=@$_GET['halaman'];
      $perhalaman=15;
      $query_part ="SELECT id_gejala, kd_gejala, gejala, informasi FROM cf_gejala
                    WHERE (gejala LIKE '%$txtcari%')";
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
      $query="SELECT id_gejala, kd_gejala, gejala, substring(informasi, 1, 45) as informasi_min, informasi FROM cf_gejala
              WHERE (gejala LIKE '%$txtcari%') 
              ORDER BY kd_gejala ASC LIMIT $halamannya, $perhalaman" ;
      $hquery=querydb($query);
      while ($data_tbl=mysql_fetch_assoc($hquery)) {
      $nomor=$nomor+1;
      ?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data_tbl['kd_gejala']; ?></td>
        <td><?php echo $data_tbl['gejala']; ?></td>
        <td><?php echo $data_tbl['informasi_min']; if(strlen($data_tbl['informasi_min'])< strlen($data_tbl['informasi'])) { echo "..."; } ?></td>
        <td>
		<script type="text/javascript">
        function konfirmasi<?php echo $data_tbl['id_gejala']; ?>() {
            var answer = confirm("Anda yakin akan menghapus data <?php echo $data_tbl['kd_gejala']." - ".$data_tbl['gejala']; ?>?")
            if (answer){
                window.location = "aksi_gejala.php?act=hapus&id=<?php echo"$data_tbl[id_gejala]"; ?>";
            }
        }
        </script>
        <a href="?hal=gejala-input&act=ubah&id=<?php echo $data_tbl['id_gejala']; ?>" class="btn_hijau">Ubah</a>
        <a href="#" class="btn_merah" onclick="konfirmasi<?php echo $data_tbl['id_gejala']; ?>()">Hapus</a>
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
        
        <a href="?hal=gejala&halaman=<?php echo"$j"; ?>" title="Halaman : <?php echo"$j"; ?>" class="<?php if (($halaman+1)==$j) { echo"active"; } ?>"><?php echo"$j"; ?></a>
        <?php }
    ?>
    </div>
</div>
