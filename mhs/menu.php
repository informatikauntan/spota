<?php
include "../sambung.inc.php";
session_start();
if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']);  
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
	$sql = mysql_query("SELECT COUNT(IF(status_pesan='0',1,NULL)) as 'A' FROM pesan_pribadi_mini WHERE penerima='$initid'");
	$hasil = mysql_fetch_array($sql);
?>
<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="index.php">Mahasiswa Index</a></li>
<li><a href="uploaddes.php">Upload Praoutline</a></li>
<li><a href="#" rel="dropmenu1">Review</a></li>
<li><a href="#" rel="dropmenu2">Message</a></li>
<li><a href="profil.php">Profil</a></li>
<li><a href="chat.php">Chat Room</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<!--1st drop down menu -->
<div id="dropmenu1" class="dropmenudiv" style="width: 160px; ">
<a href="hasilrev.php">Hasil Review</a>
<a href="reviewmhs.php">Daftar Judul Praoutline</a>
</div>

<div id="dropmenu2" class="dropmenudiv" style="width: 160px; ">
<a href="tulispesan.php">Write New</a>
<a href="inbox.php">Inbox(<?php=$hasil['A'];?>)</a>
</div>


<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>

</body>
</html>