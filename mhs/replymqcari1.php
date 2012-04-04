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
 include "cekonline.php";  
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
$key = $_POST['key'];
$field = $_POST['field'];
$halaman = $_POST['halaman'];
$urutan = $_POST['urutan'];
$id_jud = $_POST['id_ju'];
$urutan_rep=$_POST['urutan_rep'];
$id_rev=$_POST['id_rev'];
$waktu=date("H:i:s");

if ($revi==NULL or $revi=='%')
{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='replymqcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=replymqcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep''></center></div>";
}
else
{
		$no = mysql_query
				("INSERT INTO review_mhs (id_judul, NIM, review, tanggal, waktu, status)
				 values ('$id_jud', '$initid', '$rev_text', NOW(), '$waktu', '0')");
		echo "
		<div id='warning'>
		<center><h1>New Post berhasil</h1><br>";
		echo "Klik <a href='reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#bottom'>ini</a> untuk kembali ke menu Review Praoutline<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#bottom'></center></div>";
}
?>
</body>
</html>

