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
<?php
$id=$_POST['id'];
$halaman=$_POST['halaman'];
$punya=$_POST['nim'];
$urutan=$_POST['urutan'];
$put=$_POST['put'];
$judul_out=trim($_POST['judul_out']);
$dos1=$_POST['dos1'];
$dos2=$_POST['dos2'];
$dos3=$_POST['dos3'];
$dos4=$_POST['dos4'];
$waktu=date("H:i:s");
$sem=$_POST['sem'];
$tahun=$_POST['tahun'];
if ($put==NULL)
{
	echo
	"
	<div id='warning'><center>
	<h2>Status tidak dipilih</h2><br>Klik <a href='lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'>ini</a> untuk kembali menu Ubah Status";
	echo "<meta http-equiv='refresh' content='3;URL=lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'></center><br></div>";	
}
else
{
	if ($sem==NULL or $tahun=="")
	{
	echo
	"
	<div id='warning'><center>
	<h2>Semester atau tahun ajaran tidak dipilih</h2><br>Klik <a href='lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'>ini</a> untuk kembali menu Ubah Status";
	echo "<meta http-equiv='refresh' content='3;URL=lbhjauh.php?id=$id&halaman=$halaman&punya=$punya#tambahan'></center><br></div>";	
	}
	else
	{			
		if ($put=="1")
		{
		$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id'");  
		$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='2' WHERE NIM='$punya'");
		mysql_query(
		"INSERT into rekap (id_judul, NIM, kep_akhir, judul_out, pemb1, pemb2, peng1, peng2, tanggal, waktu, semester, tahun_aj)
		values ('$id','$punya', '1', '$judul_out', '$dos1','$dos2','$dos3','$dos4', NOW(), '$waktu', '$sem', '$tahun')");
		}
		if ($put=="0")
		{
		$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id'");  
		$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='0' WHERE NIM='$punya'");	
		mysql_query(
		"INSERT into rekap (id_judul, NIM, kep_akhir, judul_out, pemb1, pemb2, peng1, peng2, tanggal, waktu, semester, tahun_aj)
		values ('$id','$punya', '0', '', '','','','', NOW(), '$waktu', '$sem', '$tahun')");	
		}
		echo
			"
				<div id='warning'><center>
				<h2>Status berhasil diubah</h2><br>Klik <a href='kaprodi.php'>ini</a> untuk kembali halaman utama";
				echo "<meta http-equiv='refresh' content='3;URL=kaprodi.php'></center><br></div>";					
	}
}

?>
</div>
</body>
</html>
