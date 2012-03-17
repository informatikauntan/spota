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
$mode=$_GET['mode'];
$id_jud=$_GET['id_jud'];
//$halaman=$_GET['halaman'];

?>
<a href="recent1.php?mode=<?php echo $mode;?>&id_jud=<?php echo $id_jud;?>">.:: Kembali ke Halaman Review ::.</a>
<br><br>
<form enctype="multipart/form-data" action="npost1.php" method="post">
<table width="100%" class="khusus">
  <tr>
    <td colspan="2" align="center" bgcolor="#65739F">New Post</td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Review Text</td>
    <td bgcolor="#C4C6CA" valign="top" width="70%">
	<script>Init('review_text',90,15,''); </script>
	 </td>
  </tr>
  <tr>
    <td>&nbsp;Review Suara</td>
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
<br>

</div>
</div>
</body>
</html>

</div>
</body>
</html>

