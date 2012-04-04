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
 
  
$halaman=$_POST['hal']-1;
$cek=$_POST['cek'];
$jum=count($cek);
for($i=0;$i<$jum;$i++)
{
	mysql_query("DELETE FROM pesan_pribadi_mini WHERE id_pesan='$cek[$i]'");
}
header("location:inbox.php?halaman=$halaman"); 
?> 
