<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
  header("Location: index.php");
  }

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