<?php
include "../sambung.inc.php";
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
<br>
<form method="post" action="tulispesan1.php">
<table width="80%" class="pm" align="center">
 <tr>
    <td colspan="2" align="center" bgcolor="#65739F"><b>Private Message</b></td>
    </tr>
  <tr>
    <td width="30%" valign="top" bgcolor="#FFFFFF">&nbsp;Penerima</td>
    <td width="70%" valign="top" bgcolor="#FFFFFF">
			<?php echo "
			<input type='radio' name='penerima' value='dosen' onClick='recm(this.value)'>Dosen
		    <input type='radio' name='penerima' value='mhs' onClick='recm(this.value)'>Mahasiswa
			<input type='radio' name='penerima' value='khusus' onClick='recm(this.value)'>Khusus
			";?>
			<div id="accm"></div>
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

</body>
</html>
