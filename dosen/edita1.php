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
<script type="text/javascript" src="ed.js"></script>
</head>
<body class="admin">
<div id="header"></div>
<?php include "menu.php"; ?>
<?php
$del = $_POST['delete'];
$reviewer = $initid;
$rev_text = $_POST['review_text'];
$rev_text = trim($rev_text);
$rev_text = ereg_replace("(\r\n|\n|\r)", "",$rev_text);
$jbr = substr_count($rev_text,"<br>");
$cek=explode("<br>",$rev_text);
for ($i=0;$i<=$jbr;$i++)
{
	$revi=$revi.trim($cek[$i]);		
}
$max_file = 3072000;
$tipe_file = $_FILES['suara']['type'];
$lokasi_file = $_FILES['suara']['tmp_name'];
$nama_file = $_FILES['suara']['name'];
$ukuran_file = $_FILES['suara']['size'];
$jenis_rev = $_POST['jenis_rev'];
$hasil = $_POST['hasil'];
$id_rev = $_POST['id'];
$id_jud = $_POST['id_ju'];
$key=$_POST['key'];
$field=$_POST['field'];
$urutan=$_POST['urutan'];
$halaman=$_POST['halaman'];
//$kode=$_POST['kode'];
$urutan_rep=$_POST['urutan_rep'];
$acak = rand(0000,9999);
$nama_ubah = $acak.'-'.$reviewer.'-'.$nama_file;
$direktori = "../dosen-spota/upload/$nama_ubah";
$panggil = mysql_query("SELECT review_sound FROM review_praoutline WHERE id_review='$id_rev'");
$sh = mysql_fetch_array($panggil);
$revsoh = $sh['review_sound'];

