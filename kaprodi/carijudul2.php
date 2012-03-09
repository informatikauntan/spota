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
<script type="text/javascript" src="aj.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<?php include "menu.php"; ?>
<div id="induk">
<?php
$key=$_GET['key'];
$field=$_GET['field'];
$urutan=$_GET['urutan'];
$id_jud=$_GET['id_jud'];
$halaman=$_GET['halaman'];
$sql="Select id, NIM, judul_praoutline, berkas,  
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
<a href="carijudul1.php?key=<?php=$key;?>&field=<?php=$field;?>&halaman=<?php=$halaman;?>#<?php=$urutan;?>">.:: Kembali ke Halaman Desain Praoutline ::.</a>
</div>
<br>
<div id="judul">
<?php
$sta=($result['status_review']=='0'? "Closed" : "Opened");
$tanggal=tgli($result['tgl']);
//$reply=($result['status_review']=='0'? "" : "|&nbsp;<a href='replyd.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman'><img src='images/reply.gif'></a>");
$link = "../mhs-spota/desain/$result[berkas]";
echo "
<img src='../images/topic.gif'>&nbsp;&nbsp;<b>$result[judul_praoutline]</b><br>
Oleh : <b>$result[NIM]</b> | Tanggal : $tanggal | Waktu : $result[wkt] | Review : $result[P] | Komentar : $result[Q] | Putusan : $result[R] ( Tidak Setuju : $result[S] -- Setuju : $result[T] ) | Status : $sta";
echo "<br><br>";
echo " <input type='checkbox' style='border:0px;' value='$link' onClick='tberkas(this)'><b>Check jika ingin menampilkan Desain Praoutline</b>&nbsp;
|&nbsp;<a href='$link'><img src='../images/pdf.gif'></a> :: Klik kanan Save As jika ingin download ::";
?>
</div>
<div id="berkas"></div>
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
	<td width='85%' align='right' style='background-color:$color1;'>";
	echo "<a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
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
</div><br>
<div id="rev_mhs">
<?php
$sqlb=mysql_query("SELECT id_rev_mhs, 
review_mhs.NIM as 'rev', 
review, review_mhs.tanggal as 'tglb', review_mhs.waktu as 'wktb', status, 
upload_mhs.NIM as 'up', 
nama_mhs, status_review FROM review_mhs, data_mahasiswa, upload_mhs 
WHERE review_mhs.NIM=data_mahasiswa.NIM and review_mhs.id_judul=upload_mhs.id and id_judul='$id_jud' and status='1'");
$jum = mysql_num_rows($sqlb)+$no;
$in=$no;
while ($rowa=mysql_fetch_array($sqlb))
{
$tglm=tgli($rowa['tglb']);
$textm = html_entity_decode($rowa['review']);
$statusm= ($rowa['status']=="0"? "#A3A3A3" : "#DCDCDC");
$milik = ($rowa['rev']==$initid? "#CCFF8A" : "#B9D3FF");
echo "<table width='100%' align='center'>
  <tr>
    <td width='15%' style='background-color:$statusm;'><img src='../images/mhs.gif'>&nbsp;Mahasiswa</td>
	<td width='85%' align='right' style='background-color:$statusm;'>
	<a name='$in'><a href='#'><img src='images/top.gif'></a></a></td>
  </tr>
  <tr>
    <td style='background-color:$milik;' valign='top'><b>$rowa[nama_mhs]</b><br><br>Tanggal : $tglm<br>Waktu : $rowa[wktb]</td>
    <td valign='top'>$textm</td>
  </tr>
 </table><br>";
$in++;

}


?>

</div><br>
<a name="bottom"></a>
</div>

<br>
</div>
</body>
</html>
