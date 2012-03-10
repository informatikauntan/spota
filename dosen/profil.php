<?php
include "../sambung.inc.php";
session_start();
$initid=$_SESSION['nipdos'];
  if (!isset($initid))
  {
	header("Location: index.php");
  }

//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[nipdos]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[nipdos]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[nipdos]'");
 session_destroy();
 header("Location: index.php");
 }
 $ubah = mysql_query("UPDATE online_user SET sta='0' WHERE ((UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tm))/60) > 10");                                                                     	
//------------------------------  
  
  
if (isset($_POST['Submit']))
{
	$pw=trim($_POST['ubahpass']);
	$sql = mysql_query("UPDATE log_dos set pw='".$pw."', pwdosen='".md5($pw)."' WHERE NIP='$initid'");
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
	$sql=mysql_query("SELECT pw, nama_dosen FROM log_dos, data_dosen WHERE data_dosen.NIP=log_dos.NIP and log_dos.NIP='$initid'");
	$r=mysql_fetch_assoc($sql);
?>
<form method="post" action="profil.php">
<table width="55%" align="center">
  <tr>
    <td colspan="2" style="border-bottom: 1px solid #990000; "><img src="../images/pengirim.gif">&nbsp;<b>Edit Profil</b></td>
   </tr>
  <tr>
    <td width="40%">&nbsp;NIP (Nomor Induk Pegawai)</td>
    <td width="60%">&nbsp;<?php echo $initid;?></td>
  </tr>
  <tr>
    <td width="40%">&nbsp;Nama Anda</td>
    <td width="60%">&nbsp;<b><?php echo $r['nama_dosen'];?></b></td>
  </tr>
  <tr>
    <td>&nbsp;Password Baru</td>
    <td>&nbsp;<input type="text" name="ubahpass" size="20" value="<?php echo $r['pw'];?>" style="background-color:#CCCCCC; color:#FF0000; font-weight:bold;"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" >&nbsp;<input type="submit" name="Submit" value="Ubah Profil">&nbsp;</td>
    </tr>
</table>
</form>

</div>
</body>
</html>
