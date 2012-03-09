<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }
  
//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[user_nama]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[user_nama]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[user_nama]'");
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
<script type="text/javascript" src="ed.js"></script>
<script type="text/javascript" src="aj.js"></script>
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<div id="edit">
<?php
$key=$_GET['key'];
$field=$_GET['field'];
$urutan=$_GET['urutan'];
$id_jud=$_GET['id_jud'];
$halaman=$_GET['halaman'];
$urutan_rep=$_GET['urutan_rep'];
$id_rev=$_GET['id_rev'];
$sql = mysql_query("SELECT * FROM review_mhs WHERE id_rev_mhs='$id_rev'");
$row = mysql_fetch_array($sql);
$content=html_entity_decode($row['review']);

if ($row['status']=="0")
{
	$navigasi =
	"
	<a href='ubahstatus.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep&status=$row[status]' onclick=\"return confirm('Apakah Anda ingin menampilkan review mahasiswa ini?')\"><img src='images/izin.gif'></a>&nbsp;
	<a href='deleterevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;	
	"; 
}
else
{
	$navigasi =
	"		
	<a href='deleterevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;
	"; 
}
?>
<a href="judulpra_asli2.php?key=<?php=$key;?>&field=<?php=$field;?>&urutan=<?php=$urutan;?>&id_jud=<?php=$id_jud;?>&halaman=<?php=$halaman;?>#<?php=$urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
<br><br>
<form action="editrevmhs1.php" method="post">
<table width="100%" class="khusus">
  <tr>
    <td colspan="2" align="center" bgcolor="#65739F">Edit Post</td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
    <td bgcolor="#C4C6CA" valign="top">
	<script>Init('review_text',90,15,'<?php=$content;?>'); </script>
	 </td>
  </tr>
  <tr>
    <td width="30%">&nbsp;Navigasi</td>
	<td>&nbsp;<?php=$navigasi;?></td>
  </tr>
  <tr>  
  <td colspan="2" bgcolor="#999999" align="center">
  <input type="hidden" name="id" value="<?php=$id_rev;?>">
	<input type="hidden" name="id_ju" value="<?php=$id_jud;?>">
	<input type="hidden" name="reviewer" value="<?php=$row['NIM'];?>">
	<input type="hidden" name="key" value="<?php=$key;?>">
	<input type="hidden" name="field" value="<?php=$field;?>">
	<input type="hidden" name="urutan" value="<?php=$urutan;?>">
	<input type="hidden" name="halaman" value="<?php=$halaman;?>">
	<input type="hidden" name="urutan_rep" value="<?php=$urutan_rep;?>">
  <input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
  </tr>	
</table>
</form>
</div>
</div>
</body>
</html>
