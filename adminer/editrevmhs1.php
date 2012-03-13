<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }

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
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<?php
$id_rev = $_POST['id'];
$id_jud = $_POST['id_ju'];
$key=$_POST['key'];
$field=$_POST['field'];
$urutan=$_POST['urutan'];
$halaman=$_POST['halaman'];
$urutan_rep=$_POST['urutan_rep'];
$rev_text = $_POST['review_text'];
$rev_text = trim($rev_text);
$rev_text = ereg_replace("(\r\n|\n|\r)", "",$rev_text);
$jbr = substr_count($rev_text,"<br>");
$cek=explode("<br>",$rev_text);
for ($i=0;$i<=$jbr;$i++)
{
	$rev=$rev.trim($cek[$i]);		
}

$NIM = $_POST['reviewer'];

if ($rev==NULL or $rev=='%')
{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='editrevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=editrevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
}
else
{
		$sql = mysql_query("UPDATE review_mhs set review='$rev_text' WHERE id_rev_mhs='$id_rev'");
		echo "
		<div id='warning'>
		<center><h1>Edit Post Berhasil</h1><br>";
		echo "Klik <a href='judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
}
?>
</div>
</body>
</html>
