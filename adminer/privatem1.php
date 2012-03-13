<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }
  
include "cekonline.php";?> 
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
$key=$_POST['key'];
$field=$_POST['field'];
$urutan=$_POST['urutan'];
$id_jud=$_POST['id_ju'];
$halaman=$_POST['halaman'];
$urutan_rep=$_POST['urutan_rep'];
//------------
$kode=$_POST['kode'];
$init=$_POST['rcp'];
$id_rev=$_POST['id_rev'];
$isi= strip_tags($_POST['private']);
$isi = trim($isi);
//$isi = htmlentities($isi);

//----------------
$aktif=$_POST['cari'];
$pen=$_POST['penerima'];
$rec=$_POST['receiver'];
$waktu=date("H:i:s");

if ($isi == NULL or $isi == '%')
{
	echo "
		<div id='warning'>
		<center><h1>Pesan bernilai kosong</h1><br>";
		echo "Klik <a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'></center></div>";
}
else
{
	if ($aktif=="ad")
	{
		if ($pen=="" or $rec=="")
			{
				echo "
				<div id='warning'>
				<center><h1>Anda telah mengaktifkan penerima lain namun bernilai kosong</h1><br>";
				echo "Klik <a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'></center></div>";		
			}
		else
			{
				$nama_acc=$rec;
				if ($nama_acc==$_SESSION['user_nama'])
				{
					echo "
					<div id='warning'>
					<center><h1>Admin DODOL, tidak bisa kirim ke diri sendiri</h1><br>";
					echo "Klik <a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'></center></div>";
				}	
				else
				{
				$sql = "INSERT INTO pesan_pribadi_mini(pengirim, penerima, tanggal, waktu, pesan, status_pesan) values 
				('$_SESSION[user_nama]', '$nama_acc', NOW(), '$waktu', '$isi', '0')";
				$insert=mysql_query($sql);
				echo "
				<div id='warning'>
				<center><h1>Private Message Berhasil Dikirim</h1><br>";
				echo "Klik <a href='judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";								
				}
			}
	}
	else
	{
		$nama_acc=$init;
		if ($nama_acc==$_SESSION['user_nama'])
				{
					echo "
					<div id='warning'>
					<center><h1>Admin DODOL, tidak bisa kirim ke diri sendiri</h1><br>";
					echo "Klik <a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Private Message<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$init&id_rev=$id_rev&kode=$kode&urutan_rep=$urutan_rep'></center></div>";
				}	
				else
				{
		$sql = "INSERT INTO pesan_pribadi_mini(pengirim, penerima, tanggal, waktu, pesan, status_pesan) values 
		('$_SESSION[user_nama]', '$nama_acc', NOW(), '$waktu', '$isi', '0')";
		$insert=mysql_query($sql);
		echo "
				<div id='warning'>
				<center><h1>Private Message Berhasil Dikirim</h1><br>";
				echo "Klik <a href='judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";								
			}
	}
}
	
	
		

?>

</body>
</html>
