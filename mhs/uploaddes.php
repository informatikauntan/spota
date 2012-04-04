<?php 
include "../sambung.inc.php";
session_start();
 $rand = session_id();
	//echo"veri ganteng";
if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']); 
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
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<?php
	
	$cek=mysql_query("SELECT * FROM data_mahasiswa, upload_mhs WHERE data_mahasiswa.NIM=upload_mhs.NIM and data_mahasiswa.NIM='$initid'");
	$hasil = mysql_fetch_array($cek);
	if ($hasil['status_upload']=="1")
	{
	echo 
	"
	<br><table width='75%' align='center' class='desain'>
	  <tr bgcolor='#A1A1A1'>
		<td><img src='images/ico.gif'>&nbsp;<b>Upload Desain Praoutline</b></td>
		</tr>
	  <tr>
	  <tr align='center'>
	  	<td><h2>Desain Praoutline Anda sedang dalam proses</h2><br>Pilih Menu Review untuk melihat review dosen</td>
	  </tr>
	 <table><br>
	";
	}
	else if ($hasil['status_upload']=="2")
		{
		echo
		"<br>
		<table width='75%' align='center' class='desain'>
		  <tr bgcolor='#A1A1A1'>
			<td><img src='images/ico.gif'>&nbsp;<b>Upload Desain Praoutline</b></td>
			</tr>
		  <tr>
		  <tr align='center'>
			<td><h2>Desain Praoutline Anda telah diterima</h2><br>Pilih Menu Review untuk melihat review dosen<br>Segera ajukan sidang Outline</td>
		  </tr>
		 <table><br>
		";
		}
		else
		{
			echo 
			"
			<br><form method='POST' action='uploaddes1.php' enctype='multipart/form-data'>
			<table width='75%' align='center' class='desain'>
			  <tr bgcolor='#A1A1A1'>
				<td colspan='2'><img src='images/ico.gif'>&nbsp;<b>Upload Desain Praoutline</b></td>
				</tr>
			  <tr>
				<td width='30%' rowspan='2' valign='top' bgcolor='#FFFFFF'>&nbsp;&nbsp;Judul Praoutline</td>
				<td width='70%'><textarea name='juduldes' cols='70' rows='3'></textarea></td>
			  </tr>
			  <tr>
				<td><b>:: Tulis judul praoutline dengan lengkap<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berkas Desain Praoutline berformat <u>pdf</u> dengan ukuran < 2M</b><br></td>
			  </tr>
			  <tr>
				<td bgcolor='#FFFFFF'>&nbsp;&nbsp;Upload Berkas</td>
				<td><input type='file' name='upldes' size='45'></td>
			  </tr>
			  <tr>
				<td colspan='2' align='center' bgcolor='#EDEDED'><input type='submit' value='Upload' class='inputkh'>&nbsp;<input type='reset' value='Reset' class='inputkh'></td>
				</tr>
			</table><br>
			";
		}
?>


<!--
<div id="upload">
<b>SPOTA Forums Copyright Teknik Informatika 2009 (Versi 1.1)</b>
</div>-->
</body>
</html>
