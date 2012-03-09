<?php
include "../sambung.inc.php";
include "converttanggal.php";
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
<br><br>
<table width="75%" align="center" class="utama">
      <tr>
      <td colspan="6"><img src="../images/topic.gif">&nbsp;<b>List Desain Praoutline</b></td>
      </tr>
      <tr>
      <th width="4%"></th>
      <th width="60%">Judul Praoutline</th>
      <th width="10%">Review</th>
      <th width="10%">Putusan</th>      
      <th colspan="2">Detail</th>
      </tr>
 <tr>
<?php
$mode=$_GET['mode'];
if ($mode=="new")
{
	$sql="SELECT id, judul_praoutline, NIM, 
	status_review,  
    upload_mhs.tanggal as 'A',
    upload_mhs.waktu as 'B', 
	COUNT(IF(reviewer='" . $initid . "',1,NULL)) as 'P', 
	COUNT(id_upload) as 'M',
	COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T'
	FROM upload_mhs LEFT JOIN review_praoutline on id=id_upload GROUP BY id HAVING P=0 and status_review='1'";
	$hasil = mysql_query($sql);
	//$jum = mysql_num_rows($hasil);
	$no=1;
	while ($result=mysql_fetch_array($hasil))
	{		
	 $status=($result['status_review']=="1" ? "Opened" : "Closed");
     $tgl_indo=tgli($result['A']);
	 $cetaknm = nama($result['NIM']);
	 echo "
      <td align='center'><img src='../images/show.jpg'></td>
      <td><a href='recent1.php?mode=new&id_jud=$result[id]'>$result[judul_praoutline]</a></td>
      <td align='center'>$result[M]</td>
      <td align='center'>$result[R]<br><br>Y : <font color=#01016F><b>$result[T]</b></font> -- N : <font color=#FA0303><b>$result[S]</b></font></td>
      <td width='14%'>
      Oleh : <font color=#583000><b>$result[NIM]</b></font><br><font color=#072dba><b>$cetaknm</b></font><br>
      Tanggal : $tgl_indo<br>
      Waktu : $result[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
      </tr>";
      $no++;

      }
      echo "
      <tr colspan='6'>

      </tr>";
      echo "</table>";
}
else if ($mode=="rep")
{
	$sqla="SELECT id,id_upload, judul_praoutline, 
	reviewer, NIM, status_review,  upload_mhs.tanggal as 'A',
    upload_mhs.waktu as 'B'   
	FROM 
	review_praoutline, upload_mhs 
	WHERE id_review IN (SELECT MAX(id_review) as 'MM' FROM review_praoutline GROUP by id_upload) 
	and id=id_upload 
	and status_review='1' 
	and reviewer<>'$initid'";
	$hasil = mysql_query($sqla);
	//$jum = mysql_num_rows($hasil);
	$no=1;
	while ($result=mysql_fetch_array($hasil))
	{		
	 $sqlb=mysql_query("SELECT    
	COUNT(id_upload) as 'M',
	COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T' 
   	from upload_mhs, review_praoutline WHERE id=id_upload and id_upload='$result[id_upload]'");
	$row=mysql_fetch_array($sqlb);	
	 
	 $status=($result['status_review']=="1" ? "Opened" : "Closed");
     $tgl_indo=tgli($result['A']);
	 $cetaknm = nama($result['NIM']);
	 echo "
      <td align='center'><img src='../images/show.jpg'></td>
      <td><a href='recent1.php?mode=rep&id_jud=$result[id]#bottom'>$result[judul_praoutline]</a></td>
      <td align='center'>$row[M]</td>
      <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
      <td width='14%'>
      Oleh : <font color=#583000><b>$result[NIM]</b></font><br><font color=#072dba><b>$cetaknm</b></font><br>
      Tanggal : $tgl_indo<br>
      Waktu : $result[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
      </tr>";
      $no++;

      }
      echo "
      <tr colspan='6'>

      </tr>";
      echo "</table>";
}
else
{
	$sqld="SELECT DISTINCT(id_upload) as 'new', 
	judul_praoutline,  
	NIM, status_review,  
    upload_mhs.tanggal as 'A',
    upload_mhs.waktu as 'B', 
	COUNT(id_upload) as 'M',
	COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T'
	FROM review_praoutline, upload_mhs 
	WHERE id_upload NOT IN (SELECT id_upload FROM review_praoutline, upload_mhs WHERE id=id_upload and jenis_rev='1' and reviewer='$initid' ORDER by id_upload) 
	and id=id_upload 
	and status_review='1' GROUP by new";
	$hasild = mysql_query($sqld);
	//$jum = mysql_num_rows($hasil);
	$no=1;
	while ($resultd=mysql_fetch_array($hasild))
	{		
	 $status=($resultd['status_review']=="1" ? "Opened" : "Closed");
     $tgl_indo=tgli($resultd['A']);
	 $cetaknm = nama($resultd['NIM']);
	 
	 echo "
      <td align='center'><img src='../images/show.jpg'></td>
      <td><a href='recent1.php?mode=nodes&id_jud=$resultd[new]'>$resultd[judul_praoutline]</a></td>
      <td align='center'>$resultd[M]</td>
      <td align='center'>$resultd[R]<br><br>Y : <font color=#01016F><b>$resultd[T]</b></font> -- N : <font color=#FA0303><b>$resultd[S]</b></font></td>
      <td width='14%'>
      Oleh : <font color=#583000><b>$resultd[NIM]</b></font><br><font color=#072dba><b>$cetaknm</b></font><br>
      Tanggal : $tgl_indo<br>
      Waktu : $resultd[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
      </tr>";
      $no++;

      }
      echo "
      <tr colspan='6'>

      </tr>";
      echo "</table>";
}
?>

</body>
</html>
