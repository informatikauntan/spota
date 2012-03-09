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
    
$task=$_GET['task'];
$jenis_rev=$_GET['jenis_rev'];
$rad=$_GET['rad'];
$aktif=$_GET['aktif'];
$sem=$_GET['sem'];
if ($task=="berkas")
{
if ($aktif!=NULL)
{
sleep(3);
echo "<object data='$aktif' type='application/pdf' width='100%' height='60%'></object>";
}
}
 
 
if ($task=="tampil")
{
	if($jenis_rev=="1")
	{
	sleep(3);
	echo "<input type='radio' name='hasil' value='1'>Setuju&nbsp;<input type='radio' name='hasil' value='0'>Tidak Setuju";	
	}
} 

if ($task=="tsemang")
{
	if($sem=="carilain")
	{
	sleep(1);
	echo "
	<select name='semester'>
	<option value=''>--Pilih Semester--</option>
	<option value='GAZAL'>GAZAL</option>
	<option value='GENAP'>GENAP</option>
	</select>";
	
	$sqlcar=mysql_query("SELECT ang FROM tahun_ang");
	echo 
	"
	<select name='tahun'>
	<option value=''>--Pilih Tahun Akademik--</option>";
	while ($hasilcar=mysql_fetch_array($sqlcar))
	{
	echo "<option value='$hasilcar[ang]'>$hasilcar[ang]</option>";
	}
	
	echo "
	</select>
	";
	}
	else
	{
	sleep(1);
	echo "<input type='text' name='key' size='50'>";
	}
}

if ($task=="tradio")
{
	if($rad=="ad")
	{
	sleep(1);
		echo"<input type='radio' name='penerima' value='dosen' onClick='rec(this.value)'>Dosen
		    <input type='radio' name='penerima' value='mhs' onClick='rec(this.value)'>Mahasiswa
			<input type='radio' name='penerima' value='khusus' onClick='rec(this.value)'>Khusus";
			echo "<div id='acp'></div>";
	}
}	



if ($task=="tcombo")
{
	if($rad=="dosen")
	{
	sleep(1);
	$sql=mysql_query("SELECT NIP, nama_dosen FROM data_dosen");
	echo 
	"
	<select name='receiver'>
	<option value=''>--Pilih Nama Dosen--</option>";
	while ($hasil=mysql_fetch_array($sql))
	{
	echo "<option value='$hasil[NIP]'>$hasil[nama_dosen]</option>";
	}
	
	echo "
	</select>
	";
	}
	
	if($rad=="mhs")
	{
	sleep(1);
	$sql=mysql_query("SELECT NIM, nama_mhs FROM data_mahasiswa ORDER BY angkatan");
	echo 
	"
	<select name='receiver'>
	<option value=''>--Pilih Nama Mahasiswa--</option>";
	while ($hasil=mysql_fetch_array($sql))
	{
	echo "<option value='$hasil[NIM]'>$hasil[NIM] :: $hasil[nama_mhs]</option>";
	}	
	echo "
	</select>
	";
	}
	
	if ($rad=="khusus")
	{
	sleep(1);
	echo 
	"
	<select name='receiver'>
	<option value=''>--Pilih Jabatan--</option>
	<option value='kaprodi'>Kepala Prodi</option>
	<option value='superadmin'>Administrator</option>
	</select>
	";
	}
}	

?>