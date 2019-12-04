<?php 
include("config/library.php");
include("config/koneksi.php");
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sistem Pakar Metode Certainty Factor (CF) Penyakit Gigi dan mulut - Download</title>
    <meta name="description" content="Program aplikasi Sistem Pakar Metode Certainty Factor (CF) Penyakit Sapi Perah" />
    <meta name="keywords" content="sp, sistem pakar, certainty factor, program, download, source code" />    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/normalize.css">

	<style>
      body {
      font-family: "Open Sans", sans-serif;
      height: 100vh;
      /* background: url("http://i.imgur.com/HgflTDf.jpg") 50% fixed; */
	  background:#333 url(assets/css/images/bg01.png);
      /* background-size: cover; */
    }
    
    @keyframes spinner {
      0% {
        transform: rotateZ(0deg);
      }
      100% {
        transform: rotateZ(359deg);
      }
    }
    * {
      box-sizing: border-box;
    }
    
    .wrapper {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      width: 100%;
      min-height: 100%;
      padding: 20px;
    }
    
    .login {
      border-radius: 2px 2px 5px 5px;
      padding: 10px 20px 20px 20px;
      width: 90%;
      max-width: 320px;
      background: #ffffff;
      position: relative;
      padding-bottom: 80px;
      box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
    }
    .login.loading button {
      max-height: 100%;
      padding-top: 50px;
    }
    .login.loading button .spinner {
      opacity: 1;
      top: 40%;
    }
    .login.ok button {
      background-color: #8bc34a;
    }
    .login.ok button .spinner {
      border-radius: 0;
      border-top-color: transparent;
      border-right-color: transparent;
      height: 20px;
      animation: none;
      transform: rotateZ(-45deg);
    }
    .login input {
      display: block;
      padding: 15px 10px;
      margin-bottom: 10px;
      width: 100%;
      border: 1px solid #ddd;
      transition: border-width 0.2s ease;
      border-radius: 2px;
      color: #ccc;
    }
    .login input + i.fa {
      color: #fff;
      font-size: 1em;
      position: absolute;
      margin-top: -47px;
      opacity: 0;
      left: 0;
      transition: all 0.1s ease-in;
    }
    .login input:focus {
      outline: none;
      color: #444;
      border-color: #2196F3;
      border-left-width: 35px;
    }
    .login input:focus + i.fa {
      opacity: 1;
      left: 30px;
      transition: all 0.25s ease-out;
    }
    .login a {
      font-size: 0.8em;
      color: #2196F3;
      text-decoration: none;
    }
    .login .title {
      color: #444;
      font-size: 1.2em;
      font-weight: bold;
      margin: 10px 0 30px 0;
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
    }
    .login button {
      width: 100%;
      height: 100%;
      padding: 10px 10px;
      background: #FF3737;
      color: #fff;
      display: block;
      border: none;
      margin-top: 20px;
      position: absolute;
      left: 0;
      bottom: 0;
      max-height: 60px;
      border: 0px solid rgba(0, 0, 0, 0.1);
      border-radius: 0 0 2px 2px;
      transform: rotateZ(0deg);
      transition: all 0.1s ease-out;
      border-bottom-width: 7px;
    }
    .login button .spinner {
      display: block;
      width: 40px;
      height: 40px;
      position: absolute;
      border: 4px solid #ffffff;
      border-top-color: rgba(255, 255, 255, 0.3);
      border-radius: 100%;
      left: 50%;
      top: 0;
      opacity: 0;
      margin-left: -20px;
      margin-top: -20px;
      animation: spinner 0.6s infinite linear;
      transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
      box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
    }
    .login:not(.loading) button:hover {
      box-shadow: 0px 1px 3px #FF1C1C;
    }
    .login:not(.loading) button:focus {
      border-bottom-width: 4px;
    }
    
    footer {
      display: block;
      padding-top: 50px;
      text-align: center;
      color: #ddd;
      font-weight: normal;
      text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
      font-size: 0.8em;
    }
    footer a, footer a:link {
      color: #fff;
      text-decoration: none;
    }
    </style>
	<script src="assets/js/prefixfree.min.js"></script>
  
  </head>
  <body>
	<?php
	if(@$_POST['username']) {
		
		opendb();
		$username=antiinjec(@$_POST['username']);
		$password=md5(@$_POST['password']);
		
		$query="SELECT id_pengguna, username, tipe FROM cf_pengguna WHERE username='$username' AND password='$password'";
		$hasil=querydb($query);
		$userjum=mysql_fetch_array($hasil);
		if ($userjum['username']<>"") {
			$_SESSION['ses_nama_pengguna']=$userjum['username'];
			$_SESSION['ses_tipe_pengguna']=$userjum['status'];
			?>
			<script language="JavaScript">document.location='./'</script>
			<?php
		} else {
			?>
			<script language="JavaScript">
			document.location='login.php?salah=ya'</script>
			<?php
		}
		closedb();
	}
    ?>
   
  <div class="wrapper">
  <form class="login" action="" method="post" enctype="multipart/form-data">
        <p class="title">Log in | SISTEM PAKAR</p>
		<?php if(@$_GET['salah']!="") { ?><p style="text-align:left; font-size:12px; margin-top:10px; color:#FF1717;">Username atau password salah.</p><?php } ?>
        <input type="text" name="username" placeholder="Username" autofocus/>
        <i class="fa fa-user"></i>
        <input type="password" name="password" placeholder="Password" />
        <i class="fa fa-key"></i>
        <button onClick="submit();">
          <i class="spinner"></i>
         <span class="state">Log in</span>
       </button>
        <span style="font-size:11px;">
        
        </span>
  </form>
  <footer>
  <a href="http://aplikasi-sistem-pakar-metode-certainty-factor.htm" target="_blank">SP Metode Certainty Factor</a><br>
    <a href="http://aplikasi-sistem-pakar-metode-certainty-factor.htm" target="_blank">belum mempunyai akun?</a><br>
      <a href="daftar.php" target="_blank">Klik Disini</a><br>


  </footer>
  </p>
	</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="assets/js/index.js"></script>
  </body>
</html>
