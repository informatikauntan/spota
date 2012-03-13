<?php 
include "../sambung.inc.php";
session_start();
  if (!isset($_SESSION['user_nama']))
  {
	header("Location: index.php");
  }
  
include "cekonline.php";?> 
<body bgcolor="#999999">
<?php
	$nim = $_GET['NIM'];
	$sql = "SELECT pw FROM log_mhs WHERE NIM='$nim'";
	$query = mysql_query($sql);
	$result = mysql_fetch_assoc($query);
	echo "$result[pw]";
?>
</body>

