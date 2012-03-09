<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
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