<?php
include "../sambung.inc.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($_SESSION['nipdos']))
  {
	header("Location: dosen-spota.php");
  }

//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[nipdos]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[nipdos]'"); 
 
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
<?php include "menu.php"; ?>
</div>
<?php
	$sql="SELECT id, 
	judul_praoutline,status_review, COUNT(IF(reviewer='" . $initid . "',1,NULL)) as 'P' 
	FROM upload_mhs LEFT JOIN review_praoutline on id=id_upload 
	GROUP BY id HAVING P=0 and status_review='1'";
	$hasil = mysql_query($sql);
	$jum = mysql_num_rows($hasil);
	
	$sqla=mysql_query("SELECT id_upload, reviewer FROM 
	review_praoutline, upload_mhs 
	where id_review IN (SELECT MAX(id_review) as 'MM' FROM review_praoutline GROUP by id_upload) 
	and id=id_upload 
	and status_review='1' 
	and reviewer<>'$initid'");
	$juma= mysql_num_rows($sqla);
	
	$sqlb=mysql_query("SELECT DISTINCT(id_upload) as 'New', judul_praoutline 
	FROM review_praoutline, upload_mhs 
	WHERE id_upload NOT IN (SELECT id_upload FROM review_praoutline, upload_mhs WHERE id=id_upload and jenis_rev='1' and reviewer='$initid' ORDER by id_upload) 
	and id=id_upload 
	and status_review='1'");
	$jumb=mysql_num_rows($sqlb);
	
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
    <th>Desain Praoutline BARU</th>
  </tr>
  <tr align="center">
    <td>Terdapat <a href="recent.php?mode=new"><?php echo $jum;?></a> <b>desain praotline</b> yang belum anda REVIEW</td>
  </tr>
</table>
</div>
<div id="newp">
<table>
  <tr align="center" bgcolor="#4F642D">
    <th>Reply BARU</th>
  </tr>
  <tr align="center">
    <td>Terdapat <a href="recent.php?mode=rep"><?php echo $juma;?></a> <b>reply</b> yang belum anda lihat</td>
  </tr>
</table>
</div>
<div id="nodes">
	<table width="60%" align="center">
	  <tr align="center" bgcolor="#765900">
		<th>Desain Praoutline Tidak Berputusan</th>
	  </tr>
	  <tr align="center">
		<td>Terdapat <a href="recent.php?mode=nodes"><?php echo $jumb;?></a> <b>desain praotline</b> yang belum anda berikan keputusan</td>
	  </tr>
	</table>
</div>
</div>

<div id="footer">
	<p>Copyright 2008 - Teknik Informatika - Universitas Tanjungpura</p>
</div>
</body>
</html>