<?php
include "../sambung.inc.php";
session_start();
 /* if (!isset($_SESSION['nipdos']))
  {
	header("Location: index.php");
  }
//$id=$_GET['id'];  */
$query = "UPDATE online_user SET sta='0' WHERE id='$_SESSION[nipdos]'";
$result=mysql_query($query);
session_destroy();
header("Location: index.php");
?>
