<article class="box post post-excerpt">
    <header>
        <h2><a href="#">Data Pengguna</a></h2>
    </header>

    <table width="100%" border="0" class="default" cellpadding="0" cellspacing="0" >
      <tr>
        <th width="2%">No.</th>
        <th width="33%">Nama Pengguna</th>
        <th width="22%">Username</th>
        <th width="38%">Tipe</th>
        <th width="6%"><a href="?hal=pengguna-input&act=tambah" class="btn_biru">Tambah</a></th>
      </tr>
    <?php
    $halaman=@$_GET['halaman'];
    $perhalaman=10;
    $query_part ="SELECT * FROM cf_pengguna";
    $hasil_part = querydb($query_part);
    $jmlhalaman_part = ceil(mysql_num_rows($hasil_part)/$perhalaman);
    
    if (!isset($halaman))
    {
    $halaman=0;
    }
    else
    {
    $halaman=$halaman-1;
    }
    $halamannya = $halaman * $perhalaman;
    
    $nomor=0;
    $query="SELECT id_pengguna, nama, username, password, tipe FROM cf_pengguna ORDER BY id_pengguna ASC LIMIT $halamannya, $perhalaman" ;
    $hquery=querydb($query);
    while ($data_tbl=mysql_fetch_array($hquery)) {
    $nomor=$nomor+1;
    ?>
      <tr>
        <td><?php echo"$nomor"; ?></td>
        <td><?php echo"$data_tbl[nama]"; ?></td>
        <td><?php echo"$data_tbl[username]"; ?></td>
        <td>
            <?php echo""; 
                if($data_tbl['tipe']==1) { echo "Pakar"; }
                elseif($data_tbl['tipe']==2) { echo "Konsultan"; }
            ?>
        </td>
        <td>
		<script type="text/javascript">
        function konfirmasi<?php echo $data_tbl['id_pengguna']; ?>() {
            var answer = confirm("Anda yakin akan menghapus data <?php echo $data_tbl['username']; ?>?")
            if (answer){
                window.location = "aksi_pengguna.php?act=hapus&id=<?php echo"$data_tbl[id_pengguna]"; ?>";
            }
        }
        </script>
        <a href="?hal=pengguna-input&act=ubah&id=<?php echo $data_tbl['id_pengguna']; ?>" class="btn_hijau">Ubah</a>
        <a href="#" class="btn_merah" onclick="konfirmasi<?php echo $data_tbl['id_pengguna']; ?>()">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
    </table>
</article>


<div class="pagination">
    <a href="#" class="button previous">Halaman</a>
    <div class="pages">
    <?php
        for($j=1;$j<($jmlhalaman_part+1);$j++)
        {
        ?>
        
        <a href="?hal=pengguna&halaman=<?php echo"$j"; ?>" title="Halaman : <?php echo"$j"; ?>" class="<?php if (($halaman+1)==$j) { echo"active"; } ?>"><?php echo"$j"; ?></a>
        <?php }
    ?>
    </div>
</div>