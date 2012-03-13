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

$field = $_GET['field'];
$semester= $_GET['semester'];
$tahun=$_GET['tahun'];
//echo "$field";
$key = strtoupper($_GET['key']);
//$field = $_GET['field'];
//$key = $_GET['key'];
//echo "$field";
$key = trim($key);
//echo "$key<br>";
$multikey = explode(" ",$key);
//echo "$multikey[1]<br>";
$banyak_kata = (integer)count($multikey);
//echo "$banyak_kata<br>";
if ($key == NULL or $key == '%')
{
  if ($semester=="" and $tahun=="")
  {	
  echo "<center><h1>Kata kunci kosong</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
  }
  else
  {
  if ($semester==NULL and $tahun!=NULL)
		{
		$batas = 10;		
		$query_hitung = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING tahun_aj='$tahun'";
				$result = mysql_query($query_hitung);
				$jum = mysql_num_rows($result);
				$jmlhal = ceil($jum/$batas);
				$file = "judulpra_asli2a.php?field=$field&semester=$semester&tahun=$tahun";
				if ($jum == 0)
				{
				echo "<center><h1>Tidak terdapat record</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
				}
				else
				{
				$halaman = $_GET['halaman'];
				if (empty($halaman))
				  {
					$posisi = 0;
					$halaman = 1;
				  }
				  else
				  {
					$posisi = ($halaman-1) * $batas;
				  }
				$query_tampil = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING tahun_aj='$tahun' LIMIT $posisi, $batas";
				 $result_tampil = mysql_query($query_tampil);
				
				?>
				<br><br>
				<table width="75%" align="center" class="utama">
				  <tr>
				  <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>List Desain Praoutline</b></td>
				  </tr>
				  <tr>
				  <th width="4%"></th>
				  <th width="50%">Judul Praoutline</th>
				  <th width="10%">Review</th>
				  <th width="10%">Putusan</th>
				  <th width="10%">Review Mahasiswa</th>
				  <th colspan="3">Detail</th>
				  </tr>
				 
				<?php
				$no=$posisi+1;
				while($row=mysql_fetch_array($result_tampil))
				  {
				  $id=$row['id'];
				  $sql="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id'";
				  $execsql=mysql_query($sql);
				  $data=mysql_fetch_array($execsql);
			
				  $isi = $row['judul_praoutline'];
				  //$isi_baru = str_replace($multikey, $search_replace, $isi);
				  //$isi_display = substr($isi_baru, 0, 800);
				  //$isi_display = substr($isi_baru, 0, strrpos($isi_display, " "));
				  //echo "$isi_baru<br>";
				  $status=($row['status_review']=="1" ? "Opened" : "Closed");
				  $tgl_indo=tgli($row['A']);
				  $tgltetap=tgli($row['tgr']);
				  if ($row['kep_akhir']=="0")
				  {
					$kep = "<b>Tidak Disetujui</b>";
				  }
				  else if ($row['kep_akhir']=="1")
				  {
					$kep = "<b>Disetujui</b>";
				  }
				  else
				  {
					$kep = "<b>Dalam PROSES</b>";
				  }
				  
				  $cekdos=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb1]'");
				  $cekdosa=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb2]'");
				  $cekdosb=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng1]'");
				  $cekdosc=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng2]'");
				  $a = mysql_fetch_array($cekdos);
				  $b = mysql_fetch_array($cekdosa);
				  $c = mysql_fetch_array($cekdosb);
				  $d = mysql_fetch_array($cekdosc);
				echo "
				<tr>
				  <td align='center'><img src='../images/show.jpg'></td>
				  <td><a href='$file&urutan=$no&id_jud=$row[id]&halaman=$halaman'>$isi</a></td>
				  <td align='center'>$row[P]</td>
				  <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
				  <td align='center'>$data[rev]</td>
				  <td width='12%'>
				  Oleh : <font color=#583000><b>$row[N]</b></font><br>
				  Tanggal : $tgl_indo<br>
				  Waktu : $row[B]<br>
				  Status : <font color=#7BC409><b>$status</b></font>
				  </td>
				  <td width='2%'><a href='deletedesain.php?id=$id&keyword=$key&field=$field&halaman=$halaman' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus desain praoutline ini?')\"><img src='../images/delete.gif' title='Delete'></a></td>
				  <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
				</tr>
				<tr>
				  <td align='center'></td>
				  <td valign='top' colspan='2'><b>Judul Outline :</b><br>
				  $row[judul_out]</td>	
				  <td valign='top'><u>Keputusan Akhir : </u><br>
				  $kep</td>
				  <td colspan='6'><u>Keterangan</u><br>
				  Ditetapkan<br>
				  Tanggal : $tgltetap<br>
				  Pukul : $row[wktr]<br>
				  Semester : $row[semester]<br>
				  Tahun Akademik : $row[tahun_aj]	  	  
				  </td>
				</tr>
				<tr >
				<td colspan='9'>
				Pembimbing 1 : <b>$a[nama_dosen]</b>&nbsp;
				Pembimbing 2 : <b>$b[nama_dosen]</b>&nbsp;
				Penguji 1 : <b>$c[nama_dosen]</b>&nbsp;
				Penguji 2 : <b>$d[nama_dosen]</b>
				</td>
				</tr>
				";
				  $no++;
			
				} 
				  echo "
				  <tr colspan='9'>
							
				  </tr>";
				  echo "</table>";
				  
			  
			echo "<br><br><br>";
				echo "<div id='paging'>";
				 if ($halaman > 1)
				 {
				 $prevoius=$halaman-1;
				 echo "<A HREF=$file&halaman=1> << First</A> | <A HREF=$file&halaman=$previous> < Previous</A> | ";
				 }
				 else
				 {
				 echo "<< First | < Previous | ";
				 }
			
				 $angka=($halaman > 3 ? " ... " : " ");
				 for ($i=$halaman-2;$i<$halaman;$i++)
				 {
				   if ($i < 1)
					continue;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= " <b>$halaman</b> ";
				 for ($i=$halaman+1;$i<($halaman+3);$i++)
				 {
				   if ($i > $jmlhal)
					break;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= ($halaman+2<$jmlhal ? " ... <a href=$file&halaman=$jmlhal>$jmlhal</a> " : " ");
				 echo "$angka";
			
				 if ($halaman < $jmlhal)
				 {
				   $next=$halaman+1;
				  echo "<A HREF=$file&halaman=$next> Next > </A> | <A HREF=$file&halaman=$jmlhal> Last >> </A> ";
				 }
				 else
				 {
				   echo "| Next > | Last >>";
				 }
				 echo "</div>";
				} 
			}
	else if ($semester!=NULL and $tahun==NULL)		
	{
	$batas = 10;		
		$query_hitung = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING semester='$semester'";
				$result = mysql_query($query_hitung);
				$jum = mysql_num_rows($result);
				$jmlhal = ceil($jum/$batas);
				$file = "judulpra_asli2a.php?field=$field&semester=$semester&tahun=$tahun";
				if ($jum == 0)
				{
				echo "<center><h1>Tidak terdapat record</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
				}
				else
				{
				$halaman = $_GET['halaman'];
				if (empty($halaman))
				  {
					$posisi = 0;
					$halaman = 1;
				  }
				  else
				  {
					$posisi = ($halaman-1) * $batas;
				  }
				$query_tampil = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING semester='$semester' LIMIT $posisi, $batas";
				 $result_tampil = mysql_query($query_tampil);
				
				?>
				<br><br>
				<table width="75%" align="center" class="utama">
				  <tr>
				  <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>List Desain Praoutline</b></td>
				  </tr>
				  <tr>
				  <th width="4%"></th>
				  <th width="50%">Judul Praoutline</th>
				  <th width="10%">Review</th>
				  <th width="10%">Putusan</th>
				  <th width="10%">Review Mahasiswa</th>
				  <th colspan="3">Detail</th>
				  </tr>
				 
				<?php
				$no=$posisi+1;
				while($row=mysql_fetch_array($result_tampil))
				  {
				  $id=$row['id'];
				  $sql="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id'";
				  $execsql=mysql_query($sql);
				  $data=mysql_fetch_array($execsql);
			
				  $isi = $row['judul_praoutline'];
				  //$isi_baru = str_replace($multikey, $search_replace, $isi);
				  //$isi_display = substr($isi_baru, 0, 800);
				  //$isi_display = substr($isi_baru, 0, strrpos($isi_display, " "));
				  //echo "$isi_baru<br>";
				  $status=($row['status_review']=="1" ? "Opened" : "Closed");
				  $tgl_indo=tgli($row['A']);
				  $tgltetap=tgli($row['tgr']);
				  if ($row['kep_akhir']=="0")
				  {
					$kep = "<b>Tidak Disetujui</b>";
				  }
				  else if ($row['kep_akhir']=="1")
				  {
					$kep = "<b>Disetujui</b>";
				  }
				  else
				  {
					$kep = "<b>Dalam PROSES</b>";
				  }
				  
				  $cekdos=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb1]'");
				  $cekdosa=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb2]'");
				  $cekdosb=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng1]'");
				  $cekdosc=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng2]'");
				  $a = mysql_fetch_array($cekdos);
				  $b = mysql_fetch_array($cekdosa);
				  $c = mysql_fetch_array($cekdosb);
				  $d = mysql_fetch_array($cekdosc);
				echo "
				<tr>
				  <td align='center'><img src='../images/show.jpg'></td>
				  <td><a href='$file&urutan=$no&id_jud=$row[id]&halaman=$halaman'>$isi</a></td>
				  <td align='center'>$row[P]</td>
				  <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
				  <td align='center'>$data[rev]</td>
				  <td width='12%'>
				  Oleh : <font color=#583000><b>$row[N]</b></font><br>
				  Tanggal : $tgl_indo<br>
				  Waktu : $row[B]<br>
				  Status : <font color=#7BC409><b>$status</b></font>
				  </td>
				  <td width='2%'><a href='deletedesain.php?id=$id&keyword=$key&field=$field&halaman=$halaman' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus desain praoutline ini?')\"><img src='../images/delete.gif' title='Delete'></a></td>
				  <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
				</tr>
				<tr>
				  <td align='center'></td>
				  <td valign='top' colspan='2'><b>Judul Outline :</b><br>
				  $row[judul_out]</td>	
				  <td valign='top'><u>Keputusan Akhir : </u><br>
				  $kep</td>
				  <td colspan='6'><u>Keterangan</u><br>
				  Ditetapkan<br>
				  Tanggal : $tgltetap<br>
				  Pukul : $row[wktr]<br>
				  Semester : $row[semester]<br>
				  Tahun Akademik : $row[tahun_aj]	  	  
				  </td>
				</tr>
				<tr >
				<td colspan='9'>
				Pembimbing 1 : <b>$a[nama_dosen]</b>&nbsp;
				Pembimbing 2 : <b>$b[nama_dosen]</b>&nbsp;
				Penguji 1 : <b>$c[nama_dosen]</b>&nbsp;
				Penguji 2 : <b>$d[nama_dosen]</b>
				</td>
				</tr>
				";
				  $no++;
			
				 }
				  echo "
				  <tr colspan='9'>
			
				  </tr>";
				  echo "</table>";
				  
			  
			echo "<br><br><br>";
				echo "<div id='paging'>";
				 if ($halaman > 1)
				 {
				 $prevoius=$halaman-1;
				 echo "<A HREF=$file&halaman=1> << First</A> | <A HREF=$file&halaman=$previous> < Previous</A> | ";
				 }
				 else
				 {
				 echo "<< First | < Previous | ";
				 }
			
				 $angka=($halaman > 3 ? " ... " : " ");
				 for ($i=$halaman-2;$i<$halaman;$i++)
				 {
				   if ($i < 1)
					continue;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= " <b>$halaman</b> ";
				 for ($i=$halaman+1;$i<($halaman+3);$i++)
				 {
				   if ($i > $jmlhal)
					break;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= ($halaman+2<$jmlhal ? " ... <a href=$file&halaman=$jmlhal>$jmlhal</a> " : " ");
				 echo "$angka";
			
				 if ($halaman < $jmlhal)
				 {
				   $next=$halaman+1;
				  echo "<A HREF=$file&halaman=$next> Next > </A> | <A HREF=$file&halaman=$jmlhal> Last >> </A> ";
				 }
				 else
				 {
				   echo "| Next > | Last >>";
				 }
				 echo "</div>";
				 }
			}
	else
	{
	$batas = 10;		
		$query_hitung = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING semester='$semester' and tahun_aj='$tahun'";
				$result = mysql_query($query_hitung);
				$jum = mysql_num_rows($result);
				$jmlhal = ceil($jum/$batas);
				$file = "judulpra_asli2a.php?field=$field&semester=$semester&tahun=$tahun";
				if ($jum == 0)
				{
				echo "<center><h1>Tidak terdapat record</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
				}
				else
				{
				$halaman = $_GET['halaman'];
				if (empty($halaman))
				  {
					$posisi = 0;
					$halaman = 1;
				  }
				  else
				  {
					$posisi = ($halaman-1) * $batas;
				  }
				$query_tampil = "SELECT id,
				judul_praoutline,
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
				status_review,
				COUNT(id_upload) as 'P',
				COUNT(IF(jenis_rev=0,1,null)) as 'Q',
				COUNT(IF(jenis_rev=1,1,null)) as 'R',
				COUNT(IF(hasil='0',1,null)) as 'S',
				COUNT(IF(hasil=1,1,null)) as 'T'
				from upload_mhs 
				LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
				LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
				GROUP by id HAVING semester='$semester' and tahun_aj='$tahun' LIMIT $posisi, $batas";
				 $result_tampil = mysql_query($query_tampil);
				
				?>
				<br><br>
				<table width="75%" align="center" class="utama">
				  <tr>
				  <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>List Desain Praoutline</b></td>
				  </tr>
				  <tr>
				  <th width="4%"></th>
				  <th width="50%">Judul Praoutline</th>
				  <th width="10%">Review</th>
				  <th width="10%">Putusan</th>
				  <th width="10%">Review Mahasiswa</th>
				  <th colspan="3">Detail</th>
				  </tr>
				 
				<?php
				$no=$posisi+1;
				while($row=mysql_fetch_array($result_tampil))
				  {
				  $id=$row['id'];
				  $sql="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id'";
				  $execsql=mysql_query($sql);
				  $data=mysql_fetch_array($execsql);
			
				  $isi = $row['judul_praoutline'];
				  //$isi_baru = str_replace($multikey, $search_replace, $isi);
				  //$isi_display = substr($isi_baru, 0, 800);
				  //$isi_display = substr($isi_baru, 0, strrpos($isi_display, " "));
				  //echo "$isi_baru<br>";
				  $status=($row['status_review']=="1" ? "Opened" : "Closed");
				  $tgl_indo=tgli($row['A']);
				  $tgltetap=tgli($row['tgr']);
				  if ($row['kep_akhir']=="0")
				  {
					$kep = "<b>Tidak Disetujui</b>";
				  }
				  else if ($row['kep_akhir']=="1")
				  {
					$kep = "<b>Disetujui</b>";
				  }
				  else
				  {
					$kep = "<b>Dalam PROSES</b>";
				  }
				  
				  $cekdos=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb1]'");
				  $cekdosa=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb2]'");
				  $cekdosb=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng1]'");
				  $cekdosc=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng2]'");
				  $a = mysql_fetch_array($cekdos);
				  $b = mysql_fetch_array($cekdosa);
				  $c = mysql_fetch_array($cekdosb);
				  $d = mysql_fetch_array($cekdosc);
				echo "
				<tr>
				  <td align='center'><img src='../images/show.jpg'></td>
				  <td><a href='$file&urutan=$no&id_jud=$row[id]&halaman=$halaman'>$isi</a></td>
				  <td align='center'>$row[P]</td>
				  <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
				  <td align='center'>$data[rev]</td>
				  <td width='12%'>
				  Oleh : <font color=#583000><b>$row[N]</b></font><br>
				  Tanggal : $tgl_indo<br>
				  Waktu : $row[B]<br>
				  Status : <font color=#7BC409><b>$status</b></font>
				  </td>
				  <td width='2%'><a href='deletedesain.php?id=$id&keyword=$key&field=$field&halaman=$halaman' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus desain praoutline ini?')\"><img src='../images/delete.gif' title='Delete'></a></td>
				  <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
				</tr>
				<tr>
				  <td align='center'></td>
				  <td valign='top' colspan='2'><b>Judul Outline :</b><br>
				  $row[judul_out]</td>	
				  <td valign='top'><u>Keputusan Akhir : </u><br>
				  $kep</td>
				  <td colspan='6'><u>Keterangan</u><br>
				  Ditetapkan<br>
				  Tanggal : $tgltetap<br>
				  Pukul : $row[wktr]<br>
				  Semester : $row[semester]<br>
				  Tahun Akademik : $row[tahun_aj]	  	  
				  </td>
				</tr>
				<tr >
				<td colspan='9'>
				Pembimbing 1 : <b>$a[nama_dosen]</b>&nbsp;
				Pembimbing 2 : <b>$b[nama_dosen]</b>&nbsp;
				Penguji 1 : <b>$c[nama_dosen]</b>&nbsp;
				Penguji 2 : <b>$d[nama_dosen]</b>
				</td>
				</tr>
				";
				  $no++;
			
				 }
				  echo "
				  <tr colspan='9'>
			
				  </tr>";
				  echo "</table>";
				  
			  
			echo "<br><br><br>";
				echo "<div id='paging'>";
				 if ($halaman > 1)
				 {
				 $prevoius=$halaman-1;
				 echo "<A HREF=$file&halaman=1> << First</A> | <A HREF=$file&halaman=$previous> < Previous</A> | ";
				 }
				 else
				 {
				 echo "<< First | < Previous | ";
				 }
			
				 $angka=($halaman > 3 ? " ... " : " ");
				 for ($i=$halaman-2;$i<$halaman;$i++)
				 {
				   if ($i < 1)
					continue;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= " <b>$halaman</b> ";
				 for ($i=$halaman+1;$i<($halaman+3);$i++)
				 {
				   if ($i > $jmlhal)
					break;
				  $angka .= "<a href=$file&halaman=$i>$i</a> ";
				 }
			
				 $angka .= ($halaman+2<$jmlhal ? " ... <a href=$file&halaman=$jmlhal>$jmlhal</a> " : " ");
				 echo "$angka";
			
				 if ($halaman < $jmlhal)
				 {
				   $next=$halaman+1;
				  echo "<A HREF=$file&halaman=$next> Next > </A> | <A HREF=$file&halaman=$jmlhal> Last >> </A> ";
				 }
				 else
				 {
				   echo "| Next > | Last >>";
				 }
				 echo "</div>";
			}	 
	}
	}					
}

