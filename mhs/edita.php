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
$cek=mysql_query("SELECT id_review, reviewer FROM review_praoutline WHERE id_review='$_GET[id_rev]'");
$hadang=mysql_fetch_array($cek);
if ($hadang['reviewer']!=$initid)
{
	echo "<div id='warning'><center><h1>GATAL JUGA tuh tangan pengen ubah-ubah URL</h1><br>Klik <a href='hasilrev1.php?id_jud=$_GET[id_jud]'>ini</a> untuk kembali ke Desain Praoutline";
}
else
{
$id_rev=$hadang['id_review'];


			//$urutan=$_GET['urutan'];
			$id_jud=$_GET['id_jud'];
			//$id_rev=$_GET['id_rev'];
			//$kode=$_GET['kode'];
			$urutan_rep=$_GET['urutan_rep'];
			
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
			<a href="hasilrev1.php?id_jud=<?php echo $id_jud;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form enctype="multipart/form-data" action="edita1.php" method="post">
			<table width="100%" class="khusus">
			  <tr>
				<td colspan="3" align="center" bgcolor="#65739F"><b>Edit Post</b></td>
				</tr>
			  <tr>
				<td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
				<td bgcolor="#C4C6CA" valign="top" colspan="2">
				<textarea name="review_text" cols="90" rows="15"><?php echo $content;?></textarea>
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
			  echo "<input type='hidden' name='jenis_rev' value='0'>";
			  ?>
			  <tr>
				<td colspan="3" bgcolor="#999999" align="center">
				<input type="hidden" name="id" value="<?php echo $id_rev;?>">
				<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">
				<input type="hidden" name="reviewer" value="<?php echo $row['reviewer'];?>">
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
</div>
</body>
</html>
