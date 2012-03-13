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

<div id="induk">
<?php
$key=$_GET['key'];
$field=$_GET['field'];
$urutan=$_GET['urutan'];
$id_jud=$_GET['id_jud'];
$halaman=$_GET['halaman'];
$urutan_rep=$_GET['urutan_rep'];

$sql="Select id, NIM, judul_praoutline, 
upload_mhs.tanggal as 'tgl', 
upload_mhs.waktu as 'wkt', 
status_review, 
COUNT(id_upload) as 'P', 
COUNT(IF(jenis_rev=0,1,null)) as 'Q', 
COUNT(IF(jenis_rev=1,1,null)) as 'R', 
COUNT(IF(hasil='0',1,null)) as 'S', 
COUNT(IF(hasil=1,1,null)) as 'T' 
from upload_mhs LEFT JOIN review_praoutline on id=id_upload GROUP by id HAVING id='$id_jud' ";
$execsql=mysql_query($sql);
$result=mysql_fetch_array($execsql);

?>
<br>
<div id="link">
<a href="judulpra_asli1.php?key=<?php echo $key;?>&field=<?php echo $field;?>&halaman=<?php echo $halaman;?>#<?php echo $urutan;?>">.:: Kembali ke Halaman List Desain Praoutline ::.</a>
</div>
<br>
<div id="judul">
<?php
$sta=($result['status_review']=='0'? "Closed" : "Opened");
$tanggal=tgli($result['tgl']);
echo "
<img src='../images/topic.gif'>&nbsp;&nbsp;<b>$result[judul_praoutline]</b><br>
Oleh : <b>$result[NIM]</b> | Tanggal : $tanggal | Waktu : $result[wkt] | Review : $result[P] | Komentar : $result[Q] | Putusan : $result[R] ( Tidak Setuju : $result[S] -- Setuju : $result[T] ) | Status : $sta
";
?>
</div>
<br>
<div id="rev_dosen">
<?php
$sqla="SELECT * from review_praoutline 
LEFT JOIN data_dosen on review_praoutline.reviewer=data_dosen.NIP 
LEFT JOIN data_mahasiswa on review_praoutline.reviewer=data_mahasiswa.NIM GROUP BY id_review HAVING id_upload='$id_jud'";
$execsqla=mysql_query($sqla);
$no=1;
while($row=mysql_fetch_array($execsqla))
{
$rev_suara=($row['review_sound']==""? "N/A" : "<a href='../dosen-spota/upload/$row[review_sound]'><img src='../images/sound.gif'></a> [..: Klik kanan Save Target As untuk download :..]");
$color = ($row['jenis_rev']=="1"? "#FF0000" : "#000000");
$color1 = ($row['jenis_rev']=="1"? "#E8DDB3" : "#DCDCDC");
$con = ($row['jenis_rev']=="1"? "<b>Putusan</b>" : "<b>Komentar</b>");
$title = ($row['nama_dosen']==NULL? "Mahasiswa" : "Dosen");
$warna = ($row['nama_dosen']==NULL? "#CCFF8A" : "#B9D3FF");
if (empty($row['hasil']))
{
$con1= "";
}
if ($row['hasil']=="1")
{
$con1="<b>[..: Setuju :..]</b>";
}
if ($row['hasil']=="0")
{
$con1="<b>[..: Tidak Setuju :..]</b>";
}
$tgl = tgli($row['tanggal']);
$text = html_entity_decode($row['review_text']);
echo "<table width='100%' align='center'>
  <tr>
    <td width='15%' style='background-color:$color1;'><img src='../images/user.gif'>&nbsp;$title</td>
	<td width='85%' align='right' style='background-color:$color1;'>
	<a href='editrevdos.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$row[id_review]&kode=$title&urutan_rep=$no'><img src='images/edit.gif'></a>&nbsp;
	<a href='deleterevdos.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$row[id_review]&rev_sound=$row[review_sound]&urutan_rep=$no' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;
	<a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$row[reviewer]&id_rev=$row[id_review]&kode=$title&urutan_rep=$no'><img src='images/pm.gif'>&nbsp;
	<a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
  </tr>
  <tr>
    <td rowspan='3' style='background-color:$warna;' valign='top'><b>$row[nama_dosen]$row[nama_mhs]</b><br><br>Tanggal : $tgl<br>Waktu : $row[waktu]</td>
    <td>$text</td>
  </tr>
  <tr>
  	<td>Review Suara : $rev_suara</td>
  </tr>
  <tr>
    <td>Sifat Review : <font color='$color'>$con&nbsp;$con1</font></td>
  </tr>
</table><br>";
$no++;
}
?>
</div>
<br>
<div id="rev_mhs">
<?php
$sqlb=mysql_query("SELECT id_rev_mhs, 
review_mhs.NIM as 'rev', 
review, review_mhs.tanggal as 'tglb', review_mhs.waktu as 'wktb', status, 
upload_mhs.NIM as 'up', 
nama_mhs, status_review FROM review_mhs, data_mahasiswa, upload_mhs 
WHERE review_mhs.NIM=data_mahasiswa.NIM and review_mhs.id_judul=upload_mhs.id and id_judul='$id_jud'");
$in=$no;
while ($rowa=mysql_fetch_array($sqlb))
{
$tglm=tgli($rowa['tglb']);
$textm = html_entity_decode($rowa['review']);
$statusm= ($rowa['status']=="0"? "#A3A3A3" : "#DCDCDC");
$milik = ($rowa['up']==$rowa['rev']? "#CCFF8A" : "#B9D3FF");
if ($rowa['status']=="0")
{
	$navigasi =
	"
	<a href='ubahstatus.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in&status=$rowa[status]' onclick=\"return confirm('Apakah Anda ingin menampilkan review mahasiswa ini?')\"><img src='images/izin.gif'></a>&nbsp;
	<a href='editrevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in'><img src='images/edit.gif'></a>&nbsp;
	<a href='deleterevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;
	<a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$rowa[rev]&id_rev=$rowa[id_rev_mhs]&kode=Mahasiswa&urutan_rep=$in'><img src='images/pm.gif'>&nbsp;
	<a name='$in'><a href='#'><img src='images/top.gif'></a></a>
	"; 
}
else
{
	$navigasi =
	"	
	<a href='editrevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in'><img src='images/edit.gif'></a>&nbsp;
	<a href='deleterevmhs.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$rowa[id_rev_mhs]&urutan_rep=$in' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus review ini?')\"><img src='images/delete.gif'></a>&nbsp;
	<a href='privatem.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&reviewer=$rowa[rev]&id_rev=$rowa[id_rev_mhs]&kode=Mahasiswa&urutan_rep=$in'><img src='images/pm.gif'>&nbsp;
	<a name='$in'><a href='#'><img src='images/top.gif'></a></a>
	"; 

}

echo "<table width='100%' align='center'>
  <tr>
    <td width='15%' style='background-color:$statusm;'><img src='../images/mhs.gif'>&nbsp;Mahasiswa</td>
	<td width='85%' align='right' style='background-color:$statusm;'>$navigasi</td>
  </tr>
  <tr>
    <td style='background-color:$milik;' valign='top'><b>$rowa[nama_mhs]</b><br><br>Tanggal : $tglm<br>Waktu : $rowa[wktb]</td>
    <td valign='top'>$textm</td>
  </tr>
 </table><br>";
$in++;
}
?>
</div>
<br>
</div>
</div>
</body>
</html>