if (($revi == NULL or $revi == '%') and (empty($lokasi_file)))
{
	if ($revsoh==NULL)
	{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
	}
	else
	{
		if ($del=="1")
		{
		echo "
		<div id='warning'>
		<center><h1>Review bernilai kosong</h1><br>";
		echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
		echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
		}
		else
		{
			if ($jenis_rev=="")
			{
				$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text' WHERE id_review='$id_rev'");
				echo "
				<div id='warning'>
				<center><h1>Edit Post Berhasil</h1><br>";
				echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";								
			}
			else if ($jenis_rev=="0")
			{
				$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='0', hasil='' WHERE id_review='$id_rev'");
				echo "
				<div id='warning'>
				<center><h1>Edit Post Berhasil</h1><br>";
				echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
				echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
			}
			else
			{
				if($hasil!="")
				{
						$cek = mysql_query("SELECT reviewer, jenis_rev FROM review_praoutline WHERE id_review='$id_rev'");
						$docek=mysql_fetch_array($cek);
						if ($docek['jenis_rev']=="1")
						{
							$sql = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', hasil='$hasil' WHERE id_review='$id_rev'");
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
						}
						else
						{
							$cek1 = mysql_query("SELECT id_review FROM review_praoutline WHERE id_upload='$id_jud' and jenis_rev='1' and reviewer='$docek[reviewer]'");
							$docek1=mysql_fetch_array($cek1);
							if ($docek1['id_review']!=NULL)
							{
								$sql1= mysql_query("UPDATE review_praoutline SET jenis_rev='0', hasil='' WHERE id_review='$docek1[id_review]'");
								$sql2= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
								echo "
								<div id='warning'>
								<center><h1>Edit Post Berhasil</h1><br>";
								echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
								echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
							
							}
							else
							{
								$sql3= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
								echo "
								<div id='warning'>
								<center><h1>Edit Post Berhasil</h1><br>";
								echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
								echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
							}
						}
				}
				else
				{
					echo "
						<div id='warning'>
						<center><h1>Anda tidak memilih putusan</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
				}	
			}
		}	
	}		
}
//Cek jika suara tidak kosong
else if (($revi == NULL or $revi == '%') and !empty($lokasi_file))
	{
		if ($jenis_rev=="")
		{
			if ($tipe_file == "audio/mpeg")
				{
				if ($ukuran_file > $max_file or $ukuran_file == 0)	
					{
						echo "
						<div id='warning'>
						<center><h1>MP3 yang diupload terlalu besar</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
					}		
				else
					{//
					if (move_uploaded_file($lokasi_file,$direktori))
					{
						$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah' WHERE id_review='$id_rev'");					
						/*if ($revsoh!=NULL)
						{					
							unlink("../dosen-spota/upload/$revsoh");
						}*/
						echo "
						<div id='warning'>
						<center><h1>Edit Post Berhasil</h1><br>";
						echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";											
					}
					}	
				}
			else
				{
					echo "
						<div id='warning'>
						<center><h1>File bukan bertipe mp3</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
				}				
		}
		else if ($jenis_rev=="0")
		{
			if ($tipe_file == "audio/mpeg")
				{
				if ($ukuran_file > $max_file or $ukuran_file == 0)	
					{
						echo "
						<div id='warning'>
						<center><h1>MP3 yang diupload terlalu besar</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
					}						
				else
					{//
					//unlink("../dosen-spota/upload/$revsoh");
					if (move_uploaded_file($lokasi_file,$direktori))
					{
					$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='0', hasil='' WHERE id_review='$id_rev'");
						/*if ($revsoh!=NULL)
						{					
							unlink("../dosen-spota/upload/$revsoh");
						}*/
						echo "
						<div id='warning'>
						<center><h1>Edit Post Berhasil</h1><br>";
						echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";										
					}
					}					
				}
			else
				{
				echo"
					<div id='warning'>
						<center><h1>File bukan bertipe mp3</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
				}					
		}
		else
		{
			if($hasil!="")
			{
					$cek = mysql_query("SELECT reviewer,review_text,review_sound,jenis_rev FROM review_praoutline WHERE id_review='$id_rev'");
					$docek=mysql_fetch_array($cek);
					if ($docek['jenis_rev']=="1")
					{
						if ($tipe_file == "audio/mpeg")
							{
							if ($ukuran_file > $max_file or $ukuran_file == 0)	
							{
								echo "
								<div id='warning'>
								<center><h1>MP3 yang diupload terlalu besar</h1><br>";
								echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
								echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
							}
							else
							{//
								//unlink("../dosen-spota/upload/$revsoh");
								if (move_uploaded_file($lokasi_file,$direktori))
								{								
								$sql = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', hasil='$hasil' WHERE id_review='$id_rev'");
									/*if ($revsoh!=NULL)
									{					
										unlink("../dosen-spota/upload/$revsoh");
									}*/
									echo "
									<div id='warning'>
									<center><h1>Edit Post Berhasil</h1><br>";
									echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
									echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";										
									
								}
							}	
							}								
						else	
							{
								echo"
								<div id='warning'>
									<center><h1>File bukan bertipe mp3</h1><br>";
									echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
									echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
							}									
					}
					else
					{
						$cek1 = mysql_query("SELECT id_review, review_text, review_sound FROM review_praoutline WHERE id_upload='$id_jud' and jenis_rev='1' and reviewer='$docek[reviewer]'");
						$docek1=mysql_fetch_array($cek1);
						if ($docek1['id_review']!=NULL)
						{
							if ($tipe_file == "audio/mpeg")
								{
								if ($ukuran_file > $max_file or $ukuran_file == 0)	
								{
									echo "
									<div id='warning'>
									<center><h1>MP3 yang diupload terlalu besar</h1><br>";
									echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
									echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
								}
								else
								{//
									//unlink("../dosen-spota/upload/$docek1[review_sound]");
									//unlink("../dosen-spota/upload/$revsoh");
									if (move_uploaded_file($lokasi_file,$direktori))
									{
										$sql1= mysql_query("UPDATE review_praoutline SET jenis_rev='0', hasil='' WHERE id_review='$docek1[id_review]'");
										$sql2= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
										/*if ($revsoh!=NULL)
											{					
												unlink("../dosen-spota/upload/$revsoh");
											}*/
										echo "
										<div id='warning'>
										<center><h1>Edit Post Berhasil</h1><br>";
										echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";											
									}
								}
								}
							else
								{
									echo"
									<div id='warning'>
										<center><h1>File bukan bertipe mp3</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
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
									echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
									echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
								}								
								else
								{//
									//unlink("../dosen-spota/upload/$revsoh");
									if (move_uploaded_file($lokasi_file,$direktori))
									{
										$sql3= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
										/*if ($revsoh!=NULL)
											{					
												unlink("../dosen-spota/upload/$revsoh");
											}*/
										echo "
										<div id='warning'>
										<center><h1>Edit Post Berhasil</h1><br>";
										echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";											
									}
								}
								}
							else
								{
									echo"
									<div id='warning'>
										<center><h1>File bukan bertipe mp3</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
								}												
						}
					}
			}
			else
			{
				echo "
						<div id='warning'>
						<center><h1>Anda tidak memilih putusan</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
			}	
		}
	}
