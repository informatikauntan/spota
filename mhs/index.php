<?php 
include "../sambung.inc.php";
session_start();
$rand = session_id();
if (!isset($_SESSION['nim'])) {
	header("Location: ../index.php");
}
$initid=strtoupper($_SESSION['nim']);  
//--------------------
$ip=$_SERVER['REMOTE_ADDR'];
$now=date("Y-m-d H:i:s");
/*
//kelihatannya blok ini tidak dipakai
$query = mysql_query("SELECT * FROM online_user WHERE id='$initid'");
$cek = mysql_fetch_array($query);
$dul=strtotime($cek['tm']);
$skr=strtotime($now);
$dif=(integer)$skr-$dul;
*/
$sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$initid'");	

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
</head>
<body class="mhs">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
</div>
<?php
	$sql = mysql_query("SELECT COUNT(IF(status_pesan='0',1,NULL)) as 'A' FROM pesan_pribadi_mini WHERE penerima='$initid'");
	$hasil = mysql_fetch_array($sql);
	
	$sqldul=mysql_query
	("SELECT id, COUNT(id_upload) as 'P' FROM upload_mhs, review_praoutline 
	WHERE id=id_upload and NIM='$initid' and status_review='1' GROUP by id_upload");
	$pan=mysql_fetch_array($sqldul);
	
	
	$sqla=mysql_query(
	"SELECT id_review, 
	reviewer , 
	nama_dosen FROM 
	data_dosen, upload_mhs, review_praoutline 
	where id_review IN (SELECT MAX(id_review) as 'MM' FROM review_praoutline WHERE id_upload='$pan[id]') 
	and NIM='$initid' and status_review='1' and data_dosen.NIP=review_praoutline.reviewer");
	$r=mysql_fetch_array($sqla);
	$jum=mysql_num_rows($sqla);
	
	$warni = ($jum!==0? 
	"Reply Terbaru dari <b>$r[nama_dosen]</b><br>Klik <a href='hasilrev1.php?id_jud=$pan[id]#$pan[P]'>ini</a> untuk menuju hasil review" : "Tidak terdapat reply baru");
	
	$sqlon = "SELECT id FROM online_user WHERE sta='1'";
	$queryon = mysql_query($sqlon);
	$jummhs = 0;
	$jumdos = 0;
	while ($tam = mysql_fetch_array($queryon))
	{
	if (substr($tam['id'],0,1)=="D")
	{
		$sqlmhs = "SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$tam[id]'";
		$querymhs = mysql_query($sqlmhs);		
		$jummhs += mysql_num_rows($querymhs);
	}
	if (substr($tam['id'],0,1)=="1")
	{
		$sqldos = "SELECT nama_dosen FROM data_dosen WHERE NIP='$tam[id]'";
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
</div>
<div id="newd">
<table>
  <tr align="center" bgcolor="#6C0606">
    <th>Reply BARU</th>
  </tr>
  <tr align="center">
    <td><?php echo $warni;?></td>
  </tr>
</table>

</div>
<div id="newp">
<table>
  <tr align="center" bgcolor="#4F642D">
    <th>Pesan Baru</th>
  </tr>
  <tr align="center">
    <td>Terdapat <a href="inbox.php"><?php echo $hasil['A'];?></a> <b>pesan</b> yang belum anda baca</td>
  </tr>
</table>
</div>
</div>
<div id="footer">
	<p>Copyright 2008 - Teknik Informatika - Universitas Tanjungpura</p>
</div>
</body>
</html>


