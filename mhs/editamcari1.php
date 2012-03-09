<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
 $rand = session_id();
if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']);  
 //--------------------  
  $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$initid'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$initid'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$initid'");
 session_destroy();
 header("Location: ../index.php");
 }
 $ubah = mysql_query("UPDATE online_user SET sta='0' WHERE ((UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tm))/60) > 10");                                                                     	
//------------------------------  
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<?php
$rev_text = $_POST['review_text'];
$rev_text = trim($rev_text);
$rev_text = htmlentities($rev_text);

$key = $_POST['key'];
$field = $_POST['field'];
$halaman = $_POST['halaman'];
$urutan = $_POST['urutan'];
$id_rev = $_POST['id'];
$id_jud = $_POST['id_ju'];
$urutan_rep=$_POST['urutan_rep'];

if ($rev_text==NULL or $rev_text=='%')
{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='editamcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=editamcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep''></center></div>";
}
else
{
		$sql = mysql_query("UPDATE review_mhs set review='$rev_text' WHERE id_rev_mhs='$id_rev'");
		echo "
		<div id='warning'>
		<center><h1>Edit Post berhasil</h1><br>";
		echo "Klik <a href='reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke menu Review Praoutline<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";
}
?>


</body>
</html>

