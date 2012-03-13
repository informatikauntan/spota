<?php 
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }
 
include "cekonline.php";
  
$cek=$_POST['cek'];
$jum=count($cek);
for($i=0;$i<$jum;$i++)
{
	mysql_query("DELETE FROM kotak_pesan WHERE no='$cek[$i]'");
}
header("location:kritiksaran.php");

?>