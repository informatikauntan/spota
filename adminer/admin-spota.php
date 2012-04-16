<?php 
include "../sambung.inc.php";
session_start();
if (!isset($_SESSION['user_nama'])) {
	header("Location: index.php");
}

//---------------------  
$ip=$_SERVER['REMOTE_ADDR'];
$now=date("Y-m-d H:i:s");
/*
//kelihatannya blok ini tidak dipakai
$query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[user_nama]'");
$cek = mysql_fetch_array($query);
$dul=strtotime($cek['tm']);
$skr=strtotime($now);
$dif=(integer)$skr-$dul;
*/
$sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[user_nama]'"); 

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
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php
include "menu.php"; 
$val = $_GET['part'];
if ($val=='setdatdos')
{
	include "setdatdos.php";
}
else if ($val=='pasdos')
{
	include "genpasdos.php";
}
else if ($val=='setdatmhs')
{
	include "setdatmhs.php";
}
else if ($val=='pasmhs')
{
	include "genpasmhs.php";
}
else if ($val=='judul')
{
	include "judulpra_asli.php";
}
else
{
	$sql=mysql_query("SELECT id_rev_mhs FROM review_mhs WHERE status='0'");
	$jum=mysql_num_rows($sql);
	
	$sqlon = "SELECT id FROM online_user WHERE sta='1'";
	$queryon = mysql_query($sqlon);
	$jummhs = 0;
	$jumdos = 0;
	while ($tam = mysql_fetch_array($queryon)) {
		if (substr($tam['id'],0,1)=="D") {
			$sqlmhs = "SELECT NIM FROM data_mahasiswa WHERE NIM='$tam[id]'";
			$querymhs = mysql_query($sqlmhs);		
			$jummhs += mysql_num_rows($querymhs);
		}
		else if (substr($tam['id'],0,1)=="1") {
			$sqldos = "SELECT NIP FROM data_dosen WHERE NIP='$tam[id]'";
			$querydos = mysql_query($sqldos);
			$jumdos += mysql_num_rows($querydos);
		}
	}
?>
	<div id="inde">
	<div id="whos">
	  <table width="60%" align="center">
		<tr align="center" bgcolor="#3E6497">
		  <th>Jumlah Dosen dan Mahasiswa yang sedang ONLINE</th>
		</tr>
		<tr align="center">
		  <td>Dosen : <b><?php echo $jumdos;?></b> :: Mahasiswa : <b><?php echo $jummhs;?></b></td>
		</tr>    
	</table>
	<br>
	<table align="center">
	  <tr align="center" bgcolor="#6C0606">
		<th>Review Mahasiswa</th>
	  </tr>
	  <tr align="center">
		<td>Terdapat <a href="tamrevmhs.php"><?php echo $jum;?></a> <b>review mahasiswa</b> baru</td>
	  </tr>
	</table>
	
	</div>
	</div>
	<div id="footer">
	<?php include "../footer.php"; ?>
	</div>
<?php
}
?>
</div>
</body>
</html>