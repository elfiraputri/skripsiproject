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
	$query="SELECT id_pengguna, nama, username, password, tipe 
			FROM cf_pengguna as a
			WHERE id_pengguna ='$id'";
	$hquery=querydb($query);
	$dataquery=mysql_fetch_assoc($hquery);
?>
<article class="box post post-excerpt">
    <header>
        <h2><?php if($status=="ubah") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Pengguna</h2>
    </header>
<div class="form-style-6">
<form action="aksi_pengguna.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
    <input type="hidden" name="id" value="<?php echo"$dataquery[id_pengguna]"; ?>" />
        <table width="100%" cellpadding="10" cellspacing="0" border="0" class="pad">
          <input type="hidden" name="id" value="<?php echo"$dataquery[id_pengguna]"; ?>" />
          <tr>
            <td width="23%">Nama Pengguna</td>
            <td width="2%">:</td>
            <td width="75%"><input name="nama" type="text" size="30" maxlength="50" value="<?php echo"$dataquery[nama]"; ?>" class="input-field required"></td>
          </tr>
          <tr>
            <td>Tipe</td>
            <td>:</td>
            <td>
            <select name="tipe" class="select-field">
                <option value="1" <?php if($dataquery['tipe']==1) { echo "selected"; } ?>>Pakar</option>
                <option value="2" <?php if($dataquery['tipe']==2) { echo "selected"; } ?>>Konsultan</option>
            </select>
            </td>
          </tr>
          <tr>
            <td>Username</td>
            <td>:</td>
            <td><input name="username" type="text" size="20" maxlength="100" value="<?php echo"$dataquery[username]"; ?>" class="input-field required"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td>:</td>
            <td><input name="pass1" type="password" size="20" value="<?php echo"$dataquery[password]"; ?>" class="input-field required"></td>
          </tr>
          <tr>
            <td>Ulangi Password</td>
            <td>:</td>
            <td><input name="pass2" type="password" size="20" value="<?php echo"$dataquery[password]"; ?>" class="input-field required"></td>
          </tr>
        </table>
    <input name="simpan" type="submit" value="Simpan">
    <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">    
</form>
</div>