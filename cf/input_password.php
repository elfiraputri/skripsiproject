<script type="text/javascript">
// Forms Validator
$j(function() {
    $j("#test").validate();
});
</script>
    <?php
	$kode_setting=antiinjec(@$_POST['koset']);
	$stat=antiinjec(@$_POST['stat']);
	
	$satu=md5(antiinjec(@$_POST['satu']));
	$dua=md5(antiinjec(@$_POST['dua']));
	$tiga=md5(antiinjec(@$_POST['tiga']));
	?>
    <article class="box post post-excerpt">
        <header>
            <h2>Ubah Password</h2>
        </header>
    <div class="form-style-6">
	<form method="post" action="?hal=ubah-password" enctype="multipart/form-data" id="test">
        <input name="stat" type="hidden" value="ubah1">
        <input name="koset" type="hidden" value="<?php echo"$kode_setting"; ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="pad">
				  <tr bgcolor="#FFFFFF">
					<td width="21%">Password Lama </td>
					<td width="1%">:</td>
					<td width="78%"><input type="password" name="satu" class="input-field required" value="<?php echo "$dview[1]"; ?>" maxlength="50" style="width:150px;"></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td valign="top">&nbsp;</td>
				    <td valign="top">&nbsp;</td>
				    <td>&nbsp;</td>
			      </tr>
				  <tr bgcolor="#FFFFFF">
					<td valign="top">Password Baru </td>
					<td valign="top">:</td>
					<td><input type="password" name="dua" class="input-field required" value="<?php echo "$dview[2]"; ?>" maxlength="50" style="width:150px;"></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td valign="top">Ulangi Password Baru </td>
				    <td valign="top">:</td>
				    <td><input type="password" name="tiga" class="input-field required" value="<?php echo "$dview[3]"; ?>" maxlength="50" style="width:150px;"></td>
			      </tr>
				  <tr bgcolor="#FFFFFF">
					<td>&nbsp;</td>
					<td></td>
					<td align="right"></td>
				  </tr>
				</table>
        <input name="simpan" type="submit" value="Simpan">
        <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">    
	</form>
	<br>
	</div>
    </article>
<?php
//Script untuk pemrosesan data :::
//ubah data
if ($stat=="ubah1") {
		if ($satu<>$dataadm['password'])
		{ ?>
			<script language="JavaScript">alert('Passwrod lama salah. Password lama adalah password yang Anda gunakan sekarang.');
			document.location='?h=password'</script>
		<?php }
		else
		{
			if (($dua<>$tiga) or ($dua=="") or ($tiga==""))
			{ ?>
				<script language="JavaScript">alert('Pasword baru dan password baru ulangi tidak sama dan tidak boleh dikosongkan.');
				document.location='?hal=ubah-password'</script>
			<?php }
			else
			{
				opendb();
				$query="UPDATE cf_pengguna SET password='$dua' WHERE id_pengguna=$dataadm[id_pengguna]";
				querydb($query);
				closedb();
				?>
				<script language="JavaScript">alert('Perubahan berhasil disimpan. Sistem Logout.');
				document.location='logout.php'</script>
				<?php
			}
		}
		}
?>