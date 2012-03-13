<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
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
$kode=$_GET['kode'];

$sql="SELECT * FROM review_praoutline WHERE id_review='$id_rev'";
$execsql=mysql_query($sql);
$row=mysql_fetch_array($execsql);
$content=html_entity_decode($row['review_text']);
//$content=$row['review_text'];
$sound = (empty($row['review_sound'])? "N/A" : "$row[review_sound]");
$rev = ($row['jenis_rev']=="1"? "<font color='#FF0000'><b>Putusan</b></font>" : "<font color='#000000'><b>Komentar</b></font>");
if (empty($row['hasil']))
{
$hasil= "";
}
if ($row['hasil']=="1")
{
$hasil="<font color='#FF0000'><b>[..: Setuju :..]</b></font>";
}
if ($row['hasil']=="0")
{
$hasil="<font color='#FF0000'><b>[..: Tidak Setuju :..]</b></font>";
}
?>
<a href="judulpra_asli2.php?key=<?php echo $key;?>&field=<?php echo $field;?>&urutan=<?php echo $urutan;?>&id_jud=<?php echo $id_jud;?>&halaman=<?php echo $halaman;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
<br><br>
<form enctype="multipart/form-data" action="editrevdos1.php" method="post">
<table width="100%" class="khusus">
  <tr>
    <td colspan="3" align="center" bgcolor="#65739F">Edit Post</td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
    <td bgcolor="#C4C6CA" valign="top" colspan="2">	
	<script>Init('review_text',90,15,'<?php echo $content;?>'); </script>
	 </td>
  </tr>
  <tr>
    <td width="30%">&nbsp;Review Suara</td>
	<?php
	if (!empty($row['review_sound']))
	{
	?>
    <td width="20%" bgcolor="#C4C6CA"><b><?php echo $sound;?></b></td>
	<td width="50%"><input type="checkbox" name="delete" value="1">&nbsp;Delete review suara</td>
	<?php
	}
	else
	{
	?>
	<td bgcolor="#C4C6CA"><b><?php echo $sound;?></b></td>
	<?php
	}
	?>	
  </tr>
   <tr>
    <td width="30%">&nbsp;Ubah Review Suara (Kosongkan jika tidak mengubah)</td>
    <td bgcolor="#C4C6CA" colspan="2"><input name="suara" type="file" size="50">&nbsp;&nbsp;&nbsp;<b>.:: Ukuran File < 3 MB ::.</b></td>
  </tr>
  <tr>
  <td width="30%" valign="top">&nbsp;Sifat Review</td>
    <td bgcolor="#C4C6CA" colspan="2">&nbsp;<?php echo $rev.' '.$hasil;?>
  </tr>
  <?php
  if ($kode=="Dosen")
  {
  ?>
  <tr>
    <td width="30%">&nbsp;Ubah Review (Pilih jika ingin mengubah)</td>
    <td bgcolor="#C4C6CA" colspan="2">
	<select name="jenis_rev" onchange="cool(this.value)">
	<option value="">-- Pilih --</option>
    <option value="0">Komentar</option>
    <option value="1">Putusan</option>
	</select>
	<div id="rev"></div>
	</td>
  </tr>
  <?php
  }
  else
  {
  echo "<input type='hidden' name='jenis_rev' value='0'>";
  }
  ?>
  <tr>
    <td colspan="3" bgcolor="#999999" align="center">
	<input type="hidden" name="id" value="<?php echo $id_rev;?>">
	<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
	<input type="hidden" name="reviewer" value="<?php echo $row['reviewer'];?>">
	<input type="hidden" name="key" value="<?php echo $key;?>">
	<input type="hidden" name="field" value="<?php echo $field;?>">
	<input type="hidden" name="urutan" value="<?php echo $urutan;?>">
	<input type="hidden" name="review_s" value="<?php echo $row['review_sound'];?>">
	<input type="hidden" name="halaman" value="<?php echo $halaman;?>">
	
	<input type="hidden" name="kode" value="<?php echo $kode;?>">
	<input type="hidden" name="urutan_rep" value="<?php echo $urutan_rep;?>">
	<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
    </tr>
</table>
</form>
<br>

</div>
</div>
</body>
</html>
