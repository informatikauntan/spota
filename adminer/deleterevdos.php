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
$rev=$_GET['rev_sound'];
$no=$_GET['urutan_rep'];
$u=$no-1;
$sql=mysql_query("DELETE from review_praoutline where id_review='$id_rev'");
if (!empty($rev))
{
unlink("../dosen-spota/upload/$rev");
}
header("Location: judulpra_asli2.php?key=$key&field=$field&urutan=$urutan&id_jud=$id_jud&halaman=$halaman#$u");
?>