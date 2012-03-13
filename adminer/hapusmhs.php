<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
  {
	header("Location: index.php");
  }
  
include "cekonline.php";  
$NIM_hapus = $_GET['nim'];
$query = "DELETE from data_mahasiswa where NIM='$NIM_hapus'";
$query1= " DELETE from log_mhs where NIM='$NIM_hapus'";
$hasil_query=mysql_query($query) or die("Something Wrong" .mysql_error());
$hasil_query1=mysql_query($query1) or die("Something Wrong" .mysql_error());
if ($hasil_query)
{
header("Location: admin-spota.php?part=setdatmhs");
}
?>