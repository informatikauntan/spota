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
$id_jud=$_GET['id_jud'];
$mode=$_GET['mode'];
$urutan_rep=$_GET['urutan_rep'];
$reviewer=$_GET['reviewer'];
if (substr($reviewer,0,1)=="1")
{
	$sql=mysql_query("SELECT NIP, nama_dosen FROM data_dosen WHERE NIP='$reviewer'");
	$hasil=mysql_fetch_array($sql);
	$nama=$hasil['nama_dosen'];
	$init=$hasil['NIP'];
}
else
{
	$sql=mysql_query("SELECT NIM, nama_mhs FROM data_mahasiswa WHERE NIM='$reviewer'");
	$hasil=mysql_fetch_array($sql);
	$nama=$hasil['nama_mhs'];
	$init=$hasil['NIM'];
}
?>

<a href="recent1.php?mode=<?php echo $mode;?>&id_jud=<?php echo $id_jud;?>#<?php echo $urutan_rep;?>">.:: Kembali ke Halaman Review ::.</a>
<br><br>
<form method="post" action="privatewa1.php">
<table width="100%" class="pm">
 <tr>
    <td colspan="3" align="center" bgcolor="#65739F"><b>Private Message</b></td>
    </tr>
  <tr>
    <td width="30%" valign="top">&nbsp;Penerima</td>
    <td width="30%" valign="top" bgcolor="#999999"><b><?php echo $nama;?></b></td>
    <td width="40%" valign="top"><input type="checkbox" name="cari" value="ad" onclick="tradio(this)">&nbsp;Advanced Search&nbsp;&nbsp;<div id="acc"></div>
	</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;Message</td>
    <td colspan="2" bgcolor="#999999" valign="top">
	<script>Init('private',80,15,''); </script>
	</td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#999999" align="center">
	
	<input type="hidden" name="id_ju" value="<?php echo $id_jud;?>">	
	<input type="hidden" name="rcp" value="<?php echo $init;?>">
	<input type="hidden" name="mode" value="<?php echo $mode;?>">	
	<input type="hidden" name="urutan_rep" value="<?php echo $urutan_rep;?>">
	<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset">
	</td>
    </tr>
</table>



</form>
</div>
</div>

</body>
</html>
