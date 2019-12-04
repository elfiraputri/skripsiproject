<!DOCTYPE HTML>
<html>
  <head>
    <title>Sistem Pakar - Gigi Dan Mulut</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Program aplikasi Sistem Pakar Metode Certainty Factor (CF) Penyakit Gigi dan Mulut" />
        <meta name="keywords" content="sp, sistem pakar, certainty factor, program, download, source code" />    
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <script type="text/javascript" src="assets/js/jquery.min_2.js?ver=3.1.2"></script>
        <script type="text/javascript" src="assets/js/custom.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
  </head>
  <body>

<?php if(isset($_SESSION['sesi_hasil'])) { ?>
  <script language="JavaScript">document.location='?hal=konsultasi-hasil'; </script>
<?php } elseif(isset($_SESSION['sesi_konsultasi'])) { ?>
  <script language="JavaScript">document.location='login.php'; </script>
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
    <table width="100%" cellpadding="30" cellspacing="0" border="1" class="pad">
        <tr>
        <td >Nama</td>
        <td><input class="form-control"  type="text" name="nama" value="" placeholder="Isi Nama Lengkap" /></td>
      </tr>
       <td >Username</td>
        <td><input class="form-control"  type="text" name="nama" value="" placeholder="Isi username" /></td>
      </tr>
         <td >Password</td>
        <td><input class="form-control"  type="text" name="nama" value="" placeholder="Isi password" /></td>
      </tr>
      </tr>
      <tr>
        <td >Jenis Kelamin</td>
        <td><input  type="radio" name="jk" value="P"  /> Laki-laki 
          <input  type="radio" name="jk" value="W"  /> Wanita 
        </td>
      </tr>
      

      <tr>
        <td></td>
        <td></td>
        <td>
            <input name="simpan" type="submit" value="Daftar">
            <input name="batal" type="button" value="Batal" onclick="self.history.back()" class="red">   
        </td> 
      </tr>
    </table>
</form>
</div>
<?php } ?>