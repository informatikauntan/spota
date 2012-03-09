<?php
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['kapro']))
  {
	header("Location: index.php");
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<br>
<?php
$id=$_POST['id'];
$halaman=$_POST['halaman'];
$punya=$_POST['nim'];
$urutan=$_POST['urutan'];
$isi = trim($_POST['private']);
$cek=$_POST['cek'];
$jum=count($cek);
$waktu=date("H:i:s");
if (($isi==NULL or $isi=='%') or ($cek==""))
{
	echo
	"
	<div id='warning'><center>
	<h2>Isi pesan atau penerima bernilai kosong</h2><br>Klik <a href='lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'>ini</a> untuk kembali menu sebelumnya";
	echo "<meta http-equiv='refresh' content='3;URL=lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'></center><br></div>";
}
else
{
for($i=0;$i<$jum;$i++)
{
	mysql_query("INSERT INTO pesan_pribadi_mini (pengirim, penerima, tanggal, waktu, pesan, status_pesan) 
	values ('kaprodi','$cek[$i]', NOW(), '$waktu', '$isi', '0')");
}
	echo
	"
	<div id='warning'><center>
	<h2>Pesan berhasil dikirim</h2><br>Klik <a href='lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'>ini</a> untuk kembali menu sebelumnya";
	echo "<meta http-equiv='refresh' content='3;URL=lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'></center><br></div>";
}
?>
</div>
</body>
</html>
