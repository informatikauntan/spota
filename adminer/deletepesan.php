<?php
include "../sambung.inc.php";
include "converttanggal.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
  header("Location: index.php");
  }

//---------------------  
 $ip=$_SERVER['REMOTE_ADDR'];
 $now=date("Y-m-d H:i:s");
 $query = mysql_query("SELECT * FROM online_user WHERE id='$_SESSION[user_nama]'");
 $cek = mysql_fetch_array($query);
 		$dul=strtotime($cek['tm']);
		$skr=strtotime($now);
		$dif=(integer)$skr-$dul;
		//echo "$dif";
 if ($dif < 600)
 {		
 $sql = mysql_query("UPDATE online_user SET ip='$ip', tm='$now' ,sta='1' WHERE id='$_SESSION[user_nama]'"); 
 }
 else
 {
  $sql = mysql_query("UPDATE online_user SET sta='0' WHERE id='$_SESSION[user_nama]'");
 session_destroy();
 header("Location: index.php");
 }
 $ubah = mysql_query("UPDATE online_user SET sta='0' WHERE ((UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tm))/60) > 10");                                                                     	
//------------------------------  
  
$halaman=$_POST['hal']-1;
$cek=$_POST['cek'];
$jum=count($cek);
for($i=0;$i<$jum;$i++)
{
	mysql_query("DELETE FROM pesan_pribadi_mini WHERE id_pesan='$cek[$i]'");
}
header("location:inbox.php?halaman=$halaman"); 
?> 