<?php 
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
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
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<?php
//$form = new searching("admin-spota.php","$_POST[key]","Search");
//$form->addoption("NIM");
//$form->addoption("Judul");
//$form->tamsearchform();
//if(!isset($_POST['submit']))
//{
echo "<form>";
echo "<table width='275' border='0' align='center'>
  <tr>
    <td colspan='3' align='center'><img src='../images/search.gif'></td>
  </tr>
  <tr>
    <td colspan='3'><input type='text' name='key' size='50'></td>
  </tr>
  <tr>
    <td align='right'><label>Berdasarkan</label></td>
  <td align='center'><input type='radio' name='field' value='judul_praoutline' checked>Judul Praoutline</td>
  <td align='left'><input type='radio' name='field' value='NIM'>NIM</td>
  </tr>
  <tr>
    <td colspan='3' align='center'><input type='submit' name='submit' value='Cari Desain Praoutline' class='spesial' onclick='cari(key.value,field.value)'>&nbsp;<input type='reset' value='Reset Kata Kunci' class='spesial'></td>
  </tr>";
echo "</table>";
echo "</form>";
?>
</div>
</body>
</html>