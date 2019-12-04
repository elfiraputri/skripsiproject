<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$root_url="http://localhost/TA/SK%20Fahry%20-%20UBhayangkaraSby%20September%202015%20(Marketing%20Terbaik%20+%20TOPSIS)/topsis";

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$set_judul = "Pemilihan Marketing Terbaik";
$set_judul_sub = "Pemilihan Marketing Terbaik Berdasarkan Key Performance 
				  Indicator Menggunakan Metode TOPSIS pada PT. Asuransi
				  Sinarmas Cabang Surabaya";
$set_alternatif = "Marketing";				  
				  

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
							
function antiinjec($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}
$tgl_full=date("Y-m-d H:i:s");

$sesinf_adminid=1;

function tgl_waktu($data){
	$tgl_waktu=date("d-m-Y H:i:s", strtotime($data));
	return $tgl_waktu;
}
?>
