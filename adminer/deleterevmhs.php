<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
  {
	header("Location: index.php");
  }
  
include "cekonline.php";  
$key=$_GET['key'];
$field=$_GET['field'];
$urutan=$_GET['urutan'];
$id_jud=$_GET['id_jud'];
$halaman=$_GET['halaman'];
$id_rev=$_GET['id_rev'];
$in=$_GET['urutan_rep'];
$u=$in-1;
$sql=mysql_query("DELETE from review_mhs where id_rev_mhs='$id_rev'");
header("Location: judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$u");
?>
