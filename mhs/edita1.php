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
$del = $_POST['delete'];
//$reviewer = $_POST['reviewer'];
$rev_text = $_POST['review_text'];
$rev_text = trim($rev_text);
$rev_text = htmlentities($rev_text);
$max_file = 3072000;
$tipe_file = $_FILES['suara']['type'];
$lokasi_file = $_FILES['suara']['tmp_name'];
$nama_file = $_FILES['suara']['name'];
$ukuran_file = $_FILES['suara']['size'];
$id_rev = $_POST['id'];
$id_jud = $_POST['id_ju'];
$urutan_rep=$_POST['urutan_rep'];

$acak = rand(0000,9999);
$nama_ubah = $acak.'-'.$initid.'-'.$nama_file;
$direktori = "../dosen-spota/upload/$nama_ubah";
$panggil = mysql_query("SELECT review_sound FROM review_praoutline WHERE id_review='$id_rev'");
$sh = mysql_fetch_array($panggil);
$revsoh = $sh['review_sound'];

if (($rev_text==NULL or $rev_text=='%') and (empty($lokasi_file)))
{
	if ($revsoh==NULL)
	{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
	}
	else
	{
		if ($del=="1")
		{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
		}
		else
		{
		$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text' WHERE id_review='$id_rev'");
		echo "
		<div id='warning'>
		<center><h1>Edit Post berhasil</h1><br>";
		echo "Klik <a href='hasilrev1.php?id_jud=$id_jud#$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#$urutan_rep'></center></div>";
		}
	}
}

else if (($rev_text == NULL or $rev_text == '%') and (!empty($lokasi_file)))
{
	if ($tipe_file == "audio/mpeg")
		{
		if ($ukuran_file > $max_file or $ukuran_file == 0)	
			{
			echo "
			<div id='warning'>
			<center><h1>MP3 yang diupload terlalu besar</h1><br>";
			echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
			}		
		else
			{
			if (move_uploaded_file($lokasi_file,$direktori))
					{
						$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah' WHERE id_review='$id_rev'");					
						if ($revsoh!=NULL)
						{					
							unlink("../dosen-spota/upload/$revsoh");
						}
						echo "
						<div id='warning'>
						<center><h1>Edit Post berhasil</h1><br>";
						echo "Klik <a href='hasilrev1.php?id_jud=$id_jud#$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#$urutan_rep'></center></div>";
					}
						
			}
		}
	else
		{
		echo "
			<div id='warning'>
			<center><h1>Tipe file bukan MP3</h1><br>";
			echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
		}
}

else if (($rev_text != NULL or $rev_text != '%') and (empty($lokasi_file))) 
{
	if ($del=="1")
	{
		unlink("../dosen-spota/upload/$revsoh");
		$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='' WHERE id_review='$id_rev'");
		echo "
		<div id='warning'>
		<center><h1>Edit Post berhasil</h1><br>";
		echo "Klik <a href='hasilrev1.php?id_jud=$id_jud#$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#$urutan_rep'></center></div>";
	}
	else
	{
	$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text' WHERE id_review='$id_rev'");
	echo "
	<div id='warning'>
	<center><h1>Edit Post berhasil</h1><br>";
	echo "Klik <a href='hasilrev1.php?id_jud=$id_jud#$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
	echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#$urutan_rep'></center></div>";
	}
	
}

else
{
if ($tipe_file == "audio/mpeg")
		{
		if ($ukuran_file > $max_file or $ukuran_file == 0)	
			{
			echo "
			<div id='warning'>
			<center><h1>MP3 yang diupload terlalu besar</h1><br>";
			echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
			}		
		else
			{
			if (move_uploaded_file($lokasi_file,$direktori))
					{
						$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah' WHERE id_review='$id_rev'");					
						if ($revsoh!=NULL)
						{					
							unlink("../dosen-spota/upload/$revsoh");
						}
						echo "
						<div id='warning'>
						<center><h1>Edit Post berhasil</h1><br>";
						echo "Klik <a href='hasilrev1.php?id_jud=$id_jud#$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=hasilrev1.php?id_jud=$id_jud#$urutan_rep'></center></div>";
					}
						
			}
		}
	else
		{
		echo "
			<div id='warning'>
			<center><h1>Tipe file bukan MP3</h1><br>";
			echo "Klik <a href='edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=edita.php?id_jud=$id_jud&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
		}
}
?>

</body>
</html>
