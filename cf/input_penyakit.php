<script type="text/javascript">
// Forms Validator
$j(function() {
   $j("#form1").validate();
});
</script>

<?php
$status=antiinjec(@$_GET['act']);

if ($status=="ubah") { $id=antiinjec(@$_REQUEST['id']); }
if ($status=="tambah") { $id=0; }
	$query="SELECT id_penyakit, kd_penyakit, penyakit, informasi, saran FROM cf_penyakit where id_penyakit='$id'" ;
	$hquery=querydb($query);
	$dataquery=mysql_fetch_assoc($hquery);
?>
<article class="box post post-excerpt">
    <header>
        <h2><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Penyakit</h2>
    </header>
<div class="form-style-6">
<form action="aksi_penyakit.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
    <input type="hidden" name="id" value="<?php echo"$dataquery[id_penyakit]"; ?>" />
        <table width="100%" cellpadding="10" cellspacing="0" border="1" class="pad">
          <tr>
            <td width="14%">Kode</td>
            <td width="2%">:</td>
            <td width="84%"><input name="kode" type="text" size="6" maxlength="5" value="<?php echo"$dataquery[kd_penyakit]"; ?>" class="input-field required"></td>
          </tr>
          <tr>
            <td>Penyakit</td>
            <td>:</td>
            <td><input name="penyakit" type="text" size="50" maxlength="150" value="<?php echo"$dataquery[penyakit]"; ?>" class="input-field required"></td>
          </tr>
          <tr>
            <td>Informasi</td>
            <td>:</td>
            <td><textarea name="informasi" class="textarea-field required" cols="52" rows="5"><?php echo"$dataquery[informasi]"; ?></textarea></td>
          </tr>
          <tr>
            <td>Saran</td>
            <td>:</td>
            <td><textarea name="saran" class="textarea-field required" cols="52" rows="5"><?php echo"$dataquery[saran]"; ?></textarea></td>
          </tr>
        </table>
    <input name="simpan" type="submit" value="Simpan">
    <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">    
</form>
</div>