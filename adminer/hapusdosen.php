<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
  {
	header("Location: index.php");
  }
  
include "cekonline.php";  
$NIP_hapus = $_GET['nip'];
$query = "DELETE from data_dosen where NIP='$NIP_hapus'";
$query1= " DELETE from log_dos where NIP='$NIP_hapus'";
$hasil_query=mysql_query($query) or die("Something Wrong" .mysql_error());
$hasil_query1=mysql_query($query1) or die("Something Wrong" .mysql_error());
if ($hasil_query)
{
header("Location: admin-spota.php?part=setdatdos");
}
?>