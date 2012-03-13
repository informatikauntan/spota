<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
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
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<?php
$sql = mysql_query("SELECT * FROM kotak_pesan");
?>
<br><br>
<form action="deletekri.php" method="post">
<table width="75%" class="krisar" align="center">
  <tr>
  <td colspan="5">&nbsp;<img src="../images/views.gif">&nbsp;<b>Kritik dan Saran</b></td>
  </tr>
  <tr>
    <th width="5%">&nbsp;</td>
    <th width="30%">&nbsp;Identitas</td>
    <th width="65%">&nbsp;Isi Kritik dan Saran</td>	
  </tr>
  <?php
  $no=0;
  while ($row=mysql_fetch_array($sql))
  {
  if (($no % 2)==1)
  {
  	$warna="#EEEFE7";
  }
	else
  {
  	$warna="#FFFFFF";
  }	
	
  $tgl = tgli($row['tanggal']);
  $saran = strip_tags($row['saran']);
  echo "
  <tr bgcolor='$warna'>
    <td align=center valign=middle><input type=checkbox name=cek[] value=$row[no] id=id$no></td>";
	$no++;	
  echo "	
    <td valign=top><b>$row[nama]</b><br>$row[email]<br>$tgl<br>$row[waktu]</td>
    <td valign=top>&nbsp;$saran</td>
  </tr>";
   
  }
  echo "
  <tr>
  <td colspan=3 align=right bgcolor='#DFFCE2'>
  &nbsp;<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All
  &nbsp;<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All
  &nbsp;<input type=submit name=kirim value=Delete style='background-color: #FFFFFF; color:#000033; font-weight:bold; font-size=10px; text-decoration:none;'></td>
  </tr>";
  ?>
</table>
</form>


</div>
</body>
</html>
