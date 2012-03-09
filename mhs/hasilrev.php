<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
 $rand = session_id();
 if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']);  
 //--------------------  
  $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$initid'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$initid'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$initid'");
 session_destroy();
 header("Location: ../index.php");
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
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>


<?php
$sql="
SELECT id, judul_praoutline,
				judul_out,
				kep_akhir,
				pemb1,
				pemb2,
				peng1,
				peng2,
				rekap.tanggal as 'tgr',
				rekap.waktu as 'wktr',
				semester, tahun_aj,  
				upload_mhs.NIM as 'N',
upload_mhs.tanggal as 'A', 
upload_mhs.waktu as 'B', 
COUNT(id_upload) as 'P', 
COUNT(IF(jenis_rev=0,1,null)) as 'Q', 
COUNT(IF(jenis_rev=1,1,null)) as 'R', 
COUNT(IF(hasil='0',1,null)) as 'S', 
COUNT(IF(hasil=1,1,null)) as 'T' , 
status_review from 
upload_mhs 
LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
LEFT JOIN rekap on upload_mhs.id=rekap.id_judul 
GROUP by id HAVING N='$initid' ";
$execsql=mysql_query($sql); 

?>
<br><br>
    <table width="75%" align="center" class="utama">
      <tr>
      <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>Desain Praoutline Anda</b></td>
      </tr>
      <tr>
      <th width="4%"></th>
      <th width="50%">Judul Praoutline</th>
      <th width="10%">Review</th>
      <th width="10%">Putusan</th>
      <th width="10%">Review Mahasiswa</th>
      <th colspan="2">Detail</th>
      </tr>
     
    <?php
	$no=1;
	while($r=mysql_fetch_array($execsql))
      {
      $id=$r['id'];
      $sqla="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id' and status='1'";
      $execsqla=mysql_query($sqla);
      $data=mysql_fetch_array($execsqla);
	  $isi = $r['judul_praoutline'];
      $status=($r['status_review']=="1" ? "Opened" : "Closed");
      $tgl_indo=tgli($r['A']);
	  $tgltetap=tgli($r['tgr']);
				  if ($r['kep_akhir']=="0")
				  {
					$kep = "<b>Tidak Disetujui</b>";
				  }
				  else if ($r['kep_akhir']=="1")
				  {
					$kep = "<b>Disetujui</b>";
				  }
				  else
				  {
					$kep = "<b>Dalam PROSES</b>";
				  }
				  
				  $cekdos=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$r[pemb1]'");
				  $cekdosa=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$r[pemb2]'");
				  $cekdosb=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$r[peng1]'");
				  $cekdosc=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$r[peng2]'");
				  $a = mysql_fetch_array($cekdos);
				  $b = mysql_fetch_array($cekdosa);
				  $c = mysql_fetch_array($cekdosb);
				  $d = mysql_fetch_array($cekdosc);
	  echo "
      <tr>
	  <td align='center'><img src='../images/show.jpg'></td>
      <td><a href='hasilrev1.php?id_jud=$r[id]'>$isi</a></td>
      <td align='center'>$r[P]</td>
      <td align='center'>$r[R]<br><br>Y : <font color=#01016F><b>$r[T]</b></font> -- N : <font color=#FA0303><b>$r[S]</b></font></td>
      <td align='center'>$data[rev]</td>
      <td width='14%'>
      Tanggal : $tgl_indo<br>
      Waktu : $r[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
      </tr>
	  <tr>
				  <td align='center'></td>
				  <td valign='top' colspan='2'><b>Judul Outline :</b><br>
				  $r[judul_out]</td>	
				  <td valign='top'><u>Keputusan Akhir : </u><br>
				  $kep</td>
				  <td colspan='4'><u>Keterangan</u><br>
				  Ditetapkan<br>
				  Tanggal : $tgltetap<br>
				  Pukul : $r[wktr]<br>
				  Semester : $r[semester]<br>
				  Tahun Akademik : $r[tahun_aj]	  	  
				  </td>
				</tr>
				<tr >
				<td colspan='7'>
				Pembimbing 1 : <b>$a[nama_dosen]</b>&nbsp;
				Pembimbing 2 : <b>$b[nama_dosen]</b>&nbsp;
				Penguji 1 : <b>$c[nama_dosen]</b>&nbsp;
				Penguji 2 : <b>$d[nama_dosen]</b>
				</td>
				</tr>
	  ";
      $no++;

      }
      echo "</table>";
	  echo "<br><br>";
echo "<div id='paging'>&nbsp;&nbsp;&nbsp;SPOTA Forums Copyright Teknik Informatika 2009 (Versi 1.1)</div>";
?>


</body>
</html>
