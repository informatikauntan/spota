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
$urutan=$_GET['urutan'];
			$id_jud=$_GET['id_jud'];
			//$id_rev=$_GET['id_rev'];
			//$kode=$_GET['kode'];
			$urutan_rep=$_GET['urutan_rep'];
			$key=$_GET['key'];
			$field=$_GET['field'];
			$halaman=$_GET['halaman'];
?>
<a href="reviewmhs2.php?key=<?php echo $key;?>&field=<?php echo $field;?>&urutan=<?php echo $urutan;?>&id_jud=<?php echo $id_jud;?>&halaman=<?php echo $halaman;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
			<br><br>
			<form action="replymcari1.php" method="post">
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
				<input type="hidden" name="key" value="<?php echo $key;?>">
				<input type="hidden" name="field" value="<?php echo $field;?>">
				<input type="hidden" name="halaman" value="<?php echo $halaman;?>">
				<input type="hidden" name="urutan" value="<?php echo $urutan;?>">
				<?php
				//echo "<input type='hidden' name='review_s' value='$row[review_sound]'>";		
				?>
				<input type="hidden" name="urutan_rep" value="<?php echo $urutan_rep;?>">
				<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"></td>
				</tr>
			</table>
			</form>
			
</div>
</body>
</html>

</body>
</html>
