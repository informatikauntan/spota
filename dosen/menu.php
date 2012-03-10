<?php
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['nipdos']))
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
<script type="text/javascript" src="chrome.js"></script>
</head>
<body>
<?php
$sql = mysql_query("SELECT COUNT(IF(status_pesan='0',1,NULL)) as 'A' FROM pesan_pribadi_mini WHERE penerima='$_SESSION[nipdos]'");
	$hasil = mysql_fetch_array($sql);
//Tambahan	
	$sqlnamados = "SELECT nama_dosen FROM data_dosen WHERE NIP='$_SESSION[nipdos]'";
	$rst = mysql_query($sqlnamados);
	$row = mysql_fetch_array($rst);
	$namados = $row[nama_dosen];
//	
?>
<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="index.php">.: Anda login sebagai : <?php echo $namados."  :."; ?></a></li>
<li><a href="dosen-spota.php">Dosen Index</a></li>
<li><a href="#" rel="dropmenu1">Message</a></li>
<li><a href="#" rel="dropmenu2">Review Dosen</a></li>
<li><a href="profil.php">Profil</a></li>
<li><a href="chat.php">Chat Room</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<!--1st drop down menu -->
<div id="dropmenu1" class="dropmenudiv" style="width: 160px; ">
<a href="tulispesan.php">Write New</a>
<a href="inbox.php">Inbox(<?php $hasil['A'];?>)</a>
</div>


<!--2nd drop down menu -->
<div id="dropmenu2" class="dropmenudiv" style="width: 160px; ">
<a href="recent.php?mode=new">Upload Recent</a>
<a href="reviewdos.php">Pencarian</a>
</div>
<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>

