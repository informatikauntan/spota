<?php 
include "../sambung.inc.php";
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
<script type="text/javascript" src="chrome.js"></script>
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<br>

<form method="post" action="tulispesan1.php">
<table width="90%" class="pm" align="center">
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
