<?php
include "../sambung.inc.php";
include "converttanggal.php";
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
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
</div>
<?php
$id=$_POST['id'];
$halaman=$_POST['halaman'];
$nim=$_POST['nim'];
$put=$_POST['put'];
if ($put==NULL)
{
echo
	"
	<div id='warning'><center>
	<h2>Status tidak dipilih</h2><br>Klik <a href='lbhjauh.php?id=$id&halaman=$halaman&punya=$nim'>ini</a> untuk kembali menu Ubah Status";
	echo "<meta http-equiv='refresh' content='3;URL=lbhjauh.php?id=$id&halaman=$halaman&punya=$nim'></center><br></div>";
}
else
{
	if ($put=="2")
		{
		$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id'");  
		$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='2' WHERE NIM='$nim'");
		echo
			"
				<div id='warning'><center>
				<h2>Status berhasil diubah</h2><br>Klik <a href='kaprodi.php'>ini</a> untuk kembali halaman utama";
				echo "<meta http-equiv='refresh' content='3;URL=kaprodi.php'></center><br></div>";
		}
	else if ($put=="0")
		{
		$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id'");  
		$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='0' WHERE NIM='$nim'");
		echo
			"
				<div id='warning'><center>
				<h2>Status berhasil diubah</h2><br>Klik <a href='kaprodi.php'>ini</a> untuk kembali halaman utama";
				echo "<meta http-equiv='refresh' content='3;URL=kaprodi.php'></center><br></div>";
		}
	else
		{
		echo
			"
				<div id='warning'><center>
				<h2>Status berhasil diubah</h2><br>Klik <a href='kaprodi.php'>ini</a> untuk kembali halaman utama";
				echo "<meta http-equiv='refresh' content='3;URL=kaprodi.php'></center><br></div>";		
		}	
}
?>
</body>
</html>