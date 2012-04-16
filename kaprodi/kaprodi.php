<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['kapro']))
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
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<div id="main">
<?php include "menu.php"; ?>
</div>
<?php
$batas = 10;
$sql = mysql_query("SELECT id FROM upload_mhs WHERE status_review='1'");
$jum = mysql_num_rows($sql);
$jmlhal = ceil($jum/$batas);
$file = "kaprodi.php?";

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

    $query_tampil = "SELECT id,judul_praoutline,
    NIM,
    upload_mhs.tanggal as 'A',
    upload_mhs.waktu as 'B',
    status_review,
    COUNT(id_upload) as 'P',
    COUNT(IF(jenis_rev=0,1,null)) as 'Q',
    COUNT(IF(jenis_rev=1,1,null)) as 'R',
    COUNT(IF(hasil='0',1,null)) as 'S',
    COUNT(IF(hasil=1,1,null)) as 'T'
    from upload_mhs LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload 
	GROUP by id HAVING status_review='1' ORDER BY id DESC";
	//$query_tampil .= " LIMIT $posisi,$batas";
      $result_tampil = mysql_query($query_tampil);
?>
<br><br>
<table width="75%" align="center" class="utama">
      <tr>
      <td colspan="8"><img src="../images/topic.gif">&nbsp;<b>Desain Praoutline Dengan Status Opened</b></td>
      </tr>
      <tr>
      <th width="4%"></th>
      <th width="50%">Judul Praoutline</th>
      <th width="10%">Review</th>
      <th width="10%">Putusan</th>
      <th width="10%">Review Mahasiswa</th>
      <th colspan="3">Detail</th>
      </tr><tr>
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
	  /*if ($row['T'] > $row['S']) 
	  {
	  	$link = "ubahstatus.php?act=app&id=$id&halaman=$halaman&punya=$row[NIM]' onclick=\"return confirm('Apakah Anda benar-benar akan menutup desain praoutline ini?')\"";
	  }
	  else if ($row['T'] < $row['S'])
	  {
	  	$link = "ubahstatus.php?act=dis&id=$id&halaman=$halaman&punya=$row[NIM]' onclick=\"return confirm('Apakah Anda benar-benar akan menutup desain praoutline ini?')\"";
	  }
	  else
	  {*/
	    $link = "lbhjauh.php?id=$id&halaman=$halaman&punya=$row[NIM]&urutan=$no";
	  //}
    echo "
      <td align='center'><img src='../images/show.jpg'></td>
      <td><font color='#B61C03'><b>$isi</b></font></td>
      <td align='center'>$row[P]</td>
      <td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
      <td align='center'>$data[rev]</td>
      <td width='12%'>
      Oleh : <font color=#583000><b>$row[NIM]</b></font><br>
      Tanggal : $tgl_indo<br>
      Waktu : $row[B]<br>
      Status : <font color=#7BC409><b>$status</b></font>
      </td>
	  <td width='2%'><a href='$link'><img src='../images/tutup.gif' title='Tutup'></a></td>
      <td width='2%'><a name='$no'><a href='#'><img src='images/top.gif'></a></a></td>
      </tr>";
      $no++;

      }
      echo "
      <tr colspan='8'>

      </tr>";
      echo "</table>";
	?>
<br><br>   	 
<div id="footer">
	<?php include "../footer.php"; ?>
</div>
</body>
</html>