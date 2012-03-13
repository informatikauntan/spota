<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
  {
	header("Location: index.php");
  } 
  
include "cekonline.php";  
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