<?php
session_start();
unset($_SESSION['ses_nama_pengguna']);
unset($_SESSION['ses_tipe_pengguna']);
?>
<script language="JavaScript">document.location='login.php'</script>