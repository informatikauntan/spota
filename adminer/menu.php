<?php
session_start();
if (!isset($_SESSION['user_nama'])) {
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
$sql = mysql_query("SELECT COUNT(IF(status_pesan='0',1,NULL)) as 'A' FROM pesan_pribadi_mini WHERE penerima='$_SESSION[user_nama]'");
$hasil = mysql_fetch_array($sql);
?>

<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="admin-spota.php">Admin Index</a></li>
<li><a href="#" rel="dropmenu1">Data Dosen</a></li>
<li><a href="#" rel="dropmenu2">Data Mahasiswa</a></li>
<li><a href="#" rel="dropmenu3">Message</a></li>
<li><a href="kritiksaran.php">Kritik dan Saran</a></li>
<li><a href="chat.php">Chat Room</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<!--1st drop down menu -->
<div id="dropmenu1" class="dropmenudiv" style="width: 160px; ">
<a href="admin-spota.php?part=setdatdos">Setting Data Dosen</a>
<a href="admin-spota.php?part=pasdos">Lihat Password</a>
</div>


<!--2nd drop down menu -->
<div id="dropmenu2" class="dropmenudiv" style="width: 175px;">
<a href="admin-spota.php?part=setdatmhs">Setting Data Mahasiswa</a>
<a href="admin-spota.php?part=pasmhs">Lihat Password</a>
<a href="admin-spota.php?part=judul">Uploaded Praoutline</a>
</div>

<div id="dropmenu3" class="dropmenudiv" style="width: 160px; ">
<a href="tulispesan.php">Write New</a>
<a href="inbox.php">Inbox(<?php echo $hasil['A'];?>)</a>
</div>

<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>
