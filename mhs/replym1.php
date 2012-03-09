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
$rev_text = ereg_replace("(\r\n|\n|\r)", "",$rev_text);
$jbr = substr_count($rev_text,"<br>");
$cek=explode("<br>",$rev_text);
for ($i=0;$i<=$jbr;$i++)
{
	$revi=$revi.trim($cek[$i]);		
}
$id_jud = $_POST['id_ju'];
$urutan_rep=$_POST['urutan_rep'];
$waktu=date("H:i:s");
//$no=$_POST['ter'];

if ($revi==NULL or $revi=='%')
{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='replym.php?id_jud=$id_jud&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu New Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=replym.php?id_jud=$id_jud&urutan_rep=$urutan_rep'></center></div>";
}
else
{
		$no = mysql_query
				("INSERT INTO review_mhs (id_judul, NIM, review, tanggal, waktu, status)
				 values ('$id_jud', '$initid', '$rev_text', NOW(), '$waktu', '0')");
		echo "
		<div id='warning'>
		<center><h1>New POST berhasil dikirim</h1><br>";
		echo "Post akan diaktifkan setelah beberapa hari<br>Klik <a href='hasilrev1.php?id_jud=$id_jud#bottom'>ini</a> untuk kembali ke Review Praoutline<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#bottom'></center></div>";
}
?>
</body>
</html>
