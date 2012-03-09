<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>..::[SPOTA Prodi TEKNIK INFORMATIKA]::..</title>
<meta name="keywords" content="SPOTA, Sistem Pendukung Outline Tugas Akhir" />
<meta name="copyright" content="nikolaidiez - Teknik Informatika - UNTAN" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" src="aj.js"></script>
</head>

<body>
<div id="menu" style="background-image:url(images/menu.gif);">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="praoutline.php">Praoutline</a></li>
		<li><a href="index.php?bag=kontak">Kontak</a></li>
	</ul>
</div>
<div id="header" style="background-image:url(images/header.gif);"></div>
<div id="page">
	<div id="tabpra">
	<?php
//$form = new searching("admin-spota.php","$_POST[key]","Search");
//$form->addoption("NIM");
//$form->addoption("Judul");
//$form->tamsearchform();
//if(!isset($_POST['submit']))
//{
echo "<form method='GET' action='praoutline1.php#post'>";
echo "<table width='400' border='0' align='center'>
  <tr>
    <td align='center'><img src='images/search.gif'></td>
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
    <td colspan='3' align='center'><input type='submit' name='submit' value='Cari Desain Praoutline' class='spesial'>&nbsp;<input type='reset' value='Reset Kata Kunci' class='spesial'></td>
  </tr>";
echo "</table>";
echo "</form>";
//}
?>
</div>	
</div>
<div id="footer">
	<p>Copyright 2008 - Teknik Informatika - Universitas Tanjungpura</p>
</div>
</body>
</html>	