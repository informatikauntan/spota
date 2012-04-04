<?php
include "../sambung.inc.php";
session_start();
 $rand = session_id();
if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }
 $initid=strtoupper($_SESSION['nim']);
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
<script type="text/javascript" src="chrome.js"></script>
</head>
<body class="mhs">
<div id="header"></div>
<?php include "menu.php"; ?>
<?php
$lokasi_file = $_FILES['upldes']['tmp_name'];
$ukuran_file = $_FILES['upldes']['size'];
$jenis_file = $_FILES['upldes']['type'];
$nama_file = $_FILES['upldes']['name'];
$max = 2048000;
$acak = rand(0000,9999);
$nama_ubah = $acak.'-'.strtoupper($_SESSION['nim']).'-'.$nama_file;
$juduldes = strip_tags(strtoupper($_POST['juduldes']));
$juduldes = trim($juduldes);
$direktori = "desain/$nama_ubah";
$waktu=date("H:i:s");


if (($juduldes==NULL or $juduldes == '%') or (empty($lokasi_file)))
{
  echo
  "
  <div id='warning'><center>
  <h2>Judul bernilai kosong atau berkas bernilai kosong</h2><br>Klik <a href='uploaddes.php'>ini</a> untuk kembali menu Upload";
  echo "<meta http-equiv='refresh' content='3;URL=uploaddes.php'></center><br></div>";
}
else
{
  if ($jenis_file!="application/pdf")
  {
  echo
  "
  <div id='warning'><center>
  <h2>Tipe berkas harus <u>pdf</u></h2><br>Klik <a href='uploaddes.php'>ini</a> untuk kembali menu Upload";
  echo "<meta http-equiv='refresh' content='3;URL=uploaddes.php'></center><br></div>";
  }
  else
  {
   if ($ukuran_file > $max)
    {
    echo
    "
    <div id='warning'><center>
    <h2>Berkas yang diupload harus lebih kecil dari 2M</h2><br>Klik <a href='uploaddes.php'>ini</a> untuk kembali menu Upload";
    echo "<meta http-equiv='refresh' content='3;URL=uploaddes.php'></center><br></div>";
    }
    else
    {
    if (move_uploaded_file($lokasi_file,$direktori))
      {
      $sql=mysql_query("INSERT INTO upload_mhs (NIM, judul_praoutline, berkas, tanggal, waktu, status_review)
      values ('$initid', '$juduldes', '$nama_ubah', NOW(), '$waktu', '1')");
      $sql2=mysql_query("UPDATE data_mahasiswa set status_upload='1' WHERE NIM='$initid'");
      echo
      "
      <div id='warning'><center>
      <h2>Upload desain praoutline berhasil</h2><br>Tunggulah review dari dosen<br>Klik <a href='uploaddes.php'>ini</a> untuk kembali menu Upload";
      echo "<meta http-equiv='refresh' content='3;URL=uploaddes.php'></center><br></div>";
      }
    }

  }
}


?>

</body>
</html>