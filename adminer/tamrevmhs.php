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

<div id="tam">
<?php
$sqlb=mysql_query("SELECT * FROM review_mhs, data_mahasiswa WHERE data_mahasiswa.NIM=review_mhs.NIM and status='0'");
$no=1;
while ($rowa=mysql_fetch_array($sqlb))
{
$tglm=tgli($rowa['tanggal']);
$textm = html_entity_decode($rowa['review']);

//$milik = ($rowa['up']==$rowa['rev']? "#CCFF8A" : "#B9D3FF");
//if ($rowa['status']=="0")
//{
	$navigasi =
	"
	<a href='tubahstatus.php?id_rev=$rowa[id_rev_mhs]' onclick=\"return confirm('Apakah Anda ingin menampilkan review mahasiswa ini?')\"><img src='images/izin.gif'></a>&nbsp;
	<a href='teditrev.php?id_rev=$rowa[id_rev_mhs]&urutan_rep=$no'><img src='images/edit.gif'></a>&nbsp;
	<a href='tdeleterev.php?id_rev=$rowa[id_rev_mhs]' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;	
	"; 
//}
//else
//{
	/*$navigasi =
	"	
	<a href='editrevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in'><img src='images/edit.gif'></a>&nbsp;
	<a href='deleterevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;
	<a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$rowa[rev]&id_rev=$rowa[id_rev_mhs]&kode=Mahasiswa&urutan_rep=$in'><img src='images/pm.gif'>&nbsp;
	<a name='$in'><a href='#'><img src='images/top.gif'></a></a>
	"; 
	
}*/

echo "<table width='100%' align='center'>
  <tr bgcolor='#6C8AC0'>
    <td width='15%'><img src='../images/mhs.gif'>&nbsp;Mahasiswa</td>
	<td width='85%' align='right' bgcolor='#C5C3BE'>$navigasi</td>
  </tr>
  <tr>
    <td valign='top' bgcolor='#D2D3D3'><b>$rowa[nama_mhs]</b><br><br>Tanggal : $tglm<br>Waktu : $rowa[waktu]</td>
    <td valign='top'>$textm</td>
  </tr>
 </table><br>";
$no++;
}
?>
</div>
</div>
</body>
</html>
