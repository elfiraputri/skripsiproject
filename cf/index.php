<?php
include "config/library.php";
include "config/koneksi.php";
opendb();
$hal=antiinjec(@$_GET['hal']);

$ses_nama_pengguna=@$_SESSION['ses_nama_pengguna'];
if($ses_nama_pengguna=="")
{ 
	header("location:login.php");
} else { 
	$queryadm="SELECT * FROM cf_pengguna WHERE username='$ses_nama_pengguna'";
	$hasiladm=querydb($queryadm);
	$dataadm=mysql_fetch_array($hasiladm);
	$tipen=0;
	if($dataadm['tipe']==1) { $tipe_pengguna="Pakar"; $tipen=1; }
	elseif($dataadm['tipe']==2) { $tipe_pengguna="Konsultan"; $tipen=2; }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Sistem Pakar - Gigi Dan Mulut</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Program aplikasi Sistem Pakar Metode Certainty Factor (CF) Penyakit Gigi dan Mul\ut" />
        <meta name="keywords" content="sp, sistem pakar, certainty factor, program, download, source code" />    
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script type="text/javascript" src="assets/js/jquery.min_2.js?ver=3.1.2"></script>
        <script type="text/javascript" src="assets/js/custom.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
	</head>
	<body>

		<!-- Content -->
			<div id="content">
				<div class="inner">
					<?php 
					if($hal=="penyakit") { include "data_penyakit.php"; }
					elseif($hal=="penyakit-input") { include "input_penyakit.php"; }
					elseif($hal=="gejala") { include "data_gejala.php"; }
					elseif($hal=="gejala-input") { include "input_gejala.php"; }
					elseif($hal=="basis") { include "data_basis.php"; }
					elseif($hal=="basis-input") { include "input_basis.php"; }
					elseif($hal=="pengguna") { include "data_pengguna.php"; }
					elseif($hal=="pengguna-input") { include "input_pengguna.php"; }
					elseif($hal=="konsultasi") { include "konsultasi.php"; }
					elseif($hal=="konsultasi-gejala") { include "konsultasi_gejala.php"; }
					elseif($hal=="konsultasi-hasil") { include "konsultasi_hasil.php"; }
					elseif($hal=="konsultasi-selesai") { include "konsultasi_selesai.php"; }
					elseif($hal=="konsultasi-list") { include "data_konsultasi.php"; }
					elseif($hal=="konsultasi-view") { include "data_konsultasi_view.php"; }
					elseif($hal=="ubah-password") { include "input_password.php"; }
					else{ include "home.php"; }
					?>
				</div>
			</div>

		<!-- Sidebar -->
			<div id="sidebar">

				<!-- Logo -->
					<h1 id="logo"><a href="#"><span style="font-size:0.73em">RSUD</span> Bangkalan</a></h1>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li <?php if($hal=="") { echo "class='current'"; } ?>><a href="./">Beranda</a></li>
							<?php if($tipen==1) { ?>
							<li <?php if($hal=="penyakit" || $hal=="penyakit-input") { echo "class='current'"; } ?>><a href="?hal=penyakit">Data Penyakit</a></li>
							<li <?php if($hal=="gejala" || $hal=="gejala-input") { echo "class='current'"; } ?>><a href="?hal=gejala">Data Gejala</a></li>
                            <li <?php if($hal=="konsultasi-list" || $hal=="konsultasi-view") { echo "class='current'"; } ?>><a href="?hal=konsultasi-list">Daftar Konsultasi</a></li>
							
                            <li <?php if($hal=="basis" || $hal=="basis-input") { echo "class='current'"; } ?>><a href="?hal=basis">Basis Pengetahuan</a></li>
                            <li <?php if($hal=="pengguna" || $hal=="pengguna-input") { echo "class='current'"; } ?>><a href="?hal=pengguna">Data Pengguna</a></li>
							
                            <li><a>&nbsp;</a></li>
							<?php } ?>
                            <li <?php if($hal=="konsultasi" || $hal=="konsultasi-gejala") { echo "class='current'"; } ?>><a href="?hal=konsultasi">Konsultasi</a></li>
							<li <?php if($hal=="konsultasi-hasil") { echo "class='current'"; } ?>><a href="?hal=konsultasi-hasil">Hasil Konsultasi</a></li>
							
						</ul>
					</nav>

				<!-- Copyright -->
                	<div id="copyright">
                    	<p>
                        	User : <?php echo $dataadm['nama']; ?> [<?php echo $tipe_pengguna; ?>]<br>
                            <a href="?hal=ubah-password">Ubah Password</a> | <a href="logout.php">Logout</a><br>
                            <div style="border-bottom:1px solid #2dafff;"></div>
                 
                            <a href="http://aplikasi-sistem-pakar-metode-certainty-factor.htm" target="_blank">SP Metode Certainty Factor</a><br>
                          
                        </p>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
            				<a href="login.php" target="_blank"><button type="button" class="btn btn-default navbar-btn">Menu Admin</button></a>      
    					</ul>
					
			</div>

			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php closedb(); } ?>