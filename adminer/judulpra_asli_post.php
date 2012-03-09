<?php
include "../sambung.inc.php";
include "converttanggal.php";
//include "search.inc.php";
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
<body>
<?php
//$form = new searching("admin-spota.php","$_POST[key]","Search");
//$form->addoption("NIM");
//$form->addoption("Judul");
//$form->tamsearchform();
if(!isset($_POST['submit']))
{
//echo "<form method='POST' action='admin-spota.php?part=judul'>";
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
    <td colspan='3' align='center'><input type='submit' name='submit' value='Cari Desain Praoutline' class='spesial'>&nbsp;<input type='reset' value='Reset Kata Kunci' class='spesial'></td>
  </tr>";
echo "</table>";
echo "</form>";
}
else
{
$field = $_POST['field'];
$key = $_POST['key'];
//echo "$field";
$key = trim($key);
//echo "$key<br>";
$multikey = explode(" ",$key);
//echo "$multikey[1]<br>";
$banyak_kata = (integer)count($multikey);
//echo "$banyak_kata<br>";
if ($key == NULL or $key == '%')
{
  echo "<center><h1>Kata kunci kosong</h1> Kembali ke <a href='admin-spota.php?part=judul'>Menu Pencarian</a></center>";
}
else
{		
		$batas = 10;
		$query_hitung = "SELECT id, judul_praoutline, 
		COUNT(id_upload) as 'P', 
		COUNT(IF(jenis_rev=0,1,null)) as 'Q', 
		COUNT(IF(jenis_rev=1,1,null)) as 'R', 
		COUNT(IF(hasil='0',1,null)) as 'S', 
		COUNT(IF(hasil=1,1,null)) as 'T' 
		from upload_mhs LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload GROUP by id HAVING ";
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
	  $file = "admin-spota.php?part=judul&keyword=$key";
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
		
		$query_tampil = "SELECT id,judul_praoutline,
		NIM,
		upload_mhs.tanggal as 'A',
		upload_mhs.waktu as 'B',
		status_review,
		status_upload,
		COUNT(id_upload) as 'P',
		COUNT(IF(jenis_rev=0,1,null)) as 'Q',
		COUNT(IF(jenis_rev=1,1,null)) as 'R', 
		COUNT(IF(hasil='0',1,null)) as 'S',
		COUNT(IF(hasil=1,1,null)) as 'T' 
		from upload_mhs LEFT JOIN review_praoutline on upload_mhs.id=review_praoutline.id_upload GROUP by id HAVING ";
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
		<table width="75%" align="center" class="utama">
		  <tr>
			<td colspan="8">List Desain Praoutline</td>
		  </tr>
		  <tr>
			<th width="4%"></th>
			<th width="50%">Judul Praoutline</th>
			<th width="10%">Review Dosen</th>
			<th width="10%">Putusan</th>
			<th width="10%">Review Mahasiswa</th>
			<th colspan="3">Detail</th>
		  </tr>
		 <tr>
		<?php
		$no=$posisi+1;
		while($row=mysql_fetch_array($result_tampil))
		  {
		  $id=$row['id'];
		  $sql="SELECT COUNT(id_judul) as 'rev' FROM review_mhs WHERE id_judul='$id' and status='1'";
		  $execsql=mysql_query($sql);
		  $data=mysql_fetch_array($execsql);
		  
		  $isi = $row['judul_praoutline'];
		  $isi_baru = str_replace($multikey, $search_replace, $isi);
		  $isi_display = substr($isi_baru, 0, 800);
		  //$isi_display = substr($isi_baru, 0, strrpos($isi_display, " "));
		  //echo "$isi_baru<br>";
		  $status=($row['status_review']=="1" ? "Opened" : "Closed");
		  $tgl_indo=tgli($row['A']);
		echo "	  
			<td align='center'><img src='../images/show.jpg'></td>
			<td><a href='$file&urutan=$no&id_jud=$row[id]&halaman=$halaman'>$isi_display</a></td>
			<td align='center'>$row[P]</td>
			<td align='center'>$row[R]<br><br>Y : <font color=#01016F><b>$row[T]</b></font> -- N : <font color=#FA0303><b>$row[S]</b></font></td>
			<td align='center'>$data[rev]</td>
			<td width='12%'>
			Oleh : <font color=#583000><b>$row[NIM]</b></font><br>
			Tanggal : $tgl_indo<br>
			Waktu : $row[B]<br>
			Status : <font color=#7BC409><b>$status</b></font>
			</td>
			<td width='2%'><a href='deletedesain.php?id=$id&keyword=$key&halaman=$halaman' onclick=\"return confirm('Apakah Anda benar-benar akan menghapus desain praoutline ini?')\"><img src='../images/delete.gif' title='Delete'></a></td>
			<td width='2%'>&nbsp;<a href='#$no'>#$no</a></td>
		  </tr>";
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
echo "<br><br>";

}
 
}
/*echo 
"<div>
<form method='POST' action='admin-spota.php?part=judul'>
Pencarian: <input type='text' name='key' value='$key'>&nbsp;
Berdasarkan ";
if ($field=='judul_praoutline')
{
	echo 
	"<input type='radio' name='field' value 'judul_praoutline' checked>Judul Praoutline
	<input type='radio' name='field' value 'nim'>NIM";
}
if ($field=='NIM')
{
	echo 
	"<input type='radio' name='field' value 'judul_praoutline'>Judul Praoutline
	<input type='radio' name='field' value 'NIM' checked>NIM";
}
echo "&nbsp;<input type='submit' name='submit' value='Cari Kata Kunci'></form>";
echo "</div>";*/
?>
</body>
</html>