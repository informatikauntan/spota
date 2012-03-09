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
  
$id = $_GET['id'];
$hal= $_GET['halaman'];
$kunci = $_GET['keyword'];
$field = $_GET['field'];
$sql="DELETE from upload_mhs where id='$id'";
$sql1="DELETE from review_praoutline where id_upload='$id'";
$sql2="DELETE from review_mhs where id_judul='$id' ";
$exec=mysql_query($sql);
$exec1=mysql_query($sql1);
$exec2=mysql_query($sql2);
if ($exec and $exec1 and $exec2)
{
//unlink(
header("Location: judulpra_asli1.php?key=$kunci&field=$field&halaman=$hal");
}
?>