else
{
 /*if ($field=="carilain")
 {
 }
 else
 {*/
    $batas = 10;
    $query_hitung = "SELECT id, judul_praoutline, upload_mhs.NIM as 'N',
    COUNT(id_upload) as 'P',
    COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T'
    from upload_mhs 
	LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
	LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
	GROUP by id HAVING ";
          for ( $x = 0; $x<= $banyak_kata; $x++)
            {
            $query_hitung .= "$field like '%$multikey[$x]%'";
            if ( $x < $banyak_kata )
            {
              $query_hitung .= " AND ";
            }
          }
    $result = mysql_query($query_hitung);
    $jum = mysql_num_rows($result);
    $jmlhal = ceil($jum/$batas);
    $file = "judulpra_asli2.php?key=$key&field=$field";
    if ($jum == 0)
    {
    echo "<center><h1>Tidak terdapat record</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
    }
    else
    {
    $halaman = $_GET['halaman'];
    if (empty($halaman))
      {
        $posisi = 0;
        $halaman = 1;
      }
      else
      {
        $posisi = ($halaman-1) * $batas;
      }

    $query_tampil = "SELECT id,
	judul_praoutline,
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
    status_review,
    COUNT(id_upload) as 'P',
    COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T'
    from upload_mhs 
	LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
	LEFT JOIN rekap on upload_mhs.id=rekap.id_judul
	GROUP by id HAVING ";
      for ( $x = 0; $x<= $banyak_kata; $x++)
      {
        $query_tampil .= "$field like '%$multikey[$x]%'";
        if ( $x < $banyak_kata )
        {
          $query_tampil .= " AND ";
        }

      }
      $query_tampil .= "LIMIT $posisi,$batas";
      $result_tampil = mysql_query($query_tampil);

     for ( $x = 0; $x<= $banyak_kata; $x++)
      {
        $search_replace[$x] = "<b><font color='#000099'>$multikey[$x]</font></b>";
        //print "$search_replace[$x] ";
      }
    ?>
    <br><br>
    <table width="75%" align="center" class="utama">
      <tr>
      <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>List Desain Praoutline</b></td>
      </tr>
      <tr>
      <th width="4%"></th>
      <th width="50%">Judul Praoutline</th>
      <th width="10%">Review</th>
      <th width="10%">Putusan</th>
      <th width="10%">Review Mahasiswa</th>
      <th colspan="3">Detail</th>
      </tr>
     
    <?php
    $no=$posisi+1;
    while($row=mysql_fetch_array($result_tampil))
      {
      $id=$row['id'];
      $sql="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id'";
      $execsql=mysql_query($sql);
      $data=mysql_fetch_array($execsql);

      $isi = $row['judul_praoutline'];
      $isi_baru = str_replace($multikey, $search_replace, $isi);
      $isi_display = substr($isi_baru, 0, 800);
      //$isi_display = substr($isi_baru, 0, strrpos($isi_display, " "));
      //echo "$isi_baru<br>";
      $status=($row['status_review']=="1" ? "Opened" : "Closed");
      $tgl_indo=tgli($row['A']);
	  $tgltetap=tgli($row['tgr']);
	  if ($row['kep_akhir']=="0")
	  {
	  	$kep = "<b>Tidak Disetujui</b>";
	  }
	  else if ($row['kep_akhir']=="1")
	  {
	  	$kep = "<b>Disetujui</b>";
	  }
	  else
	  {
	  	$kep = "<b>Dalam PROSES</b>";
	  }
	  
	  $cekdos=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb1]'");
	  $cekdosa=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[pemb2]'");
	  $cekdosb=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng1]'");
	  $cekdosc=mysql_query("SELECT nama_dosen FROM data_dosen WHERE NIP='$row[peng2]'");
	  $a = mysql_fetch_array($cekdos);
	  $b = mysql_fetch_array($cekdosa);
	  $c = mysql_fetch_array($cekdosb);
	  $d = mysql_fetch_array($cekdosc);
    echo "
	<tr>
      <td align='center'><img src='../images/show.jpg'></td>
      <td><a href='$file&urutan=$no&id_jud=$row[id]&halaman=$halaman'>$isi_display</a></td>
      <td align='center'>$row[P]</td>
      <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
      <td align='center'>$data[rev]</td>
      <td width='12%'>
      Oleh : <font color=#583000><b>$row[N]</b></font><br>
      Tanggal : $tgl_indo<br>
      Waktu : $row[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
      <td width='2%'><a href='deletedesain.php?id=$id&keyword=$key&field=$field&halaman=$halaman' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus desain praoutline ini?')\"><img src='../images/delete.gif' title='Delete'></a></td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
    </tr>
	<tr>
	  <td align='center'></td>
      <td valign='top' colspan='2'><b>Judul Outline :</b><br>
	  $row[judul_out]</td>	
	  <td valign='top'><u>Keputusan Akhir : </u><br>
	  $kep</td>
	  <td colspan='6'><u>Keterangan</u><br>
	  Ditetapkan<br>
	  Tanggal : $tgltetap<br>
	  Pukul : $row[wktr]<br>
	  Semester : $row[semester]<br>
	  Tahun Akademik : $row[tahun_aj]	  	  
	  </td>
	</tr>
	<tr >
	<td colspan='9'>
	Pembimbing 1 : <b>$a[nama_dosen]</b>&nbsp;
	Pembimbing 2 : <b>$b[nama_dosen]</b>&nbsp;
	Penguji 1 : <b>$c[nama_dosen]</b>&nbsp;
	Penguji 2 : <b>$d[nama_dosen]</b>
	</td>
	</tr>
	";
      $no++;

     }
      echo "
      <tr colspan='9'>

      </tr>";
      echo "</table>";
	  
  }
