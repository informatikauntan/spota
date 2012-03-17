<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($initid))
  {
	header("Location: index.php");
  }
  
include "cekonline.php";  
    
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
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<?php include "menu.php"; ?>

<div id="induk">
<?php
$mode=$_GET['mode'];
$id_jud=$_GET['id_jud'];
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
<a href="recent.php?mode=<?php echo $mode;?>">.:: Kembali ke Halaman Sebelumnya ::.</a>
</div>
<br>
<div id="judul">
<?php
$sta=($result['status_review']=='0'? "Closed" : "Opened");
$tanggal=tgli($result['tgl']);
//$reply=($result['status_review']=='0'? "" : "|&nbsp;<a href='npost.php?mode=$mode&id_jud=$id_jud'><img src='images/newp.gif'></a>");
$reply = ($result['status_review']=='0'? "" : "| <a href='#bottom'><img src='images/newp.gif'></a>");
$link = "../mhs-spota/desain/$result[berkas]";
echo "
<img src='../images/topic.gif'>&nbsp;&nbsp;<b>$result[judul_praoutline]</b><br>
Oleh : <b>$result[NIM]</b> | Tanggal : $tanggal | Waktu : $result[wkt] | Review : $result[P] | Komentar : $result[Q] | Putusan : $result[R] ( Tidak Setuju : $result[S] -- Setuju : $result[T] ) | Status : $sta";
echo "<br><br>";
echo " <input type='checkbox' style='border:0px;' value='$link' onClick='tberkas(this)'><b>Check jika ingin menampilkan Desain Praoutline</b>&nbsp;
|&nbsp;<a href='$link'><img src='../images/pdf.gif'></a> :: Klik kanan Save As jika ingin download ::
$reply";
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
	if ($result['status_review']=="1")
	{
		if ($row['reviewer']!=$initid)
		{
		$navigasi = "
		<a href='nrep.php?mode=$mode&id_jud=$id_jud&id_rev=$row[id_review]&urutan_rep=$no'><img src='images/quote.gif'>&nbsp;
		<a href='privatewa.php?mode=$mode&id_jud=$id_jud&reviewer=$row[reviewer]&urutan_rep=$no'><img src='images/pm.gif'>&nbsp;";
		}
		else
		{
		$navigasi = "
		<a href='nrep.php?mode=$mode&id_jud=$id_jud&id_rev=$row[id_review]&urutan_rep=$no'><img src='images/quote.gif'>&nbsp;
		<a href='warned.php?mode=$mode&id_jud=$id_jud&id_rev=$row[id_review]&urutan_rep=$no'><img src='images/edit.gif'></a>&nbsp;
		<a href='privatewa.php?mode=$mode&id_jud=$id_jud&reviewer=$row[reviewer]&urutan_rep=$no'><img src='images/pm.gif'>&nbsp;";
		}
	}
	else
	{
		$navigasi="";
	}
	echo "$navigasi";
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
<a name="bottom"></a>
</div>
<div id="reply">
<form enctype="multipart/form-data" action="npost1.php" method="post">
<table width="100%" class="khusus">
  <tr>
    <td colspan="2" align="center" bgcolor="#65739F"><b>New Post</b></td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#EFEFEF">&nbsp;Review Text</td>
    <td bgcolor="#C4C6CA" valign="top" width="70%">
	<script>Init('review_text',90,15,''); </script>
	 </td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF">&nbsp;Review Suara</td>
    <td bgcolor="#C4C6CA"><input name="suara" type="file" size="50">&nbsp;&nbsp;&nbsp;<b>.:: Ukuran File < 3 MB ::.</b></td>
  </tr>
  <tr>
    <td>&nbsp;Jenis Review</td>
    <td bgcolor="#C4C6CA">
	<select name="jenis_rev" onchange="cool(this.value)">
	<option value="">-- Pilih --</option>
    <option value="0">Komentar</option>
    <option value="1">Putusan</option>
	</select>
	<div id="rev"></div>
	</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#999999" align="center">
	
	<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
	<input type="hidden" name="mode" value="<?php echo $mode;?>">
	<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
    </tr>
</table>
</form>
</div>
</body>
</html>
