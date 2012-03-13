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
<script type="text/javascript" src="aj.js"></script>
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
<br><br>
<form method="post" action="deletepesan.php">
<table width="35%" align="center" class="inbox">
  <tr>
    <td colspan="3">&nbsp;<img src="../images/inbox.bmp">&nbsp;<b>Inbox</b></td>
  </tr>
  <tr bgcolor="#314381">
    <th width="20%" align="center">#</th>
    <th width="60%" align="center">&nbsp;Pengirim</th>
    <th width="20%" align="center">&nbsp;Status Pesan</th>
   </tr>
<?php
$batas = 5;
$halaman = $_GET['halaman'];
if(empty($halaman))
{
	$posisi=0;
	$halaman = 1;
}
else
{
	$posisi = ($halaman-1)*$batas;
}

$sql = mysql_query("SELECT * FROM pesan_pribadi_mini WHERE penerima='$_SESSION[user_nama]' ORDER BY status_pesan='0' DESC LIMIT $posisi, $batas");
$no=$posisi;
while ($mes=mysql_fetch_array($sql))
{
	if (substr($mes['pengirim'],0,1)=="D")
	{
		$cek = mysql_query("SELECT nama_mhs FROM data_mahasiswa WHERE NIM='$mes[pengirim]'");
		$hasil = mysql_fetch_array($cek);
		$pengirim=$hasil['nama_mhs'];
	}
	else if (substr($mes['pengirim'],0,1)=="1")
	{
		$cek = mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$mes[pengirim]'");
		$hasil = mysql_fetch_array($cek);
		$pengirim=$hasil['nama_dosen'];
	}
	else if ($mes['pengirim']=="kaprodi")
	{
		$pengirim="Kepala Prodi";
	}
	else
	{
		$pengirim="Administrator";
	}
	echo 
	"<tr bgcolor='#FFFFFF'><td align=center valign=middle><input type=checkbox name=cek[] value=$mes[id_pesan] id=id$no></td>";
	$no++;	
	echo "<td><img src='../images/pengirim.gif'>&nbsp;<a href='inbox.php?halaman=$halaman&id=$mes[id_pesan]&dari=$pengirim'>$pengirim</a></td>
		<td align='center'><img src='../images/$mes[status_pesan].gif'></td>
	</tr>";
	
}
echo "
<tr>
  <td  align=right bgcolor='#D8D9DA' colspan='3'>
  &nbsp;<input type=radio name=pilih onClick='for (i=$posisi;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All
  &nbsp;<input type=radio name=pilih onClick='for (i=$posisi;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All
  &nbsp;<input type=submit name=kirim value=Delete style='color:#000033; font-weight:bold; font-size=10px; text-decoration:none;'></td>
</tr>";
echo "<tr>
<td valign='top' bgcolor='#FFFFFF' style='padding: 10px 10px 10px 10px; color:#000033;' align='left'  colspan='3'>";
		if (isset($_GET['id']))
		{
		$tammes = mysql_query("SELECT * FROM pesan_pribadi_mini WHERE id_pesan='$_GET[id]'");
		$hasil = mysql_fetch_assoc($tammes);	
		echo "Pesan : <b>$_GET[dari]</b><br>
		<p></p>$hasil[pesan]";
		$ubah = mysql_query("UPDATE pesan_pribadi_mini SET status_pesan='1' WHERE id_pesan='$_GET[id]'");
			
echo "</td></tr><tr>
<td align='right' colspan='3'><a href='repmes.php?idp=$hasil[pengirim]&nama=$_GET[dari]&halaman=$halaman&idpesan=$_GET[id]'><img src='images/replym.gif'></a>";} 
echo "&nbsp;<a href='inbox.php?halaman=$halaman'><img src='images/close.gif'></a></td>
</tr></table>
<input type='hidden' name='hal' value='$halaman'>
</form><br>";


$sql2=mysql_query("SELECT COUNT(penerima) as 'jum' FROM pesan_pribadi_mini WHERE penerima='$_SESSION[user_nama]'");
$has=mysql_fetch_assoc($sql2);
$jmlhalaman = ceil($has['jum']/$batas);
$file="inbox.php";

echo "<div id='paging'>";
if($halaman > 1)
{
  $previous=$halaman-1;
  echo "<A HREF=$file?halaman=1><< First</A> |
        <A HREF=$file?halaman=$previous>< Previous</A> | ";
}
else
{
  echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1)
      continue;
  $angka .= "<a href=$file?halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman)
      break;
  $angka .= "<a href=$file?halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...
          <a href=$file?halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
  $next=$halaman+1;
  echo " | <A HREF=$file?halaman=$next>Next ></A> |
  <A HREF=$file?halaman=$jmlhalaman>Last >></A> ";
}
else
{
  echo " | Next > | Last >>";
}
echo "</div>";

?>


</body>
</html>

