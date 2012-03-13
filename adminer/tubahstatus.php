<?php
include "../sambung.inc.php";
 session_start();
  if (!isset($_SESSION['user_nama']) )
  {
	header("Location: index.php");
  }

include "cekonline.php";

$id_rev=$_GET['id_rev'];
$sql=mysql_query("UPDATE review_mhs set status='1' where id_rev_mhs='$id_rev'");
header("Location: tamrevmhs.php");
?>
