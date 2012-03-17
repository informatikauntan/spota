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
</head>
<body class="admin">
<div id="header"></div>
<?php include "menu.php"; ?>
</div>
<?php
//$form = new searching("admin-spota.php","$_POST[key]","Search");
//$form->addoption("NIM");
//$form->addoption("Judul");
//$form->tamsearchform();
//if(!isset($_POST['submit']))
//{
echo "<form method='GET' action='reviewdos1.php'>";
echo "<table width='400' border='0' align='center'>
  <tr>
    <td align='center'><img src='../images/search.gif'></td>
  </tr>
  <tr>
  <td align='center'>
  <label>Berdasarkan</label>
  <input type='radio' name='field' value='judul_praoutline' onClick='tsemang(this.value)'>Judul Praoutline
  <input type='radio' name='field' value='NIM' onClick='tsemang(this.value)'>NIM
  <input type='radio' name='field' value='carilain' onClick='tsemang(this.value)'>Advanced Search<br>
  <div id='adva'></div>
  </td>
  </tr>
  
  <tr>
    <td align='center'><input type='submit' name='submit' value='Cari Desain Praoutline' class='spesial'>&nbsp;<input type='reset' value='Reset Kata Kunci' class='spesial'></td>
  </tr>";
echo "</table>";
echo "</form>";
//}
?>

</body>
</html>
