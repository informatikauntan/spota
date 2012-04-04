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
$hadang=mysql_query("SELECT id, NIM FROM upload_mhs WHERE id='$_GET[id_jud]'");
$cek=mysql_fetch_array($hadang);
if ($cek['NIM']!=$initid)
{  
echo "<div id='warning'><center><h1>GATAL JUGA tuh tangan pengen ubah-ubah URL</h1><br>Klik <a href='replym.php?id_jud=$cek[id]&urutan=$_GET[urutan_rep]'>ini</a> untuk kembali ke Desain Praoutline";
}
else
{		
$id_jud=$_GET['id_jud'];
$urutan_rep=$_GET['urutan_rep'];
/*$sql="SELECT upload_mhs.NIM as 'mil', 
COUNT(id_judul) as 'P' from 
upload_mhs LEFT JOIN review_mhs on 
upload_mhs.id=review_mhs.id_judul 
GROUP by id HAVING mil='$initid' ";
$execsql=mysql_query($sql); 
$last=mysql_fetch_array($execsql);
$ter=$last['P'];*/
//$ter=$_GET['last'];
//echo "$ter";
?>
<a href="hasilrev1.php?id_jud=<?php echo $id_jud;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form action="replym1.php" method="post">
			<table width="100%" class="khusus">
			  <tr>
				<td colspan="2" align="center" bgcolor="#65739F"><b>New POST</b></td>
				</tr>
			  <tr>
				<td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
				<td bgcolor="#C4C6CA" valign="top" width="70%">
				<script>Init('review_text',80,15,''); </script>
				 </td>
			  </tr>			  			   			  
			  <tr>
				<td colspan="2" bgcolor="#999999" align="center">
				<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
				<input type="hidden" name="ter" value="<?php echo $ter;?>">
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