//Cek jika text tidak kosong
else if (($revi != NULL or $revi != '%') and empty($lokasi_file)) 
	{
					
		if ($jenis_rev=="")
		{
			if ($del=="1")
			{
			//unlink("../dosen-spota/upload/$revsoh");
			$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='' WHERE id_review='$id_rev'");			
			echo "
			<div id='warning'>
			<center><h1>Edit Post Berhasil</h1><br>";
			echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
			}
			else
			{
			$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text' WHERE id_review='$id_rev'");
			echo "
			<div id='warning'>
			<center><h1>Edit Post Berhasil</h1><br>";
			echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
			}		
		}
		else if ($jenis_rev=="0")
		{
			if ($del=="1")
			{
			//unlink("../dosen-spota/upload/$revsoh");
			$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='', jenis_rev='0', hasil='' WHERE id_review='$id_rev'");
			echo "
			<div id='warning'>
			<center><h1>Edit Post Berhasil</h1><br>";
			echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
			}
			else
			{
			$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='0', hasil='' WHERE id_review='$id_rev'");
			echo "
			<div id='warning'>
			<center><h1>Edit Post Berhasil</h1><br>";
			echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
			echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
			}
		}
		else
		{
			if($hasil!="")
			{
					$cek = mysql_query("SELECT reviewer, jenis_rev FROM review_praoutline WHERE id_review='$id_rev'");
					$docek=mysql_fetch_array($cek);
					if ($docek['jenis_rev']=="1")
					{
					   if ($del=="1")
						{
						//unlink("../dosen-spota/upload/$revsoh");
						$sql = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='', hasil='$hasil' WHERE id_review='$id_rev'");
						echo "
						<div id='warning'>
						<center><h1>Edit Post Berhasil</h1><br>";
						echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

						}
						else
						{
						$sql = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', hasil='$hasil' WHERE id_review='$id_rev'");
						echo "
						<div id='warning'>
						<center><h1>Edit Post Berhasil</h1><br>";
						echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

						}
					}
					else
					{
						$cek1 = mysql_query("SELECT id_review FROM review_praoutline WHERE id_upload='$id_jud' and jenis_rev='1' and reviewer='$docek[reviewer]'");
						$docek1=mysql_fetch_array($cek1);
						if ($docek1['id_review']!=NULL)
						{
							$sql1= mysql_query("UPDATE review_praoutline SET jenis_rev='0', hasil='' WHERE id_review='$docek1[id_review]'");
							if ($del=="1")
							{
							//unlink("../dosen-spota/upload/$revsoh");							
							$sql2= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

							}
							else
							{
							$sql2= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

							}												
						}
						else
						{
							if ($del=="1")
							{
							//unlink("../dosen-spota/upload/$revsoh");		
							$sql3= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

							}
							else
							{
							$sql3= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

							}
						}
					}
			}
			else
			{
				echo "
						<div id='warning'>
						<center><h1>Anda tidak memilih putusan</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
			}	
		}
	}
	
