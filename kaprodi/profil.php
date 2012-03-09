<?php
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['kapro']))
  {
	header("Location: index.php");
  }
  
if (isset($_POST['Submit']))
{
	$pw=trim($_POST['ubahpass']);
	$sql = mysql_query("UPDATE log_kaprodi set pw='".$pw."', pwkaprodi='".md5($pw)."' WHERE kaprodi_name='$_SESSION[kapro]'");
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
<script type="text/javascript" src="ed.js"></script>
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<?php include "menu.php"; ?>
<div id="profil">
<?php
	$sql=mysql_query("SELECT pw, kaprodi_name FROM log_kaprodi WHERE kaprodi_name='$_SESSION[kapro]'");
	$r=mysql_fetch_assoc($sql);
?>
<form method="post" action="profil.php">
<table width="55%" align="center">
  <tr>
    <td colspan="2" style="border-bottom: 1px solid #990000; "><img src="../images/pengirim.gif">&nbsp;<b>Edit Profil</b></td>
   </tr>
  <tr>
    <td width="40%">&nbsp;Username</td>
    <td width="60%">&nbsp;kaprodi</td>
  </tr>

  <tr>
    <td>&nbsp;Password Baru</td>
    <td>&nbsp;<input type="text" name="ubahpass" size="20" value="<?php=$r['pw'];?>" style="background-color:#CCCCCC; color:#FF0000; font-weight:bold;"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" >&nbsp;<input type="submit" name="Submit" value="Ubah Profil">&nbsp;</td>
    </tr>
</table>
</form>

</div>
</body>
</html>

