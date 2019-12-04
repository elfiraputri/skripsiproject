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
	$query="SELECT id_pengetahuan, id_penyakit, id_gejala, mb, md, cf 
			FROM cf_pengetahuan as a
			WHERE id_pengetahuan='$id'";
	$hquery=querydb($query);
	$dataquery=mysql_fetch_assoc($hquery);
?>
<article class="box post post-excerpt">
    <header>
        <h2><?php if($status=="ubah") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Basis Pengetahuan</h2>
    </header>
<div class="form-style-6">
<form action="aksi_basis.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
    <input type="hidden" name="id" value="<?php echo"$dataquery[id_pengetahuan]"; ?>" />
        <table width="100%" cellpadding="10" cellspacing="0" border="1" class="pad">
          <tr>
            <td width="20%">Penyakit</td>
            <td width="2%">:</td>
            <td width="78%">
            <select name="penyakit" class="input-field required"> 
            	<option value="">- Pilih -</option>
                <?php
				$q_drop="SELECT id_penyakit, kd_penyakit, penyakit FROM cf_penyakit ORDER BY kd_penyakit ASC";
				$h_drop=querydb($q_drop);
				while($d_drop=mysql_fetch_assoc($h_drop)) {
					?>
                    	<option value="<?php echo $d_drop['id_penyakit']; ?>" <?php if($d_drop['id_penyakit']==$dataquery['id_penyakit']) { echo "selected"; } ?>><?php echo $d_drop['kd_penyakit']." - ".$d_drop['penyakit']; ?></option>
                    <?php
				}
				?>
            </select>
            </td>
          </tr>
          <tr>
            <td>Gejala</td>
            <td>:</td>
            <td>
            <select name="gejala" class="input-field required"> 
            	<option value="">- Pilih -</option>
                <?php
				$q_drop="SELECT id_gejala, kd_gejala, gejala FROM cf_gejala ORDER BY kd_gejala ASC";
				$h_drop=querydb($q_drop);
				while($d_drop=mysql_fetch_assoc($h_drop)) {
					?>
                    	<option value="<?php echo $d_drop['id_gejala']; ?>" <?php if($d_drop['id_gejala']==$dataquery['id_gejala']) { echo "selected"; } ?>><?php echo $d_drop['kd_gejala']." - ".$d_drop['gejala']; ?></option>
                    <?php	
				}
				?>
            </select>
          	</td>
          </tr>
          <tr>
            <td>MB (Nilai Kepercayaan)</td>
            <td>:</td>
            <td><input type="text" name="mb" value="<?php echo"$dataquery[mb]"; ?>" size="5" min="0" max="1" placeholder="0" class="input-field required"/></td>
          </tr>
          <tr>
            <td>MD (Nilai Ketidakpercayaan)</td>
            <td>:</td>
            <td><input type="text" name="md" value="<?php echo"$dataquery[md]"; ?>" size="5" min="0" max="1" placeholder="0" class="input-field required"/></td>
          </tr>
        </table>
    <input name="simpan" type="submit" value="Simpan">
    <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">    
</form>
</div>