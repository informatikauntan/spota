<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
 $rand = session_id();
if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']);
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
<script type="text/javascript" src="ed.js"></script>
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<div id="edit">
<?php
$hadang=mysql_query("SELECT id, NIM, status_review FROM upload_mhs WHERE id='$_GET[id_jud]'");
$cek=mysql_fetch_array($hadang);
if ($cek['NIM']!=$initid or $cek['status_review']=="0")
{  
echo "<div id='warning'><center><h1>GATAL JUGA tuh tangan pengen ubah-ubah URL</h1><br>Klik <a href='reply.php?id_jud=$cek[id]&urutan=$_GET[urutan_rep]'>ini</a> untuk kembali ke Desain Praoutline";
}
else
{		
$id_jud=$_GET['id_jud'];
$urutan_rep=$_GET['urutan_rep'];
$id_rev=$_GET['id_rev'];
$sql="SELECT NIM, 
COUNT(id_upload) as 'P' from 
upload_mhs LEFT JOIN review_praoutline on 
upload_mhs.id=review_praoutline.id_upload 
GROUP by id HAVING NIM='$initid' ";
$execsql=mysql_query($sql); 
$last=mysql_fetch_array($execsql);
$ter=$last['P'];
$host=$_SERVER['HTTP_HOST'];

$com=mysql_query("
SELECT id_review, id_upload, nama_dosen, nama_mhs, review_text, review_sound from review_praoutline 
LEFT JOIN data_dosen on review_praoutline.reviewer=data_dosen.NIP 
LEFT JOIN data_mahasiswa on review_praoutline.reviewer=data_mahasiswa.NIM where id_review='$id_rev'");
$has=mysql_fetch_array($com);
$text = html_entity_decode($has['review_text']);
$sound=($has['review_sound']==NULL? "N/A" : "<a href=\"http://$host/newspota/dosen-spota/upload/$has[review_sound]\">$has[review_sound]</a>");
$content = "<div style=\"background-color:#F0F0F0; padding: 10px 10px 10px 10px; border-left:3px solid #11034A;\"><b>$has[nama_dosen]$has[nama_mhs]</b><br>Review Text : <br>$text<br>Review Sound : $sound</div>";


?>
<a href="hasilrev1.php?id_jud=<?php echo $id_jud;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form enctype="multipart/form-data" action="replyq1.php" method="post">
			<table width="100%" class="khusus">
			  <tr>
				<td colspan="3" align="center" bgcolor="#65739F"><b>New POST</b></td>
				</tr>
			  <tr>
				<td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
				<td bgcolor="#C4C6CA" valign="top" colspan="2">
				<script>Init('review_text',80,15,'<?php echo $content;?>'); </script>
				 </td>
			  </tr>
			  <tr>
				<td width="30%">&nbsp;Review Suara (Upload MP3 untuk memperjelas --> Optional)</td>
				<td bgcolor="#C4C6CA" colspan="2"><input name="suara" type="file" size="50">&nbsp;&nbsp;&nbsp;<b>.:: Ukuran File < 3 MB ::.</b></td>
			  </tr>
			  <?php			
			  echo "<input type='hidden' name='jenis_rev' value='0'>";
			  ?>
			  <tr>
				<td colspan="3" bgcolor="#999999" align="center">
				<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
				<input type="hidden" name="ter" value="<?php echo $ter;?>">
				<input type="hidden" name="id_rev" value="<?php echo $id_rev;?>">
				<?php
				//echo "<input type='hidden' name='review_s' value='$row[review_sound]'>";		
				?>
				<input type="hidden" name="urutan_rep" value="<?php echo $urutan_rep;?>">
				<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
				</tr>
			</table>
			</form>
<?php
}
?>
</div>
</body>
</html>

