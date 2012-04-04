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
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<?php
//$urutan=$_POST['urutan'];
$init=$_POST['rcp'];
$id_jud=$_POST['id_ju'];
$urutan_rep=$_POST['urutan_rep'];
//$kode=$_POST['kode'];
$urutan=$_POST['urutan'];
$halaman=$_POST['halaman'];
$key=$_POST['key'];
$field=$_POST['halaman'];
$isi= $_POST['private'];
$isi = trim($isi);
$isi = ereg_replace("(\r\n|\n|\r)", "",$isi);
$jbr = substr_count($isi,"<br>");
$cek=explode("<br>",$isi);
for ($i=0;$i<=$jbr;$i++)
{
	$has=$has.trim($cek[$i]);		
}
//----------
$aktif=$_POST['cari'];
$pen=$_POST['penerima'];
$rec=$_POST['receiver'];
$waktu=date("H:i:s");


if ($has == NULL or $has == '%')
{
	echo "
		<div id='warning'>
		<center><h1>Pesan bernilai kosong</h1><br>";
		echo "Klik <a href='privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'></center></div>";
}
else
{
	if ($aktif=="ad")
	{
		if ($pen=="" or $rec=="")
			{
				echo "
				<div id='warning'>
				<center><h1>Anda telah mengaktifkan penerima lain namun tidak memilih penerima</h1><br>";
				echo "Klik <a href='privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'></center></div>";
			}
		else
			{
				$nama_acc=$rec;
				if ($nama_acc==$initid)
				{
					echo "
					<div id='warning'>
					<center><h1>Pesan tidak bisa kirim ke diri sendiri</h1><br>";
					echo "Klik <a href='privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'></center></div>";
				}
				else
				{
				$sql = "INSERT INTO pesan_pribadi_mini(pengirim, penerima, tanggal, waktu, pesan, status_pesan) values 
				('$initid', '$nama_acc', NOW(), '$waktu', '$isi', '0')";
				$insert=mysql_query($sql);
				echo "
				<div id='warning'>
				<center><h1>Private Message Berhasil Dikirim</h1><br>";
				echo "Klik <a href='reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke menu Review Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";
				}
			}
	}
	else
	{
		$nama_acc=$init;
		if ($nama_acc==$initid)
				{
					echo "
					<div id='warning'>
					<center><h1>Pesan tidak bisa kirim ke diri sendiri</h1><br>";
					echo "Klik <a href='privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=privatemcari.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&urutan_rep=$urutan_rep'></center></div>";
				}
				else
				{
		$sql = "INSERT INTO pesan_pribadi_mini(pengirim, penerima, tanggal, waktu, pesan, status_pesan) values 
		('$initid', '$nama_acc', NOW(), '$waktu', '$isi', '0')";
		$insert=mysql_query($sql);
		echo "
				<div id='warning'>
				<center><h1>Private Message Berhasil Dikirim</h1><br>";
				echo "Klik <a href='reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke menu Review Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=reviewmhs2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";
				}
	}
}
?>

</body>
</html>

