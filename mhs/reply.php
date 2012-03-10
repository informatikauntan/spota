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
 //--------------------  
  $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$initid'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$initid'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$initid'");
 session_destroy();
 header("Location: ../index.php");
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
$sql="SELECT NIM, 
COUNT(id_upload) as 'P' from 
upload_mhs LEFT JOIN review_praoutline on 
upload_mhs.id=review_praoutline.id_upload 
GROUP by id HAVING NIM='$initid' ";
$execsql=mysql_query($sql); 
$last=mysql_fetch_array($execsql);
$ter=$last['P'];
//echo "$ter";
?>
<a href="hasilrev1.php?id_jud=<?php echo $id_jud;?>#">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form enctype="multipart/form-data" action="reply1.php" method="post">
			<table width="100%" class="khusus">
			  <tr>
				<td colspan="3" align="center" bgcolor="#65739F"><b>New POST</b></td>
				</tr>
			  <tr>
				<td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
				<td bgcolor="#C4C6CA" valign="top" colspan="2">
				<script>Init('review_text',80,15,''); </script>
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

/*$sql="SELECT NIM, 
COUNT(id_upload) as 'P' from 
upload_mhs LEFT JOIN review_praoutline on 
upload_mhs.id=review_praoutline.id_upload 
GROUP by id HAVING NIM='$initid' ";
$execsql=mysql_query($sql); 
$last=mysql_fetch_array($execsql);
$no=$last['P']+1;
echo "$no";*/
?>			
</div>
</body>
</html>
