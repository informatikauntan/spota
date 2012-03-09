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
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<?php
$idp=$_GET['idp'];
$nama=$_GET['nama'];
$halaman=$_GET['halaman'];
$idpesan=$_GET['idpesan'];
?>
<div id="edit">
<a href="inbox.php?halaman=<?php=$halaman;?>&id=<?php=$idpesan;?>&dari=<?php=$nama;?>">Kembali ke Inbox Message</a><br><br>
<form method="post" action="repmes1.php">
<table width="100%" class="pm" align="center">
 <tr>
    <td colspan="2" align="center" bgcolor="#65739F"><b>Private Message</b></td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Penerima</td>
    <td width="70%" valign="top" bgcolor="#FFFFFF"><b><?php=$nama;?></b>
	<input type="hidden" name="receiver" value="<?php=$idp;?>">
	<input type="hidden" name="halaman" value="<?php=$halaman;?>">
	<input type="hidden" name="namarec" value="<?php=$nama;?>">
	<input type="hidden" name="id" value="<?php=$idpesan;?>">
	</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;Message</td>
    <td valign="top">
	<script>Init('private',60,10,''); </script>
	</td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#999999" align="center">
	<input name="submit" type="submit" value="Submit">&nbsp;<input type="reset" value="Reset">
	</td>
    </tr>
</table>
</form>
</div>
</body>
</html>



</body>
</html>