//cek jika suara dan text tidak kosong	
else
	{
		if ($jenis_rev=="")
		{
			if ($tipe_file == "audio/mpeg")
				{
				if ($ukuran_file > $max_file or $ukuran_file == 0)	
					{
						echo "
						<div id='warning'>
						<center><h1>MP3 yang diupload terlalu besar</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
					}		
				else
					{//
					if (move_uploaded_file($lokasi_file,$direktori))
					{
					
					$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah' WHERE id_review='$id_rev'");
					//
							/*if ($revsoh!=NULL)
							{					
								unlink("../dosen-spota/upload/$revsoh");
							}	*/
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

					}
					}
				}
			else
				{
					echo"
					<div id='warning'>
					<center><h1>File bukan bertipe mp3</h1><br>";
					echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
				}				
		}
		else if ($jenis_rev=="0")
		{
			if ($tipe_file == "audio/mpeg")
				{
				if ($ukuran_file > $max_file or $ukuran_file == 0)	
					{
						echo "
						<div id='warning'>
						<center><h1>MP3 yang diupload terlalu besar</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
					}		
				else
					{//
					if (move_uploaded_file($lokasi_file,$direktori))
					{
					
					$no = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='0', hasil='' WHERE id_review='$id_rev'");
					//unlink("../dosen-spota/upload/$revsoh");
					/*if ($revsoh!=NULL)
							{					
								unlink("../dosen-spota/upload/$revsoh");
							}*/	
							echo "
							<div id='warning'>
							<center><h1>Edit Post Berhasil</h1><br>";
							echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
							echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

					}
					}
				}
			else
				{
					echo"
					<div id='warning'>
					<center><h1>File bukan bertipe mp3</h1><br>";
					echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
					echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
				}					
		}
		else
		{
			if($hasil!="")
			{
					$cek = mysql_query("SELECT reviewer, jenis_rev FROM review_praoutline WHERE id_review='$id_rev'");
					$docek=mysql_fetch_array($cek);
					if ($docek['jenis_rev']=="1")
					{
						if ($tipe_file == "audio/mpeg")
						{
						if ($ukuran_file > $max_file or $ukuran_file == 0)	
							{
								echo "
								<div id='warning'>
								<center><h1>MP3 yang diupload terlalu besar</h1><br>";
								echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
								echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
							}		
						else
							{//
								if (move_uploaded_file($lokasi_file,$direktori))
								{
								
								$sql = mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', hasil='$hasil' WHERE id_review='$id_rev'");
								//unlink("../dosen-spota/upload/$revsoh");
								/*if ($revsoh!=NULL)
									{					
										unlink("../dosen-spota/upload/$revsoh");
									}*/	
									echo "
									<div id='warning'>
									<center><h1>Edit Post Berhasil</h1><br>";
									echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
									echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

								}
							}	
							}
						else	
							{
								echo"
									<div id='warning'>
										<center><h1>File bukan bertipe mp3</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
							}									
					}
					else
					{
						$cek1 = mysql_query("SELECT id_review FROM review_praoutline WHERE id_upload='$id_jud' and jenis_rev='1' and reviewer='$docek[reviewer]'");
						$docek1=mysql_fetch_array($cek1);
						if ($docek1['id_review']!=NULL)
						{
							if ($tipe_file == "audio/mpeg")
								{
								if ($ukuran_file > $max_file or $ukuran_file == 0)	
									{
										echo "
										<div id='warning'>
										<center><h1>MP3 yang diupload terlalu besar</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
									}		
								else
									{//
									if (move_uploaded_file($lokasi_file,$direktori))
									{
										
										$sql1= mysql_query("UPDATE review_praoutline SET jenis_rev='0', hasil='' WHERE id_review='$docek1[id_review]'");
										$sql2= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
										//
										//unlink("../dosen-spota/upload/$revsoh");
										/*if ($revsoh!=NULL)
										{					
											unlink("../dosen-spota/upload/$revsoh");
										}	*/
										echo "
										<div id='warning'>
										<center><h1>Edit Post Berhasil</h1><br>";
										echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					

									}
									}
								}
							else
								{
									echo"
									<div id='warning'>
										<center><h1>File bukan bertipe mp3</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
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
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
									}		
								else
									{//
									if (move_uploaded_file($lokasi_file,$direktori))
									{
										
										$sql3= mysql_query("UPDATE review_praoutline SET review_text='$rev_text', review_sound='$nama_ubah', jenis_rev='1', hasil='$hasil' WHERE id_review='$id_rev'");
										//
										/*if ($revsoh!=NULL)
											{					
												unlink("../dosen-spota/upload/$revsoh");
											}*/	
										echo "
										<div id='warning'>
										<center><h1>Edit Post Berhasil</h1><br>";
										echo "Klik <a href='reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'>ini</a> untuk kembali ke List Desain Praoutline<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=reviewdos2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$urutan_rep'></center></div>";					
	
									}
									}
								}
							else
								{
									echo"
									<div id='warning'>
										<center><h1>File bukan bertipe mp3</h1><br>";
										echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
										echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
								}												
						}
					}
			}
			else
			{
				echo "
						<div id='warning'>
						<center><h1>Anda tidak memilih putusan</h1><br>";
						echo "Klik <a href='edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'>ini</a> untuk kembali ke menu Edit Post<br><br>";
						echo "<meta http-equiv='refresh' content='3;URL=edita.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman&id_rev=$id_rev&urutan_rep=$urutan_rep'></center></div>";
			}	
		}
	}
	
	


?>
</body>
</html>
