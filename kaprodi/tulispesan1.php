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
$receiver=$_POST['receiver'];
$isi = $_POST['private'];
$isi = trim($isi);
$isi = ereg_replace("(\r\n|\n|\r)", "",$isi);
$jbr = substr_count($isi,"<br>");
$cek=explode("<br>",$isi);
for ($i=0;$i<=$jbr;$i++)
{
	$has=$has.trim($cek[$i]);		
}
$waktu=date("H:i:s");


if (($has==NULL or $has=='%') or ($receiver==""))
{
	echo
	"
	<div id='warning'><center>
	<h2>Isi pesan atau nama penerima bernilai kosong</h2><br>Klik <a href='tulispesan.php'>ini</a> untuk kembali menu Private Message";
	echo "<meta http-equiv='refresh' content='3;URL=tulispesan.php'></center><br></div>";
}
else
{
	if ($receiver==$_SESSION['kapro'])
	{
	echo
	"
	<div id='warning'><center>
	<h2>Anda tidak bisa mengirim pesan ke diri sendiri</h2><br>Klik <a href='tulispesan.php'>ini</a> untuk kembali menu Private Message";
	echo "<meta http-equiv='refresh' content='3;URL=tulispesan.php'></center><br></div>";
	}
	else
	{
	$sql = mysql_query
	("INSERT INTO pesan_pribadi_mini (pengirim, penerima, tanggal, waktu, pesan) 
	values ('$_SESSION[kapro]','$receiver',NOW(), '$waktu', '$isi')");
	echo
			"
			<div id='warning'><center>
			<h2>Private Message berhasil dikirim</h2><br>Klik <a href='tulispesan.php'>ini</a> untuk kembali menu Private Message";
			echo "<meta http-equiv='refresh' content='3;URL=tulispesan.php'></center><br></div>";
	}
}

?>

</body>
</html>
