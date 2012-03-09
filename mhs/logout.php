<?php
include "../sambung.inc.php";
session_start();
  /*if (!isset($_SESSION['nim']))
  {
   header("Location: ../index.php");
  }*/
 $initid=strtoupper($_SESSION['nim']); 
//$id=$_GET['id'];  
$query = "UPDATE online_user SET sta='0' WHERE id='$initid'";
$result=mysql_query($query);
session_destroy();
header("Location: ../index.php");
?>