echo "<br><br><br>";
    echo "<div id='paging'>";
     if ($halaman > 1)
     {
     $prevoius=$halaman-1;
     echo "<A HREF=$file&halaman=1> << First</A> | <A HREF=$file&halaman=$previous> < Previous</A> | ";
     }
     else
     {
     echo "<< First | < Previous | ";
     }

     $angka=($halaman > 3 ? " ... " : " ");
     for ($i=$halaman-2;$i<$halaman;$i++)
     {
       if ($i < 1)
        continue;
      $angka .= "<a href=$file&halaman=$i>$i</a> ";
     }

     $angka .= " <b>$halaman</b> ";
     for ($i=$halaman+1;$i<($halaman+3);$i++)
     {
       if ($i > $jmlhal)
        break;
      $angka .= "<a href=$file&halaman=$i>$i</a> ";
     }

     $angka .= ($halaman+2<$jmlhal ? " ... <a href=$file&halaman=$jmlhal>$jmlhal</a> " : " ");
     echo "$angka";

     if ($halaman < $jmlhal)
     {
       $next=$halaman+1;
      echo "<A HREF=$file&halaman=$next> Next > </A> | <A HREF=$file&halaman=$jmlhal> Last >> </A> ";
     }
     else
     {
       echo "| Next > | Last >>";
     }
     echo "</div>";
    
	echo "<br><br>";
	echo "&nbsp;&nbsp;&nbsp;SPOTA Forums Copyright Teknik Informatika 2009 (Versi 1.1)&nbsp;&nbsp;&nbsp;<a href='admin-spota.php?part=judul'>Pencarian</a>";
 } 
?>
</div>
</body>
</html>