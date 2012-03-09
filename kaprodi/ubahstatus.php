<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['kapro']))
  {
	header("Location: index.php");
  }
$id_jud=$_GET['id'];
$halaman=$_GET['halaman'];
$nim=$_GET['punya'];
$pus=$_GET['act'];
if ($pus=="app")
{
$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id_jud'");  
$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='2' WHERE NIM='$nim'");
header("Location: kaprodi.php");
}
else if ($pus=="dis")
{
$sql=mysql_query("UPDATE upload_mhs set status_review='0' WHERE id='$id_jud'");  
$sqla=mysql_query("UPDATE data_mahasiswa set status_upload='0' WHERE NIM='$nim'");
header("Location: kaprodi.php");
}
else
{
header("Location: kaprodi.php");
}  
?>
