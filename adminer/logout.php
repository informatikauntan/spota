<?php
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }
//$id=$_GET['id'];  
$query = "UPDATE online_user SET sta='0' WHERE id='$_SESSION[user_nama]'";
$result=mysql_query($query);
session_destroy();
header("Location: index.php");
?>

