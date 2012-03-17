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
<div id="edit">
<?php
$key=$_GET['key'];
$field=$_GET['field'];
$urutan=$_GET['urutan'];
$id_jud=$_GET['id_jud'];
$halaman=$_GET['halaman'];
$id_rev=$_GET['id_rev'];
$urutan_rep=$_GET['urutan_rep'];
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
<a href="reviewdos2.php?key=<?php echo $key;?>&field=<?php echo $field;?>&urutan=<?php echo $urutan;?>&id_jud=<?php echo $id_jud;?>&halaman=<?php echo $halaman;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form enctype="multipart/form-data" action="replydq1.php" method="post">
			<table width="100%" class="khusus">
			  <tr>
				<td colspan="3" align="center" bgcolor="#65739F"><b>New POST</b></td>
				</tr>
			  <tr>
				<td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
				<td bgcolor="#C4C6CA" valign="top" colspan="2">
				<script>Init('review_text',90,15,'<?php echo $content;?>'); </script>
				 </td>
			  </tr>
			  <tr>
				<td width="30%">&nbsp;Review Suara</td>
				<td bgcolor="#C4C6CA" colspan="2"><input name="suara" type="file" size="50">&nbsp;&nbsp;&nbsp;<b>.:: Ukuran File < 3 MB ::.</b></td>
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
				<td colspan="3" bgcolor="#999999" align="center">
				<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
				<input type="hidden" name="id_rev" value="<?php echo $id_rev;?>">
				<input type="hidden" name="key" value="<?php echo $key;?>">
				<input type="hidden" name="field" value="<?php echo $field;?>">
				<input type="hidden" name="urutan" value="<?php echo $urutan;?>">
				<input type="hidden" name="urutan_rep" value="<?php echo $urutan_rep;?>">
				<input type="hidden" name="halaman" value="<?php echo $halaman;?>">
				<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
				</tr>
			</table>
			</form>

</div>
</body>
</html>
