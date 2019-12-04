<?php if(isset($_SESSION['sesi_hasil'])) { ?>
	<script language="JavaScript">document.location='?hal=konsultasi-hasil'; </script>
<?php } elseif(isset($_SESSION['sesi_konsultasi'])) { ?>
	<script language="JavaScript">document.location='?hal=konsultasi-gejala'; </script>
<?php } else { ?>
<script type="text/javascript">
// Forms Validator
$j(function() {
   $j("#form1").validate();
});
</script>
<article class="box post post-excerpt">
    <header>
        <h2>Konsultasi</h2>
        <p style="font-size:16px; color:#666; font-weight:600;">Untuk memulai konsultasi silahkan masukkan Nama Lengkap terlebih dahulu.</p>
    </header>

<div class="form-style-6">
<form action="konsultasi_aksi.php" method="post" enctype="multipart/form-data" id="form1">
    <table width="100%" cellpadding="10" cellspacing="0" border="1" class="pad">
        <tr>
        <td >Nama</td>
        <td><input class="form-control"  type="text" name="nama" value="" placeholder="Isi Nama Lengkap" /></td>
      </tr>
      <tr>
        <td >Jenis Kelamin</td>
        <td>
          <input  type="radio" name="jk" value="P"  /> Laki-laki 
          <input  type="radio" name="jk" value="W"  /> Wanita 
        </td>
      </tr>
      <tr>
        <td >Alamat</td>
        <td><input class="form-control"  type="text" name="alamat" value=""  placeholder="Isi Alamat Lengkap"/></td>
      </tr>
      <tr>
        <td >Pekerjaan</td>
        <td><input class="form-control"  type="text" name="pekerjaan" value="" placeholder="Isi Pekerjaan Anda" /></td>
      </tr>
      </tr>

      <tr>
        <td></td>
        <td></td>
        <td>
            <input name="simpan" type="submit" value="Lanjutkan">
            <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">   
        </td> 
      </tr>
    </table>
</form>
</div>
<?php } ?>