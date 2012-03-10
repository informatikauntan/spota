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
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
</div>
<div>
<div id="induk">
<?php
$id=$_GET['id'];
$halaman=$_GET['halaman'];
$nim=$_GET['punya'];
$urutan=$_GET['urutan'];
//$id_jud=$_GET['id_jud'];
//$halaman=$_GET['halaman'];
$sql="Select id, NIM, judul_praoutline, berkas,  
upload_mhs.tanggal as 'tgl', 
upload_mhs.waktu as 'wkt', 
status_review, 
COUNT(id_upload) as 'P', 
COUNT(IF(jenis_rev=0,1,null)) as 'Q', 
COUNT(IF(jenis_rev=1,1,null)) as 'R', 
COUNT(IF(hasil='0',1,null)) as 'S', 
COUNT(IF(hasil=1,1,null)) as 'T' 
from upload_mhs, review_praoutline where id=id_upload and id='$id' GROUP by id";
$execsql=mysql_query($sql);
$result=mysql_fetch_array($execsql);
?>
<br>
<div id="link">
<a href="kaprodi.php?#<?php echo $urutan;?>">.:: Kembali ke Halaman Index ::.</a>
</div>
<br>
<?php
echo "<form method='post' action='lbhjauh1.php'>";
?>
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
</form>
<div id="berkas"></div>
<br>
<div id="rev_dosen">
<?php

$sqla="SELECT * from review_praoutline 
LEFT JOIN data_dosen on review_praoutline.reviewer=data_dosen.NIP 
LEFT JOIN data_mahasiswa on review_praoutline.reviewer=data_mahasiswa.NIM GROUP BY id_review HAVING id_upload='$id'";
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
WHERE review_mhs.NIM=data_mahasiswa.NIM and review_mhs.id_judul=upload_mhs.id and id_judul='$id' and status='1'");
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
</div></div>
<a name="tambahan"></a>
<br>
<div id="des">
<div id="sms">
<form method="post" action="tegur.php">
<table width="50%">
	  <tr>
  	<td colspan="2" bgcolor="#FFFFFF"><b>Kirim Pesan</b></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DFDFDF">Penerima</td>
  </tr>	
   <?php
  $sql = mysql_query
	("SELECT * FROM data_dosen LEFT JOIN review_praoutline on 
	NIP=reviewer and 
	id_upload='$id' and 
	jenis_rev='1' GROUP by NIP HAVING id_review is NULL");
  while ($row=mysql_fetch_array($sql))  
  {
  	echo "<tr>
	<td width='5%'><input type='checkbox' name=cek[] value='$row[NIP]'></td>
	<td width='95%'>$row[nama_dosen]</td>
	</tr>";
  }  
  ?>  	
  <tr>
     <td colspan="2" bgcolor='#DFDFDF'>Isi Pesan</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><script>Init('private',60,10,''); </script></td>
  </tr>
  <?php
  echo "
	<input type='hidden' name='id' value='$id'>
	<input type='hidden' name='halaman' value='$halaman'>
	<input type='hidden' name='nim' value='$nim'>
	<input type='hidden' name='urutan' value='$urutan'>";
  ?>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Kirim">&nbsp;<input type="reset" value="Reset"></td>
  </tr>
</table>
</form>
</div>
<div id="rekap">
<form method="post" action="penetapan.php">
<table width="90%">
	<tr>
    <td colspan="2" bgcolor="#FFFFFF"><b>Penetapan</b></td>
  </tr>
  <tr>
    <td width="30%">Keputusan Akhir</td>
    <td width="70%">&nbsp;<input type="radio" name="put" value="1">Terima&nbsp;<input type="radio" name="put" value="0">Tolak</td>
  </tr>
  <tr>
    <td valign="top">Judul Outline</td>
    <td style="border:1px solid #FFFFFF;"><script>Init('judul_out',80,4,'<?php echo $result[judul_praoutline];?>'); </script></td>
  </tr>
  <tr>
    <td>Dosen Pembimbing 1</td>
    <td>
	<?php
	$sqla=mysql_query("SELECT NIP, nama_dosen FROM data_dosen");
	echo 
	"
	<select name='dos1'>
	<option value=''>--Pilih Nama Dosen--</option>";
	while ($hasila=mysql_fetch_array($sqla))
	{
	echo "<option value='$hasila[NIP]'>$hasila[nama_dosen]</option>";
	}	
	echo "
	</select>";
	?>
	</td>
  </tr>
  <tr>
    <td>Dosen Pembimbing 2</td>
    <td>
	<?php
	$sqlb=mysql_query("SELECT NIP, nama_dosen FROM data_dosen");
	echo 
	"
	<select name='dos2'>
	<option value=''>--Pilih Nama Dosen--</option>";
	while ($hasilb=mysql_fetch_array($sqlb))
	{
	echo "<option value='$hasilb[NIP]'>$hasilb[nama_dosen]</option>";
	}	
	echo "
	</select>";
	?>
	</td>
  </tr>
  <tr>
    <td>Dosen Penguji 1</td>
    <td>
	<?php
	$sqlc=mysql_query("SELECT NIP, nama_dosen FROM data_dosen");
	echo 
	"
	<select name='dos3'>
	<option value=''>--Pilih Nama Dosen--</option>";
	while ($hasilc=mysql_fetch_array($sqlc))
	{
	echo "<option value='$hasilc[NIP]'>$hasilc[nama_dosen]</option>";
	}	
	echo "
	</select>";
	?>
	</td>
  </tr>
  <tr>
    <td>Dosen Penguji 2</td>
    <td>
		<?php
	$sqld=mysql_query("SELECT NIP, nama_dosen FROM data_dosen");
	echo 
	"
	<select name='dos4'>
	<option value=''>--Pilih Nama Dosen--</option>";
	while ($hasild=mysql_fetch_array($sqld))
	{
	echo "<option value='$hasild[NIP]'>$hasild[nama_dosen]</option>";
	}	
	echo "
	</select>";
	?>
	</td>
  </tr>
  <?php
  echo "
	<input type='hidden' name='id' value='$id'>
	<input type='hidden' name='halaman' value='$halaman'>
	<input type='hidden' name='nim' value='$nim'>
	<input type='hidden' name='urutan' value='$urutan'>";
  ?>
  <tr>
    <td>Semester</td>
    <td><input type="radio" name="sem" value="GAZAL">GAZAL&nbsp;<input type="radio" name="sem" value="GENAP">GENAP</td>
  </tr>
  <tr>
    <td>Tahun Ajaran</td>
    <td>
	<?php
	$sql=mysql_query("SELECT * FROM tahun_ang");
	echo 
	"
	<select name='tahun'>
	<option value=''>--Pilih Tahun Ajaran--</option>";
	while ($hasil=mysql_fetch_array($sql))
	{
	echo "<option value='$hasil[ang]'>$hasil[ang]</option>";
	}	
	echo "
	</select>";
	?>
	</td>
  </tr>
  <tr bgcolor="#949494">
  <td colspan="2" align="center"><input type="submit" name="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
  </tr>
</table>
</form>
</div>
</div>
<br><br>   	 
<div id="footer">
	<p>Copyright 2008 - Teknik Informatika - Universitas Tanjungpura</p>
</div>
</body>
</html>
