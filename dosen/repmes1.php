<?php
include "../sambung.inc.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($initid))
  {
	header("Location: index.php");
  }
//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[nipdos]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[nipdos]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[nipdos]'");
 session_destroy();
 header("Location: index.php");
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
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
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
$halaman=$_POST['halaman'];
$nama=$_POST['namarec'];
$idpesan=$_POST['id'];

if ($has==NULL or $has=='%')
{
	echo
	"
	<div id='warning'><center>
	<h2>Isi pesan bernilai kosong</h2><br>Klik <a href='repmes.php?idp=$receiver&nama=$nama&halaman=$halaman&idpesan=$idpesan'>ini</a> untuk kembali menu Inbox Message";
	echo "<meta http-equiv='refresh' content='3;URL=repmes.php?idp=$receiver&nama=$nama&halaman=$halaman&idpesan=$idpesan'></center><br></div>";
}
else
{

	$sql = mysql_query
	("INSERT INTO pesan_pribadi_mini (pengirim, penerima, tanggal, waktu, pesan) 
	values ('$initid','$receiver',NOW(), '$waktu', '$isi')");
	echo
			"
			<div id='warning'><center>
			<h2>Reply Private Message berhasil dikirim</h2><br>Klik <a href='inbox.php?halaman=$halaman&id=$idpesan&dari=$nama'>ini</a> untuk kembali menu Private Message";
			echo "<meta http-equiv='refresh' content='3;URL=inbox.php?halaman=$halaman&id=$idpesan&dari=$nama'></center><br></div>";
	
}

?>
</body>
</html>

